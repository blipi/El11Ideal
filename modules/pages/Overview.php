<?	
	$functions->build_common_header();
	
	$user->team->init_players();
	$user->team->calculate_mid_stadistic();
	$user->team->calculate_total_stadistic();
	$user->team->get_best_pos();
	
	$lng['AVG_DEF'] = $user->team->mid[0];
	$lng['AVG_MID'] = $user->team->mid[1];
	$lng['AVG_ATK'] = $user->team->mid[2];
	
	$lng['TOT_DEF'] = $user->team->total[0];
	$lng['TOT_MID'] = $user->team->total[1];
	$lng['TOT_ATK'] = $user->team->total[2];
	
	$lng['BEST_DEF_NAME'] = $user->team->players[$user->team->bestdef_id]->name . ' ' . $user->team->players[$user->team->bestdef_id]->surname;
	$lng['BEST_DEF'] = $user->team->players[$user->team->bestdef_id]->status[DEFENSA_HAB];
	$lng['BEST_MID_NAME'] = $user->team->players[$user->team->bestmid_id]->name . ' ' . $user->team->players[$user->team->bestmid_id]->surname;
	$lng['BEST_MID'] = $user->team->bestmid_hab;
	$lng['BEST_ATK_NAME'] = $user->team->players[$user->team->bestatk_id]->name . ' ' . $user->team->players[$user->team->bestatk_id]->surname;
	$lng['BEST_ATK'] = $user->team->players[$user->team->bestatk_id]->status[ATAC_HAB];
	
	
	$lang->parselang('overview');	
	
	if($user->team->tactic == 0){
		$alert .= '<div align="center" style="border: 1px solid #000000; background-color:#AD1212; color: #FFFFFF; padding:5px; margin:15px;">';
		$alert .= '<b>' . $lng['NO_TACTIC'] . ' <a href="game.php?page=tactics"><span style="color:#000000;">' . $lng['HERE'] . '</span></a></b>';
		$alerts += 1;		
	}
	
	if($user->team->own_align == 0){
		$alert .= (($alerts >= 1)?'<br>':'<div align="center" style="border: 1px solid #000000; background-color:#AD1212; color: #FFFFFF; padding:5px; margin:15px;">');
		$alert .= '<b>' . $lng['NO_ALIGN'] . ' <a href="game.php?page=align"><span style="color:#000000;">' . $lng['HERE'] . '</span></a></b>';		
		$alerts += 1;		
	}

	if($alerts >= 1){
		$alert .= '</div>';
		$lng['ALERT'] = $alert;		
	}
	
	echo $template->parsetemplate('overview', $lng);
	
	$functions->build_footer(true);
?>