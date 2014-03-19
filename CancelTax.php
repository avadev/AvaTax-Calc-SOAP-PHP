<?php
require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '110000000',
    'license' => '1A2B3C4D5E6F7G8')
);
$client = new TaxServiceSoap('Development');
$request = new CancelTaxRequest();
$request->setDocCode('10000000');
$request->setDocType('SalesInvoice');
$request->setCompanyCode("Cust1234");
$request->setCancelCode('DocDeleted');
try {
  $result = $client->cancelTax($request);
  echo 'CancelTax ResultCode is: ' . $result->getResultCode() . "\n";
  if ($result->getResultCode() != "Success") {
    foreach ($result->getMessages() as $msg) {
      echo $msg->getName() . ": " . $msg->getSummary() . "\n";
    }
  }
} catch (SoapFault $exception)
    {
    $msg = "Exception: ";
    if ($exception)
        {
        $msg .= $exception->faultstring;
        }
    echo $msg . "\n";
    echo $client->__getLastRequest() . "\n";
    echo $client->__getLastResponse() . "\n   ";
    }