<?
	define('EL11IDEAL_IN', true);
	include_once('common.php');

	/*
	DEPRECATED:
	
	if(isset($functions->vars['GET']['m'])){
		$lang->parselang('msg');
			$r['MSG'] = '<div style="margin:1px; text-align:center; border:1px solid #000000;  background-color:'. ((strpos($functions->vars['GET']['m'], 'e') >		 			-1)?'#990000':'#0D750A') .';" id="msg_div">'. ((strpos($functions->vars['GET']['m'], 'e') > -1)?$r['MSG_' . substr($functions->vars['GET']['m'], 1,				            strlen($functions->vars['GET']['m']-1))]:$r['MSG_' . $functions->vars['GET']['m']]) . '</div><br>';
	}else $r['MSG'] = '';*/
	
	//En cas de que no tingui sessió inicida
	if(!$user->logged){	
		//Fem els menus
		$functions->build_menus();
		
		//Mostrem la capcelera (header)
		$functions->build_common_header();
		//Obtenim les frases del idioma actual de l'índex
		$lang->parselang('index');		
		//Nota: Tot i que ara hi digui això, serà substituit el die(), no l'interior, per $functions->build_footer(true);
		die($template->parsetemplate('index', $lng));
	}else
		header('LOCATION: game.php');
		//Té sessió iniciada, l'enviem a la pàgina del joc (game)
?>