# IndexNow submit - Sam Incendie
# Notifie Bing/Copilot (et moteurs IndexNow) des URLs a (re)crawler.
# Usage : powershell -ExecutionPolicy Bypass -File indexnow-submit.ps1
# Recupere le sitemap en ligne (aucun fichier local requis) et envoie
# toutes les <loc> a api.indexnow.org. Script pur ASCII (compatible PS 5.1).

$HostName    = "samincendie.fr"
$Key         = "71c171590e8947eaa92b7a43391e65fa2dba5e0a86ae456baf9df36e3533e6cd"
$KeyLocation = "https://$HostName/$Key.txt"
$SitemapUrl  = "https://$HostName/sitemap.xml"

[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12

Write-Host "Lecture du sitemap en ligne : $SitemapUrl"
try {
    [xml]$sitemap = (Invoke-WebRequest -Uri $SitemapUrl -UseBasicParsing).Content
} catch {
    Write-Error "Impossible de lire le sitemap : $($_.Exception.Message)"
    exit 1
}

$urls = @($sitemap.urlset.url.loc)
if (-not $urls -or $urls.Count -eq 0) { Write-Error "Aucune <loc> dans le sitemap"; exit 1 }

$body = @{
    host        = $HostName
    key         = $Key
    keyLocation = $KeyLocation
    urlList     = $urls
} | ConvertTo-Json

Write-Host "Soumission de $($urls.Count) URLs a IndexNow..."
try {
    Invoke-RestMethod -Uri "https://api.indexnow.org/indexnow" `
        -Method Post -ContentType "application/json; charset=utf-8" -Body $body
    Write-Host "OK - URLs soumises (200/202 = accepte)." -ForegroundColor Green
} catch {
    $code = $null
    if ($_.Exception.Response) { $code = [int]$_.Exception.Response.StatusCode }
    if ($code -eq 200 -or $code -eq 202) {
        Write-Host "OK - HTTP $code (accepte)." -ForegroundColor Green
    } else {
        Write-Error "Echec soumission (HTTP $code) : $($_.Exception.Message)"
        exit 1
    }
}
