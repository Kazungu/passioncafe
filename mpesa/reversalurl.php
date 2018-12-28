<?php
  $callbackResponse = file_get_contents('php://input');
  $logFile = "reversal.json";
  $log = fopen($logFile, "a");
  fwrite($log, $callbackResponse);
  fclose($log);
  ?>