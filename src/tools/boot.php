<?php
require( dirname(__FILE__).'/../lib/HackapiTools.php');
$otools= new HackapiTools();

$device='';
isset($argv[1]) and $device =$argv[1];

if(!$device){
	$prefix="\n   - ";
	echo "USAGE: {$argv[0]} <DEVICE>\n";
	echo " <DEVICE> is one of:";
	echo $prefix;
	echo implode($prefix,$otools->ListDevices())."\n\n";
	exit(1);
}

//set the device
if(!$otools->SetDevice($device)){
	$otools->PrintError("The $device folder does not contains the 'main.php' file!");
	exit(1);
}

?>