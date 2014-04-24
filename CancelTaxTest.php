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