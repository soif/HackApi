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

	protected	$client_version		='0.50';	// API client Version, formated as M.mm

	protected $def_endpoint='/api';

	protected $api_error_codes=array(
		'400'		=> ['CONTROLLER_NOT_FOUND', 6],
		'401'		=> ['AUTHENTICATION_FAILED', 3],
	);


	// ############################################################################################
	// ## (REQUIRED) OVERRIDEN METHODS ############################################################
	// ############################################################################################


	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$this->DebugLogMethod();
		// Maybe we dont need to login first because Authentication is used in each Call
		$this->is_logged=true;
		return true;
	}

	// ############################################################################################
	// ## (Optionnal) OVERRIDEN STANDARDISED METHODS ##############################################
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
	public function CallApiGet($endpoint, $params=array()){
		return $this->CallApi($endpoint, $params, 'GET');
	}

	// -------------------------------------------------------------------------
	public function CallApiPost($endpoint, $params=array()){
		return $this->CallApi($endpoint, $params, 'POST');
	}

	// -------------------------------------------------------------------------
	public function CallApi($endpoint, $params=array(), $type='GET'){
		$this->DebugLogMethod();

		$endpoint=$this->def_endpoint.$endpoint;
		if(is_array($params and count($params))){
			$endpoint.='/'.implode('/',$params);
		}

		$this->SetAuthorizationHeader($this->user, $this->password);
		$result=$this->CallEndpoint($endpoint, $type);
		$arr=json_decode($result,true); // object
		
		$arr=$this->ErrorFreeResult($arr);
		return $arr;
	}

	// -------------------------------------------------------------------------
	protected function ErrorFreeResult($arr=''){

		if(is_array($arr)){
			if( isset($arr['status']) ){
				$valid_status=array('active','disabled','done','failed','ok','ready','running');
				if(in_array($arr['status'], $valid_status)){
					return $arr;
				}
				else{
					$this->SetApiErrorCode($arr['status'],$arr['message'],$arr);
				}
			}
			else{
				//$this->SetError(0,'answer is a valid array, but empty');
				return $arr;
			}
		}
		else{
			$this->SetError(0,'Result is not an array!');
			$this->DebugLogError("Result is not an array! Raw result is: $arr");
		}
		return false;
	}


}
?>