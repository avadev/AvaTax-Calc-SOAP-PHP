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
$client = new AddressServiceSoap('Development');
try
    {
    $address = new Address();
    $address->setLine1("118 N Clark St");
    $address->setLine2("");
    $address->setLine3("");
    $address->setCity("Chicago");
    $address->setRegion("IL");
    $address->setPostalCode("60602");
    $textCase = TextCase::$Mixed;
    $coordinates = 1;
//Request      
    $request = new ValidateRequest($address, ($textCase ? $textCase : TextCase::$Default), $coordinates);
    $result = $client->Validate($request);
//Results  
// Output to console the result (Success or Not Success)
    echo "\n" . 'Validate ResultCode is: ' . $result->getResultCode() . "\n";
    if ($result->getResultCode() != SeverityLevel::$Success)
        {
        foreach ($result->getMessages() as $msg)
            {
            echo $msg->getName() . ": " . $msg->getSummary() . "\n";
            }
        } else
        {
        echo "Normalized Address: \n";
        foreach ($result->getvalidAddresses() as $valid)
            {
            echo "Line 1: " . $valid->getline1() . "\n";
            echo "Line 2: " . $valid->getline2() . "\n";
            echo "Line 3: " . $valid->getline3() . "\n";
            echo "Line 4: " . $valid->getline4() . "\n";
            echo "City: " . $valid->getcity() . "\n";
            echo "Region: " . $valid->getregion() . "\n";
            echo "Postal Code: " . $valid->getpostalCode() . "\n";
            echo "Country: " . $valid->getcountry() . "\n";
            echo "County: " . $valid->getcounty() . "\n";
            echo "FIPS Code: " . $valid->getfipsCode() . "\n";
            echo "PostNet: " . $valid->getpostNet() . "\n";
            echo "Carrier Route: " . $valid->getcarrierRoute() . "\n";
            echo "Address Type: " . $valid->getaddressType() . "\n";
            if ($coordinates == 1)
                {
                echo "Latitude: " . $valid->getlatitude() . "\n";
                echo "Longitude: " . $valid->getlongitude() . "\n";
                }
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