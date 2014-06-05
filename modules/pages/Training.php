<?
if(!defined('EL11IDEAL_IN'))
	exit;

	$lang->parselang('training');
	
	if((int)$functions->vars['GET']['done'] == 1){
		$mysql->do_query('UPDATE {{table}} set name="' . $functions->vars['POST']['training_name'] . '" where p_id=' . $user->id . ' and id=' . (int)$functions->vars['GET']['id'], 'trainings');
		header('LOCATION: game.php?page=training');
	}
	
	//TODO: NO DEIXAR FER CANVIS SI S'ESTÀ ENTRENANT
	$user->team->check_in_training();	
	$lng['NUM_TRAININGS'] = $user->team->num_trainings;
	
	$lng['M_POINTS'] = 30;
	$lng['MIN0'] = 0; //
	$lng['MAX0'] = 0; //
	$lng['CURRENT0'] = 0; //
	
	$functions->build_common_header(array('bars.js', 'main.js', 'training.js', 'ajax.js'));
	$functions->build_menus();

	$training = '{TRAINING_NAME}';
	$template->parsetext($training, $lng);
	
	//TODO: Add trainings class
	$i = 0;
	$query = $mysql->do_query('SELECT * FROM {{table}} where p_id=' . $user->id . ' order by id ASC', 'trainings');
	while(($resp = mysql_fetch_array($query)) != NULL){
		$i++;
		$lng['TH_TRAININGS'] .= '<th>' . (($i >= 2)?'&nbsp;&nbsp;·&nbsp;&nbsp;':'') . '<a href="javascript:void(0);" onclick="show_training(' . ($i - 1) . ');" style="color:#228b22;"><b>' . utf8_decode($resp['name']) . '</b></a></th>';
		$lng['SELECT_OPTIONS'] .= '<option value="' . ($i-1) . '">' . $i . '</option>';
	}
	
	echo $template->parsetemplate('training', $lng);
?>