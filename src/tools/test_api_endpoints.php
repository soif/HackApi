#!/usr/bin/php
<?php

// grab $device from the command line --------------------------
require( dirname(__FILE__).'/boot.php');

// First test if we can Login -----------------------------------
// This is NOT mandatory, as each Api call should first automatically Login 
// but we make sure credentials are valid before risking to be blocked when making many unauthorized API calls

// If you're not already using the the default.php file to set your credential or to ovveride it, Uncomment the following line
// $otools->SetHostCredentials('<IP_ADDRESS'>,'<USE_SSL(true|false)'>','<USER_NAME>','<PASSWORD>');

// to hide the password, set the folowing to TRUE
$hide_pass=false;

if(!$otools->TestLogin($hide_pass) ){
	exit(1);
}


// now make stuff #########################################################################################################################
// to see the whole (CURL) calls, Set ShowErrors level, by uncommenting the next line:
$otools->ShowErrors(1); // 0=no Debug, 1=debug only those who return false, 2=those with API Errors, 3=All calls

// if single_mode is true, Each ApiCall will re Login into a new session (usefull to make sure each Api Endpoint can be call individually)
$single_mode=false;

// to test only SOME endpoints, fill the following Array with endpoints (they must already exist in the template)
$only_endpoints=array();

// let's run baby !
$otools->TestCallAllApiEndpoints($single_mode, $only_endpoints);

exit(0);
?>