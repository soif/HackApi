<?php

// 'definitions' ##############################################################################
/*
	'definitions' : 
		is an array of definition's arrays.
		Each definition array end up to allow to build a method like below, using each 'colums' of the array:
		
		public function Api<TYPE>EndPointUrl(<Argument(s) built from PARAMS>...){
			$params=<PARAMS>;
			return $this-><calls.METHOD_INDEX>('<ENDPOINT>'
, $params);
		}

	'definitions'is an array of array, where each column is:
		ENDPOINT		: (string | array) 	- endpoint(s) (ie: relative url) to pass to the called method,
		STATE			: (string) 			- current delelopment state:
													1 	=> 'NOT TESTED',
													2 	=> 'ERROR (Return an error)',
													3 	=> 'UNDER DEV',
													4 	=> 'TESTED (paramaters still not correctly ordered, and/or no description)',
													5 	=> 'FINAL  (fully tested, with paramaters correctly ordered,description set)',
		TYPE			: ('get','set') 	- Prefix of the generated method name

													'get' for "read-only" methods, 
													'set' for methods that "write" or perform an action
		METHOD_INDEX	: (string) 			- (your own) index name pointing to the method to call (see $p.calls bellow)
		PARAMS			: (array) 			- Method arguments as 'key_name' => 'default value'. ("!" means REQUIRED)
		DESCRIPTION		: (string)			- Description shown in the phpDoc method's description

*/

// [ ENDPOINT,						STATE,	TYPE,	METHOD_I, 		PARAMS,	DESCRIPTION ]
$p['definitions']=array(

	['auth.getToken',				'5',	'get',	'get',		'',		'Authentication Token'],
	['auth.checkToken',				'3',	'get',	'get',		'',		'Activate the Authentication Token Session (aka Login)'],

	['backup3g.forceDataLink',		'1',	'set',	'set',		['mode'=>['!',['on'=>'Force Cell','off'=>'No Cell','auto'=>'Auto select']]],		'Set (backup) Cellullar Mode'],
	['backup3g.forceVoipLink',		'1',	'set',	'set',		['mode'=>['!',['on'=>'Allow Cell','off'=>'Disallow Cell']]],		'Set (backup) Cellullar policy for VOIP'],
	['backup3g.getPinCode',			'2',	'get',	'get',		'',						'Get Cellular PIN code'],
	['backup3g.setPinCode',			'1',	'set',	'set',		['pincode'=>''],		'Set Cellular PIN code'],

	['ddns.getInfo',				'5',	'get',	'get',		'',		'DynDNS information'],
	['ddns.disable',				'5',	'set',	'set',		'',		'Disable DynDNS service'],
	['ddns.enable',					'5',	'set',	'set',		'',		'Enable DynDNS service'],
	['ddns.forceUpdate',			'3',	'set',	'set',		'',		'Force DynDNS update'],
	['ddns.setService',				'1',	'set',	'set',		[['service','!',['dyndns','no-ip','ovh','dyndnsit','changeip','sitelutions']],'username','password','hostname'],'Set DynDns Account'],

	['dsl.getInfo',					'5',	'get',	'get',		'',		'DSL Information'],

	['ftth.getInfo',				'5',	'get',	'get',		'',		'FiberToTheHome Information '],

	['firewall.getInfo',			'5',	'get',	'get',		'',		'Firewall Information'],
//	['firewall.enableSmtpFilter',	'2',	'set',	'set',		'',		'Enable SMTP filtering'],	// method dont exists
//	['firewall.disableSmtpFilter',	'2',	'set',	'set',		'',		'Disable SMTP filtering'],	// method dont exists

	['hotspot.getInfo',				'4',	'get',	'get',		'',		'Wifi Information'],
	['hotspot.getClientList',		'3',	'get',	'getlist',	'',		'List Wifi Clients'],
	['hotspot.enable',				'3',	'set',	'set',		'',		'Enable Wifi'],
	['hotspot.disable',				'3',	'set',	'set',		'',		'Disable Wifi'],
//	['hotspot.setMode',				'1',	'set',	'set',		'',		'Set Wifi mode'],	// method dont exists
	['hotspot.restart',				'3',	'set',	'set',		'',		'Restart Wifi'],
	['hotspot.start',				'3',	'set',	'set',		'',		'Start Wifi'],
	['hotspot.stop',				'3',	'set',	'set',		'',		'Stop Wifi'],

	['lan.getInfo',					'5',	'get',	'get',		'',		'LAN Information'],
	['lan.getDnsHostList',			'5',	'get',	'getlist',	'',		'List DNS host entries'],
	['lan.getHostsList',			'5',	'get',	'getlist',	'',		'List connected hosts'],
	['lan.addDnsHost',				'5',	'set',	'set',		['ip'=>'!','name'=>'!'],		'Add DNS host entry'],
	['lan.deleteDnsHost',			'5',	'set',	'set',		['ip'=>'!','name'=>'!'],		'Delete DNS host entry'],


	['ont.getInfo',					'4',	'get',	'get',		'',		'ONT Information'],
	['p910nd.getInfo',				'4',	'get',	'get',		'',		' Information'],
	['ppp.getInfo',					'4',	'get',	'get',		'',		'PPP Information'],
	['smb.getInfo',					'4',	'get',	'get',		'',		'SMB Sharing Information'],
	['tv.getInfo',					'4',	'get',	'get',		'',		'TV Information'],
	['usb.getInfo',					'4',	'get',	'get',		'',		'USB Information'],
	['voip.getInfo',				'4',	'get',	'get',		'',		'VOIP (phone) Information'],
	['voip.getCallhistoryList',		'2',	'get',	'getlist',	'',		'VOIP (phone) Call History'],
	['wan.getInfo',					'4',	'get',	'get',		'',		'WAN Information'],
	['wlan.getClientList',			'4',	'get',	'getlist',	'',		'Wifi (2.4GHz) Client List'],
	['wlan.getInfo',				'4',	'get',	'get',		'',		'Wifi (2.4GHz) Information'],
	['wlan.getScanList',			'4',	'get',	'getlist',	'',		'Wifi (2.4GHz) Scan List'],
	['wlan5.getClientList',			'4',	'get',	'getlist',	'',		'Wifi (5GHz) Client List'],
	['wlan5.getInfo',				'4',	'get',	'get',		'',		'Wifi (5GHz) Information'],

);
/*

ont.getInfo 
ont.sync
ont.push
ont.pull

p910nd.getInfo

ppp.getCredentials 
ppp.getInfo
ppp.setCredentials 

smb.getInfo

system.getInfo 
system.getIfList
system.getWpaKey
system.reboot
system.setNetMode
system.setRefClient 

tv.getInfo
usb.getInfo 

voip.getCallhistoryList
voip.getInfo
voip.restart 
voip.start 
voip.stop 

wan.getInfo
wlan.enable
wlan.disable 
wlan.getClientList 
wlan.getInfo 
wlan.getScanList
wlan.setChannel 
wlan.setWl0Enc 
wlan.setWl0Enctype 
wlan.setWl0Keytype 
wlan.setWl0Ssid 
wlan.setWl0Wepkey
wlan.setWl0Wpakey
wlan.setWlanMode
wlan.start
wlan.stop
wlan.restart

wlan5.getClientList
wlan5.getInfo
wlan5.setChannel
wlan5.setWl0Enc
wlan5.setWl0Enctype 
wlan5.setWl0Keytype 
wlan5.setWl0Ssid 
wlan5.setWl0Wepkey 
wlan5.setWl0Wpakey 
wlan5.setWlanMode 

guest.getInfo 
guest.enable
guest.disable 
guest.setSsid 
guest.setWpakey 


*/


// 'calls' #################################################################################################
// List all 'METHOD_I' defined above to point to the Method name
// METHOD_INDEX => [METHOD_CALLED]
$p['calls']=array(
	'get'		=> ['MyCallApiGet'],
	'getlist'	=> ['MyCallApiGetList'],
	'set'		=> ['MyCallApiPost'],
);


// 'regex' #####################################################################################################
// (to override the default regex formula)
// a preg_replace type formula to define how to build the method name
// 				[	FIND, 					, REPLACE	]
$p['regex']	=['#/[^/]+/([^/]+)/([^\\.]+)#',	'$1_$2'];


// 'template' #################################################################################################
// (to override the default template)
// the template used to build the full method
//$p['template']='';



// ********************************************************************************************************
// DOCUMENTATION
// ********************************************************************************************************

// 'information' #################################################################################################
// describe the brand, products family, and product name (ONLY if this client is specific to a particular model)
$p['information']=array(
	'brand'		=>'SFR',
	'family'	=>'box',
//	'name'	=>'',
);

// 'readme' #################################################################################################
// (Markdown syntax)
$p['readme']=<<<EOF
This API client works for SFR boxes.
It should work on all Boxes < v8

EOF;


// 'tests' #################################################################################################

/*
Used to document the list of devices supported by this current API Client
*/
// [ MODEL, 	SOWFTARE_VERSION,	DATE,			 @NickName|Full_Name, 	URL|email,					COMMENT ]
$p['tests']=array(
	['NB6VAC',	'NB6VAC-MAIN-R4.0.45d',			'2023-12-13',	'@soif',				'https://github.com/soif/', 'Most ApiGet methods have been tested']
);

?>