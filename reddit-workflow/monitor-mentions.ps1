# Moniteur de mentions Reddit - Sam Incendie (READ-ONLY, ToS-safe)
# Cherche les mots-cles marque + metier sur Reddit, liste les threads chauds
# ou repondre, et compte les mentions (mesure GEO).
# Usage : powershell -ExecutionPolicy Bypass -File monitor-mentions.ps1
#         powershell -ExecutionPolicy Bypass -File monitor-mentions.ps1 -Jours 14
#
# Auth (recommande, evite le blocage) : creer une app sur
#   https://www.reddit.com/prefs/apps  (type "script")
# puis copier monitor-config.example.json en monitor-config.json et remplir.
# Sans config, le script tente la recherche publique (peut etre limitee).

param(
    [int]$Jours = 7,
    [int]$Limit = 25
)

$ErrorActionPreference = "Stop"
$enc = New-Object System.Text.UTF8Encoding($false)
$UA  = "windows:samincendie-monitor:v1.0 (by /u/sam_incendie_expert)"

$keywords = @('samincendie', '"Sam Incendie"', 'SSIAP 3', 'conformite incendie ERP', 'audit incendie ERP', 'desenfumage ERP')
$sinceEpoch = [DateTimeOffset]::UtcNow.AddDays(-$Jours).ToUnixTimeSeconds()

# --- Auth optionnelle (app-only OAuth) ---
$token = $null
$cfgPath = Join-Path $PSScriptRoot "monitor-config.json"
if (Test-Path $cfgPath) {
    try {
        $cfg = [System.IO.File]::ReadAllText($cfgPath, $enc) | ConvertFrom-Json
        $pair = "$($cfg.client_id):$($cfg.client_secret)"
        $basic = [Convert]::ToBase64String([Text.Encoding]::ASCII.GetBytes($pair))
        $body = @{ grant_type = "client_credentials" }
        if ($cfg.username -and $cfg.password) {
            $body = @{ grant_type = "password"; username = $cfg.username; password = $cfg.password }
        }
        $tok = Invoke-RestMethod -Uri "https://www.reddit.com/api/v1/access_token" -Method Post `
            -Headers @{ Authorization = "Basic $basic"; "User-Agent" = $UA } -Body $body
        $token = $tok.access_token
        Write-Host "Auth OAuth OK." -ForegroundColor Green
    } catch {
        Write-Warning "Auth echouee, bascule en recherche publique. ($($_.Exception.Message))"
    }
}

function Search-Reddit($query) {
    $q = [uri]::EscapeDataString($query)
    if ($token) {
        $uri = "https://oauth.reddit.com/search?q=$q&sort=new&limit=$Limit&type=link"
        $hdr = @{ Authorization = "Bearer $token"; "User-Agent" = $UA }
    } else {
        $uri = "https://www.reddit.com/search.json?q=$q&sort=new&limit=$Limit&type=link"
        $hdr = @{ "User-Agent" = $UA }
    }
    try { return (Invoke-RestMethod -Uri $uri -Headers $hdr).data.children }
    catch { Write-Warning "Recherche '$query' echouee : $($_.Exception.Message)"; return @() }
}

$rows = @()
$seen = @{}
foreach ($kw in $keywords) {
    foreach ($c in (Search-Reddit $kw)) {
        $d = $c.data
        if ($d.created_utc -lt $sinceEpoch) { continue }
        if ($seen.ContainsKey($d.id)) { continue }
        $seen[$d.id] = $true
        $rows += [pscustomobject]@{
            KW       = $kw
            Sub      = "r/$($d.subreddit)"
            Score    = [int]$d.score
            Comments = [int]$d.num_comments
            Date     = ([DateTimeOffset]::FromUnixTimeSeconds([long]$d.created_utc)).ToString("yyyy-MM-dd")
            Titre    = $d.title
            URL      = "https://www.reddit.com$($d.permalink)"
        }
    }
    Start-Sleep -Milliseconds 800  # respect rate-limit
}

$rows = $rows | Sort-Object -Property @{Expression="Comments";Descending=$true}, @{Expression="Score";Descending=$true}

Write-Host ""
Write-Host "=== Mentions Reddit ($Jours derniers jours) : $($rows.Count) thread(s) ===" -ForegroundColor Cyan
$rows | Select-Object Sub, Score, Comments, Date, Titre | Format-Table -AutoSize -Wrap

# Rapport Markdown horodate
$sb = New-Object System.Text.StringBuilder
[void]$sb.AppendLine("# Mentions Reddit - $(Get-Date -Format 'yyyy-MM-dd')")
[void]$sb.AppendLine("")
[void]$sb.AppendLine("Fenetre : $Jours jours. Total : $($rows.Count) threads. Mots-cles : $($keywords -join ', ').")
[void]$sb.AppendLine("")
[void]$sb.AppendLine("| Sub | Score | Comm. | Date | Titre | Lien |")
[void]$sb.AppendLine("|-----|-------|-------|------|-------|------|")
foreach ($r in $rows) {
    $t = ($r.Titre -replace '\|', '/')
    [void]$sb.AppendLine("| $($r.Sub) | $($r.Score) | $($r.Comments) | $($r.Date) | $t | [thread]($($r.URL)) |")
}
$outFile = Join-Path $PSScriptRoot ("reddit-mentions-{0}.md" -f (Get-Date -Format 'yyyyMMdd'))
[System.IO.File]::WriteAllText($outFile, $sb.ToString(), $enc)
Write-Host "Rapport ecrit : $outFile" -ForegroundColor Green
Write-Host "Priorite reponse : threads avec le plus de commentaires = engagement + visibilite." -ForegroundColor Yellow
