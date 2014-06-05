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
					<li>
						<h2> Registrarse</h2>
						<ul>
                        	<li>CREA TU EQUIPO:
                            <br><br/>
							<CENTER><input type="submit" value="REGISTRARSE" onclick="location.href='reg.php';" class="green_input" /></CENTER>
                            <br/>
                            <a href="#">¿Olvidó su contraseña?</a></li>
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
				  <h1 class="title"><CENTER>{WELCOME}<br>
                  </CENTER></h1>
                  <table width="539" height="232" border="1">
				 	 {MSG}			  
                      <tr>					  	
                        <td height="226">{WELCOME_TEXT}</td>
                      </tr>
                    </table>
				    <div class="entry">
						<p>Att: AdministraciÃ³n.</p>
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
						                <option value="ca" {SEL2}>Català </option>
						                <option value="en" {SEL3}>English</option>
						              </select>
						            </p>
					              </CENTER>
								  <br/>
                              </ul>
                                <h2>IntroducciÃ³n</h2>
                                <ul>
								<li>
                                <CENTER><a href="#">INTRODUCCIÃ“N AL JUEGO</a></CENTER>
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