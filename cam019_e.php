<?php
// Sistema			: CAMELIA
// Programa			: CAM019_e.PHP
// Descripcion		: Elimina instituciones al sistema.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 03/10/2011

session_start();

require_once 'admin/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Eliminación de Instituciones</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
		
			function fabre_ventana(iparamt,icoord){
			/*---------------------------*/
				pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
				pant_emp.location = iparamt
			}

			function f_elimina(){
    	    /*-------------------*/
				  if(confirm('¿Está Seguro de Eliminar?'))
				     {
				     document.Form1.hdElimina.value = "E";
					 document.Form1.submit();
		     	     }
				  else{
  					 document.getElementById('hdElimina').Value = "";
					 window.close()
				   }  
              }


		</script>
</head>
<?php
$codins_w = $_GET["COD"];
//echo $codven_w;
?>

<body class="pantalla_normal">
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
$_SESSION['codins_s'] = $codins_w ;

$nombre_w  = "";
$rutins_w  = "";
$direcc_w  = "";
$ciudad_w  = "";
$fono_w  = "";
$fax_w  = "";
$porcom_w  = "";
	
$modo_w = "E";

//echo 'COD '.$_GET["COD"];
if ( strlen(trim( $_GET["COD"] )) > 0 )
{
	if (!$_POST)
	{ 
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_instituciones('".$codins_w."',null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nombre_w = $row["nombre"];
		$rutins_w = $row["rutins"];
		$direcc_w = $row["direcc"];
		$ciudad_w = $row["ciudad"];
		$fono_w   = $row["fono"];
		$fax_w   = $row["fax"];
		$porcom_w = $row["porcom"];
		}
	mysqli_free_result($result);
	mysqli_close($link);
	}
}
?>
<script type="text/javascript">

var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}

</script>
    <div>
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 1px; position: absolute; top: 2px; height: 300px; width: 606px;" >
      <tr>
            <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18">ELIMINA INSTITUCIONES</span></td>
            </tr>
          <tr>
        <td align="top" width="584"> <table width="484" height="175" border="0" cellpadding="0" cellspacing="0" class="texto11" id="Table2"
                        style="text-align: left;">
            <tr> 
              <td width="100" style="width: 95px; height: 18px">&nbsp; <span id="Lb_identificador" style="display:inline-block;width:83px;">Código</span></td>
            <?php 
			   echo '<td style="width: 94px; height: 18px"> <input name="cmd_codins" type="text" maxlength="03" id="cmd_codins" class="input-normal" style="text-transform: uppercase;width:56px;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$_SESSION["codins_s"].'" readonly="readonly"/> ';
              ?>
            </tr>
            <tr> 
              <td> </td>
            </tr>
			<tr> 
              <td width="131" style="width: 95px; height: 18px"> &nbsp; Rut</td>
              <td width="365" style="width: 314px; height: 18px"> <input name="cmd_rutins" type="text" maxlength="13" id="cmd_rutins" class="input-normal" style="text-transform: uppercase; width:76px;" onchange="vRut()" value="<?php echo $rutins_w; ?>" readonly="readonly"/> 
			  <span id="RutMalo" style="color:Red;display:none;">* Rut inválido</span> </td>
             </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 2px">&nbsp; Nombre</td>
              <td width="424" style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" maxlength="30" id="cmd_nombre" class="input-normal" style="text-transform: uppercase;width:176px;" value="<?php echo $nombre_w; ?>" onchange="this.value = this.value.toUpperCase();" readonly="readonly"/> 
                &nbsp; <span id="NombreMalo" style="color:Red;display:none;">* Nombre inválido</span> </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp;Dirección</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_direcc" type="text" maxlength="30" id="cmd_direccion" class="input-normal" style="text-transform: uppercase; width:176px;" value="<?php echo $direcc_w; ?>" onchange="this.value = this.value.toUpperCase();" readonly="readonly"/> 
                &nbsp; <span id="ApeMalo" style="color:Red;display:none;">* Dirección inválida</span> </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px">&nbsp;Ciudad</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_ciudad" type="text" maxlength="15" id="cmd_ciudad" class="input-normal" style="text-transform: uppercase; width:176px;" value="<?php echo $ciudad_w; ?>" onchange="this.value = this.value.toUpperCase();" readonly="readonly"/> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp;Fono</td>
 		        <td style="width: 314px; height: 3px"> <input name="cmd_fono" type="text" maxlength="10" id="cmd_fono" class="input-normal" style="width:176px;" value="<?php echo $fono_w; ?>" readonly="readonly"/> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp;Fax</td>
 		        <td style="width: 314px; height: 3px"> <input name="cmd_fax" type="text" maxlength="10" id="cmd_fax" class="input-normal" style="width:176px;" value="<?php echo $fax_w; ?>" readonly="readonly"/> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td style="width: 135px; height: 3px"> &nbsp; % Comisión</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_porcom" type="text" maxlength="5" class="input-normal" id="cmd_porcom"  value="<?php echo $porcom_w; ?>" size="6" onKeypress="if ((event.keyCode < 46 || event.keyCode > 57) || event.keyCode == 47 ) event.returnValue = false;" readonly="readonly"/> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            <tr> 
              <td colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg" value="0" /> 
                <input type="hidden" name="hdCorr" id="hdCorr" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina" value="2" /> 
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
    

<div>
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
	    <input type="hidden" name="hdElimina" id="hdElimina" />

</div>
</form>

<?php
if (!$_POST)
{
echo "<script type=\"text/javascript\">f_elimina();</script>";
}

if ($_POST) {
	$codins_w = $_POST["cmd_codins"];
	$nombre_w = $_POST["cmd_nombre"];
	$rutins_w = $_POST["cmd_rutins"];
	$direcc_w = $_POST["cmd_direcc"];
	$ciudad_w = $_POST["cmd_ciudad"];
	$fono_w  = $_POST["cmd_fono"];
	$fax_w  = $_POST["cmd_fax"];
	$porcom_w  = $_POST["cmd_porcom"];

 	$elim_w = $_POST["hdElimina"];
//	echo 'elim: '. $elim_w ;
	if ($elim_w == "E"){

		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

		$sql1 = "call cam_pupd_instituciones('".$modo_w."','".$codins_w."','".$rutins_w."','".$nombre_w."','".$direcc_w."','".$ciudad_w."','".$fono_w."','".$fax_w."','".$porcom_w."')";
//echo $sql1;
//mysqli_close($link);
//exit();
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1451)
			    {
				$merror = "La institución tiene movimientos asociados....." ;
				} 
				
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();

			}
  		

	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";

 }
}
?>

</body>
</html>
