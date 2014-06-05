<?
if(!defined('EL11IDEAL_IN'))
	exit;

session_start();
		
class Session{
	public $sid;
	private function XOREncryption($InputString, $KeyPhrase){ 
		$KeyPhraseLength = strlen($KeyPhrase);
	 	for ($i = 0; $i < strlen($InputString); $i++){
			$rPos = $i % $KeyPhraseLength;
			$r = ord($InputString[$i]) ^ ord($KeyPhrase[$rPos]);
			$InputString[$i] = chr($r);
		}
		return $InputString;
	}
	  
	public function XOREncrypt($InputString, $KeyPhrase){
		$InputString = $this->XOREncryption($InputString, $KeyPhrase);
		$InputString = base64_encode($InputString);
		return $InputString;
	}
	/*
	public function XORDecrypt($InputString, $KeyPhrase){
		$InputString = base64_decode($InputString);
		$InputString = $this->XOREncryption($InputString, $KeyPhrase);
		return $InputString;
	}
	*/
	public function get_ip(){
		if ($_SERVER) {
			if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
				$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif ( isset($_SERVER['HTTP_CLIENT_IP']) ) {
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			} else {
				$realip = $_SERVER['REMOTE_ADDR'];
			}
		} else {
			if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
				$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
			} elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
				$realip = getenv( 'HTTP_CLIENT_IP' );
			} else {
				$realip = getenv( 'REMOTE_ADDR' );
			}
		}
		return $realip;
	}
	private function gen_sid($uname){
		$sid = '';
		$ip = str_replace('.', '', $this->get_ip());
		$ssid = ((strlen($uname) > strlen($ip))?$this->XOREncrypt($uname, $ip):$this->XOREncrypt($ip, $uname));
		for ($i = 0; $i < strlen($ssid); $i++)
			$sid .= ord($ssid[$i]);
		return $sid;
	}
	public function init(){
		global $user, $functions;
		if ($user->logged==true){
			$this->sid = $this->gen_sid($user->username);
			if(isset($functions->vars['SESSION']['SID'])){
				if($functions->vars['SESSION']['SID'] != $this->sid){
					$user->log_out();
					header('LOCATION: index.php?m=e10');
				}
			}else
				$_SESSION['SID'] = $this->sid;
		}
	}
}
?>