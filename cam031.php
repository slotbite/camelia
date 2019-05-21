<?php
// Sistema			: CAMELIA
// Programa			: CAM031.PHP
// Descripcion		: Consulta de Cuadratura de Caja.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 19/11/2012

session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Consulta Cuadratura de Caja</title>
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			function Imprimir_Vtna(cod1,cod2){
			/*-----------------------------------*/
//		    alert(cod1+','+cod2);
            var cod = cod1 + ',' + cod2;
			window.open('cam031_i.php?CODIGO=' + cod,'cam031_i','width=750, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
				
			 }
		
			
		
		    function Remueve_Opcion2(cod,opc)
			//-------------------------
	          {
              if(opc!=='C')
			    {
	          document.Form1.Btt_modific.disabled = false;
  	          document.Form1.Btt_eliminar.disabled = false;
			  	}
				
			  document.getElementById('hdCodLoc').Value = cod;
	          }

  
	    </script>
	    
    <style type="text/css">
	    div.message{ position:absolute; left:0px; top:0px; width:100%; height:100%; background-color:#000; filter:alpha(opacity=20); -moz-opacity: 0.2; opacity: 0.2;}
	    div#myAlert{ position:absolute; left:0px; top:10px; width:100%; text-align:center;}
	    //.myAlert{ position:absolute; left:35%; padding:25px; width:250px; height:150px; background-color:#FFF; border:2px solid #000; margin:auto; text-align:left;}
	    .closeAlert {position:absolute; right:450px; top:-50px; width:70px; height:70px; background-color:#FFF; background:url(ivvpp/ivvpp0020.gif) no-repeat top left;}
    </style>
	    
	</head>
<?php
if (isset($_GET["OPC"]) and (!empty( $_GET["OPC"] ))) {
   $opc_w = $_GET["OPC"];   
}
else{
  $opc_w = "1";
}

if ( isset($_GET["OPC2"]) ) {
   $opc2_w = $_GET["OPC2"];   
}
else {
  $opc2_w = "C";  //solo consulta
}
?>

<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout">
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

<?php

$_SESSION['codloc_s'] = "";
$_SESSION['fecha_s'] = date("d/m/Y");

if ($_POST) {
    $_SESSION['codloc_s'] = $_POST['cmd_codloc'];
    $_SESSION['fecha_s'] = $_POST['cmd_fecha'];

}
?>
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
			<TR>
				<td vAlign="bottom" width="500">&nbsp;
					<span id="Label1" class="texto18">CONSULTA CUADRATURA DE CAJA</span></td>
			</TR>
<!-- 			<TR>
				<td background="ivvpp0002.jpg" height="5" style="width: 34px">&nbsp;</td>
				<td width="500" background="ivvpp0005.jpg" height="5">&nbsp;</td>
			</TR>
 -->			<TR>
				<td align="left" width="500" height="6">
					<TABLE class="texto13" id="Table2" cellPadding="0" width="579" border="0">
        <TR> 
						<td width="100" style="WIDTH: 70px; HEIGHT: 12px"></td>
						<td width="224" style="WIDTH: 224px; HEIGHT: 12px"></td>
						<td width="129" style="WIDTH: 70px; HEIGHT: 12px"></td>
						<td width="116" style="HEIGHT: 12px"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 70px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Cód.Local</td>
						<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/></td>
						<td style="HEIGHT: 12px"></td>

					  </TR>
  					  <TR> 
	           		 	<td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Fecha </td>
						<td style="WIDTH: 174px; HEIGHT: 3px">
						<input name="cmd_fecha" type="text" id="cmd_fecha" class="input-normal" style="width:86px" value="<?php if (isset($_SESSION['fecha_s'])){ echo $_SESSION['fecha_s']; } ?>"/>
						</td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" onclick="javascript:MyAlert('');" id="cmd_buscar" class="boton" /></td>

					  </TABLE>
				</td>
				</TR>
<?php	
if ($_POST) 
{
 if (isset($_POST["cmd_buscar"])) 
    {
    $atran = array("Contado Efectivo","Contado Documentado","Cheque a Fecha","CR-Camelia","Tarjetas de Crédito ","Habilitado","Instituciones","Créditos Particulares");
	$cod_w = $_POST["cmd_codloc"];
	$fecha_w = trim($_POST["cmd_fecha"]);

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_vtasxfpago('".$cod_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'))";
//echo $consulta;
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="400" >';
//    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';
    echo '		<P><table class="link13" cellspacing="0" cellpadding="3" align="center" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:400px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
	echo '<td>FORMA DE PAGO</td><td>INGRESOS</td><td>EGRESOS</td><td>Total</td>';
	echo '</tr>';

    $toting = 0;
	$tottot = 0;
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		//		echo '<tr style="background-color:#F7F7F7;">';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
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

	echo '<tr class="texto13" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td>Totales</td>';
		echo '<td>'.number_format($toting).'</td>';
		echo '<td> </td>';
		echo '<td>'.number_format($tottot).'</td>';
		echo '</tr>';
    echo '</table></P>	</td> </TR>';

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

	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="500">';
//    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';
    echo '		<P><table class="link13" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call cam_psel_vtasxtipo('".$cod_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'))";
//echo $consulta;
	$result=mysqli_query($link,$consulta);
	while ($row=mysqli_fetch_array($result))
		{
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		if ($row["activo"] == "S")
		{
			echo '<td> Vales Emitidos :</td>';
			echo '<td>'.$row["totval"].'</td>';
			echo '<td> del '.$valini.'</td>';
			echo '<td> al '.$valfin.'</td>';

		}
        else
		{
			echo '<td> Vales Anulados :</td>';
			echo '<td>'.$row["totval"].'</td>';

		}
		echo '</tr>';
	
    	}
	mysqli_free_result($result);
	mysqli_close($link);
	
    echo '</table></P>	</td> </TR>';
	
	
    $atran = array("Consulta","Venta","Cambio","Devolución","Separado","Abono Separado","Dev. Separado","Ent. Separado","Personal","Anulación");

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call cam_psel_vtasxtransa('".$cod_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'))";
//echo $consulta;
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="300" height="145">';
    echo '		<P><table class="link13" cellspacing="0" cellpadding="3" align="Center" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:300px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
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
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td>'.$atran[$row["transa"] - 1].'</td>';
//		echo '<td>'.$row["transa"].'</td>';
 		echo '<td>'.$row["cant"].'</td>';
		echo '<td>'.number_format($row["total"]).'</td>';
		echo '</tr>';
    	}

	
	echo '<tr class="texto13" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="3"><span></span></td>	</tr>';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td>Totales</td>';
		echo '<td>'.$tcant.'</td>';
		echo '<td>'.number_format($tmonto).'</td>';
		echo '</tr>';
	echo '<tr class="texto13" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="3"><span></span></td>	</tr>';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td>Vales Personal</td>';
		echo '<td>'.$cantper.'</td>';
		echo '<td>'.number_format($monper).'</td>';
		echo '</tr>';

    echo '</table></P>	</td> </TR>';

	mysqli_free_result($result);
	mysqli_close($link);

	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '						align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '							<td style="WIDTH: 124px" align="center" width="124"></td>';
    echo '                          <td align="center"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" onClick="Imprimir_Vtna(&quot;'.$cod_w.'&quot;,&quot;'.$fecha_w.'&quot;)" </td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';
	

	}
}

?>
  <div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdCodLoc" id="hdCodLoc" />
  </div>

</form>

</body>
</HTML>
