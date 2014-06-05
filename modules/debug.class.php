<?
//Si no est� definida la variable global sortim
if(!defined('EL11IDEAL_IN'))
	exit;
		
//Classe principal DEBUG (OOP - Programaci� orientada a objectes)
class Debug{
	private $debug = array(array()); 	//Un arregle (array) que contindr� tots els missatges
	private $current=0;					//Variable utilitzada per dur el compte de missatge
	private $timeparts;					//Variable utilitzada per comptar el temps que triga a carregar
	private $starttime;					//Igual que l'anterior
	private $err_var;					//Variable per tenir const�ncia de la funci� que captura els errors PHP
	private $err = array();				//Arregle (array) que contindr� els errors PHP (cal millorarla)
	private $err_num = 0;				//Variable per dur el compte de missatges d'error PHP
	private $active_debug;
	
	//Funci� inicialitzadora
	public function Debug($active_debug){
		$this->active_debug = $active_debug;
		if($active_debug)
			$this->timer_start();	//Si volem dur una depuraci� extrema, comptem el temps de c�rrega
		$this->err_var = set_error_handler(array(&$this, 'ErrHandler'), (($active_debug==true)?E_ALL:(E_ALL ^ E_NOTICE)));
		//Establim la funci� que captura errors PHP, i si cal o no capturar tots els tipus d'error
	}
	//Funci� que comen�a el comptador de temps de c�rrega
	private function timer_start() {
		//... Molt dif�cil d'explicar...
		$this->timeparts = explode(" ",microtime());
		$this->starttime = $this->timeparts[1].substr($timeparts[0],1);
		$this->timeparts = explode(" ",microtime());
	}
	//Funci� que complementa la anterior, para el comptador
	private function timer_end() {
		//... Molt dif�cil d'explicar...
		$endtime = $this->timeparts[1].substr($this->timeparts[0],1);
		return bcsub($endtime,$this->starttime,6);
	}

	//Permet possar un nou error a la array d'errors
	public function push($main_type, $sub_type, $value, $sub_value=0){
		$this->debug[$this->current++] = array(0=>$main_type, 1=> $sub_type, 2=> $value, 3=> $sub_value);
	}
	
	//Destrueix totes les classes creades en el Common.php. Realment no �s important ja que PHP no fa servir la mem�ria real de l'ordinador del client
	public function unset_all(){
		global $session, $mysql, $user, $fun, $template, $lang;
		unset($session);
		unset($mysql);
		unset($user);
		unset($functions);
		unset($template);
		unset($lang);
	}
	
	//La funci� que captura errors PHP
	public function ErrHandler($errno, $errstr, $errfile, $errline)
	{
		$this->err[$this->err_num++] = "{" . $errno . "} => " . $errstr . " " . $errfile . " " . $errline;
		if($errno == E_USER_ERROR || $errno == E_ERROR){
			global $functions, $template, $lng;
			echo $template->parsetemplate('fatal_error', array('ERR' => $errstr, 'FATAL_ERROR' => $lng['FATAL_ERROR']));
			$functions->build_footer(true);
		}
		return true;
	}
	
	//Funci� que mostra tots els errors obtinguts durant la mostra de la p�gina.
	//Ha de ser de les �ltimes funcions creades, just abans de mostrar el ending.
	public function pop(){	
		if(!$this->active_debug) exit;
		//L'explicar� m�s tard!
		$index = 0;
		for($i=0;$i<$this->current;$i++){
			echo "DEBUG " . $i . " : ";
			switch($this->debug[$i][0]){
				case 'MYSQL_CONNECT':
					if(!empty($this->debug[$i][1])) echo "MYSQL_CONNECT : " . $this->debug[$i][2] . "<br>";
				break;
				case 'MYSQL_DB_SELECT':
					echo "MYSQL_DB_SELECT : " . $this->debug[$i][2] . "<br>";
				break;
				case 'MYSQL_QUERY':
					echo "MYSQL_QUERY (" . ++$index . ") : " . $this->debug[$i][2] . " -> " . $this->debug[$i][3] . "<br>";
				break;
				case 'FUNCTIONS_INITVARS':
					echo 'FUNCTIONS_INITVARS : 1<br>';
				break;
				case 'FUNCTIONS_CONFIG':
					echo 'FUNCTIONS_CONFIG : <br><blockquote>';
					foreach($this->debug[$i][2] as $key => $value)	
						echo $key . ' -> ' . $value . "<br>";
					echo "</blockquote>";
				break;
				default:
					echo $this->debug[$i][0] . ' : ' . $this->debug[$i][2] . '<br>';
				break;
			}
		}
		echo "<br>N&uacute;mero de consultas SQL: " . $index;
		echo "<br>Tiempo de ejecuci&oacute;n: " . $this->timer_end();
		echo "<br>&Uacute;ltimo error MYSQL : " . ((($err=mysql_error())=='')?'No':$err);
		echo "<br>Errores PHP : ";
			if($this->err_num != 0){
				echo "<br><blockquote>";
				for($i=0 ; $i<$this->err_num ; $i++)
					echo $this->err[$i] . "<br>";
				echo "</blockquote>";
			}else
				echo "No";
	}	
}

?>