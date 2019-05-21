<?php
// Sistema			: CAMELIA
// Programa			: CAMO29.PHP
// Descripcion		: Buscador de Inventario (por rango).
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 23/11/2011

// iniciamos sesiones
//ob_start();
session_start();
require_once 'admin/config.php';

if (!$_POST)
	{
//	if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";}
	$_SESSION['codloc1_s']="";
	$_SESSION['codloc2_s']="";
	$_SESSION['codpro1_s']=""; 
	$_SESSION['codpro2_s']=""; 
	$_SESSION['codart1_s']=""; 
	$_SESSION['codart2_s']=""; 
	$_SESSION['codcol1_s']=""; 
	$_SESSION['codcol2_s']=""; 
	$_SESSION['talla1_s']=""; 
	$_SESSION['talla2_s']=""; 

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
    $_SESSION['codloc1_s'] = $_POST['cmd_codloc1'];
    $_SESSION['codloc2_s'] = $_POST['cmd_codloc2'];
    $_SESSION['codpro1_s'] = $_POST['cmd_codpro1'];
    $_SESSION['codpro2_s'] = $_POST['cmd_codpro2'];
    $_SESSION['codart1_s'] = $_POST['cmd_codart1'];
    $_SESSION['codart2_s'] = $_POST['cmd_codart2'];
    $_SESSION['codcol1_s'] = $_POST['cmd_codcol1'];
    $_SESSION['codcol2_s'] = $_POST['cmd_codcol2'];
    $_SESSION['talla1_s'] = $_POST['cmd_talla1'];
    $_SESSION['talla2_s'] = $_POST['cmd_talla2'];
	
    $extra = 'cam029_muestra.php?CODIGO=' ;
	echo "<script>parent.frames['mainFrame'].location.href='eco_autoriza.php?PAGINA=cam029_muestra.php?OPC=$opc_w';</script>";
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
						<span id="Label1" class="texto18">CONSULTA DE INVENTARIO</span></td>
				</TR>
				<TR>
					<td align="left" width="500" height="6">
						<TABLE width="642" height="119" border="0" cellPadding="0" class="texto13" id="Table2">
        <TR> 
							
          <td width="214"  align="right" style="WIDTH: 190px; HEIGHT: 2px">Ingrese Código Local Desde : </td>
							<td width="224" style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codloc1" type="text" maxlength="2" id="cmd_codloc1" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codloc1_s'])){ echo $_SESSION['codloc1_s']; } ?>"/>
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelLocal()" /></td>
							<td width="74" align="center" style="WIDTH: 70px; HEIGHT: 2px"></td>
							<td width="120" align="center" style="HEIGHT: 2px"></td>
						  </TR>
         					<TR> 
							
          <td style="WIDTH: 190px; HEIGHT: 2px" align="right">Código Local Hasta : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codloc2" type="text" maxlength="2" id="cmd_codloc2" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codloc2_s'])){ echo $_SESSION['codloc2_s']; } ?>"/>
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelLocal()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>

		  					<TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px" align="right">Ingrese Código Proveedor Desde : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codpro1" type="text" id="cmd_codpro1" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codpro1_s'])){ echo $_SESSION['codpro1_s']; } ?>"/>
    						<input name="imgprov" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelProveedor()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
						  	<TR> 
							
          <td style="WIDTH: 190px; HEIGHT: 2px" align="right">Código Proveedor Hasta : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codpro2" type="text" id="cmd_codpro2" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codpro2_s'])){ echo $_SESSION['codpro2_s']; } ?>"/>
    						<input name="imgprov" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelProveedor()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>

		  					<TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px" align="right">Ingrese Código Artículo Desde : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codart1" type="text" id="cmd_codart1" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codart1_s'])){ echo $_SESSION['codart1_s']; } ?>"/>
							<input name="imgart" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelArticulo()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
		  					<TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px" align="right">Código Artículo Hasta : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codart2" type="text" id="cmd_codart2" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codart2_s'])){ echo $_SESSION['codart2_s']; } ?>"/>
							<input name="imgart" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelArticulo()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
						  <TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px" align="right">Ingrese Código Color Desde : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codcol1" type="text" id="cmd_codcol1" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codcol1_s'])){ echo $_SESSION['codcol1_s']; } ?>"/>
							<input name="imgcol" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelColor()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
						  <TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px" align="right">Código Color Hasta : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_codcol2" type="text" id="cmd_codcol2" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codcol2_s'])){ echo $_SESSION['codcol2_s']; } ?>"/>
							<input name="imgart" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelArticulo()" /></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>
						  <TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px" align="right">Ingrese Talla Desde : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_talla1" type="text" id="cmd_talla1" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['talla1_s'])){ echo $_SESSION['talla1_s']; } ?>"/>
          					</td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"></td>
							<td style="HEIGHT: 2px" align="center"></td>
						  </TR>

						   <TR> 
							<td style="WIDTH: 190px; HEIGHT: 2px" align="right">Talla Hasta : </td>
							<td style="WIDTH: 224px; HEIGHT: 2px"><input name="cmd_talla2" type="text" id="cmd_talla2" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['talla2_s'])){ echo $_SESSION['talla2_s']; } ?>"/></td>
							<td style="WIDTH: 70px; HEIGHT: 2px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" id="cmd_buscar" class="boton" /></td>
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
