<?php
// Sistema			: ECO
// Programa			: eco022_i.PHP
// Descripcion		: Imprime Exámen Ecogafría Renal.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 09/11/2010

session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Imprime Ecogafría Renal</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
		function f_imprimir(){
        /*-----------------------------------*/
			window.print()
			        }
				
		</script>
</head>
<?php
require_once 'admin/config.php';

$codigo_w = $_GET["CODIGO"];
// echo $codigo_w;
?>

<body onload="f_imprimir()">
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1"  >
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

/// trae datos del examen
if ($codigo_w > 0)
{ 
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_ECORENAL('".$codigo_w."',null,null,null,null,null)";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nompac_w = $row["npaciente"] ." ". $row["ppaciente"]." ". $row["mpaciente"];
		$rutpac_w = $row["rutpaciente"];
		$fecha_w = $row["fecha"];
		$rderecho_w    = $row["trderecho"];
		$rizquierdo_w  = $row["trizquierdo"];
		$detalle_w     = $row["tdetalle"];
		$diagnostica_w = $row["tdiagnostica"];
		$medico_w 	  = $row["rutmedico"];
		$nommed_w = trim($row["nmedico"] ." ". $row["pmedico"]." ". $row["mmedico"]);
		$rutmed_w = trim($row["rutmedico"]);
		$especial_w = trim($row["nEspecial"]);

		}
	mysqli_free_result($result);
	mysqli_close($link);
}
?>
	   
  <div> 
  
  <table width="300" border="0" cellspacing="0" cellpadding="0" class="texto11">
  <tr>
    <td><?php echo 'ECOCENTRO   LTDA.';?></td>
  </tr>
  <tr>
      <td><?php echo 'EDIFICIO PROSALUD';?></td>
  </tr>
  <tr>
     <td><?php echo '14 NORTE 571 OF.323 – 324';?></td>
  </tr>
  <tr>
    <td><?php echo 'FONO 2686062 – 2691645';?></td>
  </tr>
  <tr>
     <td><?php echo 'VIÑA DEL MAR';?></td>
  </tr>
</table>
<!--
  <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 41px; position: absolute; top: 134px; height: 468px; width: 756px;" width="510">
-->  
  <table id="Table1" border="0" cellpadding="0" cellspacing="0"  style="z-index: 101; position: absolute; top: 134px; " width="710">

      <tr> 
        <td style="height: 24px" width="500"  align="center" valign="bottom"> <span id="Label1" class="texto18"> 
          ECOGRAFÍA - RENAL</span></td>
      </tr>
      <tr> 
        <td height="100" width="780"> 
		<table width="712" height="387" border="0" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
			<tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
			<tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> </tr>
            <tr style="color: #000000"> 
              <td width="95" height="25" >Código</td>
              <td colspan="2" width="365" style="width: 314px; height: 3px"> 
			  <?php echo $codigo_w; ?>
              </td>
            </tr>
            <tr style="color: #000000"> </tr>
            <tr style="color: #000000"> 
              <td height="25" style="width: 95px; height: 2px">Nombre</td>
              <td  colspan="2" width="365" style= "height: 3px"> 
                <?php echo $nompac_w ?>
              </td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 18px">Rut</td>
              <td  colspan="2" style="width: 314px; height: 18px"> 
                <?php echo $rutpac_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 18px">Fecha Exámen</td>
              <td  colspan="2" style="width: 314px; height: 18px"> 
                <?php echo $fecha_w; ?>
              </td>
            </tr>
           
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="3" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 150px; height: 2px;text-decoration: underline;"> RIÑÓN DERECHO</td>
              <td  colspan="2" style="width: 414px; height: 3px"> 
                <?php echo $rderecho_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
			 <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td style="width: 150px; height: 3px;text-decoration: underline;"> RIÑÓN IZQUIERDO</td>
              <td colspan="2"  style="width: 414px; height: 3px"> 
                <?php echo $rizquierdo_w; ?>
              </td>
            </tr>
			 <tr> 
              <td colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td  colspan="3" style="width: 614px; height: 3px"> 
                <?php echo $detalle_w; ?>
              </td>
            </tr>
			 <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
			 <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
			 <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
			 <tr> 
              <td  align="center" style="width: 500px; height: 2px;text-decoration: underline;" colspan="3" class="txtngr"> IMPRESIÓN DIAGNÓSTICA</td>
            </tr>
			<tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
			 <tr> 
              <td style="width: 314px; height: 3px" colspan="3"> 
                <?php echo $diagnostica_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="3" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td  colspan="3" style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
			<td  height="37" style="width: 100px; height: 2px">&nbsp;</td>
		     <td   align="center" style="width: 400px; height: 3px"> 
                <?php echo $nommed_w; ?>
              </td>
			 <td></td> 
            </tr>
            <tr> 
	  		  <td  height="37" style="width: 100px; height: 2px">&nbsp;</td>
              <td  align="center" style="width: 400px; height: 3px" > 
                <?php echo $rutmed_w; ?>
              </td>
            </tr>
            <tr> 
	  		  <td  height="37" style="width: 200px; height: 2px">&nbsp;</td>
              <td  align="center" style="width: 400px; height: 3px"> 
                <?php echo $especial_w; ?>
              </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
    <br/>
        <br/>
    
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
   
</form>

</body>
</html>
