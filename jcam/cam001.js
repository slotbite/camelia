// Objetivo: Contiene las funciones JavaScript llamadas desde el Sistema CAMELIA.

function validaRut(variable,digit){
/*----------------------------------*/

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

/**
*
*  Javascript trim, ltrim, rtrim
*  http://www.webtoolkit.info/
*
**/
 
//unión de ambas funciones ltrim y rtrim
function trim(str, chars) {
    return ltrim(rtrim(str, chars), chars);
}
 
//ltrim quita los espacios o caracteres indicados al inicio de la cadena
function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
//rtrim quita los espacios o caracteres indicados al final de la cadena 
function rtrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}