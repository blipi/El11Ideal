<?
	//Definim la variable global o constat
	define('EL11IDEAL_IN', true);
	//Incluim l'arxiu global o com�
	include_once('common.php');
	
	//Obtenim les frases de l'idioma actual
	$lang->parselang('register');
	
	$functions->build_menus();
	
	//Si no ha enviat el formulari
	if(!isset($functions->vars['GET']['r']))
		echo $template->parsetemplate('register', $lng); //Mostrem la p�gina de registre
	else{
		//Si s� la enviat
		//Construim la part general del missatge a mostrar (tan si es registra b� com si no)
		$common_msg = '<div style="margin-bottom: 5px; background-color:#770000; border: 1px solid #000000; color: #FFFFFF; text-align:center; font-weight: bold;">';
		//Construim el final com� del missatge
		$common_end = '</div>';
		//Obtenim les frases de l'idioma actual
		$lang->parselang('msg');

		//Guardem en una variable el resultat de registrar l'usuari, ja que hem de saber si s'ha fet b� o no
		$r = $user->register($functions->vars['POST']['nick'],$functions->vars['POST']['pass'],$functions->vars['POST']['nombre'],$functions->vars['POST']['apellidos'],$functions->vars['POST']['email']);
		if ($r == 2){
			//Si el resultat �s 2, vol dir que l'usuari ja existeix
			$lng['ERR'] = $common_msg . $lng['USERNAME_ALREADY_EXISTS'] . $common_end;	
			echo $template->parsetemplate('register', $lng);
			exit;
		}elseif($r == 3){
			//Si l'usuari es 3, vol dir que hi ha hagut un error inesperat.
			//No hauria d'oc�rrer
			$lng['ERR'] = $common_msg . $lng['UNEXPECTED_ERROR'] . $common_end;	
			echo $template->parsetemplate('register', $lng);
			//Aquest exit hauria de ser substituit per, parse_ending
			exit;
		}
		
		//Intentem iniciar la sessi� per estalviar feina al client
		if(!$user->log_in($functions->vars['POST']['nick'],$functions->vars['POST']['pass'])){
			//Si no ho aconseguim, mostrem un missatge al client conforme est� registrat per� sense sessi� iniciada
			//segurament es canviar� el missatge hi mostrarem que, est� registrar i ja pot iniciar sessi�,
			//enlloc de dir que hi ha hagut un error
			$lng['MSG'] = '<b>' . $lng['REGISTERED_NOT_LOGED_IN_1'] .', '. $functions->vars['POST']['nick'] .'</b>' . $lng['REGISTERED_NOT_LOGED_IN_1'] . '<br><a href="index.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=playercreate"> ';			
			//Mostrer la pantalla del missatge
			echo $template->parsetemplate('temp', $lng);
			//exit... -> parse_ending()
			exit;
		}
		//Construim el missatge de que est� registrat i amb sessi� iniciada
		$lng['MSG'] = '<b>' . $lng['REGISTERED_FINE'] .', '. $functions->vars['POST']['nick'] .'</b><br><a href="index.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=playercreate"> ';			
		//Mostrem el missatge comforme tot ha anat b�.
		echo $template->parsetemplate('temp', $lng);
	}
?>