<?php 
    function tokengeneration(){
        // consume keys generated from safaricom daraja api portal
        $consumerkey = 'hTPwOT2qhmnWgl6jgA5FzKdxPQePs8Tw';
	    $consumersecret = 'HLLBmfuVQj8nnf2F';

        $headers =['Content-Type:application/json; charset=utf8'];
        // sandbox for testing 
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        // call the url using the curl function
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerkey. ':'.$consumersecret);

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

        $access_token = $result->access_token;

        echo $access_token;

        curl_close($curl);
    }
    tokengeneration();
?>