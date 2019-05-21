<?php
// Sistema			: ECO
// Programa			: ECO02.PHP
// Descripcion		: Buscador de Pacientes.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 10/2010

// iniciamos sesiones
//ob_start();
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
	             window.open('eco_autoriza.php?PAGINA=' + 'eco003.php?RUT=' ,'eco003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
			function Modificar_Vtna()
	          {
			  
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



<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
<?php
$_SESSION['apellido_s'] = "";
$_SESSION['nombre_s'] = "";
$_SESSION['rut_s'] = "";
$_SESSION['opcpac_s'] = $opc_w;

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
    $_SESSION['apellido_s'] = $_POST['cmd_apellido'];
    $_SESSION['nombre_s'] = $_POST['cmd_nombre'];
    $_SESSION['rut_s'] = $_POST['cmd_rut'];

    $extra = 'eco002_muestra.php?CODIGO=' ;
/*		echo "<script>parent.frames['mainFrame'].location.href= 'eco_autoriza.php?PAGINA="."'eco002_muestra.php?OPC=';</script>";
*/
	echo "<script>parent.frames['mainFrame'].location.href='eco_autoriza.php?PAGINA=eco002_muestra.php?OPC=$opc_w';</script>";
//    header("Location: $extra");
//	ob_end_flush();
	}

 if (isset($_POST["Btt_aceptar"]))
    {
	 if (isset($_POST['rbnRut']))
	 { 
		$_SESSION['rutpac_s'] = $_POST["rbnRut"] ;
		
		$rut_w = $_POST["rbnRut"];
		//Conexion con la base
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

		//Ejecutamos la sentencia SQL
		$consulta="call ECO_PSEL_PACIENTES(null,null,'".$rut_w."')";
	
		$result=mysqli_query($link,$consulta);
	
		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
			$_SESSION['nompac_s'] = $row["nombre"]." ".$row["apaterno"]." ".$row["amaterno"];
	
			}
	
		mysqli_free_result($result);
		mysqli_close($link);

	 }
		echo "<script>opener.document.Form1.submit();</script>";
		echo "<script>window.close();</script>";

  }
}  
?>

</form>

</body>
</HTML>
