/*

funciones para el manejo del calendario
---------------------------------------

*/

var now      = new Date();
var mes_w    = now.getMonth() + 1;
var ano_w    = now.getYear();
var dia_w    = now.getDay();
var campo_w  = ""

function next(ndia, ini , ter , tipo) {
  var val1= 'Form1.'+ini.id;
  var val2= 'Form1.'+ter.id;
  mes_w++
  if ( mes_w > 12 ) {
     mes_w = 1
     ano_w += 1
  }
  despcal( mes_w, ano_w, val1 , val2 , tipo )
}


function previous(ndia, ini , ter , tipo) {
  var val1= 'Form1.'+ini.id;
  var val2= 'Form1.'+ter.id;
  mes_w = mes_w - 1
  if ( mes_w < 1 ) {
     mes_w = 12
     ano_w = ano_w -1
  }
  despcal( mes_w, ano_w, val1 , val2 , tipo )
}


function dia( ndia , ini , ter , tipo) {
/*-----------------*/
//Agregado por Sebastian
 var str_inicio = eval(ini).value ;
 var str_termino = eval(ter).value ;
 var day_inicio = new Date();
 var day_termino = new Date();
 var ini_solicitud = new Date();
 var ter_solicitud = new Date();
 var seleccion_w = new Date();
 var sol_campo_ini = Form1.cmd_fec_inicio.value;
 var sol_campo_fin = Form1.cmd_fec_termino.value;
 
 ini_solicitud.setFullYear(sol_campo_ini.substring(6,10),parseInt(sol_campo_ini.substring(3,5)-1),sol_campo_ini.substring(0,2));
 ter_solicitud.setFullYear(sol_campo_fin.substring(6,10),parseInt(sol_campo_fin.substring(3,5)-1),sol_campo_fin.substring(0,2));
  
//***********************
 var nmes_w
 var fec_js
 nmes_w = mes_w
 if ( mes_w < 10 ) {
    nmes_w = '0' + mes_w
 } 

 if ( ndia < 10 ) {
    ndia = '0' + ndia
 }

 fec_js = ano_w + '' + nmes_w + '' + ndia
 
 //ter_solicitud.setFullYear(str_termino.substring(6,10),parseInt(str_termino.substring(3,5)-1),str_termino.substring(0,2));
 
 if (tipo==0) 
 {
    day_inicio.setFullYear(ano_w,parseInt(nmes_w-1),ndia);
    day_termino.setFullYear(str_termino.substring(6,10),parseInt(str_termino.substring(3,5)-1),str_termino.substring(0,2));
 } else {
    day_inicio.setFullYear(str_inicio.substring(6,10),parseInt(str_inicio.substring(3,5)-1),str_inicio.substring(0,2));
    day_termino.setFullYear(ano_w,parseInt(nmes_w-1),ndia);
 }
 
 //alert('Fec Ini: '+day_inicio +' Fec Ter: '+ day_termino+' Tipo: '+tipo);

 if( opener_w ) {
   opener.document.form_open_fecha.dato.value = ndia + '/' + nmes_w + '/' + ano_w
   opener.document.form_open_fecha.indice.onclick()
   window.close()
 } else {
   if (day_inicio > day_termino && ini.id != ter.id)
   { 
      alert('Fecha de Inicio No Puede Ser Mayor a la Termino'); 
   } else {
      seleccion_w.setFullYear(ano_w,parseInt(nmes_w-1),ndia);
      if ((seleccion_w < ini_solicitud || seleccion_w > ter_solicitud)&&(ini.id!='cmd_fec_inicio' && ter.id!='cmd_fec_termino'))
      {
          alert('La Fecha Seleccionada: '+ ndia + '/' + nmes_w + '/' + ano_w + ' esta fuera del rango de solicitud');
      } else {
          eval(campo_w).value = ndia + '/' + nmes_w + '/' + ano_w; 
          if (ini.id=='cmd_fecha')
          {
              __doPostBack('foto_calendario','');
          }
      }
   }
 }
}

function cal_dias( fec_1_js, fec_2_js ) {
/*------------------------------------*/
var suma_js = 0
var dia_js
var i = 1
var k = 100000
var nmes_w
var ano_w
dia_js = fec_1_js.substr(0,2) 
nmes_w = fec_1_js.substr(3,2) 
ano_w  = fec_1_js.substr(6,4) 

nmes_w = eval( nmes_w )
dia_js = eval( dia_js )

 for( i=1; i < k; i++ ) {

   fecha_js = dia_js + '/' + nmes_w + '/' + ano_w
   dia_x = dia_js
   mes_x = nmes_w
   if( dia_js < 10 ) {
     dia_x = '0' + dia_js
   }
   if( nmes_w < 10 ) {
     mes_x = '0' + nmes_w
   }
   
   fec_1_js = dia_x + '/' + mes_x + '/' + ano_w
   if( fec_1_js == fec_2_js ) {
      i = k + 1
   } else {
      if( dia_js < (getDaysInMonth(nmes_w,ano_w) ) ) {
          dia_js++
      } else {
         dia_js = 1
         nmes_w++
         if( nmes_w > 12 ) {
           ano_w++
           nmes_w = 1
         }
      }
      suma_js++   
   }
 }

return suma_js
}


function despcal( month, year, inicio, termino, tipo ) {
/*----------------------------*/
if (tipo=='inicio' || tipo=='0') {
    var tipo = 0; 
} else {
    var tipo = 1; 
}
var firstOfMonth = new Date (year, month - 1 , 1);
var startingPos  = firstOfMonth.getDay();
var nomdia_w     = 0
var ultdia_w     = getDaysInMonth(month,year)
var cal_w ;
var nom_mes
mes_x = ''
cal_w = ''

if ( month < 10 ) {
mes_x = '<img src="../fotos/m0' + month + year + '.jpg" width="119" height="38" usemap="#Map" border="0">'
} else {
mes_x = '<img src="../fotos/m' + month + year + '.jpg" width="119" height="38" usemap="#Map" border="0">'
}

if( month == 1 ) { 
  nom_mes = 'Ene '
}
if( month == 2 ) { 
  nom_mes = 'Feb '
}
if( month == 3 ) { 
  nom_mes = 'Mar '
}
if( month == 4 ) { 
  nom_mes = 'Abr '
}
if( month == 5 ) { 
  nom_mes = 'May '
}
if( month == 6 ) { 
  nom_mes = 'Jun '
}
if( month == 7 ) { 
  nom_mes = 'Jul '
}
if( month == 8 ) { 
  nom_mes = 'Ago '
}
if( month == 9 ) { 
  nom_mes = 'Sep '
}
if( month == 10 ) { 
  nom_mes = 'Oct '
}
if( month == 11 ) { 
  nom_mes = 'Nov '
}
if( month == 12 ) { 
  nom_mes = 'Dic '
}



mes_x  = ''

mes_x += '  <table border="0" cellpadding="0" cellspacing="0" width="120"  align="top">'
mes_x += '    <tr valign="top" bgcolor="#CCCCCC">'
mes_x += '      <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><a href="javascript:javascript:previous(' + nomdia_w + ',' + inicio + ',' + termino + ',' + tipo +')"><b><<</b></a></font></td>'
mes_x += '      <td width="60%"><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><b><div align="center">' + nom_mes + '  ' + year + '</div></b></font></td>'
mes_x += '      <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><a href="javascript:javascript:next(' + nomdia_w + ',' + inicio + ',' + termino + ',' + tipo +')"><b>>></b></a></font></td>'
mes_x += '    </tr>'
mes_x += '  </table>'

mes_x += '  <table border="0" cellpadding="0" cellspacing="0" width="120"  align="top">'
mes_x += '    <tr valign="top" bgcolor="#CCCCCC">'
mes_x += '      <td rowspan="2" width="17"><font color="#000099" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 9px"><div align="center">L</div></font></b></td>'
mes_x += '      <td rowspan="2" width="17"><font color="#000099" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 9px"><div align="center">M</div></font></b></td>'
mes_x += '      <td rowspan="2" width="17"><font color="#000099" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 9px"><div align="center">M</div></font></b></td>'
mes_x += '      <td rowspan="2" width="17"><font color="#000099" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 9px"><div align="center">J</div></font></b></td>'
mes_x += '      <td rowspan="2" width="17"><font color="#000099" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 9px"><div align="center">V</div></font></b></td>'
mes_x += '      <td rowspan="2" width="17"><font color="#000099" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 9px"><div align="center">S</div></font></b></td>'
mes_x += '      <td rowspan="2" width="17"><font color="#FF0033" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 9px"><div align="center">D</div></font></b></td>'
mes_x += '    </tr>'

mes_x += '  </table>'


Cal_Layer0.innerHTML = mes_x 

cal_w += '  <table border="0" cellpadding="0" cellspacing="0" width="120"  align="top">'
cal_w += '    <tr valign="top"> '


if ( startingPos < 1 ) {
   startingPos = 7
}

for ( i = 1; i < startingPos; i++)  {
cal_w += '      <td rowspan="2" width="17"></td>'
}


nomdia_w = 0
for ( i = startingPos; i <= 7; i++)  {
nomdia_w += 1
cal_w += '      <td rowspan="2" width="17" align="right"><a href="javascript:dia( ' + nomdia_w + ',' + inicio + ',' + termino + ',' + tipo + ' )" class="texto01">' + nomdia_w + '</a></td>'
}
cal_w += '    </tr>'

cal_w += '  <tr valign="top"> '
cal_w += '    <td width="10"><img src="../fotos/shim.gif" width="1" height="15" border="0"></td>'
cal_w += '  </tr>'


for ( i = nomdia_w; nomdia_w <= ultdia_w; i++)  {
  cal_w += '    <tr> '
  for ( i = 1; i <= 7; i++)  {
    nomdia_w += 1
    if ( nomdia_w <= ultdia_w ) {
       cal_w += '      <td rowspan="2" width="17" align="right"><a href="javascript:dia( ' + nomdia_w + ',' + inicio + ',' + termino + ',' + tipo + ' )" class="texto01" aling="center">' + nomdia_w + '</a></td>'
    } else {
       cal_w += '      <td rowspan="2" width="17"></td>'
    }
  }
cal_w += '    </tr>'

cal_w += '  <tr valign="top"> '
cal_w += '    <td width="10"><img src="isase/shim.gif" width="1" height="15" border="0"></td>'
cal_w += '  </tr>'

}


cal_w += '  </table>'
Cal_Layer1.innerHTML = cal_w

}


function getDaysInMonth(month,year)  {
var days;
if (month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12)  {
   days=31;
} else {
   if (month==4 || month==6 || month==9 || month==11) {
      days=30;
   } else {
      if (month==2)  {
         if (isLeapYear(year)) {
            days=29;
         } else {
           days=28;
         }
      }
   }
}
return (days);
}

function isLeapYear (Year) {
if (((Year % 4)==0) && ((Year % 100)!=0) || ((Year % 400)==0)) {
   return (true);
} else {
  return (false);
}
}


