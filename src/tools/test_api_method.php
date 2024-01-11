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
// to see the whole (CURL) calls, Set ShowDebug level, by uncommenting the next line:
/* Debug Levels are
	'1'	=> show only error
	'2'	=> also shows info
	'3'	=> also shows debug
	'4'	=> also shows verbose (ie with CURL calls)
 */

//$otools->ShowDebug(4);

$otools->TestCallApi($method_name,$parameters);

exit(0);
?>