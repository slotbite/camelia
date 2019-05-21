

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ingreso de Pacientes</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
	function vRut(){
   	/*----------------------------------*/

		var variable = Form1.cmd_rut.value.substr(0,Form1.cmd_rut.value.indexOf("-"));
		var digit = Form1.cmd_rut.value.substr(Form1.cmd_rut.value.indexOf("-")+1).toUpperCase();
					
		if ( validaRut(variable,digit) == false )
			  { alert("Rut Invalido") 
			
			} 					
		
		}
			function validaFecha(source, arguments){
			/*------------------------------------*/
				var dia  = Form1.cmd_fec_nac.value.substr(0,2)
				var mes  = Form1.cmd_fec_nac.value.substr(3,2)
				var anno = Form1.cmd_fec_nac.value.substr(6,4)
				
				if (dia.length!==2 || mes.length!==2 || anno.length!==4){
					arguments.IsValid=false
				}				
			}			
			
		
			function fabre_ventana(iparamt,icoord){
			/*---------------------------*/
				pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
				pant_emp.location = iparamt
			}

		</script>
</head>
<?php

$rut_w = $_GET["RUT"];
//echo $rut_w;

?>

<body>
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">

<?php


$nombre_w = "";
$apepat_w = "";
$apemat_w = "";
$dia_w    = "";
$mes_w    = "";
$ano_w    = "";
$fecnac_w = "";
$sexo_w   = "M";
$direccion_w = "";
$ciudad_w    = "";
$comuna_w    = "";
$ffijo_w     = "";
$fcelular_w  = "";
$email_w     = "";
$nota_w     = "";

$modo_w = "I";

if (strlen(trim($rut_w)) > 0)
{ 
    $modo_w = "M";
	
	//Conexion con la base
	$link = mysql_connect("localhost","root","");
	mysql_select_db("eco");
	
	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_PACIENTES(null,null,'".$rut_w."')";
	$result=mysql_query($consulta);

	//Mostramos los registros
	while ($row=mysql_fetch_array($result))
		{
	//	echo '<tr><td>'.$row["CDESCRIPCION"].'</td>';
	//	echo '<td>'.$row["NDESCRIPCION"].'</td></tr>';
		$nombre_w = $row["nombre"];
		$apepat_w = $row["apaterno"];
		$apemat_w = $row["amaterno"];
		$fecnac_w = $row["fnacimiento"];
		$dia_w    = substr($fecnac_w, 0, 2);
		$mes_w    = substr($fecnac_w, 3, 2);
		$ano_w    = substr($fecnac_w, 6, 4);
		$sexo_w   = $row["sexo"];
		$direccion_w = $row["direccion"];
		$ciudad_w    = $row["nCiudad"];
 		$comuna_w    = $row["nComuna"];

		}
	mysql_free_result($result);
	mysql_close($link);
}

//llena ddl comunas

$db=mysql_connect("localhost","root","");
mysql_select_db("eco");

$query="call ECO_PSEL_DESCRIPCIONES(null,'COMUNA','S')";

$r=mysql_query($query) or die("No se pudo ejecutar la consulta ".$query);

$lst_comunas="<select name='ddl_comuna' id='ddl_comuna' class='input-normal'>\n<option selected>Comunas</option>";
while($registro=mysql_fetch_array($r))
{    
    if ($modo_w == "M")
	
	   { 
	   if ($registro[1] == $comuna_w  )
	      {
		   $lst_comunas.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_comunas.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		   }
	   }
    else
	  {
		$lst_comunas.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
	   }

}

$lst_comunas.="\n</select>";

mysql_close($db);
//llena ddl ciudades
$db=mysql_connect("localhost","root","");
mysql_select_db("eco");

$query2="call ECO_PSEL_DESCRIPCIONES(null,'CIUDAD','S')";

$r2=mysql_query($query2) or die("No se pudo ejecutar la consulta ".$query2);

$lst_ciudades="<select name='ddl_ciudad' id='ddl_ciudad' class='input-normal'>\n<option selected>Ciudades</option>";
while($registro=mysql_fetch_array($r2))
{
//	$lst_ciudades.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
    if ($modo_w == "M")
	
	   { 
	   if ($registro[1] == $ciudad_w  )
	      {
		   $lst_ciudades.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_ciudades.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		   }
	   }
    else
	  {
		$lst_ciudades.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
	   }

}

$lst_ciudades.="\n</select>";

mysql_close($db);

?> 
<script type="text/javascript">

var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}

</script>

<!--
<script src="/desa_vvpp/WebResource.axd?d=3lC5CkLTZo17F4QZ5jLtcw2&amp;t=633964179561718750" type="text/javascript"></script>

<script src="/desa_vvpp/WebResource.axd?d=bfJgu44SMauYC2Auaebm1Lrtp3Y2Cb2YGY-yfgTuWFw1&amp;t=633964179561718750" type="text/javascript">
</script><script language="javascript"> 
var MsgBoxTipoMensaje; 
var MsgBoxTextoMensaje; 
window.attachEvent("onfocus", MsgBoxMostrarMensaje); 
function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} 
</script>
-->
    <div>
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 63px; position: absolute; top: 14px; height: 498px; width: 623px;" width="510">
      <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18"> PACIENTES</span></td>
            </tr>
            <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                <td style="background-image: url(ivvpp0005.jpg); height: 21px">
                </td>
            </tr>
          <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                <td align="center" height="100" width="480">
                    <table id="Table2" align="center" border="0" cellpadding="0" cellspacing="0" class="texto11"
                        style="height: 88px; text-align: left;" width="512">
						
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="131" style="width: 95px; height: 18px"> &nbsp; <span id="Lb_identificador" style="display:inline-block;width:83px;">Rut</span></td>
			  <!--
              <td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="<?php if (isset($_POST['cmd_rut'])) echo $_POST['cmd_rut'];?>"/> 
			  -->
			 <?php 
			
			 if (strlen(trim($rut_w)) == 0)
			 {
			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="'.$rut_w.'" /> ';
			  }
			 else
			   { 
			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="'.$rut_w.'" readOnly="readonly"/> ';
               
              }
			  echo '<span id="RutMalo" style="color:Red;display:none;">* Rut inválido</span> </td>';

              ?>

            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td height="22" style="width: 95px; height: 2px"> &nbsp; Nombre</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" maxlength="40" id="cmd_nombre" class="input-normal" style="width:176px;"  value="<?php echo $nombre_w; ?>"/> 
                &nbsp; <span id="RequiredFieldValidator2" style="display:inline-block;color:Red;font-weight:bold;width:8px;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Apellido 
                Paterno</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_apellido1" type="text" maxlength="40" id="cmd_apellido1" class="input-normal" style="width:176px;" value="<?php echo $apepat_w; ?>"/> 
                &nbsp; <span id="RequiredFieldValidator3" style="color:Red;font-weight:bold;visibility:hidden;">???</span></td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Apellido Materno</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_apellido2" type="text" maxlength="40" id="cmd_apellido2" class="input-normal" style="width:176px;" value="<?php echo $apemat_w; ?>" /> 
                &nbsp; <span id="RequiredFieldValidator3" style="color:Red;font-weight:bold;visibility:hidden;">???</span></td>
            </tr>
            <tr style="color: #000000"> 
              <td style="width: 95px; height: 3px"> &nbsp; Fec. Nacimiento</td>
              <td style="width: 314px; height: 3px"> &nbsp; 
<!--			  	  
			  <select name="DDL_dia" id="select2" class="input-normal">
				  <option selected="selected" value="no">Dia</option>
				  <option value="01">1</option>
				  <option value="02">2</option>
				  <option value="03">3</option>
				  <option value="04">4</option>
				  <option value="05">5</option>
				  <option value="06">6</option>
				  <option value="07">7</option>
				  <option value="08">8</option>
				  <option value="09">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
				  <option value="12">12</option>
				  <option value="13">13</option>
				  <option value="14">14</option>
				  <option value="15">15</option>
				  <option value="16">16</option>
				  <option value="17">17</option>
				  <option value="18">18</option>
				  <option value="19">19</option>
				  <option value="20">20</option>
				  <option value="21">21</option>
				  <option value="22">22</option>
				  <option value="23">23</option>
				  <option value="24">24</option>
				  <option value="25">25</option>
				  <option value="26">26</option>
´				  <option value="27">27</option>
				  <option value="28">28</option>
				  <option value="29">29</option>
				  <option value="30">30</option>
				  <option value="31">31</option>
				  
				  
				</select>
-->
				<?php
				//llena ddl dia
				
				$cont_w = 1;
				$lst_dia="<select name='DDL_dia' id='DDL_dia' class='input-normal'>\n<option selected>Dia</option>";
				
				while($cont_w <= 31)
				{
					
				  { if ( $cont_w == $dia_w )
						  {
						   $lst_dia.="\n<option selected='selected' value='".$cont_w."'>".$cont_w."</option>";
						   }
					   else
						  { 
						  $lst_dia.="\n<option value='".$cont_w."'>".$cont_w."</option>";
						   }
						  
			 	   }
					
					$cont_w ++;
				}
				
				$lst_dia.="\n</select>";
				
				echo $lst_dia;
						
				//llena ddl mes
				
				$cont_w = 1;
				$nmes_w = "";
				$lst_mes = "<select name='DDL_mes' id='DDL_mes' class='input-normal'>\n<option selected>Mes</option>";
				
				while($cont_w <= 12)
				{	switch ($cont_w) {
					case 1:
						$nmes_w = "Enero";
						break;
					case 2:
						$nmes_w = "Febrero";
						break;
					case 3:
						$nmes_w = "Marzo";
						break;
					case 4:
						$nmes_w = "Abril";
						break;
					case 5:
						$nmes_w = "Mayo";
						break;
					case 6:
						$nmes_w = "Junio";
						break;
					case 7:
						$nmes_w = "Julio";
						break;
					case 8:
						$nmes_w = "Agosto";
						break;
					case 9:
						$nmes_w = "Septiembre";
						break;
					case 10:
						$nmes_w = "Octubre";
						break;
					case 11:
						$nmes_w = "Noviembre";
						break;
					case 12:
						$nmes_w = "Diciembre";
						break;

				}
				  if ( $cont_w == $mes_w )
					  {
					   $lst_mes.="\n<option selected='selected' value='".$cont_w."'>".$nmes_w."</option>";
					   }
				   else
					  { 
					  $lst_mes.="\n<option value='".$cont_w."'>".$nmes_w."</option>";
					   }
						  
			 	   $cont_w ++;
				}
				
				$lst_mes.="\n</select>";
				
				echo $lst_mes;
				
				//llena ddl anno
				
				$cont_w = 1930;
				$lst_ano="<select name='DDL_anno' id='DDL_anno' class='input-normal'>\n<option selected>Año</option>";
				
//				while($cont_w <= 2010)
				while($cont_w <= date ("Y"))
							
				  { if ( $cont_w == $ano_w )
						  {
						   $lst_ano.="\n<option selected='selected' value='".$cont_w."'>".$cont_w."</option>";
						   }
					   else
						  { 
						  $lst_ano.="\n<option value='".$cont_w."'>".$cont_w."</option>";
						   }
													
					$cont_w ++;
				  }
				
				$lst_ano.="\n</select>";
				
				echo $lst_ano;

				?>
<!--
                <select name="DDL_mes" id="DDL_mes" class="input-normal">
                 <option selected="selected" value="no">Mes</option>
                  <option value="01">Enero</option>
                  <option value="02">Febrero</option>
                  <option value="03">Marzo</option>
                  <option value="04">Abril</option>
                  <option value="05">Mayo</option>
                  <option value="06">Junio</option>
                  <option value="07">Julio</option>
                  <option value="08">Agosto</option>
                  <option value="09">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
				  </select> &nbsp; 
-->				  
<!--
				  
                
				<select name="DDL_anno" id="DDL_anno" class="input-normal">
                  <option selected="selected" value="no">A&#241;o</option>
                  <option value="1930">1930</option>
                  <option value="1931">1931</option>
                  <option value="1932">1932</option>
                  <option value="1933">1933</option>
                  <option value="1934">1934</option>
                  <option value="1935">1935</option>
                  <option value="1936">1936</option>
                  <option value="1937">1937</option>
                  <option value="1938">1938</option>
                  <option value="1939">1939</option>
                  <option value="1940">1940</option>
                  <option value="1941">1941</option>
                  <option value="1942">1942</option>
                  <option value="1943">1943</option>
                  <option value="1944">1944</option>
                  <option value="1945">1945</option>
                  <option value="1946">1946</option>
                  <option value="1947">1947</option>
                  <option value="1948">1948</option>
                  <option value="1949">1949</option>
                  <option value="1950">1950</option>
                  <option value="1951">1951</option>
                  <option value="1952">1952</option>
                  <option value="1953">1953</option>
                  <option value="1954">1954</option>
                  <option value="1955">1955</option>
                  <option value="1956">1956</option>
                  <option value="1957">1957</option>
                  <option value="1958">1958</option>
                  <option value="1959">1959</option>
                  <option value="1960">1960</option>
                  <option value="1961">1961</option>
                  <option value="1962">1962</option>
                  <option value="1963">1963</option>
                  <option value="1964">1964</option>
                  <option value="1965">1965</option>
                  <option value="1966">1966</option>
                  <option value="1967">1967</option>
                  <option value="1968">1968</option>
                  <option value="1969">1969</option>
                  <option value="1970">1970</option>
                  <option value="1971">1971</option>
                  <option value="1972">1972</option>
                  <option value="1973">1973</option>
                  <option value="1974">1974</option>
                  <option value="1975">1975</option>
                  <option value="1976">1976</option>
                  <option value="1977">1977</option>
                  <option value="1978">1978</option>
                  <option value="1979">1979</option>
                  <option value="1980">1980</option>
                  <option value="1981">1981</option>
                  <option value="1982">1982</option>
                  <option value="1983">1983</option>
                  <option value="1984">1984</option>
                  <option value="1985">1985</option>
                  <option value="1986">1986</option>
                  <option value="1987">1987</option>
                  <option value="1988">1988</option>
                  <option value="1989">1989</option>
                  <option value="1990">1990</option>
                  <option value="1991">1991</option>
                  <option value="1992">1992</option>
                  <option value="1993">1993</option>
                  <option value="1994">1994</option>
                  <option value="1995">1995</option>
                  <option value="1996">1996</option>
                  <option value="1997">1997</option>
                  <option value="1998">1998</option>
                  <option value="1999">1999</option>
                  <option value="2000">2000</option>
                  <option value="2001">2001</option>
                  <option value="2002">2002</option>
                  <option value="2003">2003</option>
                  <option value="2004">2004</option>
                  <option value="2005">2005</option>
                  <option value="2006">2006</option>
                  <option value="2007">2007</option>
                </select>
-->				
				 </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Sexo</td>
			  
  			 		  			  
<!--
              <td style="width: 314px; height: 3px"> <select name="cmd_sexo" id="cmd_sexo" class="texto01">
			  
                  <option selected="selected" value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
-->				
				<?php
				   echo'<td style="width: 314px; height: 3px"> <select name="cmd_sexo" id="cmd_sexo" class="texto01">';

				  if ( $sexo_w == "M" )
				  {
					echo "\n<option selected='selected' value='M'>Masculino</option>";
				   	echo "\n<option value='F'>Femenino</option>";
				   }
				  else
				  { 
				  	echo "\n<option value='M'>Masculino</option>";
				   	echo "\n<option selected='selected'value='F'>Femenino</option>";
				   }
				  
				  echo "\n</select></td>";
				?>				
				
				</tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Direccion</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_direccion" type="text" maxlength="100" id="cmd_direccion" class="input-normal" style="width:312px;" value="<?php echo $direccion_w; ?>" /> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Comuna  </td>
              <td style="width: 314px; height: 3px"> 
              <?php
			  echo $lst_comunas;
			  ?>
                <!--			  <select name="ddl_comuna">
                  <option value="valpo" selected="selected">valparaiso</option>
                  <option value="stgo">santiago</option>
                </select>
				-->
                &nbsp; Ciudad 
                <!--				  
				<select name="ddl_ciudad">
                  <option value="valpo" selected="selected">valparaiso</option>
                  <option value="stgo">santiago</option>
                </select>
				-->
                <?php
			  echo $lst_ciudades;
			  ?>
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 3px"> &nbsp; Fono Fijo</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_fono_fijo" type="text" maxlength="10" id="cmd_fono_fijo" class="input-normal" style="width:112px;" /> 
                &nbsp; Fono Celular&nbsp; <input name="cmd_fono_cel" type="text" maxlength="10" id="cmd_fono_cel" class="input-normal" style="width:112px;" /></td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Email</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_email" type="text" maxlength="60" id="cmd_email" class="input-normal" style="width:176px;" /> 
                &nbsp; <span id="RegularExpressionValidator1" style="color:Red;visibility:hidden;">e-mail 
                no valida</span></td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Nota</td>
              <td style="width: 314px; height: 3px"> <textarea name="txt_nota" rows="3" class="input-normal"></textarea>
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px;"> 
              </td>
            </tr>
            <tr> 
              <td colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg" value="0" /> 
                <div id="Panel1" style="height:50px;width:440px;"> 
                  <div id="Panel2" style="height:50px;width:125px;"> 
                    <table cellpadding="0" cellspacing="0" class="texto11" style="width: 440px">
                      <tr> 
                        <td colspan="3" style="height: 20px"> </td>
                      </tr>
                      <tr> 
                        <td colspan="3" style="height: 7px"> </td>
                      </tr>
                      <tr> 
                        <td style="width: 106px;"> </td>
                        <td style="width: 152px;"> </td>
                        <td> </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <input type="hidden" name="hdCorr" id="hdCorr" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina" value="2" /> 
              </td>
            </tr>
          </table>
                    <table id="Table3" align="center" border="0" cellpadding="1" cellspacing="1"
                        style="width: 310px; height: 8px; background-color: whitesmoke;" width="310">
                        <tr>
                            <td align="center" style="width: 126px">
                                <input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" style="width:70px;" /></td>
                            <td style="width: 45px">
                                
                            </td>
                            <td align="center">
<!--							
														<input type="submit" name="cmd_aceptar" value="Aceptar" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;cmd_aceptar&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="cmd_aceptar" class="boton" /></td>
-->														
			             <input type="submit" name="cmd_aceptar" value="Aceptar" id="cmd_aceptar" class="boton" /></td>

                        </tr>
                    </table>
                    <input type="hidden" name="HD_trans" id="HD_trans" />
                    </td>
            </tr>
        </table>
        <br />
        <br />
    
    </div>
    
<?php	
if ($_POST) 
{
 if(isset($cmd_atras)) 
    {
//	 include ("eco003.php"); 
    $extra = 'eco002.php';
    header("Location: $extra");
	}
	
}
?>

<div>

	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
</div>

<script type="text/javascript">
<!--
var Page_ValidationActive = false;
if (typeof(ValidatorOnLoad) == "function") {
    ValidatorOnLoad();
}

function ValidatorOnSubmit() {
    if (Page_ValidationActive) {
        return ValidatorCommonOnSubmit();
    }
    else {
        return true;
    }
}
// -->
</script>
        
<script type="text/javascript">
<!--

//theForm.oldSubmit = theForm.submit;
//theForm.submit = WebForm_SaveScrollPositionSubmit;

//theForm.oldOnSubmit = theForm.onsubmit;
//theForm.onsubmit = WebForm_SaveScrollPositionOnSubmit;
// -->
</script>
</form>

<?php
if ($_POST) {
 if(isset($cmd_aceptar)) { 
//echo "grabar";

//	if (isset($_POST["cmd_rut"])){//1
	$rut_w    = $_POST["cmd_rut"];
	$nombre_w = $_POST["cmd_nombre"];
	$apepat_w = $_POST["cmd_apellido1"];
	$apemat_w = $_POST["cmd_apellido2"];
	$dia_w    = $_POST["DDL_dia"];
	$mes_w    = $_POST["DDL_mes"];
	$ano_w    = $_POST["DDL_anno"];
	$fecnac_w = $dia_w .'/' . $mes_w . '/' . $ano_w;
	$sexo_w   = $_POST["cmd_sexo"];
	$direccion_w = $_POST["cmd_direccion"];
	$ciudad_w    = $_POST["ddl_ciudad"];
	$comuna_w    = $_POST["ddl_comuna"];
	$ffijo_w     = $_POST["cmd_fono_fijo"];
	$fcelular_w  = $_POST["cmd_fono_cel"];
	$email_w     = $_POST["cmd_email"];
	$nota_w     = $_POST["txt_nota"];


	//empiezas las validaciones correspondientes por ejemplo
	
	if (strlen($rut_w) < "3") { //que el nombre sea mayor a 3
		   echo "<script type=\"text/javascript\">document.getElementById('RutMalo').style.display=''</script>";
/*		ahora dentro del echo pongo un alert que lo q hace es q si sucede q el nombre sea menor a tres manda un mensaje que te permite visualizarlo sin salir de la pagina
		echo  "<script type=\"text/javascript\">
		alert('El campo Nombre debe tener al menos 3 caracteres');
		</script>";    
*/
		 exit();
		}
/*
	else{
	
	//mas validaciones
*/	
	else{//el ultimo else tiene que se el de tu insert into
	
		$link = mysql_connect("localhost","root","");
		mysql_select_db("eco");
		
//	call `ECO_PUPD_PACIENTES`('M','1-9','JUAN','PEREZ','GONZALEZ',STR_TO_DATE('31/01/1970','%d/%m/%Y'),'5ciud','36com','VALLE CORDILLERA 1111','93324806','2499805','PACIENTE EXCELENTE',sexo,email);

//		$sql1 = "call ECO_PUPD_PACIENTES('I','".$rut_w."','".$nombre_w."','".$apepat_w."','".$apemat_w."',null,null,null,null,null,null,null,null,null)";
		$sql1 = "call ECO_PUPD_PACIENTES('".$modo_w."','".$rut_w."','".$nombre_w."','".$apepat_w."','".$apemat_w."',STR_TO_DATE('".$fecnac_w."','%d/%m/%Y'),'".$ciudad_w."','".$comuna_w."','".$direccion_w."','".$ffijo_w."','".$fcelular_w."','".$nota_w."','".$sexo_w."','".$email_w."')";

// echo $sql1;
// exit();
		mysql_query($sql1);
		mysql_close($link);

		echo "<script type=\"text/javascript\">
			alert('El Paciente: \' $rut_w \' ha sido registrado de manera satisfactoria.');
			</script>";
	
	   }//cierras todos los else que abras

 }
}
?>

</body>
</html>
