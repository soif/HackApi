<?php
/*
--------------------------------------------------------------------------------------------------------------------------------------
HackApi - OPNSense main Class
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
class Hackapi_OpnSense extends Hackapi{
	use Hackapi_OpnSense_Trait;

	// Overrides parent's properties ---------------------------------------------------
	protected $host			="192.168.1.1";		// (default) ip address or hostname
	protected $user			="root";			// (default) user name
	protected $password		="opnsense";		// (default) user password

	protected	$client_version		='0.92';	// API client Version, formatted as M.mm

	protected $def_endpoint='/api';

	// OPNsense CSV downloads use semicolon (European) dialect
	protected $csv_delimiter=';';

	protected $api_error_codes=array(
		'400'		=> ['CONTROLLER_NOT_FOUND', 6],
		'401'		=> ['AUTHENTICATION_FAILED', 3],
	);

	//protected $timeout_request =30;	// some methods are very long to answer, ie ApiSetMonitServiceStart

	// ############################################################################################
	// ## (REQUIRED) OVERRIDEN METHODS ############################################################
	// ############################################################################################


	// -------------------------------------------------------------------------
	/**
	 * Log in to the device API and set $this->is_logged when successful.
	 *
	 * @param string $user	Optional username override
	 * @param string $password	Optional password override
	 * @return bool
	 */
	public function ApiLogin($user='',$password=''){
		$this->DebugLogMethod();
		// Maybe we dont need to login first because Authentication is used in each Call
		$this->is_logged=true;
		return true;
	}

	// ############################################################################################
	// ## (Optional) OVERRIDEN STANDARDISED METHODS ##############################################
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
*/

	// -------------------------------------------------------------------------
	/**
	 * Ask the device to reboot.
	 *
	 * @return bool
	 */
	public function ApiReboot(){
		$this->DebugLogMethod();
		return $this->ApiSetCoreSystemReboot();
	}
	
/*
	// -------------------------------------------------------------------------
	public function ApiCellStatus($fast_mode=false){
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
	public function ApiSmsListReceived($read_type=0, $page=1, $limit=20){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiWifiListClients($id=''){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiWifiListSsids($only_enabled=false){
		$this->DebugLogMethod();
	}

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
	/**
	 * GET an API endpoint and return a decoded/error-checked result.
	 *
	 * @param string $endpoint	Endpoint path
	 * @param array|string $params	Query params
	 * @return mixed
	 */
	public function CallApiGet($endpoint, $params=array()){
		return $this->CallApi($endpoint, $params, 'GET');
	}

	// -------------------------------------------------------------------------
	/**
	 * POST to an API endpoint and return a decoded/error-checked result.
	 *
	 * @param string $endpoint	Endpoint path
	 * @param array|string $params	Body/params
	 * @return mixed
	 */
	public function CallApiPost($endpoint, $params=array()){
		return $this->CallApi($endpoint, $params, 'POST');
	}

	// -------------------------------------------------------------------------
	/** Non-JSON body (CSV/image/text/binary) — opaque envelope, no json_decode. */
	public function CallApiGetRaw($endpoint, $params=array()){
		return $this->CallApiRaw($endpoint, $params, 'GET');
	}

	// -------------------------------------------------------------------------
	/**
	 * POST an endpoint and return a Raw envelope (no JSON decode).
	 *
	 * @param string $endpoint	Endpoint
	 * @param array $params	Body params
	 * @return array
	 */
	public function CallApiPostRaw($endpoint, $params=array()){
		return $this->CallApiRaw($endpoint, $params, 'POST');
	}

	// -------------------------------------------------------------------------
	/**
	 * GET raw then ParseCsvBody with device $csv_delimiter / $csv_eol.
	 * @return array Raw envelope + 'rows' (list of field lists), or false on transport fail
	 */
	public function CallApiGetCsv($endpoint, $params=array()){
		$env=$this->CallApiGetRaw($endpoint, $params);
		if(!is_array($env) || empty($env['ok'])){
			return false;
		}
		$env['rows']=$this->ParseCsvBody(isset($env['body']) ? $env['body'] : '');
		return $env;
	}

	// -------------------------------------------------------------------------
	/**
	 * Transport + decode wrapper for this device.
	 *
	 * @param string $endpoint	Endpoint
	 * @param array $params	Params
	 * @return mixed
	 */
	public function CallApi($endpoint, $params=array(), $type='GET'){
		$this->DebugLogMethod();

		$result=$this->_CallApiTransport($endpoint, $params, $type);
		$arr=json_decode($result,true); // object
		
		$arr=$this->ErrorFreeResult($arr);
		return $arr;
	}

	// -------------------------------------------------------------------------
	/**
	 * Transport wrapper returning a Raw envelope (no JSON decode).
	 *
	 * @param string $endpoint	Endpoint
	 * @param array $params	Params
	 * @return array
	 */
	public function CallApiRaw($endpoint, $params=array(), $type='GET'){
		$this->DebugLogMethod();
		$result=$this->_CallApiTransport($endpoint, $params, $type);
		return $this->MakeRawResultEnvelope($result);
	}

	// -------------------------------------------------------------------------
	/**
	 * Shared HTTP transport for OPNsense CallApi / CallApiRaw.
	 *
	 * @param string $endpoint	Endpoint
	 * @param array $params	Params
	 * @return string|false
	 */
	private function _CallApiTransport($endpoint, $params=array(), $type='GET'){
		$endpoint=$this->def_endpoint.$endpoint;
		if(is_array($params) && count($params)){
			$endpoint.='/'.implode('/',$params);
		}

		$this->SetAuthorizationHeader($this->user, $this->password);
		return $this->CallEndpoint($endpoint, $type);
	}

	// -------------------------------------------------------------------------
	/**
	 * Validate a decoded result and map device errors into last_error.
	 *
	 * @param mixed $arr	Decoded payload
	 * @return mixed
	 */
	protected function ErrorFreeResult($arr=''){

		if(is_array($arr)){
			$yes_status=array('active','done','ok','ready','running','OK');
			$no_status=array('disabled','failed','stopped','Error (1)');
			$res_keys=array('status','result','response');
			foreach($res_keys as $k){
				if( isset($arr[$k]) and (count($arr)==1 or (count($arr)==2 and isset($arr['widget']) )) ){
					if(in_array(trim($arr[$k]), $yes_status)){
						$this->DebugLogInfo("TRUE was guessed from: '$k'=>'{$arr[$k]}' ");
						return true;
					}
					elseif(in_array(trim($arr[$k]), $no_status)){
						$this->DebugLogInfo("FALSE was guessed from: '$k'=>'{$arr[$k]}' ");
						return false;
					}
					elseif(isset($arr['status'])){
						//$this->DebugLogError("Can't guess this answer status : ", $arr );
						$this->SetApiErrorCode($arr['status'],$arr['message'],$arr);
					}
				}
			}
			//$this->SetError(0,'answer is a valid array, but empty');
			return $arr;
		}
		else{
			$this->SetError(0,'Result is not an array!');
			$this->DebugLogError("Result is not an array! Raw result is: $arr");
		}
		return false;
	}

}
?>