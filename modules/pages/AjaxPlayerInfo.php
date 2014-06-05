<?
define('EL11IDEAL_IN', true);
define('EL11IDEAL_PATH','../../');
include('../../common.php');

if(!$user->logged){
	echo 'ERROR :: TIENES QUE TENER SESIÓN INICIADA';
	exit;
}

if(!isset($functions->vars['GET']['id']) || !isset($functions->vars['GET']['pid'])){
	echo "ERROR :: DATOS NO RECIBIDOS";
	exit;
}

$user->team->init_player_num($functions->vars['GET']['pid'], $functions->vars['GET']['id']s);
$stat = $user->team->players[(int)$functions->vars['GET']['id']]->status;

echo utf8_encode('
<table width="500" cellpadding="0" cellspacing="0">
<tr><td align="right" colspan="2"><a href="javascript:void(0);" onclick="shut(\'player_info\');"><b>Tancar</b></a></td></tr>
<tr><td width="30%"><b>Nom:</b></td><td>' . utf8_decode($user->team->players[(int)$functions->vars['GET']['pid']]->name) . '</td></tr>
<tr><td width="30%"><b>Cognom:</b></td><td>' . utf8_decode($user->team->players[(int)$functions->vars['GET']['pid']]->surname) . '</td></tr>
<tr><td width="30%"><b>Porter (<b>'. $stat[0] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[0])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
<tr><td width="30%"><b>Agilitat (<b>'. $stat[1] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[1])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
<tr><td width="30%"><b>Relexos (<b>'. $stat[2] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[2])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
<tr><td width="30%"><b>Defensa (<b>'. $stat[3] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[3])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
<tr><td width="30%"><b>Precisió (<b>'. $stat[4] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[4])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
<tr><td width="30%"><b>Potència (<b>'. $stat[5] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[5])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
<tr><td width="30%"><b>Atac (<b>'. $stat[6] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[6])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
<tr><td width="30%"><b>Velocitat (<b>'. $stat[7] .'</b>):</b></td><td><div style="background: #334433; width:' . 200 . 'px; border:1px solid #FFFFFF;padding:0; height:5px;"><div style="background: #339933; width:' . ((int)($stat[7])). '%;height:4px;text-align:center;overflow:visible;line-height:1.2em;color:#FF0000;"></div></div></td></tr>
</table>
');

exit;
?>