<?
//Si no està definida la variable global sortim
if(!defined('EL11IDEAL_IN'))
	exit;

//Clase funcions
class Functions{
	//Arregle o array de configuració
	var	$config_arr = array();
	//Las variables POST, GET i SESSION segures
	var $vars = array(array());
	
	//Configura la array de configuració amb els seus valors
	public function recursive_config_array($query, $return=false){
		//Obtenim els valors i els possem dins la array
		while ( ($row = mysql_fetch_assoc($query)) != NULL )
			$this->config_arr[$row['config_name']] = $row['config_value'];
		
		//Si estem fent DEBUG actiu, enviem que la funció ha estat correctament executada
		if(defined('DEBUG')){ 
			global $debug;
			$debug->push('FUNCTIONS_CONFIG', 'RESULT_ARRAY',  $this->config_arr);
		}
			
		//Si voliem que retornés un valor, retornem la array de configuració
		if($return) return $this->config_arr;
	}

	//Inicialitza el sistema de seguretat
	public function init_vars(){
		//Primer establim la array amb cada un dels valors, separats, per tal de no sobreescriure
		$this->vars = array('POST' => $_POST, 'GET' => $_GET, 'SESSION' => $_SESSION, 'COOKIE' => $_COOKIE);
		//Per cada valor principal (POST, GET, SESSION, COOKIE)
		foreach($this->vars as $k => $v){
			//Si conté més d'una entrada
			if (sizeof($this->vars[$k]) > 0)
				//Per cada entrada (subvalor) que trobem
				foreach($this->vars[$k] as $sk => $sv){
					//Apliquem htmlspecialschars per evitar injeccions SSX o d'altres semblants
					$this->vars[$k][$sk] = htmlspecialchars($sv);
					//A no ser que no estiguem conectats a la DB, apliquem mysql_real_escape_string, per evitar injeccions SQL
					if(!defined('MYSQL_NOTCONECT'))$this->vars[$k][$sk] = mysql_real_escape_string($this->vars[$k][$sk]);
				}
		}
		
		if(defined('DEBUG')){ 
			global $debug;
			$debug->push('FUNCTIONS_INITVARS', 'RESULT',  true);
		}
		
	}
	
	public function build_menus(){
		global $user, $lng, $lang, $template;
		
		$lang->parselang('upper_menu');
		$lng['UPPER_MENU'] = utf8_decode($template->parsetemplate('upper_menu', $lng));
		
		if($user->logged){
			$lang->parselang('left_menu');
			$lng['LEFT_MENU'] = utf8_decode($template->parsetemplate('left_menu', $lng));
			
			$lang->parselang('right_menu');
			$lng['RIGHT_MENU'] = utf8_decode($template->parsetemplate('right_menu', $lng));
		}
	}
	
	public function build_common_header($scriptsarray = NULL){
		global $template, $lng;
		$script_str = '';
		$script_include = 0;
		if($scriptsarray != NULL){
			$script_str .= '<script>';
			foreach ($scriptsarray as $v){
				$script = @file_get_contents(EL11IDEAL_PATH . 'scripts/' . $v);
				$template->parsetext($script, $lng);
				$script_str .= $script; 
			}
			$script_str .= '</script><br>';
			$script_include = 1;
		}
		$script_array = array('SCRIPT' => $script_str);
		$script_array = array_merge($script_array, $lng);
			
		$temp = $template->parsetemplate('common_header', $script_array);
		
		if(defined('DEBUG')){ 
			global $debug;
			$debug->push('FUNCTIONS_BUILDCOMMONHEADER', 'RESULT',  $script_include);
		}
		
		echo $temp;
	}
	
	public function build_footer($die = true){
		global $debug;
		if(defined('DEBUG')) $debug->pop();
		$debug->unset_all();
		if($die) exit;
	}
}
?>