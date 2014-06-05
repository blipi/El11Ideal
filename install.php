<?
define('EL11IDEAL_IN', true);
define('MYSQL_NOTCONECT', true);
define('EL11IDEAL_PATH', './');
error_reporting(E_ALL ^ E_NOTICE);

include_once('modules/functions.php');
include_once('modules/template.php');
include_once('modules/mysql.php');
$functions = new Functions();
$template = new Template();
$mysql = new Mysql();

$functions->init_vars();
$functions->config_arr['style_override'] = 'true';
$functions->config_arr['style_name'] = 'default';
$template->select_style();

$lng = array();
$lng['STYLE_DIR'] = EL11IDEAL_PATH . USER_STYLENAME;

$data = '';

function connect_DB(){
	global $mysql, $lng, $t, $data, $template, $str;
	error_reporting(0);
	if(!$mysql->connect(true)){
		if($data != ''){
			unlink('modules/mysql.php');
			$fh = fopen('modules/mysql.php', 'w');
			fwrite($fh, $data);	
			fclose($fh);
		}
		$r['I_TEXT'] = '<center><span style="font-weight: bold;">Error de conecci&oacute;n, vuelva  <a href="javascript:history.back(1)">atr&aacute;s</a> y compruebe los datos</span></center>';
		$t .= $template->parsetemplate('install', $lng);
		echo $t;
		exit;
	}else
		$str = '<center>Conecci&oacute;n satisfactoria... <br><br></center>';
}

if(!isset($functions->vars['GET']['i'])){	
	$lng['ACTION'] = $_SERVER['PHP_SELF'];
	echo $template->parsetemplate('install_1', $lng);
}elseif($functions->vars['GET']['i'] == '1' || $functions->vars['GET']['i'] == '2'){	

	if($functions->vars['GET']['i'] == '1'){
		if((int)(substr(sprintf('%o', fileperms('modules/mysql.php')), -4)) < 666){
			$lng['I_TEXT'] = 'No hay permiso de escritura para el archivo "modules/mysql.php".<br>Cambie el CHMOD a un minimo de 0666, ya que su actual est&aacute; en '.substr(sprintf('%o', fileperms('modules/mysql.php')), -4). '.<br>Despu&eacute;s de la instalaci&oacute;n deber&iacute;a volver a cambiar los permisos a los anteriores.';
			$t .= $template->parsetemplate('install', $lng);
			echo $t;
			exit;
		}
			
		$fh = fopen('modules/mysql.php', 'r');
		$data = fread($fh, filesize('modules/mysql.php'));	
		$ndata = $data;
		fclose($fh);
		$ndata = str_replace('%HOST%', $functions->vars['POST']['host'], $ndata);
		$ndata = str_replace('%USER%', $functions->vars['POST']['user'], $ndata);
		$ndata = str_replace('%PASS%', $functions->vars['POST']['pass'], $ndata);
		$ndata = str_replace('%NAME%', $functions->vars['POST']['name'], $ndata);
		$ndata = str_replace('%PREF%', $functions->vars['POST']['pref'], $ndata);
		
		unlink('modules/mysql.php');
		$fh = fopen('modules/mysql.php', 'w');
		fwrite($fh, $ndata);	
		fclose($fh);
	}
		
	connect_DB();

	$str .= '<b>Creando base de datos... </b><br><br>';
	$query = array();
	$query[0][0] = "SELECT * FROM `".$functions->vars['POST']['pref']."config` LIMIT 0,1";
	$query[0][1] = "
		CREATE TABLE IF NOT EXISTS `".$functions->vars['POST']['pref']."config` (
		  `config_name` text NOT NULL,
		  `config_value` text NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=latin1;
		";
	$query[0][2] = "INSERT INTO `".$functions->vars['POST']['pref']."config` (`config_name`, `config_value`) VALUES('style_override', 'true'),('style_name', 'default'),('lang_override', 'false'),('lang_name', 'es');";
	$query[0][3] = $functions->vars['POST']['pref']."config";
	
	$query[1][0] = "SELECT * FROM `".$functions->vars['POST']['pref']."players` LIMIT 0,1";
	$query[1][1] = "CREATE TABLE IF NOT EXISTS `".$functions->vars['POST']['pref']."players` (
		  `id` int(20) NOT NULL AUTO_INCREMENT,
		  `nombre` varchar(200) NOT NULL,
		  `apellidos` varchar(200) NOT NULL,
		  `posicion` int(2) NOT NULL,
		  `c_global` int(3) NOT NULL DEFAULT '60',
		  `ataque` int(3) NOT NULL DEFAULT '60',
		  `defensa` int(3) NOT NULL DEFAULT '60',
		  `agilidad` int(3) NOT NULL DEFAULT '60',
		  `reflejos` int(3) NOT NULL DEFAULT '60',
		  `velocidad` int(3) NOT NULL DEFAULT '60',
		  `p_id` int(12) NOT NULL,
		  `c_id` int(12) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;";
	$query[1][2] = $functions->vars['POST']['pref']."players";
	
	$query[2][0] = "SELECT * FROM `".$functions->vars['POST']['pref']."users` LIMIT 0,1";
	$query[2][1] = "CREATE TABLE IF NOT EXISTS `".$functions->vars['POST']['pref']."users` (
		  `id` int(12) NOT NULL AUTO_INCREMENT,
		  `nick` varchar(200) NOT NULL,
		  `pass` varchar(200) NOT NULL,
		  `lang_name` varchar(3) NOT NULL,
		  `nombre` varchar(200) NOT NULL,
		  `apellidos` varchar(200) NOT NULL,
		  `email` varchar(200) NOT NULL,
		  `c_id` int(12) NOT NULL DEFAULT '-1',
		  `f_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  `f_entrada` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;";
	$query[2][2] = $functions->vars['POST']['pref']."users";
	
	$query[3][0] = "SELECT * FROM `".$functions->vars['POST']['pref']."clubs` LIMIT 0,1";
	$query[3][1] = "CREATE TABLE IF NOT EXISTS `".$functions->vars['POST']['pref']."clubs` (
		  `id` int(12) NOT NULL AUTO_INCREMENT,
		  `p_id` int(12) NOT NULL,
		  `tactic` int(2) NOT NULL,
		  `align` varchar(200) NOT NULL DEFAULT 'a:1:{i:0;i:0}',
		  `nombre` varchar(200) NOT NULL,
		  `pais` varchar(200) NOT NULL,
		  `wins` int(3) NOT NULL DEFAULT '0',
		  `loses` int(3) NOT NULL DEFAULT '0',
		  `temp` tinyint(1) NOT NULL DEFAULT '1',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;";
	$query[3][2] = $functions->vars['POST']['pref']."clubs";
	
	$last=false;
	for($i=0;$i<=sizeof($query)-1;$i++){
		for($si=0;$si<=sizeof($query[$i])-2;$si++){
			if($si == 0){
				$r = $mysql->do_query($query[$i][$si],'', '', false);
				if($r)
					$last = true;
				else
					$last = false;
			}elseif($si == 1 && $last)
				$str .= "<blockquote>--> La tabla ya existia, omitido <b>\"". $query[$i][sizeof($query[$i])-1] ."\"</b></blockquote>";
			elseif(!$last){
				if($mysql->do_query($query[$i][$si],'', '', false)==true){
					if ($si == 1)
						$str .= "<blockquote>Tabla <b>\"". $query[$i][sizeof($query[$i])-1] ."\"</b> Creada con exito" . '</blockquote>';
					else
						$str .= "<blockquote>Tabla <b>\"". $query[$i][sizeof($query[$i])-1] ."\"</b> datos Insertados con exito" . '</blockquote>';
				}else
					$str .= "<blockquote>Error al crear la tabla <b>\"". $query[$i][sizeof($query[$i])-1] ."\"</b> -> ". mysql_error() . '</blockquote>';
			}
		}
	}
	$t .= $template->parsetemplate('install', array_merge($lng, array('I_TEXT' => $str )));
	echo $t;
}elseif($functions->vars['GET']['i'] == '3'){
	die('No puede actualizar, debe instalar la DB por completo...');
	/*
	include_once('modules/mysql.php');
	$mysql = new Mysql();

	connect_DB();
		
	$str .= 'Creando base de datos... <br><br>';
	
	$query = array();
	$query[0][0] = "SELECT * FROM `".$functions->vars['POST']['pref']."users` LIMIT 0,1";
	$query[0][1] = "ALTER TABLE `".$functions->vars['POST']['pref']."users` ADD `lang_name` VARCHAR( 3 ) NOT NULL AFTER `pass`";
	$query[0][2] = $functions->vars['POST']['pref']."users";
	
	$query[1][0] = "SELECT * FROM `".$functions->vars['POST']['pref']."config` LIMIT 0,1";
	$query[1][1] = "UPDATE `".$functions->vars['POST']['pref']."config` SET config_value='false' WHERE config_name='lang_override'";
	$query[1][2] = $functions->vars['POST']['pref']."config";
	
	$query[2][0] = "SELECT * FROM `".$functions->vars['POST']['pref']."clubs` LIMIT 0,1";
	$query[2][1] = "ALTER TABLE `".$functions->vars['POST']['pref']."clubs` ADD `tactic` INT( 2 ) NOT NULL AFTER `p_id`";
	$query[2][2] = $functions->vars['POST']['pref']."clubs";
	
		
	$last=false;
	for($i=0;$i<=sizeof($query)-1;$i++){
		for($si=0;$si<=sizeof($query[$i])-2;$si++){
			if($si == 0){
				$r = $mysql->do_query($query[$i][$si],'', '', false);
				if($r)
					$last = true;
				else
					$last = false;
			}elseif($si == 1 && !$last)
				$str .= "<blockquote>--> La tabla no existe, no se puedo actualizar.<b>\"". $query[$i][sizeof($query[$i])-1] ."\"</b></blockquote>";
			elseif($last){
				if($mysql->do_query($query[$i][$si],'', '', false)==true)
					$str .= "<blockquote>Tabla <b>\"". $query[$i][sizeof($query[$i])-1] ."\"</b> actualizada con exito" . '</blockquote>';
				else
					$str .= "<blockquote>Error al actualizar la tabla <b>\"". $query[$i][sizeof($query[$i])-1] ."\"</b> -> ". mysql_error() . '</blockquote>';
			}
		}
	}
	$t .= $template->parsetemplate('install', array_merge($lng, array('I_TEXT' => $str )));
	echo $t;
	*/

}
	?>
