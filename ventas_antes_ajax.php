<?php
// Sistema			: CAMELIA
// Programa			: VENTAS.PHP
// Descripcion		: Punto de Ventas.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 18/11/2011

session_start();
if (!isset($_SESSION['usuario'])){ $_SESSION['usuario']="";} 
if (!isset($_SESSION['password'])){ $_SESSION['password']="";} 
if (!isset($_SESSION['tipo'])){ $_SESSION['tipo']="";} 
if (!isset($_SESSION['autoriza'])){ $_SESSION['autoriza']="";}

require_once 'admin/config.php';
require_once 'cam_valida.php';

if (!$_POST)
	{
	$_SESSION['codloc_s']="";
	$_SESSION['nomloc_s']="";
	$_SESSION['codven_s']="";
	$_SESSION['codinv_s']="";
	$_SESSION["arrDetalles"] = array();

	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Punto de Ventas</title>
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
        function f_ValidaLocal(){
       /*-----------------------------------*/
            window.location.href = "cam_validalocal.php";
//   		    Form1.cmd_transac.focus();
			
			        }
					
        function f_SelLocal(){
       /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_locales.php' ,'Locales','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
 		    document.getElementById('cmd_transac').focus();
			
			        }
		
        function f_SelVendedor(){
       /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_vendedores.php' ,'Vendedores','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
//   		    Form1.cmd_transac.focus();
			
			        }
		
        function f_SelInventario(){
       /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_inventario.php' ,'Inventario','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
//   		    Form1.cmd_transac.focus();
			
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
		
     function vCod(cod){
   	/*----------------------------------*/
alert("pase" + cod);
		//var cod = Form1.cmd_codigo.value;
		//var anno  = Form1.cmd_codigo.value.substr(0,4)
					/*
		if ( cod.length!==10 )
			  { alert("Código erróneo") 
			
			}
			*/
		cod = cod.replace(/^\s+/g,'').replace(/\s+$/g,''); 					
		if ( cod.length >= 1 && cod.length <13 )
			  { alert("Código erróneo") 
			
			}
		}

		  
	    </script>
	    
    <style type="text/css">
	    div.message{ position:absolute; left:0px; top:0px; width:100%; height:100%; background-color:#000; filter:alpha(opacity=20); -moz-opacity: 0.2; opacity: 0.2;}
	    div#myAlert{ position:absolute; left:0px; top:10px; width:100%; text-align:center;}
	    //.myAlert{ position:absolute; left:35%; padding:25px; width:250px; height:150px; background-color:#FFF; border:2px solid #000; margin:auto; text-align:left;}
	    .closeAlert {position:absolute; right:450px; top:-50px; width:70px; height:70px; background-color:#FFF; background:url(ivvpp/ivvpp0020.gif) no-repeat top left;}
    </style>
	    
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

<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout">
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" id="Form1">
<?php
/*
if (!$_POST)
{
	if (!isset($_SESSION['autoriza']) or $_SESSION['autoriza'] <> "SI") 
	  {
		echo "<script type=\"text/javascript\">
				alert('Acceso denegado......');
				</script>";
		exit();			
	  }				
	else
	{ 
		$_SESSION['autoriza'] = "NO";
		if (($_SESSION['tipo'] <> 'ADM') and ($opc2_w <> 'C'))
		{
		echo "<script type=\"text/javascript\">
				alert('Usuario No Tiene Acceso......');
				</script>";
		exit();	
		}

	}  
}
*/

if (isset($_POST['cmd_transac']))
{
	$transac_w  = $_POST['cmd_transac'];
	}
else
{
	$transac_w  = "";
	}
/*
if (isset($_POST['articulos']))
{
	$articulos_w  = $_POST['articulos'];
	}
else
{
    $fila = 0;
    $articulos_w = array();
    $articulos_w[$fila][0] = '1111111111111';
    $articulos_w[$fila][1] = 'DESCRIPCION DEL ARTICULO';
	$articulos_w[$fila][2] = '12.550';

	}
*/
if (!$_POST)
{
   $arrRegs = array(); 
/*   
   $arrRegs[0]["prod"] = "             "; 
   $arrRegs[0]["cant"] = ""; 
   $arrRegs[0]["prec"] = ""; 
*/
}

//if (isset($_POST["btnAdd"])) 
if ($_POST)
{ 
    // recogemos data posteada por el usuario  
    $arr1 = array(); 
    $arr1["prod"] = $_POST["prod"]; 
    $arr1["cant"] = ""; 
    $arr1["prec"] = ""; 

    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
	
} 

/*
if (!$_POST)
{
    $fila = 0;
    $_POST['articulos'] = array();
    $_POST['articulos'][$fila][0] = '1111111111111';
    $_POST['articulos'][$fila][1] = 'DESCRIPCION DEL ARTICULO';
	$_POST['articulos'][$fila][2] = '12.550';
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

<!-- <script src="/desa_vvpp/WebResource.axd?d=3lC5CkLTZo17F4QZ5jLtcw2&amp;t=633964179561718750" type="text/javascript"></script>
 -->
<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
			<TR>
				<td vAlign="bottom"  align="center" width="500">&nbsp;
					<span id="Label1"  class="texto18">PUNTO DE VENTAS</span></td>
			</TR>
<!-- 			<TR>
				<td background="ivvpp0002.jpg" height="5" style="width: 34px">&nbsp;</td>
				<td width="500" background="ivvpp0005.jpg" height="5">&nbsp;</td>
			</TR>
 -->			<TR>
				<td align="left" width="500" height="6">
					<TABLE width="700" height="149" border="0" cellPadding="0" class="texto13" id="Table2">
        <TR> 
						
          <td style="WIDTH: 90px; HEIGHT: 12px"></td>
						<td style="WIDTH: 234px; HEIGHT: 12px"></td>
						<td style="WIDTH: 70px; HEIGHT: 12px"></td>
						<td class="texto18"  align="right" style="WIDTH: 224px;HEIGHT: 12px"><?php echo date("d/m/Y");?></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Cód.Local</td>
							<td style="WIDTH: 254px; HEIGHT: 2px"><input name="cmd_codloc" type="text" maxlength="2" tabindex="1" id="cmd_codloc" class="input-normal" style="width:56px;"  onChange="<?php cam_validalocal(); ?>" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/>
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelLocal()" />
                			<input name="cmd_nomloc" type="text" maxlength="20" id="cmd_nomloc"  value="<?php echo $_SESSION['nomloc_s']; ?>" readOnly="readonly" />
							</td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Nº Venta</td>
						<td style="WIDTH: 254px; HEIGHT: 3px">
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Transacción</td>
						              <?php
				   echo'<td style="width: 314px; height: 3px"> <select name="cmd_transac" id="cmd_transac" class="texto01" tabindex="2">';

				  	echo "\n<option value='1'>Consulta</option>";
				   	echo "\n<option selected='selected'value='2'>Venta</option>";
				  	echo "\n<option value='3'>Cambio</option>";
				  	echo "\n<option value='4'>Devolución</option>";
				  	echo "\n<option value='5'>Separado</option>";
				  	echo "\n<option value='6'>Abono Separado</option>";
				  	echo "\n<option value='7'>Devolución Separado</option>";
				  	echo "\n<option value='8'>Entrega Separado</option>";
				  	echo "\n<option value='9'>Personal</option>";
				  	echo "\n<option value='10'>Anulación</option>";
				  echo "\n</select></td>";
				?>

					  </TR>
					  <TR> 
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Vendedor</td>
							<td style="WIDTH: 254px; HEIGHT: 2px"><input name="cmd_codven" type="text" maxlength="2" id="cmd_codven" tabindex="3" class="input-normal" style="width:56px;" value="<?php if (isset($_SESSION['codven_s'])){ echo $_SESSION['codven_s']; } ?>"/>
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelVendedor()" /></td>
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Nº Separado</td>
						<td style="WIDTH: 224px; HEIGHT: 3px">
<!-- 						<input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>" disabled="disabled" /> </td>
 -->					  </TR>
					  <TR> 
					<td style="WIDTH: 90px; HEIGHT: 19px">&nbsp;&nbsp;&nbsp;&nbsp;Forma Pago</td>
						<td style="WIDTH: 254px; HEIGHT: 19px">
<!-- 						<input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/></td>
 -->					  </TR>
					  <TR> 
						<td style="WIDTH: 90px; HEIGHT: 6px">&nbsp;&nbsp;&nbsp;&nbsp;Total Abono</td>
						<td style="WIDTH: 254px; HEIGHT: 6px">
<!-- 						<input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/></td>
 -->						<td style="WIDTH: 90px; HEIGHT: 6px">&nbsp;&nbsp;&nbsp;&nbsp;Total a pagar</td>
						<td style="WIDTH: 224px; HEIGHT: 6px">
<!-- 						<input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/></td>
 -->					  </TR>

					  </TABLE>
				</td>
				</TR>
				
					<TR>
		<td vAlign="top" align="center" width="700" height="145">
    		<P><table cellspacing="0" cellpadding="3" align="Left" rules="all" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:700px;border-collapse:collapse;">
	<tr style="color:#000080;background-color:#ffffff;">
		<td width="159">Artículo</td><td width="379">Descripción</td><td width="134">Precio</td>
	</tr>
	<?php
    for ($i = 0; $i < count($arrRegs); $i++) 
    { 
        echo '<tr style="color:#ffffff;background-color:#000080;">'; 
        echo "<td>".$arrRegs[$i]["prod"]."</td>"; 
        echo "<td>".$arrRegs[$i]["cant"]."</td>"; 
        echo "<td>".$arrRegs[$i]["prec"]."</td>"; 
        echo "</tr>"; 
    } 
 
	?> 
	
<!-- 		<tr style="color:#ffffff;background-color:#000080;">
		<td><input name="cmd_codart" type="text" id="cmd_codart" class="input-normal" style="width:86px;"  maxlength="13" value="<?php echo $articulos_w[0][0]; ?>"/>
			<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelInventario()" /></td>
		<td><?php echo $articulos_w[0][1]; ?></td>
		<td><?php echo $articulos_w[0][2]; ?></td>
	</tr>
 -->	
    <tr> 
        <td><input name="prod" type="text" class="input-normal" id="prod" onChange="vCod('prod')" tabindex="4" size="15" maxlength="13"> 
		<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelInventario()" /></td> 
        <td></td> 
        <td></td> 
        <td><input type="submit" name="btnAdd" value="Agregar"></td> 
    </tr> 
		
    </table></P>	</td> </TR>

				
				
				
<?php	
if ($_POST) 
{
 if (isset($_POST["cmd_buscar"])) 
    {
    
	$cod_w = $_POST["cmd_codloc"];
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_locales('".$cod_w."')";

	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="500" height="145">';
//    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:554px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
	echo '	<td>&nbsp;</td><td>Código</td><td>Nombre</td><td>Dirección</td><td>Ciudad</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
//		echo '<tr style="background-color:#F7F7F7;">';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td></td><td>';
		echo '<input type="radio" name="rbnRut" value="'.$row["codloc"].'" onClick="Remueve_Opcion2(&quot;'.$row["codloc"].'&quot;,&quot;'.$opc_w.'&quot;)"/>';
		echo '<label for="rbnRut">'.$row["codloc"].'</label>';
		echo '</td><td>'.utf8_decode($row["nombre"]).'</td>';
		echo '<td>'.utf8_decode($row["direcc"]).'</td>';
		echo '<td>'.$row["ciudad"].'</td>';
		echo '</tr>';
    	}
		
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table></P>	</td> </TR>';
	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '						align="center" border="0">';
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

	}
}

?>
  <div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdCodLoc" id="hdCodLoc" />
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
  </div>

</form>

</body>
</HTML>
