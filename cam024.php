<?php
// Sistema			: CAMELIA
// Programa			: CAMO24.PHP
// Descripcion		: Buscador de Proveedores por código.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 18/10/2011

// iniciamos sesiones
//ob_start();
session_start();

require_once 'admin/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head><title>Consulta de Proveedores</title>
		<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
		
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>  
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			function f_cliente(iparamt){
			/*-------------------------*/
	             window.open('eco_autoriza.php?PAGINA=' + 'cam003.php?COD=' ,'cam003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();

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
			
      		function f_valida(){
			/*----------------*/
//			alert(Form1.cmd_codloc2.value.length);
  				if(Form1.cmd_codpro2.value.length > 0) {
					if(Form1.cmd_codpro2.value < Form1.cmd_codpro1.value ) {
					  alert("Rango Erróneo")
					  }
				 }	  
			}

	    </script>
	    
	</head>
<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >

<form name="Form1" method="post" "<?php echo $_SERVER['SCRIPT_NAME']; ?>" id="Form1">
<?php
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

<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
<?php
$_SESSION['codpro1_s'] = "";
$_SESSION['codpro2_s'] = "";

if ($_POST) {
    $_SESSION['codpro1_s'] = $_POST['cmd_codpro1'];
    $_SESSION['codpro2_s'] = $_POST['cmd_codpro2'];

}
?>
			<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
				<TR>
					<td vAlign="bottom" width="500">&nbsp;
						<span id="Label1" class="texto18">CONSULTA DE PROVEEDORES</span></td>
				</TR>
				<TR>
					<td align="left" width="500" height="6">
						<TABLE width="648" height="93" border="0" cellPadding="0" class="texto13" id="Table2">
        <TR> 
						<td style="WIDTH: 110px; HEIGHT: 12px"></td>
						<td style="WIDTH: 224px; HEIGHT: 12px"></td>
						<td style="WIDTH: 70px; HEIGHT: 12px"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 110px; HEIGHT: 3px">Ingrese Código Desde</td>
						<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_codpro1" type="text" id="cmd_codpro1" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codpro1_s'])){ echo $_SESSION['codpro1_s']; } ?>" onChange="f_valida()"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 110px; HEIGHT: 3px">Ingrese Código Hasta</td>
						<td style="WIDTH: 224px; HEIGHT 3px"><input name="cmd_codpro2" type="text" id="cmd_codpro2" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codpro2_s'])){ echo $_SESSION['codpro2_s']; } ?>" onChange="f_valida()"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" onclick="f_valida()" id="cmd_buscar" class="boton" /></td>
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
    $_SESSION['codpro1_s'] = $_POST['cmd_codpro1'];
    $_SESSION['codpro2_s'] = $_POST['cmd_codpro2'];
	
//    $extra = 'cam024_muestra.php?CODIGO=' ;
/*		echo "<script>parent.frames['mainFrame'].location.href= 'eco_autoriza.php?PAGINA="."'eco002_muestra.php?OPC=';</script>";
*/
	echo "<script>parent.frames['mainFrame'].location.href='cam024_muestra.php?';</script>";
//    header("Location: $extra");
//	ob_end_flush();
	}
/*
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
  */
}  
?>

</form>

</body>
</HTML>
