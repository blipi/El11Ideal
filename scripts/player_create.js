var myBars = [
	new Bars(0, {MIN0}, {MAX0}, {CURRENT0}, 'subbar0'),
	new Bars(1, {MIN1}, {MAX1}, {CURRENT1}, 'subbar1'),
	new Bars(2, {MIN2}, {MAX2}, {CURRENT2}, 'subbar2'),
	new Bars(3, {MIN3}, {MAX3}, {CURRENT3}, 'subbar3'),
	new Bars(4, {MIN4}, {MAX4}, {CURRENT4}, 'subbar4'),
	new Bars(5, {MIN5}, {MAX5}, {CURRENT5}, 'subbar5'),
	new Bars(6, {MIN6}, {MAX6}, {CURRENT6}, 'subbar6'),
	new Bars(7, {MIN7}, {MAX7}, {CURRENT7}, 'subbar7')
];

function validate(frm){
	if (frm.player_name.value.length <= 3){ alert("{PLAYER_NAME_SHORT}"); return false; };
	if (frm.player_surname.value.length <= 3){ alert("{PLAYER_SURNAME_SHORT}"); return false; };
	return true;
}

function auto_gen_name(){
	document.getElementsByName('player_name')[0].value = "Espera...";
	document.getElementsByName('player_surname')[0].value = "";
	request.open('GET',"{ROOT}modules/randname/randname_{LANG}.php", true);
	request.onreadystatechange = function(){
		if (request.readyState == 4){
			if (request.status == 200){
				var resp = request.responseText;
				var surname_pos = resp.indexOf('&SURNAME=');
				var publi_pos = resp.indexOf('<!');
				var name = resp.substring(5, surname_pos);
				var surname;
				
				if(publi_pos == -1) 
					surname = resp.substring(surname_pos+9);
				else
					surname = resp.substring(surname_pos+9, publi_pos-1);
					
				document.getElementsByName('player_name')[0].value = name;
				document.getElementsByName('player_surname')[0].value = surname;
			}else{
				alert("ERROR...");
			}  
		}  
	};
	request.send(null);
}