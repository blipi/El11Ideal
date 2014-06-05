<?
if(!defined('EL11IDEAL_IN'))
	exit;

include(EL11IDEAL_PATH.'modules/players.class.php');
	
class Team{
	public $id;
	public $name;
	public $country;
	public $tactic;
	public $stats=array();
	public $is_temp=true;
	public $has_team=false;
	public $players = array();
	public $playersnum = -1;
	public $playersnumbypos = array(-1,-1,-1,-1,-1,-1,-1);
	public $align=array();
	public $own_align;
	public $num_trainings;
	public $mid=array();
	public $total=array();
	public $bestdef_id;
	public $bestmid_id;
	public $bestmid_hab;
	public $bestatk_id;
	
	public function __destruct(){
		for ($i=0; $i <= sizeof($this->players); $i++){
			unset($this->players[i]);
		}	
	}
	
	public function Team($p_id, $c_id){
		global $mysql;
		switch($c_id){
			case -1:{
				$query = $mysql->do_query('SELECT * FROM {{table}} where p_id=' . $p_id, 'clubs');
				if(mysql_num_rows($query) > 0){
					$resp = mysql_fetch_array($query);
					$this->id = (int)($resp['id']);
					$this->is_temp = (((int)$resp['temp']==0)?false:true); //Debería ser 0=false
					$this->name = $resp['nombre'];
					$this->stats = array('WIN' => $resp['wins'],'LOST' => $resp['loses']);
					$this->tactic = (int)($resp['tactic']);
					$this->has_team = true;
					$this->own_align = $resp['own_align'];
				}
				mysql_free_result($query);
			}break;
			default:{
				$query = $mysql->do_query('SELECT * FROM {{table}} where id=' . $c_id, 'clubs');
				if(mysql_num_rows($query) <= 0){
					global $lang;
					$lang->parselang('fatal_error');
					trigger_error("TEAM_NOT_FOUND::" . $lng['TEAM_NOT_FOUND'], E_USER_ERROR);
				}
				$resp = mysql_fetch_array($query);
				$this->id = (int)($resp['id']);
				$this->is_temp = (((int)$resp['temp']==0)?false:true);
				$this->name = $resp['nombre'];
				$this->stats = array('WIN' => $resp['wins'],'LOST' => $resp['loses']);
				$this->tactic = (int)($resp['tactic']);
				$this->align = unserialize($resp['align']);
				$this->has_team = true;
				$this->own_align = $resp['own_align'];
				mysql_free_result($query);		
			}break;
		}
	}
	
	public function init_players(){		
		global $mysql, $user;	
		if(sizeof($this->align) >= 11){	//Mínimo 11 jugadores
			$subarray = array();
			foreach($this->align as $pos => $id)
				$subarray[$id] = $pos;			
			
			$querie = $mysql->do_query('SELECT * FROM {{table}} where p_id=' . $user->id, 'players');
			while(($resp = mysql_fetch_array($querie)) != NULL)
				$this->players[$subarray[$resp['id']]] = new Player($resp);

			mysql_free_result($querie);
		}
	}
	
	public function init_player_num(int $num, int $id){
		global $mysql, $user;	
		$querie = $mysql->do_query('SELECT * FROM {{table}} where id=' . $id, 'players');
		$resp = mysql_fetch_array($querie);
		$this->players[$num] = new Player($resp);
		mysql_free_result($querie);
	}
		
	public function register_players(){
		global $mysql, $user;
		$temp = array();
		$query = $mysql->do_query('SELECT * FROM {{table}} where p_id=' . $user->id, 'players');
		
		while(($resp = mysql_fetch_array($query)) != NULL)
			$temp = array_merge($temp, array($resp['id']));
			
		$mysql->do_query("UPDATE {{table}} set align='" . serialize($temp) . "' where id=" . $this->id, 'clubs', '', false);
	}
	
	public function get_players_num(){
		if($this->playersnum != -1) return $this->playersnum;
		if(is_array($this->align) && sizeof($this->align) >= 11) return ($this->playersnum = sizeof($this->align));
		else{
			global $mysql;
			$query = $mysql->do_query('SELECT * FROM {{table}} where c_id=' . $this->id, 'players');
			$this->playersnum = mysql_num_rows($query);
			mysql_free_result($query);
			return $this->playersnum;
		}
	}
	public function get_players_num_bypos($p_pos){
		if($this->playersnumbypos[$p_pos] != -1) return $this->playersnumbypos[$p_pos];
		else{
			global $mysql;
			$query = $mysql->do_query('SELECT * FROM {{table}} where c_id=' . $this->id . ' and posicion=' . $p_pos, 'players');
			$this->playersnumbypos[$p_pos] = mysql_num_rows($query);
			mysql_free_result($query);
			return $this->playersnumbypos[$p_pos];
		}
	}
	public function renew($p_pos){
		global $mysql;
		$this->playersnum -= $this->playersnumbypos[$p_pos];
		$query = $mysql->do_query('SELECT * FROM {{table}} where c_id=' . $this->id . ' and posicion=' . $p_pos, 'players');
		$this->playersnumbypos[$p_pos] = mysql_num_rows($query);
		$this->playersnum += $this->playersnumbypos[$p_pos];
		mysql_free_result($query);
	}
	
	public function calculate_mid_stadistic(){
		include(EL11IDEAL_PATH . 'modules/vars.php');
		$def_init = 0;
		$mid_init = 0;
		$atk_init = 0;
		for($i = 1; $i < sizeof($this->players); $i++){
			switch($this->players[$i]->position){
				case 2:{
					$def += $this->players[$i]->status[DEFENSA_HAB];
					if(!$def_init) $def_init = 1;
					else $def /= 2;
				}break;
				case 3:{
					$mid += ($this->players[$i]->status[DEFENSA_HAB] *5/10);
					$mid += ($this->players[$i]->status[PRECISIO_HAB] *5/10);
					if(!$mid_init) $mid_init = 1;
					else $mid /= 2;
				}break;
				case 4:{
					$mid += ($this->players[$i]->status[ATAC_HAB] *6/10);
					$mid += ($this->players[$i]->status[PRECISIO_HAB] *3/10);
					$mid += ($this->players[$i]->status[POTENCIA_HAB] *1/10);	
					if(!$mid_init) $mid_init = 1;
					else $mid /= 2;					
				}break;
				case 5:{
					$atk += $this->players[$i]->status[ATAC_HAB];
					if(!$atk_init) $atk_init = 1;
					else $atk /= 2;
				}break;
				default:{
					$mid += ($this->players[$i]->status[DEFENSA_HAB] *10 / 100);
					$mid += ($this->players[$i]->status[ATAC_HAB] *60 / 100);
					$mid += ($this->players[$i]->status[PRECISIO_HAB] *20 / 100);
					$mid += ($this->players[$i]->status[POTENCIA_HAB] *10 / 100);	
					if(!$mid_init) $mid_init = 1;
					else $mid /= 2;					
				}break;
			}
		}
		$this->mid = array(round($def,2), round($mid,2), round($atk,2));
	}
	
	public function calculate_total_stadistic(){
		include(EL11IDEAL_PATH . 'modules/vars.php');
		$global_i = 1;
		
		for($i=0; $i < $strategia[$this->tactic][0]; $i++, $global_i++)
			$def += ($this->players[$global_i]->status[DEFENSA_HAB]*2);
				
		if(sizeof($strategia[$this->tactic]) >= 4){
			for($i=0; $i < $strategia[$this->tactic][1]; $i++, $global_i++)
				$def += ($this->players[$global_i]->status[DEFENSA_HAB]/2);
			$global_i -= $strategia[$this->tactic][1];
		}
		//$def = round($def / ($strategia[$this->tactic][0]+((sizeof($strategia[$this->tactic]) >= 4)?$strategia[$this->tactic][1]:0)), 2);
			
		for($i=0; $i < ($strategia[$this->tactic][1] + ((sizeof($strategia[$this->tactic]) == 4)?$strategia[$this->tactic][2]:0) + ((sizeof($strategia[$this->tactic]) == 5)?$strategia[$this->tactic][3]:0)); $i++, $global_i++){
			if(sizeof($strategia[$this->tactic]) == 3){
				$submid = ($this->players[$global_i]->status[DEFENSA_HAB] *10 / 100);
				$submid += ($this->players[$global_i]->status[ATAC_HAB] *60 / 100);
				$submid += ($this->players[$global_i]->status[PRECISIO_HAB] *20 / 100);
				$submid += ($this->players[$global_i]->status[POTENCIA_HAB] *10 / 100);	
			}
			if(sizeof($strategia[$this->tactic]) == 4){
				if($i < $strategia[$this->tactic][1]){
					$submid = ($this->players[$global_i]->status[DEFENSA_HAB] *5/10);
					$submid += ($this->players[$global_i]->status[PRECISIO_HAB] *5/10);
				}else{
					$submid = ($this->players[$global_i]->status[ATAC_HAB] *6/10);
					$submid += ($this->players[$global_i]->status[PRECISIO_HAB] *3/10);
					$submid += ($this->players[$global_i]->status[POTENCIA_HAB] *1/10);					
				}
			}
			if(sizeof($strategia[$this->tactic]) == 5){
				if($i < $strategia[$this->tactic][1]){
					$submid = ($this->players[$global_i]->status[DEFENSA_HAB] *5/10);
					$submid += ($this->players[$global_i]->status[PRECISIO_HAB] *5/10);
				}elseif($i < $strategia[$this->tactic][1]+$strategia[$this->tactic][2]){
					$submid = ($this->players[$global_i]->status[DEFENSA_HAB] *10 / 100);
					$submid += ($this->players[$global_i]->status[ATAC_HAB] *60 / 100);
					$submid += ($this->players[$global_i]->status[PRECISIO_HAB] *20 / 100);
					$submid += ($this->players[$global_i]->status[POTENCIA_HAB] *10 / 100);	
				}else{
					$submid = ($this->players[$global_i]->status[ATAC_HAB] *6/10);
					$submid += ($this->players[$global_i]->status[PRECISIO_HAB] *3/10);
					$submid += ($this->players[$global_i]->status[POTENCIA_HAB] *1/10);					
				}
			}
			
			if(sizeof($strategia[$this->tactic]) == 3) $mid += ($submid * 2);
			elseif(sizeof($strategia[$this->tactic]) ==4) $mid += ($submid * 1.5);
			elseif(sizeof($strategia[$this->tactic]) ==5){
				if($i < $strategia[$this->tactic][1]) $mid += ($submid * 2);
				elseif($i < $strategia[$this->tactic][2]) $mid += ($submid * 2);
				else  $mid += ($submid / 2);
			}		
			
		}
		//$mid = round($mid / ($strategia[$this->tactic][1] + ((sizeof($strategia[$this->tactic]) == 4)?$strategia[$this->tactic][2]:0) + ((sizeof($strategia[$this->tactic]) == 5)?$strategia[$this->tactic][3]:0)), 2);
			
		if(sizeof($strategia[$this->tactic]) == 4)
			$global_i -= $strategia[$this->tactic][2];
			
		if(sizeof($strategia[$this->tactic]) == 5)
			$global_i -= ($strategia[$this->tactic][2] + $strategia[$this->tactic][3]);
			
		for($i=0; $i < ((sizeof($strategia[$this->tactic]) ==3)?$strategia[$this->tactic][2]: /*else2*/ ((sizeof($strategia[$this->tactic]) ==4)?$strategia[$this->tactic][2] + $strategia[$this->tactic][3]:/*else3*/((sizeof($strategia[$this->tactic]) == 5)?$strategia[$this->tactic][3] + $strategia[$this->tactic][4]:0))); $i++, $global_i++){
			$subatk = ($this->players[$global_i]->status[ATAC_HAB] *90 / 100);	
			$subatk += ($this->players[$global_i]->status[PRECISIO_HAB] *5 / 100);
			$subatk += ($this->players[$global_i]->status[POTENCIA_HAB] *5 / 100);
			
			if(sizeof($strategia[$this->tactic]) ==3 ) $atk += ($subatk * 2);
			elseif(sizeof($strategia[$this->tactic]) ==4){
				if($i < $strategia[$this->tactic][2]) $atk += ($subatk / 2);
				else $atk += ($subatk * 2);
			}	
			elseif(sizeof($strategia[$this->tactic]) ==5){
				if($i < $strategia[$this->tactic][3]) $atk += ($subatk * 2);
				else $atk += ($subatk * 2);
			}		
		}
		//$atk = round($atk / ((sizeof($strategia[$this->tactic]) ==3)?$strategia[$this->tactic][2]: /*else2*/ ((sizeof($strategia[$this->tactic]) ==4)?$strategia[$this->tactic][2] + $strategia[$this->tactic][3]:/*else3*/((sizeof($strategia[$this->tactic]) == 5)?$strategia[$this->tactic][3] + $strategia[$this->tactic][4]:0))), 2);

		$this->total = array(round($def,2), round($mid,2), round($atk,2));
	}
	
	public function get_best_pos(){
		include(EL11IDEAL_PATH . 'modules/vars.php');
	
		$bestdef = 0;
		$bestmid = 0;
		$bestatk = 0;
		$this->bestdef_id = 0;
		for($i = 1; $i < sizeof($this->players); $i++){
			switch($this->players[$i]->position){
				case 2:{		
					if($this->bestdef_id == 0 || $this->players[$i]->status[DEFENSA_HAB] > $bestdef){
						$this->bestdef_id = $i;
						$bestdef = $this->players[$i]->status[DEFENSA_HAB];
					}
				}break;
				case 3:{
					$hab = ($this->players[$i]->status[DEFENSA_HAB] *5/10);
					$hab += ($this->players[$i]->status[PRECISIO_HAB] *5/10);
					if($this->bestmid_id == 0 || $hab > $bestmid){
						$this->bestmid_id = $i;
						$bestmid = $hab;
						$this->bestmid_hab = $hab;
					}
				}break;
				case 4:{
					$hab = ($this->players[$i]->status[ATAC_HAB] *6/10);
					$hab += ($this->players[$i]->status[PRECISIO_HAB] *3/10);
					$hab += ($this->players[$i]->status[POTENCIA_HAB] *1/10);	
					if($this->bestmid_id == 0 || $hab > $bestmid){
						$this->bestmid_id = $i;
						$bestmid = $hab;
						$this->bestmid_hab = round($hab, 2);
					}
				}break;
				case 5:{
					if($this->bestatk_id == 0 || $this->players[$i]->status[ATAC_HAB] > $bestatk){
						$this->bestatk_id = $i;
						$bestatk = $this->players[$i]->status[ATAC_HAB];
					}
				}break;
			}
		}
	}
	
	public function check_in_training(){
		global $mysql, $user;
		$query = $mysql->do_query('SELECT * FROM {{table}} where p_id=' . $user->id . ' ORDER BY id DESC', 'trainings');
		$this->num_trainings = mysql_num_rows($query); 
		if($this->num_trainings <= 0)
			return false;	
	}
}
?>