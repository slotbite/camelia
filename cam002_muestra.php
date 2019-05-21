<?php
// Sistema			: CAMELIA
// Programa			: CAM002_muestra.PHP
// Descripcion		: Buscador de Proveedores.
// Programador(a) 	: Roxana Ram�rez Vega
// F.Inicio 		: 18/08/2011

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
		
			function fabre_ventana(iparamt,icoord){
			/*---------------------------*/
				pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
				pant_emp.location = iparamt
				
             window.open('cam003.php?COD=' ,'cam003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
			function f_cliente(iparamt){
			/*-------------------------*/
	             window.open('eco_autoriza.php?PAGINA=' + 'cam003.php?COD=' ,'cam003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();

			}
			
			function Modificar_Vtna()
	          {
			   window.open('eco_autoriza.php?PAGINA=' + 'cam003.php?COD=' + document.getElementById('hdCodPro').Value,'cam003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();
	          }

			function Eliminar_Vtna()
			/*-------------------------*/
	          {
	 	              window.open('eco_autoriza.php?PAGINA=' + 'cam003_e.php?COD=' + document.getElementById('hdCodPro').Value ,'cam003_e','width=550, height=350, status= no, resizable= yes, menubar=no, scrollbars=yes, location=no, top=150, left=200').focus();
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
			
              if(opc!=='C')
			    {
	          document.Form1.Btt_modific.disabled = false;
  	          document.Form1.Btt_eliminar.disabled = false;

			  	}
			  document.getElementById('hdCodPro').Value = cod;
	          }
		  
	    </script>
	    
	</head>
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

?>
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
if ( isset($_GET["p�gina"]) ) {
   $p�gina = $_GET["p�gina"];   
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

    $nomfa_w = $_SESSION['nomfa_s'] ;
    $rasoc_w = $_SESSION['rasoc_s'] ;
    $rutpro_w = $_SESSION['rutpro_s'];
    $codpro_w = $_SESSION['codpro_s'];

   $registros = 20;
	if (!isset($p�gina)) {
 		$inicio = 0;
   		$p�gina = 1;
		}
	else {
   		$inicio = ($p�gina - 1) * $registros;
		}

//echo $opc_w;
//echo $p�gina;

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call CAM_PSEL_PROVEEDORES('".$nomfa_w."','".$rasoc_w."','".$rutpro_w."','".$codpro_w."')";
	$result = mysqli_query($link,$consulta);
	
	$total_registros = mysqli_num_rows($result);
	
	$select_w = "Select pro_rutpro,pro_nomfa,pro_rasoc,pro_codpro From cam_proveedores
           Where pro_rutpro     Like '$rutpro_w%'
           And pro_nomfa    Like '$nomfa_w%'
           And pro_rasoc Like '$rasoc_w%'
		   And pro_codpro Like '$codpro_w%'
           Order By pro_nomfa, pro_rasoc
           LIMIT $inicio, $registros"; 
	
//	$select_w = "Select crut,nnombre,nappaterno,napmaterno,ccodigo From eco_pacientes Order By nappaterno, nNombre LIMIT $inicio, $registros"; 
//echo $select_w;
		   
		   
//	$result = mysqli_query("SELECT * FROM art�culos WHERE visible = 1 ORDER BY fecha DESC LIMIT $inicio, $registros");
	mysqli_free_result($result);
	mysqli_close($link);
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	$result = mysqli_query($link,$select_w);
	$total_p�ginas = ceil($total_registros / $registros);
		
	echo '<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">';
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="500" height="145">';
//    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:454px;border-collapse:collapse;">';
    echo '		<P><table class="link12" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
	echo '	<td>&nbsp;</td><td>C�digo</td><td>Rut</td><td>Nombre Fantas�a</td><td>Raz�n Social</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
//		echo '<tr align="left" style="background-color:#F7F7F7;" >';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td></td><td>';
		echo '<input type="radio" name="rbnRut" value="'.$row["pro_codpro"].'" onClick="Remueve_Opcion2(&quot;'.$row["pro_codpro"].'&quot;,&quot;'.$opc_w.'&quot;)"/>';
		echo '<label for="rbnRut">'.$row["pro_codpro"].'</label></td>';
		echo '<td>'.$row["pro_rutpro"].'</td>';
		echo '<td>'.utf8_decode($row["pro_nomfa"]).'</td>';
		echo '<td>'.utf8_decode($row["pro_rasoc"]).'</td>';
		echo '</tr>';
    	}
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="5"><span></span></td>	</tr>';
    echo '</table>';
	echo '</P>	</td> </TR>';
	
	echo '<TR>';
	echo '<td vAlign="middle" align="center" width="500" height="10">';

	if(($p�gina - 1) > 0) {
     echo "<a href='eco_autoriza.php?PAGINA=cam002_muestra.php?p�gina=".($p�gina-1)."'>< Anterior</a> ";
	}
	for ($i=1; $i<=$total_p�ginas; $i++){
 	  if ($p�gina == $i) {
    	  echo "<b>".$p�gina."</b> ";
		} 
	  else {
		  echo "<a href='eco_autoriza.php?PAGINA=cam002_muestra.php?p�gina=$i'>$i</a> ";
		}
    }		
	if(($p�gina + 1)<=$total_p�ginas) {
		$destino_w = "eco_autoriza.php?PAGINA=cam002_muestra.php?p�gina=".($p�gina+1);
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
    <input type="hidden" name="hdCodPro" id="hdCodPro"  />
    <input type="hidden" name="hdNomPer" id="hdNomPer" />

</div>
</form>


</body>
</HTML>
