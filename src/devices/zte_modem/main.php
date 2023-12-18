<?php
//include the main class we are exending, and our trait (if it exists or not)
require_once(dirname(__FILE__).'/../../lib/Hackapi.php');
Hackapi::RequireTrait(__FILE__);

/*

Credits:
https://github.com/an1by/ZTEModemAPI
https://github.com/paulo-correia/ZTE_API_and_Hack
https://github.com/rkarimabadi/ZTE-MF79-usb-modem-Send-SMS
https://taisto.org/ZTE_MF823D
*/

// ###############################################################################################
class Hackapi_Zte_modem extends Hackapi{
	use Hackapi_Zte_modem_Trait;

	protected $host			="192.168.0.1";	
	protected $password		="admin";

	// Override Parent properties ---------------------------------------------------------------
	protected $def_referer	='/index.html';
	//protected $def_endpoint	='/goform/goform_get_cmd_process';
	protected $def_params		=array(
			'isTest'	=>'false',
	);
	protected $api_error_codes=array(
			'failure'	=> 	['FAILURE',		7],				
	);
		
		
	protected $std_fields_map=array(		// an array (indexed by the standart method name) of maps description 'to_field' => 'from_field' (hierarchized by '/') 
		'ApiSmsList'=>array(
			'id'	=> 'id',
			'date'	=> 'my_date',
			'phone'	=> 'number',
			'text'	=> 'my_text',
		),
		'ApiWifiListClients'=>array(
//			'id'			=> 'ssid_index',
			'mac'			=> 'mac_addr',
			'ipv4'			=> 'ip_addr',
//			'ipv6'			=> '',
//			'dns_name'		=> '',
			'name'			=> 'hostname',
//			'alias'			=> 'hostname',
//			'level_send'	=> '',
//			'level_receive'	=> '',
//			'duration'		=> '',
//			'time'			=> '',
		),
		// 'ApiWifiListSsids'=>array(
		// 	'id'			=> 'ID',
		// 	'bssid'			=> 'WifiMac',
		// 	'ssid'			=> 'WifiSsid',
		// 	'password'		=> '',
		// 	'channel'		=> '',

		// ),
	);

	private $_ad1	='';
	private $_ad2	='';
	private $_ad	='';


	// ###############################################################################
	// #### OVERRIDEN Methods ########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	public function ApiLogin($user='',$password=''){
		$user 		and $this->user		=$user;
		$password	and $this->password	=$password;
		
		$params=array(
			'goformId'	=>'LOGIN',
			'password'	=>base64_encode($this->password)
		);
		$r= (array) json_decode($this->CallEndpoint('/goform/goform_set_cmd_process','POST',$params));
				
		if($r['result']=='0'){
			$this->is_logged=true;
			return true;
		}
	}

	// ###############################################################################
	// #### API GET Methods ##########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	public function ApiReboot(){
		return $this->ApiSetREBOOTDEVICE();
	}

	// -------------------------------------------------------------------------
	public function ApiWanConnect(){
		return $this->ApiSetConnectNetwork();
	}

	// -------------------------------------------------------------------------
	public function ApiWanDisconnect(){
		return $this->ApiSetDisconnectNetwork();
	}

	// -------------------------------------------------------------------------
	public function ApiWifiStart(){
		return $this->ApiSetSetWifiInfo(1);
	}

	// -------------------------------------------------------------------------
	public function ApiWifiStop(){
		return $this->ApiSetSetWifiInfo(0);
	}

	// -------------------------------------------------------------------------
	public function ApiSmsSend($to_tel, $message, $priority = ''){
		//$date = date('y;m;d;H;i;s;+0');
		$message=$this->_utf2hex($message);
		return $this->ApiSetSendSms($to_tel, $message, $date); //,'GSM7_default'
	}

	// -------------------------------------------------------------------------
	public function ApiSmsDelete($id){
		return $this->ApiSetDeleteSms($id);
	}

	// -------------------------------------------------------------------------
	public function ApiSmsListReceived($read_type = 0, $page = 1, $limit = 20){
		return $this->_smslist(1, $page, $limit, $read_type);
	}

	// -------------------------------------------------------------------------
	public function ApiSmsListSent($page = 1, $limit = 20){
		return $this->_smslist(2, $page, $limit);
	}

	// -------------------------------------------------------------------------
	private function _smslist($box_type = 0, $page = 1, $limit = 20,$read_type=0){
		$page--;
		$mem_store='1';
		$tags='10';
		if($result=$this->ApiGetSmsDataTotal($box_type, $page, $limit, $mem_store)){
			if(is_array($result['messages'])){
				$result=$result['messages'];
				foreach($result as $k => $it){
					//makes date
					list($y,$m,$d,$h,$mm,$s,$o)=explode(',',$it['date']);
					$time=mktime($h,$mm,$s,$m,$d,$y);
					$result[$k]['my_date']=date('Y-m-d H:i:s',$time);
					unset($result[$k]['date']);
					//makes text
					$result[$k]['my_text']=trim(pack("H*", $it['content']));
					unset($result[$k]['content']);

					$result[$k]=$this->RemapFields($result[$k],'ApiSmsList');
				}
			}
			return $result;
		}
	}


	// -------------------------------------------------------------------------
	public function ApiWifiListClients($id = ''){
		if($result=$this->ApiGetStationList()){
			if(is_array($result)){
				$items=$result['station_list'];
				//map by ssid
				$formatted=array();
				foreach($items as $it){
					$formatted[$it['ssid_index']][]=$this->RemapFields($it,'ApiWifiListClients');
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




	// ###############################################################################
	// #### Our OWN methods ##########################################################
	// ###############################################################################




	// -------------------------------------------------------------------------
		//https://github.com/zetxx/router-rpi-4G/blob/master/zte-mf-823-cmd.md
		//https://github.com/an1by/ZTEModemAPI/blob/master/docs/ATTRIBUTES.md

	// as ZTE seens to not accept more than around 100 paramaters in a single command, we have to split in 2 commands
	public function ApiGetAll(){
		$err=0;
		if(!$arr1=$this->_ApiCmd1()){
			$arr1=array();
			$err++;
		}
		if(!$arr2=$this->_ApiCmd2()){
			$arr2=array();
			$err++;
		}
		if(!$arr3=$this->_ApiCmd3()){
			$arr3=array();
			$err++;
		}
		if($err !=3){
			return array_merge($arr1,$arr2,$arr3);
		}
	}


	// -------------------------------------------------------------------------
	private function _ApiCmd1(){
		//is this really needed ?
		// $params=array(
		// 	'sms_received_flag_flag'	=> '0',
		// 	'sts_received_flag_flag'	=> '0',
		// 	'sms_db_change_flag'		=> '0'
		// );

		$commands=array(
			'apn_interface_version',
			'AuthMode',
			'battery_charging',
			'battery_pers',
			'battery_status',
			'battery_value',
			'battery_vol_percent',
			'BSSID',
			'cable_wan_ipaddr',
			'cell_id',
			'check_apn_result',
			'check_web_conflict',
			'cr_version',
			'current_imsi_provider',
			'current_upgrade_state',
			'data_status',
			'data_volume_alert_percent',
			'data_volume_limit_size',
			'data_volume_limit_switch',
			'data_volume_limit_unit',
			'datausage_current_status',
			'datausage_data_left',
			'datausage_data_total',
			'datausage_sim_number',
			'datausage_unit',
			'date_month',
			'devui_get_sim_info',
			'dhcpEnd',
			'dhcpStart',
			'dial_mode',
			'dlginfo',
			'dlna_rescan_end',
			'dm_update_control_result',
			'domain_stat',
			'ecio',
			'enodeb_id',
			'EX_APLIST',
			'EX_APLIST1',
			'EX_SSID1',
			'EX_wifi_profile',
			'ex_wifi_rssi_dbm',
			'ex_wifi_rssi',
			'ex_wifi_status',
			'fota_apn_flag',
			'fota_check_result',
			'fota_upgrade_result',
			'hardware_version',
			'hmcc',
			'hmnc',
			'hplmn_fullname',
			'hplmn',
			'imei',
			'imsi',
			'ipv6_pdp_type_ui',
			'ipv6_pdp_type',
			'ipv6_prefer_dns_auto',
			'ipv6_standby_dns_auto',
			'ipv6_wan_ipaddr',
			'is_mandatory',
			'lac_code',
			'lan_ipaddr',
			'lan_netmask_for_current',
			'lan_netmask',
			'lan_station_list',
			'Language',
			'last_login_time',
			'LocalDomain',
			'locknum',
			'login_last_time',
			'loginfo',
			'lte_band',
			'lte_pci',
			'lte_rsrp',
			'lte_rsrq',
			'lte_rssi',
			'lte_snr',
		);
		return $this->MyCallApiGet($commands);
	}
	// -------------------------------------------------------------------------
	private function _ApiCmd2(){
		$commands=array(
			'm_AuthMode',
			'm_HideSSID',
			'm_MAX_Access_num',
			'm_netselect_result',
			'm_netselect_status',
			'm_profile_name',
			'm_ssid_enable',
			'm_SSID',
			'm_WPAPSK1_encode',
			'mac_address',
			'manufacturer',
			'MAX_Access_num',
			'mdm_mcc',
			'mdm_mnc',
			'mexico_active_flag',
			'mgmt_nvc_timemark',
			'mgmt_open_url_for_auto_connect_flag',
			'mode_main_state',
			'model_name',
			'modem_main_state',
			'modem_msn',
			'monthly_rx_bytes',
			'monthly_time',
			'monthly_tx_bytes',
			'msisdn',			
			'need_hard_reboot',
			'net_select',
			'network_provider_fullname',
			'network_provider',
			'network_search',
			'network_type',
			'new_version_state',
			'oled_test_status',
			'opms_wan_mode',
			'ota_manual_check_roam_state',
			'ota_new_version_state_remind',
			'ota_user_select',			
			'pbm_cur_index',
			'pbm_group',
			'pbm_init_flag',
			'pbm_load_complete',
			'pbm_write_flag',
			'pdp_type_ui',
			'pdp_type',
			'peak_rx_bytes',
			'peak_tx_bytes',
			'pin_manage_at_wait',
			'pin_manage_result',
			'pin_modify_or_save',
			'pin_puk_at_wait',
			'pin_puk_result',
			'pin_status',
			'pinnumber',
			'plmn_display_flag',
			'ppp_dial_conn_fail_counter',
			'ppp_status',
			'pre_ppp_status',
			'prefer_dns_auto',
			'privacy_read_flag',
			'product_type',
			'psw_fail_num_str',
			'puknumber',
			'RadioOff',
			'RadioOff',
			'realtime_rx_bytes',
			'realtime_rx_thrpt',
			'realtime_time',
			'realtime_tx_bytes',
			'realtime_tx_thrpt',
			'redirect_flag',
			'rmcc',
			'rmnc',
			'roam_setting_option',
			'router_mode_gateway',
			'rplmn_num',
			'rscp',
			'rssi',
	
		);
		return $this->MyCallApiGet($commands);
	}

	// -------------------------------------------------------------------------
	private function _ApiCmd3(){
		$commands=array(
			'sc',
			'scan_finish',
			'signalbar',
			'sim_card_type',
			'sim_clear_all_flag',
			'sim_iccid',
			'sim_imsi',
			'sim_pay_type_o2',
			'simcard_roam',
			'sleep_status',
			'sm_cause',
			'sms_cmd_status_info',
			'sms_current_db_id',
			'sms_data_total',
			'sms_db_change',
			'sms_init',
			'sms_nv_capability_used',
			'sms_received_flag',
			'sms_sim_capability_used',
			'sms_unread_count',
			'spn_b1_flag',
			'spn_b2_flag',
			'spn_display_flag',
			'spn_name_data',
			'ssid',
			'SSID1',
			'ssid2_stat',
			'sta_ip_status',
			'standby_dns_auto',
			'static_wan_ipaddr',
			'station_mac',
			'station_num',
			'stk_menu',
			'stk_write_flag',
			'stk',
			'sts_received_flag',
			'support_pbm_flag',
			'systime_mode',
			'total_rx_bytes',
			'total_tx_bytes',
			'tx_power',
			'upg_roam_switch',
			'upgrade_remind',
			'user_ip_addr',
			'user_login_timemark',
			'ussd_action',
			'ussd_content',
			'ussd_write_flag_msisdn',
			'ussd_write_flag_swiss',
			'ussd_write_flag',
			'wa_inner_version',
			'wa_version',
			'wan_active_band',
			'wan_auto_conn_prompt_flag',
			'wan_auto_reconnecting',
			'wan_connect_status',
			'wan_csq',
			'wan_curr_conn_time',
			'wan_curr_rx_bytes',
			'wan_curr_tx_bytes',
			'wan_ipaddr',
			'wan_lte_ca',
			'wan_network_status',
			'wan_rrc_state',
			'web_version',
			'wifi_5g_enable',
			'wifi_coverage',
			'wifi_dfs_status',
			'wifi_driver_reload_flag',
			'wifi_enable',
			'wifi_onoff_func_control',
			'wifi_profile_tmp',
			'wifi_set_flags',
			'wispr_result',
			'work_mode',
			'WPAPSK1_encode',
			'wps_pin',
		);
		return $this->MyCallApiGet($commands);
	}


	// -------------------------------------------------------------------------
	private function MyCallApiGet($cmds='',$params=array()){
		return $this->_CallApiCommands('/goform/goform_get_cmd_process', $cmds, $params, 'GET');
	}
	// -------------------------------------------------------------------------
	private function MyCallApiPost($cmds='',$params=array()){
		return $this->_CallApiCommands('/goform/goform_set_cmd_process', $cmds, $params, 'POST');
	}

	// -------------------------------------------------------------------------
	private function _CallApiCommands($url, $cmds='',$params=array(),$method='GET'){
		
		if($method=='GET'){
			//parse commands
			if(is_array($cmds)){
				$cmd_str=implode(',',$cmds);
			}
			else{
				$cmd_str=$cmds;
			}

			// makes params
			if(strpos($cmd_str,',')){
				$params['multi_data']='1';
			}
			$cmd_str and $params['cmd']	=$cmd_str;
			$params['_'] 	= $this->GetTimeMs();
		}
		elseif($method=='POST'){
			$params['goformId']=$cmds;
			$params['AD']=$this->_GrabAD();
		}

		// grab result
		$result=$this->CallEndpointWhenLogged($url,$method,$params);
		$arr = json_decode($result,true);
		return $this->ErrorFreeResult($arr);
	}

	// -------------------------------------------------------------------------
	protected function ErrorFreeResult($arr=''){	
		if(is_array($arr)){
			if( isset($arr['result']) ){
				if($arr['result']=='success'){
					return true;
				}
				elseif($arr['result']=='failure'){
					$this->SetApiErrorCode($arr['result'],'',$arr);
					return false;
				}
				else{
					$this->SetApiErrorCode($arr['result'],'Unexpected result code',$arr);
					return false;
				}
			}
			elseif(empty($arr)){
				$this->SetError(0,'answer is a valid array, but empty');
				$this->DebugLogDebug("API's result seems valid, Great!");
				return $arr;
			}
			else{
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
	private function _ApiGrabAD1(){
		$this->DebugLogMethod();
		if($result=$this->MyCallApiGet('cr_version,wa_inner_version')){	//Language,
			$this->_ad1=md5($result['wa_inner_version'].$result['cr_version']);
			$this->DebugLogVerbose("Grabed ad1: {$this->_ad1}");
			return true;
		}		
	}

	// -------------------------------------------------------------------------
	private function _ApiGrabAD2(){
		$this->DebugLogMethod();
		if($result=$this->MyCallApiGet('RD')){	//	,['goformId'=>'RD']
			$this->_ad2=$result['RD'];
			$this->DebugLogVerbose("Grabed ad2: {$this->_ad2}");
			return $result;
		}		
	}

	// -------------------------------------------------------------------------
	private function _GrabAD(){
		$this->DebugLogMethod();
		if($this->_ad){
			return $this->_ad;
		}
		if(!$this->_ad1){
			$this->_ApiGrabAD1();
		}
		if(!$this->_ad2){
			$this->_ApiGrabAD2();
		}
		if($this->_ad1 and $this->_ad2){
			$this->_ad=md5($this->_ad1.$this->_ad2);
			$this->DebugLogVerbose("Made ad: {$this->_ad}");
			return $this->_ad;
		}
	}


	// -------------------------------------------------------------------------
	private function _utf2hex($str){
		mb_internal_encoding("UTF-8");		
		$l=mb_strlen($str);
		$res='';
		for ($i=0;$i<$l;$i++){	
			$s = mb_substr($str,$i,1);
			$s = mb_convert_encoding($s, 'UCS-2LE', 'UTF-8');
			$s = dechex(ord(substr($s, 1, 1))*256+ord(substr($s, 0, 1)));
			if (mb_strlen($s)<4) $s = str_repeat("0",(4-mb_strlen($s))).$s;
			$res.=$s;
		}
		return $res; 
	}



}
?>