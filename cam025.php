<?php
// Sistema			: CAMELIA
// Programa			: CAMO25.PHP
// Descripcion		: Buscador de Proveedores por nombre.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 07/11/2011

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
			
      		function f_valida(){
			/*----------------*/
//			alert(Form1.cmd_codloc2.value.length);
  				if(Form1.cmd_nompro2.value.length > 0) {
					if(Form1.cmd_nompro2.value < Form1.cmd_nompro1.value ) {
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
$_SESSION['nompro1_s'] = "";
$_SESSION['nompro2_s'] = "";

if ($_POST) {
    $_SESSION['nompro1_s'] = $_POST['cmd_nompro1'];
    $_SESSION['nompro2_s'] = $_POST['cmd_nompro2'];

}
?>
			<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
				<TR>
					<td vAlign="bottom" width="500">&nbsp;
						<span id="Label1" class="texto18">CONSULTA DE PROVEEDORES</span></td>
				</TR>
				<TR>
					<td align="left" width="500" height="6">
						<TABLE width="622" height="93" border="0" cellPadding="0" class="texto13" id="Table2">
        <TR> 
						<td style="WIDTH: 110px; HEIGHT: 12px"></td>
						<td style="WIDTH: 224px; HEIGHT: 12px"></td>
						<td style="WIDTH: 70px; HEIGHT: 12px"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 110px; HEIGHT: 3px">Ingrese Nombre Desde</td>
						<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_nompro1" type="text" id="cmd_nompro1" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['nompro1_s'])){ echo $_SESSION['nompro1_s']; } ?>" onChange="f_valida()"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 110px; HEIGHT: 3px">Ingrese Nombre Hasta</td>
						<td style="WIDTH: 224px; HEIGHT 3px"><input name="cmd_nompro2" type="text" id="cmd_nompro2" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['nompro2_s'])){ echo $_SESSION['nompro2_s']; } ?>" onChange="f_valida()"/></td>
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
    $_SESSION['nompro1_s'] = $_POST['cmd_nompro1'];
    $_SESSION['nompro2_s'] = $_POST['cmd_nompro2'];
	
//    $extra = 'cam024_muestra.php?CODIGO=' ;
/*		echo "<script>parent.frames['mainFrame'].location.href= 'eco_autoriza.php?PAGINA="."'eco002_muestra.php?OPC=';</script>";
*/
	echo "<script>parent.frames['mainFrame'].location.href='eco_autoriza.php?PAGINA=cam025_muestra.php?';</script>";
//    header("Location: $extra");
//	ob_end_flush();
	}
}  
?>

</form>

</body>
</HTML>
