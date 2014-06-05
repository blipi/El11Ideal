<?
	//Definim la variable global o constant de seguretat
	define('EL11IDEAL_IN', true);
	//Incluim l'arxiu general o com�
	include_once('common.php');

	/*
		AQU� HI HA MOLT A FER
		Cal comprovar si l'idioma �s v�lid (comprovant l'exist�ncia de l'arxiu d'idioma
		Cal enviar un missatge de comfirmaci� o refutaci�
	*/
	
	//Si l'usuari t� sessi� iniciada
	if($user->logged){
		//Actualitzem la variable d'idioma de l'usuari en la DB
		$mysql->do_query('update {{table}} set lang_name="'. $functions->vars['GET']['l'] .'" where id='. $user->id,'users');
		//Simplement redirigim a l'�ndex, ser� canviat
		header('LOCATION: index.php');	//MISSATGE DE COMFIRMACIO?
	}else{
		//Instaurem la cookie de llenguatge, degut a que no t� sessi� iniciada i per tant no t� lloc a la DB
		setcookie('LANG',$functions->vars['GET']['l'],0);
		//Simplement redirigim a l'index, ser� canviat
		//No podem utilitzar la funci� de PHP header() degut a que la funci� anterior interfereix en el seu funcionament
		//Utilitzo <script> degut a que �s m�s r�pid i crec que fiable que no pas el HTML <meta>
		echo "<script>location.href='index.php'</script>";	//MISSATGE DE COMFIRMACIO?
	}
?>