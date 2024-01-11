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

// [ ENDPOINT,										STATE,	TYPE,	METHOD_I, 		PARAMS,	DESCRIPTION ]
$p['definitions']=array(

	[ 'dhcp',											'5',	'get',	'list',		'',		'List DHCP objects'],
	[ ['dhcp',	'add_lease'],							'1',	'set',	'call',		['mac'=>'','leasetime'=>'','name'=>'','hostid'=>'','duid'=>'','ip'=>''],		''],
	[ ['dhcp',	'ipv6leases'],							'4',	'get',	'call',		'',		'(ACL needed) ipv4 DHCP Leases'],
	[ ['dhcp',	'ipv4leases'],							'4',	'get',	'call',		'',		'(ACL needed) ipv6 DHCP Leases'],

	[ 'dnsmasq',										'5',	'get',	'list',		'',		'List DnsMasq objects'],
	[ ['dnsmasq',	'metrics'],							'4',	'get',	'call',		'',		'(ACL needed) DnsMasq Metrics'],

	[ 'file',											'5',	'get',	'list',		'',		'List file objects'],
	[ ['file',	'read'],								'4',	'get',	'call',		['path'=>['!','File Path'],'base64'=>['false',['true','false'],'Is result base64 encoded?']],	'Read a file contents. The result is encoded in Base64 if the base64 param set to “true” '],
	[ ['file',	'write'],								'1',	'set',	'call',		['path'=>['!','File Path'],'base64'=>['false',['true','false'],'Is result base64 encoded?'],'append'=>['false',['true','false'],'If "true",the file is not overwritten but the new content is added to the end of the file'],'mode'=>['','File permission mode'],'data'=>['','file content']],		'Write a data to a file by path.'],
	[ ['file',	'list'],								'4',	'get',	'call',		['path'=>['/','Directory Path']],				'List files in the Directory'],
	[ ['file',	'md5'],									'4',	'get',	'call',		['path'=>['!','File Path']],				'File md5 sum'],
	[ ['file',	'exec'],								'1',	'set',	'call',		['command'=>'','env'=>'','params'=>''],		''],
	[ ['file',	'stat'],								'4',	'get',	'call',		['path'=>['!','File/Directory Path']],				'File or Directory Statistics'],
	[ ['file',	'remove'],								'1',	'set',	'call',		['path'=>''],				''],

	[ 'iwinfo',											'5',	'get',	'list',		'',		'List Wireless objects'],
	[ ['iwinfo','assoclist'],							'4',	'get',	'call',		['device'=>['!', 'Interface name'],'mac'=>['','???']],		'List Wifi Stations'],
	[ ['iwinfo','devices'],								'4',	'get',	'call',		'',										'(ACL needed) Wifi Interfaces List'],
	[ ['iwinfo','survey'],								'4',	'get',	'call',		['device'=>['!', 'Interface name']],	'(ACL needed) Wifi Channels Stats ???'],
	[ ['iwinfo','countrylist'],							'4',	'get',	'call',		['device'=>['!', 'Interface name']],	'Countries List'],
	[ ['iwinfo','phyname'],								'4',	'get',	'call',		['section'=>['!', 'radio device (radioX)']],'(ACL needed) Physical name'],
	[ ['iwinfo','scan'],								'5',	'set',	'call',		['device'=>['!', 'Interface name']],	'Scan neighbourhood Access Points'],
	[ ['iwinfo','info'],								'5',	'get',	'call',		['device'=>['!', 'Interface name']],	'Interface Information'],
	[ ['iwinfo','txpowerlist'],							'4',	'get',	'call',		['device'=>['!', 'Interface name']],	'dbm vs Transmit Power List?'],
	[ ['iwinfo','freqlist'],							'5',	'get',	'call',		['device'=>['!', 'Interface name']],	'Channels vs Frequencies List'],

	[ 'luci',											'5',	'get',	'list',		'',					'List Luci objects'],
	[ ['luci','getMountPoints'],						'5',	'get',	'call',		'',					'Mount Points'],
	[ ['luci','getFeatures'],							'5',	'get',	'call',		'',					'Features'],
	[ ['luci','getLocaltime'],							'4',	'get',	'call',		'',					'(ACL needed) Current local time'],
	[ ['luci','getSwconfigFeatures'],					'4',	'get',	'call',		['switch'=>['!','Switch (ie "switch0")']],		'Switch Configuration'],
	[ ['luci','getSwconfigPortState'],					'4',	'get',	'call',		['switch'=>['!','Switch (ie "switch0")']],		'Switch Ports States'],
	[ ['luci','setPassword'],							'3',	'set',	'call',		['username'=>'','password'=>''],		''],
	[ ['luci','getConntrackHelpers'],					'5',	'get',	'call',		'',					'Connection Track Helpers'],
	[ ['luci','getUSBDevices'],							'5',	'get',	'call',		'',					'USB ports and devices'],
	[ ['luci','getInitList'],							'5',	'get',	'call',		['name'=>''],		'Init List'],
	[ ['luci','getProcessList'],						'5',	'get',	'call',		'',					'Processes List'],
	[ ['luci','setLocaltime'],							'1',	'set',	'call',		['localtime'=>''],	''],
	[ ['luci','getRealtimeStats'],						'4',	'get',	'call',		['mode'=>['!',['load','interface','wireless','conntrack'],'Mode'],'device'=>['',"Interface. Required for 'interface' and 'wireless' modes"]],	'Realtime Statistics'],
	[ ['luci','getConntrackList'],						'5',	'get',	'call',		'',					'Connection Track Helpers'],
	[ ['luci','getBlockDevices'],						'3',	'get',	'call',		'',					'?'],
	[ ['luci','getLEDs'],								'5',	'get',	'call',		'',					'LEDs status'],
	[ ['luci','getTimezones'],							'5',	'get',	'call',		'',					'Time zones list'],
	[ ['luci','setInitAction'],							'1',	'set',	'call',		['name'=>'','action'=>''],		''],
	[ ['luci','setBlockDetect'],						'1',	'set',	'call',		'',					''],

	[ 'luci-rpc',										'5',	'get',	'list',		'',				'List luci-RPC objects'],
	[ ['luci-rpc',	'getHostHints'],					'5',	'get',	'call',		'',				'Hosts (ip,ipv6,name) - indexed by MAC address'],
	[ ['luci-rpc',	'getNetworkDevices'],				'5',	'get',	'call',		'',				'Network Interfaces - indexed by interfaces'],
	[ ['luci-rpc',	'getDHCPLeases'],					'5',	'get',	'call',		['family'=>''],	'DHCP Leases : dhcp_leases & dhcp6_leases'],
//	[ ['luci-rpc',	'getDUIDHints'],					'3',	'get',	'call',		'',				'???'],
	[ ['luci-rpc',	'getWirelessDevices'],				'5',	'get',	'call',		'',				'Wireless Devices - indexed by interfaces'],
	[ ['luci-rpc',	'getBoardJSON'],					'5',	'get',	'call',		'',				'Basic Board Information'],

	[ 'network',										'5',	'get',	'list',		'',							'List Network objects'],
	[ ['network','add_dynamic'],						'1',	'set',	'call',		['name'=>''] ,				''],
	[ ['network','restart'],							'1',	'set',	'call',		'',							' Restart the network, reconfigures all interfaces'],
	[ ['network','get_proto_handlers'],					'4',	'get',	'call',		'',							'Proto? handlers'],
	[ ['network','netns_updown'],						'1',	'set',	'call',		['start'=>'','jail'=>''],	''],
	[ ['network','add_host_route'],						'1',	'set',	'call',		['target'=>'','v6'=>'','interface'=>'','exclude'=>''],		''],
	[ ['network','reload'],								'1',	'set',	'call',		'',							''],

	[ 'network.device',									'5',	'get',	'list',		'',								'List Device objects'],
	[ ['network.device','status'],						'4',	'get',	'call',		['name'=>['!','Interface name']],	'(ACL needed) Dump status of given network device ifname'],
	[ ['network.device','set_alias'],					'1',	'set',	'call',		['alias'=>'','device'=>''],		''],
	[ ['network.device','set_state'],					'1',	'set',	'call',		['defer'=>'','name'=>'','auth_status'=>''],	'Defer or ready the given network device ifname, depending on the boolean value defer'],
	[ ['network.device','stp_init'],					'1',	'set',	'call',		'',								''],

	[ 'network.interface',								'5',	'get',	'list',		'',		'List Network Interface objects'],
	[ ['network.interface','remove_device'],			'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	''],
	[ ['network.interface','up'],						'1',	'set',	'call',		'',		''],
	[ ['network.interface','add_device'],				'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	''],
	[ ['network.interface','prepare'],					'1',	'set',	'call',		'',		''],
	[ ['network.interface','set_data'],					'1',	'set',	'call',		'',		''],
	[ ['network.interface','remove'],					'1',	'set',	'call',		'',		''],
	[ ['network.interface','renew'],					'1',	'set',	'call',		'',		''],
	[ ['network.interface','status'],					'3',	'get',	'call',		'',		'(ACL needed) ????'],
	[ ['network.interface','notify_proto'],				'1',	'set',	'call',		'',		''],
	[ ['network.interface','down'],						'1',	'set',	'call',		'',		''],
	[ ['network.interface','dump'],						'4',	'get',	'call',		'',		'(ACL needed) Interfaces status ???'],

	[ 'network.interface.lan',							'5',	'get',	'list',		'',		'List LAN Network Interface objects'],
	[ ['network.interface.lan','remove_device'],		'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Remove network device 'name' from interface LAN"],
	[ ['network.interface.lan','up'],					'1',	'set',	'call',		'',		'Bring interface LAN up'],
	[ ['network.interface.lan','add_device'],			'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Add network device 'name' to interface LAN"],
	[ ['network.interface.lan','prepare'],				'1',	'set',	'call',		'',		'Prepare setup of interface LAN'],
	[ ['network.interface.lan','set_data'],				'1',	'set',	'call',		'',		''],
	[ ['network.interface.lan','remove'],				'1',	'set',	'call',		'',		'Remove interface LAN'],
	[ ['network.interface.lan','renew'],				'1',	'set',	'call',		'',		''],
	[ ['network.interface.lan','status'],				'4',	'get',	'call',		'',		'(ACL needed) Dump status of interface LAN'],
	[ ['network.interface.lan','notify_proto'],			'1',	'set',	'call',		'',		''],
	[ ['network.interface.lan','down'],					'1',	'set',	'call',		'',		'Bring interface LAN down'],
	[ ['network.interface.lan','dump'],					'4',	'get',	'call',		'',		'(ACL needed) LAN Interfaces Status'],

	[ 'network.interface.loopback',						'5',	'get',	'list',		'',		'List Loopback Network Interface objects'],
	[ ['network.interface.loopback','remove_device'],	'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Remove network device 'name' from interface LoopBack"],
	[ ['network.interface.loopback','up'],				'1',	'set',	'call',		'',		'Bring interface LoopBack up'],
	[ ['network.interface.loopback','add_device'],		'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Add network device 'name' to interface LoopBack"],
	[ ['network.interface.loopback','prepare'],			'1',	'set',	'call',		'',		'Prepare setup of interface LoopBack'],
	[ ['network.interface.loopback','set_data'],		'1',	'set',	'call',		'',		''],
	[ ['network.interface.loopback','remove'],			'1',	'set',	'call',		'',		'Remove interface LoopBack'],
	[ ['network.interface.loopback','renew'],			'1',	'set',	'call',		'',		''],
	[ ['network.interface.loopback','status'],			'4',	'get',	'call',		'',		'(ACL needed) Dump status of interface LoopBack'],
	[ ['network.interface.loopback','notify_proto'],	'1',	'set',	'call',		'',		''],
	[ ['network.interface.loopback','down'],			'1',	'set',	'call',		'',		'Bring interface LoopBack down'],
	[ ['network.interface.loopback','dump'],			'4',	'get',	'call',		'',		'(ACL needed) LoopBack Interfaces Status'],

	[ 'network.interface.wan',							'5',	'get',	'list',		'',		'List WAN Network Interface objects'],
	[ ['network.interface.wan','remove_device'],		'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Remove network device 'name' from interface WAN"],
	[ ['network.interface.wan','up'],					'1',	'set',	'call',		'',		'Bring interface WAN up'],
	[ ['network.interface.wan','add_device'],			'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Add network device 'name' to interface WAN"],
	[ ['network.interface.wan','prepare'],				'1',	'set',	'call',		'',		'Prepare setup of interface WAN'],
	[ ['network.interface.wan','set_data'],				'1',	'set',	'call',		'',		''],
	[ ['network.interface.wan','remove'],				'1',	'set',	'call',		'',		'Remove interface WAN'],
	[ ['network.interface.wan','renew'],				'1',	'set',	'call',		'',		''],
	[ ['network.interface.wan','status'],				'3',	'get',	'call',		'',		'(ACL needed) Dump status of interface WAN'],
	[ ['network.interface.wan','notify_proto'],			'1',	'set',	'call',		'',		''],
	[ ['network.interface.wan','down'],					'1',	'set',	'call',		'',		'Bring interface WAN down'],
	[ ['network.interface.wan','dump'],					'3',	'get',	'call',		'',		'(ACL needed) WAN Interfaces Status'],

	[ 'network.interface.wan6',							'5',	'get',	'list',		'',		'List WAN6 Network Interface objects'],
	[ ['network.interface.wan6','remove_device'],		'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Remove network device 'name' from interface WAN6"],
	[ ['network.interface.wan6','up'],					'1',	'set',	'call',		'',		'Bring interface WAN6 up'],
	[ ['network.interface.wan6','add_device'],			'1',	'set',	'call',		['link-ext'=>'','name'=>'','vlan'=>''],	"Add network device 'name' to interface WAN6"],
	[ ['network.interface.wan6','prepare'],				'1',	'set',	'call',		'',		'Prepare setup of interface WAN6'],
	[ ['network.interface.wan6','set_data'],			'1',	'set',	'call',		'',		''],
	[ ['network.interface.wan6','remove'],				'1',	'set',	'call',		'',		'Remove interface WAN6'],
	[ ['network.interface.wan6','renew'],				'1',	'set',	'call',		'',		''],
	[ ['network.interface.wan6','status'],				'3',	'get',	'call',		'',		'(ACL needed) Dump status of interface WAN6'],
	[ ['network.interface.wan6','notify_proto'],		'1',	'set',	'call',		'',		''],
	[ ['network.interface.wan6','down'],				'1',	'set',	'call',		'',		'Bring interface WAN6 down'],
	[ ['network.interface.wan6','dump'],				'3',	'get',	'call',		'',		'(ACL needed) WAN6 Interfaces Status'],

	[ 'network.rrdns',									'5',	'get',	'list',		'',		'List RrDns objects'],
	[ ['network.rrdns','lookup'],						'1',	'set',	'call',		['port'=>'','timeout'=>'','addrs'=>'','limit'=>'','server'=>''],	''],

	[ 'network.wireless',								'5',	'get',	'list',		'',		'List Wireless objects'],
	[ ['network.wireless','get_validate'],				'4',	'get',	'call',		'',		'(ACL needed) ???'],
	[ ['network.wireless','up'],						'5',	'set',	'call',		'',		'Bring Wireless interfaces up'],
	[ ['network.wireless','status'],					'4',	'get',	'call',		'',		'(ACL needed) Dump status of WLAN interfaces'],
	[ ['network.wireless','reconf'],					'1',	'set',	'call',		'',		''],
	[ ['network.wireless','down'],						'5',	'set',	'call',		'',		'Bring Wireless interfaces down'],
	[ ['network.wireless','notify'],					'1',	'set',	'call',		'',		''],

	[ 'service',										'5',	'get',	'list',		'',				'List Service objects'],
	[ ['service','update_complete'],					'1',	'set',	'call',		['name'=>''],	''],
	[ ['service','delete'],								'1',	'set',	'call',		['name'=>'','instance'=>''],	''],
	[ ['service','set'],								'1',	'set',	'call',		['instances'=>'','script'=>'','validate'=>'','autostart'=>'','name'=>'','data'=>'','triggers'=>''],	''],
	[ ['service','event'],								'1',	'set',	'call',		['data'=>'','type'=>''],	''],
	[ ['service','state'],								'1',	'set',	'call',		['name'=>'','spawn'=>''],	''],
	[ ['service','add'],								'1',	'set',	'call',		['instances'=>'','script'=>'','validate'=>'','autostart'=>'','name'=>'','data'=>'','triggers'=>''],	''],
	[ ['service','get_data'],							'1',	'set',	'call',		['instance'=>'','type'=>'','name'=>''],	''],
	[ ['service','list'],								'3',	'get',	'call',		['name'=>'','verbose'=>''],	'(ACL needed)'],
	[ ['service','validate'],							'1',	'set',	'call',		['package'=>'','type'=>'','service'=>''],	''],
	[ ['service','watchdog'],							'1',	'set',	'call',		['instance'=>'','mode'=>'','timeout'=>'','name'=>''],	''],
	[ ['service','update_start'],						'1',	'set',	'call',		['name'=>''],	''],
	[ ['service','signal'],								'1',	'set',	'call',		['instance'=>'','name'=>'','addrs'=>'','signal'=>''],	''],

	[ 'session',										'5',	'get',	'list',		'',		'List Session objects'],
	[ ['session','destroy'],							'1',	'set',	'call',		['ubus_rpc_session'=>''],	''],
	[ ['session','access'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','function'=>'','object'=>'','scope'=>''],	''],
	[ ['session','set'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','values'=>''],	''],
	[ ['session','create'],								'1',	'set',	'call',		['timeout'=>''],	''],
	[ ['session','revoke'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','objects'=>'','scope'=>''],	''],
	[ ['session','list'],								'4',	'get',	'call',		'',							'(ACL needed) List (current) session'],
	[ ['session','login'],								'1',	'set',	'call',		['username'=>'','password'=>'','timeout'=>''],	''],
	[ ['session','grant'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','objects'=>'','scope'=>''],	''],
	[ ['session','unset'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','keys'=>''],	''],
	[ ['session','get'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','keys'=>''],	''],

	[ 'system',											'5',	'get',	'list',		'',				'List System objects'],
	[ ['system',	'reboot'],							'5',	'set',	'call',		'',				'Reboot Device'],
	[ ['system',	'board'],							'5',	'get',	'call',		'',				'Board and Firmare Information'],
	[ ['system',	'info'],							'5',	'get',	'call',		'',				'Memory, Storage, Load and Uptime'],
	[ ['system',	'sysupgrade'],						'1',	'set',	'call',		['backup'=>'','path'=>'','prefix'=>'','command'=>'','force'=>'','options'=>''],		''],
	[ ['system',	'watchdog'],						'1',	'set',	'call',		['timeout'=>'','magicclose'=>'','stop'=>'','frequency'=>''],		''],
	[ ['system',	'validate_firmware_image'],			'1',	'set',	'call',		['path'=>''],	''],
	[ ['system',	'signal'],							'3',	'set',	'call',		['pid'=>'','signum'=>''],		'(ACL needed) ?'],


	[ 'uci',											'5',	'get',	'list',		'',		''],
	[ ['uci',	'delete'],								'1',	'set',	'call',		['type'=>'','options'=>'','section'=>'','option'=>'','ubus_rpc_session'=>'','config'=>'','match'=>''],		''],
	[ ['uci',	'get'],									'1',	'set',	'call',		['type'=>'','section'=>'','ubus_rpc_session'=>'','option'=>'','config'=>'','match'=>''],		''],
	[ ['uci',	'set'],									'1',	'set',	'call',		['type'=>'','values'=>'','section'=>'','ubus_rpc_session'=>'','config'=>'','match'=>''],		''],
	[ ['uci',	'order'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','config'=>'','sections'=>''],		''],
	[ ['uci',	'configs'],								'4',	'get',	'call',		'',													'(ACL needed) List UCI configurations'],
	[ ['uci',	'changes'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','config'=>''],		''],
	[ ['uci',	'reload_config'],						'1',	'set',	'call',		'',		''],
	[ ['uci',	'state'],								'1',	'set',	'call',		['type'=>'','section'=>'','ubus_rpc_session'=>'','option'=>'','config'=>'','match'=>''],		''],
	[ ['uci',	'add'],									'1',	'set',	'call',		['type'=>'','values'=>'','ubus_rpc_session'=>'','config'=>'','name'=>''],		''],
	[ ['uci',	'rollback'],							'1',	'set',	'call',		['ubus_rpc_session'=>''],		''],
	[ ['uci',	'revert'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','config'=>''],		''],
	[ ['uci',	'commit'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','config'=>''],		''],
	[ ['uci',	'confirm'],								'1',	'set',	'call',		['ubus_rpc_session'=>''],		''],
	[ ['uci',	'rename'],								'1',	'set',	'call',		['config'=>'','name'=>'','section'=>'','option'=>'','ubus_rpc_session'=>''],		''],
	[ ['uci',	'apply'],								'1',	'set',	'call',		['ubus_rpc_session'=>'','timeout'=>'','rollback'=>''],		''],
	
);

// 'calls' ######################################################################################################
// List all 'METHOD_I' defined above to point to the Method name
// METHOD_INDEX => [METHOD_CALLED]
$p['calls']=array(
	'call'	=> ['MyRpcCall'],
	'list'	=> ['MyRpcList'],
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
	'brand'		=>'OpenWRT',
	'family'	=>'router',
//	'name'	=>'',
);

// 'readme' #################################################################################################
// (Markdown syntax)
$p['readme']=<<<EOF
(WORK IN PROGRESS)

This API client works for OpenWrt 22.x.
but it should actually work for many previous version.
It does not require any specific packages.

-------
Please note that some methods are not permitted using the default OpenWrt configuration. _(You'll get a nice '-32002 error')_

To grant access to all methods, you can add: 

```json
{
	"superuser": {
		"description": "Super user access role",
		"read": {
			"ubus": {
					"*": [ "*" ]
			},
			"uci": [ "*" ],
			"file": {
					"*": ["*"]
			}
		},
		"write": {
			"ubus": {
					"*": [ "*" ]
			},
			"uci": [ "*" ],
			"file": {
					"*": ["*"]
			},
			"cgi-io": ["*"]
		}
	}
}
```

into a new file (in your OpenWRT router) at: `/usr/share/rpcd/acl.d/superuser.json`.

_Then for security reasons, you might rather want to create a user dedicated to your API usage, with appropriate restrictions._

EOF;


// 'tests' #################################################################################################

/*
Used to document the list of devices supported by this current API Client
*/
// [ MODEL, 	SOWFTARE_VERSION,	DATE,			 @NickName|Full_Name, 	URL|email,					COMMENT ]
$p['tests']=array(
	['openwrt',	'22.03.2',			'2024-01-10',	'@soif',				'https://github.com/soif/', 'Most ApiGet methods have been tested. Most ApiSet methods still need tests']
);

?>