<?php
/*
--------------------------------------------------------------------------------------------------------------------------------------
HackApi main Class
--------------------------------------------------------------------------------------------------------------------------------------
Copyright (C) 2023  by François Déchery - https://github.com/soif/

HackApi is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

HackApi is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
--------------------------------------------------------------------------------------------------------------------------------------
*/
class Hackapi{
	private		$version			='1.00'; 	// HackApi Version

	// host and credentials ----------- 
	protected	$host				="";		// (default) ip address or hostname
	protected	$use_ssl			=false;		// (default) use httpS ?
	protected	$user				="admin";	// (default) user name
	protected	$password			="";		// (default) user password
	private		$preferences		=false; 	// an array holding the above or FALSE when not set 

	protected	$client_version		='0.00';	// API client Version, formated as M.mm

	protected	$use_cookies		=true;		// do we automatically handles cookies?
	protected	$def_referer		='';		// when set, default referer URL to add in the default headers. Starts with "/";
	protected	$def_endpoint		='';		// default enpoint to use when not set in the CallEndpoint method
	protected	$def_headers		=array();	// default headers to send with each call
	protected	$def_params			=array();	// default parameters to always add in the CallEndpoint method

	protected	$is_logged			=false;		// Are we logged in ?
	protected	$last_call			=array();	// contains all the Last Call parameters.
	protected	$last_error			=array();	// contains the latest errors

	protected	$api_error_codes	=array();	// Populated with Api specific error api_code=>['DESCPRITION',error_code]

	private		$error_codes		=array(		// error codes meaning
		0 =>'Returned False (No Error)',
		1 =>'Malformed Request',
		2 =>'Malformed Answer',
		3 =>'Permission Issue',
		4 =>'Exception thrown',
		5 =>'Unexpected Error',
		6 =>'Unimplemented Method/Endpoint',
		7 =>'API Error',
		8 =>'API Error (not mapped)',
	);

	private		$min_apimethod_state=5;			// Minimum allowed method dev state. Method with a lower state will throw an Exception

	private		$debug_level		=0;			// Debug Level: 0= no debug, 1=Error, 2 =+Info, 3=+Debug 4=+verbose
	private		$debug_output		=0;			// Debut Output: 0=None, 1=print

	private		$cookies_file		="/tmp/cookies_Hackapi"; // file where cookies are stored 
	private		$base_url			="";		// the base url made of http(s)://host

	private		$timeout_connect	=2;			// CURL's Connection Timeout (sec)
	private		$timeout_request	=5;			// CURL's Request Timeout (sec)

	private		$_relogin_count		=0;			// used to prevent infinite Loop when using CallEndpointWhenLogged in the ApiLogin method
	private		$_relogin_max		=3;			// max count to try to relogin (when in an infinite loop condition)

	
	/**
	 * an array (indexed by the standard method name) of fields mapping between the Standard expected fields and the API returnted fields.
	 * 'to_field' => 'from_field' .Both to/from fields may be hierarchized by '/. ie: 'lan/ip' means $arr['lan']['ip'] )
	 *
	 * @var array
	 */
	protected $std_fields_map=array(
		'ApiCellStatus'=>array(
			'prov_name'		=> 'api_field_path',	// Provider Name
			'prov_fullname'	=> 'api_field_path',	// Provider Full Name
			'mcc'			=> 'api_field_path',	// MCC
			'mnc'			=> 'api_field_path',	// MNC
			'rnc'			=> 'api_field_path',	// RNC
			'enbid'			=> 'api_field_path',	// eNB ID
			'lac'			=> 'api_field_path',	// LAC
			'rat'			=> 'api_field_path',	// RAT
			'tac'			=> 'api_field_path',	// TAC
			'channel'		=> 'api_field_path',	// Channel (EARFCN)
			'bands'			=> 'api_field_path',	// Bands
			'pci'			=> 'api_field_path',	// PCI
			'mode'			=> 'api_field_path',	// Cellular network type: LTE,CMDA,...
			'protocol'		=> 'api_field_path',	// Protocol
			'imei'			=> 'api_field_path',	// IMEI
			'imci'			=> 'api_field_path',	// IMCI
			'iccid'			=> 'api_field_path',	// Sim ICCI
			'imsi'			=> 'api_field_path',	// Sim IMSI
			'msisdn'			=> 'Msisdn',		// Sim Phone Number

			'strength'		=> 'api_field_path',	// (%) Strength
			'csq'			=> 'api_field_path',	// CSQ
			'rssi'			=> 'api_field_path',	// (dBm) RSSI
			'rscp'			=> 'api_field_path',	// (dBm) RSCP
			'rsrp'			=> 'api_field_path',	// (dBm) RSRP
			'ecio'			=> 'api_field_path',	// (dB) ECIO
			'rsrq'			=> 'api_field_path',	// (dB) RSRQ
			'sinr'			=> 'api_field_path',	// (dB) SINR
			'cell_id'		=> 'api_field_path',	// Cell ID
			'rx_speed'		=> 'api_field_path',	// (Kbytes/sec) Download Speed
			'tx_speed'		=> 'api_field_path',	// (Kbytes/sec) Upload Speed

		),
		'ApiSmsList'=>array(
			'id'	=> 'api_field_path',			// SMS's ID (the one used to delete the SMS)
			'date'	=> 'api_field_path',			// SMS's Date, formated as a SQL datetime (YYYY-MM-DD HH:MM:SS)
			'phone'	=> 'api_field_path',			// SMS's Phone Number
			'text'	=> 'api_field_path',			// SMS's Text Content
		),
		'ApiWanStatus'=>array(
			'mac'			=> 'api_field_path',	// MAC address
			'up'			=> 'api_field_path',	// (boolean) Are we connected ?
			'since'			=> 'api_field_path',	// Seconds since we are connected
			'ipv4'			=> 'api_field_path',	// IP address (v4)
			'ipv6'			=> 'api_field_path',	// IP address (v6)
			'dns1v4'		=> 'api_field_path',	// DNS Server 1 IP address (v4)
			'dns2v4'		=> 'api_field_path',	// DNS Server 2 IP address (v4)
			'dns1v6'		=> 'api_field_path',	// DNS Server 1 IP address (v6)
			'dns2v6'		=> 'api_field_path',	// DNS Server 2 IP address (v6)
			'gatewayv4'		=> 'api_field_path',	// Gateway IP address (v4)
			'gatewayv6'		=> 'api_field_path',	// Gateway IP address (v6)
			'rx_realtime'	=> 'api_field_path',	// (bytes) Realtime RX 
			'rx_peak'		=> 'api_field_path',	// (bytes) Peak RX 
			'rx_day'		=> 'api_field_path',	// (bytes) Daily RX 
			'rx_month'		=> 'api_field_path',	// (bytes) Monthly RX 
			'rx_total'		=> 'api_field_path',	// (bytes) Total RX 
			'tx_realtime'	=> 'api_field_path',	// (bytes) Realtime TX 
			'tx_peak'		=> 'api_field_path',	// (bytes) Peak TX 
			'tx_day'		=> 'api_field_path',	// (bytes) Daily TX 
			'tx_month'		=> 'api_field_path',	// (bytes) Monthly TX 
			'tx_total'		=> 'api_field_path',	// (bytes) Total TX 
		),
		'ApiWifiListClients'=>array(
			'id'			=> 'api_field_path',	// the internal ID asigned by the device (else set it to the MAC address)
			'mac'			=> 'api_field_path',	// MAC address
			'ipv4'			=> 'api_field_path',	// IP address (v4)
			'ipv6'			=> 'api_field_path',	// IP address (v6)
			'dns_name'		=> 'api_field_path',	// DNS host name
			'name'			=> 'api_field_path',	// host name (usually sent by client)
			'alias'			=> 'api_field_path',	// friendly host name (user-defined in the device)
			'time'			=> 'api_field_path',	// (unix time) Date when the client has been connected
			'duration'		=> 'api_field_path',	// (sec) How long the client has been connected
			'level_send'	=> 'api_field_path',	// (db) Send Level
			'level_receive'	=> 'api_field_path',	// (db) Receive Level
		),
		'ApiWifiListSsids'=>array(
			'id'			=> 'api_field_path',	// the internal Station ID/name asigned by the device (used to filter the ApiWifiListClients)
			'bssid'			=> 'api_field_path',	// BSSID MAC Address
			'ssid'			=> 'api_field_path',	// SSID MAC Address
			'password'		=> 'api_field_path',	// Password
			'enabled'		=> 'api_field_path',	// Is enabled ? (true|false)
			'channel'		=> 'api_field_path',	// Frequency Channel
			'mode'			=> 'api_field_path',	// Wifi Mode (11xxx)
		),
	);


	// ############################################################################################

	// -------------------------------------------------------------------------
	public function __construct(){
		$this->LoadDefaults();
		$this->SetHost($this->host,$this->use_ssl);
		$this->SetCookiePath();
	}


	// ############################################################################################
	// ## METHODS TO OVERRIDE (REQUIRED) ##########################################################
	// ############################################################################################

	// -------------------------------------------------------------------------
	/**
	 * Log-in into the API. It must set $this->is_logged to TRUE, when succeeded
	 *
	 * @param string $user		(optionnal) Forces User name  (else $this->user is used)
	 * @param string $password	(optionnal) Forces User password  (else $this->password is used) 
	 * @return bool				Is Logged-in or not?
	 */
	public function ApiLogin($user='',$password=''){
		$this->DebugLogError("Please override the ".__METHOD__." method. It shoud set the '\$this->is_logged' property to TRUE!");
		$this->is_logged=true;
	}


	// ############################################################################################
	// ## STANDARDIZED METHODS TO OVERRIDE (Optionnal) ############################################
	// ############################################################################################

	// -------------------------------------------------------------------------
	/**
	 * Log-out of the API. It must set $this->is_logged to FALSE, when succeeded
	 *
	 * @return bool				Is Logged-out or not?
	 */
	public function ApiLogout(){
		$this->DebugLogError("Please override the ".__METHOD__." method. It shoud set the '\$this->is_logged' property to FALSE!");
		$this->is_logged=false;
	}

	// -------------------------------------------------------------------------
	/**
	 * Asks API if we are logged-in or Not
	 *
	 * @return bool		Are we logged-in of not?
	 */
	public function ApiIsLoggedIn(){
		$this->DebugLogInfo("No Api call performed,  this only from the class property 'is_logged'. You'd better have to Call the API if you can grab this state");
		return $this->is_logged;
	}

	// -------------------------------------------------------------------------
	/**
	 * Reboot the device
	 *
	 * @return bool		Succeeded ?
	 */
	public function ApiReboot(){
		$this->DebugLogError("Please override the ".__METHOD__." method.");
		return true;
	}


	// for Cellullar Modems #############################################################

	// -------------------------------------------------------------------------
	/**
	 * Cellular modems Status & Information
	 *
	 * @param boolean $fast_mode	Require only minimum info needed to quicky point an Antenna, whenever the API requires multiple (slow) calls to get the full information
	 * @return array		Basic Cell & signal information
	 */
	public function ApiCellStatus($fast_mode=false){
		$this->DebugLogError("Please override the ".__METHOD__." method.");
	}

	// -------------------------------------------------------------------------
	/**
	 * Returns a standardized array of Received SMS
	 *
	 * @param integer $read_type	0=all, 1=read, 2=unread
	 * @param integer $page			Page to start at (1 to n)
	 * @param integer $limit		Max messages per page
	 * @return array 				Array  of sms, sorted by date DESC
	 */
	public function ApiSmsListReceived($read_type=0, $page=1, $limit=20){
		$this->DebugLogError("Please override the ".__METHOD__." method. It should returns an array of message  (or false), date DESC sorted");
	}

	// -------------------------------------------------------------------------
	/**
	 * Returns a standardized array of Sent SMS
	 *
	 * @param integer $page	Page to start at (1 to n)
	 * @param integer $max	Max messages per page
	 * @return array 		Array  of sms, sorted by date DESC
	 */
	public function ApiSmsListSent($page=1,$max=20){
		$this->DebugLogError("Please override the ".__METHOD__." method. It should returns an array of message  (or false), date DESC sorted");
	}

	// -------------------------------------------------------------------------
	/**
	 * Send an SMS
	 *
	 * @param string $phone	 	Recipient Number formated as local or international phone number 	
	 * @param string $message	Message to send
	 * @param string $priority	(Not Implemented)
	 * @return bool				
	 */
	public function ApiSmsSend($phone, $message, $priority=''){
		$this->DebugLogError("Please override the ".__METHOD__." method. ");
	}
	
	// for Routers & Modems #############################################################

	// -------------------------------------------------------------------------
	/**
	 * Disconnect the WAN interface
	 *
	 * @return bool		Succeeded ?
	 */
	public function ApiWanConnect(){
		$this->DebugLogError("Please override the ".__METHOD__." method.");
	}

	// -------------------------------------------------------------------------
	/**
	 * Connect the WAN interface
	 *
	 * @return bool		Succeeded ?
	 */
	public function ApiWanDisconnect(){
		$this->DebugLogError("Please override the ".__METHOD__." method.");
	}

	// -------------------------------------------------------------------------
	/**
	 * WAN interface Status & Information
	 *
	 * @return array		Basic WAN information & Stats
	 */
	public function ApiWanStatus(){
		$this->DebugLogError("Please override the ".__METHOD__." method.");
	}

	// -------------------------------------------------------------------------
	/**
	 * Reload the WAN interface. (ie refresh the WAN IP address)
	 *
	 * @return bool		Succeeded ?
	 */
	public function ApiWanReload(){
		$this->ApiWanDisconnect();
		sleep(1);
		return $this->ApiWanConnect();
	}


	// for Wifi capable Routers #########################################################

	// -------------------------------------------------------------------------
	/**
	 * List Wifi Clients
	 *
	 * @param string $id	The Station ID to filter by
	 * @return array		An array indexed by Station (ssid) id of client arrays,  or an array of client arrays (if $id is set)
	 */
	public function ApiWifiListClients($id=''){
		$this->DebugLogError("Please override the ".__METHOD__." method. It should returns an array ( indexed by id) of arrays of connected wifi stations,");
	}

	// -------------------------------------------------------------------------
	/**
	 * List Wifi Station
	 *
	 * @param string $id	Station Id
	 * @return void 		An array of Stations, or one Station (when $id is set)
	 */
	public function ApiWifiListSsids($id=''){
		$this->DebugLogError("Please override the ".__METHOD__." method. It should returns an array ( indexed by id) of arrays of SSIDs available,");
	}

	// -------------------------------------------------------------------------
	/**
	 * Turn Wifi ON
	 *
	 * @return bool				Succeeded ?
	 */
	public function ApiWifiStart(){
		$this->DebugLogError("Please override the ".__METHOD__." method. ");
	}

	// -------------------------------------------------------------------------
	/**
	 * Turn Wifi OFF
	 *
	 * @return bool				Succeeded ?
	 */
	public function ApiWifiStop(){
		$this->DebugLogError("Please override the ".__METHOD__." method. ");
	}




	
	// ############################################################################################
	// ## OUR METHODS  ############################################################################
	// ############################################################################################

	// -------------------------------------------------------------------------
	public function SetHost($ip_or_hostname, $use_ssl=false){
		$ip_or_hostname and $this->host=$ip_or_hostname;
		$use_ssl ?  $scheme="https://" : $scheme="http://";

		$this->use_ssl=$use_ssl;
		$this->base_url=$scheme.$ip_or_hostname;
		$this->def_referer and $this->def_headers[]="Referer: {$this->base_url}{$this->def_referer}";
	}

	// -------------------------------------------------------------------------
	public function SetLogin($user, $password=''){
		$this->user		=$user;
		$this->password	=$password;
	}

	// -------------------------------------------------------------------------
	public function SetCookiePath($path='/tmp/'){
		// TODO: Default works on linux and OSX... should may be changed for Windows 
		$path or $path="/tmp/";
		$cleanip=preg_replace('#[:]+#',',',$this->_GetClientIP()); // clean if ipv6
		
		$path .="cookies_".get_class($this).'_to-'.$this->host.'_from-'.$cleanip;
		$this->cookies_file=$path;
		
		@touch($path);
		@chmod($path,0666);	
	}


	// -------------------------------------------------------------------------
	public function SetDebug($level, $output_mode=0){
		$this->debug_level	=$level;
		$this->debug_output	=$output_mode;
	}

	// -------------------------------------------------------------------------
	public function GetLastCall(){
		return $this->last_call;
	}

	// -------------------------------------------------------------------------
	public function GetPreferences(){
		return $this->preferences;
	}

	// -------------------------------------------------------------------------
	public function ResetLastError(){
		$this->last_error='';
	}

	// -------------------------------------------------------------------------
	public function GetLastError(){
		return $this->last_error;
	}

	// -------------------------------------------------------------------------
	/**
	 * Set Error Code
	 *
	 * @param integer $code 		Code Number: 
	 * 	0 =>'Returned False (No Error)',
	 * 	1 =>'Malformed Request',
	 * 	2 =>'Malformed Answer',
	 * 	3 =>'Permission Issue',
	 * 	4 =>'Exception thrown',
	 * 	5 =>'Unexpected Error',
	 * 	6 =>'Unimplemented method/endpoint',
	 * 	7 =>'API (known) Error',

	 * @param string $message Optionnal message
	 * @return void
	 */
	protected function SetError($code, $message=''){
		if(isset($this->error_codes[$code])){
			$this->last_error['code']		=$code;
			$this->last_error['code_txt']	=$this->error_codes[$code];
			$message and $this->last_error['mess']=$message;
			return true;
		}
		$this->DebugLogError("$code is not a valid error code");
	}

	// -------------------------------------------------------------------------
	public function GetErrorDesc($err_code){
		return $this->error_codes[$err_code];
	}

	// -------------------------------------------------------------------------
	protected function SetCallError($key='',$txt=''){
		$cu=$this->GetLastCall();
		$this->_SetCategError('call','http_code',	$cu['http_code']);
		$this->_SetCategError('call','err_code',	$cu['err_code']);
		$this->_SetCategError('call','err_txt',		$cu['err_txt']);
		if($txt){
			$this->_SetCategError('call', $key,		$txt);
		}
	}

	// -------------------------------------------------------------------------
	protected function SetXmlError($key='',$txt){
		$this->_SetCategError('xml',$key,$txt);
	}

	// -------------------------------------------------------------------------
	protected function SetApiErrorCode($code,$message='',$result=''){
		if(isset($this->api_error_codes[$code])){
			$code_txt=$this->api_error_codes[$code][0];
			if(!isset($this->last_error['code']) and isset($this->api_error_codes[$code][1])){
				$this->SetError($this->api_error_codes[$code][1]);
			}
		}
		else{
			if(!isset($this->last_error['code'])){
				$this->SetError(5);
				if($result){
					$this->SetCallError('result',$result);
				}
			}
			$code_txt="Undocumented API code '$code'";
			$this->DebugLogError("$code_txt - $message",$result);
		}

		$this->_SetCategError('api','code',		$code);
		$this->_SetCategError('api','code_txt',	$code_txt );
		$message and $this->_SetCategError('api','mess',	$message);
		if(isset($this->api_error_codes[$code])){
			return true;
		}
	}

	// -------------------------------------------------------------------------
	protected function SetApiError($key='',$txt){
		$this->_SetCategError('api',$key,$txt);
	}

	// -------------------------------------------------------------------------
	private function _SetCategError($category,$key='',$txt){
		if(!$txt and !$key){
			$this->DebugLogError("Emply error message");
			return false;
		}
		if(!isset($this->last_error['code'])){
			$this->SetError(5);
		}

		if(!isset($this->last_error[$category])){
			$this->last_error[$category]=array();
		}

		if($key){
			$this->last_error[$category][$key]=$txt;
		}
		else{
			$this->last_error[$category][]=$txt;
		}
		$this->DebugLogVerbose("$category error set to: $key -> ",$txt);
		return true;
	}

	// -------------------------------------------------------------------------
	protected function GetTimeMs(){
		return round(microtime(true)*1000,0);
	}

	// -------------------------------------------------------------------------
	public function SetApiMethodMinStateAllowed($state=5){
		$this->min_apimethod_state=$state;
	}

	// -------------------------------------------------------------------------
	protected function HandleApiMethodStateAllowed($state=5){
		if($state < $this->min_apimethod_state){
			$err=500+$state;
			throw new Exception("This method with a state of $state is considered UNSTABLE. You can use it at you own risk by setting the 'SetApiMethodMinStateAllowed' to a lower value (currently {$this->min_apimethod_state} ) ",$err);			
		}
	}

	// -------------------------------------------------------------------------
	protected function LoginIfNotAlready(){
		$this->DebugLogMethod();
		if(!$this->is_logged){
			// prevents infinite Loop when using CallEndpointWhenLogged in the ApiLogin method
			$this->_relogin_count++;
			if($this->_relogin_count > $this->_relogin_max){
				$this->DebugLogError("Preventing Login Loop (after {$this->_relogin_max} tries).");
				$this->DebugLogError("Your code is certainly using CallEndpointWhenLogged from the ApiLogin method, or something like this...");
				return false;
			}
			$this->ResetLastError();
			if(!$this->ApiLogin()){
				$this->DebugLogError('Failed to Login');
				return false;
			}
		}
		return true;
	}

	// -------------------------------------------------------------------------
	public function CallEndpointWhenLogged($endpoint='',$method='GET',$params=array(), $headers=array(), $with_def_params=true ,$with_def_headers=true){
		$this->DebugLogMethod();

		if(!$this->LoginIfNotAlready()){
			return false;
		}
		return $this->CallEndpoint($endpoint,$method,$params, $headers, $with_def_params,$with_def_headers);		
	}

	// -------------------------------------------------------------------------
	public function CallEndpoint($endpoint='',$method='GET',$params=array(), $headers=array(), $with_def_params=true ,$with_def_headers=true){
		$this->DebugLogMethod();

		$this->ResetLastError();
		//set endPoint
		$endpoint 	or $endpoint=$this->def_endpoint;

		// set url
		$url=$this->base_url.$endpoint;

		// Set params 
		//is_array($params) or $params=array();
		if(is_array($params) and $with_def_params){
			$params=array_merge($this->def_params,$params);	
		}

		// Set headers 
		is_array($headers) or $headers=array();
		if($with_def_headers){
			$headers=array_merge($this->def_headers,$headers);	
		}

		return $this->_call($url,$method,$params,$headers,$with_def_params, $with_def_headers);
	}

	// -------------------------------------------------------------------------
	public function GetCookies(){
		$out=false;
		if(file_exists($this->cookies_file)){
			$lines= file($this->cookies_file);
			foreach($lines as $line){
				if(preg_match('/^# |^$/',$line)){
					continue;
				}
				if(preg_match('#\w+\s+\w+\s+/\s+\w+\s+\d+\s+(\w+)\s+(\w+)#',$line,$m)){
					$out[$m[1]]=$m[2];
				}
			}		
		}
		return $out;
	}

	// -------------------------------------------------------------------------
	protected function CurlHandleHeaderLine( $curl, $header_line ) {
		$this->last_call['resp_headers'][]=trim($header_line);
		//curl need this
		return strlen($header_line);
	}

	// -------------------------------------------------------------------------
	protected function LoadDefaults(){
		$default_file=$this->_GetClassChildPath().'defaults.php';
		$def=array();				
		$from_file=0;
		$prefs=array();
		if(file_exists($default_file)){
			// we expect a '$prefs' array
			include($default_file);
			$from_file=1;				
		}
		$this->_SetPreferences($prefs,$from_file);

	}
	
	// -------------------------------------------------------------------------
	private function _SetPreferences($prefs, $from_file=false) {
		$this->preferences=array();
		$to_set=array('host','use_ssl','user','password');
		foreach($to_set as $t){
			isset($prefs[$t]) and $this->$t=$prefs[$t];
			$this->preferences[$t]=$this->$t;
		}
		$this->preferences['from_default_file']=(int) $from_file;
	}

	// -------------------------------------------------------------------------
	protected function SetAuthorizationHeader($username,$password=''){
		$hash=$username;
		$password and $hash.=":".$password;
		$hash=base64_encode($hash);
		$this->def_headers[]="Authorization: Basic $hash";
	}

	// -------------------------------------------------------------------------
	private function _call($url,$post=0,$params = array() ,$headers= array()) {
		$this->DebugLogMethod();
		$this->last_call=array();

		if(is_array($params)){
			$query=http_build_query($params);
		}
		else{
			$query=$params;
		}

		$ch = curl_init();
	
		if ($post=='POST') {
			$method='POST';
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		}	
		elseif($post=='GET'){
			$method='GET';
			if($query){
				$sep='?';
				if(strpos($url,'?')){
					$sep='&';
				}
				$url .= $sep.$query;
			}
		}
		curl_setopt($ch, CURLOPT_URL, 				$url);	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,	true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,	true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,	 	$headers);
		curl_setopt($ch, CURLOPT_HEADER, 			false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,	false);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,	false);
		curl_setopt($ch, CURLINFO_HEADER_OUT,		true);
		if($this->use_cookies){
			curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies_file);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies_file);	
		}

		curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this, 'CurlHandleHeaderLine'));
	
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,	$this->timeout_connect);
		curl_setopt($ch, CURLOPT_TIMEOUT, 			$this->timeout_request);
		//curl_setopt($ch,CURLOPT_ENCODING , "gzip"); //The router is fine with this, so no problem.		
		//curl_setopt($ch, CURLOPT_USERAGENT, '');

		
		$this->last_call['method']		=$method;
		$this->last_call['url']			=$url;
		if(is_array($params) and $method=='GET'){
			$this->last_call['query']		=$query;
		}
		else{
			$this->last_call['params']		=$params;
		}
		$this->last_call['req_headers']		=$headers;
		$this->last_call['cookies_file']=$this->cookies_file;
		$this->last_call['cookies']		=$this->GetCookies();

		// execute -----------------
		$r = curl_exec($ch);
		$err_txt='';
		if ($err_num=curl_errno($ch)){
			$err_txt=curl_error($ch);
		}
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_info = curl_getinfo($ch);
		
		curl_close($ch);

		$this->last_call['http_code']	=$http_code;
		$this->last_call['err_code']	=$err_num;
		$this->last_call['err_txt']		=$err_txt;
		$this->last_call['result']		=$r;
		if(!$err_num){
			$this->DebugLogVerbose('Last Call',$this->last_call);
		}
		$this->last_call['curl_info']	=$curl_info;
		if($err_num){
			$this->DebugLogError('Last Call failed',$this->last_call);
		}
		return $r;	
	}

	// ################################################################################################
	// ### Utility Methods ############################################################################
	// ################################################################################################

	// --------------------------------------------------
	protected function RemapFieldsList($rows,$map,$use_raw=true){
		if(is_array($rows)){
			foreach($rows as $r => $row){
				$rows[$r]=$this->RemapFields($row,$map,$use_raw);
			}
		}
		return $rows;
	}

	// --------------------------------------------------
	protected function RemapFields($row, $map='ApiSmsList', $use_raw=true){
		if(is_array($row) and $map=$this->std_fields_map[$map]){
			$out=array();
			foreach($map as $to =>$from){
				$val=$this->_ArrayGetFromPath($row,$from);
				$out[$to]=$val;
				$this->_ArraySetFromPath($row,$from);
			};
			if($use_raw and count($row)){
				$out['raw']=$row;
			}
			return $out;
		}
		return $row;
	}

	// --------------------------------------------------
	private function _ArraySetFromPath(&$array, $path, $value='unset()', $sep='/'){
		if(!is_array($path)){
			$path=explode($sep,$path);
			if(!is_array($path)){
				return false;
			}
		}
		$key = array_shift($path);
		if (empty($path)) {
			if($value=='unset()'){
				unset($array[$key]);
			}
			else{
				$array[$key] = $value;
			}
		} 
		else {
			if (!isset($array[$key]) || !is_array($array[$key])) {
				$array[$key] = array();
			}
			$this->_ArraySetFromPath($array[$key], $path, $value, $sep);
		}
	}

	// --------------------------------------------------
	private function _ArrayGetFromPath($array, $path ,$sep="/") {
		$path = explode($sep, $path); //if needed
		$temp =& $array;

		foreach($path as $key) {
			$temp =& $temp[$key];
		}
		return $temp;
	}

	// -------------------------------------------------------------------------
	protected function DebugLogMethod($level=2){
		$txt=str_pad('START ',80,'+');
		$this->DebugLine($level,$txt);
	}

	// -------------------------------------------------------------------------
	protected function DebugLogError($txt,$array=null){
		$this->DebugLine(1,$txt,$array);
	}

	// -------------------------------------------------------------------------
	protected function DebugLogInfo($txt,$array=null){
		$this->DebugLine(2,$txt,$array);
	}

	// -------------------------------------------------------------------------
	protected function DebugLogDebug($txt,$array=null){
		$this->DebugLine(3,$txt,$array);
	}

	// -------------------------------------------------------------------------
	protected function DebugLogVerbose($txt,$array=null){
		$this->DebugLine(4,$txt,$array);
	}

	// -------------------------------------------------------------------------
	protected function DebugLine($level,$txt,$array=null){
		$levels=array(
			'1'	=> 'ERROR',
			'2'	=> 'INFO ',
			'3'	=> 'DEBUG',
			'4'	=> 'VERBO',
		);
		$arr_txt=$this->PrettifyArray($array);
		if(is_array($array)){
			$arr_txt=" - ARRAY: \n$arr_txt";
		}
		elseif($arr_txt !== null){
			$arr_txt=" - (STRING): $arr_txt";
		}

		$back	=2;
		$bt		=debug_backtrace(0,$back + 1);	
		$class	=$bt[$back]['class'];
		$func	=$bt[$back]['function'];
		$method	=str_pad("$class/$func",35);

		$sep=" ";
		$line='+debug+ ';
		$line.=str_pad(date('H:i:s.') . gettimeofday()['usec'], 15) .$sep;
		$line.=$levels[$level]	.$sep;		
		$line.=$method.$sep.":".$sep;	
		$line.=$txt;
		$line.=$arr_txt;
		$line.="\n";
		$out='';
		if($level <= $this->debug_level){
			$out=$line;
		}
		if($out and $this->debug_output > 0 ){
			echo $out;
		}
	}

	// -------------------------------------------------------------------------
	public static function PrettifyArray($array){
		if(!is_array($array)){
			return $array;
		}
		$txt=print_r($array,true);
		$txt=preg_replace('#^Array\n#',	'',$txt);
		$txt=preg_replace('#=>\s+Array\s*\(#',	"ARRAY:",$txt);
		$txt=preg_replace('#^\s*\(\s*\n#m',		"",$txt);
		$txt=preg_replace('#^\s*\)\s*\n#m',		"",$txt);
		//$txt=preg_replace('#^\s{2}#m',		'',$txt);
		return $txt;
	}

	// -------------------------------------------------------------------------
	protected function XmlToArray($xml){
		$out=false;
		try {
			$obj = new SimpleXMLElement($xml, LIBXML_NOERROR);
			$out=(array) json_decode(json_encode($obj), true);
		}
		catch(Exception $e){
			$this->SetError(4, $e->getMessage());
			$this->SetCallError();
			$this->SetXmlError('input',$xml);
		}
		return $out;
	}
/*
	// -------------------------------------------------------------------------
	protected function ObjectToArray($obj){
		$this->DebugLogVerbose('Converting obj2arr...');
		// Not an object or array
		if (!is_object($obj) && !is_array($obj)) {
			return $obj;
		}

		// Parse array
		$arr=array();
		foreach ($obj as $key => $value) {
			$arr[$key] = $this->ObjectToArray($value);
		}
		return $arr;
	}
*/
	// -------------------------------------------------------------------------
	protected function ObjectToArray($object_or_array){
		if(!is_object($object_or_array) && !is_array($object_or_array)){
			return $object_or_array;
		}
		// php I love you ! ;-)
		//$this->DebugLogVerbose('Converting...');
		return json_decode(json_encode($object_or_array), true);
	}

	// -------------------------------------------------------------------------
	protected function ArrayToXml($array,$container='', $head='<?xml version="1.0" encoding="UTF-8"?>'){
		if(is_array($array)){
			$out=$head;
			$container and $out .="<$container>";
			foreach($array as $k => $v){
				$out .="<$k>$v</$k>";
			}
			$container and $out .="</$container>";
		}
		else{
			$out=$array;
		}
		return $out;
	}

	// -------------------------------------------------------------------------
	protected function CleanEmptyArrays($array){
		// ie: huawei API is dumb enough to sometime return empty arrays instead of a blank of false value whenever a single string would be returned.
		// lets fix this
		if(is_array($array)){
			$this->_cleanEmptyArray($array);
		}
		return $array;
	}

	// -------------------------------------------------------------------------
	private function _cleanEmptyArray( & $value){
		if(is_array($value)){
			if(!count($value)){
				$value='';
			}
			else{
				array_walk($value,array($this,'_cleanEmptyArray'));
			}
		}
		else{
		   // process scalar value
		}
	}

	// -------------------------------------------------------------------------
	private function _GetClassChildPath(){
		$reflection = new ReflectionClass($this); //location of the children class
		return dirname($reflection->getFileName()).'/';
	}

	// -------------------------------------------------------------------------
	private function _GetClientIP() {  
		//ip is from the share internet  
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
				$ip = $_SERVER['HTTP_CLIENT_IP'];  
		}  
		//ip is from the proxy  
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		}
		//ip is from the remote address  
		elseif (!empty($_SERVER['REMOTE_ADDR'])) {  
			$ip = $_SERVER['REMOTE_ADDR'];  
		}
		//ip from linux
		elseif($ifconfig = shell_exec('/sbin/ifconfig eth0')){
			preg_match('#addr:([\d\.]+)#', $ifconfig, $match);
			$ip=$match[1];
		}
		// ip from CLI
		else{
			$ip= gethostname();
			$ip and $ip = gethostbyname($ip);
		}
		return $ip;  
	}

	// -------------------------------------------------------------------------
	public static function RequireTrait($file_path){
		$device_dir=dirname($file_path);
		//include methods from trait (generated from the template)
		if(  file_exists($device_dir.'/trait.php')){
			require_once($device_dir.'/trait.php');
		}
		$name=ucFirst(pathinfo($device_dir, PATHINFO_BASENAME));
		$trait_name="Hackapi_{$name}_Trait";
		if( !trait_exists($trait_name)){
			eval("trait $trait_name {}") ;
		}
	}




	/*
	// -------------------------------------------------------------------------
	public function GetClassMethods(){
		$reflection = new ReflectionClass($this); //location of the children class
		$methods=$reflection->getMethods();
		$out=false;
		if(is_array($methods)){
			foreach($methods  as $arr){
				$out[]=$arr->name;
			}
		}
		return $out;
	}
*/

}
?>