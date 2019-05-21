<?php
// Sistema			: CAMELIA
// Programa			: CAM012_muestra.PHP
// Descripcion		: Buscador de Invenario.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 29/08/2011

// iniciamos sesiones

session_start();

require_once 'admin/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head><title>Busqueda</title>
		<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
		
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>  
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			function Modificar_Vtna()
	          {
			   window.open('eco_autoriza.php?PAGINA=' + 'cam013.php?CODIGO=' + document.getElementById('hdClave').Value,'cam013','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();
	          }

			function Eliminar_Vtna()
			/*-------------------------*/
	          {
			   window.open('eco_autoriza.php?PAGINA=' + 'cam013_e.php?CODIGO=' + document.getElementById('hdClave').Value,'cam013_e','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();
	          }


			function f_error(){
			/*----------------*/
				if(Form1.HD_error.value.length > 1 ) {
				  if(Form1.HD_error.value == "UPDATE" ) {
				     alert("La persona seleccionada no registra fecha de nacimiento...")
				     Form1.Btt_modific.onclick()
				  } else {
    				  alert(Form1.HD_error.value)
				  }
                  Form1.HD_error.value = ''
				}
			}
			
		    function Remueve_Opcion2(cod,opc)
			/*-------------------------*/
	          {
//			  alert(opc);
			
//              if(opc!=='C')
//			    {
	          	document.Form1.Btt_modific.disabled = false;
    	        document.Form1.Btt_eliminar.disabled = false;

//			  	}
			  document.getElementById('hdClave').Value = cod;
	          }
		  
	    </script>
	    
	</head>
<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >

<form name="Form1" method="post"  id="Form1">
<?php
/*
if ( isset($_GET["OPC"]) ) {
   $opc_w = $_GET["OPC"];   
}
elseif ($_SESSION['tipo'] == 'ADM') {
  $opc_w = "";  
  }
else {
  $opc_w = "C";  //solo consulta
}
*/
$opc_w = $_SESSION['opcpac_s'];
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
    $loc_w = $_SESSION['codloc_s'];
    $pro_w = $_SESSION['codpro_s'];
    $art_w = $_SESSION['codart_s'];
    $col_w = $_SESSION['codcol_s'];
    $tall_w = $_SESSION['talla_s'];

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
	$consulta="call cam_psel_inventario('".$loc_w."','".$pro_w."','".$art_w."','".$col_w."','".$tall_w."')";
	$result = mysqli_query($link,$consulta);
	
	$total_registros = mysqli_num_rows($result);
	
	$select_w = "Select inv_codloc,inv_codpro,inv_codart,inv_codcol,inv_talla,inv_saldo From cam_inventario
           Where inv_codloc Like '$loc_w%' 
		   And inv_codpro   Like '$pro_w%'
           And inv_codart   Like '$art_w%'
           And inv_codcol   Like '$col_w%'
           And inv_talla   Like '$tall_w%'
           Order By inv_codloc, inv_codpro, inv_codart, inv_codcol, inv_talla
           LIMIT $inicio, $registros"; 
	
//	$select_w = "Select crut,nnombre,nappaterno,napmaterno,ccodigo From eco_pacientes Order By nappaterno, nNombre LIMIT $inicio, $registros"; 
//echo $select_w;
		   
//	$result = mysqli_query("SELECT * FROM artículos WHERE visible = 1 ORDER BY fecha DESC LIMIT $inicio, $registros");
	mysqli_free_result($result);
	mysqli_close($link);
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	$result = mysqli_query($link,$select_w);
	$total_páginas = ceil($total_registros / $registros);
		
	echo '<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="600" border="0">';
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="600" height="145">';
    echo '		<P><table class="link13" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:600px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
	echo '	<td>&nbsp;</td><td>Local</td><td>Proveedor</td><td>Artículo</td><td>Color</td><td>Talla</td><td>Saldo</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td></td><td>';
		echo '<input type="radio" name="rbnRut" value="'.$row["inv_codloc"].'" onClick="Remueve_Opcion2(&quot;'.$row["inv_codloc"].'.'.$row["inv_codpro"].'.'.$row["inv_codart"].'.'.$row["inv_codcol"].'.'.$row["inv_talla"].'&quot;,&quot;'.$opc_w.'&quot;)"/>';
		echo '<label for="rbnRut">'.$row["inv_codloc"].'</label></td>';
		echo '<td>'.$row["inv_codpro"].'</td>';
		echo '<td>'.$row["inv_codart"].'</td>';
		echo '<td>'.$row["inv_codcol"].'</td>';
		echo '<td>'.$row["inv_talla"].'</td>';
		echo '<td>'.$row["inv_saldo"].'</td>';
		echo '</tr>';
    	}
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="7"><span></span></td>	</tr>';
    echo '</table>';
	echo '</P>	</td> </TR>';
	echo '<TR>';
	echo '<td vAlign="middle" align="center" width="500" height="10">';

	if(($página - 1) > 0) {
     echo "<a href='eco_autoriza.php?PAGINA=cam012_muestra.php?página=".($página-1)."'>< Anterior</a> ";
	}
	for ($i=1; $i<=$total_páginas; $i++){
 	  if ($página == $i) {
    	  echo "<b>".$página."</b> ";
		} 
	  else {
		  echo "<a href='eco_autoriza.php?PAGINA=cam012_muestra.php?página=$i'>$i</a> ";
		}
    }		
	if(($página + 1)<=$total_páginas) {
		$destino_w = "eco_autoriza.php?PAGINA=cam012_muestra.php?página=".($página+1);
	   	echo " <a target='mainFrame' href='".$destino_w."'>Siguiente ></a>;";
	}
	
	echo '			</TR></td>';
	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '					align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '							<td style="WIDTH: 124px" align="center" width="124"><input type="submit" name="Btt_modific" value="Modificar" id="Btt_modific" disabled="disabled" class="boton" onClick="Modificar_Vtna();return false;" /></td>';
	echo '							<td align="center"><input type="submit" name="Btt_eliminar" value="Eliminar" id="Btt_eliminar" disabled="disabled" class="boton" onClick="Eliminar_Vtna();return false;"/></td>';
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
    <input type="hidden" name="hdClave" id="hdClave"  />
    <input type="hidden" name="hdNomPer" id="hdNomPer" />

</div>
</form>


</body>
</HTML>
