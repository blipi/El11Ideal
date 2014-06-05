<?
	//Mesura de seguretat per evitar que aquesta p�gina sigui visualitzada fora de lloc
	//Dit d'altre forma, solament pot estar incluida en algun lloc on hi estigui definiti "EL11IDEAL_IN"
	if(!defined('EL11IDEAL_IN'))
		exit;
	
	//Comprovem si existeix una variable general que ens indica la ruta (path) als arxius m�s importants
	//En cas de que no estigui definada, donem per fet que ens trobem a la ruta principal (root ./)
	if(!defined('EL11IDEAL_PATH'))
		define('EL11IDEAL_PATH', './');
	
	//Simplement definim la versi�, no t� cap mena d'utilitat ara per ara
	define('EL11IDEAL_VERSION', '1.3.7');
	
/*
ATENCI�N: La clase DEBUG �s utilitzada �nica i exclusivament per tenir control sobre totes les consultes (queries) que fem a la base de dades (DB), sobre algunes de les funcions m�s cr�tiques i per controlar els possibles errors.
Clar est� que quan es publiqui el joc aquesta constant o variable global "DEBUG" no pot estar definida, ja que no volem que els nostres clients vegin les consultes SQL!
Aix� mateix com m�s endavant hi haur� una classe Error, que s'encarregar� d'enviar la pertinent resposta a l'usuari i al mateix temps d'emmagatzemar l'error a la DB i/o en un arxiu.
*/
	define('DEBUG', true);
	
	//Incluim la classe utilitzada per comprovar la validesa de la funci�
	include_once(EL11IDEAL_PATH.'modules/session.php');
	//Incluim la classe utilitzada per comunicar-nos amb la DB
	include_once(EL11IDEAL_PATH.'modules/mysql.php');
	//Incluim la classe que cont� les funcions principals
	include_once(EL11IDEAL_PATH.'modules/functions.php');
	//Incluim la classe que ens permet interpretar les plantilles (templates) i passar-les a HTML acceptable
	include_once(EL11IDEAL_PATH.'modules/template.php');
	//Incluim la classe que ens permet interpretar les plantilles i canviar les variables a l'idioma desitjat
	include_once(EL11IDEAL_PATH.'modules/lang.php');
	//Incluim la classe principal, usuari, club i jugadors.
	include_once(EL11IDEAL_PATH.'modules/user.php');
	
	//Incluim la clase utilitzasa per depurar el joc
	include_once(EL11IDEAL_PATH.'modules/debug.class.php');	
	if(defined('DEBUG')) $deb = true; else $deb = false;
	$debug = new Debug($deb);	
	// Inicialitzem la classe Debug, i decidim si volem que s'ensenyi o no el resultat de la depuraci�
	
	//Inicialitzem totes les classes
	//L'ordre �s molt important per el bon funcionament del joc!
	$session = new Session();
	$mysql = new Mysql();
	$user = new User();
	$functions = new Functions();
	$template = new Template();
	$lang = new Lang();
	
	//Connectem a la base de dades
	$mysql->connect();
	//Obtenim els valors de la taula de configuraci� del joc
	$quer = $mysql->do_query('select * from {{table}}', "config");
	
	//Incialitzem les mesures de seguretat del joc
	$functions->init_vars();
	//Incialitzem la configuraci� del joc
	$functions->recursive_config_array($quer);
	
	//Comprovem si l'usuari t� sessi� inicialitzada o no
	$user->check_log();
	
	//Inicialitzem les mesures de seguretat per evitar falsificaci� d'IP
	$session->init();
	
	//Seleccionem l'estil que est� fent servir l'usuari
	$template->select_style();
	//Seleccionem l'idioma que est� fent servir l'usuari
	$lang->select_lang();
	
	//GRAN CHAPUZA que ser� canviada quan abans millor
	if($user->lang['name'] == 'es'){
		$r['SEL1'] = 'selected';
		$r['SEL2'] = '';
		$r['SEL3'] = '';
	}elseif($user->lang['name'] == 'ca'){
		$r['SEL1'] = '';
		$r['SEL2'] = 'selected';
		$r['SEL3'] = '';	
	}elseif($user->lang['name'] == 'en'){
		$r['SEL1'] = '';
		$r['SEL2'] = '';
		$r['SEL3'] = 'selected';	
	}
	
	//Petit arreglo per mostrar b� tot (EL possem en un arxiu global perqu� casi sempre �s utilitzat)
	$lang->parselang('public');
?>