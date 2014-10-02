<?php
require('vendor/autoload.php');
use AvaTax\ATConfig;
/* Authentication Credentials
 * 
 * Development Account
 * TODO: Modify the account and license key 
 *       values below with your own.
 * 
 * Note: The ATConfig object is how Authentication credentials are set. 
 */
new ATConfig('Development', array(
    'url'       => 'https://development.avalara.net',
    'account'   => '1100000000',
    'license'   => '1A2B3C4D5E6F7G8H',
    'trace'     => true, // change to false for production
    'client' => 'AvaTaxSample',
	'name' => '14.4')
);

/* Production Account
 * TODO: Modify the account and license key 
 *       values below with your own.
 */
new ATConfig('Production', array(
    'url'       => 'https://avatax.avalara.net',
    'account'   => '<Your Production Account Here>',
    'license'   => '<Your Production License Key Here>',
    'trace'     => false, // change to false for development
	'client' => 'AvaTaxSample',
	'name' => '14.4')
);
