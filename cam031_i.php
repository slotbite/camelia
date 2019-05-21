<?php
// Sistema			: CAMELIA
// Programa			: CAM031_i.PHP
// Descripcion		: Imprimir Cuadratura de Caja.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 30/11/2012

session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Imprime Cuadratura de Caja</title>
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
$fecha_w = substr($_GET["CODIGO"], $pos1 + 1, 10) ;
//echo 'cod:' . $codigo_w;

?>

<body onload="f_imprimir()">
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" id="Form1">
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
  <tr> <td><span id="Label1" class="texto18_i" >INFORME CUADRATURA DE CAJA</span></td>
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
    $atran = array("Contado Efectivo","Contado Documentado","Cheque a Fecha","CR-Camelia","Tarjetas de Crédito ","Habilitado","Instituciones","Créditos Particulares");

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call cam_psel_vtasxfpago('".$cod_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'))";
//echo $consulta;
	$result=mysqli_query($link,$consulta);
	
    echo '<P><table class="texto09" cellspacing="0" cellpadding="3" align="center" rules="rows" border="0" id="dgrid" style="background-color:White;border-width:1px;border-style:None;height:20px;width:400px;border-collapse:collapse;">';
    echo '<tr>'; 
	echo '	<th>FORMA DE PAGO</th><th>INGRESOS</th><th>EGRESOS</th><th>Total</th>';
	echo '</tr>';

    $toting = 0;
	$tottot = 0;
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		//		echo '<tr style="background-color:#F7F7F7;">';
		echo '<tr>';
		echo '<td>'.$atran[ $row["fpago"] - 1].'</td>';
		echo '<td>'.number_format($row["totfp"]).'</td>';
		echo '<td> </td>';
		echo '<td>'.number_format($row["totfp"]).'</td>';
		echo '</tr>';
		
    $toting += $row["totfp"];
	$tottot += $row["totfp"];

    	}
	mysqli_free_result($result);
	mysqli_close($link);

	echo '<tr>';
		echo '<tr>';
		echo '<td>Totales</td>';
		echo '<td>'.number_format($toting).'</td>';
		echo '<td> </td>';
		echo '<td>'.number_format($tottot).'</td>';
		echo '</tr>';
    echo '</table></P>';

     $valini = 0;
     $valfin = 0;
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call cam_psel_num_vales('".$cod_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'))";
//echo $consulta;
	$result=mysqli_query($link,$consulta);
	while ($row=mysqli_fetch_array($result))
		{
			$valini = $row["valini"];
			$valfin = $row["valfin"];
	
    	}
	mysqli_free_result($result);
	mysqli_close($link);

    echo '<P><table class="link10" cellspacing="0" cellpadding="3" align="center" rules="rows" border="0" id="dgrid" style="background-color:White;border-width:1px;border-style:None;height:20px;width:300px;border-collapse:collapse;">';

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call cam_psel_vtasxtipo('".$cod_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'))";
	$result=mysqli_query($link,$consulta);
	while ($row=mysqli_fetch_array($result))
		{
		echo '<tr>';
		if ($row["activo"] == "S")
		{
			echo '<td> Vales Emitidos : </td>';
			echo '<td>'.$row["totval"].'</td>';
			echo '<td> del '.$valini.'</td>';
			echo '<td> al '.$valfin.'</td>';

		}
        else
		{
			echo '<td> Vales Anulados : </td>';
			echo '<td>'.$row["totval"].'</td>';

		}
		echo '</tr>';
	
    	}
	mysqli_free_result($result);
	mysqli_close($link);
	
    echo '</table></P>';
	
	
    $atran = array("Consulta","Venta","Cambio","Devolución","Separado","Abono Separado","Dev. Separado","Ent. Separado","Personal","Anulación");

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call cam_psel_vtasxtransa('".$cod_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'))";
	$result=mysqli_query($link,$consulta);
	
    echo '<P><table class="link10" cellspacing="0" cellpadding="3" align="Center" rules="rows" border="2" id="dgrid" style="background-color:White;border-width:1px;border-style:None;height:20px;width:300px;border-collapse:collapse;">';
	echo '<tr>';
	echo '<td>TIPO VALE</td><td>CANTIDAD</td><td>MONTO</td>';
	echo '</tr>';

	$tcant = 0;
	$tmonto = 0;
	$cantper = 0;
	$monper = 0;
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		if ($row["transa"] == 9)  //personal
     		{
			$cantper += $row["cant"];
			$monper += $row["total"];
			}
		else
     		{
			$tcant += $row["cant"];
			$tmonto += $row["total"];
			}
		  
		//		echo '<tr style="background-color:#F7F7F7;">';
		echo '<tr>';
		echo '<td>'.$atran[$row["transa"] - 1].'</td>';
 		echo '<td>'.$row["cant"].'</td>';
		echo '<td>'.number_format($row["total"]).'</td>';
		echo '</tr>';
    	}

	
		echo '<tr>';
		echo '<td>Totales</td>';
		echo '<td>'.$tcant.'</td>';
		echo '<td>'.number_format($tmonto).'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Vales Personal</td>';
		echo '<td>'.$cantper.'</td>';
		echo '<td>'.number_format($monper).'</td>';
		echo '</tr>';

    echo '</table></P>';

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
