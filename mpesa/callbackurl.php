<?php
$stkCallbackResponse = file_get_contents("php://input");
$logfile = "stkPushCallbackResponse.json";
$log = fopen($logfile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);
?>