<?php
/*
--------------------------------------------------------------------------------------------------------------------------------------
HackApi - OpenWRT main Class
--------------------------------------------------------------------------------------------------------------------------------------
Copyright (C) 2023  by François Déchery - https://github.com/soif/

HackApi is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

HackApi is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
--------------------------------------------------------------------------------------------------------------------------------------
*/

//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);


// ###############################################################################################
class Hackapi_Openwrt extends Hackapi{
	use Hackapi_Openwrt_Trait;

	// Overrides parent's properties ---------------------------------------------------
	protected $host			="192.168.1.1";	// (default) ip address or hostname
	protected $user			="root";		// (default) user name
	protected $password		="";			// (default) user password

	protected	$client_version		='0.30';	// API client Version, formated as M.mm

	protected $def_endpoint	='/cgi-bin/luci/admin/ubus';
	protected $def_headers=array(
		'Content-Type: application/json',
		'Accept: application/json'
	);

	protected $api_error_codes=array(
//		'0'			=>'UBUS_STATUS_OK (No Error)',
		'1'			=> 	['UBUS_STATUS_INVALID_COMMAND',		8],
		'2'			=> 	['UBUS_STATUS_INVALID_ARGUMENT',	1],
		'3'			=> 	['UBUS_STATUS_METHOD_NOT_FOUND',	6],
		'4'			=> 	['UBUS_STATUS_NOT_FOUND',			8],
		'5'			=> 	['UBUS_STATUS_NO_DATA',				8],
		'6'			=>	['UBUS_STATUS_PERMISSION_DENIED',	3], //login faile
		'7'			=> 	['UBUS_STATUS_TIMEOUT',				8],
		'8'			=> 	['UBUS_STATUS_NOT_SUPPORTED',		8],
		'9'			=> 	['UBUS_STATUS_UNKNOWN_ERROR',		5],
		'10'		=> 	['UBUS_STATUS_CONNECTION_FAILED',	8],
		'-32002'	=>	['RPC_ERROR_ACCESS_DENIED',			3],
		'-32602'	=>	['RPC_ERROR_INVALID_PARAMETERS',	1],
	);

	protected $std_fields_map=array(
		'ApiWifiListSsids'=>array(
			'id'			=> 'ifname',
			'bssid'			=> 'iwinfo/bssid',
			'ssid'			=> 'iwinfo/ssid',
			'password'		=> 'config/key',
			'channel'		=> 'my_channel',
		),
	);

	// Our properties ---------------------------------------------------------------------------
	private $_rpc_id				='';
	private $_ubus_session_id			='';
	private $_ubus_session_id_for_login	='00000000000000000000000000000000';



	// ############################################################################################
	// ## (REQUIRED) OVERRIDEN METHODS ############################################################
	// ############################################################################################


	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$this->DebugLogMethod();
		$user 		and $this->user		=$user;
		$password	and $this->password	=$password;
		
		$params=array(
			'username'	=> $this->user,
			'password'	=> $this->password
		);
		$this->_ubus_session_id=$this->_ubus_session_id_for_login;
		$r=$this->MyRpcCall('session','login',$params,false);
		$this->DebugLogVerbose('Login result',$r);
		
		if($r){
			$this->DebugLogInfo('Login OK');
			$this->_ubus_session_id=$r['ubus_rpc_session'];
			$this->is_logged=true;
			return true;
		}
	}



	// ############################################################################################
	// ## (Optionnal) OVERRIDEN STANDARDIZED METHODS ##############################################
	// ############################################################################################
/*
	// -------------------------------------------------------------------------
	public function ApiLogout(){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiIsLoggedIn(){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiReboot(){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiCellStatus($fast_mode=false){
	}

	// -------------------------------------------------------------------------
	public function ApiSmsListReceived($read_type=0, $page=1, $limit=20){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiSmsListSent($page=1,$max=20){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiSmsSend($phone, $message, $priority=''){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiWanConnect(){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiWanDisconnect(){
		$this->DebugLogMethod();
	}
	
	// -------------------------------------------------------------------------
	public function ApiWifiListClients($id=''){
		$this->DebugLogMethod();
	}
*/	
	// -------------------------------------------------------------------------
	public function ApiWifiListSsids($only_enabled=true){
		$this->DebugLogMethod();
		if($result=$this->ApiGetLuciRpcGetWirelessDevices()){
			//return $result;
			if(is_array($result)){
				$formatted=array();
				foreach($result as $radio_name => $info){
					if(!$only_enabled or $info['up']){
						foreach($info['interfaces'] as $if){
							if($if['config']['mode']=='ap'){
								$if['my_channel']=$info['config']['channel'];
								$formatted[$if['ifname']][]=$if;
							}
						}						
					}
				}

				foreach($formatted as $ssid => $list){
					if(is_array($list)){
						foreach($list as $k=>$v){
							$formatted[$ssid][$k]=$this->RemapFields($v,'ApiWifiListSsids');
						}	
					}
				}
				return $formatted;
			}
		}	
	}

/*
	// -------------------------------------------------------------------------
	public function ApiWifiStart(){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiWifiStop(){
		$this->DebugLogMethod();
	}
*/




	// ###############################################################################
	// #### Our OWN methods ##########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	protected function MyRpcCall($ubus_path, $ubus_method, $ubus_params=array() , $login_first=true){
		$result = $this->_CallRpc('call',$ubus_path, $ubus_method, $ubus_params, $login_first);
		
		// how the hell can they format a result like this :-/
		if($err=$result[0]){
			$this->SetApiErrorCode($err);
			//$this->DebugLogError("Ubus Error $err ({$this->api_error_codes[$err]})", $result);
		}
		else{
			if(isset($result[1]['results'])){
				return $result[1]['results'];
			}
			else{
				return $result[1];
			}
		}
	}

	// -------------------------------------------------------------------------
	protected function MyRpcList($ubus_path, $ubus_params=''){
		return $this->_CallRpc('list',$ubus_path,'',$ubus_params);
	}

	// -------------------------------------------------------------------------
	private function _CallRpc($rpc_method, $ubus_path='',$ubus_method='',$ubus_params=array(), $login_first=true){
		$this->DebugLogMethod();
		
		if($login_first and !$this->LoginIfNotAlready()){
		 	return false;
		}

		// makes payload -------------------
		$payload=array(
			$this->_ubus_session_id,
			$ubus_path,
			$ubus_method
		);
		// since OWRT 23.05, ubus call fails when args is empty, so add it only when needed
		if (! empty($ubus_params)) {
			$payload[]=$ubus_params;
		}
		else{
			//$payload[]= new stdClass();
		}
		$rpc=$this->_FormatRpc($rpc_method,$payload);

		if( $answer=$this->CallEndpoint('','POST',$rpc) ){
			$answer =json_decode($answer,true);
			//$answer=$this->ObjectToArray($answer);
			if (isset($answer['id']) && $answer['id'] == $this->_rpc_id && array_key_exists('result', $answer)) {
				return $answer['result'];
			}
			elseif (isset($answer['error'])) {
				$this->SetApiErrorCode($answer['error']['code'],$answer['error']['message']);
				//$this->DebugLogError('RPC Error', $answer['error']);
			}
			else{
				$this->SetError(2,'No result or error in answer');
			}
		}
		else{

		}
	}

	//---------------------------------------------------------------
	private function _FormatRpc($rpc_method, $params=array() ){
		//$this->_rpc_id or $this->_rpc_id = mt_rand();
		$this->_rpc_id = mt_rand();

		$payload = array(
			'jsonrpc'	=> '2.0',
			'method'	=> $rpc_method,
			'id' 		=> $this->_rpc_id
		);
		if (! empty($params)) {
			$payload['params'] = $params;
		}
		return json_encode($payload);
	}

}
?>