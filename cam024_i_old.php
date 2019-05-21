<?php
// Sistema			: CAMELIA
// Programa			: CAM024_i.PHP
// Descripcion		: Imprime Proveedores por código.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 22/10/2011

// iniciamos sesiones

session_start();

require_once 'admin/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head><title>Imprime Proveedores por Código</title>
		<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
		
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

$cod1_w = substr($_GET["CODIGO"], 0, $pos1) ;
$cod2_w = substr($_GET["CODIGO"], $pos1 + 1, 2) ;
//echo 'cod:' . $codigo_w;

?>
<!-- <body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >
 -->
 <body onload="f_imprimir()">

<form name="Form1" method="post"  id="Form1">
<?php
if ( isset($_GET["página"]) ) {
   $página = $_GET["página"];   
}


if (!$_POST)
{
	if (!isset($_SESSION['autoriza']) or $_SESSION['autoriza'] <> "SI") 
	  {
		echo "<script type=\"text/javascript\">
				alert('Acceso denegado......');
				</scipt>";
		exit();			
	  }				
	else
	{ 
		$_SESSION['autoriza'] = "NO";
		
		if (($_SESSION['tipo'] <> 'ADM') and ($opc_w <> 'C')) 
		{
		echo "<script type=\"text/javascript\">
				alert('Usuario No Tiene Acceso......');
				</script>";
		exit();	
		}

	}  
}

?>
  <table width="300" border="0" cellspacing="0" cellpadding="0" class="texto11">
  <tr>
    <td><?php echo 'CAMELIA CUEROS';?></td>
  </tr>
</table>

 <table align="center"> 
  <tr> <td><span id="Label1" class="texto18_i" >INFORME DE PROVEEDORES (Por Código)</span></td>
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

    $codpro1_w = $_SESSION['codpro1_s'];
    $codpro2_w = $_SESSION['codpro2_s'];

	if (strlen(trim($codpro1_w)) == 0 )
		{$codpro1_w = NULL;}
    else		
		{$codpro1_w = $codpro1_w . '%';}

	if (strlen(trim($codpro2_w)) == 0 )
		{$codpro2_w = 'ZZZ';}
    else		
		{$codpro2_w = $codpro2_w . '%';}

   $registros = 20;
	if (!isset($página)) {
 		$inicio = 0;
   		$página = 1;
		}
	else {
   		$inicio = ($página - 1) * $registros;
		}

//echo $opc_w;
//echo $página;

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call CAM_PSEL_PROVEEDORES_2('".$codpro1_w."','".$codpro2_w."')";
	$result = mysqli_query($link,$consulta);

//echo $consulta;
	
	$total_registros = mysqli_num_rows($result);
	
	$cod1_w = $codpro1_w;
    $cod2_w = $codpro2_w;

//echo $cod1_w ;
//echo $cod2_w ;
	$select_w = "Select pro_rutpro,pro_nomfa,pro_rasoc,pro_codpro,pro_direcc,pro_comuna,pro_ciudad,pro_fono,pro_fax,pro_vendedor From cam_proveedores
           Where pro_codpro >= '$cod1_w'
		   And pro_codpro <= '$cod2_w'
           Order By pro_codpro
           LIMIT $inicio, $registros"; 
	
//echo $select_w;
		   
		   
//	$result = mysqli_query("SELECT * FROM artículos WHERE visible = 1 ORDER BY fecha DESC LIMIT $inicio, $registros");
	mysqli_free_result($result);
	mysqli_close($link);
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	$result = mysqli_query($link,$select_w);
	$total_páginas = ceil($total_registros / $registros);
		
//	echo '<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="800" border="0">';
//	echo '<TR>';
//	echo '	<td vAlign="top" align="center" width="800" height="145">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="0" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:800px;border-collapse:collapse;">';
	echo '<tr>';
	echo '	<td>Código</td><td width="60">Rut</td><td>Razón Social</td><td>Nombre Fantasía</td><td>Dirección</td><td>Comuna</td><td>Ciudad</td><td>Fono</td><td>Fax</td><td>Vendedor</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
//		echo '<tr align="left" style="background-color:#F7F7F7;" >';
		echo '<tr>';
		echo '<td>'.$row["pro_codpro"].'</td>';
		echo '<td>'.$row["pro_rutpro"].'</td>';
		echo '<td>'.utf8_decode($row["pro_rasoc"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_nomfa"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_direcc"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_comuna"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_ciudad"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_fono"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_fax"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_vendedor"]).'</td>';

		echo '</tr>';
    	}
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table>';
	echo '</P>';
//	echo '</P>	</td> </TR>';
	
	echo '<TR>';
	echo '<td vAlign="middle" align="center" width="600" height="10">';
/*
	if(($página - 1) > 0) {
     echo "<a href='eco_autoriza.php?PAGINA=cam024_muestra.php?página=".($página-1)."'>< Anterior</a> ";
	}
	*/
	for ($i=1; $i<=$total_páginas; $i++){
 	  if ($página == $i) {
    	  echo "<b>".$página."</b> ";
		} 
	  else {
		  echo "<a href='eco_autoriza.php?PAGINA=cam024_muestra.php?página=$i'>$i</a> ";
		}
    }		
	if(($página + 1) <= $total_páginas) {
		$destino_w = "eco_autoriza.php?PAGINA=cam024_muestra.php?página=".($página+1);
	   	echo " <a target='mainFrame' href='".$destino_w."'>Siguiente ></a>;";
	}
	
	echo '			</TR></td>';
	/*
	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '					align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '							<td style="WIDTH: 124px" align="center" width="124"></td>';
    echo '                          <td align="center"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" onClick="Imprimir_Vtna(&quot;'.$codpro1_w.'&quot;,&quot;'.$codpro2_w.'&quot;)" </td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	*/
//	echo '		</TABLE>';

  
	mysqli_free_result($result);
	mysqli_close($link);


?>

<div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdCodPro" id="hdCodPro"  />
    <input type="hidden" name="hdNomPer" id="hdNomPer" />

</div>
</form>


</body>
</HTML>
