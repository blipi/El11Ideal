<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>El 11 ideal</title>
<link href="{STYLE_DIR}default.css" rel="stylesheet" type="text/css" media="screen" />
<script src="{ROOT}scripts/postprocess.js"></script>
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
	eval(targ+".location='lang.php?l="+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
}
function toggle(id){
	document.getElementById('msg'+id).style.display = '';
}
/*
ES UTIL, PERO DE MOMENTO NO LO VAMOS A USAR
var isMSIE = (( navigator.appVersion.indexOf( "MSIE" ) != -1 )?true:false);
*/
//-->
</script>
</head>
<body>
<!-- start header -->
<div id="header">
  <div id="banner"><img src="{STYLE_DIR}images/banner11.gif" alt="" width="943" height="190" /></div>
  <br/>
	{UPPER_MENU}
</div>
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<div id="page-bg">
		  {LEFT_MENU}
			<!-- start content -->
			<div id="content">
				<div id="content-bgtop">
				<div id="content-bgbtm">
				<div class="post">
				  <h1 class="title"><CENTER>
				    {TITLE}<br>
                  </CENTER></h1>
                  <table width="539" height="232" border="1">
                      <tr>
                        <td height="226">
						<script>
							function validate(frm){
								if (frm.team_name.value.length <= 3){ alert("{TEAM_NAME_SHORT}"); return false; };
								return true;
							}
							function changeHelp(id, c){
								var obj = document.getElementById("player_info");
								switch(id){
									case 0:	obj.innerHTML = "{MAX} "+c+"/2."; break;
									case 1:	obj.innerHTML = "{MAX} "+c+"/6."; break;
									case 2:	obj.innerHTML = "{MAX} "+c+"/3."; break;
									case 3:	obj.innerHTML = "{MAX} "+c+"/3."; break;
									case 4:	obj.innerHTML = "{MAX} "+c+"/3."; break;
								}
							}
						</script>
						<div style="padding-left:10px;padding-bottom:5px; color:Olive;"> {WELCOME_TEAM_CREATE} </div>
						<form  method="POST" action="{ROOT}game.php?page=teamcreate&check=1" onsubmit="return validate(this);">
						<table width="400" align="center">
						  {ERR}			
		            	  <tr><td width="50%">{TEAM_NAME} </td><td><input type="text" name="team_name"></td></tr>
						  <tr><td width="50%">{TEAM_LEAGUE} </td><td>
							<select name="team_country">
								<option value="1">{MOROCAN}</option>
								<option value="2">{NIGERIAN}</option>
								<option value="3">{JAPANESE}</option>
								<option value="4">{BELGIAN}</option>
								<option value="5">{BULGARIAN}</option>
								<option value="6">{CROATIAN}</option>
								<option value="7">{CZECH_REPUBLIC}</option>
								<option value="8">{DANISH}</option>
								<option value="9">{DUTCH}</option>
								<option value="10">{ENGLISH}</option>
								<option value="11">{FRENCH}</option>
								<option value="12">{GERMAN}</option>
								<option value="13">{GREEK}</option>
								<option value="14">{ITALIAN}</option>
								<option value="15">{NORWAY}</option>
								<option value="16">{POLISH}</option>
								<option value="17">{PORTUGUESE}</option>				
								<option value="18">{ROMANIAN}</option>
								<option value="19">{RUSSIAN}</option>	
								<option value="20">{SCOTTISH}</option>
								<option value="21">{SERBIAN}</option>
								<option value="22">{SPANISH}</option>
								<option value="23">{SWEDISH}</option>
								<option value="24">{SWISS}</option>
								<option value="25">{TURKISH}</option>
								<option value="26">{UKRANIA}</option>
								<option value="27">{WELSH}</option>
								<option value="28">{ARGENTINA}</option>
								<option value="29">{BRAZILIAN}</option>
								<option value="30">{CHILEAN}</option>
								<option value="31">{COLOMBIAN}</option>
								<option value="32">{PERUVIAN}</option>
								<option value="33">{URUGUAYAN}</option>
								<option value="34">{VENEZUELAN}</option>
								<option value="35">{EEUU}</option>
								<option value="36">{MEXICAN}</option>
							</select>
						  </td></tr>
						  <tr><td colspan="2">&nbsp;</td></tr>
						  <tr><td colspan="2" align="center"><input type="submit" value="{SEND}"></td></tr>
						</table>
						</form>
					</td>
                      </tr>
                    </table>
				</div>
				</div>
			</div>
			</div>
			<!-- end content -->
			<!-- start sidebars -->
			{RIGHT_MENU}
			<!-- end sidebars -->
			<div style="clear: both;">&nbsp;</div>
		</div>
	</div>
	<!-- end page -->
</div>
<div id="footer">
  <p class="link"><a href="#">EL 11 IDEAL</a><a href="#"></a></p>
  <img src="{STYLE_DIR}images/parteinferior.gif" alt="inferior" longdesc="parte inferiror" /></div>
</body>
</html>

<!--[if lt IE 7.]>
<script defer type="text/javascript" src="{STYLE_PATH}pngfix.js"></script>
<![endif]-->

