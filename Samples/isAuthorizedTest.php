<?php
require('vendor/autoload.php');
//Authentication
//TODO: Modify the account and license key values
//      contained set in Credentials.php with your own
require('Credentials.php');
use AvaTax\SeverityLevel;
use AvaTax\TaxServiceSoap;

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