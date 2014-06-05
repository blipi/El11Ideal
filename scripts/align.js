var player1 = -1;
var player2 = -1;
var current = 0;

function set_background(id, enable){
    var x=document.getElementById('player_table').rows;
    var y=x[id].cells;		
	if(enable){
		y[0].style.backgroundColor = '#008b00';
		y[1].style.backgroundColor = '#008b00';
		y[2].style.backgroundColor = '#008b00';
		y[3].style.backgroundColor = '#008b00';
	}else{
		y[0].style.backgroundColor = '#006400';
		y[1].style.backgroundColor = '#006400';
		y[2].style.backgroundColor = '#006400';
		y[3].style.backgroundColor = '#006400';
	}
}
function set_var(id){	
	if(id >= 11) id += 1;
	if(player1 == id){
		set_background(player1, false);
		player1 = -1;
	}else if(player2 == id){
		set_background(player2, false);
		player2 = -1;
	}else if(player1 == -1){
		player1 = id;
		set_background(id, true);
	}else if(player2 == -1){
		player2 = id;
		set_background(id, true);
	}else{
		if(current == 0){
			set_background(player1, false);
			player1 = id;
			current = 1;
			set_background(player1, true);
		}else{
			set_background(player2, false);
			player2 = id;
			current = 0;
			set_background(player2, true);
		}
	}
}
function clear(del){
	if(player1 != -1) set_background(player1, false);
	if(player2 != -1) set_background(player2, false);
	if(del) player1 = -1;
	if(del) player2 = -1;
}
function save(){
	var rows=document.getElementById('player_table').rows;
	var rows_num = rows.length - 1;
	var i=0;
	var sendString="";
	var realI=0;
	for(i=0;i<=rows_num;i++){
		if(i==11)i++;
		sendString = sendString + "&player" + realI + "=" + document.getElementById('player_id_'+realI).value;
		realI++;
	}
	location.href='{ROOT}game.php?page=align&change=1'+sendString;
}
function change(id, dir){
	switch(dir){
		/*case 0:
			if(id == 0){ alert('{ERROR_FIRST}'); break; }
			var x=document.getElementById('player_table').rows;
			var y=x[id].cells;	
		    var z=document.getElementById('player_table').rows;
		    var o=z[id-1].cells;
			var temp0 = y[0].innerHTML;	
			var temp1 = y[1].innerHTML;	
			var temp2 = y[2].innerHTML;	
			var temp3 = y[3].innerHTML;	
			var temp4 = y[4].innerHTML;	
			y[0].innerHTML = o[0].innerHTML;
			y[1].innerHTML = o[1].innerHTML;
			y[2].innerHTML = o[2].innerHTML;
			y[3].innerHTML = o[3].innerHTML;
			y[4].innerHTML = o[4].innerHTML;
			o[0].innerHTML = temp0;
			o[1].innerHTML = temp1;
			o[2].innerHTML = temp2;
			o[3].innerHTML = temp3;
			o[4].innerHTML = temp4;
			
			var obj = document.getElementById('ip_'+id);
			obj.onclick = function() { change((id-1),0); }
						
			var obj2 = document.getElementById('ip_'+(id-1));
			obj2.onclick = function() { change(id,0); }
			obj2.setAttribute("id",'ip_'+(id));
			
			obj.setAttribute("id",'ip_'+(id-1));
			
			obj = document.getElementById('ib_'+id);
			obj.onclick = function() { change((id-1),1); }
						
			obj2 = document.getElementById('ib_'+(id-1));
			obj2.onclick = function() { change(id,1); }
			obj2.setAttribute("id",'ib_'+(id));
			
			obj.setAttribute("id",'ib_'+(id-1));
			
			//y.onclick = function() { set_var(id); }
			//o.onclick = function() { set_var((id-1)); }
			setTimeout("clear(true)", 10);
		break;
		case 1:
		    var z=document.getElementById('player_table').rows;
			if(id == z.length-1){ alert('{ERROR_LAST}'); break; }
		    var o=z[id+1].cells;	
			var x=document.getElementById('player_table').rows;
			var y=x[id].cells;	
			var temp0 = y[0].innerHTML;	
			var temp1 = y[1].innerHTML;	
			var temp2 = y[2].innerHTML;	
			var temp3 = y[3].innerHTML;	
			var temp4 = y[4].innerHTML;	
			y[0].innerHTML = o[0].innerHTML;
			y[1].innerHTML = o[1].innerHTML;
			y[2].innerHTML = o[2].innerHTML;
			y[3].innerHTML = o[3].innerHTML;
			y[4].innerHTML = o[4].innerHTML;
			o[0].innerHTML = temp0;
			o[1].innerHTML = temp1;
			o[2].innerHTML = temp2;
			o[3].innerHTML = temp3;
			o[4].innerHTML = temp4;
			
			var obj = document.getElementById('ip_'+id);
			obj.onclick = function() { change((id+1),0); }
						
			var obj2 = document.getElementById('ip_'+(id+1));
			obj2.onclick = function() { change(id,0); }
			obj2.setAttribute("id",'ip_'+(id));
			
			obj.setAttribute("id",'ip_'+(id+1));
			
			obj = document.getElementById('ib_'+id);
			obj.onclick = function() { change((id+1),1); }
						
			obj2 = document.getElementById('ib_'+(id+1));
			obj2.onclick = function() { change(id,1); }
			obj2.setAttribute("id",'ib_'+(id));
			
			obj.setAttribute("id",'ib_'+(id+1));
			
			//o.onclick = function() { set_var((id+1)); }
			//y.onclick = function() { set_var(id); }
			setTimeout("clear(true)", 10);
		break;	*/	
		case 2:
			if(player1 == -1){ alert('{ERROR_PLAYER1}'); break; }
			if(player2 == -1){ alert('{ERROR_PLAYER2}'); break; }
			
			var t1 = player1;
			var t2 = player2;
			if(t1 > 11) t1 -= 1;			
			if(t2 > 11) t2 -= 1;
			
			var obj1 = document.getElementById('player_id_' + t1);
			var obj2 = document.getElementById('player_id_' + t2);

			obj1.setAttribute("id",'player_id_'+t2); 
			obj2.setAttribute("id",'player_id_'+t1); 
			
			var x=document.getElementById('player_table').rows;
			var y=x[player1].cells;
		    var z=document.getElementById('player_table').rows;
		    var o=z[player2].cells;
			var temp0 = y[0].innerHTML;	
			//var temp1 = y[1].innerHTML;	
			var temp2 = y[2].innerHTML;	
			var temp3 = y[3].innerHTML;	
			//var temp4 = y[4].innerHTML;	
			y[0].innerHTML = o[0].innerHTML;
			//y[1].innerHTML = o[1].innerHTML;
			y[2].innerHTML = o[2].innerHTML;
			y[3].innerHTML = o[3].innerHTML;
			//y[4].innerHTML = o[4].innerHTML;
			o[0].innerHTML = temp0;
			//o[1].innerHTML = temp1;
			o[2].innerHTML = temp2;
			o[3].innerHTML = temp3;
			//o[4].innerHTML = temp4;
			/*
			var p1 = player1;
			var p2 = player2;
			
			var obj = document.getElementById('ip_'+p1);
			obj.onclick = function() { change(p2,0); }
						
			var obj2 = document.getElementById('ip_'+p2);
			obj2.onclick = function() {change(p1,0); }
			obj2.setAttribute("id",'ip_'+p1);
			
			obj.setAttribute("id",'ip_'+p2);
			
			obj = document.getElementById('ib_'+p1);
			obj.onclick = function() { change(p2,1); }
						
			obj2 = document.getElementById('ib_'+p2);
			obj2.onclick = function() { change(p1,1); }
			obj2.setAttribute("id",'ib_'+p1);
			
			obj.setAttribute("id",'ib_'+p2);*/
			setTimeout("clear(true)", 10);
		break;
	}
}
function findPosX(obj)
{
var curleft = 0;
if(obj.offsetParent)
	while(1) 
	{
	  curleft += obj.offsetLeft;
	  if(!obj.offsetParent)
		break;
	  obj = obj.offsetParent;
	}
else if(obj.x)
	curleft += obj.x;
return curleft;
}

function findPosY(obj)
{
var curtop = 0;
if(obj.offsetParent)
	while(1)
	{
	  curtop += obj.offsetTop;
	  if(!obj.offsetParent)
		break;
	  obj = obj.offsetParent;
	}
else if(obj.y)
	curtop += obj.y;
return curtop;
}

function getWindowHeight(){
	if(window.innerHeight) return window.innerHeight;
	else if(document.body.clientHeight) return document.body.clientHeight;
	else if(document.documentElement.clientHeight) return document.documentElement.clientHeight;
	else return 0;
}

function getWindowWidth(){
	if(window.innerWidth) return window.innerWidth;
	else if(document.body.clientWidth) return document.body.clientWidth;
	else if(document.documentElement.clientWidth) return document.documentElement.clientWidth;
	else return 0;
}

function getScrollXY() {
  var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
    scrOfX = window.pageXOffset;
  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
    scrOfX = document.body.scrollLeft;
  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
    scrOfX = document.documentElement.scrollLeft;
  }
  return [ scrOfX, scrOfY ];
}

var timerFunc;


function resize(){
	var obj = document.getElementById('player_table');
	var obj2 = document.getElementById('tools_box');	
	var obj3 = document.getElementById('player_info');
	var xa2 = (findPosX(obj)-10) + "px";
	var xa = (findPosX(obj) + 505) + "px";
	
	var ya2 = (getWindowHeight()-(getWindowHeight()*(5/6))) + "px";//findPosY(obj);	
	var ya = (getWindowHeight()/2) + "px";//findPosY(obj);
	
	var x2,x,y2,y;
	
	if(parseInt(xa2)+500 > getWindowWidth()){
		if(getWindowWidth()<500){
			x2 = 0 + "px";
			obj3.style.overflow = 'scroll';
			obj3.style.width = (getWindowWidth()-50)+"px";
		}else{
			x2 = (((getWindowWidth()-500)/2)/2)+ "px";
			obj3.style.overflow = 'auto';
			obj3.style.width = 'auto';
		}
	}else{
		x2 = xa2;
		obj3.style.overflow = 'auto';
		obj3.style.width = 'auto';
	}
	
	if(parseInt(ya2)+400 > getWindowHeight()){
		if(getWindowHeight()<400){
			y2 = 0 + "px";
			obj3.style.overflow = 'scroll';
			obj3.style.height = (getWindowHeight()-50)+"px";
		}else{
			y2 = (((getWindowHeight()-400)/2)/2)+ "px";
			obj3.style.overflow = 'auto';
			obj3.style.height = 'auto';
		}
	}else{
		y2 = ya2;
		obj3.style.overflow = 'auto';
		obj3.style.height =  'auto';
	}
	
	if(parseInt(xa)+100 > getWindowWidth()) x = 0 + "px"; else x = xa;
	if(parseInt(ya)+100 > getWindowHeight()) y = 0 + "px"; else y = ya;
	
	obj2.style.top = y;
	obj2.style.left = x;
	obj3.style.left = x2;
	obj3.style.top = y2;
}


function alignWindowResize(){
    resize();
}

function alignWindowLoad(){
	resize();
}


addEvent(window, 'load', alignWindowLoad);
addEvent(window, 'resize', alignWindowResize);