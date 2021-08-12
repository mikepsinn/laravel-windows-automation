$ScriptDir = Split-Path -parent $MyInvocation.MyCommand.Path
Import-Module $ScriptDir\powershell_functions.ps1

MinimizeWindows

# Popup
Show-Warning-From-File "$ScriptDir\message.txt"

OpenUrlsFromFile "$ScriptDir\urls.txt"
OpenApplicationsFromFile "$ScriptDir\applications.txt"