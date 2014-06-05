<?
	define('EL11IDEAL_IN', true);
	define('EL11IDEAL_PATH','../');
	include_once('../common.php');
	include_once('../modules/vars.php');
		
	if(!$user->logged)
		die("[ERROR] User not logged");
		
	$template->select_style();
	$lang->select_lang();
	
	$r1 = mysql_num_rows($mysql->do_query('select id from {{table}} where posicion=0 and p_id='.$user->id,'players'));
	$r2 = mysql_num_rows($mysql->do_query('select id from {{table}} where posicion=1 and p_id='.$user->id,'players'));
	$r3 = mysql_num_rows($mysql->do_query('select id from {{table}} where posicion=2 and p_id='.$user->id,'players'));
	$r4 = mysql_num_rows($mysql->do_query('select id from {{table}} where posicion=3 and p_id='.$user->id,'players'));
	$r5 = mysql_num_rows($mysql->do_query('select id from {{table}} where posicion=4 and p_id='.$user->id,'players'));
	
	if($r1 >= 2) $por = 0; else $por = 1;
	
	/*
		NO SE MUY BIEN LO QUE HICE AQUÍ, PERO BUENO, FUNCIONA =P
	*/
	
	if($r2 < 4){
		$def = 1;
		if($r2+$r3+$r4+$r5 == 8+$r2){
			$mid_def = 0;
			$mid_ata = 0;
			$del = 0;
		}
	}elseif($r2 >= 6)
		$def = 0;
	else
		$def = 1;
	
	if($r3 < 2){
		$mid_def = 1;
		if($r2+$r3+$r4+$r5 == 10){
			$mid_ata = 0;
			$del = 0;
		}
	}elseif($r3 >= 3)
		$mid_def = 0;
	else
		$mid_def = 1;
		
	if($r4 < 2){
		$mid_ata = 1;
		if($r2+$r3+$r4+$r5 == 10){
			$del = 0;
		}
	}elseif($r4 >= 3)
		$mid_ata = 0;
	else
		$mid_ata = 1;
		
	if($r5 < 2){
		$del = 1;
	}elseif($r5 >= 3)
		$del = 0;
	else
		$del = 1;
	
	$i = mysql_num_rows($mysql->do_query('select id from {{table}} where p_id='.$user->id,'players'));					
	if(isset($functions->vars['POST']['3'])){
		++$i;
		$resp = mysql_fetch_array($mysql->do_query('select id from {{table}} where p_id='. $user->id,'clubs'));			
		$r = $mysql->do_query('insert into {{table}} (p_id, nombre, apellidos, posicion, c_id) values ('. $user->id .',"'. $functions->vars['POST']['1'] .'","'. $functions->vars['POST']['2'] .'",'. $functions->vars['POST']['3'] .', '. $resp['id'] .')','players','',false);			
			
		$str ='<div style="background-color:#0D750A; border:1px solid #000000; margin:2px;" align="center"> Jugador '. $i .' creado con exito! </div><br>';
	}
	if($i >= 16 || ($por == 0 && $def == 0 && $mid_def == 0 && mid_ata == 0 && $del == 0)){
		$mysql->do_query('update {{table}} set c_id='. $resp['id'] .' where id='. $user->id, 'users');
		$str ='<div style="background-color:#0D750A; border:1px solid #000000; margin:2px;" align="center"> {REG_COMPLETE} </div><br>';
		$lang->parse_file('playercreate.lng', $r);
		$template->parse_text($str, $r);
		echo $str;
		exit;
	}
	
	$str .= '
	<b>{CREATING} '. ($i+1) .' :</b><br>
					<form  method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit=\'postProcess("ajax/playercreate.php", this.player_name.value, this.player_surname.value, this.player_type.value); return false; \'>
		<table width="400" align="center">
		  <tr><td width="50%">{PLAYER_NAME} </td><td><input type="text" name="player_name"></td></tr>
		  <tr><td width="50%">{PLAYER_SURNAME} </td><td><input type="text" name="player_surname"></td></tr>
		  <tr><td width="50%">{PLAYER_POSITION} </td><td>
			<select name="player_type">' 
				 . (($por==1)?'<option value="0" onclick="changeHelp(0, '. $r1 .')">{PORTERO}</option>':'')
				 . (($def==1)?'<option value="1" onclick="changeHelp(1, '. $r2 .')">{DEFENSA}</option>':'')
				 . (($mid_def==1)?'<option value="2" onclick="changeHelp(2, '. $r3 .')">{MEDIO_DEF}</option>':'')
				 . (($mid_ata==1)?'<option value="3" onclick="changeHelp(3, '. $r4 .')">{MEDIO_ATA}</option>':'')
				 . (($del==1)?'<option value="4" onclick="changeHelp(4, '. $r5 .')">{DELANTERO}</option>':'')
		   . '</td></tr>
		  <tr><td colspan="2" align="center" style="color:#CCCCCC;"><small></b><div id="player_info">{MAX} 2.</div></b></small></td></tr>
		  <tr><td colspan="2">&nbsp;</td></tr>
		  <tr><td colspan="2" align="center"><input type="submit" value="{SEND}"></td></tr>
		</table>
		</form>
	';
	
	$lang->parse_file('playercreate.lng', $r);	
	$template->parse_text($str, $r);
		
	echo $str;
?>