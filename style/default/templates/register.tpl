<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>El 11 ideal</title>
<link href="{STYLE_DIR}default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='lang.php?l="+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function validate(frm){
	if(frm.nombre.value.length == 0){ alert('{REG_NAME_INVALID}'); return false; }
	if(frm.email.value.length <= 3 ){ alert('{REG_EMAIL_INVALID}'); return false; }
	if(frm.email.value.lastIndexOf('@') < 0){ alert('{REG_EMAIL_INVALID}'); return false; }
	if(frm.email.value.lastIndexOf('.') < 0){ alert('{REG_EMAIL_INVALID}'); return false; }
	if(frm.email.value != frm.email_c.value){ alert('{REG_EMAIL_CONFIRM_INVALID}'); return false; }
	if(frm.nick.value.length < 5 ){ alert('{REG_NICK_INVALID}'); return false; }
	if(frm.pass.value.length < 5 ){ alert('{REG_PASS_INVALID}'); return false; }
	if(frm.pass.value != frm.pass_c.value){ alert('{REG_PASS_CONFIRM_INVALID}'); return false; }
	if(!frm.priv.checked){ alert('{REG_PRIV_INVALID}'); return false; }
	return true;
}
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
		  <div id="sidebar1" class="sidebar">
				<div id="sidebar1-bgtop">
				<div id="sidebar1-bgbtm">
				<ul>
					<li>
						<h2>Login</h2>
						<ul>
						  <li>
						  	<form method="post" action="log.php">
                            USUARIO:<input type="text" name="nick" value="" class="green_input" />
                            CONTRASEÑA:<input type="password" name="pass" value="" class="green_input" />
							RECUERDAME
							<input type="checkbox" name="recuerda" value="ON" class="green_input" />
                            <br><br/>
                            <CENTER><input type="submit" value="ENTRAR" class="green_input" /></CENTER>
							</form>
                            <br>
						  </li>
					  </ul>
					</li>
					
				</ul>
				</div>
			</div>
			</div>
			<!-- start content -->
			<div id="content">
				<div id="content-bgtop">
				<div id="content-bgbtm">
				<div class="post">
				  <h1 class="title"><CENTER>Registrarse<br>
                  </CENTER></h1>
                  <div class="entry">
                  {ERR}
				   <form method="post" action="reg.php?r=1" onsubmit="return validate(this);" id="reg_form">  
				   	<p>NOMBRE:<img src="{STYLE_DIR}images/registrate.png" alt="" align="right" longdesc="Registrarse" /><br>
						  <input type="text" name="nombre" value="" />
                    </p>
                        <p>APELLIDOS:<br>
                    <input type="text" name="apellidos" value="" /></p>
                        <p>EMAIL:<br>
                    <input type="text" name="email" value="" /></p>
                        <p>CONFIRMA EL EMAIL:<br>
                          <input type="text" name="email_c" value="" /></p>
                        <p>NICK:<br>
                          <input type="text" name="nick" value="" /></p>
                        <p>CONTRASE�A:<br>
                          <input type="password" name="pass" value="" />
                        </p>
                        <p>CONFIRMA TU CONTRASE�A:<br>
                    <input type="password" name="pass_c" value="" /></p>
                        <p>ESTOY DE ACUERDO CON LA POLITICA DE PRIVACIDAD
                          <input type="checkbox" name="priv" value="ON" /></p>
						  <p><input type="submit" value="{REG_SUBMIT}" /></p>
					</form>
				  </div>
				</div>
				</div>
			</div>
			</div>
			<!-- end content -->
			<!-- start sidebars -->
			<div id="sidebar2" class="sidebar">
				<div id="sidebar2-bgtop">
				<div id="sidebar2-bgbtm">
				<ul>
					<li>
						<form id="searchform" method="get" action="#">
							<div>
								<h2>Elige idioma</h2>
                              <ul>
                        	<li>TU IDIOMA:                            </li>
								<li><br/>
						          <CENTER>
						            <p>
						              <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)" class="green_input" >
						                <option value="es" {SEL1}>Español</option>
						                <option value="ca" {SEL2}>Català</option>
						                <option value="en" {SEL3}>English</option>
						              </select>
						            </p>
					              </CENTER>
								  <br/>
                              </ul>
                                <h2>Introducción</h2>
                                <ul>
								<li>
                                <CENTER><a href="#">INTRODUCCIÓN AL JUEGO</a></CENTER>
                                </ul>
								</div>
						</form>
					</li>
				  </ul>
			</div>
			</div>
			</div>
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