<?php
// Sistema			: ECO
// Programa			: ECO014_e.PHP
// Descripcion		: Informe Liquidación a excel.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 29/11/2010
?>

<?php
session_start();

require_once 'admin/config.php';

/*
$codigo_w  = $_GET["CODIGO"];
$pos1 = strpos($codigo_w, 'x');
$pos2 = strpos($codigo_w, 'y');

$rut_w    = substr($_GET["CODIGO"], 0, $pos1) ;
$fecha1_w = substr($_GET["CODIGO"], $pos1 + 1, 10) ;
$fecha2_w =  substr($_GET["CODIGO"], $pos2 + 1, 10) ;
*/
/*
echo $rut_w."<br/>";
echo $fecha1_w."<br/>";
echo $fecha2_w;
*/
/*
echo $_SESSION['medliq_s'];
echo $_SESSION['fliq1_s'];
echo $_SESSION['fliq2_s'];
*/
$rut_w    = $_SESSION['medliq_s'] ;
$fecha1_w = $_SESSION['fliq1_s'] ;
$fecha2_w = $_SESSION['fliq2_s'] ;

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="liquidacion.xls"');
header("Pragma: no-cache");
header("Expires: 0");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<head>
		<title>Liquidación</title>
	    
	</head>
<body >
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
		if ($_SESSION['tipo'] <> 'ADM')
		{
		echo "<script type=\"text/javascript\">
				alert('Usuario No Tiene Acceso......');
				</script>";
		exit();	
		}

	}  
}

	if ($rut_w == "0") {
		$rut_w = NULL;
		} 	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos consulta resumen prevision
    if (strlen($fecha1_w) == 0){
	  	$consulta="call ECO_PSEL_SOLIC_RES_PREV('".$rut_w."',null,null)";
        }
    elseif (strlen($fecha2_w) == 0) {
		$consulta="call ECO_PSEL_SOLIC_RES_PREV('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),null)";

	    }
	 else {
		$consulta="call ECO_PSEL_SOLIC_RES_PREV('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),STR_TO_DATE('".$fecha2_w."','%d/%m/%Y'))";

	    }
		
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '<td background="ivvpp/ivvpp0002.jpg" height="145" style="width: 34px"></td>';
	echo '	<td vAlign="top" align="center" width="700" height="145">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Center" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:700px;border-collapse:collapse;">';
	echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
	echo '	<th>Cantidad</th><th>Prevision</th><th>Total</th>';
	echo '</tr>';

	$canprev_w = 0; 
    $totprev_w = 0; 
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
  		  echo '<td align="center">'.$row["cantprev"].' </td>';
		  echo '<td>'.$row["nPrevision"].'</td>';
  		  echo '<td>'.$row["totexamen"].'</td>';
		  echo '</tr>';
		  $totprev_w += $row["totexamen"];
		  $canprev_w += $row["cantprev"];
    	}
		
	mysqli_free_result($result);
	mysqli_close($link);

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
  		  echo '</tr>';

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td align="center">'.$canprev_w.'</td>';
		  echo '<td></td>';
  		  echo '<td>'.$totprev_w.'</td>';
		  echo '</tr>';

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
  		  echo '</tr>';
		  
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
  //Ejecutamos consulta resumen fotos
    if (strlen($fecha1_w) == 0){
	  	$consulta="call ECO_PSEL_SOLIC_RES_FOT('".$rut_w."',null,null)";
        }
    elseif (strlen($fecha2_w) == 0) {
		$consulta="call ECO_PSEL_SOLIC_RES_FOT('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),null)";

	    }
	 else {
		$consulta="call ECO_PSEL_SOLIC_RES_FOT('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),STR_TO_DATE('".$fecha2_w."','%d/%m/%Y'))";

	    }
		
	$result=mysqli_query($link,$consulta);
	
//	echo '<TR>';
//	echo '<td background="ivvpp/ivvpp0002.jpg" height="145" style="width: 34px"></td>';
//	echo '	<td vAlign="top" align="center" width="500" height="145">';
 //   echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:454px;border-collapse:collapse;">';
	echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
	echo '	<td>Cantidad</td><td>Fotos</td><td>Total</td>';
	echo '</tr>';

    $totfot_w = 0; 
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
  		  echo '<td align="center">'.$row["cantbn"].'</td>';
		  echo '<td>Fotos B/N</td>';
  		  echo '<td>'.$row["totbn"].'</td>';
		  echo '</tr>';
		  $totfot_w += $row["totbn"]; 
    	}
	mysqli_free_result($result);
	mysqli_close($link);
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
  //Ejecutamos consulta resumen fotos
    if (strlen($fecha1_w) == 0){
	  	$consulta="call ECO_PSEL_SOLIC_RES_FOT('".$rut_w."',null,null)";
        }
    elseif (strlen($fecha2_w) == 0) {
		$consulta="call ECO_PSEL_SOLIC_RES_FOT('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),null)";

	    }
	 else {
		$consulta="call ECO_PSEL_SOLIC_RES_FOT('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),STR_TO_DATE('".$fecha2_w."','%d/%m/%Y'))";

	    }
		
	
	$result=mysqli_query($link,$consulta);
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
  		  echo '<td align="center">'.$row["cantcol"].'</td>';
		  echo '<td>Fotos Color</td>';
  		  echo '<td>'.$row["totcol"].'</td>';
		  echo '</tr>';
		  $totfot_w += $row["totcol"]; 
    	}
	mysqli_free_result($result);
	mysqli_close($link);


		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
  		  echo '</tr>';

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td></td>';
		  echo '<td></td>';
  		  echo '<td>'.$totfot_w.'</td>';
		  echo '</tr>';

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
  		  echo '</tr>';


	
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
  //Ejecutamos consulta detalle solicitudes
    if (strlen($fecha1_w) == 0){
	  	$consulta="call ECO_PSEL_SOLIC_LIQ('".$rut_w."',null,null)";
        }
    elseif (strlen($fecha2_w) == 0) {
		$consulta="call ECO_PSEL_SOLIC_LIQ('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),null)";

	    }
	 else {
		$consulta="call ECO_PSEL_SOLIC_LIQ('".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),STR_TO_DATE('".$fecha2_w."','%d/%m/%Y'))";

	    }
		
	$result=mysqli_query($link,$consulta);
	
//	echo '<TR>';
//	echo '<td background="ivvpp/ivvpp0002.jpg" height="145" style="width: 34px"></td>';
//	echo '	<td vAlign="top" align="center" width="500" height="145">';
//    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:454px;border-collapse:collapse;">';
	echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
	echo '	<td>Fecha</td><td>Paciente</td><td>Examen</td><td>Previsión</td><td>B/N</td><td>Color</td><td>Examen</td><td>Solicitado</td>';
	echo '</tr>';
  
    $stotbn_w = 0;
	$stotcol_w = 0;
	$stotex_w = 0;

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
  		  echo '<td>'.$row["fecha"].'</td>';
		  echo '<td>'.utf8_decode($row["npaciente"])." ".utf8_decode($row["ppaciente"])." ".utf8_decode($row["mpaciente"]).'</td>';
  		  echo '<td>'.$row["nExamen"].'</td>';
		  echo '<td>'.$row["nPrevision"].'</td>';
		  echo '<td>'.$row["totbn"].'</td>';
		  echo '<td>'.$row["totcol"].'</td>';
		  echo '<td>'.$row["vtotexamen"].'</td>';
		  echo '<td>'.$row["tsolicita"].'</td>';
		  echo '</tr>';
		  
		  $stotbn_w += $row["totbn"];
		  $stotcol_w += $row["totcol"];
		  $stotex_w += $row["vtotexamen"];

    	}
	mysqli_free_result($result);
	mysqli_close($link);

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		   echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
 		   echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
  		  echo '</tr>';

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td></td>';
		  echo '<td></td>';
		  echo '<td>Totales</td>';
		  echo '<td></td>';
  		  echo '<td>'.$stotbn_w.'</td>';
     	  echo '<td>'.$stotcol_w.'</td>';
		  echo '<td>'.$stotex_w.'</td>';
		  echo '<td></td>';
		  echo '</tr>';

		  echo '<tr style="color:#4A3C8C;" >'; 
  		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
		  echo '<td>&nbsp;</td>';
  		  echo '</tr>';

	
		
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table></P>	</td> </TR>';
	/*
	echo '			<TR>';
	echo '				<td background="ivvpp/ivvpp0002.jpg" height="10" style="width: 34px"></td>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '						align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" ><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" onClick="Enviar_Excell(&quot;'.$rut_w.'&quot;,&quot;'.$fecha1_w.'&quot;,&quot;'.$fecha2_w.'&quot;)"/></td>';
	echo '							<td style="WIDTH: 173px" align="center" ><input type="submit" name="Btt_excel" value="Excel" id="Btt_excel" class="boton" style="width:70px;" /></td>';
//	echo '							<td align="center"><input type="submit" name="Btt_aceptar" value="Aceptar" id="Btt_aceptar" class="boton" /></td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	*/
	echo '		</TABLE>';

?>



</body>
</HTML>
