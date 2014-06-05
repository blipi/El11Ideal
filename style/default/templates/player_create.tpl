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
				    {CREATING}<br>
                  </CENTER></h1>
                  <table width="539" height="232" border="1">
                      <tr>
                        <td height="226">
						<div style="padding-left:10px;padding-bottom:5px; color:Olive;"> {WELCOME_PLAYER_CREATE} </div>
						<form  method="POST" action="{ROOT}game.php?page=playercreate&check=1" onsubmit="return validate(this);">
						<table width="400" align="center">
						  {ERR}  
						  <tr><td width="50%">{PLAYER_NAME} </td><td><input type="text" name="player_name"></td></tr>
						  <tr><td width="50%">{PLAYER_SURNAME} </td><td><input type="text" name="player_surname"></td></tr>
						  <tr><td colspan="2" align="center"><a href="javascript:void(0);" onclick="auto_gen_name();" style="color:#228b22;"><b>{AUTOGEN}</b></a></td></tr>
						  <tr><td width="50%">{PLAYER_POSITION} </td><td>
							<select name="player_pos">
								<option value="1">{PORTERO} ({P_CURRENT}/3)</option>
								<option value="2">{DEFENSA} ({D_CURRENT}/7)</option>
								<option value="3">{MEDIO_DEF} ({MD_CURRENT}/5)</option>
								<option value="4">{MEDIO_ATA} ({MA_CURRENT}/5)</option>
								<option value="5">{DELANTERO} ({DEL_CURRENT}/5)</option>
							</select>
							<input type="hidden" name="p0">
							<input type="hidden" name="p1">
							<input type="hidden" name="p2">
							<input type="hidden" name="p3">
							<input type="hidden" name="p4">
							<input type="hidden" name="p5">
							<input type="hidden" name="p6">
							<input type="hidden" name="p7">				
						  </td></tr>
						  <tr><td colspan="2">
<div style="border: 1px solid #000000;">
&nbsp;&nbsp;<b>Estatus:<br></b>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td style="padding-left:20px;" width="30%">Portero:</td><td align="left" valign="middle">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(0);">
	<div name="subbar0" id="subbar0" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(0);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c0">{S_CURRENT0}</div></td></tr>
<tr><td style="padding-left:20px;" width="30%">Agilidad:</td><td align="left">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(1);">
	<div name="subbar1" id="subbar1" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(1);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c1">{S_CURRENT1}</div></td></tr>
<tr><td style="padding-left:20px;" width="30%">Reflejos:</td><td align="left">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(2);">
	<div name="subbar2" id="subbar2" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(2);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c2">{S_CURRENT2}</div></td></tr>
<tr><td style="padding-left:20px;" width="30%">Defensa:</td><td align="left">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(3);">
	<div name="subbar3" id="subbar3" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(3);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c3">{S_CURRENT3}</div></td></tr>
<tr><td style="padding-left:20px;" width="30%">Precisión:</td><td align="left">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(4);">
	<div name="subbar4" id="subbar4" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(4);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c4">{S_CURRENT4}</div></td></tr>
<tr><td style="padding-left:20px;" width="30%">Potencia:</td><td align="left">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(5);">
	<div name="subbar5" id="subbar5" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(5);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c5">{S_CURRENT5}</div></td></tr>
<tr><td style="padding-left:20px;" width="30%">Ataque:</td><td align="left">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(6);">
	<div name="subbar6" id="subbar6" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(6);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c6">{S_CURRENT6}</div></td></tr>
<tr><td style="padding-left:20px;" width="30%">Velocidad:</td><td align="left">
<div style="border:1px solid #FFFFFF; padding:1px; background-color:#000000;text-align:left; width:200px; height:10px;" onclick="calculate_new_bar(7);">
	<div name="subbar7" id="subbar7" style="background-color:#448844; width:100px; height:100%; color:#FFFFFFF; font-weight: bold; text-align:center" onclick="calculate_new_bar(7);"></div>
</div> 
</td><td align="left" width="20%" style="padding-left:5px;"><div id="c7">{S_CURRENT7}</div></td></tr>
<tr><td colspan="4" align="center">Te quedan <b><a id="tCount">15</a></b> de <b>15</b></td></tr>
</table>
</div>
</td></tr>
						  <tr><td colspan="2" style="color:Olive;text-align:center;">{N_FICHAJES} {N_F} {FICHAJES} {OUT_OF} 16</td></tr>
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

