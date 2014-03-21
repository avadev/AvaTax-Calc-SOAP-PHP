<?php
require('AvaTax4PHP\AvaTax.php');
//Authentication
//TODO: Replace account and license key with your credentials
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net',
    'account' => '1234567890',
    'license' => 'A1B2C3D4E5F6G7H8')
);
$client = new TaxServiceSoap('Development');
$request = new CommitTaxRequest();
$request->setDocCode('INV001');
$request->setDocType('SalesInvoice');
$request->setCompanyCode("APITrialCompany");
try
    {
    $result = $client->commitTax($request);
    echo 'CommitTax ResultCode is: ' . $result->getResultCode() . "\n";

    if ($result->getResultCode() != SeverityLevel::$Success)
        {
        foreach ($result->getMessages() as $msg)
            {
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