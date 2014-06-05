var MAX_POINTS = {M_POINTS};

var onLoad = true;

var IE = ((document.all)?true:false);
if (!IE) document.captureEvents(Event.MOUSEMOVE);
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;

function Bars(id, min, max, current, obname) {
    this.id = id;
    this.min = min;
    this.max = max;
    this.current = current;
    this.obname = obname;
    this.obj = null;
    this.set_obj = function(){
    	this.obj = document.getElementsByName(obname)[0];
    	var new_width = this.current;
    	new_width += "px";
    	this.obj.style.width = new_width;
    }
}

function getMouseXY(e) {
  if (IE) { // grab the x-y pos.s if browser is IE
    tempX = event.clientX + document.body.scrollLeft;
    tempY = event.clientY + document.body.scrollTop;
  } else {  // grab the x-y pos.s if browser is NS
    tempX = e.pageX;
    tempY = e.pageY;
  }  
  // catch possible negative values in NS4
  if (tempX < 0){tempX = 0;}
  if (tempY < 0){tempY = 0;}  
  // show the position values in the form named Show
  // in the text fields named MouseX and MouseY
  return true;
}

function findPosX(obj){
	var curleft = 0;
	if(obj.offsetParent){
		while(1){
			curleft += obj.offsetLeft;
			if(!obj.offsetParent) 
				break;
			obj = obj.offsetParent;
		}
	}else if(obj.x)
		curleft += obj.x;
	return curleft;
}

function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}

function calculate_new_bar(id){
	var new_width;
	new_width = tempX - parseInt(findPosX(myBars[id].obj));
	if(new_width < 0) new_width = 0;
	
	var count_width = new_width - parseInt(myBars[id].obj.style.width);
	
	if(new_width < parseInt(myBars[id].obj.style.width)){
		if(new_width < myBars[id].min)
			new_width = myBars[id].min;
		MAX_POINTS += (parseInt(myBars[id].obj.style.width)-new_width);
	}else{
		if(count_width > MAX_POINTS)
			new_width = parseInt(myBars[id].obj.style.width)+MAX_POINTS;
		MAX_POINTS -= (new_width-parseInt(myBars[id].obj.style.width));	
	}

	var obj_p = document.getElementsByName('p' + id)[0];
	obj_p.value = ((new_width - myBars[id].min)/2);
	
	new_width += "px";
	myBars[id].obj.style.width = new_width;
	document.getElementById('c'+id).innerHTML = roundNumber(parseInt(new_width) / myBars[id].max * 100, 1);
	
	document.getElementById('tCount').innerHTML = roundNumber(MAX_POINTS/2,1);
}

window.onload=function(){
	if(!onLoad) return;
	var i;
	for(i=0; i<myBars.length; i++)
		myBars[i].set_obj();
}
