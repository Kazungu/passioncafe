<?php
  /* Urls */
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
  /* Required Variables */
  $consumerkey = 'FwmpiGjAETs9YqE5gXOVwLBQkJMv7lHq';
	$consumersecret = 'NEmjGgX8eHGxUHMz';
  $headers = ['Content-Type:application/json; charset=utf8'];
  
  /* from the test credentials provided on you developers account */
    $IntiatorName = 'testapi';
    $SecurityCredential = 'PZhrFknXmZXuOsxFX6gqv4NKHf/udExm3Vz+RaWyn9RtO3i4G9uQFPJR8AOdceL/DQ9uMb6f29aCkAaI91fwAlaLG/ZO1MnURrugP8+FW4hn8Rjzo8wGbVi9esp1ZsECiaEv53JnG1RSZ2IvTAvg2zANtxW2uASX9rBuPuPPUj7C8LeGZvixNGXiHpxdv4mRh+RL7MS3CO74Hkvw5Yg+C+lSZRX+JAoqtct1gx890gZD8xk3PMQ085o6ZrW5e42mJ+EmDoe5y9VpKEj8Skl+SmVShcIEoM61osPpY8xARsxNLC4RJ4miCfCeY1c3SuADMcaIh8Z8JQcxwQUSHOXPJw==';
    $CommandID = 'SalaryPayment';
    $Amount = ' 2500';
    $PartyA = '600862';
    $PartyB = '254708374149';
    $Remarks = 'Salary';
    $QueueTimeOutURL = 'http://mfano.nim.co.ke/mpesa/callbackurl.php';
    $ResultURL = 'http://mfano.nim.co.ke/mpesa/callbackurl.php';
    $Occasion = 'Salary,October 2018';          

  /* Obtain Access Token */
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
  
  /* Main B2C Request to the API */
  $b2cHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2c_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cHeader); //setting custom header
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => $InitiatorName,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL,
    'Occasion' => $Occasion
  );
  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  echo $curl_response;
?>