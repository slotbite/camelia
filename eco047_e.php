<?php
require_once 'admin/config.php';

$codigo_w  = $_GET["COD"];
//echo $codigo_w;
//exit();

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

/*
$pos1 = strpos($codigo_w, 'x');
$pos2 = strpos($codigo_w, 'y');

$rut_w    = substr($_GET["CODIGO"], 0, $pos1) ;
$fecha1_w = substr($_GET["CODIGO"], $pos1 + 1, 10) ;
$fecha2_w =  substr($_GET["CODIGO"], $pos2 + 1, 10) ;
$nombre_w = "Todos";
*/

//rescata nombre medico

$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$consulta="call ECO_PSEL_LIQUIDACIONES('".$codigo_w."',null,null,null)";

$result=mysqli_query($link,$consulta);
while ($row=mysqli_fetch_array($result))
	{
	$rut_w  = $row["rmedico"];
	$nombre_w  = $row["enmedico"]." ".$row["epmedico"]." ".$row["emmedico"];
	$fecha1_w  = $row["fdesde"];
	$fecha2_w  = $row["fhasta"];
	}
		
mysqli_free_result($result);
mysqli_close($link);

echo "<table border=1> ";
echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
echo "<th>LIQUIDACION APROBADA Nº ".$codigo_w." </th> ";
echo "</tr> ";
echo "<tr></tr> ";
echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
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
 
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos consulta resumen prevision
  	$consulta="call ECO_PSEL_SOLIC_RES_PREV_LIQ('".$codigo_w."')";
	
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
   $consulta="call ECO_PSEL_SOLIC_RES_FOT_LIQ('".$codigo_w."')";

	$result=mysqli_query($link,$consulta);
	
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
  	 $consulta="call ECO_PSEL_SOLIC_RES_FOT_LIQ('".$codigo_w."')";

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
   	$consulta="call ECO_PSEL_SOLIC_LIQ_2('".$codigo_w."')";
		
	$result=mysqli_query($link,$consulta);
	
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
		
    echo '</table></P>	</td> </TR>';

?>



