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
try
    {
    $result = $client->ping("");
    echo 'Ping ResultCode is: ' . $result->getResultCode() . "\n";
    if ($result->getResultCode() != SeverityLevel::$Success)
        {
        foreach ($result->Messages() as $msg)
            {
            echo $msg->Name() . ": " . $msg->Summary() . "\n";
            }
        } else
        {
        echo 'Ping Version is: ' . $result->getVersion() . "\n";
        echo 'TransactionID is: ' . $result->getTransactionId() . "\n\n";
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