<?
if(!defined('EL11IDEAL_IN'))
	exit;

	if($user->team->has_team == true && $user->team->is_temp == false)
		header('LOCATION: game.php'); //El equipo ya esta creado, redirigimos al juego	

	
	$lang->parselang('playercreate');
		
	function register_club($is_last_player = false){
		global $lng, $lang, $mysql, $user, $template, $functions;
		$lang->parselang('msg');
		
		$user->team->register_players();			
		
		if($mysql->do_query('UPDATE {{table}} set c_id=' . $user->team->id . ' where id=' . $user->id, 'users', '', false)){
			if($mysql->do_query('UPDATE {{table}} set temp=0 where id=' . $user->team->id, 'clubs', '', false))	
				$lng['MSG'] = (($is_last_player==true)?$lng['LAST_PLAYER'] . '<br>':'') . '<b>' . $lng['CLUB_PLAYERS_CREATED'] .', '. $functions->vars['POST']['nick'] .'</b><br><a href="game.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php"> ';
			else 
				$lng['MSG'] = '<b>' . $lng['CLUB_PLAYERS_ERROR_CREATE'] .' (2), '. $functions->vars['POST']['nick'] .'</b><br><a href="game.php?page=playercreate">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=playercreate"> ';
		}else 
			$lng['MSG'] = '<b>' . $lng['CLUB_PLAYERS_ERROR_CREATE'] .' (1), '. $functions->vars['POST']['nick'] .'</b><br><a href="game.php?page=playercreate">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=playercreate"> ';
			
		echo $template->parsetemplate('temp', $lng);
		$functions->build_footer(true);
	}	
		
	function set_main_info(){
		global $lng, $user, $mysql;
		$lng['P_CURRENT'] = $user->team->get_players_num_bypos(1);
		$lng['D_CURRENT'] = $user->team->get_players_num_bypos(2);
		$lng['MD_CURRENT'] = $user->team->get_players_num_bypos(3);
		$lng['MA_CURRENT'] = $user->team->get_players_num_bypos(4);
		$lng['DEL_CURRENT'] = $user->team->get_players_num_bypos(5);
		$lng['N_F'] = $user->team->get_players_num();
		
		if(isset($_SESSION['ERR']) && $_SESSION['ERR'] != ''){
			$lng['ERR'] = $_SESSION['ERR'];
			unset($_SESSION['ERR']);
		}
		
		$mysql->do_query('DELETE FROM {{table}} WHERE p_id = ' . $user->id, 'temp_players', '', false);
			
		$while_gen = true;
		$run1 = false;
		$run2 = false;
		$run3 = false;
		$run4 = false;
		$run5 = false;
		while($while_gen && !($run1 && run2 && run3 && run4 && run5)){
			$rnd_value = rand(1, 5);
			switch($rnd_value){
				case 1: if($user->team->get_players_num_bypos(1) < 3){ $while_gen = false; $run1 = true; }break;
				case 2: if($user->team->get_players_num_bypos(2) < 7){ $while_gen = false; $run2 = true; }break;
				case 3: if($user->team->get_players_num_bypos(3) < 5){ $while_gen = false; $run3 = true; }break;
				case 4: if($user->team->get_players_num_bypos(4) < 5){ $while_gen = false; $run4 = true; }break;
				case 5: if($user->team->get_players_num_bypos(5) < 5){ $while_gen = false; $run5 = true; }break;
			}
		}
		
		switch($rnd_value){
			case 1:{
				$lng['MIN0'] = round(rand(rand(rand(35,40), 50), rand(55,70)),0) * 2; //PORTER
				$lng['MIN1'] = round(rand(rand(rand(30,45), 50), rand(55,70)),0) * 2; //AGILITAT
				$lng['MIN2'] = round(rand(rand(rand(30,40), 55), rand(55,70)),0) * 2; //REFLEXOS
			}break;
			case 2:{
				$lng['MIN1'] = round(rand(rand(rand(30,45), 50), rand(50,60)),0) * 2; //AGILITAT
				$lng['MIN2'] = round(rand(rand(rand(30,40), 55), rand(55,60)),0) * 2; //REFLEXOS
				$lng['MIN3'] = round(rand(rand(rand(35,40), 50), rand(55,70)),0) * 2; //DEFENSA
				$lng['MIN4'] = round(rand(rand(rand(30,40), 50), rand(50,65)),0) * 2; //PRECISIÓ
			}
			case 3:{
				//$lng['MIN1'] = round(rand(rand(rand(30,35), 45), rand(45,55)),0) * 2; //AGILITAT
				//$lng['MIN2'] = round(rand(rand(rand(30,40), 45), rand(45,55)),0) * 2; //REFLEXOS
				$lng['MIN3'] = round(rand(rand(rand(35,40), 50), rand(55,65)),0) * 2; //DEFENSA
				$lng['MIN4'] = round(rand(rand(rand(30,40), 50), rand(50,70)),0) * 2; //PRECISIÓ	
				$lng['MIN5'] = round(rand(rand(rand(30,40), 50), rand(45,55)),0) * 2; //POTÈNCIA	
			}
			case 4:{
				$lng['MIN4'] = round(rand(rand(rand(30,40), 50), rand(50,70)),0) * 2; //PRECISIÓ	
				$lng['MIN5'] = round(rand(rand(rand(30,40), 50), rand(45,60)),0) * 2; //POTÈNCIA	
				$lng['MIN6'] = round(rand(rand(rand(30,40), 50), rand(50,70)),0) * 2; //ATAC	
				$lng['MIN7'] = round(rand(rand(rand(35,40), 55), rand(55,70)),0) * 2; //VELOCITAT				
			}
			case 5:{
				$lng['MIN4'] = round(rand(rand(rand(30,40), 50), rand(50,65)),0) * 2; //PRECISIÓ	
				$lng['MIN5'] = round(rand(rand(rand(30,45), 50), rand(55,70)),0) * 2; //POTÈNCIA	
				$lng['MIN6'] = round(rand(rand(rand(30,40), 50), rand(55,70)),0) * 2; //ATAC	
				$lng['MIN7'] = round(rand(rand(rand(35,40), 55), rand(55,65)),0) * 2; //VELOCITAT
			}
		}	
		for($i = 0; $i <= 7; $i++){
				if(!isset($lng['MIN' . $i])) $lng['MIN' . $i] = rand(40,60);
				$lng['MAX' . $i] = 200;
				$lng['CURRENT' . $i] = $lng['MIN' . $i];
				$lng['S_CURRENT' . $i] =  round($lng['MIN' . $i] / 200 * 100,1);
		}
		$lng['M_POINTS'] = 30; // ( x/2 = PUNTS REALS)
		
		$mysql->do_query('INSERT INTO {{table}} (p_id, port, agl, refl, def, prec, pot, atc, vel) values (' .
		$user->id . ',' .
		(int)$lng['MIN0'] . ',' .
		(int)$lng['MIN1'] . ',' .
		(int)$lng['MIN2'] . ',' .
		(int)$lng['MIN3'] . ',' .
		(int)$lng['MIN4'] . ',' .
		(int)$lng['MIN5'] . ',' .
		(int)$lng['MIN6'] . ',' .
		(int)$lng['MIN7'] . ')', "temp_players");
	}
	
	$main_confirm_str = '<tr><td colspan="2"><div style="margin-bottom: 5px; background-color:#007700; border: 1px solid #000000; color: #FFFFFF; text-align:center; font-weight: bold;">';
	$main_info_str = '<tr><td colspan="2"><div style="margin-bottom: 5px; background-color:#D2691E; border: 1px solid #000000; color: #FFFFFF; text-align:center; font-weight: bold;">';
	$main_error_str = '<tr><td colspan="2"><div style="margin-bottom: 5px; background-color:#770000; border: 1px solid #000000; color: #FFFFFF; text-align:center; font-weight: bold;">';
	
	if(!isset($functions->vars['GET']['check']) || $functions->vars['GET']['check'] != 1){
		
		if((int)$functions->vars['GET']['new'] == 1)
			$lng['ERR'] = $main_confirm_str . $lng['TEAM_CREATED'] . '</div></td></tr>';
		else
			$lng['ERR'] = $main_info_str . (((int)$functions->vars['GET']['new'] == 0)?$lng['TEAM_WAS_CREATED']:$lng['TEAM_PLAYERS_EXIST']) . '</div></td></tr>';
		
		set_main_info();
			
		$functions->build_common_header(array('main.js', 'bars.js', 'ajax.js', 'player_create.js'));
		
		echo $template->parsetemplate('player_create', $lng);
		$functions->build_footer(true);
	}else{
		$error = 0;
		
		//Numero de jugadores >= 16?
		if($user->team->get_players_num() >= 16)
			register_club();
		
		//Campos vacios?
		if(!isset($functions->vars['POST']['player_name']) || $functions->vars['POST']['player_name'] == '' 
			|| !isset($functions->vars['POST']['player_surname']) || $functions->vars['POST']['player_surname'] == ''
			|| !isset($functions->vars['POST']['player_pos']) || $functions->vars['POST']['player_pos'] == ''			){
			$error += 1;
			$lng['ERR'] = $main_error_str . $lng['PLAYER_INFO_NOT_RECIVED'];
		}
		
		//No hi ha hagut cap error?
		if($error == 0){
			$tPoints = (int)($functions->vars['POST']['p0']);
			$tPoints += (int)($functions->vars['POST']['p1']);
			$tPoints += (int)($functions->vars['POST']['p2']);
			$tPoints += (int)($functions->vars['POST']['p3']);
			$tPoints += (int)($functions->vars['POST']['p4']);
			$tPoints += (int)($functions->vars['POST']['p5']);
			$tPoints += (int)($functions->vars['POST']['p6']);
			$tPoints += (int)($functions->vars['POST']['p7']);
			if($tPoints > 15){
				$error += 1;
				$lng['ERR'] = $main_error_str . $lng['PLAYER_POINTS_EXCEED'];
			}
		}
		
		//No hay error?
		if($error == 0){
			//El jugador ya existe?
			$query = $mysql->do_query('select id from {{table}} where nombre="' . $functions->vars['POST']['player_name'] . '" and apellidos="' . $functions->vars['POST']['player_surname'] . '" and p_id=' . $user->id, 'players');
			if(mysql_num_rows($query) > 0){
				$lng['ERR'] = $main_error_str . $lng['ERROR_ALREADY_CREATED'];
				$error += 1;
			}
		}
		
		//No hay error?
		if($error == 0){
			//Comprobamos que haya un jugador de cada tipo como minimo o aun haya espacio para crearlos
			if($user->team->get_players_num() > 11 && $user->team->get_players_num_bypos((int)$functions->vars['POST']['player_pos']) > 0){				
				$total = 0;
				for($i=1; $i<=5; $i++)
					if($user->team->get_players_num_bypos($i) > 0) $total += 1;

				//if($user->team->get_players_num_bypos((int)$functions->vars['POST']['player_pos']) > 0 && $total < 5){					
				if((16 - (5-$total)) <= $user->team->get_players_num()){
					$lng['ERR'] = $main_error_str . $lng['ERROR_FIRST_UNUSED'];
					$error += 1;
				}
			}
		}
		
		
		//No hay error?
		if($error == 0){
			//Comprobamos que no se haya superado el límite jugadores para esa posicion
			switch((int)$functions->vars['POST']['player_pos']){
				case 1: if($user->team->get_players_num_bypos(1) >= 3) $error += 1; break;
				case 2: if($user->team->get_players_num_bypos(2) >= 7) $error += 1; break;
				case 3: if($user->team->get_players_num_bypos(3) >= 5) $error += 1; break;
				case 4: if($user->team->get_players_num_bypos(4) >= 5) $error += 1; break;
				case 5: if($user->team->get_players_num_bypos(5) >= 5) $error += 1; break;
			}
			if($error > 0) $lng['ERR'] = $main_error_str . $lng['PLAYER_POS_LIMIT_REACH'];
		}
		
		//No hay error?
		if($error == 0){
			//Registramos el jugador
			
			//Recuperem el jugador temporal
			$query = $mysql->do_query('SELECT * FROM {{table}} WHERE p_id = ' . $user->id, 'temp_players');
			if(mysql_num_rows($query) <= 0){
				$error += 1;
				$lng['ERR'] = $main_error_str . "{NO S'HA POGUT RECUPERAR INFORMACIÓ TEMPORAL!}";
			}			
		}
		if($error == 0){
			$resp = mysql_fetch_array($query);
			$stat_array = array(
				round((float)($resp['port']) / 200 * 100, 1) + (float)($functions->vars['POST']['p0']),
				round((float)($resp['agl']) / 200 * 100, 1) + (float)($functions->vars['POST']['p1']),
				round((float)($resp['refl']) / 200 * 100, 1) + (float)($functions->vars['POST']['p2']),
				round((float)($resp['def']) / 200 * 100, 1) + (float)($functions->vars['POST']['p3']),
				round((float)($resp['prec']) / 200 * 100, 1) + (float)($functions->vars['POST']['p4']),
				round((float)($resp['pot']) / 200 * 100, 1) + (float)($functions->vars['POST']['p5']),
				round((float)($resp['atc']) / 200 * 100, 1) + (float)($functions->vars['POST']['p6']),	
				round((float)($resp['vel']) / 200 * 100, 1) + (float)($functions->vars['POST']['p7'])					
			);	
			
			mysql_free_result($query);
			
			if($mysql->do_query('insert into {{table}} (p_id, c_id, nombre, apellidos, posicion, 
			port, agl, refl, def, prec, pot, atc, vel) 
			values (' . 
			$user->id . ',' . 
			$user->team->id . ',"' . 
			$functions->vars['POST']['player_name'] . '","' . 
			$functions->vars['POST']['player_surname'] . '","' . 
			$functions->vars['POST']['player_pos'] . '",' . 
			$stat_array[0] . ',' .
			$stat_array[1] . ',' .
			$stat_array[2] . ',' .
			$stat_array[3] . ',' .
			$stat_array[4] . ',' .
			$stat_array[5] . ',' .
			$stat_array[6] . ',' .
			$stat_array[7] . ')', 'players','',false)){
		
				$template->parsetext($lng['REG_PLAYER_OK'], array('NAME' => '"' . utf8_decode($functions->vars['POST']['player_name']), 'SURNAME' => utf8_decode($functions->vars['POST']['player_surname']) . '"'));
				$lng['ERR'] = $main_confirm_str . $lng['REG_PLAYER_OK'];
			}else{
				$lng['ERR'] = $main_error_str . $lng['UNEXPECTED_TEAM_REG_ERROR'];
				$error += 1;
			}
		}
		$user->team->renew((int)$functions->vars['POST']['player_pos']);
		
		if($user->team->get_players_num() >= 16)
			register_club(true);
	}
	
	$lng['ERR'] .= '</div></td></tr>';
	
	$_SESSION['ERR'] = $lng['ERR'];
	
	header('LOCATION: ' . EL11IDEAL_PATH . 'game.php?page=playercreate');
	/*
	set_main_info();
	$functions->build_common_header(array('player_create.js'));
	
	echo $template->parsetemplate('player_create', $lng);
	$functions->build_footer(true);
	*/	
?>