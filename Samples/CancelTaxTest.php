<?php
require('vendor/autoload.php');
//Authentication
//TODO: Modify the account and license key values
//      contained set in Credentials.php with your own
require('Credentials.php');
use AvaTax\CancelTaxRequest;
use AvaTax\TaxServiceSoap;

$taxSvc = new TaxServiceSoap('Development');
$cancelTaxRequest = new CancelTaxRequest();
$cancelTaxRequest->setDocCode('INV001');
$cancelTaxRequest->setDocType('SalesInvoice');
$cancelTaxRequest->setCompanyCode("APITrialCompany");
$cancelTaxRequest->setCancelCode('DocVoided');
try {
  $cancelTaxResult = $taxSvc->cancelTax($cancelTaxRequest);
  echo 'CancelTax ResultCode is: ' . $cancelTaxResult->getResultCode() . "\n";
  if ($cancelTaxResult->getResultCode() != "Success") {
    foreach ($cancelTaxResult->getMessages() as $message) {
      echo $message->getName() . ": " . $message->getSummary() . "\n";
    }
  }
} catch (SoapFault $exception)
    {
    $message = "Exception: ";
    if ($exception)
        {
        $message .= $exception->faultstring;
        }
    echo $message . "\n";
    echo $taxSvc->__getLastRequest() . "\n";
    echo $taxSvc->__getLastResponse() . "\n   ";
    }
