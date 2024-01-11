<?php
/*
--------------------------------------------------------------------------------------------------------------------------------------
HackApi - SFR Box main Class
--------------------------------------------------------------------------------------------------------------------------------------
Copyright (C) 2023  by François Déchery - https://github.com/soif/

HackApi is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

HackApi is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
--------------------------------------------------------------------------------------------------------------------------------------
Many Thanks to the reverse-engineering work of these guys:
	https://github.com/hacf-fr/sfrbox-api/blob/main/src/sfrbox_api/helpers.py
	https://gist.github.com/motin/7cbe1ae77bf493e3cae8
--------------------------------------------------------------------------------------------------------------------------------------
*/

//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);


// ###############################################################################################
class Hackapi_Sfr_box extends Hackapi{
	use Hackapi_Sfr_box_Trait;

	// Overidde Parent properties ---------------------------------------------------------------
	protected $host		="192.168.1.1";		// default Box's IP address
	protected $use_ssl	=false;				// it seems that the API dont work (don't even answers) in httpS mode
	protected $user		="admin";			// default Box's user name

	protected $client_version		='0.90';	// API client Version, formated as M.mm

	protected $use_cookies			=false;		// not needed
	//protected $def_headers		=array();
	//protected $def_referer		="/";
	protected $def_endpoint="/api/1.0/?method=";

	protected $api_error_codes=array(
		'0'		=> 	'Undebuged yet...',
		'112'	=> 	['METHOD_NOT_FOUND',	 	6],
		'113'	=>	['NEED_ARGUMENTS',			1],
		'114'	=> 	['INVALID_ARGUMENTS',		1],
		'115'	=> 	['AUTHENTICATION_NEEDED',	3],
		'116'	=> 	['INVALID_AUTHENTIFICATION',3],
		'120'	=> 	['BOX_BEING_UPGRADED',	 	7],

		'201'	=> 	['INVALID_SESSION_OR_ALREADY_ACTIVATED',	 3],
		'202'	=> 	['PRE_SESSION_TIMEOUT',	 	5],
		'203'	=> 	['PUSH_BUTTON_MISSED',	 	7],
		'204'	=> 	['INVALID_USER_OR_PASS',	3],
		'205'	=> 	['AUTHENTICATION_DISABLED',	3],
		'210'	=> 	['DNS_HOST_ALREADY_EXIST',	7],
		'212'	=> 	['DNS_HOST_NOT_FOUND',	 	7],
		'500'	=> 	['CANT_RETRIEVE_INTERFACE_LIST',7],
	);

	protected $std_fields_map=array(
		'ApiWanStatus'=>array(
			//'mac'			=> 'api_field_path',		// MAC address
			'up'			=> 'my_up',					// (boolean) Are we connected ?
			'since'			=> 'uptime',				// Seconds since we are connected
			'ipv4'			=> 'ip_addr',				// IP address (v4)
			'ipv6'			=> 'ipv6_addr',				// IP address (v6)
			// 'dns1v4'		=> 'api_field_path',		// DNS Server 1 IP address (v4)
			// 'dns2v4'		=> 'api_field_path',		// DNS Server 2 IP address (v4)
			// 'dns1v6'		=> 'api_field_path',		// DNS Server 1 IP address (v6)
			// 'dns2v6'		=> 'api_field_path',		// DNS Server 2 IP address (v6)
			// 'gatewayv4'		=> 'api_field_path',	// Gateway IP address (v4)
			// 'gatewayv6'		=> 'api_field_path',	// Gateway IP address (v6)
			// 'rx_realtime'	=> 'api_field_path',	// (bytes) Realtime RX 
			// 'rx_peak'		=> 'api_field_path',	// (bytes) Peak RX 
			// 'rx_day'		=> 'api_field_path',		// (bytes) Daily RX 
			// 'rx_month'		=> 'api_field_path',	// (bytes) Monthly RX 
			// 'rx_total'		=> 'api_field_path',	// (bytes) Total RX 
			// 'tx_realtime'	=> 'api_field_path',	// (bytes) Realtime TX 
			// 'tx_peak'		=> 'api_field_path',	// (bytes) Peak TX 
			// 'tx_day'		=> 'api_field_path',		// (bytes) Daily TX 
			// 'tx_month'		=> 'api_field_path',	// (bytes) Monthly TX 
			// 'tx_total'		=> 'api_field_path',	// (bytes) Total TX 
			'mode'				=> 'mode',				// Connection Mode

		),
		'ApiWifiListClients'=>array(
//			'id'			=> 'api_field_path',		// the internal ID asigned by the device (else set it to the MAC address)
			'mac'			=> 'mac_addr',				// MAC address
			'ipv4'			=> 'ip_addr',				// IP address (v4)
//			'ipv6'			=> 'api_field_path',		// IP address (v6)
//			'dns_name'		=> 'api_field_path',		// DNS host name
			'name'			=> 'my_name',				// host name (usually sent by client)
//			'alias'			=> 'api_field_path',		// friendly host name (user-defined in the device)
//			'time'			=> 'api_field_path',		// (unix time) Date when the client has been connected
			'duration'		=> 'my_dur',				// (sec) How long the client has been connected
//			'level_send'	=> 'api_field_path',		// (db) Send Level
//			'level_receive'	=> 'api_field_path',		// (db) Receive Level
		),
		'ApiWifiListSsids'=>array(
			'id'			=> 'my_id',					// the internal Station ID/name asigned by the device (used to filter the ApiWifiListClients)
//			'bssid'			=> '',						// BSSID MAC Address
			'ssid'			=> 'ssid',					// SSID MAC Address
			'password'		=> 'wpakey',				// Password
			'enabled'		=> 'my_enabled',			// Is enabled ? (true|false)
			'channel'		=> 'channel',				// Frequency Channel
			'mode'			=> 'mode',					// Wifi Mode (11xxx)
		),
	);

	// our own properties ---------------------------------------------------------------------------
	private $_token='';
	private $_token_duration=550;	// the token is supposed to be valid 600sec, let's set it a bit lower just in case
	private $_token_time	=0;		// time when the token was set



	// ############################################################################################
	// ## (REQUIRED) OVERRIDEN METHODS ############################################################
	// ############################################################################################

	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$this->DebugLogMethod();

		$user 		and $this->user		=$user;
		$password	and $this->password	=$password;

		$r=$this->CallApi('auth.getToken','','GET',false);
		if(isset($r['auth']['@attributes']['token'])){
			$token=$r['auth']['@attributes']['token'];
			$this->_token=$token;
			$this->_token_time=time();
			$this->DebugLogVerbose("Found token $token");

			$hash=hash_hmac('SHA256', hash('sha256',$this->user), $token) . hash_hmac('SHA256', hash('sha256',$this->password), $token) ;

			if($r=$this->CallApi('auth.checkToken',array('token'=>$token,'hash'=>$hash),'GET',false)){
				$this->DebugLogDebug('Login succeeded');
				$this->is_logged=true;
				return true;
			}
			else{
				$this->DebugLogError('Login failed');
			}
		}
		else{
			$this->SetApiErrorCode('','Cant get Token',$r);
			$this->DebugLogError('Cant get Token');
		}
		
	}


	// ############################################################################################
	// ## (Optionnal) OVERRIDEN STANDARDISED METHODS ##############################################
	// ############################################################################################

	// -------------------------------------------------------------------------
	public function ApiReboot(){
		$this->ApiSetSystemReboot();
	}


	/*
	// -------------------------------------------------------------------------
	public function ApiLogout(){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiIsLoggedIn(){
		$this->DebugLogMethod();
	}


*/
	// -------------------------------------------------------------------------
	public function ApiWanStatus(){
		if($r=$this->ApiGetWanGetInfo()){
			$r['my_up'] = $r['status']=='up' ? true:false;
			$r=$this->RemapFields($r,'ApiWanStatus',false);
			return $r;
		}
	}

	// -------------------------------------------------------------------------
	public function ApiWifiListClients($id=''){
		$out=array();
		// get names and duration
		$macs=array();
		if($hosts=$this->ApiGetLanGetHostsList()){
			foreach($hosts as $h){
				$macs[$h['mac']]=$h;
			}
		}

		if($arr=$this->ApiGetWlanGetClientList()){
			foreach($arr as $k => $c){
				if(isset($macs[$c['mac_addr']])){
					$c['my_name']	=$macs[$c['mac_addr']]['name'];
					$c['my_dur']	=$macs[$c['mac_addr']]['probe']; // 'probe' or maybe 'alive'
				}
				$out['2g'][$k]=$this->RemapFields($c,'ApiWifiListClients');
			}
		}

		if($arr=$this->ApiGetWlan5GetClientList()){
			foreach($arr as $k => $c){
				if(isset($macs[$c['mac_addr']])){
					$c['my_name']	=$macs[$c['mac_addr']]['name'];
					$c['my_dur']	=$macs[$c['mac_addr']]['probe']; // 'probe' or maybe 'alive'
				}
				$out['5g'][$k]=$this->RemapFields($c,'ApiWifiListClients');
			}
		}

		// TODO handle Guests
		//$radio_g=$this->ApiGetGuestGetInfo();

		if(!empty($out)){
			if($id){
				return $out[$id];
			}
			else{
				return $out;
			}
		}
	}

	// -------------------------------------------------------------------------
	public function ApiWifiListSsids($only_enabled=false){
		$out=array();
		$radio_2=$this->ApiGetWlanGetInfo();
		$radio_5=$this->ApiGetWlan5GetInfo();
		$radio_g=$this->ApiGetGuestGetInfo();
		isset($radio_2['wl0'])		and $out['2g']	=array_merge($radio_2['wl0'],	$radio_2['@attributes']);
		isset($radio_5['wl0'])		and $out['5g']	=array_merge($radio_5['wl0'],	$radio_5['@attributes']);
		isset($radio_g['config'])	and $out['guest']=array_merge($radio_g['config'],$radio_g['@attributes']);
		
		// we should get bssid via ApiGetSystemGetIflist, but method rarely works 
		
		foreach($out as $k => $arr){
			$arr['my_id']=$k;
			$arr['my_enabled']= $arr['active']=='on' ? true:false;
			if(!$only_enabled or ($only_enabled and $arr['my_enabled'])){
				$out[$k]=$this->RemapFields($arr,'ApiWifiListSsids',true);
			}
			else{
				unset($out[$k]);
			}
		}
		if(!empty($out)){
			return $out;
		}
	}

	// -------------------------------------------------------------------------
	public function ApiWifiStart(){
		$this->ApiSetWlanEnable();
		//$this->ApiSetWlan5Enable(); // method needs to be discovered
		$this->ApiSetGuestEnable();
		return true;
	}

	// -------------------------------------------------------------------------
	public function ApiWifiStop(){
		$this->ApiSetWlanDisable();
		//$this->ApiSetWlan5Disable(); // method needs to be discovered
		$this->ApiSetGuestDisable();
		return true;
	}


	// ###############################################################################
	// #### Our OWN methods ##########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	//lets reformat info
	public function ApiGetOntGetInfoClean(){
		if($r=$this->ApiGetOntGetInfo()){
			$tmp=$r['info'];
			$r['info']=array();
			foreach ($tmp as $pair){
				$r['info'][$pair['name']]=$pair['value'];
			}
			return $r;
		}
	}


	// -------------------------------------------------------------------------
	public function CallApiGet($endpoint, $params=''){
		return $this->CallApi($endpoint, $params, 'GET');
	}

	// -------------------------------------------------------------------------
	public function CallApiGetFix($endpoint, $params=''){
		return $this->CallApi($endpoint, $params, 'GET',true,false,true);
	}

	// -------------------------------------------------------------------------
	public function CallApiGetList($endpoint, $params=''){
		return $this->CallApi($endpoint, $params, 'GET',true,true);
	}

	// -------------------------------------------------------------------------
	public function CallApiPost($endpoint, $params=''){
		return $this->CallApi($endpoint, $params, 'POST');
	}

	// -------------------------------------------------------------------------
	private function CallApi($endpoint, $params=array(), $type='GET', $autologin=true,$force_list=false,$fix_xml=false){
		$this->DebugLogMethod();
		
		if($autologin){
			// relogin if needed
			if($this->_token_time + $this->_token_duration < time()){
				$this->DebugLogDebug("Re login because the token as expired after {$this->_token_duration} sec");
				$this->is_logged=false;
			}

			if(!$this->LoginIfNotAlready()){
				return false;
			}
		}

		$this->_token and $params['token']=$this->_token;

		// make the call ----------------------------------------
		$endpoint=$this->def_endpoint.$endpoint;
		$xml=$this->CallEndpoint($endpoint, $type, $params);
		//$arr=$this->XmlToArray($this->CallEndpoint($endpoint, $type, $params));
		if($fix_xml){
			$xml=preg_replace('#^\s*\n$#m','',$xml);
		}
		$arr=$this->XmlToArray($xml);
		$arr= $this->ErrorFreeResult($arr,$autologin,$force_list);
		
		return $arr;
	}

	// -------------------------------------------------------------------------
	protected function ErrorFreeResult($arr,$autologin,$force_list=false){
		if(is_array($arr)){
			if( isset($arr['@attributes']['stat']) ){
				if($arr['@attributes']['stat']=='ok'){
			//if( isset($arr['stat']) ){
			//	if($arr['stat']=='ok'){
					$this->DebugLogDebug('Status ok!');
					$this->DebugLogVerbose('Original Array: ',$arr);
					//unset($arr['stat']);
					//unset($arr['version']);
					if($autologin){
						$arr=$this->_CleanArray($arr,$force_list);
					}
					$this->DebugLogVerbose('Cleaned Array: ',$arr);

					//if(is_array($arr) and !count($arr)){
					//	return true;
					//}
					return $arr;
				}
				elseif($arr['@attributes']['stat']=='fail'){
					if(isset($arr['err']['@attributes']['code'])){
						$this->SetApiErrorCode($arr['err']['@attributes']['code'], $arr['err']['@attributes']['msg'], $arr['err']['@attributes']);

				//elseif($arr['stat']=='fail'){
				//	if(isset($arr['err']['code'])){
				//		$this->SetApiErrorCode($arr['err']['code'],$arr['err']['msg'],$arr['err']);
						return false;
					}
				}
				else{
					$this->SetApiErrorCode(0,'Unknown @attributes.stat',$arr);
				}
			}
			else{
				$this->SetApiErrorCode(0,'No @attributes.stat found',$arr);
			}
		}
		else{
			$this->SetApiErrorCode(0,'Result is not an array! Raw result is',$arr);
		}
		return false;
	}

	// -------------------------------------------------------------------------
	private function _CleanArray($arr,$force_list=false){
		//echo "Original Array:\n".$this->PrettifyArray($arr)."\n\n";

		//remove the first 'state'  arr.@attributes
		//$state=$arr['@attributes'];
		unset($arr['@attributes']);

		//if only ONE result, move the result up one level, ie arr.lan=array() becomes arr.array()
		if(is_array($arr) and count($arr)==1){
			reset($arr);
			$first_key=key($arr);
			$data=$arr[$first_key];
			if(is_array($data)){
				unset($arr[$first_key]);
				$arr=array_merge($data, $arr);	
			}
		}

		// now remove all intermediate "@properties" (did I say that i love(...) XML structures)
		$this->_ReFormatArray($arr);

		if(!is_array($arr)){
			return false;
		}

		// due to our previous fomatting, some method expecting a List of array, would return the first array, in the first level, instead of being emclosed in an array, lets fix this 
		if($force_list and is_array($arr) and !isset($arr[0])){
			$arr=array($arr);
		}

		//remove blank arr.0 if any
		if( isset($arr[0]) and (is_array($arr[0]) and !count($arr[0]) or (!is_array($arr[0]) and trim($arr[0])=='') ) ){ //count($arr)==1 and   and trim($arr[0])==''
			if($force_list){
				return false;
			}
			else{
				return true;
			}
		}

		return $arr;
	}

	// -------------------------------------------------------------------------
	private function _ReFormatArray(  & $arr){
		if(is_array($arr)){
			foreach($arr as $k => &$v){
				if(is_array($v)){
					$this->_ReFormatArray($v);
					if($k=='@attributes'){
						if(count($arr)==1){
							$arr=array_merge($v, $arr);
							unset($arr[$k]);
						}
					}
				}
			}
		}
	}


}
?>