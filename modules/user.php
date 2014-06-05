<?
if(!defined('EL11IDEAL_IN'))
	exit;

include(EL11IDEAL_PATH.'modules/team.class.php');
	
class User{
	var $logged=false;
	var $id;
	var $username;
	var $c_uname;
	var $team;
	
	public function __destruct(){
		unset($this->team);
	}
	
	public function check_log($return=false){
		if($_SESSION['logged']==true){
			global $mysql;
			$query = $mysql->do_query("select pass,id,c_id from {{table}} where nick='". $_SESSION['nick'] ."'","users");
			if(mysql_num_rows($query) > 0){
				$resp = mysql_fetch_array($query);
				if($_SESSION['pass'] == $resp['pass'])
				{	
					$this->username = $_SESSION['nick'];
					$this->id = (int)($resp['id']);			
					$this->c_id = (int)($resp['c_id']);		
					$this->logged=true;
					$this->team = new Team($this->id, $this->c_id);
					if($return)return true;
				}else{
					$this->logged=false;
					if($return)return false;
				}
			}else{
				$this->logged=false;
				if($return)return false;
			}
		}else{
			$this->logged=false;
			if($return)return false;
		}
	}
	
	public function register($nick, $pass, $nombre, $apellidos, $email){
		global $mysql;
		$r = $mysql->do_query("select * from {{table}} where nick='". $nick ."'",'users');
		if (mysql_num_rows($r) > 0)
			return 2;
		if($mysql->do_query('insert into {{table}} (nick,pass,nombre,apellidos,email) values ("'. $nick .'","'. md5($pass) .'","'. $nombre .'","'. $apellidos .'","'. $email .'")', "users",'',false) == false)
			return 3;	
		
		return 1;
	}
	
	public function log_in($uname, $upass){
		global $mysql;
		$query = $mysql->do_query('select * from {{table}} where nick="'. $uname .'" and pass="'. md5($upass) .'"', "users");
		if(mysql_num_rows($query) > 0){
			$resp = mysql_fetch_array($query);
			$_SESSION['logged'] = true;
			$_SESSION['nick'] = $uname;
			$_SESSION['pass'] = md5($upass);
			return true;
		}else
			return false;
	}
	
	public function log_out(){
		$_SESSION['logged'] = false;
		unset($_SESSION['nick']);
		unset($_SESSION['pass']);
		unset($_SESSION['SID']);
		return true;
	}
}
?>