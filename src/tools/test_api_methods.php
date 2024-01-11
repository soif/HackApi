#!/usr/bin/php
<?php

// grab $device from the command line --------------------------
require( dirname(__FILE__).'/boot.php');

// ask for at least argument 2: state ------------------------
if(isset($argv[2])){
	$only_state=$argv[2];
}
else{
	echo "\nPlease choose a state (or 0 for all) to filter methods, as third argument among:\n";
	$otools->ReportCountMethodsDefinitionsBy('get','state');
	echo "\n";
	exit(1);
}

if(isset($argv[3])){	
	$only_methods=@eval("return {$argv[3]} ;");
}


// First test if we can Login ##########################################################################################################
// This is NOT mandatory, as each Api call should first automatically Login 
// but we make sure credentials are valid before risking to be blocked when making many unauthored API calls

// If you're not already using the the default.php file to set your credential or to ovveride it, Uncomment the following line
// $otools->SetHostCredentials('<IP_ADDRESS'>,'<USE_SSL(true|false)'>','<USER_NAME>','<PASSWORD>');

// to hide the password, set the folowing to TRUE
$hide_pass=false;

if(!$otools->TestLogin($hide_pass) ){
	exit(1);
}


// now make stuff #########################################################################################################################
// to see the whole (CURL) calls, Set ShowDebug level, by uncommenting the next line:
/* Debug Levels are
	'1'	=> show only error
	'2'	=> also shows info
	'3'	=> also shows debug
	'4'	=> also shows verbose (ie with CURL calls)
 */
//$otools->ShowDebug(4);


// if single_mode is true, Each ApiCall will re Login into a new session (usefull to make sure each Api Endpoint can be call individually)
$single_mode=false;

// to test only SOME methods, fill the following Array with methods (they must already exist in the device class or its trait.php)
$only_methods=array();

$otools->TestCallAllApiGet($single_mode ,$only_methods, $only_state);

exit(0);
?>