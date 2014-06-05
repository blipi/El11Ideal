var request;    // request object 
var container;

function initXMLHttpClient(){  
	var xmlhttp;  
	try { 
		xmlhttp = new XMLHttpRequest();  // Mozilla/Safari/IE7  
	}catch(e){                          // IE (?!)  
		var success=false;  
		var XMLHTTP_IDS= new Array('MSXML2.XMLHTTP.5.0','MSXML2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP','Microsoft.XMLHTTP');  
		for (var i=0; i<XMLHTTP_IDS.length && !success; i++){
			try {
				xmlhttp=new ActiveXObject(XMLHTTP_IDS[i]);
				success=true;
			}catch(e){
				success=false;
			}  
		}
		if (!success){ throw new Error('Unable to create XMLHttpRequest!'); }  
	}	  
	return xmlhttp;  
}  

function ajaxWindowLoad(){ 
	request  = initXMLHttpClient();  
}  

function send_request(url, _container){  
	container = document.getElementById(_container);
	container.style.display = 'block';
	container.innerHTML = "LOADING...";
	request.open('GET',url, true);
	request.onreadystatechange = request_handler;
	request.send(null);
}  

function request_handler(){  
	if (request.readyState == 4){
		if (request.status == 200){
			container.innerHTML = request.responseText;
		}else{
			container.innerHTML = "ERROR...";
		}  
	}  
} 

function shut(id){
	document.getElementById(id).style.display = 'none';
}

addEvent(window, 'load', ajaxWindowLoad);