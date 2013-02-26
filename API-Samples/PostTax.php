<?php

require('../AvaTax4PHP/AvaTax.php');            // location of the AvaTax.PHP Classes - Required
require('../Security/Credentials.php');        // where service URL, account, license key are set

$client = new TaxServiceSoap('Development');
$request = new PostTaxRequest();

$file = fopen('..\Invoice-Samples\Post.csv', 'r');   //uses sample input document
while ($line = fgets($file)) {                      //Reads a line from the input document
   
 //Assigns variables to data elements read from Post.csv --  
 //  NOTE: Post.csv must be modified to refelct the document you plan to Post.
 //  NOTE: You can also Commit the document from this PostTax by setting Commit to (TRUE)
 //
    list( $CompanyCode, $DocType, $DocCode, $DocDate, $TotalAmount, $TotalTax, $Commit ) = explode(',', str_replace('"', '', $line));

// Locate Document by Invoice Number
    $request->setCompanyCode($CompanyCode);     // Company Code from the Admin Console
    $request->setDocType($DocType);            // DocumentType (SalesInvoice, ReturnInvoice, PurchaseInvoice) 
    $request->setDocCode($DocCode);           // Document Code (Invoice Number) 
    $request->setDocDate($DocDate);          // Document Date as shown on the Admin Console 
    $request->setTotalAmount($TotalAmount); // Total Amount from the Document 
    $request->setTotalTax($TotalTax);      // Total Tax from the Document 
    $request->setCommit(FALSE);           // If set to TRUE, the document will be Committed 

// PostTax and Results
    try {
        $result = $client->postTax($request);
        echo 'PostTax ResultCode is: ' . $result->getResultCode() . "\n";

// Success - Display GetTaxResults to console
            
        if ($result->getResultCode() != SeverityLevel::$Success) {
            foreach ($result->getMessages() as $msg) {
                echo $msg->getName() . ": " . $msg->getSummary() . "\n";
            }
        }

// If NOT success - display error or warning messages to console
// it is important to itterate through the entire message class   
    } catch (SoapFault $exception) {
        $msg = "Exception: ";
        if ($exception)
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
