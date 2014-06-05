<?
$changelog = array(
	'1.5.1' => 'Añadido el generador aleatorio de nombres (en castellano)<br>
	Nuevo archivo "./modules/randname/randname_es.php"<br>
	Cambios en "./modules/pages/PlayerCreate.php" para alojar el codigo de los scripts nuevos<br>
	Añadidos los scripts "./scripts/player_create.js::auto_gen_name()"<br>
	Añadidos los scripts "./scripts/ajax.js" y "./scripts/main.js" a la cabecera de PlayerCreate.php',
	'1.5' => 'Añadido en Overview mensajes de alerta de:<br>
	<blockquote>
		Alineación por defecto -> Valor "own_align = 0" en tabla "players" de la DB<br>
		Táctica no seleccionada -> "tactic = 0" en tabla "players" de la DB
	</blockquote>',
	'1.4.6' => 'Corregido el error de la duplicación de jugadores<br>
	Una vez registrado el jugador, se guarda el resultado en SESSION, se redirige a la página normal, y se muestra el mensaje<br>
	Imposibilidad de repetir/clonar el jugador.',
	'1.4.5.x' => 'Reducción del peso de los archivos<br>
	Facilitación del cambio de URL internas<br>
	Facilitación del cambio de los textos de los menús',
	'1.4.5.2' => 'El menú derecho ha sido puesto en una plantilla separada<br>
	style/default/templates/right_menu.tpl<br>
	lang/es/right_menu.lng',
	'1.4.5.1' => 'El menú superior ha sido puesto en una plantilla separada<br>
	style/default/templates/upper_menu.tpl<br>
	lang/es/upper_menu.lng',
	'1.4.5.0' => 'El menú izquierdo ha sido puesto en una plantilla separada<br>
	style/default/templates/left_menu.tpl<br>
	lang/es/left_menu.lng',
	'1.4.4.1' => 'Arreglado problema en el js Validate(frm) del PlayerCreate',
	'1.4.4' => 'Gran cambio en todo en sistema de registro de jugadores.<br>Barras para mostrar las habilidades, con posibilidad de aumentar 15 puntos.<br>
	Sistema de seguridad perfecto, comprobado que es imposible augmentar las capacidades ni el número de puntos.<br>
	<b>TODO:</b> Falta evitar el duplicado de jugadores (se hará mediante la fecha de registro del jugador, que a su vez servirá para la edad del jugador)',
	'1.4.3' => 'Cambios en la página AjaxPlayerInfo (modules/pages/AjaxPlayerInfo.php)<br>
	Se reduce el codigo de la página<br>
	Se passan dos valores más, el ID del jugador respecto al equipo y el ID del jugador global<br>
	La propia clase Team::Player inicializa y da estos valores.<br>
	Añadida función Team::init_player_num(...)',
	'1.4.2' => 'Añadida la página Overview (modules/pages/overview.php , style/templates/overview.tpl , lang/es/overview.lng)<br>
	Añadido las funciones Team::calculate_mid_stadistics(), Team::calculate_total_stadistics(), Team::get_best_pos()<br>
	Servirán, además para Overview (que se tiene que terminar), para los posteriores partidos celebrados (sobretodo el calculate_total_stadistics())<br>
	Esta última mencionada depende exclusivamente de la estrategia del equipo, mientras que la mid_estadistics, lo hace solo de los jugadores.',
	'1.4.1' => 'Implementado en la mayoría de los archivos la funcion Functions::build_common_header($scripts)<br>
	Cambios en esta misma función que permiten el parseado del mismo script antes de ser incluido.',
	'1.4.0' => 'Optimizaciones de las consultas SQL<br>Reducidas a 5 las consultas mínimas por visita<br>
	Reducidas las consultas en cambios de alineacion en 1<br>
	Optimizado la base de datos de los jugadores (players), añadiendo nuevas casillas a las tablas, en vez de la array en status.',
	'----------------------------------------' => '',
	'1.3.7' => 'Pequeños ajusts en "./modules/session.php"<br>
	Bug fixes en "./modules/myqsl.php"<br>
	Pequeños ajustes en "./modules/functions.php"<br>
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
	Añadido en "./modules/debug.class.php" código para gestionar errores propios, y terminar la sesion/pagina de forma que no se altere el resutlado visual/memoria...<br>	
	Eliminado "./p.php" el cuál no llego a comprender porque seguía allí, es un archivo donde hago pruebas normalmente
	',
	'1.3.6.2' => 'Cambios en la clase Debug:<br>Cambiada las funciones Debug::push() , Debug::pop()<br>Añadidas: Debug::start_timer() , Debug::end_timer() , Debug::Debug() , Debug::ErrHandler<br>Debug::ErrHandler servirá para tener un "trace back"/log de todos los errores de PHP<br>Arreglados un par de errores en "./install.php"',
	'1.3.6.1' => 'Implementación de dicha clase. Functions::build_footer($die = true);',
	'1.3.6' => 'Creada la clase Debug ("./modules/debug.class.php"), utilizada para recuento de MySQL queries, llamadas de funciones, errores, etc.',
	'1.3.5.1' => '"./install.php" error fix en la línea 44',
	'1.3.5' => '"./modules/pages/PlayerCreate.php" reestrucuración parcial del codigo.',
	'1.3.4' => '"./modules/pages/PlayerCreate.php", diseño principal.',
	'1.3.3' => '"./modules/pages/TeamCreate.php", reestructuramiento del codigo y mejoras.',
	'1.3.2' => 'Añadida la clase Team ("./modules/team.class.php"), trabaja a través de User: $user->team->...',
	'1.3.1' => 'Cambios en "./common.php" i clases adyacentes',
	'1.3.0' => 'Rediseño del codigo.<br>"./game.php" soporta todo el main switch.<br>Grandes cambios a las clases, especialmente Lang/Template.<br>Nueva carpeta "./modules/pages".<br>Reestructuración del codigo',
	'---------------------------------------' => '',
	'1.2.0' => 'Añadida pagina de tacticas "./tactics.php"',
	'--------------------------------------' => '',
	'1.1.1' => 'Arreglados errores',
	'1.1.0' => 'Añadido codigo principal: lang/template/user/mysql/functions',
	'-------------------------------------' => '',
	'1.0' => 'Alpha publicada para el team',
	'------------------------------------' => '',
	'0.1' => 'Alpha inicial'
);
foreach($changelog as $k => $v)
	echo "<span style='color:#FFFFFF; background-color:#666666;'><b>" . $k . "</b></span> :: " . $v . "<br><br>";
?>