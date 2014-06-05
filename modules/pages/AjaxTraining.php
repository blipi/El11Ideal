<?
	define('EL11IDEAL_IN', true);
	define('EL11IDEAL_PATH','../../');
	include('../../common.php');
	
	if(!$user->logged){
		echo '0';
		exit;
	}
	
	if(!isset($functions->vars['GET']['switch'])){
		echo '2';
		exit;
	}
	
	if((int)($functions->vars['GET']['switch']) == 1){
		$user->team->check_in_training();
		if($user->team->num_trainings >= 3){
			echo '3';
			exit;
		}else{
			$lang->parselang('training');
			$name = "{TRAINING_NAME} #" . ($user->team->num_trainings+1);
			$template->parsetext($name, $lng);
			$mysql->do_query('INSERT INTO {{table}} (p_id, name) values (' . $user->id . ', "' . $name . '")', 'trainings');
			echo '1';
			exit;
		}
	}
	if((int)($functions->vars['GET']['switch']) == 2){
		if(!isset($functions->vars['GET']['id'])){
			echo '2';
			exit;
		}
		/*
		$delete_id = -1;
		$query = $mysql->do_query('SELECT * FROM {{table}} where p_id=' . $user->id, 'trainings');
		for($i = 0; $i <= (int)($functions->vars['GET']['id']); $i++){
			$resp = mysql_fetch_array($query);
			if($i == (int)($functions->vars['GET']['id']) && $resp != NULL)
				$delete_id = $resp['id'];			
		}
		*/
		//$mysql->do_query('DELETE FROM {{table}} where p_id=' . $user->id . ' limit ' . ((int)$functions->vars['GET']['id']) . ',1', 'trainings', '', false);
/*		
$mysql->do_query('Delete {{table}}
From (Select * From {{table}} Where p_id = ' . $user->id . ' limit ' . (int)$functions->vars['GET']['id'] . ',1) AS t1
Where {{table}}.id = t1.id', 'trainings');
*/
		$id = mysql_fetch_array($mysql->do_query('select id from {{table}} where p_id="' . $user->id . '" order by id limit ' . (int)$functions->vars['GET']['id'] . ',1', 'trainings'));
		$id = $id['id'];

		$mysql->do_query('delete from {{table}} where id=' . $id, 'trainings');

		echo '1';
		exit;
		
	}
	if((int)($functions->vars['GET']['switch']) == 3){	
		$lang->parselang('training');
		$lang->parselang('days');
		
		foreach($lng as $k => $v)
			$lng[$k] = utf8_encode($v);
			
		if(!isset($functions->vars['GET']['id'])){
			$error = '{ERR_AJAX_2}';
			$template->parsetext($error, $lng);
			echo $error;
			exit;
		}
		
		$query = $mysql->do_query('SELECT * FROM {{table}} where p_id=' . $user->id . ' order by id limit ' . ((int)$functions->vars['GET']['id']) . ',1', 'trainings');
		$resp = mysql_fetch_array($query);
		
		$str = "
		<form method='POST' action='game.php?page=training&done=1&id=" . $resp['id'] . "'>
		<table width='100%'>
		<tr>
			<td width='50%'>{TRAINING_NAME_AJAX}: </td><td><input type='text' name='training_name' id='training_name' value='" . $resp['name'] . "'></td>
		</tr>
		<tr>
		<td width='50%'>{TRAINING_DAYS}: </td><td><select id='training_days' name='training_days'>
			<option value='d7'>{EVERY_DAY}</option>
			<option value='d2'>{TWO_DAY}</option>
			<option value='d3'>{THREE_DAY}</option>
			<option value='d1'>{DEFINE}</option>
		</select></td>
		</tr>
		<tr>
		<td width='50%'>{IF_DEFINE}: </td><td><select id='training_day_select' name='training_day_select'>
			<option value='1'>{MON}</option>
			<option value='2'>{TUE}</option>
			<option value='3'>{WED}</option>
			<option value='4'>{THU}</option>
			<option value='5'>{FRY}</option>
			<option value='6'>{SAT}</option>
			<option value='7'>{SUN}</option>
		</select>
		</td>
		</tr>
		</table>
		";
		
		echo '
		<br>
		<div style="display:fixed; border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;">
			<div name="subbar0" id="subbar0" style="display:fixed; background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center"></div>
		</div> 
		<div id="c0">{S_CURRENT0}</div>
		<input type="submit" value="[SEND]">
		</form>
		';
		
		$template->parsetext($str, $lng);
		echo $str;
		exit;
	}
?>