<?php
function countryCityFromIP($ipAddr)
{
   //function to find country and city name from IP address
   //Developed by Roshan Bhattarai 
   //Visit http://roshanbh.com.np for this script and more.
  
  //verify the IP address for the  
  ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
  // This notice MUST stay intact for legal use
  $ipDetail=array(); //initialize a blank array
  //get the XML result from hostip.info
  $xml = file_get_contents("http://api.hostip.info/?ip=".$ipAddr);
  //get the city name inside the node <gml:name> and </gml:name>
  preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);
  //assing the city name to the array
  $ipDetail['city']=$match[2]; 
  //get the country name inside the node <countryName> and </countryName>
  preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);
  //assign the country name to the $ipDetail array 
  $ipDetail['country']=$matches[1];
  //get the country name inside the node <countryName> and </countryName>
  preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
  $ipDetail['country_code']=$cc_match[1]; //assing the country code to array
  //return the array containing city, country and country code
  return $ipDetail;
} 
  

function get_ip(){
		if ($_SERVER) {
			if ( $_SERVER['HTTP_X_FORWARDED_FOR'] ) {
				$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif ( $_SERVER['HTTP_CLIENT_IP'] ) {
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
/*
$country = file_get_contents('http://api.hostip.info/country.php?ip=89.129.55.82');
echo $country;
*/
	
exit;

$v2 = rand(0,rand(2,rand(3,rand(4,rand(5,6)))));

$rnd = rand(1, $v2 * 100);
echo "Rand = " . $rnd . "<br>"; 
$rnd = (0.01 * rand($rnd-10, $rnd+10));
if($rnd < 0) $rnd = -$rnd;
echo "RND = $rnd";
?>
