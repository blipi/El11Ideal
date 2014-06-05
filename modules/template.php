<?
if(!defined('EL11IDEAL_IN'))
	exit;

class Template{	
	public function select_style(){
		global $user,$mysql,$functions;
		if($functions->config_arr['style_override'] == "false"){
			$a = mysql_fetch_array($mysql->do_query('select style_name from {{table}} where nick="'. $user->username .'"','users'));
			$user->style['name'] = $a['style_name'];
		}else
			$user->style['name'] = $functions->config_arr['style_name'];
			
		if($user->style['name'] == "") $user->style['name'] = $functions->config_arr['style_name'];
		
		define('TEMPLATE_DIR', 'style/' . $user->style['name'] . '/templates/');
		define('USER_STYLENAME',  'style/' . $user->style['name'] .'/');
	}
	
	public function parsetemplate ($templatename, $array, $ext='.tpl')
	{ 
		return utf8_encode(preg_replace('#\{([a-z0-9\-_]*?)\}#Ssie', '( ( isset($array[\'\1\']) ) ? $array[\'\1\'] : \'\' );', $this->gettemplate($templatename, $ext)));
	}
	
	private function gettemplate ($templatename, $ext='.tpl') //string
	{
		return @file_get_contents(EL11IDEAL_PATH . TEMPLATE_DIR . $templatename . $ext);
	}
	
	public function parsetext(&$text, $array){			
		$text = preg_replace('#\{([a-z0-9\-_]*?)\}#Ssie', '( ( isset($array[\'\1\']) ) ? $array[\'\1\'] : \'\' );', $text);
	}
}
?>