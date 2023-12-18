#!/usr/bin/php
<?php

// grab $device from the command line --------------------------
require( dirname(__FILE__).'/boot.php');


// now make stuff #########################################################

$mode=2;
// $mode: can be:
//	- 0	-> just return the output
//	- 1 -> print to screen 
//	- 2 -> save 'trait.php' file 
//	- 3 -> save 'trait.php' file and print to screen 
$otools->BuildMethods($mode);
$otools->BuildReadme($mode);

echo "\n";
exit(0);
?>