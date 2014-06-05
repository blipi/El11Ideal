<?
if(!defined('EL11IDEAL_IN'))
	exit;

class Mysql{
	private $dblink;
	var $conarr = array();
	
	public function Mysql(){
		$this->conarr['dbhost'] = "localhost" ; 
		$this->conarr['dbuser'] = "root" ; 
		$this->conarr['dbpass'] = "" ;
		$this->conarr['db'] = "el11ideal" ;/*
		$this->conarr['dbhost'] = "mysql12.000webhost.com" ; 
		$this->conarr['dbuser'] = "a2299533_user" ; 
		$this->conarr['dbpass'] = "el11t3am" ;
		$this->conarr['db'] = "a2299533_db" ;*/
		$this->conarr['pref'] = "el11_"; //<= NO TOCAR A NO SER QUE SEPAS DE QUE VA
	}
	
	public function connect($ret=false){
		if(defined('DEBUG')) global $debug;
		
		$this->dblink = @mysql_connect($this->conarr['dbhost'],$this->conarr['dbuser'],$this->conarr['dbpass']);
		if(defined('DEBUG')){ 
			$debug->push('MYSQL_CONNECT', 'RESULT',  (($this->dblink==true)?1:0));
		}
				
		if(!$this->dblink){
			if($ret) return false;
			else
				trigger_error("MYSQL_ERROR::" . "Error de connecció a la DB", E_USER_ERROR);
		}
		
		$r = @mysql_select_db($this->conarr['db'],$this->dblink);
		
		if(defined('DEBUG'))
			$debug->push('MYSQL_DB_SELECT', 'RESULT',  (($r==true)?1:0));
		
			
		if($r && $ret) return true;
		elseif(!$r){
			if($ret) return false;
			else 
				trigger_error("MYSQL_ERROR::" . "Error de selecció de la DB", E_USER_ERROR);
		}
	}
	
	public function do_query($query, $table, $usePref='', $ret=true){	
		$query = str_replace('{{table}}',(($usePref=='')? $this->conarr['pref'] : $usePref) . $table, $query);
		$quer = mysql_query($query);
		
		//Class debug...
		if(defined('DEBUG')){ 
			global $debug;
			$debug->push('MYSQL_QUERY', 'QUERY', $query, (($query==true)?1:0));
			if(!$query) $debug->push('MYSQL_QUERY_ERROR', 'QUERY', mysql_error(), 0);
		}
		if($ret){
			if($quer) return $quer;
			else{ return 0; }
		}else{
			if($quer){ return true; }
			else{ return false; }
		}
	}
}
?>