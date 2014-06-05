<?
//Definim la variable global o constant de seguretat
define('EL11IDEAL_IN', true);
//Incluim l'arxiu "com�" o global
include_once("common.php");

/*	----------------------------------------------------------------------------
 NO M'ACAVA DE CONVENCER TOT EL QUE EST� A PARTIR D'AQU�, SEGURAMENT HO CANVIAR� */
//Simplement evitem que la variable no estigui inicialitzada, no �s realment important
if(!isset($functions->vars['GET']['page'])) $functions->vars['GET']['page'] = '';

//Si l'usuari t� sessi� iniciada
if($user->logged){
	//Comprovem si no te equip, i que la p�gina que visualitza no sigui la de crear equip
	if($user->team->has_team == false && $functions->vars['GET']['page'] != 'teamcreate'){
		//Si les condicions anteriors es compleixen, l'enviem a la p�gina per crear equip.
		header('Location: '. EL11IDEAL_PATH .'game.php?page=teamcreate');
		//Simple mesura de seguretat per si la redirecci� no funciona
		exit;
	//Comprovar que l'usuari tingui equip i que no sigui temporal. Si �s temporal vol dir que encara no t� els jugadors fitxats
	//Comprovem tamb� que no ens trobem a la p�gina de crear equip
	}elseif($user->team->has_team == true && $user->team->is_temp == true && $functions->vars['GET']['page'] != 'playercreate'){
		//Redirigim a crear jugadors
		header('Location: '. EL11IDEAL_PATH .'game.php?page=playercreate');	
		//Simple mesura de seguretat
		exit;
	}
}else
	header('Location: '. EL11IDEAL_PATH .'index.php');
	//No t� sessi� iniciada, l'enviem a la p�gina principal, no pot estar aqu�
/*	----------------------------------------------------------------------------  */

/* Construim el men� esquerre */
$functions->build_menus();
	
//Obtenim la p�gina que est� visualitzant
switch($functions->vars['GET']['page'])
{
	//Si es tracta de la p�gina "overview"
	case 'overview':{
		//S'ha d'acavar, no est� fet.
		include_once(EL11IDEAL_PATH . 'modules/pages/Overview.php');
	}break;
	
	//A partir d'aqu� simplement incluim la p�gina en q�esti�
	
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
	
	//En cas de que no sigui cap de les p�gines anteriors, mostrem la p�gina "overview"
	default:{
		include_once(EL11IDEAL_PATH . 'modules/pages/Overview.php');
	}break;
}

//Tampoc m'acava de conv�ncer, i menys ara que he implementat la funci� per parseixar per separar la header, body i ending
//per� de moment es quedar� aqu�, degut a que no se si hi �s per algo en especial
//probablement ser� eliminada aquesta funci�, i substiuida per $functions->build_footer(true);
$debug->pop();
?>