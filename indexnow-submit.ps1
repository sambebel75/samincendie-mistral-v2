# IndexNow submit - Sam Incendie
# Notifie Bing/Copilot (moteurs IndexNow) des URLs a (re)crawler.
# Usage : powershell -ExecutionPolicy Bypass -File indexnow-submit.ps1
# Lit sitemap.xml, envoie toutes les <loc> a api.indexnow.org.

$HostName    = "samincendie.fr"
$Key         = "71c171590e8947eaa92b7a43391e65fa2dba5e0a86ae456baf9df36e3533e6cd"
$KeyLocation = "https://$HostName/$Key.txt"
$SitemapPath = Join-Path $PSScriptRoot "sitemap.xml"

if (-not (Test-Path $SitemapPath)) { Write-Error "sitemap.xml introuvable"; exit 1 }

[xml]$sitemap = Get-Content $SitemapPath -Raw
$urls = $sitemap.urlset.url.loc
if (-not $urls) { Write-Error "Aucune loc dans sitemap.xml"; exit 1 }

$payload = @{
    host        = $HostName
    key         = $Key
    keyLocation = $KeyLocation
    urlList     = @($urls)
} | ConvertTo-Json

Write-Host ("Soumission de " + @($urls).Count + " URLs a IndexNow...")
try {
    Invoke-RestMethod -Uri "https://api.indexnow.org/indexnow" -Method Post -ContentType "application/json; charset=utf-8" -Body $payload
    Write-Host "OK - URLs soumises (200/202 = accepte)." -ForegroundColor Green
} catch {
    Write-Error ("Echec soumission : " + $_.Exception.Message)
    exit 1
}
