<?
//Definim la variable global o constant de seguretat
define('EL11IDEAL_IN', true);
//Incluim l'arxiu "comú" o global
include_once("common.php");

/*	----------------------------------------------------------------------------
 NO M'ACAVA DE CONVENCER TOT EL QUE ESTÀ A PARTIR D'AQUÍ, SEGURAMENT HO CANVIARÉ */
//Simplement evitem que la variable no estigui inicialitzada, no és realment important
if(!isset($functions->vars['GET']['page'])) $functions->vars['GET']['page'] = '';

//Si l'usuari té sessió iniciada
if($user->logged){
	//Comprovem si no te equip, i que la pàgina que visualitza no sigui la de crear equip
	if($user->team->has_team == false && $functions->vars['GET']['page'] != 'teamcreate'){
		//Si les condicions anteriors es compleixen, l'enviem a la pàgina per crear equip.
		header('Location: '. EL11IDEAL_PATH .'game.php?page=teamcreate');
		//Simple mesura de seguretat per si la redirecció no funciona
		exit;
	//Comprovar que l'usuari tingui equip i que no sigui temporal. Si és temporal vol dir que encara no té els jugadors fitxats
	//Comprovem també que no ens trobem a la pàgina de crear equip
	}elseif($user->team->has_team == true && $user->team->is_temp == true && $functions->vars['GET']['page'] != 'playercreate'){
		//Redirigim a crear jugadors
		header('Location: '. EL11IDEAL_PATH .'game.php?page=playercreate');	
		//Simple mesura de seguretat
		exit;
	}
}else
	header('Location: '. EL11IDEAL_PATH .'index.php');
	//No té sessió iniciada, l'enviem a la pàgina principal, no pot estar aquí
/*	----------------------------------------------------------------------------  */

/* Construim el menú esquerre */
$functions->build_menus();
	
//Obtenim la pàgina que està visualitzant
switch($functions->vars['GET']['page'])
{
	//Si es tracta de la pàgina "overview"
	case 'overview':{
		//S'ha d'acavar, no està fet.
		include_once(EL11IDEAL_PATH . 'modules/pages/Overview.php');
	}break;
	
	//A partir d'aquí simplement incluim la pàgina en qüestió
	
	case 'teamcreate':{
		include_once(EL11IDEAL_PATH . 'modules/pages/TeamCreate.php');
	}break;
	
	case 'playercreate':{
		include_once(EL11IDEAL_PATH . 'modules/pages/PlayerCreate.php');
	}break;
		
	case 'tactics':{
		include_once(EL11IDEAL_PATH . 'modules/pages/SetTactics.php');
	}break;
	
	case 'align':{
		include_once(EL11IDEAL_PATH . 'modules/pages/SetAlign.php');
	}break;
	
	case 'training':{
		include_once(EL11IDEAL_PATH . 'modules/pages/Training.php');
	}break;
	
	//En cas de que no sigui cap de les pàgines anteriors, mostrem la pàgina "overview"
	default:{
		include_once(EL11IDEAL_PATH . 'modules/pages/Overview.php');
	}break;
}

//Tampoc m'acava de convèncer, i menys ara que he implementat la funció per parseixar per separar la header, body i ending
//però de moment es quedarà aquí, degut a que no se si hi és per algo en especial
//probablement serà eliminada aquesta funció, i substiuida per $functions->build_footer(true);
$debug->pop();
?>