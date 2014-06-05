<?
	define('EL11IDEAL_IN', true);
	define('EL11IDEAL_PATH','../');
	include_once('../common.php');
	
	if(!$user->logged)
		die("[ERROR] User not logged");
	
	$template->select_style();
	$lang->select_lang();
	
	if(!isset($functions->vars['POST']['1']) || !isset($functions->vars['POST']['2']))
		die("[ERROR] Variables didn't arrive");
		
	if(mysql_num_rows($mysql->do_query('select id from {{table}} where p_id='. $user->id,'clubs')) > 0){
		$str = '<div style="background-color:#990000; border:1px solid #000000; margin:2px;" align="center"> {ERROR_ALREADY_CREATED} </div><br>';
		$mysql->do_query('delete from {{table}} where p_id='. $user->id,'clubs');
	}
		
	if(mysql_num_rows($mysql->do_query('select id from {{table}} where nombre="'. $functions->vars['POST']['1'] .'"','clubs')) > 0){
		$str .='		
	<div style="background-color:#990000; border:1px solid #000000; margin:2px;" align="center"> {ERROR_EXISTS} </div><br>	
	<form  method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit=\'if(validate(this)){ postProcess("ajax/teamcreate.php", this.team_name.value, this.team_country.value); } return false; \'>
			<table width="400" align="center">
			  <tr><td width="50%">{TEAM_NAME} </td><td><input type="text" name="team_name"></td></tr>
			  <tr><td width="50%">{TEAM_LEAGUE} </td><td>
			  	<select name="team_country">
					<option value="1">{MOROCAN}</option>
					<option value="2">{NIGERIAN}</option>
					<option value="3">{JAPANESE}</option>
					<option value="4">{BELGIAN}</option>
					<option value="5">{BULGARIAN}</option>
					<option value="6">{CROATIAN}</option>
					<option value="7">{CZECH_REPUBLIC}</option>
					<option value="8">{DANISH}</option>
					<option value="9">{DUTCH}</option>
					<option value="10">{ENGLISH}</option>
					<option value="11">{FRENCH}</option>
					<option value="12">{GERMAN}</option>
					<option value="13">{GREEK}</option>
					<option value="14">{ITALIAN}</option>
					<option value="15">{NORWAY}</option>
					<option value="16">{POLISH}</option>
					<option value="17">{PORTUGUESE}</option>				
					<option value="18">{ROMANIAN}</option>
					<option value="19">{RUSSIAN}</option>	
					<option value="20">{SCOTTISH}</option>
					<option value="21">{SERBIAN}</option>
					<option value="22">{SPANISH}</option>
					<option value="23">{SWEDISH}</option>
					<option value="24">{SWISS}</option>
					<option value="25">{TURKISH}</option>
					<option value="26">{UKRANIA}</option>
					<option value="27">{WELSH}</option>
					<option value="28">{ARGENTINA}</option>
					<option value="29">{BRAZILIAN}</option>
					<option value="30">{CHILEAN}</option>
					<option value="31">{COLOMBIAN}</option>
					<option value="32">{PERUVIAN}</option>
					<option value="33">{URUGUAYAN}</option>
					<option value="34">{VENEZUELAN}</option>
					<option value="35">{EEUU}</option>
					<option value="36">{MEXICAN}</option>
				</select>
			  </td></tr>
			  <tr><td colspan="2">&nbsp;</td></tr>
			  <tr><td colspan="2" align="center"><input type="submit" value="{SEND}"></td></tr>
			</table>
			</form>
		';			
		$lang->parse_file('teamcreate.lng', $r, false);
		$lang->parse_file('countries.lng', $r, false);
		$template->parse_text($str, $r);
		echo $str;
		exit;
	}
	$r = $mysql->do_query('insert into {{table}} (p_id, nombre, pais) values ('. $user->id .',"'. $functions->vars['POST']['1'] .'","'. $functions->vars['POST']['2'] .'")','clubs','',false);


	if(mysql_num_rows($mysql->do_query('select id from {{table}} where p_id='. $user->id,'players')) > 0){ 
		$resp = mysql_fetch_array($mysql->do_query('select id from {{table}} where p_id='. $user->id,'clubs'));
		$mysql->do_query('update {{table}} set c_id='. $resp['id'] .' where p_id='. $user->id,'players');
	}
			
	$str .= "
	<div style='background-color:#0D750A; border:1px solid #000000; margin:2px;' align='center'> Team creado con exito! </div><br>";
	include('playercreate.php');
?>