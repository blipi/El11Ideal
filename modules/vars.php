<?
// => ....(ataque, defensa, agilidad, reflejos, velocidad);
// => ....(at,de,ag,re,ve);

$position = array(
	1 => "PORTERO",
	2 => "DEFENSA",
	3 => "MEDIO_DEF",
	31 => "MEDIOCENTRO",
	4 => "MEDIO_ATA",
	5 => "DELANTERO",
	6 => "SUPLENTE"
);

$players = array(
0 => array(30,60,60,60,55), //portero (265)
1 => array(40,65,50,45,65), //defensas (265)
2 => array(50,55,50,50,60), //medio-def (265)
3 => array(55,45,50,45,70), //medio-att (265)
4 => array(65,30,55,45,70) //del (265)
);

$strategia = array(
	0 => 0,
	1 => array(1, 4, 3, 2),
	2 => array(3, 4, 1, 2),
	3 => array(3, 4, 2, 1),
	4 => array(3, 4, 3),
	5 => array(3, 5, 2),
	6 => array(4, 1, 2, 1, 2),
	7 => array(4, 1, 2, 2, 1),
	8 => array(4, 2, 3, 1),
	9 => array(4, 2, 4),
	10 => array(4, 3, 1, 2),
	11 => array(4, 3, 2, 1),
	12 => array(4, 3, 3),
	13 => array(4, 4, 1, 1),
	14 => array(4, 4, 2),
	15 => array(4, 5, 1),
	16 => array(5, 2, 1, 2),
	17 => array(5, 2, 2, 1),
	18 => array(5, 3, 2),
	19 => array(5, 4, 1)
);

?>