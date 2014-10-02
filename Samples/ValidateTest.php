<?php
require('vendor/autoload.php');
//Authentication
//TODO: Modify the account and license key values
//      contained set in Credentials.php with your own
require('Credentials.php');
use AvaTax\Address;
use AvaTax\AddressServiceSoap;
use AvaTax\TextCase;
use AvaTax\ValidateRequest;
use AvaTax\SeverityLevel;

$addressSvc = new AddressServiceSoap('Development');
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
    $validateRequest = new ValidateRequest($address, ($textCase ? $textCase : TextCase::$Default), $coordinates);
    $validateResult = $addressSvc->Validate($validateRequest);
//Results  
    echo "\n" . 'Validate ResultCode is: ' . $validateResult->getResultCode() . "\n";
    if ($validateResult->getResultCode() != SeverityLevel::$Success)
        {
        foreach ($validateResult->getMessages() as $message)
            {
            echo $message->getName() . ": " . $message->getSummary() . "\n";
            }
        } else
        {
        echo "Normalized Address: \n";
        foreach ($validateResult->getvalidAddresses() as $valid)
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
    $message = "Exception: ";
    if ($exception)
        {
        $message .= $exception->faultstring;
        }
    echo $message . "\n";
    echo $addressSvc->__getLastRequest() . "\n";
    echo $addressSvc->__getLastResponse() . "\n   ";
    }
