<?php
// Sistema			: ECO
// Programa			: ECO02.PHP
// Descripcion		: Buscador de Pacientes.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 10/2010

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
				
             window.open('eco003.php?RUT=' ,'eco003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
			function f_cliente(iparamt){
			/*-------------------------*/
	//			location.href = iparamt
	             window.open('eco_autoriza.php?PAGINA=' + 'eco003.php?RUT=' ,'eco003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

//	             window.open('eco003.php?RUT=' ,'eco003','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			
			}
			
			function Modificar_Vtna()
	          {
			  
//	             window.open('eco003.php?RUT=' + document.getElementById('hdRutPer').Value  ,'eco003','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
		        window.open('eco_autoriza.php?PAGINA=' + 'eco003.php?RUT=' + document.getElementById('hdRutPer').Value,'eco003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

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
			
	          function Remueve_Opcion(Marcado,RutPer)

	          {
	          var radio = document.getElementById(Marcado,RutPer) ;
	          document.getElementById('hdRutPer').Value = RutPer;
	          document.Form1.Btt_modific.disabled = false;
			  alert("pase por aki");
//             document.getElementById('Btt_modific').removeAttribute("disabled"); 

	               for(var i=3; i < document.getElementById("hdCantReg").value; i++) {
                       if(i<10)
                       {
                       //alert(radio.id+" ***** "+ document.getElementById("dgrid_ctl02_rbnSeleccionar").id);
                           if(radio.id != document.getElementById("dgrid_ctl0" + i + "_rbnSeleccionar").id)
                           {
                             document.getElementById("dgrid_ctl0" + i + "_rbnSeleccionar").checked=false;
                             //var el = document.getElementById("dgrid_ctl0" + i + "_rbnSeleccionar");
                             //el.parentNode.removeChild(el);
                           }
                       } else {
                           if(radio.id != document.getElementById("dgrid_ctl" + i + "_rbnSeleccionar").id)
                           {
                             document.getElementById("dgrid_ctl" + i + "_rbnSeleccionar").checked=false;
                           }
                       }
                   }
	          }
	
	
		    function Remueve_Opcion2(rut,opc)
			/*-------------------------*/
	          {
//			  alert(opc);
			
              if(opc!=='C')
			    {
	          document.Form1.Btt_modific.disabled = false;
			  	}
				
			  document.getElementById('hdRutPer').Value = rut;
	          }
		  
	    </script>
	    
	</head>
<?php
if ( isset($_GET["OPC"]) ) {
   $opc_w = $_GET["OPC"];   
}
elseif ($_SESSION['tipo'] == 'ADM') {
  $opc_w = "";  
  }
else {
  $opc_w = "C";  //solo consulta
}
?>
<body leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >

<form name="Form1" method="post" "<?php echo $_SERVER['SCRIPT_NAME']; ?>" id="Form1">
<?php	
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


<script src="/desa_vvpp/WebResource.axd?d=3lC5CkLTZo17F4QZ5jLtcw2&amp;t=633964179561718750" type="text/javascript"></script>

<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
<?php
$_SESSION['apellido_s'] = "";
$_SESSION['nombre_s'] = "";
$_SESSION['rut_s'] = "";


if ($_POST) {
    $_SESSION['apellido_s'] = $_POST['cmd_apellido'];
    $_SESSION['nombre_s'] = $_POST['cmd_nombre'];
    $_SESSION['rut_s'] = $_POST['cmd_rut'];

}
?>
			<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
				<TR>
					<td background="ivvpp0002.jpg" style="width: 34px"></td>
					<td vAlign="bottom" width="500">&nbsp;
						<span id="Label1" class="texto18">BUSCAR PACIENTES</span></td>
				</TR>
				<TR>
					<td background="ivvpp0002.jpg" height="5" style="width: 34px">&nbsp;</td>
					<td width="500" background="ivvpp0005.jpg" height="5">&nbsp;</td>
				</TR>
				<TR>
					<td background="ivvpp0002.jpg" height="6" style="width: 34px"></td>
					<td align="left" width="500" height="6">
						<TABLE class="texto01" id="Table2" cellPadding="0" width="448" border="0">
						  <TR> 
							<td style="WIDTH: 70px; HEIGHT: 12px"></td>
							<td style="WIDTH: 224px; HEIGHT: 12px"></td>
							<td style="WIDTH: 70px; HEIGHT: 12px"></td>
							<td style="HEIGHT: 12px"></td>
						  </TR>
						  <TR> 
							<td style="WIDTH: 70px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Apellido</td>
<!--							<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_apellido" type="text" id="cmd_apellido2" class="input-normal" style="width:216px;" /></td>
-->
							<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_apellido" type="text" id="cmd_apellido" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['apellido_s'])){ echo $_SESSION['apellido_s']; } ?>"/></td>
							<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
							<td style="HEIGHT: 3px" align="center"></td>
						  </TR>
						  <TR> 
							<td style="WIDTH: 70px; HEIGHT: 20px">&nbsp;&nbsp;&nbsp;&nbsp; Nombre</td>
							<td style="WIDTH: 224px; HEIGHT: 20px"><input name="cmd_nombre" type="text" id="cmd_nombre" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['nombre_s'])){ echo $_SESSION['nombre_s']; } ?>"/></td>
							<td style="WIDTH: 70px; HEIGHT: 20px" align="center"></td>
							<td style="HEIGHT: 20px" align="center"></td>
						  </TR>
						  <TR> 
							<td style="WIDTH: 70px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Rut.</td>
							
          <td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_rut" type="text" id="cmd_rut" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['rut_s'])){ echo $_SESSION['rut_s']; } ?>"/></td>
							<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" id="cmd_buscar" class="boton" /></td>
<!--							<td style="HEIGHT: 3px" align="center"><input type="submit" name="cmd_agregar" value="Agregar" onClick="javascript:f_cliente('eco003.php');return false;" id="cmd_agregar" class="boton" /></td>
-->
							<?php
							 if (($opc_w == "C") and ($_SESSION['tipo'] <> 'ADM')) {
	 							 echo '<td style="HEIGHT: 3px" align="center"><input type="submit" name="cmd_agregar" value="Agregar" disabled="disabled" onClick="javascript:f_cliente();return false;" id="cmd_agregar" class="boton" </td>';
								}
							 else {
	 							 echo '<td style="HEIGHT: 3px" align="center"><input type="submit" name="cmd_agregar" value="Agregar" onClick="javascript:f_cliente();return false;" id="cmd_agregar" class="boton" </td>';
								}
							?>
							
						  </TR>
					  </TABLE>
				</td>
				</TR>
  <div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdRutPer" id="hdRutPer"  />
    <input type="hidden" name="hdNomPer" id="hdNomPer" />

  </div>

<?php	
if ($_POST) 
{
 if (isset($_POST["cmd_buscar"]) )
    {
 //   echo "pase";
//	$_SESSION['apellido_s'] = $_POST['cmd_apellido'];
	
	$ape_w = $_POST["cmd_apellido"];
	$nom_w = $_POST["cmd_nombre"];
	$rut_w = $_POST["cmd_rut"];
	
	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//	mysql_select_db(DB_NAME, $link); 
	
	//Ejecutamos la sentencia SQL
//	$consulta="call ECO_PSEL_PACIENTES(null,'".$concepto_w."',null)";
	$consulta="call ECO_PSEL_PACIENTES('".$nom_w."','".$ape_w."','".$rut_w."')";
	
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '<td background="ivvpp/ivvpp0002.jpg" height="145" style="width: 34px"></td>';
	echo '	<td vAlign="top" align="center" width="500" height="145">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:454px;border-collapse:collapse;">';
	echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
	echo '	<td>&nbsp;</td><td>Rut</td><td>Código</td><td>Apellidos</td><td></td><td>Nombres</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		echo '<tr align="left" style="background-color:#F7F7F7;" >';
		echo '<td></td><td>';
		echo '<input type="radio" name="rbnRut" value="'.$row["rut"].'" onClick="Remueve_Opcion2(&quot;'.$row["rut"].'&quot;,&quot;'.$opc_w.'&quot;)"/>';
		echo '<label for="rbnRut">'.$row["rut"].'</label></td>';
		echo '<td>'.$row["ccodigo"].'</td>';
		echo '<td>'.utf8_decode($row["apaterno"]).'</td>';
		echo '<td>'.utf8_decode($row["amaterno"]).'</td>';
		echo '<td>'.utf8_decode($row["nombre"]).'</td>';
		echo '</tr>';
    	}
		
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table></P>	</td> </TR>';
	echo '			<TR>';
	echo '				<td background="ivvpp/ivvpp0002.jpg" height="10" style="width: 34px"></td>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '						align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '							<td style="WIDTH: 124px" align="center" width="124"><input type="submit" name="Btt_modific" value="Modificar" id="Btt_modific" disabled="disabled" class="boton" onClick="Modificar_Vtna();return false;" /></td>';
	echo '							<td align="center"><input type="submit" name="Btt_aceptar" value="Aceptar" id="Btt_aceptar" class="boton" /></td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';
	

	mysqli_free_result($result);
	mysqli_close($link);

	}
/*
// if(isset($cmd_agregar)) 
  if ($_POST["cmd_agregar"]) 
    {
//	 include ("eco003.php"); 
    $extra = 'eco003.php?RUT=';
    header("Location: $extra");
	}
*/
}
 if (isset($_POST["Btt_aceptar"]))
// if(isset($Btt_aceptar)) 
    {
	 if (isset($_POST['rbnRut'])){ 
//    echo 'El valor es: <strong>'.$_POST['rbnRut'].'</strong><br />';
	
		$_SESSION['rutpac_s'] = $_POST["rbnRut"] ;
		
//    echo 'El valor es: <strong>'.$_SESSION['rutpac_s'].'</strong><br />';
		
		$rut_w = $_POST["rbnRut"];
		
		//Conexion con la base
//		$link = mysql_connect("localhost","root","");
//		mysql_select_db("eco");
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//		mysql_select_db(DB_NAME, $link); 

		//Ejecutamos la sentencia SQL
		$consulta="call ECO_PSEL_PACIENTES(null,null,'".$rut_w."')";
	
		$result=mysqli_query($link,$consulta);
	
		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
			$_SESSION['nompac_s'] = $row["nombre"]." ".$row["apaterno"] ;
	
			}
	
		mysqli_free_result($result);
		mysqli_close($link);

	}
/*	
echo 'El valor es: <strong>'.$_SESSION['rutpac_s'].'</strong><br />';
echo 'El valor es: <strong>'.$_SESSION['nompac_s'].'</strong><br />';
*/
		echo "<script>opener.document.Form1.submit();</script>";
		echo "<script>window.close();</script>";

	}

?>

</form>


</body>
</HTML>
