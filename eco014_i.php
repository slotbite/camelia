<?php
// Sistema			: ECO
// Programa			: eco014_i.PHP
// Descripcion		: Imprime Informe Liquidación.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 30/11/2010

session_start();
require_once 'admin/config.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<head><title>Imprime Informe Liquidación</title>
<META content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
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

$codigo_w  = $_GET["CODIGO"];
$pos1 = strpos($codigo_w, 'x');
$pos2 = strpos($codigo_w, 'y');

$rut_w    = substr($_GET["CODIGO"], 0, $pos1) ;
$fecha1_w = substr($_GET["CODIGO"], $pos1 + 1, 10) ;
$fecha2_w =  substr($_GET["CODIGO"], $pos2 + 1, 10) ;
$nombre_w = "Todos";
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

//rescata nombre medico

if ($rut_w <> 0 ){
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query="call ECO_PSEL_MEDICOS(null,null,'".$rut_w."')";
	
	$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);
	
	while($registro=mysqli_fetch_array($r))
	{    
         $nombre_w= $registro[2]." ".$registro[3]." ".$registro[1];
		
	}
	
	mysqli_close($link);

}
?>
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

<?php
//echo "<table border=0> ";
?>
 <table align="center" > 
 <tr> 
        <td style="width: 34px; height: 24px"> </td>
        <td style="height: 24px" valign="bottom"> <span id="Label1" class="texto18"> 
          LIQUIDACION</span></td>
      </tr>
	  <tr>
         <td colspan="2" style="width: 381px; height: 14px"> </td>
       </tr>
 </table>
<?php
echo "<table align=center border=1> ";	  
echo "<tr> ";
echo "<th>Rut Medico</th> ";
echo "<th>Nombre Medico</th> ";
echo "<th>Desde</th> ";
echo "<th>Hasta</th> ";
echo "</tr> ";
echo "<tr> ";
echo "<td>".$rut_w."</font></td> ";
echo "<td>".$nombre_w."</font></td> ";
echo "<td>".$fecha1_w ."</td> ";
echo "<td>".$fecha2_w ."</td> ";
echo "</tr> ";
echo "</table> ";
 
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
	echo '<td height="145" style="width: 34px"></td>';
	echo '	<td vAlign="top" align="center" width="400" height="145">';
    echo '		<P><table class="texto13" cellspacing="0" cellpadding="3" align="Center" rules="rows" border="0" id="dgrid" style="height:20px;width:400px;">';
	echo '<tr >';
	echo '	<th>Cantidad</th><th>Prevision</th><th>Total</th>';
	echo '</tr>';

	$canprev_w = 0; 
    $totprev_w = 0; 
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr >'; 
  		  echo '<td align="center">'.$row["cantprev"].' </td>';
		  echo '<td align="center">'.$row["nPrevision"].'</td>';
  		  echo '<td align="right">'.number_format($row["totexamen"],0, ',', '.').'</td>';
		  echo '</tr>';
		  $totprev_w += $row["totexamen"];
		  $canprev_w += $row["cantprev"];
    	}
		
	mysqli_free_result($result);
	mysqli_close($link);
		  echo '<tr >'; 
  		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
  		  echo '</tr>';

		  echo '<tr >'; 
  		  echo '<td align="center">'.number_format($canprev_w,0, ',', '.').'</td>';
		  echo '<td></td>';
  		  echo '<td align="right">'.number_format($totprev_w,0, ',', '.').'</td>';
		  echo '</tr>';

		  echo '<tr >'; 
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
	echo '<tr >';
	echo '	<th>Cantidad</th><th>Fotos</th><th>Total</th>';
	echo '</tr>';

    $totfot_w = 0; 
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr >'; 
  		  echo '<td align="center">'.number_format($row["cantbn"],0, ',', '.').'</td>';
		  echo '<td align="center">Fotos B/N</td>';
  		  echo '<td align="right">'.number_format($row["totbn"],0, ',', '.').'</td>';
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
		  echo '<tr >'; 
  		  echo '<td align="center">'.number_format($row["cantcol"],0, ',', '.').'</td>';
		  echo '<td align="center">Fotos Color</td>';
  		  echo '<td align="right">'.number_format($row["totcol"],0, ',', '.').'</td>';
		  echo '</tr>';
		  $totfot_w += $row["totcol"]; 
    	}
	mysqli_free_result($result);
	mysqli_close($link);


		  echo '<tr >'; 
  		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
  		  echo '</tr>';

		  echo '<tr >'; 
  		  echo '<td></td>';
		  echo '<td></td>';
  		  echo '<td align="right">'.number_format($totfot_w,0, ',', '.').'</td>';
		  echo '</tr>';

		  echo '<tr >'; 
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
   echo '<P><table class="texto09" cellspacing="0" cellpadding="3" align="center" rules="rows" border="0" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:654px;border-collapse:collapse;">';

	echo '<tr >';
	echo '	<th>Fecha</th><th>Paciente</th><th>Examen</th><th>Previsión</th><th>B/N</th><th>Color</th><th>Examen</th><th>Solicitado</th>';
	echo '</tr>';
  
    $stotbn_w = 0;
	$stotcol_w = 0;
	$stotex_w = 0;

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr >'; 
  		  echo '<td>'.$row["fecha"].'</td>';
		  echo '<td>'.utf8_decode($row["npaciente"])." ".utf8_decode($row["ppaciente"])." ".utf8_decode($row["mpaciente"]).'</td>';
  		  echo '<td>'.$row["nExamen"].'</td>';
		  echo '<td>'.$row["nPrevision"].'</td>';
		  echo '<td>'.number_format($row["totbn"],0, ',', '.').'</td>';
		  echo '<td>'.number_format($row["totcol"],0, ',', '.').'</td>';
		  echo '<td>'.number_format($row["vtotexamen"],0, ',', '.').'</td>';
		  echo '<td>'.$row["tsolicita"].'</td>';
		  echo '</tr>';
		  
		  $stotbn_w += $row["totbn"];
		  $stotcol_w += $row["totcol"];
		  $stotex_w += $row["vtotexamen"];

    	}
	mysqli_free_result($result);
	mysqli_close($link);

		  echo '<tr >'; 
  		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		   echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
 		   echo '<td><HR width=100%></HR></td>';
		  echo '<td><HR width=100%></HR></td>';
  		  echo '</tr>';

		  echo '<tr>'; 
  		  echo '<td></td>';
		  echo '<td></td>';
		  echo '<td>Totales</td>';
		  echo '<td></td>';
  		  echo '<td>'.number_format($stotbn_w,0, ',', '.').'</td>';
     	  echo '<td>'.number_format($stotcol_w,0, ',', '.').'</td>';
		  echo '<td>'.number_format($stotex_w,0, ',', '.').'</td>';
		  echo '<td></td>';
		  echo '</tr>';
		
    echo '</table>';
    echo '</table></P>	</td> </TR>';
    	
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
