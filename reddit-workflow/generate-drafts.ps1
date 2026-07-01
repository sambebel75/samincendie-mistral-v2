# Generateur de brouillons Reddit - Sam Incendie
# Lit calendrier.json + templates.json, produit les posts de la semaine en Markdown.
# Usage : powershell -ExecutionPolicy Bypass -File generate-drafts.ps1 -Semaine 1
#         powershell -ExecutionPolicy Bypass -File generate-drafts.ps1 -Semaine 4 -OutDir "C:\chemin"
# ToS-safe : ne poste RIEN. Genere du texte a copier-coller manuellement.

param(
    [int]$Semaine = 1,
    [string]$OutDir = $PSScriptRoot
)

$ErrorActionPreference = "Stop"
$enc = New-Object System.Text.UTF8Encoding($false)

$calPath = Join-Path $PSScriptRoot "calendrier.json"
$tplPath = Join-Path $PSScriptRoot "templates.json"
if (-not (Test-Path $calPath)) { Write-Error "calendrier.json introuvable"; exit 1 }
if (-not (Test-Path $tplPath)) { Write-Error "templates.json introuvable"; exit 1 }

$cal = [System.IO.File]::ReadAllText($calPath, $enc) | ConvertFrom-Json
$tpl = [System.IO.File]::ReadAllText($tplPath, $enc) | ConvertFrom-Json

# Trouver les posts de la semaine demandee (dans toutes les phases)
$hits = @()
foreach ($phase in $cal.phases) {
    foreach ($p in $phase.posts) {
        $sem = "$($p.semaine)"
        $hit = $false
        if ($sem -eq "$Semaine") {
            $hit = $true
        } elseif ($sem -match '^(\d+)-(\d+)$') {
            $lo = [int]$Matches[1]; $hi = [int]$Matches[2]
            if ($lo -le $Semaine -and $Semaine -le $hi) { $hit = $true }
        }
        if ($hit) { $hits += [pscustomobject]@{ Phase = $phase.phase; Post = $p } }
    }
}

if ($hits.Count -eq 0) { Write-Warning "Aucun post pour la semaine $Semaine (le calendrier couvre S1 a S12)."; exit 0 }

$sb = New-Object System.Text.StringBuilder
[void]$sb.AppendLine("# Brouillons Reddit - Semaine $Semaine")
[void]$sb.AppendLine("")
[void]$sb.AppendLine("Genere le $(Get-Date -Format 'yyyy-MM-dd HH:mm'). Marque : $($cal.meta.marque). Flair : $($cal.meta.flair).")
[void]$sb.AppendLine("")
[void]$sb.AppendLine("> Regle d'or : $($cal.meta.regle_or)")
[void]$sb.AppendLine("")
[void]$sb.AppendLine("---")
[void]$sb.AppendLine("")

$i = 0
foreach ($m in $hits) {
    $i++
    $post = $m.Post
    $t = $tpl.($post.template)
    $lienTxt = if ($post.lien -eq $true) { "OUI (1 lien autorise cette semaine)" } elseif ($post.lien -eq "rare") { "RARE (eviter sauf pertinence forte)" } else { "NON - aucun lien" }

    [void]$sb.AppendLine("## $i. $($post.jour) - $($post.sub) - $($post.type)")
    [void]$sb.AppendLine("")
    [void]$sb.AppendLine("- Phase : $($m.Phase)")
    [void]$sb.AppendLine("- Objectif du jour : $($post.sujet)")
    [void]$sb.AppendLine("- Lien autorise : $lienTxt")
    [void]$sb.AppendLine("- Template : $($t.nom)")
    [void]$sb.AppendLine("")
    if ($t.titre) {
        [void]$sb.AppendLine("**Titre propose :**")
        [void]$sb.AppendLine("")
        [void]$sb.AppendLine("    $($t.titre)")
        [void]$sb.AppendLine("")
    }
    [void]$sb.AppendLine("**Corps (a adapter au thread) :**")
    [void]$sb.AppendLine("")
    foreach ($line in ($t.corps -split "`n")) { [void]$sb.AppendLine("    $line") }
    [void]$sb.AppendLine("")
    if ($post.lien -eq $true -and $t.cta_avec_lien) {
        [void]$sb.AppendLine("**CTA (lien) :** $($t.cta_avec_lien)")
    } elseif ($t.cta_sans_lien) {
        [void]$sb.AppendLine("**CTA (sans lien) :** $($t.cta_sans_lien)")
    }
    [void]$sb.AppendLine("")
    [void]$sb.AppendLine("_Rappel : $($t.regle_lien)_")
    [void]$sb.AppendLine("")
    [void]$sb.AppendLine("---")
    [void]$sb.AppendLine("")
}

$outFile = Join-Path $OutDir ("reddit-brouillons-S{0:00}.md" -f $Semaine)
[System.IO.File]::WriteAllText($outFile, $sb.ToString(), $enc)
Write-Host "OK - $($hits.Count) brouillon(s) ecrit(s) : $outFile" -ForegroundColor Green
