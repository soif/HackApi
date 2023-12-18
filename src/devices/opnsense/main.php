<?php
//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);


/*

*/

// ###############################################################################################
class Hackapi_OpnSense extends Hackapi{
	use Hackapi_OpnSense_Trait;

	// Overidde Parent properties ---------------------------------------------------------------
	protected $host			="192.168.1.1";	
	protected $user			="root";
	protected $password		="opnsense";


	//protected $use_cookies	=true;
	//protected $def_headers=array();
	//protected $def_referer="";
	//....
	protected $def_endpoint='/api';

	// our API errors ---------------------------------------------------------------
	// define our API specific errors as : api_code => ['ERROR_CODE_TEXT', $err_num]
	//	$err_num in the index of the $error_codes property.
	//
	//	'API_CODE'	=>	['ERROR_CODE_TEXT', 			err_num]
	protected $api_error_codes=array(
		'400'		=> ['CONTROLLER_NOT_FOUND', 6],
		'401'		=> ['AUTHENTICATION_FAILED', 3],
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

	// -------------------------------------------------------------------------
	// protected function CurlHandleHeaderLine( $curl, $header_line ) {
	// }

}
?>