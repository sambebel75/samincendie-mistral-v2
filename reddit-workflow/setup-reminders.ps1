# Rappels planifies Windows - Sam Incendie Reddit
# Cree 3 taches hebdo (Lundi/Mercredi/Vendredi) qui affichent un rappel
# "quoi poster / quel sub" et regenerent les brouillons de la semaine.
# NE POSTE RIEN. Rappel seulement.
#
# Installer : powershell -ExecutionPolicy Bypass -File setup-reminders.ps1 -Hour 9
# Retirer   : powershell -ExecutionPolicy Bypass -File setup-reminders.ps1 -Unregister
# (Necessite droits pour Register-ScheduledTask ; sinon lancer PowerShell en admin.)

param(
    [int]$Hour = 9,
    [switch]$Unregister
)

$ErrorActionPreference = "Stop"
$prefix = "SamIncendie_Reddit_"
$days = @{ "Lundi" = "Monday"; "Mercredi" = "Wednesday"; "Vendredi" = "Friday" }

if ($Unregister) {
    foreach ($fr in $days.Keys) {
        $name = "$prefix$fr"
        try { Unregister-ScheduledTask -TaskName $name -Confirm:$false -ErrorAction Stop; Write-Host "Supprime : $name" }
        catch { Write-Warning "Absent ou non supprime : $name" }
    }
    exit 0
}

$gen = Join-Path $PSScriptRoot "generate-drafts.ps1"

foreach ($fr in $days.Keys) {
    $name = "$prefix$fr"
    $en = $days[$fr]

    # Commande executee par la tache : calcule la semaine ISO, regenere les brouillons, popup.
    $inner = @"
`$week = [int](Get-Date -UFormat %V)
try { & '$gen' -Semaine `$week } catch {}
Add-Type -AssemblyName System.Windows.Forms | Out-Null
[System.Windows.Forms.MessageBox]::Show('Jour Reddit ($fr). Brouillons semaine '+`$week+' regeneres dans reddit-workflow. Regle: valeur d abord, lien max 1/semaine, reponse sous 4h.','Sam Incendie - Rappel Reddit') | Out-Null
"@
    $b64 = [Convert]::ToBase64String([Text.Encoding]::Unicode.GetBytes($inner))

    $action  = New-ScheduledTaskAction -Execute "powershell.exe" -Argument "-ExecutionPolicy Bypass -WindowStyle Hidden -EncodedCommand $b64"
    $trigger = New-ScheduledTaskTrigger -Weekly -DaysOfWeek $en -At ([datetime]::Today.AddHours($Hour))
    $settings = New-ScheduledTaskSettingsSet -StartWhenAvailable -AllowStartIfOnBatteries -DontStopIfGoingOnBatteries

    try {
        Register-ScheduledTask -TaskName $name -Action $action -Trigger $trigger -Settings $settings `
            -Description "Rappel Reddit Sam Incendie ($fr $Hour h)" -Force | Out-Null
        Write-Host "OK - tache : $name ($fr $Hour h00)" -ForegroundColor Green
    } catch {
        Write-Error "Echec creation $name : $($_.Exception.Message). Essayez PowerShell en administrateur."
    }
}
Write-Host "Termine. Verifier dans le Planificateur de taches Windows (dossier racine)." -ForegroundColor Cyan
