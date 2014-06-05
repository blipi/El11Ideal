<?	
//Medida de seguridad para que no se acceda sin permiso!
if(!defined('EL11IDEAL_IN'))
	exit;
	
	//Comprobamos que no tenga club ya
	if($user->team->has_team == true){
		//Si tiene un club, esto se deberia mejorar y comprobar el numero de jugadores de ese club,
		//de ser iguales al máximo comprobar que el club no esté ya registrado (sin temp=1)
		//de no ser asi registrarlo (temp=0), y si fuera 1 echar un error
		//Indicamos que se trata de un club ya existente (new=0)
		//Aun que se deberia comprobar si numero_jugadores=0 => new=1, sino new=0
		if($user->team->is_temp == true) header('LOCATION: game.php?page=playercreate');
		else header('LOCATION: game.php');
	}

	$lang->parselang('teamcreate');
		
	//Comprobamos que no se trate de el registro del club
	if(!isset($functions->vars['GET']['check']) || $functions->vars['GET']['check'] != 1){
		//No es registro nuevo, es el formualrio	
		$lang->parselang('countries');	
		echo $template->parsetemplate('team_create', $lng);
		$functions->build_footer(true);
	}else{
		//Estamos registrando el club (temp=1)
		//Dejamos preparada la variable de error por si acaso, de no haber error no será mostrada.
		$main_error_str = '<tr><td colspan="2"><div style="margin-bottom: 5px; background-color:#770000; border: 1px solid #000000; color: #FFFFFF; text-align:center; font-weight: bold;">';
		$error = 0;
		
		//Campos vacios?
		if(!isset($functions->vars['POST']['team_name']) || $functions->vars['POST']['team_name'] == '' || !isset($functions->vars['POST']['team_country']) || $functions->vars['POST']['team_country'] == ''){
			$error += 1;
			$lng['ERR'] = $main_error_str . $lng['TEAM_INFO_NOT_RECIVED'];
		}
		
		//No hay error?
		if($error == 0){
			//El club ya existe?
			$query = $mysql->do_query('select id from {{table}} where p_id=' . $user->id, 'clubs');
			if(mysql_num_rows($query) > 0){
				$lng['ERR'] = $main_error_str . $lng['ERROR_ALREADY_CREATED'];
				$error += 1;
			}
		}
		
		//No hay error?
		if($error == 0){
			//Registramos el club
			if($mysql->do_query('insert into {{table}} (p_id, nombre, pais) values (' . $user->id . ',"' . $functions->vars['POST']['team_name'] . '","' . $functions->vars['POST']['team_country'] . '")', 'clubs','',false)){
				//Ha ido bien, indicamos que se trata de un club nuevo (new=1)
				header('LOCATION: game.php?page=playercreate&new=1');		
			}else{
				$lng['ERR'] = $main_error_str . $lng['UNEXPECTED_TEAM_REG_ERROR'];
				$error += 1;
			}
		}
		
		//Hay error?
		if($error > 0){
			//Ha habido un error
			$lng['ERR'] .= '</div></td></tr>';
			$lang->parselang('countries');	
			echo $template->parsetemplate('team_create', $lng);
			$functions->build_footer(true);
		}
			
	}
?>