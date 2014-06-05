<?
	//Definim la variable global o constant de seguretat
	define('EL11IDEAL_IN', true);
	//Incluim l'arxiu global o comú
	include_once('common.php');
	
	//Guardem el nom d'usuari abans de borrar-lo, per després poder mostrar-lo
	$username = $user->username;
	//Tanquem la sessió de l'usuari
	$user->log_out();
	
	//Obtenim les frases de l'idioma actual
	$lang->parselang('msg');	
	//Construim el misatge a mostarr
	$str = $lng['LOG_OUT'] .', <b>'. $username .'</b><br>';
	$str .= '<a href="index.php">'. $lng['REDIRECT'] .'</a><br><br>';
	$str .= '<meta HTTP-EQUIV="REFRESH" content="5; url=index.php"> ';
	//Posem a la variable d'idioma missatge el missatge que acavem de construir
	$lng['MSG'] = $str;
	
	//Com sempre el die serà canviat
	die($template->parsetemplate('temp', $lng));
?>