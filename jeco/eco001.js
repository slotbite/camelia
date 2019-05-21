// Objetivo: Contiene las funciones JavaScript llamadas desde el Sistema ECO.

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
