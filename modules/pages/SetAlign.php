<?
	if(!defined('EL11IDEAL_IN'))
		exit;
	
	include_once('modules/vars.php');
	
	if(isset($functions->vars['GET']['change']) && $functions->vars['GET']['change'] == 1){
		$lang->parselang('msg');
		$temp = array();
		for($i=0;$i<$user->team->get_players_num();$i++){
			if(!isset($functions->vars['GET']['player' . $i])){
				$lng['MSG'] = '<b>' . ' - ' . $lng['ERROR_DATA_NOT_ARRIVED'] .'</b><br><a href="game.php?page=align">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=align"> ';
				echo $template->parsetemplate('temp', $lng);
				$functions->build_footer(true);
			}
			/*
			ANTIC MÈTOCE QUE UTILITZAVA CONSULTES SQL
			$query = $mysql->do_query('SELECT p_id FROM {{table}} where id=' . $functions->vars['GET']['player' . $i], 'players');
			$resp = mysql_fetch_array($query);
			if((int)$resp['p_id'] != $user->id){
				mysql_free_result($query);
				$lng['MSG'] = '<b>' . $lng['ERROR_DATA_NOT_ARRIVED'] .'</b><br><a href="game.php?page=align">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=align"> ';
				echo $template->parsetemplate('temp', $lng);
				$functions->build_footer(true);
			}
			mysql_free_result($query);
			*/
			if(!in_array((int)$functions->vars['GET']['player' . $i], $user->team->align)){
				$lng['MSG'] = '<b>' . $lng['ERROR_DATA_NOT_ARRIVED'] .'</b><br><a href="game.php?page=align">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=align"> ';
				echo $template->parsetemplate('temp', $lng);
				$functions->build_footer(true);
			}
			$temp = array_merge($temp, array($i => ((int)$functions->vars['GET']['player' . $i])));
		}
		if($mysql->do_query('UPDATE {{table}} set align="' . serialize($temp) . '", own_align=1 where id=' . $user->team->id, 'clubs', '', false))
			$lng['MSG'] = '<b>' . $lng['ALIGN_CHANGE_FINE'] .'</b><br><a href="game.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php"> ';
		else
			$lng['MSG'] = '<b>' . $lng['UNEXPECTED_ERROR'] .'</b><br><a href="game.php?page=align">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=align"> ';
			
		echo $template->parsetemplate('temp', $lng);
		$functions->build_footer(true);
	}else{
		$functions->build_common_header(array('main.js','align.js','ajax.js'));
		
		$user->team->init_players();
		
		$lang->parselang('align');
		$strTemplate = $template->parsetemplate('align_header', $lng);
					
		$porteroPos = 1;
		$pos1 = $porteroPos + $strategia[$user->team->tactic][0];
		$pos2 = $pos1 + $strategia[$user->team->tactic][1];
		$pos3 = $pos2 + $strategia[$user->team->tactic][2];
		if(sizeof($strategia[$user->team->tactic]) >= 4) $pos4 = $pos3 + $strategia[$user->team->tactic][3];
		if(sizeof($strategia[$user->team->tactic]) >= 5) $pos5 = $pos4 + $strategia[$user->team->tactic][4];
	
		for($i = 0; $i < $user->team->get_players_num(); $i++){
			$lng['POS'] = '{' . $position[$user->team->players[$i]->position] . '}';
			$lng['NAME'] = utf8_decode($user->team->players[$i]->name . " " . $user->team->players[$i]->surname);
			$lng['I'] = $i;
			
			if(($i+1) <= $porteroPos) $lng['C_POS'] = $position[1];
			elseif(($i+1) <= $pos1) $lng['C_POS'] = $position[2];
			elseif(($i+1) <= $pos2){
				if(sizeof($strategia[$user->team->tactic]) < 4) $lng['C_POS'] = $position[31];
				elseif(sizeof($strategia[$user->team->tactic]) >= 4) $lng['C_POS'] = $position[3];
			}elseif(($i+1) <= $pos3){
				if(sizeof($strategia[$user->team->tactic]) < 4) $lng['C_POS'] = $position[5];
				elseif(sizeof($strategia[$user->team->tactic]) == 4) $lng['C_POS'] = $position[4];
				elseif(sizeof($strategia[$user->team->tactic]) == 5) $lng['C_POS'] = $position[31];
			}
			elseif(sizeof($strategia[$user->team->tactic]) == 4 && ($i+1) > $pos3 && ($i+1) <= $pos4)
				$lng['C_POS'] = $position[5];				
			elseif(sizeof($strategia[$user->team->tactic]) == 5 && ($i+1) > $pos3 && ($i+1) <= $pos4)
				$lng['C_POS'] = $position[4];			
			elseif(sizeof($strategia[$user->team->tactic]) == 5 && ($i+1) > $pos4 && ($i+1) <= $pos5 )
				$lng['C_POS'] = $position[5];
			else 	
				$lng['C_POS'] = $position[6];
			
			if(( sizeof($strategia[$user->team->tactic]) == 5 && ($i+1) == $pos5) 
			|| sizeof($strategia[$user->team->tactic]) == 4 && ($i+1) == $pos4
			|| sizeof($strategia[$user->team->tactic]) < 4 && ($i+1) == $pos3) $lng['SPACER'] = '<tr><td>&nbsp;</td></tr>'; else $lng['SPACER'] = '';
				
			$lng['C_POS'] = '{' . $lng['C_POS']  . '}';
				
			$lng['ID'] = $user->team->players[$i]->id;
			$lng['ID_PLAYER'] = $i;
			
			$lang->parselang('playernames');
			$strTemplate .= $template->parsetemplate('align_body', $lng);
		}
		
		$strTemplate .= $template->parsetemplate('align_footer', $lng);
		
		echo $strTemplate;
		$functions->build_footer(true);
	}
?>