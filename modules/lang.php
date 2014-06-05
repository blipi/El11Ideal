<?
if(!defined('EL11IDEAL_IN'))
	exit;

class Lang{	
	var $config=array();
	var $init=false;

	public function select_lang(){
		global $user,$mysql,$functions,$lng;
		
		if($user->logged && $functions->config_arr['lang_override'] == 'false'){
			$a = mysql_fetch_array($mysql->do_query('select lang_name from {{table}} where id="'. $user->id .'"','users'));
			if($a['lang_name'] != '') $user->lang['name'] = $a['lang_name'];
		}elseif($user->logged)
			$user->lang['name'] = $functions->config_arr['lang_name'];
		
		if(isset($functions->vars['COOKIE']['LANG']))
			$user->lang['name'] = $functions->vars['COOKIE']['LANG'];
			
		if(!isset($user->lang['name']) || $user->lang['name'] == '') $user->lang['name'] = $functions->config_arr['lang_name'];
		
		$lng = array();
		
		define('LANGUAGE_DIR', 'lang/' . $user->lang['name'] . '/');
		define('USER_LANGNAME', $user->lang['name']);
	}
	
	public function parselang($filename, $ext = '.lng'){
		global $lng, $user;
		include (EL11IDEAL_PATH . LANGUAGE_DIR . $filename.$ext);
	}
}
?>