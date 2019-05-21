<?php
// Sistema			: CAMELIA
// Programa			: CAM030_i.PHP
// Descripcion		: Imprime Ventas x Fecha.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 06/12/2012

session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Imprime Ventas x Fecha</title>
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";

  		function f_imprimir(){
        /*--------------------*/
			window.print()
			        }

 
	    </script>
	    
	    
	</head>
<?php
$codigo_w  = $_GET["CODIGO"];
$pos1 = strpos($codigo_w, ',');

$cod_w = substr($_GET["CODIGO"], 0, $pos1) ;
$fecha1_w = substr($_GET["CODIGO"], $pos1 + 1, 10) ;
$fecha2_w = substr($_GET["CODIGO"], $pos1 + 12, 10) ;
//echo 'local:' . $cod_w;
//echo 'fecha1:' . $fecha1_w;
//echo 'fecha2:' . $fecha2_w;

?>

<body onload="f_imprimir()">
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" id="Form1">
<?php
if (!$_POST)
/*
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
		if (($_SESSION['tipo'] <> 'ADM') and ($opc2_w <> 'C'))
		{
		echo "<script type=\"text/javascript\">
				alert('Usuario No Tiene Acceso......');
				</script>";
		exit();	
		}

	}  
}
*/
?>
  <table width="300" border="0" cellspacing="0" cellpadding="0" class="texto11">
  <tr>
    <td><?php echo 'CAMELIA CUEROS';?></td>
  </tr>
</table>

 <table align="center"> 
  <tr> <td><span id="Label1" class="texto18_i" >INFORME VENTAS X FECHA</span></td>
 </tr>
 </table>
 
 <table class="texto11">
 <tr>
 </tr>
 <tr >
 </tr>
  <tr >
 </tr>
 <tr >
     <td><?php echo 'Fecha: ' . date("d/m/Y");?> </td>
      <td><?php echo 'Hora: ' . date("H:i:s");?> </td>
 </tr>

 </table>

<?php	
    $atran = array("Consulta","Venta","Cambio","Devolución","Separado","Abono Separado","Dev. Separado","Ent. Separado","Personal","Anulación");

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_vtasxfecha('".$cod_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),STR_TO_DATE('".$fecha2_w."','%d/%m/%Y'))";
//echo $consulta;
	$result=mysqli_query($link,$consulta);
	
//    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';
	echo '<tr>';
	echo '<td>NºVale</td><td></td><td></td><td>Vendedor</td><td>Nulo</td><td>Total</td><td>F.Pago</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nul = "";
		if ($row["activo"] <> "S")
		  {$nul = "NULO";}

		$fpago = "";
		if ($row["cantfp"] > 1)
		  {$fpago = "MIXTO";}
		elseif ($row["fpago"] > 5)
		  {$fpago = "CREDITO";}
		else
		  {$fpago = "CONTADO";}
		  
		//		echo '<tr style="background-color:#F7F7F7;">';
		echo '<tr>';
		echo '<td>'.$row["numtra"].'</td>';
		echo '<td>'.$atran[ $row["transa"] - 1].'</td>';
 		echo '<td>'.$row["codven"].'</td>';
		echo '<td>'.utf8_decode($row["nomven"]).'</td>';
		echo '<td>'.$nul.'</td>';
		echo '<td>'.$row["total"].'</td>';
//		echo '<td>'.$row["cantfp"].'</td>';
		echo '<td>'.$fpago.'</td>';
//		echo '<td>'.$row["fpago"].'</td>';
		echo '</tr>';
    	}
		
	echo '<tr class="texto01" align="center" >';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table></P>	';


	mysqli_free_result($result);
	mysqli_close($link);


?>
  <div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdCodLoc" id="hdCodLoc" />
  </div>

</form>

</body>
</HTML>
