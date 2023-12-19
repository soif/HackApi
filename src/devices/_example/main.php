<?php
//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);


/*

*/

// ###############################################################################################
class Hackapi_DEVICE extends Hackapi{
	use Hackapi_DEVICE_Trait;

	// Override Parent properties ---------------------------------------------------------------
	//protected $host		="192.168.1.1";		// default Box's IP address
	//protected $use_ssl	=false;				// it seems that the API dont work (don't even answers) in httpS mode
	//protected $user		="admin";			// default Box's user name
	//protected	$password	="";				// (default) user password

	protected $client_version		='0.01';	// API client Version, formated as M.mm

	//protected $use_cookies	=true;
	//protected $def_headers=array();
	//protected $def_referer="";
	//....

	// our API errors ---------------------------------------------------------------
	// define our API specific errors as : api_code => ['ERROR_CODE_TEXT', $err_num]
	//	$err_num in the index of the $error_codes property.
	//
	//	'API_CODE'	=>	['ERROR_CODE_TEXT', 		err_num]
	protected $api_error_codes=array(
		//'666'		=> ['UNNEXPECTED_ALIEN_ERROR', 5],
	);


	// our own properties ---------------------------------------------------------------------------
	//private $_token='';


	// ############################################################################################
	// ## (REQUIRED) OVERRIDEN METHODS ############################################################
	// ############################################################################################


	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$this->DebugLogMethod();
		$this->is_logged=true;
		return true;
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
	public function CallApi($endpoint, $params=array(), $type='GET', $myown_args='xxx'){
		$this->DebugLogMethod();
		$headers=array();

		$result=$this->CallEndpoint($endpoint, $type, $params, $headers);
		$arr=json_decode($result);
		$arr=$this->ErrorFreeResult($arr);
		return $arr;
	}

	// -------------------------------------------------------------------------
	// here we check for API errors, and maybe reformat weird data structures
	protected function ErrorFreeResult($arr=''){
		return $arr;
		// if(is_array($arr)){
		// 	if( isset($arr['code']) ){
		// 		$this->SetApiErrorCode($arr['code'],$arr['message'],$arr);
		// 	}
		// 	else{
		// 		$this->SetError(0,'answer is a valid array, but empty');
		// 		return $arr;
		// 	}
		// }
		// else{
		// 	$this->SetError(0,'Result is not an array!');
		// 	$this->DebugLogError("Result is not an array! Raw result is: $arr");
		// }
		// return false;
	}

	// -------------------------------------------------------------------------
	// protected function CurlHandleHeaderLine( $curl, $header_line ) {
	// }

}
?>