<?
$changelog = array(
	'1.5.1' => 'A�adido el generador aleatorio de nombres (en castellano)<br>
	Nuevo archivo "./modules/randname/randname_es.php"<br>
	Cambios en "./modules/pages/PlayerCreate.php" para alojar el codigo de los scripts nuevos<br>
	A�adidos los scripts "./scripts/player_create.js::auto_gen_name()"<br>
	A�adidos los scripts "./scripts/ajax.js" y "./scripts/main.js" a la cabecera de PlayerCreate.php',
	'1.5' => 'A�adido en Overview mensajes de alerta de:<br>
	<blockquote>
		Alineaci�n por defecto -> Valor "own_align = 0" en tabla "players" de la DB<br>
		T�ctica no seleccionada -> "tactic = 0" en tabla "players" de la DB
	</blockquote>',
	'1.4.6' => 'Corregido el error de la duplicaci�n de jugadores<br>
	Una vez registrado el jugador, se guarda el resultado en SESSION, se redirige a la p�gina normal, y se muestra el mensaje<br>
	Imposibilidad de repetir/clonar el jugador.',
	'1.4.5.x' => 'Reducci�n del peso de los archivos<br>
	Facilitaci�n del cambio de URL internas<br>
	Facilitaci�n del cambio de los textos de los men�s',
	'1.4.5.2' => 'El men� derecho ha sido puesto en una plantilla separada<br>
	style/default/templates/right_menu.tpl<br>
	lang/es/right_menu.lng',
	'1.4.5.1' => 'El men� superior ha sido puesto en una plantilla separada<br>
	style/default/templates/upper_menu.tpl<br>
	lang/es/upper_menu.lng',
	'1.4.5.0' => 'El men� izquierdo ha sido puesto en una plantilla separada<br>
	style/default/templates/left_menu.tpl<br>
	lang/es/left_menu.lng',
	'1.4.4.1' => 'Arreglado problema en el js Validate(frm) del PlayerCreate',
	'1.4.4' => 'Gran cambio en todo en sistema de registro de jugadores.<br>Barras para mostrar las habilidades, con posibilidad de aumentar 15 puntos.<br>
	Sistema de seguridad perfecto, comprobado que es imposible augmentar las capacidades ni el n�mero de puntos.<br>
	<b>TODO:</b> Falta evitar el duplicado de jugadores (se har� mediante la fecha de registro del jugador, que a su vez servir� para la edad del jugador)',
	'1.4.3' => 'Cambios en la p�gina AjaxPlayerInfo (modules/pages/AjaxPlayerInfo.php)<br>
	Se reduce el codigo de la p�gina<br>
	Se passan dos valores m�s, el ID del jugador respecto al equipo y el ID del jugador global<br>
	La propia clase Team::Player inicializa y da estos valores.<br>
	A�adida funci�n Team::init_player_num(...)',
	'1.4.2' => 'A�adida la p�gina Overview (modules/pages/overview.php , style/templates/overview.tpl , lang/es/overview.lng)<br>
	A�adido las funciones Team::calculate_mid_stadistics(), Team::calculate_total_stadistics(), Team::get_best_pos()<br>
	Servir�n, adem�s para Overview (que se tiene que terminar), para los posteriores partidos celebrados (sobretodo el calculate_total_stadistics())<br>
	Esta �ltima mencionada depende exclusivamente de la estrategia del equipo, mientras que la mid_estadistics, lo hace solo de los jugadores.',
	'1.4.1' => 'Implementado en la mayor�a de los archivos la funcion Functions::build_common_header($scripts)<br>
	Cambios en esta misma funci�n que permiten el parseado del mismo script antes de ser incluido.',
	'1.4.0' => 'Optimizaciones de las consultas SQL<br>Reducidas a 5 las consultas m�nimas por visita<br>
	Reducidas las consultas en cambios de alineacion en 1<br>
	Optimizado la base de datos de los jugadores (players), a�adiendo nuevas casillas a las tablas, en vez de la array en status.',
	'----------------------------------------' => '',
	'1.3.7' => 'Peque�os ajusts en "./modules/session.php"<br>
	Bug fixes en "./modules/myqsl.php"<br>
	Peque�os ajustes en "./modules/functions.php"<br>
	Modificado en "./modules/team.class.php", Team::init_players() , Team::register_players() , Team::get_players_num()<br>
	Modificado en "./modules/players.class.php", Player::Player()<br>
	Team::init_players() i Player::Player() reducidas las consultas SQL de >= 16 a 1 consulta SQL<br>
	Team::register_players() reducidas consultas SQL de 16 a 1<br>
	Ajustes en "./modules/pages/PlayerCreate.php"::register_club() debido a los cambios anteriores.<br>
	Modificado en "./modules/debug.class.php", todas las funciones son completamente funcionales y reportan:<br>
	<blockquote>
		Calls (llamadas) de funciones, algunas<br>
		Consultas SQL y resultado (1 = true ; 0 = false)<br>
		Errores SQL (si hay)<br>
		Errores PHP (si hay)<br>
	</blockquote>	
	A�adido en "./modules/debug.class.php" c�digo para gestionar errores propios, y terminar la sesion/pagina de forma que no se altere el resutlado visual/memoria...<br>	
	Eliminado "./p.php" el cu�l no llego a comprender porque segu�a all�, es un archivo donde hago pruebas normalmente
	',
	'1.3.6.2' => 'Cambios en la clase Debug:<br>Cambiada las funciones Debug::push() , Debug::pop()<br>A�adidas: Debug::start_timer() , Debug::end_timer() , Debug::Debug() , Debug::ErrHandler<br>Debug::ErrHandler servir� para tener un "trace back"/log de todos los errores de PHP<br>Arreglados un par de errores en "./install.php"',
	'1.3.6.1' => 'Implementaci�n de dicha clase. Functions::build_footer($die = true);',
	'1.3.6' => 'Creada la clase Debug ("./modules/debug.class.php"), utilizada para recuento de MySQL queries, llamadas de funciones, errores, etc.',
	'1.3.5.1' => '"./install.php" error fix en la l�nea 44',
	'1.3.5' => '"./modules/pages/PlayerCreate.php" reestrucuraci�n parcial del codigo.',
	'1.3.4' => '"./modules/pages/PlayerCreate.php", dise�o principal.',
	'1.3.3' => '"./modules/pages/TeamCreate.php", reestructuramiento del codigo y mejoras.',
	'1.3.2' => 'A�adida la clase Team ("./modules/team.class.php"), trabaja a trav�s de User: $user->team->...',
	'1.3.1' => 'Cambios en "./common.php" i clases adyacentes',
	'1.3.0' => 'Redise�o del codigo.<br>"./game.php" soporta todo el main switch.<br>Grandes cambios a las clases, especialmente Lang/Template.<br>Nueva carpeta "./modules/pages".<br>Reestructuraci�n del codigo',
	'---------------------------------------' => '',
	'1.2.0' => 'A�adida pagina de tacticas "./tactics.php"',
	'--------------------------------------' => '',
	'1.1.1' => 'Arreglados errores',
	'1.1.0' => 'A�adido codigo principal: lang/template/user/mysql/functions',
	'-------------------------------------' => '',
	'1.0' => 'Alpha publicada para el team',
	'------------------------------------' => '',
	'0.1' => 'Alpha inicial'
);
foreach($changelog as $k => $v)
	echo "<span style='color:#FFFFFF; background-color:#666666;'><b>" . $k . "</b></span> :: " . $v . "<br><br>";
?>