<tr onclick="set_var({I});">
	<td width="5%" style="padding-left: 4px; border: 1px solid #FFFFFF; border-right: 0px; background-color: #006400;" valign="top"><a href="javascript:void(0);" onclick="send_request('{ROOT}modules/pages/AjaxPlayerInfo.php?pid={ID_PLAYER}&id={ID}', 'player_info')" class="aplayer">VIEW</a><input type="hidden" id="player_id_{I}" value="{ID}">&nbsp;-
	</td>
	<td width="20%" style="border: 1px solid #FFFFFF; border-left: 0px; background-color: #006400;" valign="top">{C_POS}</td>
	<td width="20%" style="padding-left: 4px; border: 1px solid #FFFFFF; border-right: 0px; border-left: 0px; background-color: #006400;" valign="top">{POS}</td>
	<td width="55%" style="border: 1px solid #FFFFFF; border-left: 0px; background-color: #006400;" valign="top">{NAME}</td>
	{SPACER}
</tr>