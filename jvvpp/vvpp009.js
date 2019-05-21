function $(objID){
	return document.getElementById(objID);
}

function closeMessage(){
	$("message").style.display = 'none';
	$("myAlert").style.display = 'none';
}

function resizeMessage(){
	var body = document.getElementsByTagName("body")[0];
	var message = $('message')

	if(!message){
		var message = document.createElement("div");
		message.className = 'message';
		message.id = 'message';
		document.body.appendChild(message);
	}

	message.style.display = 'block';
	
	var isIE = '\v' == 'v';
	if (isIE){
		var body = document.getElementsByTagName("body")[0];
//		message.style.height = body.offsetHeight-4+"px";
//		message.style.width = body.offsetWidth-20+"px";
		message.style.height = body.offsetHeight+200+"px";
		message.style.width = body.offsetWidth+20+"px";
	} else {
		message.style.height = window.offsetHeight+"px";
		message.style.width = window.offsetWidth+"px";
	}
}

function MyAlert( sAlert ) {
	var alt;
	if ((this.NS4) || (this.NS6)) {//[ Netscape ]//
		alt = window.pageYOffset;
	} else {
		alt = document.documentElement.scrollTop;
	}
	resizeMessage();

	myAlert = $("myAlert");
	if(!myAlert){
		var myAlert = document.createElement("div");
		myAlert.id = 'myAlert';
		document.body.appendChild(myAlert);

		var inMyAlert = document.createElement("div");
		myAlert.appendChild(inMyAlert);

		var myAlertText = document.createElement("div");
		myAlertText.id = 'myAlertText';
		inMyAlert.appendChild(myAlertText);
		
		var closeAlert = document.createElement("div");
		closeAlert.className = 'closeAlert';
		//closeAlert.onclick = function(){closeMessage();}
		inMyAlert.appendChild(closeAlert);

//var elem = document.createElement("img");
//elem.setAttribute("src", "iserv/iserv002.gif");
//elem.setAttribute("height", "16");
//elem.setAttribute("width", "16");
//elem.setAttribute("alt", "Guardando");
//closeAlert.appendChild(elem);
		
	}
  //$("myAlertText").innerHTML = sAlert;
  myAlert.style.display = "block";  

	myAlert.style.marginTop = alt+"px";
	myAlert.style.display = 'block';

}
//window.alert = MyAlert;
//window.alert = window.alert;




