var NUM_TRAININGS = {NUM_TRAININGS};

onLoad = false;

function add_training()
{
	NUM_TRAININGS++;
	if(NUM_TRAININGS >= 4) {
		alert("{ERR_AJAX_3}");
		return;
	}

	
	request.open('GET', '{ROOT}modules/pages/AjaxTraining.php?switch=1', true);
	request.onreadystatechange = function(){
		if (request.readyState == 4){
			if (request.status == 200){
				var resp = request.responseText;
				var publi_pos = resp.indexOf('<!');
				var result;
				
				if(publi_pos == -1) 
					result = resp;
				else
					result = resp.substring(0, publi_pos-1);
				
				if(result == "1"){				
					document.getElementById('num_trainings').innerHTML = NUM_TRAININGS;
					
					var id = 'trainings_table';
					var tblHeadObj = document.getElementById(id).tHead;
					for (var h=0; h<=0/*<tblHeadObj.rows.length*/; h++) {
						var newTH = document.createElement('th');
						tblHeadObj.rows[h].appendChild(newTH);
						newTH.style.padding = "5px";
						var str = "";
						if(NUM_TRAININGS >= 2) str = '&nbsp;&nbsp;·&nbsp;&nbsp;';
						str += '<a href="javascript:void(0);" onclick="show_training(' + (NUM_TRAININGS-1) + ');" style="color:#228b22;"><b>{TRAINING_NAME} #' + NUM_TRAININGS+ '</b></a>';
						newTH.innerHTML = str;
					}
					var elOptNew = document.createElement('option');
					elOptNew.text = NUM_TRAININGS;
					elOptNew.value = (NUM_TRAININGS-1);
					var elSel = document.getElementById('training_num');
					try {
						elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
					}
					catch(ex) {
						elSel.add(elOptNew); // IE only
					}

					  
					/*
					var tblBodyObj = document.getElementById(id).tBodies[0];
					for (var i=0; i<tblBodyObj.rows.length; i++) {
						var newCell = tblBodyObj.rows[i].insertCell(-1);
						newCell.style.border = tblBodyObj.rows[i].style.border;
						newCell.innerHTML = '[td] row:' + i + ', cell: ' + (tblBodyObj.rows[i].cells.length - 1)
					}
					*/
				}else{
					switch(result){
						case "0": alert("{ERR_AJAX_0}"); break;
						case "2": alert("{ERR_AJAX_2}"); break;
						case "3": alert("{ERR_AJAX_3}"); break;
					}
				}			
			}else{
				alert("ERROR...");
			}  
		}  
		
	};
	request.send(null);
}

function delete_training(){
	var delete_id = document.getElementById('training_num').value;
	request.open('GET', '{ROOT}modules/pages/AjaxTraining.php?switch=2&id=' + delete_id, true);
	request.onreadystatechange = function(){
		if (request.readyState == 4){
			if (request.status == 200){
				var resp = request.responseText;
				var publi_pos = resp.indexOf('<!');
				var result;
				
				if(publi_pos == -1) 
					result = resp;
				else
					result = resp.substring(0, publi_pos-1);
				
				if(result == "1"){				
					window.location.reload();
				}else{
					switch(result){
						case "0": alert("{ERR_AJAX_0}"); break;
						case "2": alert("{ERR_AJAX_2}"); break;
						case "3": alert("{ERR_AJAX_3}"); break;
					}
				}			
			}else{
				alert("ERROR...");
			}  
		}  
		
	};
	request.send(null);
}

function show_training(training_id){
	request.open('GET', '{ROOT}modules/pages/AjaxTraining.php?switch=3&id=' + training_id, true);
	request.onreadystatechange = function(){
		if (request.readyState == 4){
			if (request.status == 200){	
				var container = document.getElementById('training_table');
				container.innerHTML = request.responseText;		
			}else{
				alert("ERROR...");
			}  
		}  		
	};
	request.send(null);
}

var myBars = [
	new Bars(0, {MIN0}, {MAX0}, {CURRENT0}, 'subbar0')
];