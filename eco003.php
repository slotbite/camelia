<?php
// Sistema			: ECO
// Programa			: ECO003.PHP
// Descripcion		: Mantención de pacientes.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 19/10/2010

session_start();

require_once 'admin/config.php';
?>

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
		
	 function vCod(){
   	/*----------------------------------*/

		var cod = Form1.cmd_codigo.value;
		var anno  = Form1.cmd_codigo.value.substr(0,4)
					/*
		if ( cod.length!==10 )
			  { alert("Código erróneo") 
			
			}
			*/
		cod = cod.replace(/^\s+/g,'').replace(/\s+$/g,'') 					
		if ( cod.length >= 1 && cod.length <10 )
			  { alert("Código erróneo") 
			
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
if (!$_POST)
{
	if (!isset($_SESSION['autoriza']) or $_SESSION['autoriza'] <> "SI") 
	  {
		echo "<script type=\"text/javascript\">
				alert('Acceso denegado......');
				</script>";
		exit();			
	  }				
	else
	{ 
		$_SESSION['autoriza'] = "NO";
	}  
}

$_SESSION['rut_s'] = $rut_w ;

$fecnac_w = "";

if (isset($_POST['cmd_codigo'])){
	$codigo_w  = $_POST['cmd_codigo'];
	}
else
{
	$codigo_w  = "";
	}

if (isset($_POST['cmd_nombre']))
{
	$nombre_w  = $_POST['cmd_nombre'];
	}
else
{
	$nombre_w  = "";
	}

if (isset($_POST['cmd_apellido1']))
{
	$apepat_w  = $_POST['cmd_apellido1'];
	}
else
{
	$apepat_w  = "";
	}

if (isset($_POST['cmd_apellido2']))
{
	$apemat_w  = $_POST['cmd_apellido2'];
	}
else
{
	$apemat_w  = "";
	}

if (isset($_POST['cmd_apellido2']))
{
	$apemat_w  = $_POST['cmd_apellido2'];
	}
else
{
	$apemat_w  = "";
	}


if (isset($_POST['DDL_dia']))
{
	$dia_w  = $_POST['DDL_dia'];
	}
else
{
	$dia_w  = "";
	}


if (isset($_POST['DDL_mes']))
{
	$mes_w  = $_POST['DDL_mes'];
	}
else
{
	$mes_w  = "";
	}

if (isset($_POST['DDL_anno']))
{
	$ano_w  = $_POST['DDL_anno'];
	}
else
{
	$ano_w  = "";
	}

if (isset($_POST['cmd_sexo']))
{
	$sexo_w  = $_POST['cmd_sexo'];
	}
else
{
	$sexo_w  = "M";
	}


if (isset($_POST['cmd_direccion']))
{
	$direccion_w  = $_POST['cmd_direccion'];
	}
else
{
	$direccion_w  = "";
	}

if (isset($_POST['ddl_ciudad']))
{
	$ciudad_w  = $_POST['ddl_ciudad'];
	}
else
{
	$ciudad_w  = "";
	}

if (isset($_POST['ddl_comuna']))
{
	$comuna_w  = $_POST['ddl_comuna'];
	}
else
{
	$comuna_w  = "";
	}

if (isset($_POST['cmd_fono_fijo']))
{
	$ffijo_w  = $_POST['cmd_fono_fijo'];
	}
else
{
	$ffijo_w  = "";
	}

if (isset($_POST['cmd_fono_cel']))
{
	$fcelular_w  = $_POST['cmd_fono_cel'];
	}
else
{
	$fcelular_w  = "";
	}

if (isset($_POST['cmd_email']))
{
	$email_w  = $_POST['cmd_email'];
	}
else
{
	$email_w  = "";
	}
	
if (isset($_POST['txt_nota']))
{
	$nota_w  = $_POST['txt_nota'];
	}
else
{
	$nota_w  = "";
	}


$modo_w = "I";
$ultcod_w = "";
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//$consulta="call ECO_PSEL_PACIENTES(null,null,'".$rut_w."')";
$consulta = "SELECT IFNULL(MAX(CONVERT(CCODIGO,signed)),0) FROM eco_pacientes";
$result=mysqli_query($link,$consulta);
while ($row=mysqli_fetch_array($result))
		{
		$ultcod_w      = $row[0];

		}
mysqli_free_result($result);
mysqli_close($link);


if ($_POST) {
    $_SESSION['rut_s'] = $_POST['cmd_rut'];
}

// if (strlen(trim($rut_w)) > 0)
if ( strlen(trim( $_GET["RUT"] )) > 0 )
{ 
    $modo_w = "M";
	
	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//	mysql_select_db(DB_NAME, $link); 

	//Ejecutamos la sentencia SQL
//	$consulta="call ECO_PSEL_PACIENTES(null,null,'".$rut_w."')";
	$consulta="call ECO_PSEL_PACIENTES(null,null,'".$rut_w."')";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
	//	echo '<tr><td>'.$row["CDESCRIPCION"].'</td>';
	//	echo '<td>'.$row["NDESCRIPCION"].'</td></tr>';
		$nombre_w = $row["nombre"];
		$apepat_w = $row["apaterno"];
		$apemat_w = $row["amaterno"];
		$fecnac_w = $row["fnacimiento"];
		$dia_w  = substr($fecnac_w, 0, 2);
		$mes_w  = substr($fecnac_w, 3, 2);
		$ano_w  = substr($fecnac_w, 6, 4);
		$sexo_w   = $row["sexo"];
		$direccion_w = $row["direccion"];
		$ciudad_w = $row["cciudad"];
 		$comuna_w = $row["ccomuna"];
		$ffijo_w   = $row["fonofijo"];
		$fcelular_w  = $row["celular"];
		$email_w     = $row["email"];
		$nota_w      = $row["nota"];
		$codigo_w    = $row["ccodigo"];


		}
	mysqli_free_result($result);
	mysqli_close($link);
}

//llena ddl comunas

//$db=mysql_connect("localhost","root","");
//mysql_select_db("eco");

$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//mysql_select_db(DB_NAME, $link); 

$query="call ECO_PSEL_DESCRIPCIONES(null,'COMUNA','S')";

$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);

$lst_comunas="<select name='ddl_comuna' id='ddl_comuna' class='input-normal'>\n<option value='0' selected>Comunas</option>";


while($registro=mysqli_fetch_array($r))
{    
	   if ($registro[0] == $comuna_w)
	      {
		   $lst_comunas.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_comunas.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		
		   }
}

$lst_comunas.="\n</select>";

mysqli_close($link);
//llena ddl ciudades
//$db=mysql_connect("localhost","root","");
//mysql_select_db("eco");
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//mysql_select_db(DB_NAME, $link); 

$query2="call ECO_PSEL_DESCRIPCIONES(null,'CIUDAD','S')";

$r2=mysqli_query($link,$query2) or die("No se pudo ejecutar la consulta ".$query2);

$lst_ciudades="<select name='ddl_ciudad' id='ddl_ciudad' class='input-normal'>\n<option value='0' selected>Ciudades</option>";
while($registro=mysqli_fetch_array($r2))
{
//	$lst_ciudades.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
	   if ($registro[0] == $ciudad_w  )
	      {
		   $lst_ciudades.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_ciudades.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		   }

}

$lst_ciudades.="\n</select>";

mysqli_close($link);

?> 
<script type="text/javascript">

var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}

</script>

    <div>
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 3px; position: absolute; top: 6px; height: 479px; width: 611px;" width="590">
      <tr>
                <td width="32" style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
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
                
        <td align="center" height="100" width="591"> <table width="512" height="415" border="0" align="left" cellpadding="0" cellspacing="0" class="texto11" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Código Paciente</td>
              <!--
              <td width="373" style="width: 314px; height: 3px"> <input name="cmd_codigo" type="text" maxlength="10" id="cmd_codigo" class="input-normal" style="border:1px solid #FFFFFF;color:Red;"  value="<?php echo $codigo_w; ?>" readonly="readonly"/></td>
			  -->
              <?php 
			
//			 if (strlen(trim($codigo_w)) == 0)
			 if ($modo_w == "I")
			 {
			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codigo" type="text" maxlength="10" id="cmd_codigo" class="input-normal" style="text-transform: uppercase; width:60px;" onchange="vCod()" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$codigo_w.'" /> &nbsp; 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="CodMalo" style="color:Red;">Ult Cod Ingresado &nbsp;&nbsp;'.$ultcod_w.'</span> ';
			  }
			 else
			   { 
 			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codigo" type="text" maxlength="10" id="cmd_codigo" class="input-normal" style="text-transform: uppercase; width:60px;"" onchange="vCod()" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$codigo_w.'" readOnly="readonly"/> ';
  
              }
			  echo '<span id="CodMalo" style="color:Red;display:none;">* Código inválido</span> </td>';

              ?>
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
			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase; width:76px;" onchange="vRut()" value="'.$_SESSION["rut_s"].'" /> ';
			  }
			 else
			   { 
			//   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="'.$rut_w.'" readOnly="readonly"/> ';
 			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase; width:76px;" onchange="vRut()" value="'.$_SESSION["rut_s"].'" readOnly="readonly"/> ';
  
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
              <td style="width: 314px; height: 3px"> <input name="cmd_nombre" stype="text" maxlength="40" id="cmd_nombre" class="input-normal" style="width:176px;"  value="<?php echo $nombre_w; ?>"/> 
                &nbsp; <span id="RequiredFieldValidator2" style="display:inline-block;color:Red;font-weight:bold;width:8px;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Apellido 
                Paterno</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_apellido1" type="text" maxlength="40" id="cmd_apellido12" class="input-normal" style="width:176px;" value="<?php echo $apepat_w; ?>"/> 
                &nbsp; <span id="RequiredFieldValidator3" style="color:Red;font-weight:bold;visibility:hidden;">???</span></td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="6" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Apellido Materno</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_apellido2" type="text" maxlength="40" id="cmd_apellido22" class="input-normal" style="width:176px;" value="<?php echo $apemat_w; ?>" /> 
                &nbsp; <span id="RequiredFieldValidator3" style="color:Red;font-weight:bold;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td style="width: 95px; height: 3px"> &nbsp; Fec. Nacimiento</td>
              <td style="width: 314px; height: 3px"> 
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
				
				$cont_w = 1900;
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
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Sexo</td>
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
              <td style="width: 314px; height: 3px"> <input name="cmd_direccion" type="text" maxlength="100" id="cmd_direccion2" class="input-normal" style="width:312px;" value="<?php echo $direccion_w; ?>" /> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Comuna </td>
              <td style="width: 314px; height: 3px"> 
                <?php
			  echo $lst_comunas;
  			  echo "&nbsp;   Ciudad   ";
			  echo $lst_ciudades;
			  ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 3px"> &nbsp; Fono Fijo</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_fono_fijo" type="text" maxlength="10" id="cmd_fono_fijo2" class="input-normal" style="width:112px;" value="<?php echo $ffijo_w; ?>"/> 
                &nbsp; Fono Celular&nbsp; <input name="cmd_fono_cel" type="text" maxlength="10" id="cmd_fono_cel2" class="input-normal" style="width:112px;" value="<?php echo $fcelular_w; ?>"/></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Email</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_email" type="text" maxlength="60" id="cmd_email2" class="input-normal" style="width:176px;" value="<?php echo $email_w; ?>" /> 
                &nbsp; <span id="RegularExpressionValidator1" style="color:Red;visibility:hidden;">e-mail 
                no valida</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Nota</td>
              <td style="width: 314px; height: 3px"> <textarea name="txt_nota" cols="60" rows="3" class="input-normal" ><?php echo $nota_w; ?></textarea> 
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td height="92" colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg2" value="0" /> 
                <table width="512" border="0" align="center" cellpadding="1" cellspacing="1" id="Table3"
                        style="width: 310px; height: 8px; background-color: whitesmoke;">
                  <tr> 
                    <td height="24" align="center" style="width: 126px"> <input type="submit" name="cmd_atras" value="Atras" id="cmd_atras2" class="boton" style="width:70px;" /></td>
                    <td style="width: 45px"> </td>
                    <td align="center"> <input type="submit" name="cmd_aceptar" value="Aceptar" id="cmd_aceptar2" class="boton" /></td>
                  </tr>
                </table>
                <div id="Panel1" style="height:50px;width:440px;"> 
                  <div id="Panel2" style="height:50px;width:125px;"> </div>
                </div>
                <input type="hidden" name="hdCorr" id="hdCorr2" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina2" value="2" /> 
              </td>
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
 if(isset($_POST["cmd_atras"])) 
    {
//	 include ("eco003.php"); 
/*
    $extra = 'eco002.php';
    header("Location: $extra");
*/	
	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";
	
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
 if(isset($_POST["cmd_aceptar"])) { 
//echo "grabar";

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
	$codigo_w     = trim($_POST["cmd_codigo"]);

	//empiezas las validaciones correspondientes por ejemplo
	$error_w = FALSE;
	if (strlen($rut_w) < "3") { //que el nombre sea mayor a 3
		   echo "<script type=\"text/javascript\">document.getElementById('RutMalo').style.display=''</script>";
		$error_w = TRUE;
		}
		
		
	if ( $error_w )	
	  {
	  exit();
	  }
	else{//el ultimo else tiene que se el de tu insert into
		if ($ciudad_w == "0") {
			$ciudad_w = "NULL";
			} 		

		if ($comuna_w == "0") {
			$comuna_w = "NULL";
			} 		

	     if (empty($codigo_w)) {
			 $codigo_w = "0";
		   } 
		   
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$sql1 = "call ECO_PUPD_PACIENTES('".$modo_w."','".$rut_w."','".$nombre_w."','".$apepat_w."','".$apemat_w."',STR_TO_DATE('".$fecnac_w."','%d/%m/%Y'),".$ciudad_w.",".$comuna_w.",'".$direccion_w."','".$fcelular_w."','".$ffijo_w."','".$nota_w."','".$sexo_w."','".$email_w."',";
 		$sql1 = $sql1."'".$codigo_w."',@cod_w)";
// echo $sql1;
// exit();

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El paciente ya existe....." ;
				$error = mysqli_error($link);
				$newText = str_replace("'" , " " , $error);
				$merror = $newText;
				
				$mystring = $error;
				$findme   = 'PRIMARY';
				$pos = strpos($mystring, $findme);
				$findme   = 'key 1';
				$pos1 = strpos($mystring, $findme);
				// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
				// porque la posición de 'a' está en el 1° (primer) caracter.
				if ($pos != false or $pos1 != false ) {
					$merror = "El RUT del paciente ya existe....." ;
					}
				else {
					$mystring = $error;
					$findme   = 'CODIGO';
					$pos = strpos($mystring, $findme);
					$findme   = 'key 2';
					$pos1 = strpos($mystring, $findme);
					// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
					// porque la posición de 'a' está en el 1° (primer) caracter.
					if ($pos != false or $pos1 != false ) {
						$merror = "El CODIGO del paciente ya existe....." ;
						}
					}
					
				} 
				
//			echo $error;	
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .' );
				</script>";
				
			mysqli_close($link);
			exit();

			}
		else
		   {
			echo "<script type=\"text/javascript\">
				alert('El Paciente: \' $rut_w \' ha sido registrado de manera satisfactoria.');
				</script>";
				
   			//rescato el codigo del paciente

			$consulta = "SELECT @cod_w";
			$result   = mysqli_query($link,$consulta);
			$row      = mysqli_fetch_array($result);
			$codigo_w = $row[0];
//			$_POST['cmd_codigo'] = $codigo_w;
//			$modo_w = "M";	
			mysqli_free_result($result); 
		    mysqli_close($link);

			}	
  		

	   }//cierras todos los else que abras

/*   echo "<script>opener.document.form1.submit()</script>";
   echo "<script type=\"text/javascript\"> window.close(); </script>";
*/
	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";


 }
}
?>

</body>
</html>
