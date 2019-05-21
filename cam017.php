<?php
// Sistema			: CAMELIA
// Programa			: CAM017.PHP
// Descripcion		: Agrega habilitados al sistema.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 14/09/2011

session_start();

require_once 'admin/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ingreso de Habilitados</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
	function vRut(){
   	/*----------------------------------*/
		var variable = Form1.cmd_ruthab.value.substr(0,Form1.cmd_ruthab.value.indexOf("-"));
		var digit = Form1.cmd_ruthab.value.substr(Form1.cmd_ruthab.value.indexOf("-")+1).toUpperCase();
		
		if ( validaRut(variable,digit) == false )
			  { alert("Rut Invalido") 
			}
		Form1.cmd_ruthab.value = Form1.cmd_ruthab.value.toUpperCase();
		
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
$codhab_w = $_GET["COD"];
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
$_SESSION['codhab_s'] = $codhab_w ;

if (isset($_POST['cmd_nombre']))
{
	$nombre_w  = $_POST['cmd_nombre'];
	}
else
{
	$nombre_w  = "";
	}

if (isset($_POST['cmd_ruthab']))
{
	$ruthab_w  = $_POST['cmd_ruthab'];
	}
else
{
	$ruthab_w  = "";
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

if (isset($_POST['cmd_porcom']))
{
	$porcom_w  = $_POST['cmd_porcom'];
	}
else
{
	$porcom_w  = "";
	}
	
	
$modo_w = "I";

if ($_POST) {
    $_SESSION['codhab_s'] = $_POST['cmd_codhab'];
}

//echo 'COD '.$_GET["COD"];
if ( strlen(trim( $_GET["COD"] )) > 0 )
{
    $modo_w = "M";
	if (!$_POST)
	{ 
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_habilitados('".$codhab_w."',null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nombre_w = $row["nombre"];
		$ruthab_w = $row["ruthab"];
		$direcc_w = $row["direcc"];
		$ciudad_w = $row["ciudad"];
		$fono_w   = $row["fono"];
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
                    <span id="Label1" class="texto18">HABILITADOS</span></td>
            </tr>
          <tr>
        <td align="top" width="584"> <table width="574" height="175" border="0" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="text-align: left;">
            <tr> 
              <td width="100" style="width: 95px; height: 18px">&nbsp; <span id="Lb_identificador" style="display:inline-block;width:83px;">Código</span></td>
            <?php 
			if (strlen(trim($codhab_w)) == 0)
			 {
			   echo '<td style="width: 94px; height: 18px"> <input name="cmd_codhab" type="text" maxlength="03" id="cmd_codhab" class="input-normal" style="text-transform: uppercase;width:56px;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$_SESSION["codhab_s"].'" onchange="this.value = this.value.toUpperCase();"/> ';
			  }
			 else
			   { 
 			   echo '<td style="width: 94px; height: 18px"> <input name="cmd_codhab" type="text" maxlength="03" id="cmd_codhab" class="input-normal" style="text-transform: uppercase;width:56px;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$_SESSION["codhab_s"].'" readonly="readonly"/> ';
                }
			  echo '<span id="CodMalo" style="color:Red;display:none;">* Código inválido</span> </td>';
              ?>
            </tr>
            <tr> 
              <td> </td>
            </tr>
			<tr> 
              <td width="131" style="width: 95px; height: 18px"> &nbsp; Rut</td>
              <td width="365" style="width: 314px; height: 18px"> <input name="cmd_ruthab" type="text" maxlength="13" id="cmd_ruthab" class="input-normal" style="text-transform: uppercase; width:76px;" onchange="vRut()" value="<?php echo $ruthab_w; ?>" /> 
			  <span id="RutMalo" style="color:Red;display:none;">* Rut inválido</span> </td>
             </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 2px">&nbsp; Nombre</td>
              <td width="424" style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" maxlength="30" id="cmd_nombre" class="input-normal" style="text-transform: uppercase;width:176px;" value="<?php echo $nombre_w; ?>" onchange="this.value = this.value.toUpperCase();"/> 
                &nbsp; <span id="NombreMalo" style="color:Red;display:none;">* Nombre inválido</span> </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp;Dirección</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_direcc" type="text" maxlength="30" id="cmd_direccion" class="input-normal" style="text-transform: uppercase; width:176px;" value="<?php echo $direcc_w; ?>" onchange="this.value = this.value.toUpperCase();"/> 
                &nbsp; <span id="ApeMalo" style="color:Red;display:none;">* Dirección inválida</span> </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px">&nbsp;Ciudad</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_ciudad" type="text" maxlength="15" id="cmd_ciudad" class="input-normal" style="text-transform: uppercase; width:176px;" value="<?php echo $ciudad_w; ?>" onchange="this.value = this.value.toUpperCase();"/> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp;Fono</td>
 		        <td style="width: 314px; height: 3px"> <input name="cmd_fono" type="text" maxlength="10" id="cmd_fono" class="input-normal" style="width:176px;" value="<?php echo $fono_w; ?>" /> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td style="width: 135px; height: 3px"> &nbsp; % Comisión</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_porcom" type="text" maxlength="5" class="input-normal" id="cmd_porcom"  value="<?php echo $porcom_w; ?>" size="6" onKeypress="if ((event.keyCode < 46 || event.keyCode > 57) || event.keyCode == 47 ) event.returnValue = false;" /> 
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
          <table id="Table3" align="left" border="0" cellpadding="1" cellspacing="1"
                        style="height: 8px; background-color: whitesmoke;" width="410">
                        <tr>
                            <td align="center" style="width: 126px">
                                <input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" style="width:70px;" /></td>
                            <td style="width: 15px">
                            </td>
                            <td align="center" style="width: 126px">
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
</form>

<?php
if ($_POST) {
 if(isset($_POST["cmd_aceptar"])) { 
//echo "grabar";
	$codhab_w = $_POST["cmd_codhab"];
	$nombre_w = $_POST["cmd_nombre"];
	$ruthab_w = $_POST["cmd_ruthab"];
	$direcc_w = $_POST["cmd_direcc"];
	$ciudad_w = $_POST["cmd_ciudad"];
	$fono_w  = $_POST["cmd_fono"];
	$porcom_w  = $_POST["cmd_porcom"];

	//empiezas las validaciones correspondientes por ejemplo
	$error_w = FALSE;
	if (strlen($codhab_w) < "1") { 
 	    echo "<script type=\"text/javascript\">document.getElementById('CodMalo').style.display=''</script>";
		exit();
		}
	if (strlen($ruthab_w) < 3) { //que ingrese rut
        echo "<script type=\"text/javascript\">document.getElementById('RutMalo').style.display=''</script>";
		$error_w = TRUE;
		} 		

/*
	else{
	
	//mas validaciones
*/
    if ( $error_w )	
	  {
	   exit();
	  }

	else{//el ultimo else tiene que se el de tu insert into
	
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

		$sql1 = "call cam_pupd_habilitados('".$modo_w."','".$codhab_w."','".$ruthab_w."','".$nombre_w."','".$direcc_w."','".$ciudad_w."','".$fono_w."','".$porcom_w."')";
//echo $sql1;
//mysqli_close($link);
//exit();
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El habilitado ya existe....." ;
				} 
				
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();

			}
		else
		   {
			echo "<script type=\"text/javascript\">
				alert('El Habilitado: \' $codhab_w \' ha sido registrado de manera satisfactoria.');
				</script>";
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
