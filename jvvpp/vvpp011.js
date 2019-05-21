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

var coor_x    = '';
var coor_y    = '';

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
 var SinCarEspecialesMin = "abcdefghijklmnopqrstuvwxyz"; 
 var SinCarEspecialesMay = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
 var strSinCarEsp = strNumeros + SinCarEspecialesMin + SinCarEspecialesMay;
 var strTexto   = Minusculas + Mayusculas + " "; 
 var strTextoSEsp = Minusculas + Mayusculas ; 
 var strAlfanumerico = strTexto + strNumeros + "/-_,;:=[]<>&@.'%?¿áéíóúÁÉÍÓÚ#()¡!+*º"; 
 var strTextoNumero  = strTextoSEsp + strNumeros; 
 var strMail = Minusculas + Mayusculas + strNumeros + "@_-."; 
 var strFecha = strNumeros + "/-."; 
 var TextoTotal = new String(); 
 TextoTotal = Adicional; 
 switch(Tipo){ 
 case "Numerico":{ 
      TextoTotal += strNumeros; break; } 
 case "Fecha":{ 
      TextoTotal += strFecha; break; } 
 case "Texto":{ 
      TextoTotal += strTexto; break; } 
 case "Alfanumerico":{ 
      TextoTotal += strAlfanumerico; break; } 
 case "Email":{ 
      TextoTotal += strMail; break; } 
 case "SinCarEspeciales":{ 
      TextoTotal += strSinCarEsp; break; } 
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
    
    if (JValidaCaracter('Numerico',',', true) == false) {
        return
    }

    if (String.fromCharCode(window.event.keyCode) !== ',' ) {
        pos = obj.value.indexOf(',')    
        if (pos > -1) {
            strDecimal = obj.value.substr( pos+1,10)
            if( strDecimal.length > cantDec - 1 ) {
                window.event.keyCode = 0
                return
            }
        }
        return
    }

    if (obj.value.length == 0 && String.fromCharCode(window.event.keyCode) == ',' ) {    
        window.event.keyCode = 0
        return
    }

    pos = obj.value.indexOf(',')    
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

function replace(texto,s1,s2)
/*---------------------------*/
{
	return texto.split(s1).join(s2);
}

function decimal(number,X) 
/*------------------------*/
{ 
X = (!X ? 2 : X); 
return Math.round(number*Math.pow(10,X))/Math.pow(10,X); 
} 

/*  ---------- VALIDACIONES FORMULARIO DINAMICO -------------------  */
/* Largo Maximo de caracteres */
function LargoMaximo(txt,maxLen){  
try{  
if(txt.value.length > (maxLen-1))return false;  
}catch(e){  
}  
}

/* Valido que primer caracter sea <> a numerico y <> _ */
function Valido1erCar(txt) {
try{  
if (((window.event.keyCode >= 48 && window.event.keyCode <= 57)||window.event.keyCode == 95) && txt.value == '')
{
	window.event.keyCode = 0;
}
}catch(e){  
}  
}

/* Comparo Rangos */
function Rangos(txt,rangoini,rangoterm)
{
	if (isNaN(txt.value))
	{
		alert('Ingrese Valor Entre: ' + rangoini + ' y ' + rangoterm);
		txt.value = '';
		return false;
	} else {
	  if (txt.value < rangoini || txt.value > rangoterm)
	  {
		alert('Ingrese Valor Entre: ' + rangoini + ' y ' + rangoterm);
		txt.value = '';
		return false;
	  }
	}
}

/* Valido Numerico */
function ValiNumForm(txt)
{
	if (isNaN(txt.value))
	{
		txt.value = '';
		return false;
	}
}

/* Bloqueo Control de Formulario */
function BloquearCtrl(lectura,focoval)
{
document.getElementById(lectura.id).readOnly = true;
document.getElementById(focoval.id).focus();
}

/* Muestro Contenido de Rut en Control */
function MuestroEnCtrl(ctrlRUT,almacenadorRUT,valorRUT,ctrlNOM,almacenadorNOM,valorNOM)
{
almacenadorRUT.value = valorRUT;
ctrlRUT.value = almacenadorRUT.value;
almacenadorNOM.value = valorNOM;
ctrlNOM.value = almacenadorNOM.value;
}

function ObtenerHoras(fechaini, fechafin)
/* Obtiene horas entre dos fechas */
{
//Obtiene dia, mes y año   
var fecha1 = new fecha( replace(fechaini,"-","/")) ;      
var fecha2 = new fecha( replace(fechafin,"-","/")) ;  

//Obtiene objetos Date   
var miFecha1 = new Date( fecha1.anio, fecha1.mes, fecha1.dia )   
var miFecha2 = new Date( fecha2.anio, fecha2.mes, fecha2.dia )   

var Horas = ( miFecha2.getTime() - miFecha1.getTime() ) / 1000 / 60 / 60
return Horas
}  


function fecha( cadena ) {   
/*--------------------*/
//Separador para la introduccion de las fechas   
var separador = "/"  

//Separa por dia, mes y año   
if ( cadena.indexOf( separador ) != -1 ) {   
    var posi1 = 0   
    var posi2 = cadena.indexOf( separador, posi1 + 1 )   
    var posi3 = cadena.indexOf( separador, posi2 + 1 )   
    this.dia = cadena.substring( posi1, posi2 )   
    this.mes = cadena.substring( posi2 + 1, posi3 )   
    this.anio = cadena.substring( posi3 + 1, cadena.length )
    this.mes = this.mes - 1   
} else {   
    this.dia = 0   
    this.mes = 0   
    this.anio = 0      
} 
}                              

/*------------------*/
//Formato numerico a numeros con decimales
function formato_numero(numero, decimales, separador_decimal, separador_miles){ 
    numero=parseFloat(numero);
    if(isNaN(numero)){
        return "";
    }

    if(decimales!==undefined){
        // Redondeamos
        numero=numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

    if(separador_miles){
        // Añadimos los separadores de miles
        var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
        while(miles.test(numero)) {
            numero=numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}

// Saca Posicin X de un Ctrl
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
// Saca Posicin Y de un Ctrl
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

// Marca o quita las marcas de los checkbox (1 activa, 0 desactiva)
function chequeoElementos(form,activa)
{
for(i=0;i<form.elements.length;i++)
if(form.elements[i].type=="checkbox")
form.elements[i].checked=activa;
}



