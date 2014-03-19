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
    $result = $client->isAuthorized("GetTax");
    echo 'IsAuthorized ResultCode is: ' . $result->getResultCode() . "\n";
    if ($result->getResultCode() != SeverityLevel::$Success) // call failed
        {
        echo "isAuthorized(\"Validate\") failed\n";
        foreach ($result->Messages() as $idx => $msg)
            {
            echo $msg->getName() . ": " . $msg->getSummary() . "\n";
            }
        } else
        {
        echo "isAuthorized succeeded\n";
//        echo 'Expiration: ' . $result->getexpires() . "\n";
//        echo "Operation: " . $result->getOperations() . "\n\n";
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