<?php

// 'definitions' ##############################################################################
/*
	'definitions' : 
		is an array of definition's arrays.
		Each definition array end up to allow to build a method like below, using each 'colums' of the array:
		
		public function Api<TYPE>EndPointUrl(<Argument(s) built from PARAMS>...){
			$params=<PARAMS>;
			return $this-><calls.METHOD_INDEX>('<ENDPOINT>'... , $params);
		}

	'definitions'is an array of array, where each column is:
		ENDPOINT		: (string | array) 	- endpoint(s) (ie: relative url) to pass to the called method,
		STATE			: (string) 			- current delelopment state:
													1 	=> 'NOT TESTED',
													2 	=> 'ERROR (Returns an error)',
													3 	=> 'UNDER DEV',
													4 	=> 'TESTED (paramaters still not correctly ordered/described, and/or no description)',
													5 	=> 'FINAL  (fully tested, with paramaters correctly set, description set)',
		TYPE			: ('get','set') 	- Prefix of the generated method name. 
													'get' for "read-only" methods, 
													'set' for methods that "write" or perform an action
		METHOD_INDEX	: (string) 			- (your own) index name pointing to the method to call (see $p.calls bellow)
		PARAMS			: (array) 			- Method arguments as 'key_name' => 'default value'. (see all formats in the _MakeParams method from the HackapiTools class)
		DESCRIPTION		: (string)			- Description shown in the phpDoc method's description & readme
*/

// [ ENDPOINT,						STATE,	TYPE,	METHOD_I, 		PARAMS,	DESCRIPTION ]
$p['definitions']=array(

	['auth.getToken',				'5',	'get',	'get',		'',		'Authentication Token'],
	['auth.checkToken',				'5',	'get',	'get',		'',		'Activate the Authentication Token Session (aka Login)'],

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

	['firewall.getInfo',			'5',	'get',	'get',		'',		'Firewall Information'],
//	['firewall.enableSmtpFilter',	'2',	'set',	'set',		'',		'Enable SMTP filtering'],	// method dont exists
//	['firewall.disableSmtpFilter',	'2',	'set',	'set',		'',		'Disable SMTP filtering'],	// method dont exists

	['ftth.getInfo',				'5',	'get',	'get',		'',		'FiberToTheHome Information '],

	['guest.getInfo',				'5',	'get',	'get',		'',		'Wifi (2.4GHz) Guests Information'],
	['guest.getClientList',			'5',	'get',	'getlist',	'',		'List Guests Wifi (2.4GHz) Clients'],	//undocumented , but seems to work ???
	['guest.enable',				'5',	'set',	'set',		'',		'Enable Guests Wifi (2.4GHz)'],
	['guest.disable',				'5',	'set',	'set',		'',		'Disable Guests Wifi (2.4GHz)'],
	['guest.setSsid',				'1',	'set',	'set',		['ssid'=>['!','ssid to set']],		'Set Guest SSID'],
	['guest.setWpakey',				'1',	'set',	'set',		['wpakey'=>['!','WPA Key to set']],		'Set Guest WPA Key'],

	['hotspot.getInfo',				'3',	'get',	'get',		'',		'Hotspot Information'],
	['hotspot.getClientList',		'3',	'get',	'getlist',	'',		'List Hotspot Clients'],
//	['hotspot.enable',				'3',	'set',	'set',		'',		'Enable Hotspot'],
//	['hotspot.disable',				'3',	'set',	'set',		'',		'Disable Hotspot'],
//	['hotspot.setMode',				'1',	'set',	'set',		'',		'Set Hotspot mode'],	// method dont exists
//	['hotspot.restart',				'3',	'set',	'set',		'',		'Restart Hotspot'],
//	['hotspot.start',				'3',	'set',	'set',		'',		'Start Hotspot'],
//	['hotspot.stop',				'3',	'set',	'set',		'',		'Stop Hotspot'],

	['lan.getInfo',					'5',	'get',	'get',		'',		'LAN Information'],
	['lan.getDnsHostList',			'5',	'get',	'getlist',	'',		'List DNS host entries'],
	['lan.getHostsList',			'5',	'get',	'getlist',	'',		'List connected hosts'],
	['lan.addDnsHost',				'5',	'set',	'set',		['ip'=>'!','name'=>'!'],		'Add DNS host entry'],
	['lan.deleteDnsHost',			'5',	'set',	'set',		['ip'=>'!','name'=>'!'],		'Delete DNS host entry'],

	['ont.getInfo',					'5',	'get',	'get',		'',		'ONT Information'],
	['ont.sync',					'1',	'set',	'set',		'',		'Synchronize ONT Information with Box'],
	['ont.push',					'1',	'set',	'set',		[
																	'name'	=>['slid',['slid'=>'identifier'],'parameter to change'],
																	'value'	=>['!','value to set'],
																	'force'	=>'Forces change',
																],		'Change ONT parameters'],
	['ont.pull',					'4',	'get',	'get',		'',		'Get exec status about the latest push. (See API doc for returned codes)'],

	['p910nd.getInfo',				'5',	'get',	'get',		'',		'Information'],

	['ppp.getInfo',					'5',	'get',	'get',		'',		'PPP Information'],
	['ppp.getCredentials',			'5',	'get',	'get',		'',		'PPP Credentials'],
	['ppp.setCredentials',			'1',	'set',	'set',		[
																'login'		=>['','Login'],
																'password'	=>['','Password']
																],		'Set PPP Credentials'],
	
	['smb.getInfo',					'4',	'get',	'get',		'',		'SMB Sharing Information'],

	['system.getInfo',				'5',	'get',	'get',		'',		'System Information'],
	['system.getIfList',			'2',	'get',	'getfix',	'',		'System Interface List'], // sometimes works
	['system.getWpaKey',			'5',	'get',	'get',		'',		'Default Wpa Key'],
	['system.reboot',				'5',	'set',	'set',		'',		'Reboot'],
	['system.setNetMode',			'1',	'set',	'set',		['mode'	=>['!',['router','bridge'],'Routing Mode']],		'Set Box Routing Mode'],
	['system.setRefClient',			'1',	'set',	'set',		['refclient'=>['!','Client Reference']],		'Set Client Reference'],
	
	['tv.getInfo',					'4',	'get',	'get',		'',		'TV Information'],

	['usb.getInfo',					'4',	'get',	'get',		'',		'USB Information'],

	['voip.getInfo',				'4',	'get',	'get',		'',		'VOIP (phone) Information'],
	['voip.getCallhistoryList',		'2',	'get',	'getlist',	'',		'VOIP (phone) Call History'],
	['voip.restart',				'1',	'set',	'set',	'',			'Restart VOIP Service'],
	['voip.start',					'1',	'set',	'set',	'',			'Start VOIP Service'],
	['voip.stop',					'1',	'set',	'set',	'',			'Stop VOIP Service'],
	
	['wan.getInfo',					'5',	'get',	'get',		'',		'WAN Information'],

	['wlan.getInfo',				'5',	'get',	'get',		'',		'Wifi (2.4GHz) Information'],
	['wlan.getClientList',			'5',	'get',	'getlist',	'',		'Wifi (2.4GHz) Client List'],
	['wlan.getScanList',			'5',	'get',	'getlist',	'',		'List of neighbour ssid found (both 2.4GHz and 5Ghz)'],
	['wlan.enable',					'5',	'set',	'set',	'',			'Enable Wifi (2.4GHz)'],
	['wlan.disable',				'5',	'set',	'set',	'',			'Disable Wifi (2.4GHz)'],
//	['wlan.start',					'3',	'set',	'set',	'',			'Wifi (2.4GHz) Start What???'],
//	['wlan.stop',					'3',	'set',	'set',	'',			'Wifi (2.4GHz) Stop What???'],
//	['wlan.restart',				'3',	'set',	'set',	'',			'Wifi (2.4GHz) Restart What???'],
	['wlan.setChannel',				'1',	'set',	'set',		['channel'	=>['!','Channel (1 to 13)']],		'Set Wifi (2.4GHz) channel'],
	['wlan.setWl0Enc',				'1',	'set',	'set',		['enc'		=>['!',['OPEN','WEP','WPA-PSK','WPA2-PSK','WPA-WPA2-PSK']]],		'Set Wifi (2.4GHz) Security Type'],
	['wlan.setWl0Enctype',			'1',	'set',	'set',		['enctype'	=>['!',['tkip','aes','tkipaes']]],	'Set Wifi (2.4GHz) Encryption Type'],
	['wlan.setWl0Keytype',			'1',	'set',	'set',		['keytype'	=>['!',['ascii','hexa']]],			'Set Wifi (2.4GHz) Key Type'],
	['wlan.setWl0Ssid',				'1',	'set',	'set',		['ssid'		=>['!','SSID name']],				'Set Wifi (2.4GHz) SSID'],
	['wlan.setWl0Wepkey',			'1',	'set',	'set',		['wepkey'	=>['!','Wep Key']],					'Set Wifi (2.4GHz) WEP Key'],
	['wlan.setWl0Wpakey',			'1',	'set',	'set',		['wpakey'	=>['!','Wpa Key']],					'Set Wifi (2.4GHz) WPA Key'],
	['wlan.setWlanMode',			'1',	'set',	'set',		['mode'	=>['!',['11n','11ng','11g','11b','auto']]],		'Set Wifi (2.4GHz) Radio Mode. For NB5/NB6: (11n|11ng|11g). For NB4/CIBOX: (11b|11g|auto)'],

	['wlan5.getInfo',				'5',	'get',	'get',		'',		'Wifi (5GHz) Information'],
	['wlan5.getClientList',			'5',	'get',	'getlist',	'',		'Wifi (5Hz) Client List'],
//	['wlan5.enable',				'5',	'set',	'set',	'',			'Enable Wifi (5GHz)'], 		// method dont exists, so how we do it ?
//	['wlan5.disable',				'5',	'set',	'set',	'',			'Disable Wifi (5GHz)'], 	// method dont exists, so how we do it ?
	['wlan5.setChannel',			'1',	'set',	'set',		['channel'	=>['!','Channel (auto|36|40|44|48|52|56|60|64|100|104|108|112|116|132|136|140)']],		'Set Wifi (5GHz) channel'],
	['wlan5.setWl0Enc',				'1',	'set',	'set',		['enc'		=>['!',['OPEN','WPA-PSK','WPA2-PSK','WPA-WPA2-PSK']]],		'Set Wifi (5GHz) Security Type'],
	['wlan5.setWl0Enctype',			'1',	'set',	'set',		['enctype'	=>['!',['tkip','aes','tkipaes']]],	'Set Wifi (5Hz) Encryption Type'],
	['wlan5.setWl0Keytype',			'1',	'set',	'set',		['keytype'	=>['!',['ascii','hexa']]],			'Set Wifi (5GHz) Key Type'],
	['wlan5.setWl0Ssid',			'1',	'set',	'set',		['ssid'		=>['!','SSID name']],				'Set Wifi (5GHz) SSID'],
	['wlan5.setWl0Wepkey',			'1',	'set',	'set',		['wepkey'	=>['!','Wep Key']],					'Set Wifi (5GHz) WEP Key'],
	['wlan5.setWl0Wpakey',			'1',	'set',	'set',		['wpakey'	=>['!','Wpa Key']],					'Set Wifi (5GHz) WPA Key'],
	['wlan5.setWlanMode',			'1',	'set',	'set',		['mode'	=>['!',['11n','11ac','auto']]],		'Set Wifi (5GHz) Radio Mode. For NB5/NB6: (11n|11ng|11g). For NB4/CIBOX: (11b|11g|auto)'],

);


// 'calls' #################################################################################################
// List all 'METHOD_I' defined above to point to the Method name
// METHOD_INDEX => [METHOD_CALLED]
$p['calls']=array(
	'get'		=> ['CallApiGet'],
	'getlist'	=> ['CallApiGetList'],
	'getfix'	=> ['CallApiGetFix'],
	'set'		=> ['CallApiPost'],
);


// 'regex' #####################################################################################################
// (to override the default regex formula)
// a preg_replace type formula to define how to build the method name
// 				[	FIND, 					, REPLACE	]
//$p['regex']	=['#/[^/]+/([^/]+)/([^\\.]+)#',	'$1_$2'];


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
This API client works for SFR (or Red-by-SFR) boxes. *SFR is a popular french Internet Service Provider.*
It should work on all Boxes < v8

EOF;


// 'tests' #################################################################################################

/*
Used to document the list of devices supported by this current API Client
*/
// [ MODEL, 	SOWFTARE_VERSION,			DATE,			 @NickName|Full_Name, 	URL|email,					COMMENT ]
$p['tests']=array(
	['NB6VAC',	'NB6VAC-MAIN-R4.0.45d',		'2023-12-20',	'@soif',				'https://github.com/soif/', 'Most methods have been tested'],
);

?>