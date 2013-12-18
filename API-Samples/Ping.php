<?php

require('../AvaTax4PHP/AvaTax.php');
require('../Security/Credentials.php');
$client = new TaxServiceSoap('Development');
try {
  $result = $client->ping("");
  echo 'Ping ResultCode is: ' . $result->getResultCode() . "\n";
  if ($result->getResultCode() != SeverityLevel::$Success) {
    foreach ($result->Messages() as $msg) {
      echo $msg->Name() . ": " . $msg->Summary() . "\n";
    }
  } else { // successful calll
    echo 'Ping Version is: ' . $result->getVersion() . "\n\n";
  }
} catch (SoapFault $exception) {
  $msg = "Exception: ";
  if ($exception)
    $msg .= $exception->faultstring;

  echo $msg . "\n";
  echo $client->__getLastRequest() . "\n";
  echo $client->__getLastResponse() . "\n";
}
?>
