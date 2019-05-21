<?php
// Sistema			: CAM
// Programa			: CAM003.PHP
// Descripcion		: Mantención de proveedores.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 18/08/2011

session_start();

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ingreso de Provedores</title>
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

$codpro_w = $_GET["COD"];
//echo $_GET["COD"];
//echo $codpro_w;

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

// $fecnac_w = "";

if (isset($_POST['cmd_rutpro'])){
	$rutpro_w  = $_POST['cmd_rutpro'];
	}
else
{
	$rutpro_w  = "";
	}

if (isset($_POST['cmd_rasoc']))
{
	$rasoc_w  = $_POST['cmd_rasoc'];
	}
else
{
	$rasoc_w  = "";
	}

if (isset($_POST['cmd_nomfa']))
{
	$nomfa_w  = $_POST['cmd_nomfa'];
	}
else
{
	$nomfa_w  = "";
	}

if (isset($_POST['cmd_direcc']))
{
	$direcc_w  = $_POST['cmd_direcc'];
	}
else
{
	$direcc_w  = "";
	}

if (isset($_POST['cmd_ciudad']))
{
	$ciudad_w  = $_POST['cmd_ciudad'];
	}
else
{
	$ciudad_w  = "";
	}

if (isset($_POST['cmd_fono']))
{
	$fono_w  = $_POST['cmd_fono'];
	}
else
{
	$fono_w  = "";
	}


if (isset($_POST['cmd_fax']))
{
	$fax_w  = $_POST['cmd_fax'];
	}
else
{
	$fax_w  = "";
	}

if (isset($_POST['cmd_vendedor']))
{
	$vendedor_w  = $_POST['cmd_vendedor'];
	}
else
{
	$vendedor_w  = "";
	}

if (isset($_POST['cmd_comuna']))
{
	$comuna_w  = $_POST['cmd_comuna'];
	}
else
{
	$comuna_w  = "";
	}

if (isset($_POST['cmd_email']))
{
	$email_w  = $_POST['cmd_email'];
	}
else
{
	$email_w  = "";
	}
	
$modo_w = "I";

if ($_POST) {
    $_SESSION['codpro_s'] = $_POST['cmd_codpro'];
}

// if (strlen(trim($rut_w)) > 0)
if ( strlen(trim( $_GET["COD"] )) > 0 )
{ 
    $modo_w = "M";
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call CAM_PSEL_PROVEEDORES(null,null,null,'".$codpro_w."')";
	
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$rutpro_w = $row["rutpro"];
		$rasoc_w = $row["rasoc"];
		$nomfa_w = $row["nomfa"];
		$direcc_w = $row["direcc"];
		$ciudad_w   = $row["ciudad"];
		$fono_w = $row["fono"];
		$fax_w = $row["fax"];
 		$vendedor_w = $row["vendedor"];
		$comuna_w   = $row["comuna"];
		$email_w     = $row["email"];
		
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
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 3px; position: absolute; top: 6px; height: 479px; width: 611px;" width="590">
      <tr>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18">PROVEEDORES</span></td>
            </tr>
          <tr>
                
                
        <td align="center" height="100" width="591"> <table width="512" height="415" border="0" align="left" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
			            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>

            <tr> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; Código</td>
            <?php 
			
//			 if (strlen(trim($codigo_w)) == 0)
			 if ($modo_w == "I")
			 {
			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codpro" type="text" maxlength="3" id="cmd_codpro" class="input-normal" style="text-transform: uppercase; width:60px;"  value="'.$_SESSION["codpro_s"].'" /> ';
			  }
			 else
			   { 
 			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codpro" type="text" maxlength="3" id="cmd_codpro" class="input-normal" style="text-transform: uppercase; width:60px;""  value="'.$_SESSION["codpro_s"].'" readOnly="readonly"/> ';
  
              }
			  echo '<span id="CodMalo" style="color:Red;display:none;">* Código inválido</span> </td>';

              ?>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="131" style="width: 95px; height: 18px"> &nbsp; <span id="Lb_identificador" >Rut</span></td>
            <?php 
			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rutpro" type="text" maxlength="13" id="cmd_rutpro" class="input-normal" style="text-transform: uppercase; width:76px;" onchange="vRut()" value="'.$rutpro_w.'" /> ';
			  echo '<span id="RutMalo" style="color:Red;display:none;">* Rut inválido</span> </td>';
              ?>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr > 
              <td height="22" style="width: 95px; height: 2px">&nbsp; Razón Social</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_rasoc" stype="text" maxlength="30" id="cmd_rasoc" class="input-normal" style="width:176px;"  value="<?php echo $rasoc_w; ?>"/> 
                &nbsp; <span id="RequiredFieldValidator2" style="display:inline-block;color:Red;font-weight:bold;width:8px;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Nombre Fantasía</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_nomfa" type="text" maxlength="15" id="cmd_nomfa" class="input-normal" style="width:176px;" value="<?php echo $nomfa_w; ?>"/> 
                &nbsp; <span id="RequiredFieldValidator3" style="color:Red;font-weight:bold;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Dirección</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_direcc" type="text" maxlength="40" id="cmd_direcc" class="input-normal" style="width:314px;" value="<?php echo $direcc_w; ?>" /> 
                </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Ciudad</td>
		        <td style="width: 314px; height: 3px"> <input name="cmd_ciudad" type="text" maxlength="15" id="cmd_ciudad" class="input-normal" style="width:176px;" value="<?php echo $ciudad_w; ?>" /> 
                </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 3px"> &nbsp; Comuna</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_comuna" type="text" maxlength="15" id="cmd_comuna" class="input-normal" style="width:112px;" value="<?php echo $comuna_w; ?>"/> 
               </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>

            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Fono</td>
                <td style="width: 314px; height: 3px"> <input name="cmd_fono" type="text" maxlength="12" id="cmd_fono" class="input-normal" style="width:176px;" value="<?php echo $fono_w; ?>" /> 
                </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Fax</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_fax" type="text" maxlength="12" id="cmd_fax" class="input-normal" style="width:176px;" value="<?php echo $fax_w; ?>" /> 
               </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Vendedor </td>
              <td style="width: 314px; height: 3px"> <input name="cmd_vendedor" type="text" maxlength="20" id="cmd_vendedor" class="input-normal" style="width:312px;" value="<?php echo $vendedor_w; ?>" /> 
               </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Email</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_email" type="text" maxlength="60" id="cmd_email2" class="input-normal" style="width:176px;" value="<?php echo $email_w; ?>" /> 
                &nbsp; <span id="RegularExpressionValidator1" style="color:Red;visibility:hidden;">e-mail 
                no valido</span></td>
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
        
</form>

<?php
if ($_POST) {
 if(isset($_POST["cmd_aceptar"])) { 
//echo "grabar";
	$codpro_w    = $_POST["cmd_codpro"];
	$rutpro_w    = $_POST["cmd_rutpro"];
	$rasoc_w = $_POST["cmd_rasoc"];
	$nomfa_w = $_POST["cmd_nomfa"];
	$direcc_w = $_POST["cmd_direcc"];
	$ciudad_w   = $_POST["cmd_ciudad"];
	$fono_w = $_POST["cmd_fono"];
	$fax_w     = $_POST["cmd_fax"];
	$vendedor_w  = $_POST["cmd_vendedor"];
	$comuna_w  = $_POST["cmd_comuna"];
	$email_w     = $_POST["cmd_email"];

	//empiezas las validaciones correspondientes 
	$error_w = FALSE;
	if (strlen($codpro_w) < "3") { 
		   echo "<script type=\"text/javascript\">document.getElementById('CodMalo').style.display=''</script>";
		$error_w = TRUE;
		}
	if (strlen($rutpro_w) < "3") { 
		   echo "<script type=\"text/javascript\">document.getElementById('RutMalo').style.display=''</script>";
		$error_w = TRUE;
		}
				
	if ( $error_w )	
	  {
	  exit();
	  }
	else{//el ultimo else tiene que se el de tu insert into
		   
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);;

		$sql1 = "call cam_pupd_proveedores('".$modo_w."','".$codpro_w."','".$rutpro_w."','".$rasoc_w."','".$nomfa_w."','".$direcc_w."','".$ciudad_w."','".$fono_w."','".$fax_w."','".$vendedor_w."','".$comuna_w."','".$email_w."')";

//echo $sql1;
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El proveedor ya existe....." ;
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
				alert('El Proveedor: \' $codpro_w \' ha sido registrado de manera satisfactoria.');
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
