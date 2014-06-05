<?
if(!defined('EL11IDEAL_IN'))
	exit;
		
	$lang->parselang('msg');
	
	if(isset($functions->vars['GET']['tac']) && $functions->vars['GET']['tac'] >= 1 && $functions->vars['GET']['tac'] <= 19){
		if($mysql->do_query('update {{table}} set tactic='. $functions->vars['GET']['tac'] .' where p_id='. $user->id,'clubs','',false))
			$lng['MSG'] = $lng['TACTIC_CHANGE_FINE'] .', <b>'. $functions->vars['POST']['nick'] .'</b><br><a href="index.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php"> ';
		else
			$lng['MSG'] = $lng['TACTIC_CHANGE_ERROR'] .', <b>'. $functions->vars['POST']['nick'] .'</b><br><a href="index.php">'. $lng['REDIRECT'] .'</a><br><br><meta HTTP-EQUIV="REFRESH" content="5; url=game.php?page=tactics"> ';
		echo $template->parsetemplate('temp', $lng);
		$functions->build_footer(true);
	}
	
	$lng['USING_TACTIC'] = $user->team->tactic;
	
	$lang->parselang('tactics');
	echo $template->parsetemplate('tactics', $lng);
	$functions->build_footer(true);
?>