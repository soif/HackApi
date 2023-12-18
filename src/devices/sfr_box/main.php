<?php
//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);

/*
	 Thanks to https://github.com/pablo/huawei-modem-python-api-client/blob/master/huaweisms/api/common.py
*/


// ###############################################################################################
class Hackapi_Sfr_box extends Hackapi{
	use Hackapi_Sfr_box_Trait;

	// Overidde Parent properties ---------------------------------------------------------------
	protected $host		="192.168.1.1";		// default Box's IP address
	protected $use_ssl	=false;				// it seems that the API dont work (don't even answers) in httpS mode
	protected $user		="admin";			// default Box's user name

	protected $use_cookies	=false;		// not needed
	//protected $def_headers	=array();
	//protected $def_referer="/";
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
	);


	// our own properties ---------------------------------------------------------------------------
	private $_token='';
	private $_token_duration=550;	// the token is supposed to be valid 600sec, let's set i a bit lower just in case
	private $_token_time	=0;		// time when the token was set



	// ###############################################################################
	// #### OVERRIDEN Methods ########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$this->DebugLogMethod();

		$user 		and $this->user		=$user;
		$password	and $this->password	=$password;

		$r=$this->MyCallApi('auth.getToken','','GET',false);
		if(isset($r['auth']['@attributes']['token'])){
			$token=$r['auth']['@attributes']['token'];
		//if(isset($r['auth']['token'])){
		//	$token=$r['auth']['token'];
			$this->_token=$token;
			$this->_token_time=time();
			$this->DebugLogVerbose("Found token $token");

			//https://github.com/hacf-fr/sfrbox-api/blob/main/src/sfrbox_api/helpers.py
			//https://gist.github.com/motin/7cbe1ae77bf493e3cae8
			$hash=hash_hmac('SHA256', hash('sha256',$this->user), $token) . hash_hmac('SHA256', hash('sha256',$this->password), $token) ;

			if($r=$this->MyCallApi('auth.checkToken',array('token'=>$token,'hash'=>$hash),'GET',false)){
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

	// // -------------------------------------------------------------------------
	// public function ApiLogout(){		

	// }

	// // -------------------------------------------------------------------------
	// public function ApiIsLoggedIn(){		
	// 	return false;
	// }
	
	// ################################################################################

	// ###############################################################################
	// #### Our OWN methods ##########################################################
	// ###############################################################################


	// -------------------------------------------------------------------------
	public function MyCallApiGet($endpoint, $params=''){
		return $this->MyCallApi($endpoint, $params, 'GET');
	}
	// -------------------------------------------------------------------------
	public function MyCallApiGetList($endpoint, $params=''){
		return $this->MyCallApi($endpoint, $params, 'GET',true,true);
	}
	// -------------------------------------------------------------------------
	public function MyCallApiPost($endpoint, $params=''){
		return $this->MyCallApi($endpoint, $params, 'POST');
	}
	// -------------------------------------------------------------------------
	public function MyCallApi($endpoint, $params=array(), $type='GET', $autologin=true,$force_list=false){
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
		$arr=$this->XmlToArray($this->CallEndpoint($endpoint, $type, $params));
		
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
					$this->DebugLogDebug('Status ok');
					//unset($arr['stat']);
					//unset($arr['version']);
					if($autologin){
						$arr=$this->_CleanArray($arr,$force_list);
					}
					if(is_array($arr) and !count($arr)){
						return true;
					}
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
		$state=$arr['@attributes'];
		unset($arr['@attributes']);
		//$arr=array_merge(array('api_state'=>$state), $arr);

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
			return false;
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