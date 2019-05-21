<?php
// Sistema			: CAMELIA
// Programa			: CAM025_muestra.PHP
// Descripcion		: Buscador de Proveedores por nombre.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 07/11/2011

// iniciamos sesiones

session_start();

require_once 'admin/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head><title>Busqueda de Proveedores</title>
		<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
		
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>  
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			
			function Imprimir_Vtna(cod1,cod2){
			/*-----------------------------------*/
//		    alert(cod1+','+cod2);
            var cod = cod1 + ',' + cod2;
//			window.open('eco_autoriza.php?PAGINA=' + 'cam024_i.php?CODIGO=' + cod,'cam024_i','width=750, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			window.open('cam024_i.php?CODIGO=' + cod,'cam024_i','width=750, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			
			 }

			
		    function Remueve_Opcion2(cod,opc)
			/*-------------------------*/
	          {
//			  alert(opc);
			
              if(opc!=='C')
			    {
	          document.Form1.Btt_modific.disabled = false;
  	          document.Form1.Btt_eliminar.disabled = false;

			  	}
			  document.getElementById('hdCodPro').Value = cod;
	          }
		  
	    </script>
	    
	</head>
<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >

<form name="Form1" method="post"  id="Form1">
<?php
if ( isset($_GET["página"]) ) {
   $página = $_GET["página"];   
}

/*
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
*/
?>
<script type="text/javascript">
<!-- 
var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
// -->
</script>


<?php

    $nompro1_w = $_SESSION['nompro1_s'];
    $nompro2_w = $_SESSION['nompro2_s'];

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
	$consulta="call CAM_PSEL_PROVEEDORES_3('".$nompro1_w."','".$nompro2_w."')";
	$result = mysqli_query($link,$consulta);

//echo $consulta;
	
	$total_registros = mysqli_num_rows($result);
	
	$nom1_w = STR_PAD(TRIM($nompro1_w),15,' ');
    $nom2_w = STR_PAD(TRIM($nompro2_w),15,'Z');

//echo $cod1_w ;
//echo $cod2_w ;
/*    
	if (strlen(trim($cod1_w)) == 0 )
		{$cod1_w = NULL;}
    else		
		{$cod1_w = $cod1_w . '%';}

	if (strlen(trim($cod2_w)) == 0 )
		{$cod2_w = 'ZZZ';}
    else		
		{$cod2_w = $cod2_w . '%';}
*/
	$select_w = "Select pro_rutpro,pro_nomfa,pro_rasoc,pro_codpro,pro_direcc,pro_comuna,pro_ciudad,pro_fono,pro_fax,pro_vendedor From cam_proveedores
           Where pro_nomfa >= '$nom1_w'
		   And pro_nomfa <= '$nom2_w'
           Order By pro_nomfa
           LIMIT $inicio, $registros"; 
	
//echo $select_w;
		   
		   
//	$result = mysqli_query("SELECT * FROM artículos WHERE visible = 1 ORDER BY fecha DESC LIMIT $inicio, $registros");
	mysqli_free_result($result);
	mysqli_close($link);
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	$result = mysqli_query($link,$select_w);
	$total_páginas = ceil($total_registros / $registros);
		
	echo '<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="800" border="0">';
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="800" height="145">';
    echo '		<P><table class="link12" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:800px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
	echo '	<td>Nombre Fantasía</td><td>Código</td><td width="60">Rut</td><td>Razón Social</td><td>Dirección</td><td>Comuna</td><td>Ciudad</td><td>Fono</td><td>Fax</td><td>Vendedor</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
//		echo '<tr align="left" style="background-color:#F7F7F7;" >';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td>'.utf8_decode($row["pro_nomfa"]).'</td>';
		echo '<td>'.$row["pro_codpro"].'</td>';
		echo '<td>'.$row["pro_rutpro"].'</td>';
		echo '<td>'.utf8_decode($row["pro_rasoc"]).'</td>';
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
	echo '</P>	</td> </TR>';
	
	echo '<TR>';
	echo '<td vAlign="middle" align="center" width="600" height="10">';

	if(($página - 1) > 0) {
     echo "<a href='eco_autoriza.php?PAGINA=cam025_muestra.php?página=".($página-1)."'>< Anterior</a> ";
	}
	for ($i=1; $i<=$total_páginas; $i++){
 	  if ($página == $i) {
    	  echo "<b>".$página."</b> ";
		} 
	  else {
		  echo "<a href='eco_autoriza.php?PAGINA=cam025_muestra.php?página=$i'>$i</a> ";
		}
    }		
	if(($página + 1)<=$total_páginas) {
		$destino_w = "eco_autoriza.php?PAGINA=cam025_muestra.php?página=".($página+1);
	   	echo " <a target='mainFrame' href='".$destino_w."'>Siguiente ></a>;";
	}
	
	echo '			</TR></td>';
	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '					align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '							<td style="WIDTH: 124px" align="center" width="124"></td>';
    echo '                          <td align="center"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" onClick="Imprimir_Vtna(&quot;'.$nompro1_w.'&quot;,&quot;'.$nompro2_w.'&quot;)" </td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';

  
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
