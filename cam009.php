<?php
// Sistema			: CAMELIA
// Programa			: CAM009.PHP
// Descripcion		: Mantención de artículos.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 22/08/2011

session_start();

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ingreso de Artículos</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
	function vRut(){
   	/*----------------------------------*/

		var variable = Form1.cmd_rutpro.value.substr(0,Form1.cmd_rutpro.value.indexOf("-"));
		var digit = Form1.cmd_rutpro.value.substr(Form1.cmd_rutpro.value.indexOf("-")+1).toUpperCase();
					
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

$cod_w = $_GET["COD"];

$codpro_w = "";
$codart_w = "";

if (!empty( $cod_w ) ) {
   
    $pos = strpos($cod_w, '.');

	if ($pos == 0) {
		$codpro_w = "";
		$codart_w = "";
//	    $cdes_w = substr($cod_w, $pos + 1);
	} 
	else
	{
		$codpro_w = substr($cod_w, 0, $pos);
		$codart_w = substr($cod_w, $pos + 1);

	}
      
}
else{
  $codpro_w = "";
  $codart_w = "";
}


?>
<body bgcolor="#000080" text="#ffffff">
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">
<?php	
/*
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
*/
$_SESSION['codpro_s'] = $codpro_w ;
$_SESSION['codart_s'] = $codart_w ;


if (isset($_POST['cmd_nomart']))
{
	$nomart_w  = $_POST['cmd_nomart'];
	}
else
{
	$nomart_w  = "";
	}
	
$modo_w = "I";

if ($_POST) {
    $_SESSION['codpro_s'] = $_POST['cmd_codpro'];
    $_SESSION['codart_s'] = $_POST['cmd_codart'];
}

// if (strlen(trim($rut_w)) > 0)
if ( strlen(trim( $_GET["COD"] )) > 0 )
{ 
    $modo_w = "M";
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_articulos('".$codpro_w."','".$codart_w."',null)";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nomart_w = $row["nomart"];
		
		}
	mysqli_free_result($result);
	mysqli_close($link);
}

?> 
<script type="text/javascript">

var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}

</script>

    <div>
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 3px; position: absolute; top: 6px; height: 159px; width: 511px;" >
      <tr>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18">ARTICULOS</span></td>
            </tr>
          <tr>
        <td > <table width="512" height="15" border="0" align="left" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>

            <tr> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; Código Proveedor</td>
            <?php 
			
			 if ($modo_w == "I")
			 {
			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codpro" type="text" maxlength="3" id="cmd_codpro" class="input-normal" style="text-transform: uppercase; width:60px;"  value="'.$_SESSION["codpro_s"].'" /> ';
			  }
			 else
			   { 
 			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codpro" type="text" maxlength="3" id="cmd_codpro" class="input-normal" style="text-transform: uppercase; width:60px;""  value="'.$_SESSION["codpro_s"].'" readOnly="readonly"/> ';
  
              }
			  echo '<span id="CodProMalo" style="color:Red;display:none;">* Código inválido</span> </td>';
  			  echo '<span id="CodProMalo_2" style="color:Red;display:none;">* Proveedor No Existe</span> </td>';

              ?>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; Código Artículo</td>
            <?php 
			
			 if ($modo_w == "I")
			 {
			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codart" type="text" maxlength="4" id="cmd_codart" class="input-normal" style="text-transform: uppercase; width:60px;"  value="'.$_SESSION["codart_s"].'" /> ';
			  }
			 else
			   { 
 			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codart" type="text" maxlength="4" id="cmd_codart" class="input-normal" style="text-transform: uppercase; width:60px;""  value="'.$_SESSION["codart_s"].'" readOnly="readonly"/> ';
  
              }
			  echo '<span id="CodArtMalo" style="color:Red;display:none;">* Código inválido</span> </td>';

              ?>
            </tr>

            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 2px">&nbsp; Nombre Artículo</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_nomart" stype="text" maxlength="15" id="cmd_nomart" class="input-normal" style="width:176px;"  value="<?php echo $nomart_w; ?>"/> 
                &nbsp; <span id="RequiredFieldValidator2" style="display:inline-block;color:Red;font-weight:bold;width:8px;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            
              <td height="92" colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg2" value="0" /> 
                <table width="512" border="0" align="center" cellpadding="1" cellspacing="1" id="Table3"
                        style="width: 310px; height: 8px; background-color: whitesmoke;">
                  <tr> 
                    <td height="24" align="center" style="width: 126px"> <input type="submit" name="cmd_atras" value="Atras" id="cmd_atras2" class="boton" style="width:70px;" /></td>
                    <td style="width: 45px"> </td>
                    <td align="center"> <input type="submit" name="cmd_aceptar" value="Aceptar" id="cmd_aceptar2" class="boton" /></td>
                  </tr>
                </table>
<!--                 <div id="Panel1" style="height:50px;width:440px;"> 
                  <div id="Panel2" style="height:50px;width:125px;"> </div>
                </div>
 -->                <input type="hidden" name="hdCorr" id="hdCorr2" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina2" value="2" /> 
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
        
</form>

<?php
if ($_POST) {
 if(isset($_POST["cmd_aceptar"])) { 
//echo "grabar";
	$codpro_w  = $_POST["cmd_codpro"];
	$codart_w  = $_POST["cmd_codart"];
	$nomart_w = $_POST["cmd_nomart"];

	//empiezas las validaciones correspondientes 
	$error_w = FALSE;
	if (strlen($codpro_w) < "3") { 
		   echo "<script type=\"text/javascript\">document.getElementById('CodProMalo').style.display=''</script>";
		$error_w = TRUE;
		}
		
	//Consulto si existe el proveedor
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call CAM_PSEL_PROVEEDORES(null,null,null,'".$codpro_w."')";
	$result = mysqli_query($link,$consulta);
	$total_registros = mysqli_num_rows($result);
	mysqli_free_result($result);
	mysqli_close($link);
	if ($total_registros < 1) { 
		   echo "<script type=\"text/javascript\">document.getElementById('CodProMalo_2').style.display=''</script>";
		$error_w = TRUE;
		}
		
	if (strlen($codart_w) < "4") { 
		   echo "<script type=\"text/javascript\">document.getElementById('CodArtMalo').style.display=''</script>";
		$error_w = TRUE;
		}
				
	if ( $error_w )	
	  {
	  exit();
	  }
	else{//el ultimo else tiene que se el de tu insert into
		   
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);;

		$sql1 = "call cam_pupd_articulos('".$modo_w."','".$codpro_w."','".$codart_w."','".$nomart_w."')";

//echo $sql1;
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El articulo ya existe....." ;
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
				alert('El Artículo: \' $codpro_w \ $codart_w \' ha sido registrado de manera satisfactoria.');
				</script>";
				
   			mysqli_free_result($result); 
		    mysqli_close($link);

			}	

	   }//cierras todos los else que abras

	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";

 }
}
?>

</body>
</html>
