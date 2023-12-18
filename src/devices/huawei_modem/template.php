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
													2 	=> 'ERROR (Return an error)',
													3 	=> 'UNDER DEV',
													4 	=> 'TESTED (paramaters still not correctly ordered, and/or no description)',
													5 	=> 'FINAL  (fully tested, with paramaters correctly ordered,description set)',
		TYPE			: ('get','set') 	- Prefix of the generated method name. 
													'get' for "read-only" methods, 
													'set' for methods that "write" or perform an action
		METHOD_INDEX	: (string) 			- (your own) index name pointing to the method to call (see $p.calls bellow)
		PARAMS			: (array) 			- Method arguments as 'key_name' => 'default value'.
		DESCRIPTION		: (string)			- Description shown in the phpDoc method's description

*/

// [ ENDPOINT,										STATE,	TYPE,	METHOD_I, 		PARAMS,	DESCRIPTION ]
$p['definitions']=array(


	['/api/app/privacypolicy',					'5',	'get',	'json',		'',		'Privacy Policy'],

	['/api/cradle/basic-info',					'4',	'get',	'xml',		'',		'WAN Network Information'],
	['/api/cradle/factory-mac',					'5',	'get',	'xml',		'',		'Hardware MAC Address'],
	['/api/cradle/feature-switch',				'2',	'get',	'json',		'',		''],
	['/api/cradle/mac-info',					'5',	'get',	'xml',		'',		'MAC Adresses'],
	['/api/cradle/status-info',					'4',	'get',	'xml',		'',		'WAN Network Information 2'],

	['/api/ddns/ddns-list',						'4',	'get',	'xml',		'',		'DynDNS Information'],
	['/api/ddns/serverlist',					'4',	'get',	'xml',		'',		'DynDNS Servers'],
	['/api/ddns/status',						'4',	'get',	'xml',		'',		'DynDNS Status'],

	['/api/device/antenna_type',				'5',	'get',	'xml',		'',		'Antennas Types'],
	['/api/device/basic_information',			'5',	'get',	'xml',		'',		'Device (Basic) Information'],
	['/api/device/device-feature-switch',		'5',	'get',	'xml',		'',		'Device Features'],
	['/api/device/information',					'5',	'get',	'xml',		'',		'Device (Full) Information'],
	['/api/device/signal',						'5',	'get',	'xml',		'',		'Cellular Signal Information'],
	['/api/device/usb-tethering-switch',		'2',	'get',	'json',		'',		''],
	['/api/device/vendorname',					'2',	'get',	'xml',		'',		''],

	['/api/dhcp/feature-switch',				'5',	'get',	'xml',		'',		'DHCP Features'],
	['/api/dhcp/settings',						'5',	'get',	'xml',		'',		'DHCP Settings'],
	['/api/dhcp/static-addr-info',				'4',	'get',	'xml',		'',		'DHCP (Static?) Leases'],

	['/api/diagnosis/get-wan-service-name',		'5',	'get',	'xml',		'',		'WAN Service Name'],
	['/api/diagnosis/time_reboot',				'4',	'get',	'xml',		'',		'WatchDog ?'],

	['/api/dialup/connection',					'5',	'get',	'xml',		'',		'Dialup Connection Information'],
	['/api/dialup/dialup-feature-switch',		'5',	'get',	'xml',		'',		'Dialup Features'],
	['/api/dialup/mobile-dataswitch',			'4',	'get',	'xml',		'',		'Cellular Data Switch ?'],
	['/api/dialup/multiWanProfiles',			'2',	'get',	'xml',		'',		''],
	['/api/dialup/profiles',					'5',	'get',	'xml',		'',		'Cellular Connection Profiles'],

	['/api/global/module-switch',				'4',	'get',	'xml',		'',		'Global Modules Switches ?'],

	['/api/led/appctrlled',						'4',	'get',	'xml',		'',		'Leds Information ?'],

	['/api/log/loginfo',						'5',	'get',	'xml',		'',		'Logs'],

	['/api/monitoring/check-notifications',		'5',	'get',	'xml',		'',		'Notifications'],
	['/api/monitoring/converged-status',		'5',	'get',	'xml',		'',		'SIM states & current language'],
	['/api/monitoring/daily-data-limit',		'2',	'get',	'xml',		'',		''],
	['/api/monitoring/month_statistics',		'5',	'get',	'xml',		'',		'Month Statistics'],
	['/api/monitoring/start_date',				'4',	'get',	'xml',		'',		'Start Date ?'],
	['/api/monitoring/statistic-feature-switch','5',	'get',	'xml',		'',		'Statistic Features'],
	['/api/monitoring/status',					'5',	'get',	'xml',		'',		'Gerenal (Wan,Wifi,Cellular) Information'],
	['/api/monitoring/traffic-statistics',		'5',	'get',	'xml',		'',		'Traffic Statistics'],

	['/api/net/cell-info',						'5',	'get',	'xml',		'',		'Cellular Cell Information'],
	['/api/net/csps_state',						'4',	'get',	'xml',		'',		'Csps State?'],
	['/api/net/current-plmn',					'5',	'get',	'xml',		'',		'Current Cellular Provider Information'],
	['/api/net/net-feature-switch',				'5',	'get',	'xml',		'',		'Network Features Switches'],
	['/api/net/net-mode-list',					'4',	'get',	'xml',		'',		'Cellulars Bands ?'],
	['/api/net/net-mode',						'4',	'get',	'xml',		'',		'?'],
	['/api/net/network',						'4',	'get',	'xml',		'',		'?'],
	['/api/net/register',						'4',	'get',	'xml',		'',		'?'],

	['/api/ntwk/celllock',						'2',	'get',	'xml',		'',		''],
	['/api/ntwk/dualwaninfo',					'2',	'get',	'xml',		'',		''],
	['/api/ntwk/lan_upnp_portmapping',			'4',	'get',	'xml',		'',		'UPNP Ports?'],
	['/api/ntwk/lan-wan-config',				'2',	'get',	'xml',		'',		''],

	['/api/online-update/autoupdate-config',	'5',	'get',	'xml',		'',		'Online Auto Update Configuration'],
	['/api/online-update/configuration',		'5',	'get',	'xml',		'',		'Online Update Configuration'],
	['/api/online-update/status',				'5',	'get',	'xml',		'',		'Online Update Status'],

	['/api/pin/save-pin',						'4',	'get',	'xml',		'',		'SIM Pin Save?'],
	['/api/pin/simlock',						'5',	'get',	'xml',		'',		'SIM Pin Lock Information'],
	['/api/pin/status',							'5',	'get',	'xml',		'',		'SIM Pin Status'],

	['/api/security/bridgemode',				'2',	'get',	'xml',		'',		''],
	['/api/security/dmz',						'5',	'get',	'xml',		'',		'DMZ Information'],
	['/api/security/feature-switch',			'5',	'get',	'xml',		'',		'Security Features Switches'],
	['/api/security/firewall-switch',			'5',	'get',	'xml',		'',		'Firewall Features Switches'],
	['/api/security/lan-ip-filter',				'4',	'get',	'xml',		'',		'LAN Ip Filters?'],
	['/api/security/nat',						'4',	'get',	'xml',		'',		'NAT Features ?'],
	['/api/security/sip',						'5',	'get',	'xml',		'',		'SIP Information'],
	['/api/security/special-applications',		'4',	'get',	'xml',		'',		'Ports Information?'],
	['/api/security/upnp',						'5',	'get',	'xml',		'',		'Upnp Status'],
	['/api/security/url-filter',				'5',	'get',	'xml',		'',		'Url Filters'],
	['/api/security/virtual-servers',			'5',	'get',	'xml',		'',		'Virtual Servers'],
	['/api/security/white-lan-ip-filter',		'5',	'get',	'xml',		'',		'White LAN Ip Filter'],
	['/api/security/white-url-filter',			'5',	'get',	'xml',		'',		'White Url Filter'],

	['/api/sms/config',							'5',	'get',	'xml',		'',		'SMS Configuration'],
	['/api/sms/sms-count-contact',				'5',	'get',	'xml',		'',		'SMS Contacts Count'],
	['/api/sms/sms-count',						'5',	'get',	'xml',		'',		'SMS Counts'],
	['/api/sms/sms-feature-switch',				'5',	'get',	'xml',		'',		'SMS Features'],
	['/api/sms/sms-list',						'4',	'get',	'xml_p',	[
																			'PageIndex'		=>1,
																			'ReadCount'		=>20,
																			'BoxType'		=>['1', ['1'=>'Received', 	'2'=>'Sent'],		'Direction'],
																			'SortType'		=>['0', ['0'=>'IndexOrDate?','1'=>'Unsorted?','2'=>'IndexOrDate?'],'Sort By'],
																			'Ascending'		=>['0', ['0'=>'Descending'	,'1'=>'Ascending'],	'Sort Type'],
																			'UnreadPreferred'=>['0',['0'=>'?',			'1'=>'?'],			'???'],
																			],
																					'Get SMS List'],
	['/api/sms/send-sms',						'4',	'set',	'xml_p',	[
																			'Phones'		=>['!','One of serveral phone number(s), formatted as <Phone>num1</Phone><Phone>num2</Phone>'],
																			'Content'		=>['!','Message'],
																			'Length'		=>['!','Message Length'],
																			'Reserved'		=>['1',['0'=>'?','1'=>'?','2'=>'?'],'What is this REQUIRED param ???'],
																			'Date'			=>['!',"Date formatted like date('Y-m-d H:i:s')"],
																			'SendType'		=>['0','???'],
																			'Index'			=>['-1','???'],
																			],		'Send a SMS to one or multiple phone number(s)'],

	['/api/sms/delete-sms',						'5',	'set',	'xml_p',	['Index'	=>['!',"Message's Index"]],	'Delete a SMS from the InBox' ],
																			
	['/api/sms/sms-list-contact',				'2',	'get',	'xml',		'',		''],
	['/api/sms/splitinfo-sms',					'4',	'get',	'xml',		'',		'SMS Split Info?'],

	['/api/sntp/serverinfo',					'5',	'get',	'xml',		'',		'SNTP Servers list'],
	['/api/sntp/sntpswitch',					'5',	'get',	'xml',		'',		'SNTP switch'],
	['/api/sntp/timeinfo',						'5',	'get',	'xml',		'',		'SNTP Time Information'],

	['/api/statistic/feature-roam-statistic',	'2',	'get',	'xml',		'',		''],

	['/api/system/deviceinfoex',				'4',	'get',	'json',		'',		'Device Information (Ex?)'],
	['/api/system/HostInfo',					'5',	'get',	'json',		'',		'ARP Hosts Information'],
	['/api/system/onlinestate',					'5',	'get',	'json',		'',		'Device and Sytem Information'],
	['/api/system/onlineupg',					'2',	'get',	'xml',		'',		''],

	['/api/time/timeout',						'5',	'get',	'xml',		'',		'Login Timeout (min)'],

	['/api/timerule/timerule',					'5',	'get',	'xml',		'',		'Time Rules'],

	['/api/user/hilink_login',					'5',	'get',	'xml',		'',		'Hilink Login'],
	['/api/user/pwd',							'4',	'get',	'xml',		'',		'User Pwd ?'],
	['/api/user/rule',							'5',	'get',	'xml',		'',		'User Rules'],
	['/api/user/state-login',					'5',	'get',	'xml',		'',		'Login State'],
	['/api/user/web-feature-switch',			'5',	'get',	'xml',		'',		'Web Features Switches'],

	['/api/vpn/feature-switch',					'5',	'get',	'xml',		'',		'VPN Features Switches'],
	['/api/vpn/l2tp_settings',					'5',	'get',	'xml',		'',		'VPN L2tp Settings'],
	['/api/vpn/pptp_settings',					'5',	'get',	'xml',		'',		'VPN PPTP Settings'],

	['/api/webserver/token',					'5',	'get',	'xml',		'',		'Webserver Token'],

	['/api/wlan/guesttime-setting',				'5',	'get',	'xml',		'',		'Wifi Guest Time Settings'],
	['/api/wlan/host-list',						'4',	'get',	'xml',		'',		'Wifi Hosts List'],
	['/api/wlan/multi-basic-settings',			'5',	'get',	'xml',		'',		'Wifi Settings'],
	['/api/wlan/multi-macfilter-settings-ex',	'5',	'get',	'xml',		'',		'Wifi MAC filter settings (Ex?)'],
	['/api/wlan/status-switch-settings',		'5',	'get',	'xml',		'',		'Wifi Switch Settings'],
	['/api/wlan/wifi-feature-switch',			'5',	'get',	'xml',		'',		'Wifi Features Switches'],
	['/api/wlan/wlandbho',						'4',	'get',	'json',		'',		'Wifi dbho?'],

	['/config/device/config.xml',				'5',	'get',	'xml',		'',		'Device Configuration'],
	['/config/deviceinformation/config.xml',	'5',	'get',	'xml',		'',		'Device Information Switches'],

	['/config/dialup/config.xml',				'5',	'get',	'xml',		'',		'Dialup Information Switches'],
	['/config/dialup/connectmode.xml',			'5',	'get',	'xml',		'',		'Dialup Connect Mode'],

	['/config/global/config.xml',				'5',	'get',	'xml',		'',		'Global Configuration'],
	['/config/global/languagelist.xml',			'5',	'get',	'xml',		'',		'Languages list'],
	['/config/global/net-type.xml',				'5',	'get',	'xml',		'',		'Network Types?'],

	['/config/lan/config.xml',					'5',	'get',	'xml',		'',		'LAN Configuration'],

	['/config/network/net-mode.xml',			'4',	'get',	'xml',		'',		'Network Net Modes?'],
	['/config/network/networkband_null.xml',	'2',	'get',	'xml',		'',		''],
	['/config/network/networkmode.xml',			'4',	'get',	'xml',		'',		'Net Modes?'],

	['/config/pincode/config.xml',				'5',	'get',	'xml',		'',		'PIN code Configuration'],

	['/config/webuicfg/config.xml',				'5',	'get',	'xml',		'',		'Web UI Configuration'],

	['/api/device/control',						'1',	'set',	'xml_p',	['Control'=>['1',['1'=>'Reboot'],'Set to 1 to reboot']],		'Reboot'],

);



// 'calls' #################################################################################################
// List all 'METHOD_I' defined above to point to the Method name
// METHOD_INDEX => [METHOD_CALLED]
$p['calls']=array(
	'xml'	=> ['CallApiGet'],
	'json'	=> ['CallApiGetJson'],
	'xml_p'	=> ['CallApiPost'],
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
	'brand'		=>'Huawei',
	'family'	=>'modem',
//	'name'	=>'',
);


// 'readme' #################################################################################################
// (Markdown syntax)
$p['readme']=<<<EOF
This API client works for the Huawei B535-333 modem (also sold under Soyea brand).
It should also work on many other Huawei modems

EOF;


// 'tests' #################################################################################################

/*
Used to document the list of devices supported by this current API Client
*/
// [ MODEL, 	SOWFTARE_VERSION,	DATE,			 @NickName|Full_Name, 	URL|email,					COMMENT ]
$p['tests']=array(
	['B535-333',	'11.0.5.51',			'2023-12-17',	'@soif',				'https://github.com/soif/', 'Most ApiGet methods have been tested']
);

?>