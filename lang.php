<?
	//Definim la variable global o constant de seguretat
	define('EL11IDEAL_IN', true);
	//Incluim l'arxiu general o comú
	include_once('common.php');

	/*
		AQUÍ HI HA MOLT A FER
		Cal comprovar si l'idioma és vàlid (comprovant l'existència de l'arxiu d'idioma
		Cal enviar un missatge de comfirmació o refutació
	*/
	
	//Si l'usuari té sessió iniciada
	if($user->logged){
		//Actualitzem la variable d'idioma de l'usuari en la DB
		$mysql->do_query('update {{table}} set lang_name="'. $functions->vars['GET']['l'] .'" where id='. $user->id,'users');
		//Simplement redirigim a l'índex, serà canviat
		header('LOCATION: index.php');	//MISSATGE DE COMFIRMACIO?
	}else{
		//Instaurem la cookie de llenguatge, degut a que no té sessió iniciada i per tant no té lloc a la DB
		setcookie('LANG',$functions->vars['GET']['l'],0);
		//Simplement redirigim a l'index, serà canviat
		//No podem utilitzar la funció de PHP header() degut a que la funció anterior interfereix en el seu funcionament
		//Utilitzo <script> degut a que és més ràpid i crec que fiable que no pas el HTML <meta>
		echo "<script>location.href='index.php'</script>";	//MISSATGE DE COMFIRMACIO?
	}
?>