/*

funciones para el manejo del calendario
---------------------------------------

*/

var now      = new Date();
var mes_w    = now.getMonth() + 1;
var ano_w    = now.getYear();
var dia_w    = now.getDay();
var campo_w  = ''


function next(i2,tip2) {
  mes_w++
  if ( mes_w > 12 ) {
     mes_w = 1
     ano_w += 1
  }
  despcal( mes_w, ano_w, i2,tip2 )
}


function previous(i3,tip3) {
  mes_w = mes_w - 1
  if ( mes_w < 1 ) {
     mes_w = 12
     ano_w = ano_w -1
  }
  despcal( mes_w, ano_w, i3,tip3 )
}

function fecha( cadena ) {  
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
                } else {  
                     this.dia = 0  
                     this.mes = 0  
                     this.anio = 0     
                }  
             }  

function dia( ndia,i,tipos ) {
/*-----------------*/
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
 

 if( opener_w ) {
     eval(campo_w).value = ndia + '/' + nmes_w + '/' + ano_w
     opener.document.form_open_fecha.indice.onclick()
   window.close()
 } else {
	   // Bloque agregado por sebastian
	   if (parseInt(i) < 10)
              {
              var inicio    = document.getElementById("dgrid_ctl0"+i+"_txtini");
              var termino   = document.getElementById("dgrid_ctl0"+i+"_txtfin");
	      var hidenini  = document.getElementById("dgrid_ctl0"+i+"_hf_ini");
	      var hidenter  = document.getElementById("dgrid_ctl0"+i+"_hf_term");
	      var dllegada  = document.getElementById("dgrid_ctl0"+i+"_llegada");
	      var dsalida   = document.getElementById("dgrid_ctl0"+i+"_salida");
              } else {
              var inicio    = document.getElementById("dgrid_ctl"+i+"_txtini");
              var termino   = document.getElementById("dgrid_ctl"+i+"_txtfin");
	      var hidenini  = document.getElementById("dgrid_ctl"+i+"_hf_ini");
	      var hidenter  = document.getElementById("dgrid_ctl"+i+"_hf_term");
	      var dllegada  = document.getElementById("dgrid_ctl"+i+"_llegada");
	      var dsalida   = document.getElementById("dgrid_ctl"+i+"_salida");
              }
              
	    if (tipos == '1')
	      {
		var fecha1 = new fecha( ndia + '/' + nmes_w + '/' + ano_w )  ; 
                var fecha2 = new fecha( termino.value )  ;
              } else {
                var fecha1 = new fecha( inicio.value )    ; 
                var fecha2 = new fecha( ndia + '/' + nmes_w + '/' + ano_w )  ;
              }

                //Obtiene objetos Date  
                var miFecha1 = new Date( fecha1.anio, fecha1.mes, fecha1.dia )  ;
                var miFecha2 = new Date( fecha2.anio, fecha2.mes, fecha2.dia )  ;
		var FecIniVal = new Date( dllegada.innerHTML.substr(6,4),  dllegada.innerHTML.substr(3,2), dllegada.innerHTML.substr(0,2));
		var FecTerVal = new Date( dsalida.innerHTML.substr(6,4),  dsalida.innerHTML.substr(3,2), dsalida.innerHTML.substr(0,2));
               
                //Resta fechas y redondea  
                var diferencia = miFecha1.getTime() - miFecha2.getTime()  ;
                var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24))  ;
                var segundos = Math.floor(diferencia / 1000)  ;
                var valoraux   = document.getElementById("hf_fecha");
		var valoriva   = document.getElementById("hf_iva");
                
                if (dias>0)
                {
                    alert ('Fecha Inicio F/. No Puede Ser Mayor a Fecha Termino F/.');
                
		} else if (miFecha1 < FecIniVal) {
		    alert ('Fecha Inicio F/. No Puede Ser Menor a Fecha de Llegada');

		} else if (miFecha2 > FecTerVal) {
		    alert ('Fecha Termino F/. No Puede Ser Mayor a Fecha de Salida');

		} else {
		    eval(campo_w).value = ndia + '/' + nmes_w + '/' + ano_w;
		    if (tipos == '1')
		    { hidenini.value = ndia + '/' + nmes_w + '/' + ano_w;
		    } else 
		    { hidenter.value = ndia + '/' + nmes_w + '/' + ano_w;
		    }
		    if (i<10) 
		    {
			// Cantidad Alimentacion
		    var desayuno = document.getElementById("dgrid_ctl0"+i+"_cantdes");
                    var almuerzo = document.getElementById("dgrid_ctl0"+i+"_cantalm");
                    var cena     = document.getElementById("dgrid_ctl0"+i+"_cantcena");
		    var subtotal = document.getElementById("dgrid_ctl0"+i+"_TotEst");
		        // Valores Alimentacion 
	            var vdesayuno = document.getElementById("dgrid_ctl0"+i+"_desay");
                    var valmuerzo = document.getElementById("dgrid_ctl0"+i+"_alm");
                    var vcena     = document.getElementById("dgrid_ctl0"+i+"_cena");
		    } else {
			// Cantidad Alimentacion
		    var desayuno = document.getElementById("dgrid_ctl"+i+"_cantdes");
                    var almuerzo = document.getElementById("dgrid_ctl"+i+"_cantalm");
                    var cena     = document.getElementById("dgrid_ctl"+i+"_cantcena");
		    var subtotal = document.getElementById("dgrid_ctl"+i+"_TotEst");
		       // Valores Alimentacion 
	            var vdesayuno = document.getElementById("dgrid_ctl"+i+"_desay");
                    var valmuerzo = document.getElementById("dgrid_ctl"+i+"_alm");
                    var vcena     = document.getElementById("dgrid_ctl"+i+"_cena");
		    }
		    if ((dias * -1)=='0')
		    {
		          subtotal.innerHTML = parseInt(vdesayuno.innerHTML) + parseInt(valmuerzo.innerHTML) + parseInt(vcena.innerHTML);
                          desayuno.innerHTML = 1;
		          almuerzo.innerHTML = 1;
		          cena.innerHTML = 1;
			if (i<10) 
			{
				Mostrar('0'+i,'','');
			} else {
				Mostrar(i,'','');
			}
		    } else {
		          subtotal.innerHTML = (dias * -1) * (parseInt(vdesayuno.innerHTML) + parseInt(valmuerzo.innerHTML) + parseInt(vcena.innerHTML));
			  desayuno.innerHTML = dias * -1;
		          almuerzo.innerHTML = dias * -1;
		          cena.innerHTML = dias * -1;
			if (i<10) 
			{
				Mostrar('0'+i,'','');
			} else {
				Mostrar(i,'','');
			}
		    }
		//if (tipos == '1') {
			inicio.style.color='#006699';
		//} else {
			termino.style.color='#006699';
		//}
		}
	   MM_showHideLayers('calendario','','hide')
 }
}

function Recalcula(i,Boton,Tipo) {
		if (i<10) 
		{
			i = '0'+i;
		} 
                var exento   = document.getElementById("dgrid_ctl"+i+"_exento");
                var consumo  = document.getElementById("dgrid_ctl"+i+"_consumo");
                var total    = document.getElementById("dgrid_ctl"+i+"_total");
                var estimado = document.getElementById("dgrid_ctl"+i+"_TotEst");
                
                var totexento  = document.getElementById("LB_tot_exento");
                var totconsumo = document.getElementById("LB_tot_consumo");
                var tottotal   = document.getElementById("LB_tot_total");
                
                var exentohf  = document.getElementById("dgrid$ctl"+i+"$hf_exento");
                var consuhf   = document.getElementById("dgrid$ctl"+i+"$hf_consumo");
                var totalhf   = document.getElementById("dgrid$ctl"+i+"$hf_total");
                
                if ( exento.value == '' ) {
                    exento.value = 0;     }
                if ( consumo.value == '' ){
                    consumo.value  = 0;   }
                if ( total.value == '' )  {
                    total.value = 0;      }
                    
                total.value = parseInt(MenosPuntos(exento.value)) + parseInt(MenosPuntos(consumo.value)) + parseInt(MenosPuntos(estimado.innerHTML));
                total.value = total.value;
                tottotal.innerHTML = parseInt(MenosPuntos(tottotal.innerHTML)) - parseInt(MenosPuntos(totalhf.value)) + parseInt(MenosPuntos(total.value));
                tottotal.innerHTML = insertapuntos(tottotal.innerHTML);
                Form1.hf_total.value = tottotal.innerHTML;
                totalhf.value = parseInt(MenosPuntos(total.value));
                totexento.innerHTML  = parseInt(MenosPuntos(totexento.innerHTML)) - parseInt(MenosPuntos(exentohf.value)) + parseInt(MenosPuntos(exento.value));
                totexento.innerHTML  = insertapuntos(totexento.innerHTML);
                Form1.hf_exento.value = totexento.innerHTML;
                exentohf.value = parseInt(MenosPuntos(exento.value));
                totconsumo.innerHTML  = parseInt(MenosPuntos(totconsumo.innerHTML)) - parseInt(MenosPuntos(consuhf.value)) + parseInt(MenosPuntos(consumo.value));
                totconsumo.innerHTML  = insertapuntos(totconsumo.innerHTML);
                Form1.hf_consumo.value = totconsumo.innerHTML;
                consuhf.value = parseInt(MenosPuntos(consumo.value));
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


function despcal( month, year, ind , tipo) {
/*----------------------------*/
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
mes_x += '      <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><a href="javascript:javascript:previous( ' + ind +','+ tipo + ' )"><b><<</b></a></font></td>'
mes_x += '      <td width="60%"><font color="#0000CC" face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><b><div align="center">' + nom_mes + '  ' + year + '</div></b></font></td>'
mes_x += '      <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" style="font-size: 10px"><a href="javascript:javascript:next( ' + ind + ',' + tipo + ' )"><b>>></b></a></font></td>'
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
cal_w += '      <td rowspan="2" width="17" align="right"><a href="javascript:dia( ' + nomdia_w + ',' + ind + ',' + tipo + ' )" class="texto01">' + nomdia_w + '</a></td>'
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
       cal_w += '      <td rowspan="2" width="17" align="right"><a href="javascript:dia( ' + nomdia_w + ',' + ind + ',' + tipo + ' )" class="texto01" aling="center">' + nomdia_w + '</a></td>'
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


