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
				    <p>ALINEACION<br>
	                </p>
				    </CENTER></h1>
                  <div class="entry">
                    <p align="center">Escoge la alineacion que quieres usar con tu equipo.</p>
                    <div  align="right"></div>
                    <CENTER>
					<div id="tools_box" style="position:fixed; left:auto; top:auto; display:block; border:1px solid #FFFFFF; background-color:#006600; padding:10px;">			
					<img src="{STYLE_DIR}images/align/change.png" alt="Change Players" longdesc="Change Players Positions" onclick="change(-1,2);" />
					</div>
<div id="player_info" style="position:fixed; left:auto; top:auto; display:none; border:1px solid #FFFFFF; overflow:auto; background-color:#334433; padding:10px;"></div>
                    <table width="500" border="0" cellpadding="0" cellspacing="0">
                    <tr>
						<td width="5%" style="padding-left: 4px; border: 1px solid #FFFFFF; border-right: 0px; background-color: #556b2f;"><a class="aplayer" style="color:#556b2f;">VIEW</a>&nbsp;-&nbsp;</td>
						<td width="20%" style="border: 1px solid #FFFFFF; border-left: 0px; background-color: #556b2f;" valign="top">{CURRENT_POS}</td>
						<td width="20%" style="padding-left: 4px; border: 1px solid #FFFFFF; border-right: 0px; border-left: 0px; background-color: #556b2f;" valign="top">{IDEAL_POS}</td>
						<td width="55%" style="border: 1px solid #FFFFFF; border-left: 0px; background-color: #556b2f;" valign="top">{PLAYER_NAME}</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					</table>
					<table width="500" border="0" cellpadding="1" cellspacing="0" id="player_table">
