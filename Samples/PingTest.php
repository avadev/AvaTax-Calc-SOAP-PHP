<?php
require('vendor/autoload.php');
//Authentication
//TODO: Modify the account and license key values
//      contained set in Credentials.php with your own
require('Credentials.php');
use AvaTax\SeverityLevel;
use AvaTax\TaxServiceSoap;

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
