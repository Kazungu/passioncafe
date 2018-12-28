<?php
  /* access token */
    $consumerKey = 'FwmpiGjAETs9YqE5gXOVwLBQkJMv7lHq'; //Fill with your app Consumer Key
    $consumerSecret = 'NEmjGgX8eHGxUHMz'; // Fill with your app Secret
    $headers = ['Content-Type:application/json; charset=utf8'];
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);
    $access_token = $result->access_token;
    curl_close($curl);
  /* making the request */
    $tstatus_url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $tstatus_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
    $curl_post_data = array(
      //Fill in the request parameters with valid values
      'Initiator' => 'testapi',
      'SecurityCredential' => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',
      'CommandID' => 'TransactionStatusQuery',
      'TransactionID' => 'trans12',
      'PartyA' => '600198', // shortcode 1
      'IdentifierType' => '4',
      'ResultURL' => 'http://mfano.nim.co.ke/mpesa/transresulturl.php',
      'QueueTimeOutURL' => 'http://mfano.nim.co.ke/mpesa/transresulturl.php',
      'Remarks' => 'salary_2018',
      'Occasion' => 'salary'
    );
    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    print_r($curl_response);
    echo $curl_response;
?>