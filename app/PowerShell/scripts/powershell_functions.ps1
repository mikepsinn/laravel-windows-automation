Function OpenUrls ($urls) {
    foreach ($url in $urls)
    {
        $url.replace("%", "%%")
        # Default browser
        Start-Process $url
        # Edge
        #$Browser=new-object -com internetExplorer.application
        # $Browser.navigate2($SitePath)
        # $Browser.visible=$true
        # FireFox
        #[system.Diagnostics.Process]::Start("firefox", $SitePath)
    }
}

Function OpenUrlsFromFile ($path) {
    [string[]]$urls = Get-Content -Path $path
    OpenUrls $urls
}

Function OpenApplications ($applications) {
    foreach ($application in $applications)
    {
        Start-Process -FilePath $application
    }
}

Function OpenApplicationsFromFile ($path) {
    [string[]]$applications = Get-Content -Path $path
    OpenApplications $applications
}

Function MinimizeWindows () {
    $shell = New-Object -ComObject "Shell.Application"
    $shell.minimizeall()
}

Function Show-Warning-From-File ($file) {
    $message = Get-Content $file -Raw
    Show-Warning $message
}

Function Show-Warning ($msg) {
    # Popup
    [System.Reflection.Assembly]::LoadWithPartialName('System.Windows.Forms')
    [System.Windows.Forms.MessageBox]::Show($msg,'WARNING')
}

Function OpenForm ($buttonText, $button_Onclick) {
    Add-Type -AssemblyName System.Windows.Forms

    $Form = New-Object system.Windows.Forms.Form
    $Form.Text = 'Are you working on your MOST IMPORTANT TASK?'
    $Form.Width = 300
    $Form.Height = 200

    $label2 = New-Object system.windows.Forms.Label
    $label2.AutoSize = $true
    $label2.Width = 25
    $label2.Height = 10
    $label2.location = new-object system.drawing.size(71,89)
    $label2.Font = "Microsoft Sans Serif,10"
    $Form.controls.Add($label2)

    $button4 = New-Object system.windows.Forms.Button
    $button4.add_Click($button_Onclick)
    $button4.Text = $buttonText
    $button4.Width = 100
    $button4.Height = 30
    $button4.location = new-object system.drawing.size(15,15)
    $button4.Font = "Microsoft Sans Serif,10"
    $button4.AutoEllipsis
    $Form.controls.Add($button4)

    $Form.ShowDialog()
}

function New-Symlink {
    <#
    .SYNOPSIS
        Creates a symbolic link.
    #>
    param (
        [Parameter(Position=0, Mandatory=$true)]
        [string] $Link,
        [Parameter(Position=1, Mandatory=$true)]
        [string] $Target
    )

    Invoke-MKLINK -Link $Link -Target $Target -Symlink
}


function New-Hardlink {
    <#
    .SYNOPSIS
        Creates a hard link.
    #>
    param (
        [Parameter(Position=0, Mandatory=$true)]
        [string] $Link,
        [Parameter(Position=1, Mandatory=$true)]
        [string] $Target
    )

    Invoke-MKLINK -Link $Link -Target $Target -HardLink
}


function New-Directory-Junction {
    <#
    .SYNOPSIS
        Creates a directory junction.
    #>
    param (
        [Parameter(Position=0, Mandatory=$true)]
        [string] $Link,
        [Parameter(Position=1, Mandatory=$true)]
        [string] $Target
    )

    Invoke-MKLINK -Link $Link -Target $Target -Junction
}


function Invoke-MKLINK {
    <#
    .SYNOPSIS
        Creates a symbolic link, hard link, or directory junction.
    #>
    [CmdletBinding(DefaultParameterSetName = "Symlink")]
    param (
        [Parameter(Position=0, Mandatory=$true)]
        [string] $Link,
        [Parameter(Position=1, Mandatory=$true)]
        [string] $Target,

        [Parameter(ParameterSetName = "Symlink")]
        [switch] $Symlink = $true,
        [Parameter(ParameterSetName = "HardLink")]
        [switch] $HardLink,
        [Parameter(ParameterSetName = "Junction")]
        [switch] $Junction
    )

    # Ensure target exists.
    if (-not(Test-Path $Target)) {
        throw "Target does not exist.`nTarget: $Target"
    }

    # Ensure link does not exist.
    if (Test-Path $Link) {
        throw "A file or directory already exists at the link path.`nLink: $Link"
    }

    $isDirectory = (Get-Item $Target).PSIsContainer
    $mklinkArg = ""

    if ($Symlink -and $isDirectory) {
        $mkLinkArg = "/D"
    }

    if ($Junction) {
        # Ensure we are linking a directory. (Junctions don't work for files.)
        if (-not($isDirectory)) {
            throw "The target is a file. Junctions cannot be created for files.`nTarget: $Target"
        }

        $mklinkArg = "/J"
    }

    if ($HardLink) {
        # Ensure we are linking a file. (Hard links don't work for directories.)
        if ($isDirectory) {
            throw "The target is a directory. Hard links cannot be created for directories.`nTarget: $Target"
        }

        $mkLinkArg = "/H"
    }

    # Capture the MKLINK output so we can return it properly.
    # Includes a redirect of STDERR to STDOUT so we can capture it as well.
    $output = cmd /c mklink $mkLinkArg `"$Link`" `"$Target`" 2>&1

    if ($lastExitCode -ne 0) {
        throw "MKLINK failed. Exit code: $lastExitCode`n$output"
    }
    else {
        Write-Output $output
    }
}

function Add-Reminder-To-Task-Scheduler{
    <#
.Synopsis
Creates a scheduled task that will display a reminder.
.Description
Creates a scheduled task that will display a reminder.
.Parameter Time
Time when the reminder should be displayed.
.Parameter Reminder
Message of the reminder.
.Example
Add-Reminder -Reminder  "Clean Kitchen" -time "1/1/2016 12:00 PM"
This example will remind you to clean your kitchen on 1/1/2016 at 12:00 PM
#>
    Param(
        [string]$Reminder,
        [datetime]$Time
    )
    $Task = New-ScheduledTaskAction -Execute msg -Argument "* $Reminder"
    $trigger =  New-ScheduledTaskTrigger -Once -At $Time
    $Random = (Get-random)
    Register-ScheduledTask -Action $task -Trigger $trigger -TaskName "Reminder_$Random" -Description "Reminder"
}