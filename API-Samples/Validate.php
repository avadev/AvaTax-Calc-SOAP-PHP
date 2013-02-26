<?php

require('../../AvaTax4PHP/AvaTax.php');            // location of the AvaTax.PHP Classes - Required
require('../Credentials.php');	                  // where service URL, account, license key are set

$client = new AddressServiceSoap('Development');

$file = fopen('..\Invoice-Samples\Address.csv', 'r');   //uses sample input document
while ($line = fgets($file)) {                         //Reads a line from the input document
   
 //Assigns variables to data elements read from Address.csv --  
 //  NOTE: Address.csv must be modified to refelct the address you want to validate.
 //
    list( $line1, $line2, $line3, $city, $region, $region, $postalcode ) = explode(',', str_replace('"', '', $line));

//address varibles are assigned to address objects
try
{
	$address = new Address();
	$address->setLine1($line1);
	$address->setLine2($line2);
        $address->setLine3($line3);
	$address->setCity($city);
	$address->setRegion($region);
	$address->setPostalCode($postalcode);

// Choose Default, Upper, or Mixed Case
	$textCase = TextCase::$Mixed;
// Coordinates = 1 will return latitude and longitude in the results.
	$coordinates = 1;

// Build Address object into an array
        
	$request = new ValidateRequest($address, ($textCase ? $textCase : TextCase::$Default), $coordinates);
	$result = $client->Validate($request);
        
// Output to console the result (Success or Not Success)
// If not Success return Error Message results
// If Success - retune Normalized address
// If corrdinates = 1 return latitude and longitude
	echo "\n".'Validate ResultCode is: '. $result->getResultCode()."\n";
	if($result->getResultCode() != SeverityLevel::$Success)
	{
		foreach($result->getMessages() as $msg)
		{
			echo $msg->getName().": ".$msg->getSummary()."\n";
		}
	}
	else
	{
		echo "Normalized Address:\n";
	   	foreach($result->getvalidAddresses() as $valid)
    		{
        		echo "Line 1: ".$valid->getline1()."\n";
		        echo "Line 2: ".$valid->getline2()."\n";
		        echo "Line 3: ".$valid->getline3()."\n";
		        echo "Line 4: ".$valid->getline4()."\n";
		        echo "City: ".$valid->getcity()."\n";
		        echo "Region: ".$valid->getregion()."\n";
		        echo "Postal Code: ".$valid->getpostalCode()."\n";
		        echo "Country: ".$valid->getcountry()."\n";
		        echo "County: ".$valid->getcounty()."\n";
		        echo "FIPS Code: ".$valid->getfipsCode()."\n";
		        echo "PostNet: ".$valid->getpostNet()."\n";
		        echo "Carrier Route: ".$valid->getcarrierRoute()."\n";
		        echo "Address Type: ".$valid->getaddressType()."\n";
		        if($coordinates == 1)
		        {
		             echo "Latitude: ".$valid->getlatitude()."\n";
		             echo "Longitude: ".$valid->getlongitude()."\n";
		        }
		    }
	}
    
}


catch(SoapFault $exception)
{
	$msg = "Exception: ";
	if($exception)
		$msg .= $exception->faultstring;

// If you desire to retrieve SOAP IN / OUT XML
//  - Follow directions below
//  - if not, leave as is
//    }   //UN-comment this line to return SOAP XML
        echo $msg . "\n";
        echo $client->__getLastRequest() . "\n";
        echo $client->__getLastResponse() . "\n";
}   //Comment this line to return SOAP XML
}
?>
