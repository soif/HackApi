#!/usr/bin/php
<?php

// grab $device from the command line --------------------------
require( dirname(__FILE__).'/boot.php');

// choose the method to Launch
$method_name='';

//or set it as second argument from the command line
if(!$method_name){
	if(isset($argv[2])){
		$method_name = $argv[2];
		$parameters=array();
		if(isset($argv[3])){
			$parameters=$argv;
			// remove arg 0, 1, 2
			array_shift($parameters);
			array_shift($parameters);
			array_shift($parameters);
		}
	}
	else{
		$otools->printError("I need a method_name as second argument (or set in this file)! ");

		$methods=$otools->ListApiMethods('');
	
		$otools->printTitle("Possible API Standardised methods:");
		echo "  - ".@implode("\n  - ",$methods['standard'] )."\n";

		$otools->printTitle("Possible API 'set' methods:");
		echo "  - ".@implode("\n  - ",$methods['set'] )."\n";
	
		$otools->printTitle("Possible API 'get' methods:");
		echo "  - ".@implode("\n  - ",$methods['get'] )."\n";
		
		echo "\n";
	
		exit(1);
	}
}


// now make stuff #########################################################################################################################
// to see the whole (CURL) calls, Set ShowErrors level, by uncommenting the next line:
//$otools->ShowErrors(1); // 0=no Debug, 1=debug only those who return false, 2=those with API Errors, 3=All calls
//$otools->ShowErrors(0);

//$otools->ShowDebug(4);

$otools->TestCallApi($method_name,$parameters);

exit(0);
?>