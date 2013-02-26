<?php

// The ATConfig object uses this place for setting "credentials" 
// for web service authentication. TaxSvc, AddressSvc, and AccountSvc 
// Objects make use of this class to set Account and License key.
// ATConfig object pulls the "Credentials" based on which array is called
// from the API class (for example GetTaxRequest 


/* Development Configuraton. 
 * Only values different from 'Default' need to be specified.
 * Example:
 *
 * $service = new AddressServiceSoap('Development');
 * $service = new TaxServiceSoap('Development');
 */
new ATConfig('Development', array(
    'url' => 'https://development.avalara.net', //URL to the Development - AvaTax Web Service
            'account' => '1100000000',         //Enter your Development Account number here
            'license' => '1A2B3C4D5E6F7G8',   //Enter your Development License Key Here
    'trace'     => TRUE)                     // change to false for production
    
);

/* Production Configuration. 
 * Example:
 *
 * $service = new AddressServiceSoap('Production');
 * $service = new TaxServiceSoap('Production');
 */
new ATConfig('Production', array(
    'url' => 'https://avatax.avalara.net',    //URL to the Production - AvaTax Web Service
          'account' => '1100000000',         //Enter your Production Account number here
          'license' => '1A2B3C4D5E6F7G8',   //Enter your Production License Key Here
    'trace'     => FALSE)                  // change to false for production
);


?>
