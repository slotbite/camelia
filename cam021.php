<?php
// Sistema			: CAMELIA
// Programa			: CAM021.PHP
// Descripcion		: Agrega bancos al sistema.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 21/09/2011

session_start();

require_once 'admin/config.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ingreso de Bancos</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
			function fabre_ventana(iparamt,icoord){
			/*---------------------------*/
				pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
				pant_emp.location = iparamt
			}

		</script>
</head>
<?php
$cod_w = $_GET["COD"];
//echo $cod_w;
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
$_SESSION['cod_s'] = $cod_w ;

if (isset($_POST['cmd_nombre']))
{
	$nombre_w  = $_POST['cmd_nombre'];
	}
else
{
	$nombre_w  = "";
	}

$modo_w = "I";

if ($_POST) {
    $_SESSION['cod_s'] = $_POST['cmd_cod'];
}

//if ($_GET["COD"] > 0)
if ( strlen(trim( $_GET["COD"] )) > 0 )

{ 
    $modo_w = "M";
	if (!$_POST)
	{ 
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_bancos('".$cod_w."',null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nombre_w = $row["nomban"];
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
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 1px; position: absolute; top: 2px; height: 200px; width: 578px;" >
      <tr>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18">BANCOS</span></td>
            </tr>
        <td align="top" width="484"> <table width="562" height="115" border="0" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="text-align: left;">
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="100" style="width: 95px; height: 18px">&nbsp; <span id="Lb_identificador" style="display:inline-block;width:83px;">Código</span></td>
              <?php 
			
			 if (strlen(trim($cod_w)) == 0)
			 {
			   echo '<td style="width: 94px; height: 18px"> <input name="cmd_cod" type="text" maxlength="02" id="cmd_cod" class="input-normal" style="text-transform: uppercase;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$_SESSION["cod_s"].'" /> ';
			  }
			 else
			   { 
 			   echo '<td style="width: 94px; height: 18px"> <input name="cmd_cod" type="text" maxlength="02" id="cmd_cod" class="input-normal" style="text-transform: uppercase;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$_SESSION["cod_s"].'" readOnly="readonly"/> ';
  
              }
			  echo '<span id="CodMalo" style="color:Red;display:none;">* Código inválido</span> </td>';

              ?>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 2px">&nbsp;Nombre</td>
              <td width="424" style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" maxlength="30" id="cmd_nombre" class="input-normal" style="text-transform: uppercase;width:176px;" value="<?php echo $nombre_w; ?>"/> 
                &nbsp; <span id="NombreMalo" style="color:Red;display:none;">* Nombre inválido</span> </td>
            </tr>
             <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
             <td colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg" value="0" /> 
                <input type="hidden" name="hdCorr" id="hdCorr" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina" value="2" /> 
              </td>
            </tr>
          </table>
          <table id="Table3" align="center" border="0" cellpadding="1" cellspacing="1"
                        style="height: 8px; background-color: whitesmoke;" width="410">
                        <tr>
                            <td align="center" style="width: 126px">
                                <input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" style="width:70px;" /></td>
                            <td style="width: 45px">
                            </td>
                            <td align="center">
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

//	if (isset($_POST["cmd_rut"])){//1
	$cod_w    = $_POST["cmd_cod"];
	$nombre_w = $_POST["cmd_nombre"];

	//empiezas las validaciones correspondientes por ejemplo
	$error_w = FALSE;
	if (strlen($cod_w) < "1") { //que el cod sea mayor a 1
 	    echo "<script type=\"text/javascript\">document.getElementById('CodMalo').style.display=''</script>";
		exit();
		}
	if (strlen($nombre_w) == 0) { //que ingrese nombre
        echo "<script type=\"text/javascript\">document.getElementById('NombreMalo').style.display=''</script>";
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

		$sql1 = "call cam_pupd_bancos('".$modo_w."','".$cod_w."','".$nombre_w."')";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El banco ya existe....." ;
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
				alert('El Banco: \' $cod_w \' ha sido registrado de manera satisfactoria.');
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
