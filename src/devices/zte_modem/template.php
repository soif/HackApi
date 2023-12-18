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

// [ ENDPOINT,							STATE,	TYPE,	METHOD_I, 		PARAMS,	DESCRIPTION ]
$p['definitions']=array(
	['sms_data_total',					'4',	'get',	'get',		[
																		'tags'=>['10',['1'=>'Received','2'=>'Sent','10'=>'All'],'Box Type'],
																		'page'=>'0',
																		'data_per_page'=>'500',
																		'mem_store'=>'1',
																		'order_by'=>'order+by+id+desc'
																	],		'SMS List'],
	['SEND_SMS',						'4',	'set',	'post',		[
																		'Number'		=>['!','Phone Number'],
																		'MessageBody'	=>['!','Content (HEX encoded)'],
																		'sms_time'		=>['',"Date as date('y;m;d;H;i;s;+TZ')"],
																		'notCallback'	=>['true',"?"],
																		'ID'			=>['-1','Id'],
																		'encode_type'	=>['UNICODE','Encoding'],
																	],		'Send SMS'],

	['DELETE_SMS',						'5',	'set',	'post',		['msg_id'=>['!','Message ID']],		'Delete SMS'],
	['REBOOT_DEVICE',					'5',	'set',	'post',		'',		'Reboot'],
	['CONNECT_NETWORK',					'5',	'set',	'post',		'',		'WAN Connect'],
	['DISCONNECT_NETWORK',				'5',	'set',	'post',		'',		'WAN Disconnect'],
	['CHANGE_MODE',						'1',	'set',	'post',		['change_mode'=>'2','password'=>''],		'Enable Factory Backdoor?'],
	['URL_FILTER_ADD',					'1',	'set',	'post',		['addURLFilter'=>'http://_L33T_H4X0R_/&&telnetd&&'],		'Exploits Nvram (url encoded as "http%3A%2F%2F_L33T_H4X0R_%2F%26%26telnetd%26%26"?) '],
	['SET_WIFI_INFO',					'5',	'set',	'post',		[
																		'wifiEnabled'	=>['1',['0'=>'Disable','1'=>'Enable'],'Enable/Disable Wifi'],
																		'm_ssid_enable'	=>['0',['0'=>'Disable','1'=>'Enable'],'Enable/Disable Multi SSID'],
																	],		'Wifi Switches'],

	['hostNameList',					'1',	'get',	'get',		'',		'List Host names'],
	['station_list',					'5',	'get',	'get',		'',		'List Wifi Clients'],

);
// 'calls' ######################################################################################################
// List all 'METHOD_I' defined above to point to the Method name
// METHOD_INDEX => [METHOD_CALLED]
$p['calls']=array(
	'get'	=>['MyCallApiGet'],
	'post'	=>['MyCallApiPost'],
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
	'brand'		=>'ZTE',
	'family'	=>'modem',
//	'name'		=>'',
);


// 'readme' #################################################################################################
// (Markdown syntax)
$p['readme']=<<<EOF
This API client has been tested on the ZTE mf920u modem.
It should also work on many other ZTE modems..


EOF;


// 'tests' #################################################################################################

/*
Used to document the list of devices supported by this current API Client
*/
// [ MODEL, 	SOWFTARE_VERSION,		DATE,			 @NickName|Full_Name, 	URL|email,					COMMENT ]
$p['tests']=array(
	['mf920u',	'BD_MF920UV1.0.1B05',	'2023-12-17',	'@soif',				'https://github.com/soif/', 'Work In Progress']
);

?>