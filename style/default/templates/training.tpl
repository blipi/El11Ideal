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
				  <h1 class="title"><CENTER>{OVERVIEW_TITLE}<br>
                  </CENTER></h1>
                  	<table width="521" border="0" cellspacing="0" cellpadding="0" style="margin:9px">
                     <tr><td>{PLANNED_TRAININGS} : <a id="num_trainings">{NUM_TRAININGS}</a> / 3</td></tr>
                     <tr><td><a href="javascript:void(0);" onclick="add_training();" style="color:#228b22;"><b>{ADD_MORE_TRAININGS}</b></a></td></tr>
                    </table>
                    <table id="trainings_table" cellspacing="0" width="530" style="margin:5px; padding:2px; border: 1px solid #000000;">
                    	<thead>
						<tr>
						  <th style="padding:5px;">{SHOW_TRAINING}:</th>{TH_TRAININGS}
						</tr>
						<tr>
							<th width="30%">{DELETE_TRAINING}: </th>
							<th><select id="training_num" width="50">{SELECT_OPTIONS}</select></th> 
							<th><input type="button" onclick="delete_training()" value="{BTN_DELETE}"></th>
						</tr>
						</thead>
						<tbody>
						</tbody>          
                    </table>
                    <div id="training_table" style="margin:5px; padding:2px; border: 1px solid #000000;"></div>
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
<script defer type="text/javascript" src="{STYLE_DIR}pngfix.js"></script>
<![endif]-->
