<?php
/*
--------------------------------------------------------------------------------------------------------------------------------------
HackApi Tools class
--------------------------------------------------------------------------------------------------------------------------------------
Copyright (C) 2023  by François Déchery - https://github.com/soif/

HackApi is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

HackApi is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>.
--------------------------------------------------------------------------------------------------------------------------------------
*/

class HackapiTools{
	private $device		='';
	private $path_root	='';
	private $path_device='';
	private $devices_dir="devices";
	public  $odev		='';
	private $template_prefs	=array();

	private $_methods_with_errors=array();
	private $_methods_with_false=array();	
	private $print_width=100;
	private $error_level=0;

	private $states=array(
		1 	=> ['DRAFT',		'Not tested'],
		2 	=> ['ERROR',		'Returns an error'],
		3 	=> ['UNDER DEV',	'Work in propress'],
		4 	=> ['TESTED',		'Params still not ordered or desc not set'],
		5 	=> ['FINAL',		'Fully tested: Params ordered, desc set'],
	);

	private $def_template='
// -----------------------------------------------------------------------
/**
* {method}
*
{description}
{doc_arguments}
* @category {category}
* {return}
*/
public function {method}({arguments}){
	$this->DebugLogMethod();
	$this->HandleApiMethodStateAllowed({state});
	{parameters}
	return $this->{call}({call_args}{call_params});
}
';



	// -------------------------------------------------------------------------
	function __construct($device=''){
		$this->path_root=dirname(dirname(__FILE__)).'/';
		if($device){
			$this->SetDevice($device);
		}
	}
	
	// -------------------------------------------------------------------------
	public function ShowErrors($level=1){
		$this->error_level=$level;
		$this->PrintLine("Error mode set to level $level !");
	}
	// -------------------------------------------------------------------------
	public function ShowDebug($level=1){
		$this->odev->SetDebug($level, 1);
		$this->PrintLine("Debug mode set to level $level !");
	}


	// -------------------------------------------------------------------------
	public function SetDevice($device){
		$this->device=$device;
		$this->path_device=$this->path_root."{$this->devices_dir}/{$this->device}/";
		return $this->RequireDevice();
	}

	// -------------------------------------------------------------------------
	public function SetHostCredentials($host,$is_ssl=false,$user,$password){
		$this->odev->SetHost($host,$is_ssl);
		$this->odev->SetLogin($user,$password);
	}


	// -------------------------------------------------------------------------
	public function RequireDevice(){
		$file=$this->path_device."main.php";
				
		if(!file_exists($file)){
			return false;
		}
		require_once($file);
		$class="Hackapi_".$this->device;
		$this->odev=new $class();
		return true;
	}

	// -------------------------------------------------------------------------
	public function RequireTemplate(){
		$file=$this->path_device."template.php";
		if(!file_exists($file)){
			return false;
		}
		include($file);
		$this->template_prefs=$p;
		return true;
	}

	// -------------------------------------------------------------------------
	public function ListDevices(){
		return  array_diff(scandir($this->path_root.$this->devices_dir.'/'), array('..', '.','_example'));
	}


	// -------------------------------------------------------------------------
	public function TestLogin($hide_pass=false){
		$defload='';
		$prefs=$this->odev->GetPreferences();
		
		if($prefs['from_default_file']){
			$defload="(loaded from the default.php file)";
		}
		unset($prefs['from_default_file']);
		$hide_pass and $prefs['password']=md5($prefs['password']);
		
		// show info -------
		$this->PrintTitle("Testing Login in '{$this->device}'");
		$this->PrintLine( "with the following parameters $defload :");
		echo $this->PrettifyArray($prefs);
		
		$r=$this->odev->ApiLogin();
	
		// re-init the class; to make test without first logged-in
		$this->RequireDevice(); 

		if($r){
			$this->PrintLine("Login OK!");
		}
		else{
			$this->PrintError("Cant' Login!");
		}

		return $r;
	}
	// -------------------------------------------------------------------------
	public function TestCallApi($method,$params=array(),$method_name='',$title_prefix=''){
		if(!$method){
			$this->PrintError( "You must pass a method as first argument!" );
			return false;
		}
		$this->odev->SetApiMethodMinStateAllowed(0);
		return $this->_CallInstanceMethod($this->odev,$method,$params,$method_name, $title_prefix);
	}


	// -------------------------------------------------------------------------
	private function _CallInstanceMethod($instance,$method,$params=array(),$method_name='',$title_prefix=''){
		//title
		$title_prefix and $title_prefix.=" ";
		$title="{$title_prefix}Calling: $method";
		if(is_array($params) and count($params)){
			$title=str_pad( "$title('".implode("', '",$params)."')",60);
		}
		$method_name and $title.=" -> Wrapped in: '$method_name'";
		$this->PrintTitle($title,120,'-');

		//go
		if(method_exists($instance,$method)){
			try {
				if(isset($params[0])){
					$key_err=$params[0];
					if(isset($params[1])){
						$key_err.='_'.$params[1];
					}
				}
				else{
					$key_err=$method;
				}

				if($arr=call_user_func_array(array($instance, $method), $params)){
					echo "-- $method Result -----------------------------------------------------------------------------------------------\n";
					$pretty= $this->PrettifyArray($arr);
					echo $pretty;
					if(!preg_match('#\n$#',$pretty)){
						echo "\n";
					}
					if($this->error_level>2){
						//$this->PrintLine("Last call:");
						//echo $this->PrettifyArray($instance->GetLastCall());
						//$this->_methods_with_errors[$key_err]['call']=$instance->GetLastCall();
					}
				}
				else{
					if($i_err=$instance->GetLastError()){
						$this->_methods_with_errors[$i_err['code']][$key_err]=$i_err;

						$this->PrintError(urldecode(http_build_query($i_err,'',',	')));
												
						if($this->error_level>1){
							$this->PrintLine("Last call:");
							echo $this->PrettifyArray($instance->GetLastCall());
							
							$this->_methods_with_errors[$i_err['code']][$key_err]['call']=$instance->GetLastCall();
						}
					}
					else{
						$this->_methods_with_false[0][$key_err]['error']='Returns FALSE';
						
						$this->PrintError("The method '$method' returned FALSE! (This may be normal)");
						if($this->error_level>0){
							$this->PrintError("Last call:");
							echo $this->PrettifyArray($instance->GetLastCall());
						}
					}
				}
			} 
			catch (Exception $e) {
				$this->PrintError( $e->getMessage() );
			}
		}
		else{
			$this->PrintError( "Method $method doesnt exists!" );
		}
	}

	// -------------------------------------------------------------------------
	public function TestCallAllApiEndpoints($single_mode=true,$only_enpoints=array(),$type='get'){
		$title="Calling All Endpoints from template";
		$single_mode and $title.=" (re-logging each time)";
		$this->PrintTitle($title);

		if(is_array($only_enpoints) and count($only_enpoints)){
			$this->PrintLine("Filtered By :");
			echo "	- ".implode("\n	- ", $only_enpoints)."\n";

		}

		// require needed Template file ---------------------------------
		if(!$this->RequireTemplate()){
			$this->PrintError("Can't find the template.php file!");
			return false;
		}

		$methods=$this->ListEnpointsMethods($type,$only_enpoints);
		$this->_methods_with_errors=array();

		if(is_array($methods)){
			$total=count($methods);
			$i=0;
			foreach($methods as $method_name => $call){
				$i++;
				$title_prefix="($i/$total)";
				if($single_mode){
					$this->odev->Logout(); // force reload
				}
				$this->TestCallApi($call[0], array($call[1]),$method_name ,$title_prefix);
			}
		}
		else{
			$this->PrintError("Can't find any endoints defined in the template.php file!");
			return false;
		}

		$this->PrintErrorReport('false',$total,'Endpoint');
		$this->PrintErrorReport('errors',$total,'Endpoint');
	}

	// -------------------------------------------------------------------------
	public function ListEnpointsMethods($type='get',$only_enpoints=array()){
		$out=array();		
		$pref=& $this->template_prefs;

		$has_filter=false;
		if(is_array($only_enpoints) and count($only_enpoints)){
			$has_filter=true;
			$sort_base=array_flip($only_enpoints);
		}
		foreach($pref['definitions'] as $ep){
			$def=$this->_FormatDefinition($ep,$pref);	

			//handle filter
			if($has_filter){
				if(in_array($def['f_args_txt'],$only_enpoints)){
					$sort_base[$def['f_args_txt']]=$def['f_method_name'];
				}
				else{
					continue;
				}
			}

			if($type){
				if($type==$def['type']){
					$out[$def['f_method_name']]=array( $def['f_call'], $def['f_args_txt']);
				}
			}
			else{
				$out[$def['f_method_name']]=array( $def['f_call'], $def['f_args_txt']);
			}

		}
		if($has_filter){
			// keep the same order as filter
			$out = array_replace(array_flip($sort_base), $out);
		}		
		return $out;
	}

	// -------------------------------------------------------------------------
	private function _ListMethodsDefinitionsBy($type='get', $col='state', $value=0){
		if(!method_exists($this->odev,'ListMethodsDefinitions')){
			return false;
		}
		$list=$this->odev->ListMethodsDefinitions();
		$out=false;
		foreach($list as $method => $def){
			if($type and $def['type'] != $type ){
				continue;
			}
			if($col and $def[$col]!=$value){
				continue;
			}
			$out[$method]=$def;
		}
		return $out;
	}

	// -------------------------------------------------------------------------
	private function _CountMethodsDefinitionsBy($type='get', $col='state', $value=0){
		if($lines=$this->_ListMethodsDefinitionsBy($type, $col, $value)){
			return count($lines);
		}
		return 0;
	}

	// -------------------------------------------------------------------------
	public function ReportCountMethodsDefinitionsBy($type='get', $col='state',$list_methods=true){
		//$this->PrintTitle("All methods {$col}s are:");
		$fnprint='PrintLine';
		$list_methods and $fnprint='PrintTitle';
		
		foreach($this->states as $value => $names){
			$count='0';
			if($lines=$this->_ListMethodsDefinitionsBy($type,$col,$value)){
				$count =count($lines);
			}
			$this->$fnprint("($value) ->".str_pad($count,4,' ',STR_PAD_LEFT)." methods with {$col}: ($value) ".str_pad($names[0],9)." - {$names[1]}");
			if($count and $list_methods){
				echo "	- ".implode("\n	- ", array_keys($lines))."\n";
			}	
		}
	}

	// -------------------------------------------------------------------------
	public function TestCallAllApiGet($single_mode=true,$only_methods=array(),$only_state=0){
		$title="Calling All ApiGet Methods";
		$single_mode and $title." (re-logging each time)";
		$this->PrintTitle($title);

		$has_only_methods=false;
		if(is_array($only_methods) and $count=count($only_methods)){
			$has_only_methods=true;
			$this->PrintLine("Found $count methods Filtered By Methods:");
			echo "	- ".implode("\n	- ", $only_methods)."\n";
			$methods=$only_methods;
		}
		else{
			$methods=$this->ListApiMethods('get',$only_methods);
		}
	
		if($only_state){
			if($filter=$this->_ListMethodsDefinitionsBy('get','state',$only_state)){
				$filter=array_keys($filter);
				$count=count($filter);
				$this->PrintLine("Found $count methods Filtered By State '$only_state':");
				echo "	- ".implode("\n	- ", $filter)."\n";
				
				if($has_only_methods){
					$methods_filtered=array_intersect($methods,$filter);
					if($count= count($methods_filtered)){
						$this->PrintLine("Found $count methods Filtered By Methods + State '$only_state':");
						echo "	- ".implode("\n	- ", $methods_filtered)."\n";
						$methods=$methods_filtered;
					}
					else{
						$this->PrintError( "Cant find State '$only_state' in Method's filter");
						return;
					}	
				}
				else{
					$methods=$filter;
				}
			}
			else{
				$this->PrintError( "Cant find State '$only_state' in All Methods");
				return;
			}
		}
		sleep(1);

		if(is_array($methods)){
			$total=count($methods);
			foreach($methods as $method){
				sleep(1);
				if($single_mode){
					$this->odev->Logout(); // force reload	
				}
				$this->TestCallApi($method);
			}
			$this->PrintErrorReport('false',$total,'Api Method');
			$this->PrintErrorReport('errors',$total,'Api Method');
		}

	}

	// -------------------------------------------------------------------------
	public function ListApiMethods($type='all',$only_methods=array()){
		$out=false;
		$class_methods = get_class_methods($this->odev);
		//$class_methods = $this->odev->GetClassMethods();

		$has_filter=false;
		if(is_array($only_methods) and count($only_methods)){
			$has_filter=true;
			//$sort_base=array_flip($only_methods);
		}
	
		
		if(is_array($class_methods)){
			$out['all']		=array();
			$out['standard']=array();
			$out['get']		=array();
			$out['set']		=array();
			foreach($class_methods as $method){
				if(preg_match('#^Api#i',$method)){
					//handle filter
					if($has_filter){
						if(!in_array($method,$only_methods)){
							continue;
						}
					}
					// dont list parent class methods in 'all'
					$reflec	= new ReflectionMethod($this->odev, $method);		
					if($reflec->class ==get_class($this->odev)){
						$out['all'][]=$method;
					}

					// store get and set methods
					if(preg_match('#^ApiGet#i',$method)){
						$out['get'][]=$method;
					}	
					elseif(preg_match('#^ApiSet#i',$method)){
						$out['set'][]=$method;
					}
		
				}	
			}
			$out['standard']=array_diff($out['all'],$out['get'],$out['set']);

			if($has_filter and $type){
				// keep the same order as filter
				$out = array_replace(array_flip($only_methods), $out[$type]);
			}

			//sort
			sort($out['all']);
			sort($out['standard']);
			sort($out['get']);
			sort($out['set']);
			
			$type and $out=$out[$type];
			
			return $out;
		}
	}

	// -------------------------------------------------------------------------
	private function PrintErrorReport($mode='errors',$total=0, $name='Endpoint'){
		if($mode=='errors'){
			$all_meth_failed=$this->_methods_with_errors;
			$suffix="returning an error";
		}
		elseif($mode='false'){
			$all_meth_failed=$this->_methods_with_false;
			$suffix="returning FALSE";
		}

		$count_err=0;
		if(count($all_meth_failed)){
			//count all errors
			foreach($all_meth_failed as $ecode => $meth_failed){
					$count_err +=count($meth_failed);
			}
	
			//$name=ucfirst($type);
			$stat="$count_err"; $total and $stat.="/$total";
			echo "\n";
			$this->PrintTitleBig( "$stat {$name}s $suffix:",0,'#');

			$err_all	=array();
			$err_by_types=array();
			ksort($all_meth_failed);

			foreach($all_meth_failed as $ecode =>$meth_failed ){
				$count=count($meth_failed);
				$this->PrintTitle( "$count errors of type '$ecode' : ".$this->odev->GetErrorDesc($ecode));
	
				foreach($meth_failed as $meth => $err){
					$this->PrintError( "In $name: $meth .........................");
					echo $this->PrettifyArray($err)."\n";
				}

				$err_all=array_merge($err_all,$meth_failed);
				$err_by_types[$ecode]=$meth_failed;
		
			}
			$this->PrintTitleBig( "List of {$name}s $suffix as Array",60,'*',false); 
			if($mode !='false'){
				//ksort($err_by_types[$ecode]);
				foreach($err_by_types as $ecode => $arr){
					$this->PrintLine("Type '$ecode' : ".$this->odev->GetErrorDesc($ecode));
					echo "['".implode("','",array_keys($err_by_types[$ecode]))."']\n\n";	
				}
				$this->PrintLine("ALL {$name}s $suffix in the same array:");
			}
			echo "['".implode("','",array_keys($err_all))."']\n\n";	

		}

		return $count_err;
	}

	// -------------------------------------------------------------------------
	private function _FormatDefinition($def_array=array(),$pref=''){
		isset($pref['regex'][0]) or $pref['regex'][0]=null ;
		isset($pref['regex'][1]) or $pref['regex'][1]=null ;


		$out=array_combine(['args','state','type','call_index','params','desc'],$def_array);
		$out['params']=$this->_FormatParams($out['params']);
		// makes states ----------------
		$out['f_state_name']=$this->states[$out['state']][0];
		$out['f_state_desc']=$this->states[$out['state']][1];

		// makes args -------------------
		if(is_array($out['args'])){
			$out['f_args_call']	="'".implode("','",	$out['args'])."'";
			$out['f_args_txt']	=implode(',',		$out['args']);
		}
		else{
			$out['f_args_call']	="'{$out['args']}'";
			$out['f_args_txt']	=$out['args'];
		}
		$out['f_method_name']=$this->_makeMethodName($pref['regex'][0], $pref['regex'][1], $out['f_args_txt'], $out['type']);

		//makes call method
		$out['f_call']=$pref['calls'][$out['call_index']][0];

		return $out;
	}

	// -------------------------------------------------------------------------
	private function _FormatArgValue($value){
		if($value=='!'){
			return '';
		}
		else{
			return '="'.$value.'"';
		}
	}

	// -------------------------------------------------------------------------
	private function _FormatParams($in){
		/*
			formats accepted
			- num array : 
				[ 'param1', 'param2' ]
			- num array with some as array: 
				[ 'param1', ['param2','default2','desc2'] ]
				[ 'param1', ['param2','default2',[choices],'desc2'] ]
			- assoc array : 
				[ 'param1'=>'default1', 'param2'=>'default2' ]
			- assoc array  with some values as array: 
				[ 'param1'=>[ 'default1','desc1'], 'param2'=>[ 'default2','desc2'] ]
			- assoc array  with some values as array + choices val=>desc as second array: 
				[ 'param1'=>[ 'default1','desc1'], 'param2'=>[ 'default2',['choice1' =>'choicedesc1','choice2' =>'choicedesc2'],'desc2' ]
		*/

		
		$out=array();
		$out['definitions']			='';
		$out['parameters']			='';
		$out['arguments']			='';
		$out['call_params']			='';
		$out['doc_desc']			='';
		$out['def_value']			='';
		
		if(is_array($in)){

			// num array
			if(isset($in[0])){
				foreach($in as $v){
					if(is_array($v)){
						$k=array_shift($v);
					}
					else{
						$k=$v;
						$v='';
					}
					$k=str_replace('-','_',$k);
					$cleaned[$k]=$v; //reformat aray
				}
			}
			// assoc array
			else{
				$cleaned=$in;
			}
			$out['definitions']	=$cleaned;
			$out['parameters']		="\$params=array(\n";
			$out['call_params']	=', $params';


			foreach($cleaned as $k => $v){
				$doc_desc='';

				// value=[...]
				if(is_array($v)){

					//value='default', ...
					if(is_array($v[1])){

						if(isset($v[2])){
							$doc_desc=$v[2];
						}
	
						//value=[ 'default',['choice1','choice2','...choice_n'],'arr_desc' ]
						if(isset($v[1][0])){
							//num array
							$doc_desc and $doc_desc.=" : ";
							$doc_desc .="either: ". implode(' | ', $v[1]);
						}
						//value=[ 'default', ['choice1'=>'desc_choice1'], 'arr_desc' ]?
						else{
							//assoc array
							$doc_desc .="\n";
							foreach($v[1] as $kk => $vv){
								$doc_desc .="*		'$kk'	: $vv,\n"; //is there a better way for phpdoc?
							}
						}
					}
					//value=['default','desc']
					else{
						//$arg_value=$this->_FormatArgValue($v[0]);
						$doc_desc=$v[1];
					}
					$arg_value=$this->_FormatArgValue($v[0]);
					$out['doc_desc'] .="* @param string \$$k	{$doc_desc}\n";
				}
				//value='default'
				else{
					$arg_value=$this->_FormatArgValue($v);
				}
				$arg_name=str_replace('-','_',$k);
				$out['arguments']	.="\$$arg_name{$arg_value}, ";
				$out['parameters']		.="		'$k'	=> \$$arg_name,\n";	
			}
			$out['arguments']	=substr($out['arguments'], 0, -2);
			$out['parameters']		.="	);";
			$out['doc_desc']	=trim($out['doc_desc']);
		}
		return $out;
	}

	// -------------------------------------------------------------------------
	private $_methods_created=array();
	private $_methods_duplicated=false;	//becomes array when not empty

	/**
	 * Makes methods
	 *
	 *  Takes all endpoints set in the template, and make all the Api function used by the main device class.
	 * 
	 * @param integer $output_mode 	0=only return, 
	 * 								1=screen, 
	 * 								2=file,
	 * 								3=file & screen, 
	 * @param string $file_name 	Name of the output file (saved in the device directory)
	 * @return string 				File content
	 */
	public function BuildMethods($output_mode=0,$file_name='trait.php'){
		if($output_mode){
			$this->PrintTitle("Building trait.php fom the template.php file");
		}
		if(!$this->RequireTemplate()){
			if($output_mode){
				$this->PrintError("Can't find the template.php file!");
			}
			return false;
		}

		
		$pref= & $this->template_prefs;
		$this->_methods_created=array();
		$built=array();

		// TODO: firt sort endpoints by names
		foreach($pref['definitions'] as $def){
				$def=$this->_FormatDefinition($def,$pref);

				// ensure to not recreate the same method fom same endpoint
				if(isset($this->_methods_created[$def['f_method_name']])){
					$this->_methods_duplicated[$def['f_method_name']][]=$def['f_args_txt'];
					continue;
				}
				$this->_methods_created[$def['f_method_name']]=$def;

				// makes category Tag ---------
				$category="Api".ucfirst($def['type']);

				//makes desc ---------------
				$ep_desc='';
				$ep_desc	=$def['desc'] and $ep_desc="* {$def['desc']}\n*";

				// makes arguments & params -------

				// makes template ---------------
				isset($pref['template']) ? $template=$pref['template'] : $template=$this->def_template;
				$block=$template;
				$block=$this->_replaceVar('method',			$def['f_method_name'],			$block);
				$block=$this->_replaceVar('description',	$ep_desc,						$block, true);
				$block=$this->_replaceVar('doc_arguments',	$def['params']['doc_desc'],		$block, true);
				$block=$this->_replaceVar('arguments',		$def['params']['arguments'],	$block);
				$block=$this->_replaceVar('parameters',		$def['params']['parameters'],	$block, true);
				$block=$this->_replaceVar('call',			$def['f_call'],					$block);
				$block=$this->_replaceVar('call_args',		$def['f_args_call'],			$block);
				$block=$this->_replaceVar('call_params',	$def['params']['call_params'],	$block);
				$block=$this->_replaceVar('category',		$category,						$block);
				$block=$this->_replaceVar('state',			$def['state'],					$block);

				//@return
				$doc_arr=array();
				$doc_str=implode("\n* ",$doc_arr) and $doc_str.="\n";
				$block=$this->_replaceVar('return',		'@return Array['.$doc_str.']',		$block);
				
				/*
				//@todo
				$doc_arr=array_keys($this->_indexArrayByFirst($pref['tests'])) or $doc_arr=array();
				$doc_str=implode("',' ",$doc_arr) and $doc_str="@todo Successfully tested on: Array[ '$doc_str' ]";
				$block=$this->_replaceVar('todo',		$doc_str,		$block);
				*/
				
				// makes E_NOTICE happy
				isset($built[$def['type']]) 				or $built[$def['type']]=array();
				isset($built[$def['type']][$def['state']])	or $built[$def['type']][$def['state']]=array();
				$built[$def['type']][$def['state']][] =$block;

				krsort($built[$def['type']]);
		}

		$out='';
		$total_type		=array();
		$total_state	=array();
		foreach($built as $type => $state_txt){
			$total_type[$type]=0;
			$out .="\n";						
			$out .="\n";						
			$out .="\n";						
			$out .="// ##################################################################################\n";						
			$out .="// ## 	'".strtoupper($type)."' API Methods ###########################################################\n";
			$out .="// ##################################################################################\n";		
			foreach($state_txt as $state => $blocks){
				//isset($states[$state]) ? $state_name=$states[$state] : $state_name=$state;
				$state_index=" ".str_pad($this->states[$state][0],11).str_pad($this->states[$state][1],40)." ";
				//$total_state[$state_index]=0;
				$out .="\n";						
				$out .="\n";
				$out .="// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\n";						
				$out .="// +++$state_index".									  "++++++++++++++++++\n";						
				$out .="// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\n";						
				foreach($blocks as $txt){
					$total_type[$type]++;
					@$total_state[$state_index]++;
					$out .=$txt;
				}
				$out .="\n";						
			}
		}

		// output --------------------------------------
		$out .='



// ################################################################################################
// List All methods Definitions ###################################################################
// ################################################################################################

public function ListMethodsDefinitions(){
	$def=array();
';
		foreach($this->_methods_created as $met => $arr){
			$out.= "	\$def['{$met}']=".str_replace("\n",'', var_export($arr,true)).";\n";
		}
		$out .='
	return $def;
}
';
		$out=$this->_enTab($out);


		// output --------------------------------------
		if($output_mode ==1 or $output_mode ==3 ){
			echo $out;
		}
		if($output_mode){
			if($this->_methods_duplicated){
				$this->PrintError("WARNING: the following Method have duplicated EndPoints: ");
				echo $this->PrettifyArray($this->_methods_duplicated);
				$this->PrintLine("	--> The firsts havs been created in the trait.php file, but you should remove it from the template!");
			}
			
			$count=count($this->_methods_created);
			$this->PrintLine("$count methods created!");
			$this->PrintLine("- Methods count by State: \n"	.$this->PrettifyArray($total_state));
			$this->PrintLine("- Methods count by Type: \n"	.$this->PrettifyArray($total_type));
		}

		if($output_mode >1){
			$device_name=ucfirst($this->device);
			$file_content=<<<EOF
<?php
// This file was generated by the HackapiTools::MakesMethods() using template.php
// Please do not modify it manually, but rather add endpoints to the template file, or add more complicated method in the main.php file

trait Hackapi_{$device_name}_Trait {
$out
}
?>
EOF;

			$this->_SaveFile($file_name,$file_content);
		}
		return $out;
	}

	// -------------------------------------------------------------------------
	private function _SaveFile($file_name,$file_content){
		$file_path=$this->path_device.$file_name;

		if(file_exists(dirname($file_path))){
			if(file_put_contents($file_path, $file_content)){
				$this->PrintLine("Successfully saved to: {$file_path}");
			}
			else{
				$this->PrintError("Cannot save to file (Permissions issue?): {$file_path}");
			}
		}
		else{
			$this->PrintError("Cant't save to file: {$file_path}");
		}
	}

	// -------------------------------------------------------------------------
	private function GetInformation(){
		$out=array();

		$info= & $this->template_prefs['information'];
		@list($brand,$family,$name)=explode('_',$this->device);

		isset($info['brand'])	? 	$out['brand']	=$info['brand']	: $out['brand']	=ucfirst($brand);
		isset($info['family'])	?	$out['family']	=$info['family']: $out['family']=$family;
		isset($info['name'])	? 	$out['name']	=$info['name']	: $out['name']	=$name;

		//readme info
		$out['brand_family_name']='';
		$out['brand_family_name']="**".strtoupper($brand)."**";
		$out['family']	and $out['brand_family_name'] .="'s ".ucfirst($out['family']).'s';
		$out['name']	and $out['brand_family_name'] .= " (specifically for model : **{$info['name']}**)";

		//fix english
		$out['brand_family_name']=str_replace(' Boxs',' Boxes',$out['brand_family_name']);

		return $out;
	}

	// -------------------------------------------------------------------------
	public function BuildReadme($output_mode){
		$pref= & $this->template_prefs;
		$class=get_class($this->odev);
		$version=$this->odev->GetClientVersion();
		$info=$this->GetInformation();
		$name=$info['brand_family_name'];
		$out=<<<EOF
# $class v$version

Writen in php, this API client aims to provide a nice interface with $name.

{$pref['readme']}

EOF;
		// tests ---------------------------
		if(is_array($pref['tests']) and count($pref['tests'])){
			$out .=<<<EOF


## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |

EOF;
			foreach($pref['tests'] as $t){
				$t=$this->_FormatTest($t);
				$out .=<<<EOF
| {$t['model']} | {$t['version']} | {$t['f_date']} | {$t['f_author']} | {$t['text']} |

EOF;
			}
		}

		// meth ---------------------------
		$out .=<<<EOF


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*

EOF;

		// here we need a template
		if(isset($pref['definitions']) and count($pref['definitions'])){

			$out.=$this->_MakesReadmeCountReport();

			$out .=<<<EOF


## All Methods available

*The following methods are currently available:*

EOF;
				if($stand_methods=$this->ListApiMethods('standard')){
					$out .=<<<EOF

## Standardized API Methods

| Method |
| ------ |

EOF;
					foreach($stand_methods as $meth){
						$out .="| **{$meth}** |\n";
					}
				}
				$out .=<<<EOF

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |

EOF;

				$definitions=$this->odev->ListMethodsDefinitions();
				ksort($definitions);
				foreach($definitions as $method => $def){		
					$def['desc']=str_replace('|',',',$def['desc']); // prevent colum(s) to be created if we have "|" in the description			
					$out .="| **{$def['f_method_name']}** | {$def['desc']} | {$def['f_state_name']} |\n";
			}
		
		}

		// output --------------------------------------
		if($output_mode ==1 or $output_mode ==3 ){
			echo $out;
		}
		if($output_mode >1){
			$this->_SaveFile('readme.md',$out);
		}
		return $out;
	}

	// -------------------------------------------------------------------------
	// private function _SortMultiLinesArray(& $array,$col_key){
	// 	$col = array_column( $array, $col_key );
	// 	array_multisort( $col, SORT_ASC, $array );
	// }

	// -------------------------------------------------------------------------
	private function _MakesReadmeCountReport(){
		//$class=get_class($this->odev);
		
		$count_standard=0;
		$standard_methods=$this->ListApiMethods('standard');
		if(is_array($standard_methods)){
			$count_standard=count($standard_methods);
		}

		$count_api=$this->_CountMethodsDefinitionsBy('','');
		$count_total=$count_standard + $count_api;
		$out  ="\n\n";
		$out .="## $count_total methods are currently implemented\n\n";

		$count_api and $out .="- **{$count_standard}** standardized methods\n";

		$states=$this->states;
		krsort($states);
		foreach($states as $k => $names){
			if($count=$this->_CountMethodsDefinitionsBy('','state',$k)){
				$out .="- **{$count}** methods with status of **{$names[0]}** ({$names[1]})\n";
			}
		}

		$out.="\n";
		$types=array('get'=>"*Getter* methods (ReadOnly)",'set'=>"*Setter* methods (Writing or performing an action)");
		foreach($types as $t => $tdesc){
			if($count=$this->_CountMethodsDefinitionsBy($t,'')){
				$out .="\n\n### {$count} $tdesc\n\n";
				foreach($states as $k => $names){
					if($count=$this->_CountMethodsDefinitionsBy($t,'state',$k)){
						$out .="- **{$count}** methods with status of **{$names[0]}** ({$names[1]})\n";
					}
				}
			}
		}
		$out  .="\n";
		return $out;
	}

	// -------------------------------------------------------------------------
	private function _FormatTest($row){
		$out=array();
		$out['model']		=trim($row[0]);
		$out['version']		=trim($row[1]);
		$out['date']		=trim($row[2]);
		$out['author']		=trim($row[3]);
		$out['url']			=trim($row[4]);
		$out['text']		=trim($row[5]);

		$out['f_date']		=date('F jS, Y', strtotime($out['date']));
		$out['f_author']	=preg_replace('#^@#','',$out['author']);
		if(preg_match('#^@(.*)#',$out['author'],$m)){
			$out['f_author']=$out['author']; // github will makes the link
		}
		else{
			$out['f_author']=$out['author'];
			$out['url'] and $out['f_author']='['.$out['author'].'](	'.$out['url'].')';
		}
		return $out;
	}

	// -------------------------------------------------------------------------
	public function PrintLine($txt,$start='*'){
		echo "$start $txt\n";
	}

	// -------------------------------------------------------------------------
	public function PrintError($txt,$start='#'){
		echo "$start ERROR: $txt \n";
	}

	// -------------------------------------------------------------------------
	public function PrintTitleBig($txt,$width=0,$fill='*',$with_first_cr=true){
		$start=$fill.$fill;
		$this->PrintTitle("",$width,$fill,$start,$with_first_cr);
		$this->PrintTitle($txt,$width,$fill,$start,false);
		$this->PrintTitle("",$width,$fill,$start,false);
	}

	// -------------------------------------------------------------------------
	public function PrintTitle($txt,$width=0,$fill='*',$start='',$with_cr=true){
		$width or $width=$this->print_width;
		if($txt){
			$txt=" $txt ";
		}
		if($with_cr){
			echo "\n";
		}
		$start or $start=$fill;
		echo str_pad("$start$txt",$width,$fill)."\n";
	}



	// ###############################################################################
	// #### PRIVATE methods ##########################################################
	// ###############################################################################

	// -------------------------------------------------------------------------
	private function PrettifyArray($array){
		return Hackapi::PrettifyArray($array);
	}

	// -------------------------------------------------------------------------
	private function _makeMethodName($search,$replace,$txt,$type){
		//echo "### $search\n";
		$method_name=$txt;
		if($search and $replace){
			$method_name= preg_replace($search,$replace,$txt);
		}
		$method_name=ucfirst($method_name);
		$method_name=str_replace('/',',',$method_name);
		$method_name=str_replace('_',',',$method_name);
		$method_name=str_replace('-',',',$method_name);
		$method_name=str_replace('.',',',$method_name);
		$parts=explode(',', $method_name);
		if(is_array($parts)){
			$method_name='';
			foreach($parts as $part){
				if(strtoupper($part)==$part){
					$part=strtolower($part);
				}
				$method_name.=ucFirst($part);
			}
		}
		return 'Api'.ucfirst($type).$method_name;
	}

	// -------------------------------------------------------------------------
	private function _replaceVar($search,$replace,$txt, $delete_line=false){
		if($delete_line and !$replace){
			$txt= preg_replace('#^.*?\{'.$search.'\}.*?\n#m',	'', $txt);
		}
		$txt= str_replace('{'.$search.'}',	$replace, $txt);
		return $txt;
	}

	// -------------------------------------------------------------------------
	private function _enTab($txt,$num=1){
		$tab='';
		for ($i=0; $i < $num; $i++) { 
			$tab .="\t";
		}
		$out='';
		$lines=explode("\n",$txt);
		foreach ($lines as $line){
			$out .="$tab$line\n";
		}
		return $out;
	}
/*
	// -------------------------------------------------------------------------
	private function _indexArrayByFirst($array){
		$out=array();
		if(is_array($array)){
			foreach($array as $arr){
				$out[$arr[0]]=$arr;
			}
			return $out;
		}
	}
*/

}
?>