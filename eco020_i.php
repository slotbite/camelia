<?php
// Sistema			: ECO
// Programa			: eco020_i.PHP
// Descripcion		: Imprime Exámen EcoPelviana Femenina.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 07/11/2010

session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Imprime Ecotomografia Pelviana</title>
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
	$consulta="call ECO_PSEL_ECOPELVIFEM('".$codigo_w."',null,null,null,null,null)";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nompac_w = $row["npaciente"] ." ". $row["ppaciente"]." ". $row["mpaciente"];
		$rutpac_w = $row["rutpaciente"];
		$fecha_w = $row["fecha"];
		$vejiga_w     = $row["tvejiga"];
		$utero_w  	  = $row["tutero"];
		$ovarioizq_w  = $row["tovarioizq"];
		$ovarioder_w  = $row["tovarioder"];
		$douglas_w    = $row["tdouglas"];
		$conclusion_w = $row["tconclusion"];
		$medico_w 	  = $row["rutmedico"];
		$nommed_w = $row["nmedico"] ." ". $row["pmedico"]." ". $row["mmedico"];
		$rutmed_w = $row["rutmedico"];
		$especial_w = $row["nEspecial"];

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

</table>
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; position: absolute; height: 468px; " width="750">
      <tr> 
        <td  colspan="2" style="height: 24px"  width="500" align="center" valign="bottom"> <span id="Label1" class="texto18"> 
          ECOTOMOGRAFÍA - PELVIANA</span></td>
      </tr>
      <tr> 
        <td colspan="2" align="center" height="100" width="480"> 
		<table width="512" height="387" border="0" align="center" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Código</td>
              <td width="365" style="width: 314px; height: 3px"> 
                <?php echo $codigo_w; ?>
              </td>
            </tr>
            <tr style="color: #000000"> </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Nombre</td>
              <td width="365" style= "height: 3px"> 
                <?php echo $nompac_w ?>
              </td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 18px"> &nbsp; Rut</td>
              <td style="width: 314px; height: 18px"> 
                <?php echo $rutpac_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 18px">&nbsp; Fecha Examen</td>
              <td style="width: 314px; height: 18px"> 
                <?php echo $fecha_w; ?>
              </td>
            </tr>
           
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> VEJIGA</td>
              <td style="width: 514px; height: 3px"> 
                <?php echo $vejiga_w; ?>
              </td>
            </tr>
			 <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td style="width: 95px; height: 3px"> UTERO</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $utero_w; ?>
              </td>
            </tr>
			 <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 115px; height: 2px"> OVARIO IZQUIERDO</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $ovarioizq_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			 <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td style="width: 115px; height: 3px"> OVARIO DERECHO</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $ovarioder_w; ?>
              </td>
            </tr>
			 <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> DOUGLAS</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $douglas_w; ?>
              </td>
            </tr>
			 <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
			 <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
			 <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			 <tr> 
              <td style="width: 105px; height: 2px;text-decoration: underline;" colspan="2" class="txtngr"> CONCLUSION</td>
            </tr>
			<tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
			 <tr> 
              <td style="width: 314px; height: 3px" colspan="2"> 
                <?php echo $conclusion_w; ?>
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
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="27" style="width: 105px; height: 2px">&nbsp;  </td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $nommed_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"></td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $rutmed_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"></td>
              <td style="width: 314px; height: 3px"> 
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
