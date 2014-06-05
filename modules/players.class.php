<?
if(!defined('EL11IDEAL_IN'))
	exit;
		

define('PORTER_HAB', 0);
define('AGILITAT_HAB', 1);
define('REFLEXOS_HAB', 2);
define('DEFENSA_HAB', 3);
define('PRECISIO_HAB', 4);
define('POTENCIA_HAB', 5);
define('ATAC_HAB', 6);
define('VELOCITAT_HAB', 7);
define('ESTAT_HAB', 8);

class Player{
	var $id;
	var $name;
	var $surname;
	var $position;
	var $properties = array();
	//UpgradeFunction - CurrentUpdate 
	var $status = array();
	var $names = array();
	//Por - Agi - Ref - Def - Prec - Pot - Ata - Vel - Stat
	
	public function Player($resp){
		$this->id = (int)($resp['id']);
		$this->name = $resp['nombre'];
		$this->surname = $resp['apellidos'];
		$this->position = (int)($resp['posicion']);
		$this->names = array('port', 'agl', 'refl', 'def', 'prec', 'pot', 'atc', 'vel');
		$this->status = array(
			$resp[$this->names[0]],
			$resp[$this->names[1]],
			$resp[$this->names[2]],
			$resp[$this->names[3]],
			$resp[$this->names[4]],
			$resp[$this->names[5]],
			$resp[$this->names[6]],
			$resp[$this->names[7]],
		);
	}
	
	function get_habilitie($ab_id){ return $this->status[$ab_id]; }
	
	function update_habilities($abpref, $action){
		//Coeficient = 0-1
		switch($action){
			case 0: $subcoeficient = 0.05; break; //Partit
			case 1: $subcoeficient = 0.02; break; //Entrenament
		}
		foreach($abpref as $i => $v){
			$status[$abpref[$i]] = $status[$abpref[$i]] + ($v * $subcoeficient * $properties[1]); 
		}
	}
	
	
}