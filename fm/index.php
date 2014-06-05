<script>
var timeElapsed=0;
var redir=true;
function cancelRedirect(){
 redir = false;
}
function checkRedirect(){
 var obj = document.getElementById('time');
 timeElapsed = timeElapsed + 1;
 obj.innerHTML = (30 - timeElapsed);
 if(timeElapsed >= 30){
  	redir = false;
 	location.href='ft2.php';
 }
 if(redir) setTimeout('checkRedirect()', 999);
}
window.onload = function(){
 setTimeout('checkRedirect()', 999);
}
</script>    
<?
	include_once("../game/changelog.php");
?>
<a href="ft2.php">Ir ahora</a><br>
Redirigiendo en <a id='time'>30</a> segundos...<br>
<a href="javascript:void(0);" onclick="cancelRedirect()">Cancelar redirección</a>
<br><br>
<b>Changelog:</b><br>
<div style="border: 3px dashed #000000; background-color: #666666; color: #FFFFFF;">
<ul>
 <?
 	foreach($changelog as $k => $v)
 		echo "<li>v" . $k . "<ul><li>" . $v . "</li></ul></li>";
 ?>
 </ul>
</div>