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

try
    {
    $pingResult = $taxSvc->ping("");
    echo 'Ping ResultCode is: ' . $pingResult->getResultCode() . "\n";
    if ($pingResult->getResultCode() != SeverityLevel::$Success)
        {
        foreach ($pingResult->Messages() as $messages)
            {
            echo $messages->Name() . ": " . $messages->Summary() . "\n";
            }
        } else
        {
        echo 'Ping Version is: ' . $pingResult->getVersion() . "\n";
        echo 'TransactionID is: ' . $pingResult->getTransactionId() . "\n\n";
        }
   } catch (SoapFault $exception)
    {
    $messages = "Exception: ";
    if ($exception)
        {
        $messages .= $exception->faultstring;
        }
    echo $messages . "\n";
    echo $taxSvc->__getLastRequest() . "\n";
    echo $taxSvc->__getLastResponse() . "\n   ";
    }