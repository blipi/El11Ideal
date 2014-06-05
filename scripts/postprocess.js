function AjaxObj(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!="undefined") {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
function postProcess(url){
	var obj = document.getElementById("ajax_content");
	var loading = document.getElementById("ajax_loading");
	var msg = document.getElementById("msg_div");
	if(msg) msg.style.display = "none";
	loading.style.display = "block";
	ajax=AjaxObj();
	ajax.open("POST", url,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			obj.innerHTML = ajax.responseText;
			loading.style.display = "none";
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	var sendVar="";
	for( var i = 1; i < arguments.length; i++ ){
		sendVar = sendVar + i + "=" + arguments[i] + "&";
	}
	ajax.send(sendVar);
}