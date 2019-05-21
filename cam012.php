<?php
// Sistema			: CAMELIA
// Programa			: CAMO12.PHP
// Descripcion		: Buscador de Inventario.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 29/08/2011

// iniciamos sesiones
//ob_start();
session_start();
require_once 'admin/config.php';

if (!$_POST)
	{
//	if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";}
	$_SESSION['codloc_s']="";
	$_SESSION['codpro_s']=""; 
	$_SESSION['codart_s']=""; 
	$_SESSION['codcol_s']=""; 
	$_SESSION['talla_s']=""; 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head><title>Busqueda</title>
		<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
		
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>  
		<script language="javascript">
		
   		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
        function f_SelLocal(){
        /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_locales.php' ,'Locales','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
			        }
	
        function f_SelProveedor(){
        /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_proveedores.php' ,'Proveedores','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
			        }
	
        function f_SelArticulo(){
        /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_articulos.php' ,'Articulos','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
			        }

        function f_SelColor(){
        /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_colores.php' ,'Colores','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
			        }
	
			function f_cliente(iparamt){
			/*-------------------------*/
	             window.open('eco_autoriza.php?PAGINA=' + 'cam013.php?CODIGO=' ,'cam013','width=500, height=350, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();
			}
	    </script>
	    
	</head>
<?php

if ( isset($_GET["OPC"]) ) {
   $opc_w = $_GET["OPC"];   
}
else {
  $opc_w = "C";  //solo consulta
}

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

$_SESSION['opcpac_s'] = $opc_w;
/*
if ($_POST )
  { 
    $_SESSION['codloc_s'] = $_POST['cmd_codloc'];
    $_SESSION['codpro_s'] = $_POST['cmd_codpro'];
    $_SESSION['codart_s'] = $_POST['cmd_codart'];
    $_SESSION['codcol_s'] = $_POST['cmd_codcol'];
    $_SESSION['talla_s'] = $_POST['cmd_talla'];
  }
*/


if ($_POST) 
{
 if (isset($_POST["cmd_buscar"]) )
    {
    $_SESSION['codloc_s'] = $_POST['cmd_codloc'];
    $_SESSION['codpro_s'] = $_POST['cmd_codpro'];
    $_SESSION['codart_s'] = $_POST['cmd_codart'];
    $_SESSION['codcol_s'] = $_POST['cmd_codcol'];
    $_SESSION['talla_s'] = $_POST['cmd_talla'];
	
    $extra = 'cam012_muestra.php?CODIGO=' ;
	echo "<script>parent.frames['mainFrame'].location.href='cam012_muestra.php?OPC=$opc_w';</script>";
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
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
				<TR>
					<td vAlign="bottom" width="500">&nbsp;
						<span id="Label1" class="texto18">INVENTARIO</span></td>
				</TR>
				<TR>
					<td align="left" width="500" height="6">
						<TABLE width="696" height="93" border="0" cellPadding="0" class="texto13" id="Table2">
        <TR> 
							<td width="108" style="WIDTH: 90px; HEIGHT: 2px">Código Local</td>
							<td width="269" style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codloc" type="text" maxlength="2" id="cmd_codloc" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/>
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelLocal()" /></td>
							<td width="125" align="center" style="WIDTH: 70px; HEIGHT: 2px"></td>
							<td width="184" align="center" style="HEIGHT: 2px"></td>
						  </TR>
		  					<TR> 
							<td style="WIDTH: 90px; HEIGHT: 2px">Código Proveedor</td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codpro" type="text" id="cmd_codpro" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codpro_s'])){ echo $_SESSION['codpro_s']; } ?>"/>
    						<input name="imgprov" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelProveedor()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
		  					<TR> 
							<td style="WIDTH: 90px; HEIGHT: 2px">Código Artículo</td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codart" type="text" id="cmd_codart" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codart_s'])){ echo $_SESSION['codart_s']; } ?>"/>
							<input name="imgart" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelArticulo()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
						  <TR> 
							<td height="22" style="WIDTH: 90px; HEIGHT: 2px">Código Color</td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codcol" type="text" id="cmd_codcol" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codcol_s'])){ echo $_SESSION['codcol_s']; } ?>"/>
							<input name="imgcol" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelColor()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
						  						  <TR> 
							<td height="22" style="WIDTH: 90px; HEIGHT: 2px">Talla</td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_talla" type="text" id="cmd_talla" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['talla_s'])){ echo $_SESSION['talla_s']; } ?>"/></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" id="cmd_buscar" class="boton" /></td>
							<?php
	 							 echo '<td style="HEIGHT: 2px" align="center"><input type="submit" name="cmd_agregar" value="Agregar" onClick="javascript:f_cliente();return false;" id="cmd_agregar" class="boton" </td>';
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
/*
if ($_POST) 
{
 if (isset($_POST["cmd_buscar"]) )
    {
    $_SESSION['codloc_s'] = $_POST['cmd_codloc'];
    $_SESSION['codpro_s'] = $_POST['cmd_codpro'];
    $_SESSION['codart_s'] = $_POST['cmd_codart'];
    $_SESSION['codcol_s'] = $_POST['cmd_codcol'];
    $_SESSION['talla_s'] = $_POST['cmd_talla'];
	
    $extra = 'cam012_muestra.php?CODIGO=' ;
	echo "<script>parent.frames['mainFrame'].location.href='eco_autoriza.php?PAGINA=cam012_muestra.php?OPC=$opc_w';</script>";
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
*/ 
?>

</form>

</body>
</HTML>
