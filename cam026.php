<?php
// Sistema			: CAMELIA
// Programa			: CAMO26.PHP
// Descripcion		: Buscador de Artículos por rango de prov y art.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 07/11/2011

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

        function f_SelProveedor(opc){
        /*-----------------------------------*/
//		    alert("opc " + opc);
            window.open('eco_autoriza.php?PAGINA=' + 'cam_proveedores.php?OPC=' + opc,'Proveedores','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
			        }

        function f_SelArticulo(opc){
        /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_articulos_rango.php?OPC=' + opc,'Articulos','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
			        }


			function f_cliente(iparamt){
			/*-------------------------*/
	             window.open('eco_autoriza.php?PAGINA=' + 'cam009.php?COD=' ,'cam003','width=500, height=350, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();

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
if (!$_POST)
{
$_SESSION['codpro1_s'] = "";
$_SESSION['codpro2_s'] = "";
$_SESSION['codart1_s'] = "";
$_SESSION['codart2_s'] = "";
}
//$_SESSION['opcpac_s'] = $opc_w;
/*
if ($_POST) {
    $_SESSION['codpro1_s'] = $_POST['cmd_codpro1'];
    $_SESSION['codpro2_s'] = $_POST['cmd_codpro2'];
    $_SESSION['codart1_s'] = $_POST['cmd_codart1'];
    $_SESSION['codart2_s'] = $_POST['cmd_codart2'];

}
*/
?>
			<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
				<TR>
					<td vAlign="bottom" width="500">&nbsp;
						<span id="Label1" class="texto18">CONSULTA DE ARTICULOS</span></td>
				</TR>
				<TR>
					<td align="left" width="500" height="6">
						<TABLE width="683" height="137" border="0" cellPadding="0" class="texto13" id="Table2">
        <TR> 
							<td width="190" style="WIDTH: 190px; HEIGHT: 2px">Código Proveedor Desde</td>
							<td width="204" style="WIDTH: 204px; HEIGHT: 2px"><input name="cmd_codpro1" type="text" id="cmd_codpro1" class="input-normal" style="width:26px;" value="<?php if (isset($_SESSION['codpro1_s'])){ echo $_SESSION['codpro1_s']; } ?>"/>
    						<input name="imgprov" type="image"  src="ieco/isase458.jpg" width="16" height="16" border="0" onclick="f_SelProveedor(1)" /></td>
							<td width="159" align="center" style="WIDTH: 70px; HEIGHT: 2px"></td>
							<td width="184" align="center" style="HEIGHT: 2px"></td>
						  </TR>
          					<TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px">Código Proveedor Hasta</td>
							<td style="WIDTH: 204px; HEIGHT: 2px"><input name="cmd_codpro2" type="text" id="cmd_codpro2" class="input-normal" style="width:26px;" value="<?php if (isset($_SESSION['codpro2_s'])){ echo $_SESSION['codpro2_s']; } ?>"/>
    						<input name="imgprov" type="image"  src="ieco/isase458.jpg" width="16" height="16" border="0" onclick="f_SelProveedor(2)" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>

						  <TR> 
							<td height="22" style="WIDTH: 190px; HEIGHT: 2px">Código Artículo Desde</td>
							<td style="WIDTH: 204px; HEIGHT: 2px"><input name="cmd_codart1" type="text" id="cmd_codart1" class="input-normal" style="width:46px;" value="<?php if (isset($_SESSION['codart1_s'])){ echo $_SESSION['codart1_s']; } ?>"/>
							<input name="imgart" type="image"  src="ieco/isase458.jpg" width="16" height="16" border="0" onclick="f_SelArticulo(1)" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
						  <TR> 
							
          <td height="43" style="WIDTH: 190px; HEIGHT: 2px">Código Artículo Hasta</td>
							<td style="WIDTH: 204px; HEIGHT: 2px"><input name="cmd_codart2" type="text" id="cmd_codart2" class="input-normal" style="width:46px;" value="<?php if (isset($_SESSION['codart2_s'])){ echo $_SESSION['codart2_s']; } ?>"/>
							<input name="imgart" type="image"  src="ieco/isase458.jpg" width="16" height="16" border="0" onclick="f_SelArticulo(2)" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" id="cmd_buscar" class="boton" /></td>
							<td style="HEIGHT: 2px" align="center"></td>
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
    $_SESSION['codart1_s'] = $_POST['cmd_codart1'];
    $_SESSION['codart2_s'] = $_POST['cmd_codart2'];

	echo "<script>parent.frames['mainFrame'].location.href='eco_autoriza.php?PAGINA=cam026_muestra.php?';</script>";
//    header("Location: $extra");
//	ob_end_flush();
	}

}  
?>

</form>

</body>
</HTML>
