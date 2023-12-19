<?php
//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);

/*
	 Credits:
		https://github.com/if0xx/Huawei-Hilink-API
		https://github.com/pablo/huawei-modem-python-api-client/blob/master/huaweisms/api/common.py
*/

// ###############################################################################################
class Hackapi_Huawei_modem extends Hackapi{
	use Hackapi_Huawei_modem_Trait;

	// Overrides parent's properties ---------------------------------------------------
	protected $host			="192.168.8.1";		// (default) ip address or hostname
	protected $user			="admin";			// (default) user name
	protected $password		="admin";			// (default) user password

	protected	$client_version		='0.90';	// API client Version, formated as M.mm

	protected $use_cookies	=true;
	protected $def_referer	="/html/index.html?noredirect"; // needed ?

	protected $api_error_codes=array(
		'-1'		=> 	['ERROR_DEFAULT',	 			5],
		'-2'		=> 	['ERROR_NO_DEVICE',	 			8],
		'1'			=> 	['ERROR_FIRST_SEND',			8],
		'100001'	=> 	['ERROR_UNKNOWN',	 			7],
		'100002'	=> 	['ERROR_NOT_SUPPORT',	 		6],
		'100003'	=> 	['ERROR_NO_RIGHT',	 			3],
		'100004'	=> 	['ERROR_BUSY',	 				8],
		'100005'	=> 	['ERROR_FORMAT_ERROR',	 		1],		//ie when posted XML parameters are NOT in the EXACT order expected... seriously Huawei?
		'100006'	=> 	['ERROR_PARAMETER_ERROR',		1],
		'100007'	=> 	['ERROR_SAVE_CONFIG_FILE_ERROR',8],
		'100008'	=> 	['ERROR_GET_CONFIG_FILE_ERROR',	8],

		'101001'	=> 	['ERROR_NO_SIM_CARD_OR_INVALID_SIM_CARD',	8],
		'101002'	=> 	['ERROR_CHECK_SIM_CARD_PIN_LOCK',			8],
		'101003'	=> 	['ERROR_CHECK_SIM_CARD_PUN_LOCK',			8],
		'101004'	=> 	['ERROR_CHECK_SIM_CARD_CAN_UNUSEABLE',		8],
		'101005'	=> 	['ERROR_ENABLE_PIN_FAILED',	 				8],
		'101006'	=> 	['ERROR_DISABLE_PIN_FAILED',				8],
		'101007'	=> 	['ERROR_UNLOCK_PIN_FAILED',					8],
		'101008'	=> 	['ERROR_DISABLE_AUTO_PIN_FAILED',			8],
		'101009'	=> 	['ERROR_ENABLE_AUTO_PIN_FAILED',			8],

		'102001'	=> 	['ERROR_GET_NET_TYPE_FAILED',				8],
		'102002'	=> 	['ERROR_GET_SERVICE_STATUS_FAILED',			8],
		'102003'	=> 	['ERROR_GET_ROAM_STATUS_FAILED',			8],
		'102004'	=> 	['ERROR_GET_CONNECT_STATUS_FAILED',			8],

		'103001'	=> 	['ERROR_DEVICE_AT_EXECUTE_FAILED',			8],
		'103002'	=> 	['ERROR_DEVICE_PIN_VALIDATE_FAILED',		8],
		'103003'	=> 	['ERROR_DEVICE_PIN_MODIFFY_FAILED',			8],
		'103004'	=> 	['ERROR_DEVICE_PUK_MODIFFY_FAILED',			8],
		'103005'	=> 	['ERROR_DEVICE_GET_AUTORUN_VERSION_FAILED',	8],
		'103006'	=> 	['ERROR_DEVICE_GET_API_VERSION_FAILED',		8],
		'103007'	=> 	['ERROR_DEVICE_GET_PRODUCT_INFORMATON_FAILED',	8],
		'103008'	=> 	['ERROR_DEVICE_SIM_CARD_BUSY',				8],
		'103009'	=> 	['ERROR_DEVICE_SIM_LOCK_INPUT_ERROR',		8],
		'103010'	=> 	['ERROR_DEVICE_NOT_SUPPORT_REMOTE_OPERATE',	8],
		'103011'	=> 	['ERROR_DEVICE_PUK_DEAD_LOCK',				8],
		'103012'	=> 	['ERROR_DEVICE_GET_PC_AISSST_INFORMATION_FAILED',	8],
		'103013'	=> 	['ERROR_DEVICE_SET_LOG_INFORMATON_LEVEL_FAILED',	8],
		'103014'	=> 	['ERROR_DEVICE_GET_LOG_INFORMATON_LEVEL_FAILED',	8],
		'103015'	=> 	['ERROR_DEVICE_COMPRESS_LOG_FILE_FAILED',	8],
		'103016'	=> 	['ERROR_DEVICE_RESTORE_FILE_DECRYPT_FAILED',8],
		'103017'	=> 	['ERROR_DEVICE_RESTORE_FILE_VERSION_MATCH_FAILED',	8],
		'103018'	=> 	['ERROR_DEVICE_RESTORE_FILE_FAILED',		8],
		'103101'	=> 	['ERROR_DEVICE_SET_TIME_FAILED',			8],
		'103102'	=> 	['ERROR_COMPRESS_LOG_FILE_FAILED',			8],

		'104001'	=> 	['ERROR_DHCP_ERROR',						8],

		'106001'	=> 	['ERROR_SAFE_ERROR',						8],

		'107720'	=> 	['ERROR_DIALUP_GET_CONNECT_FILE_ERROR',		8],
		'107721'	=> 	['ERROR_DIALUP_SET_CONNECT_FILE_ERROR',		8],
		'107722'	=> 	['ERROR_DIALUP_DIALUP_MANAGMENT_PARSE_ERROR',	8],
		'107724'	=> 	['ERROR_DIALUP_ADD_PRORILE_ERROR',			8],
		'107725'	=> 	['ERROR_DIALUP_MODIFY_PRORILE_ERROR',		8],
		'107726'	=> 	['ERROR_DIALUP_SET_DEFAULT_PRORILE_ERROR',	8],
		'107727'	=> 	['ERROR_DIALUP_GET_PRORILE_LIST_ERROR',		8],
		'107728'	=> 	['ERROR_DIALUP_GET_AUTO_APN_MATCH_ERROR',	8],
		'107729'	=> 	['ERROR_DIALUP_SET_AUTO_APN_MATCH_ERROR',	8],

		'108001'	=> 	['ERROR_LOGIN_NO_EXIST_USER',				8],
		'108002'	=> 	['ERROR_LOGIN_PASSWORD_ERROR',				8],
		'108003'	=> 	['ERROR_LOGIN_ALREADY_LOGINED',				8],
		'108004'	=> 	['ERROR_LOGIN_MODIFY_PASSWORD_FAILED',		8],
		'108005'	=> 	['ERROR_LOGIN_TOO_MANY_USERS_LOGINED',		8],
		'108006'	=> 	['ERROR_LOGIN_USERNAME_OR_PASSWORD_ERROR',	8],
		'108007'	=> 	['ERROR_LOGIN_TOO_MANY_TIMES',				8],

		'109001'	=> 	['ERROR_LANGUAGE_GET_FAILED',				8],
		'109002'	=> 	['ERROR_LANGUAGE_SET_FAILED',				8],

		'110001'	=> 	['ERROR_ONLINE_UPDATE_SERVER_NOT_ACCESSED',	8],
		'110002'	=> 	['ERROR_ONLINE_UPDATE_ALREADY_BOOTED',		8],
		'110003'	=> 	['ERROR_ONLINE_UPDATE_GET_DEVICE_INFORMATION_FAILED',	8],
		'110004'	=> 	['ERROR_ONLINE_UPDATE_GET_LOCAL_GROUP_COMMPONENT_INFORMATION_FAILED',	8],
		'110005'	=> 	['ERROR_ONLINE_UPDATE_NOT_FIND_FILE_ON_SERVER',	8],
		'110006'	=> 	['ERROR_ONLINE_UPDATE_NEED_RECONNECT_SERVER',	8],
		'110007'	=> 	['ERROR_ONLINE_UPDATE_CANCEL_DOWNLODING',	8],
		'110008'	=> 	['ERROR_ONLINE_UPDATE_SAME_FILE_LIST',		8],
		'110009'	=> 	['ERROR_ONLINE_UPDATE_CONNECT_ERROR',		8],
		'110021'	=> 	['ERROR_ONLINE_UPDATE_INVALID_URL_LIST',	8],
		'110022'	=> 	['ERROR_ONLINE_UPDATE_NOT_SUPPORT_URL_LIST',8],
		'110023'	=> 	['ERROR_ONLINE_UPDATE_NOT_BOOT',			8],
		'110024'	=> 	['ERROR_ONLINE_UPDATE_LOW_BATTERY',			8],
		'11019'		=> 	['ERROR_USSD_NET_NO_RETURN',				8],

		'111001'	=> 	['ERROR_USSD_ERROR',						8],
		'111012'	=> 	['ERROR_USSD_FUCNTION_RETURN_ERROR',		8],
		'111013'	=> 	['ERROR_USSD_IN_USSD_SESSION',				8],
		'111014'	=> 	['ERROR_USSD_TOO_LONG_CONTENT',				8],
		'111016'	=> 	['ERROR_USSD_EMPTY_COMMAND',				8],
		'111017'	=> 	['ERROR_USSD_CODING_ERROR',					8],
		'111018'	=> 	['ERROR_USSD_AT_SEND_FAILED',				8],
		'111020'	=> 	['ERROR_USSD_NET_OVERTIME',					8],
		'111021'	=> 	['ERROR_USSD_XML_SPECIAL_CHARACTER_TRANSFER_FAILED',	8],
		'111022'	=> 	['ERROR_USSD_NET_NOT_SUPPORT_USSD',			8],

		'112001'	=> 	['ERROR_SET_NET_MODE_AND_BAND_WHEN_DAILUP_FAILED',	8],
		'112002'	=> 	['ERROR_SET_NET_SEARCH_MODE_WHEN_DAILUP_FAILED',	8],
		'112003'	=> 	['ERROR_SET_NET_MODE_AND_BAND_FAILED',		8],
		'112004'	=> 	['ERROR_SET_NET_SEARCH_MODE_FAILED',		8],
		'112005'	=> 	['ERROR_NET_REGISTER_NET_FAILED',			8],
		'112006'	=> 	['ERROR_NET_NET_CONNECTED_ORDER_NOT_MATCH',	8],
		'112007'	=> 	['ERROR_NET_CURRENT_NET_MODE_NOT_SUPPORT',	8],
		'112008'	=> 	['ERROR_NET_SIM_CARD_NOT_READY_STATUS',		8],
		'112009'	=> 	['ERROR_NET_MEMORY_ALLOC_FAILED',			8],

		'113017'	=> 	['ERROR_SMS_NULL_ARGUMENT_OR_ILLEGAL_ARGUMENT',	8],
		'113018'	=> 	['ERROR_SMS_OVERTIME',						8],
		'113020'	=> 	['ERROR_SMS_QUERY_SMS_INDEX_LIST_ERROR',	8],
		'113031'	=> 	['ERROR_SMS_SET_SMS_CENTER_NUMBER_FAILED',	8],
		'113036'	=> 	['ERROR_SMS_DELETE_SMS_FAILED',				8],
		'113047'	=> 	['ERROR_SMS_SAVE_CONFIG_FILE_FAILED',		8],
		'113053'	=> 	['ERROR_SMS_LOCAL_SPACE_NOT_ENOUGH',		8],
		'113054'	=> 	['ERROR_SMS_TELEPHONE_NUMBER_TOO_LONG',		8],

		'114001'	=> 	['ERROR_SD_FILE_EXIST',						8],
		'114002'	=> 	['ERROR_SD_DIRECTORY_EXIST',				8],
		'114004'	=> 	['ERROR_SD_FILE_OR_DIRECTORY_NOT_EXIST',	8],
		'114004'	=> 	['ERROR_SD_IS_OPERTED_BY_OTHER_USER',		8],
		'114005'	=> 	['ERROR_SD_FILE_NAME_TOO_LONG',				8],
		'114006'	=> 	['ERROR_SD_NO_RIGHT',						8],
		'114007'	=> 	['ERROR_SD_FILE_IS_UPLOADING',				8],

		'115001'	=> 	['ERROR_PB_NULL_ARGUMENT_OR_ILLEGAL_ARGUMENT',	8],
		'115002'	=> 	['ERROR_PB_OVERTIME',						8],
		'115003'	=> 	['ERROR_PB_CALL_SYSTEM_FUCNTION_ERROR',		8],
		'115004'	=> 	['ERROR_PB_WRITE_FILE_ERROR',				8],
		'115005'	=> 	['ERROR_PB_READ_FILE_ERROR',				8],
		'115199'	=> 	['ERROR_PB_LOCAL_TELEPHONE_FULL_ERROR',		8],

		'116001'	=> 	['ERROR_STK_NULL_ARGUMENT_OR_ILLEGAL_ARGUMENT',	8],
		'116002'	=> 	['ERROR_STK_OVERTIME',						8],
		'116003'	=> 	['ERROR_STK_CALL_SYSTEM_FUCNTION_ERROR',	8],
		'116004'	=> 	['ERROR_STK_WRITE_FILE_ERROR',				8],
		'116005'	=> 	['ERROR_STK_READ_FILE_ERROR',				8],

		'117001'	=> 	['ERROR_WIFI_STATION_CONNECT_AP_PASSWORD_ERROR',	8],
		'117002'	=> 	['ERROR_WIFI_WEB_PASSWORD_OR_DHCP_OVERTIME_ERROR',	8],
		'117003'	=> 	['ERROR_WIFI_PBC_CONNECT_FAILED',			8],
		'117004'	=> 	['ERROR_WIFI_STATION_CONNECT_AP_WISPR_PASSWORD_ERROR',	8],

		'118001'	=> 	['ERROR_CRADLE_GET_CRURRENT_CONNECTED_USER_IP_FAILED',	8],
		'118002'	=> 	['ERROR_CRADLE_GET_CRURRENT_CONNECTED_USER_MAC_FAILED',	8],
		'118003'	=> 	['ERROR_CRADLE_SET_MAC_FAILED',				8],
		'118004'	=> 	['ERROR_CRADLE_GET_WAN_INFORMATION_FAILED',	8],
		'118005'	=> 	['ERROR_CRADLE_CODING_FAILED',				8],
		'118006'	=> 	['ERROR_CRADLE_UPDATE_PROFILE_FAILED',		8],

		'125002'	=> ['(???) Invalid session (login state-1 instead of 0)?', 8],
		'125003'	=> ['(???) __RequestVerificationToken Error?',	8],
	);

	protected $std_fields_map=array(
		'ApiSmsList'=>array(
			'id'	=> 'Index',						// SMS's ID (the one used to delete the SMS)
			'date'	=> 'Date',						// SMS's Date, formated as a SQL datetime (YYYY-MM-DD HH:MM:SS)
			'phone'	=> 'Phone',						// SMS's Phone Number
			'text'	=> 'Content',					// SMS's Text Content
		),
		'ApiWifiListClients'=>array(
			'id'			=> 'ID',				// the internal ID asigned by the device (else set it to the MAC address)
			'mac'			=> 'MacAddress',		// MAC address
			'ipv4'			=> 'my_ip_v4',			// IP address (v4)
			'ipv6'			=> 'my_ip_v6',			// IP address (v6)
			'dns_name'		=> '',					// DNS host name
			'name'			=> 'HostName',			// host name (usually sent by client)
			'alias'			=> 'ActualName',		// friendly host name (user-defined in the device)
			'time'			=> '',					// (unix time) Date when the client has been connected
			'duration'		=> '',					// (sec) How long the client has been connected
			'level_send'	=> '',					// (db) Send Level
			'level_receive'	=> '',					// (db) Receive Level
		),
		'ApiWifiListSsids'=>array(
			'id'			=> 'ID',
			'bssid'			=> 'WifiMac',
			'ssid'			=> 'WifiSsid',
			'password'		=> '',
			'channel'		=> '',
		),
	);

	// our own properties -----------------------------------------------------------
	private $_session='';			// current session
	private $_token='';				// current authentication token
	private $_post_tokens=array();	// available tokens



	// ############################################################################################
	// ## (REQUIRED) OVERRIDEN METHODS ############################################################
	// ############################################################################################

	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$this->DebugLogMethod();

		//$this->ResetLastError();
		$user 		and $this->user		=$user;
		$password	and $this->password	=$password;

		$this->_grabFirstSessionAndToken(true);

		$headers=array(
			'Cookie: '.$this->_session,	// the session 'value' as cookie, this is not the same as the 'SessionID=value' cookie already handled by curl
			'__RequestVerificationToken: '.$this->_token 
		);

		$encoded_pass=base64_encode(hash('sha256', $this->user.base64_encode(hash('sha256', $this->password, false)).$this->_token, false));

		$params=array(
			'Username'=> $this->user,
			'password_type'=> 4,
			'Password'=> $encoded_pass
		);
		$xml=$this->ArrayToXml($params,'request');

		$result=$this->XmlToArray($this->CallEndpoint('/api/user/login','POST',$xml, $headers));
		
		$result = $this->ErrorFreeResult($result,true);
		if($result){
			$this->DebugLogDebug('Login succeeded');
			$this->is_logged=true;
		}
		else{
			$this->DebugLogError('Login failed');
		}
		return $result;
	}

	// ############################################################################################
	// ## (Optionnal) OVERRIDEN STANDARDIZED METHODS ##############################################
	// ############################################################################################

	// -------------------------------------------------------------------------
	public function ApiLogout(){		
		$this->DebugLogMethod();

		$xml='<?xml version="1.0" encoding="UTF-8"?><request><Logout>1</Logout></request>';
		$result=$this->XmlToArray($this->CallEndpoint('/api/user/logout','POST',$xml, $headers));		
		return $this->ErrorFreeResult($result,true);
	}

	// -------------------------------------------------------------------------
	public function ApiIsLoggedIn(){		
		$this->DebugLogMethod();

		$result=$this->XmlToArray($this->CallEndpoint('/api/user/state-login','GET'));
		if($result=$this->ErrorFreeResult($result)){
			if($result['State']=='0'){
				return true;
			}
			elseif($result['State']=='-1'){
				$this->DebugLogError("'State' is -1. This means that there was an issue with the way session is set.");
			}
			else{
				$this->DebugLogError("Unknown Login state in", $result);
			}
		}
		$this->DebugLogError('We are NOT logged In');
		return false;
	}
	

	// -------------------------------------------------------------------------
	public function ApiReboot(){
		$this->DebugLogMethod();
		return $this->ApiSetDeviceControl('1');
	}

	// -------------------------------------------------------------------------
	public function ApiSmsDelete($index){
		$this->DebugLogMethod();
		return $this->ApiSetSmsDeleteSms($index);
	}

	// -------------------------------------------------------------------------
	public function ApiSmsListReceived($read_type=0, $page=1, $limit=20){
		$this->DebugLogMethod();
		return $this->_SmsList(1, $page, $limit, $read_type);
	}

	// -------------------------------------------------------------------------
	public function ApiSmsListSent($page=1, $limit=20){
		$this->DebugLogMethod();
		return $this->_SmsList(2, $page, $limit);
	}

	// -------------------------------------------------------------------------
	private function _SmsList($box_type, $page=1, $limit=20,$read_type=0){
		$this->DebugLogMethod();
		$sort=0;
		$asc=0;
		$unread=0;
		if($result=$this->ApiGetSmsSmsList($page, $limit, $box_type, $sort, $asc, $unread)){
			$this->DebugLogDebug('Result',$result);
			if(is_array($result)){
				if($result['Count']){
					return $this->RemapFieldsList($result['Messages']['Message'],'ApiSmsList',false);
				}
			}
		}
	}

	// -------------------------------------------------------------------------
	public function ApiSmsSend($phone_number, $message, $priority=''){
		$this->DebugLogMethod();
		$phones_xml='';
		if(is_array($phone_number)){
			foreach($phone_number as $phone){
				$phones_xml .="<Phone>$phone</Phone>";
			}
		}
		else{
			$phones_xml ="<Phone>$phone_number</Phone>";
		}
		$reserved="1";
		$len=strlen($message);
		$date=date('Y-m-d H:i:s');
		return $this->ApiSetSmsSendSms($phones_xml,$message,$len,$reserved,$date);
	}
/*
	// -------------------------------------------------------------------------
	public function ApiWanConnect(){
		$this->DebugLogMethod();
	}

	// -------------------------------------------------------------------------
	public function ApiWanDisconnect(){
		$this->DebugLogMethod();
	}

*/

	// -------------------------------------------------------------------------
	public function ApiWifiListClients($id = ''){
		$this->DebugLogMethod();
		if($result=$this->ApiGetWlanHostList()){
			if(is_array($result)){
				$items=$result['Hosts']['Host'];
				// if only one host, huawei dont wrap it in a list so, do it
				if(!isset($items[0])){
					$items=array($items);
				}
				//map by ssid
				$formatted=array();
				foreach($items as $it){
					list($it['my_ip_v4'],$it['my_ip_v6'])=explode(';',$it['IpAddress']);
					$formatted[$it['ID']][]=$this->RemapFields($it,'ApiWifiListClients');
				}
				//return either one $ssid content or wthe whole list
				if($id){
					if(isset($formatted[$id])){
						return $formatted[$id];
					}
				}
				else{
					return $formatted;
				}
			}
		}	
	}

	// -------------------------------------------------------------------------
	public function ApiWifiListSsids($only_enabled=true){
		$this->DebugLogMethod();
		if($result=$this->ApiGetWlanMultiBasicSettings()){
			if(is_array($result)){
				$items=$result['Ssids']['Ssid'];
				//map by ssid
				$formatted=array();
				foreach($items as $it){
					if(!$only_enabled or $it['WifiEnable']==1){
						$formatted[$it['ID']][]=$this->RemapFields($it,'ApiWifiListSsids');
					}
				}
				return $formatted;
			}
		}	
	}


	
	// ###############################################################################
	// #### Our OWN methods ##########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	public function CallApiGetJson($endpoint, $params=''){
		return $this->CallApi($endpoint,$params,'GET','json');
	}

	// // -------------------------------------------------------------------------
	// public function _CallApiPostJson($endpoint, $params=''){
	// 	return $this->CallApi($endpoint,$params,'POST','json');
	// }

	// -------------------------------------------------------------------------
	public function CallApiGet($endpoint, $params=''){
		return $this->CallApi($endpoint, $params, 'GET', 'xml');
	}

	// -------------------------------------------------------------------------
	public function CallApiPost($endpoint, $params=''){
		return $this->CallApi($endpoint, $params, 'POST', 'xml');
	}

	// -------------------------------------------------------------------------
	public function CallApi($endpoint, $params='', $type='GET', $format='xml'){
		$this->DebugLogMethod();
		if(!$this->LoginIfNotAlready()){
			return false;
		}

		// format input -------------------------------------------
		if($format=='xml'){
			$params=$this->ArrayToXml($params,'request');
		}

		$headers=array();
		if($type=='POST' and $format=='xml'){
			$this->DebugLogDebug("xml POST Call needs a Token, le's grab one");
			$headers=array(
				'__RequestVerificationToken: '.$this->_GetTokenAvailable() 
			);
		}

		// make the call ----------------------------------------
		$raw=$this->CallEndpoint($endpoint, $type, $params, $headers);
		
		if($format=='xml'){
			$arr=$this->XmlToArray($raw);
			$arr=$this->CleanEmptyArrays($arr);
		}
		elseif($format=='json'){
			$arr=(array) json_decode($raw,true);
		}
		else{
			$arr=$raw;			
		}

		return $this->ErrorFreeResult($arr);
	}

	// -------------------------------------------------------------------------
	protected function ErrorFreeResult($arr='',$ok_type=false){
		if($ok_type){
			if( isset($arr[0]) and $arr[0] == 'OK'){
				$this->DebugLogDebug('OK found');
				return true;
			}
			else{
				$this->DebugLogError('OK Not found');
			}
		}
	
		if(is_array($arr)){
			if( isset($arr['code']) ){
				$this->SetApiErrorCode($arr['code'],$arr['message'],$arr);
			}
			else{
				$this->SetError(0,'answer is a valid array, but empty');
				$this->DebugLogDebug("API's result seems valid, Great!");
				return $arr;
			}
		}
		else{
			$this->SetError(0,'Result is not an array!');
			$this->SetCallError('result',$arr);
			$this->DebugLogError("Result is not an array! Raw result is: $arr");
		}
		return false;
	}

	// -------------------------------------------------------------------------
	protected function CurlHandleHeaderLine( $curl, $header_line ) {
		parent::CurlHandleHeaderLine( $curl, $header_line );

		if(preg_match('#__RequestVerificationToken: (.*)#',$header_line, $m)){
			$this->DebugLogDebug("Found '__RequestVerificationToken' ...");

			if($token = trim($m[1])){
				$tokens=explode('#',$token);
				$this->DebugLogDebug("Found Token(s) array or string",$tokens);
				
				//Thanks to https://github.com/pablo/huawei-modem-python-api-client/blob/master/huaweisms/api/common.py
				if(is_array($tokens) and count($tokens) > 1){
					// remove the first two
					array_shift($tokens);
					array_shift($tokens);

					// keep the remaining (if any)
					$this->_post_tokens=$tokens;
					$this->DebugLogDebug("Tokens array stored");
				}
				else{
					$this->DebugLogDebug("Single Token added to current tokens");
					$this->_post_tokens[]=$tokens;
				}
			}
			else{
				$this->DebugLogError("Cant extract a valid Token");
			}
		}
		else{
			$this->DebugLogDebug("Not handled -> ".trim($header_line));
		}
		//curl need this
		return strlen($header_line);
	}

	// -------------------------------------------------------------------------
	private function _GetTokenAvailable(){
		$this->DebugLogMethod();
		if($last_token=array_pop($this->_post_tokens)){
			$this->DebugLogDebug("Returned (last) available token: ",$last_token);
			return $last_token;
		}
		else{
			$this->DebugLogInfo("No more token we need to login again to grab some new ones");
			if($this->ApiLogin()){
				$this->DebugLogDebug("(GetTokenAvailable after Login4tokens) Do we have token now ?");
				if($last_token=array_pop($this->_post_tokens)){
					$this->DebugLogDebug("(GetTokenAvailable after Login4tokens) Returned (last) available token: $last_token");
					return $last_token;
				}
				else{
					$this->DebugLogError("(GetTokenAvailable after Login4tokens) I still can't find tokens... Some patch is needed here! ");
				}	
			}
			else{
				$this->DebugLogError("(GetTokenAvailable after Login4tokens) FAILED to login ");
			}
		}
	}

	// -------------------------------------------------------------------------
	private function _grabFirstSessionAndToken($reset=false){
		//Check to see if we have session cookie and token.
		if(!$this->_token || !$this->_session || $reset ){
			$result=$this->XmlToArray($this->CallEndpoint('/api/webserver/SesTokInfo','GET'));	//,[],['__RequestVerificationToken:']		
			if( $result['SesInfo'] and $result['TokInfo']){
				$this->_session	=$result['SesInfo'];
				$this->_token	=$result['TokInfo'];
				$this->DebugLogDebug("Grabbed Session: {$this->_session}");
				$this->DebugLogDebug("Grabbed Token: {$this->_token}");
				return true;
			}
			else{
				$this->DebugLogError("Cant find session or token in",$result);
				return false;
				//throw new \RuntimeException('Malformed XML returned. Cant get token.');
			}
		}
		$this->DebugLogDebug("No session or token needed");
	}




/*
	// #### TO TEST ##################################################################

	public function setLedOn($on = false){

		$ledXml = '<?xml version:"1.0" encoding="UTF-8"?><request><ledSwitch>'.($on ? '1' : '0').'</ledSwitch></request>';
		$xml = $this->http->postXml($this->getUrl('api/led/circle-switch'), $ledXml);
		$obj = new \SimpleXMLElement($xml);
		return ((string)$obj == 'OK');
	}

	public function getLedStatus(){
		$obj = $this->generalizedGet('api/led/circle-switch');
		if(property_exists($obj, 'ledSwitch')){
			if($obj->ledSwitch == '1'){
				return true;
			}
		}
		return false;
	}

*/


}
?>