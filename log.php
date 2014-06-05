<?
	//Definim la variable global o constant de seguretat
	define('EL11IDEAL_IN', true);
	//Incluim l'arxiu global o comú
	include_once('common.php');
	
	//Incluim l'arxiu d'idioma de misatges
	$lang->parselang('msg');
	
	//Iniciem sessio ($user->log_in(...) : bool)
	if($user->log_in($functions->vars['POST']['nick'], $functions->vars['POST']['pass']))
		$lng['MSG'] = $lng['LOG_IN'] .', <b>'. $functions->vars['POST']['nick'] .'</b><br><a href="index.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=index.php"> ';
	else
		$lng['MSG'] = $lng['USER_OR_PASS_INCORRECT'] . '<br><a href="index.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=index.php"> ';
	
		//S'inicia bé, mostrem missatge que ha iniciat sessió
		// else (sino)
		//No s'ha pogut iniciar (usuari i/o contrasenya incorrecte/s). Mostrem missatge

	//El die() serà canviat per el parse ending
	die($template->parsetemplate('temp', $lng));
?>