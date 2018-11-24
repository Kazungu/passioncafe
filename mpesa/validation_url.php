<?php
	header("Content-Type: application/json");

	
	$response ='{
			"ResultCode" : 0,
			"ResultDesc": "Confirmation Received Successfully"
			}';
	//Data from mpesa
		$mpesaResponse = file_get_contents("php://input");

	// log the response

		$logfile = "m_pesaresponses.txt";	
		$jsonMpesaResponse = json_decode($mpesaResponse, true);
	// write to file
		$log = fopen($logfile, "a");

		fwrite($log, "$mpesaResponse");
		fclose($log);

		echo $response;

?>