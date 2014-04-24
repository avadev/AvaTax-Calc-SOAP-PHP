<?php

require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '1234567890',
    'license' => 'A1B2C3D4E5F6G7H8',
    'client' => 'AvaTaxSample',
    'name' => '14.2')
);
$taxSvc = new TaxServiceSoap('Development');

try {
  $isAuthorizedResult = $taxSvc->isAuthorized('GetTax');
  echo 'IsAuthorized ResultCode is: ' . $isAuthorizedResult->getResultCode() . "\n";
  if ($isAuthorizedResult->getResultCode() != SeverityLevel::$Success) {
    echo "isAuthorized(\"TaxSvc\") failed\n";
    foreach ($isAuthorizedResult->Messages() as $message => $message) {
      echo $message->getName() . ": " . $message->getSummary() . "\n";
    }
  } else {
    echo "isAuthorized succeeded\n";
    echo 'Expiration: ' . $isAuthorizedResult->getexpires() . "\n";
    echo "Operation: " . $isAuthorizedResult->getOperations() . "\n\n";
  }
} catch (SoapFault $exception) {
  $message = "Exception: ";
  if ($exception) {
    $message .= $exception->faultstring;
  }
  echo $message . "\n";
  echo $taxSvc->__getLastRequest() . "\n";
  echo $taxSvc->__getLastResponse() . "\n   ";
}