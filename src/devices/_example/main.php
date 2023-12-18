<?php
//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);


/*

*/

// ###############################################################################################
class Hackapi_Device extends Hackapi{
	use Hackapi_Device_Trait;

	// Overidde Parent properties ---------------------------------------------------------------
	//protected $use_cookies	=true;
	//protected $def_headers=array();
	//protected $def_referer="";
	//....

	// our API errors ---------------------------------------------------------------
	// define our API specific errors as : api_code => ['ERROR_CODE_TEXT', $err_num]
	//	$err_num in the index of the $error_codes property.
	//
	//	'API_CODE'	=>	['ERROR_CODE_TEXT', 			err_num]
	protected $api_error_codes=array(
		//'666'		=> ['UNNEXPECTED_ALIEN_ERROR', 5],
	);


	// our own properties ---------------------------------------------------------------------------
	//private $_token='';



	// ###############################################################################
	// #### OVERRIDEN Methods ########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$this->is_logged=true;
		return true;
	}

	
	// ################################################################################



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
	protected function ErrorFreeResult($arr=''){

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