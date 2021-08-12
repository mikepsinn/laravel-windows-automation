<?php /** @noinspection PhpUnhandledExceptionInspection */
// Loading Library
require_once "config.php";
require_once "utils.php";
require_once "powershell.php";
// Setting Headers
header('Content-Type: application/json');
// If Not Trusted
if(!isTrustedUser()) throw new Exception('Unauthorized');
$r = ['success' => 'ok'];
$r['command'] = $command = getCommand();
if(!$command){
	$r['success'] = false;
	$r['message'] = 'Please POST a command or script!';
} else{
	$ps = new PowerShell();
	$r['data'] = $ps->execute($command);
}
// Parse Request
echo json_encode($r);
  