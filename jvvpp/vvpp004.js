/*

Funciones para el manejo de los numeros
---------------------------------------
*/

/* Inicio validaciones */ 

/*
function trim(variable) { 
largo=variable.length; 
m=0; 
while (m57)) { 
 event.returnValue=false; 
 } 
} 
*/

function solorut() { 
/*-----------------*/
 if (((event.keyCode>47)&&(event.keyCode<58))||(event.keyCode==75)||(event.keyCode==107)) { 
    event.returnValue=true; } 
 else { 
    event.returnValue=false; } 
} 

function hola(){
	alert("hola")
}



function rut(variable,digit) { 
/*-------------------------*/
 Sum = 0; 
 digito = 0; 
 factor = 2; 
 largo = variable.length; 
 while (largo !== 0) { 
   Sum = Sum + (variable.substring(largo, largo-1) * factor); 
   if (factor == 7) { 
      factor = 2; } 
   else { 
      factor = factor + 1; 
   } 
   largo = largo - 1; 
 } 
 d = 11 - Sum % 11; 
 if (d == "10") { 
    digito = "K"; } 
 else { 
    if (d == "11") { 
       digito = 0; } 
    else { 
       digito = d; 
    } 
 } 
 if (digito == digit) { 
    return true; } 
 else { 
    return false; 
 } 

} 


function formatear(forma) { 
/*-----------------------*/
 forma.rut_temp.value=forma.rut_temp.value.toUpperCase(); 
 if (forma.rut_temp.value != "") { 
    valor=forma.rut_temp.value; 
    forma.rut.value=valor; 
    if (valor.length > 1) { 
       forma.rut_temp.value=insertapuntos(valor.substring(0,valor.length)); 
    } 
 } 
} 



function formatear2(forma) { 
/*-----------------------*/
 forma.rut_temp.value=forma.rut.value; 
} 


function formatear_monto(forma) { 
/*----------------------------*/
 forma.monto_temp.value=forma.monto_temp.value.toUpperCase(); 
 if (forma.monto_temp.value != "") { 
    valor=forma.monto_temp.value; 
    forma.monto.value=valor; 
    if (valor.length > 1) { 
       forma.monto_temp.value="$ " + insertapuntos(valor.substring(0,valor.length)); 
    } 
 } 
} 


function formatear2_monto(forma) { 
/*-----------------------------*/
 forma.monto_temp.value=forma.monto.value; 
} 



function Right(strvar,intcant) { 
/*---------------------------*/
 strtemp = ""; 
 intlargo = strvar.length -1; 
 for(i = 1;i <= intcant; i++) { 
   strtemp = strtemp + strvar.charAt(intlargo); 
   intlargo--; 
 } 
 strtmp2="" 
 for(intlargo = strtemp.length -1; intlargo >=0; intlargo--) { 
   strtmp2 = strtmp2 + strtemp.charAt(intlargo); 
 } 
 return(strtmp2); 
} 


function insertapuntos(strval) { 
/*---------------------------*/
 var A = new Array(); 
 var strtemp = strval; 
 strtemp = new Number(strtemp); 
 strtemp = new String(strtemp); 
 if (strtemp.length > 3) { 
   for(var i = 0; strtemp.length > 3; i++) { 
     A[i] = Right(strtemp,3); 
     strtemp /= 1000; 
     strtemp=new String(strtemp); 
     if (strtemp.indexOf('.') != -1) { 
        strtemp = strtemp.substr(0,strtemp.indexOf('.')); 
     } 
   } 
   for(i-- ;i >= 0 ;i--) { 
     strtemp = strtemp + "." + A[i]; 
   } 
 }
 return(strtemp); 
} 


function JValidaCaracter(Tipo, Adicional, Enter) { 
/*--------------------------------------------*/
 var strNumeros ="0123456789"; 
 var Minusculas = "abcdefghijklmnñopqrstuvwxyz"; 
 var Mayusculas = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ"; 
 var strTexto   = Minusculas + Mayusculas + " "; 
 var strAlfanumerico = strTexto + strNumeros + "/-_,;:=[]<>&@.'%?¿áéíóúÁÉÍÓÚ#()¡!+*º"; 
 var strTextoNumero  = strTexto + strNumeros; 
 var strMail = Minusculas + Mayusculas + strNumeros + "@_-."; 
 var TextoTotal = new String(); 
 TextoTotal = Adicional; 
 switch(Tipo){ 
 case "Numerico":{ 
      TextoTotal += strNumeros; break; } 
 case "Texto":{ 
      TextoTotal += strTexto; break; } 
 case "Alfanumerico":{ 
      TextoTotal += strAlfanumerico; break; } 
 case "Email":{ 
      TextoTotal += strMail; break; } 
 case "TextoNumero":{ 
      TextoTotal += strTextoNumero; break; } } 
 strCaracter = new String(); 
 strCaracter = String.fromCharCode(window.event.keyCode); 
 var Pos = TextoTotal.indexOf (strCaracter); 
 if(Pos > -1){ 
   return true; }
 else{ 
   window.event.keyCode = 0; 
   return false; } 
}


function JValidaCaracter2(Tipo, Adicional, Caracter){ 
/*-------------------------------------------------*/
var strNumeros ="0123456789"; 
var Minusculas = "abcdefghijklmnñopqrstuvwxyz"; 
var Mayusculas = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ"; 
var strTexto = Minusculas + Mayusculas + " "; 
var strAlfanumerico = strTexto + strNumeros + "/-_,;:=[]<>&@.'%?¿áéíóúÁÉÍÓÚ#()¡!+*º"; 
var strMail = Minusculas + Mayusculas + strNumeros + "@_-."; 
var strTextoNumero = strTexto + strNumeros; 
var TextoTotal = new String(); 
TextoTotal = Adicional; 
switch(Tipo){ 
case "Numerico":{ 
     TextoTotal += strNumeros; break; } 
case "Texto":{ 
     TextoTotal += strTexto; break; } 
case "Alfanumerico":{ 
     TextoTotal += strAlfanumerico; break; } 
case "Email":{ 
     TextoTotal += strMail; break; } 
case "TextoNumero":{ 
     TextoTotal += strTextoNumero; break; } 
} 
strCaracter = new String(); 
strCaracter = String.fromCharCode(Caracter); 
var Pos = TextoTotal.indexOf (strCaracter); 
if(Pos > -1){ 
   return true; }
else{ 
   return false; } 
} 



function JValidaDecimal ( Tipo, Adicional, Enter, obj, cantDec ) {  
/*---------------------------------------------------------------*/
var strDecimal
var pos = 0
var largo = 0
    
    if (JValidaCaracter('Numerico','.', true) == false) {
        return
    }

    if (String.fromCharCode(window.event.keyCode) !== '.' ) {
        pos = obj.value.indexOf('.')    
        if (pos > -1) {
            strDecimal = obj.value.substr( pos+1,10)
            if( strDecimal.length > cantDec - 1 ) {
                window.event.keyCode = 0
                return
            }
        }
        return
    }

    if (obj.value.length == 0 && String.fromCharCode(window.event.keyCode) == '.' ) {    
        window.event.keyCode = 0
        return
    }

    pos = obj.value.indexOf('.')    
    if (pos > -1) {    
        window.event.keyCode = 0
        return
    }
  
}



function valiTexto(e) { 
/*--------------------*/
 key = ""; 
 key = e.which; 
 tipo = e.id; 
 if ( JValidaCaracter2('Texto','',key) || key == 8) { 
   return true; }
 else{ 
   return false; } 
} 


function valiNumero(e) { 
/*--------------------*/
key = ""; 
key = e.which; 
tipo = e.id; 
if ( JValidaCaracter2('Numerico','',key) || key == 8) { 
  return true; }
else{ 
  return false; } 
} 


function valiAlfanumerico(e) { 
/*-------------------------*/
 key = ""; 
 key = e.which; 
 tipo = e.id; 
 if ( JValidaCaracter2('Alfanumerico','',key) || key == 8) { 
   return true; }
 else{ 
   return false; } 
} 


function valiTextoNumero(e) { 
/*-------------------------*/
 key = ""; 
 key = e.which; 
 tipo = e.id; 
 if ( JValidaCaracter2('TextoNumero','',key) || key == 8) { 
   return true; }
 else{ 
   return false; } 
} 


function valiEmail(e) { 
/*--------------------*/
 key = ""; 
 key = e.which; 
 tipo = e.id; 
 if ( JValidaCaracter2('Email','',key) || key == 8) { 
   return true; }
 else{ 
   return false; } 
} 


function Captura(Tipo){ 
/*--------------------*/
 if (navigator.appName == 'Netscape') { 
   if (Tipo == "T"){ 
      window.captureEvents(Event.KEYPRESS); 
      window.onKeyPress = valiTexto; 
   } 
   if (Tipo == "N"){ 
      window.captureEvents(Event.KEYPRESS); 
      window.onKeyPress = valiNumero; 
   } 
   if (Tipo == "A"){ 
      window.captureEvents(Event.KEYPRESS); 
      window.onKeyPress = valiAlfanumerico; 
   } 
   if (Tipo == "E"){ 
      window.captureEvents(Event.KEYPRESS); 
      window.onKeyPress = valiEmail; 
   } 
   if (Tipo == "C"){ 
      window.captureEvents(Event.KEYPRESS); 
      window.onKeyPress = valiTextoNumero; 
   } 
 } 
} 


function MenosPuntos(strval) { 
/*-------------------------*/
 var strtemp=""; 
 var strcopia = strval; 
 for(var intpos = 0; intpos < strval.length; intpos++) 
   if ((strval.charAt(intpos) != ".") && (strval.charAt(intpos) != ",") && (strval.charAt(intpos) != "$")) 
      strtemp = strtemp + strval.charAt(intpos) 
      if (strtemp == "") return(strcopia); return(strtemp); 
} 



function roundOff(value, precision)
/*--------------------------------*/
{
        value = "" + value //convert value to string
        precision = parseInt(precision);

        var whole = "" + Math.round(value * Math.pow(10, precision));

        var decPoint = whole.length - precision;

        if(decPoint != 0)
        {
                result = whole.substring(0, decPoint);
                result += whole.substring(decPoint, whole.length);
        }
        else
        {
                result = 0;
                result += whole.substring(decPoint, whole.length);
        }
        return result;
}

function round(number,X) {
/*------------------------*/
        // rounds number to X decimal places, defaults to 2
        X = (!X ? 2 : X);
        return Math.round(number*Math.pow(10,X))/Math.pow(10,X);
}


