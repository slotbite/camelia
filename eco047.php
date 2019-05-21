<?php
// Sistema			: ECO
// Programa			: ECO047.PHP
// Descripcion		: Muestra Liquidación Aprobada.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 11/02/2011
?>

<?php
ob_start();
session_start();

require_once 'admin/config.php';

if (!empty( $_GET["CODIGO"] ) ) {
   $codigo_w = $_GET["CODIGO"];   
}
else{
  $codigo_w = "";
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<head>
		<title>Liquidación</title>
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ieco/ivvpp0020.gif";
		
		  function f_SelMedico(){
	   /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'eco006.php','Medico','width=500, height=550, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();
		 }

		
	        function f_Modificar(cod){
        /*-----------------------------------*/

             window.open('eco_autoriza.php?PAGINA=' + 'eco011.php?CODIGO=' + cod ,'eco011','width=500, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();
			
			      		  }
						  
		function Enviar_Excel(cod){
	/*-----------------------------------*/
	alert(cod);
	/*
	    var param1 = 'x' + fec1;
		var param2 = 'y' + fec2;
		
        window.open('eco_autoriza.php?PAGINA=' + 'prueba_xls.php?CODIGO=' + cod + param1 + param2,'prueba_xls','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
*/
		 }
		 
		 function Imprimir_Vtna(cod1){
	/*-----------------------------------*/
		var cod = cod1;
        window.open('eco_autoriza.php?PAGINA=' + 'eco047_i.php?CODI=' + cod,'eco047_i','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			
		 }

	    </script>
	    
	</head>

<body leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>" id="Form1">
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
/*
 if (!$_POST ){
	 $ano = date("Y"); // Año actual
	 $mes = date("m"); // Mes actual
	 $dia = "01"; // Dia actual
	 $fec_w = $dia . "/". $mes . "/" . $ano;
	 $_SESSION['fecha1_s'] = $fec_w;
	 
	 $uldia = strftime("%d", mktime(0, 0, 0, $mes+1, 0, $ano));
	 $fec_w = $uldia . "/". $mes . "/" . $ano;
	 $_SESSION['fecha2_s'] = $fec_w;
 }
 else {
 	$_SESSION['fecha1_s'] = "";
	$_SESSION['fecha2_s'] = "";
 }
*/
$medico_w  = "";
if ($_GET["CODIGO"] > 0)
    {
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_LIQUIDACIONES('".$_GET["CODIGO"]."',null,null,null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$medico_w  = $row["enmedico"]." ".$row["epmedico"];
				
		$_SESSION['fecha1_s'] = $row["fdesde"];
		$_SESSION['fecha2_s'] = $row["fhasta"];
		
		}
		
	mysqli_free_result($result);
	mysqli_close($link);
}

?>
		<table id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
			<TR>
				<td background="ivvpp0002.jpg" style="width: 34px"></td>
				<td vAlign="bottom" width="500">&nbsp;
					<span id="Label1" class="texto18">LIQUIDACION APROBADA Nº <?php echo $codigo_w; ?></span></td>
			</TR>
			<TR>
				<td background="ivvpp0002.jpg" height="5" style="width: 34px">&nbsp;</td>
				<td width="500" background="ivvpp0005.jpg" height="5">&nbsp;</td>
			</TR>
			<TR>
				<td background="ivvpp0002.jpg" height="6" style="width: 34px"></td>
				<td align="left" width="500" height="6">
					<TABLE class="texto01" id="Table2" cellPadding="0" width="523" border="0">
       		 <TR> 
						<td width="108" style="WIDTH: 70px; HEIGHT: 12px"></td>
						<td width="254" style="WIDTH: 254px; HEIGHT: 12px"></td>
						<td width="78" style="WIDTH: 70px; HEIGHT: 12px"></td>
						<td width="73" style="HEIGHT: 12px"></td>
					  </TR>
					
					  <tr> 
						  <td style="width: 70px; height: 3px">&nbsp; Médico </td>
					      <td style="width: 254px; height: 3px"> 
		                  <?php
						  echo $medico_w;
						  ?>
							</td>
							<td style="WIDTH: 70px; HEIGHT: 3px" align="center">
							<td style="HEIGHT: 3px" align="center"></td>
						</tr>
					   <tr>
         		 		<td style="WIDTH: 70px; HEIGHT: 3px">&nbsp; Fecha Desde </td>
						<td style="WIDTH: 254px; HEIGHT: 3px"><?php if (isset($_SESSION['fecha1_s'])){ echo $_SESSION['fecha1_s']; } ?>
            			&nbsp; Hasta <?php if (isset($_SESSION['fecha2_s'])){ echo $_SESSION['fecha2_s']; } ?>
						</td>
						
          				<td style="WIDTH: 70px; HEIGHT: 3px" align="center">&nbsp;</td>
						<td style="HEIGHT: 3px" align="center"></td>
					  </TR>

					  </table>
				</td>
				</TR>
<?php	

//if ($_POST) 
//{
// if (isset($_POST["cmd_buscar"])) {
    
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
	echo '	<td>Cantidad</td><td>Prevision</td><td>Total</td>';
	echo '</tr>';

	$canprev_w = 0; 
    $totprev_w = 0; 
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
  		  echo '<td align="center">'.$row["cantprev"].' </td>';
		  echo '<td>'.$row["nPrevision"].'</td>';
  		  echo '<td>'.number_format($row["totexamen"],0, ',', '.').'</td>';
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
  		  echo '<td align="center">'.number_format($canprev_w,0, ',', '.').'</td>';
		  echo '<td></td>';
  		  echo '<td>'.number_format($totprev_w,0, ',', '.').'</td>';
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
  		  echo '<td align="center">'.number_format($row["cantbn"],0, ',', '.').'</td>';
		  echo '<td>Fotos B/N</td>';
  		  echo '<td>'.number_format($row["totbn"],0, ',', '.').'</td>';
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
  		  echo '<td align="center">'.number_format($row["cantcol"],0, ',', '.').'</td>';
		  echo '<td>Fotos Color</td>';
  		  echo '<td>'.number_format($row["totcol"],0, ',', '.').'</td>';
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
  		  echo '<td>'.number_format($totfot_w,0, ',', '.').'</td>';
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
  		  echo '<td>'.number_format($stotbn_w,0, ',', '.').'</td>';
     	  echo '<td>'.number_format($stotcol_w,0, ',', '.').'</td>';
		  echo '<td>'.number_format($stotex_w,0, ',', '.').'</td>';
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
	echo '			<TR>';
	echo '				<td background="ivvpp/ivvpp0002.jpg" height="10" style="width: 34px"></td>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '						align="center" border="0">';
	echo '						<TR>';
//	echo '							<td style="WIDTH: 173px" align="center" ><input type="submit" name="Btt_excel" value="Excel" id="Btt_excel" class="boton" style="width:70px;" onClick="Enviar_Excel(&quot;'.$codigo_w.'&quot;)"/></td>';
	echo '							<td style="WIDTH: 173px" align="center" ><input type="submit" name="Btt_excel" value="Excel" id="Btt_excel" class="boton" style="width:70px;" /></td>';
    echo '							<td style="WIDTH: 173px" align="center" ><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" onClick="Imprimir_Vtna(&quot;'.$codigo_w.'&quot;)"/> </td>';
	echo '						</TR>	';
    echo '</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';

//	}

//}

?>

</form>

<?php	
if ($_POST) 
{
 if (isset($_POST["Btt_excel"])) 
    {
	/*
    echo "<script type=\"text/javascript\">alert('pase'); </script>";
    echo "<script type=\"text/javascript\">alert('".$codigo_w."'); </script>";
	*/
	$cod = $codigo_w;
	header("Location: eco047_e.php?COD=$cod");
	ob_end_flush();
	exit();

  }
/*  
 echo "<script type=\"text/javascript\"> window.close(); </script>";
 */
}
?>

</body>
</HTML>
