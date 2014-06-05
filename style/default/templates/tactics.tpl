<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>El 11 ideal</title>
<link href="{STYLE_DIR}default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
var oldTextObj = 0;
var c_tactic = -1;
function c(id, textObj) { 
	var obj = document.getElementById('pic');
	c_tactic = id;
	switch(id){
		case 1: obj.src = '{STYLE_DIR}images/tactics/1-4-3-2.png'; break;
		case 2: obj.src = '{STYLE_DIR}images/tactics/3-4-1-2.png'; break;
		case 3: obj.src = '{STYLE_DIR}images/tactics/3-4-2-1.png'; break;
		case 4: obj.src = '{STYLE_DIR}images/tactics/3-4-3.png'; break;
		case 5: obj.src = '{STYLE_DIR}images/tactics/3-5-2.png'; break;
		case 6: obj.src = '{STYLE_DIR}images/tactics/4-1-2-1-2.png'; break;
		case 7: obj.src = '{STYLE_DIR}images/tactics/4-1-2-2-1.png'; break;
		case 8: obj.src = '{STYLE_DIR}images/tactics/4-2-3-1.png'; break;
		case 9: obj.src = '{STYLE_DIR}images/tactics/4-2-4.png'; break;
		case 10: obj.src = '{STYLE_DIR}images/tactics/4-3-1-2.png'; break;
		case 11: obj.src = '{STYLE_DIR}images/tactics/4-3-2-1.png'; break;
		case 12: obj.src = '{STYLE_DIR}images/tactics/4-3-3.png'; break;
		case 13: obj.src = '{STYLE_DIR}images/tactics/4-4-1-1.png'; break;
		case 14: obj.src = '{STYLE_DIR}images/tactics/4-4-2.png'; break;
		case 15: obj.src = '{STYLE_DIR}images/tactics/4-5-1.png'; break;
		case 16: obj.src = '{STYLE_DIR}images/tactics/5-2-1-2.png'; break;
		case 17: obj.src = '{STYLE_DIR}images/tactics/5-2-2-1.png'; break;
		case 18: obj.src = '{STYLE_DIR}images/tactics/5-3-2.png'; break;
		case 19: obj.src = '{STYLE_DIR}images/tactics/5-4-1.png'; break;
	}
	if(textObj == 0) textObj=document.getElementById('t' + c_tactic);
	textObj.style.color = 'red';	
	if(oldTextObj != 0) oldTextObj.style.color = 'white';
	oldTextObj = textObj;
}
function val(){
	if (c_tactic > -1){
		eval("location.href='game.php?page=tactics&tac="+c_tactic+"'");
	}else{
		alert("{NO_TACTIC_SELECTED}");
	}
}
</script><style type="text/css">
<!--
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	font-size:85%;	
}
-->
</style>
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
				    <p>TACTICA<br>
	                </p>
				    </CENTER></h1>
                  <div class="entry">
				  	{MSG}
                    <p align="center">Escoge la tactica que quieres usar con tu equipo.</p>
                    <table width="500">
                      <!--DWLayoutTable-->
                      <tr>
                        <td width="169" height="32" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t1" onclick="c(1, this);">1-4-3-2</a></strong></div>                        </td>																																									
                        <td width="2">&nbsp;</td>
                        <td width="301" rowspan="13" valign="middle"><img id ="pic" src="{STYLE_DIR}images/tactics/campo.png" alt="" width="300" height="413" align="right" /></td>
                      <td width="1"></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t2" onclick="c(2, this);">3-4-1-2</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t3" onclick="c(3, this);">3-4-2-1</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t4" onclick="c(4, this);">3-4-3</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t5" onclick="c(5, this);">3-5-2</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t6" onclick="c(6, this);">4-1-2-1-2</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t7" onclick="c(7, this);">4-1-2-2-1</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t8" onclick="c(8, this);">4-2-3-1</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t9" onclick="c(9, this);">4-2-4</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t10" onclick="c(10, this);">4-3-1-2</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t11" onclick="c(11, this);">4-3-2-1</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="32" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t12" onclick="c(12, this);">4-3-3</a></strong></div></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td rowspan="2" valign="top" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t13" onclick="c(13, this);">4-4-1-1</a></strong></div></td>
                        <td height="7"></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="23"></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      
                      
                      <tr>
                        <td height="32" valign="top" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t14" onclick="c(14, this);">4-4-2</a></strong></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      <tr>
                        <td rowspan="2" valign="top" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t15" onclick="c(15, this);">4-5-1</a></strong></div></td>
                        <td height="12"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="18" colspan="2" valign="top"><div align="center" class="Estilo1">
                          <div align="right"><b>{MSG_TACTICS_1}</b></div>
                        </div></td>
                        <td></td>
                      </tr>
                      
                      
                      <tr>
                        <td rowspan="2" valign="top" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t16" onclick="c(16, this);">5-2-1-2</a></strong></div></td>
                        <td height="17" colspan="2" valign="top"><div align="center" class="Estilo1">
                          <div align="right"><b>{MSG_TACTICS_2}</b></div>
                        </div></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="2" rowspan="2" valign="top"><div align="center" class="Estilo1">
                          <div align="right"><b>{MSG_TACTICS_3}</b></div>
                        </div></td>
                        <td height="13"></td>
                      </tr>
                      
                      <tr>
                        <td rowspan="2" valign="top" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t17" onclick="c(17, this);">5-2-2-1</a></strong></div></td>
                        <td height="17"></td>
                      </tr>
                      <tr>
                        <td height="13"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      <tr>
                        <td height="32" valign="top" bgcolor="#333333"><div align="center"><strong><a href="javascript:void(0);" id="t18" onclick="c(18, this);">5-3-2</a></strong></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      <tr>
                        <td rowspan="2" valign="top" bgcolor="#666666"><div align="center"><strong><a href="javascript:void(0);" id="t19" onclick="c(19, this);">5-4-1</a></strong></div></td>
                        <td height="32"></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    <div align="right"></div>
                    <div align="center">
                      <input type="button" onclick="val();" value="Guardar" />
                    </div>
                  </div>
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
  <script>
  if({USING_TACTIC} > 0) c({USING_TACTIC}, 0);
  </script>
</body>
</html>

<!--[if lt IE 7.]>
<script defer type="text/javascript" src="{STYLE_PATH}pngfix.js"></script>
<![endif]-->