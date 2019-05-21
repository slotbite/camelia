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

//incluímos la clase ajax
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax(); 
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

require_once 'admin/config.php';

function cam_validalocal($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
$_SESSION['nomloc_s']="";
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("cmd_nomloc","value","Debes ingresar un local");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("cmd_nomloc","style.color","red");
	$respuesta->script("xajax.$('cmd_codloc').focus();");
  
}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_locales('".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nomloc","value","Local no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nomloc","style.color","red");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nomloc_s']=utf8_decode($row["nombre"]);
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("cmd_nomloc","value",$_SESSION['nomloc_s']);
		$respuesta->assign("cmd_nomloc","style.color","blue");

		}
  }
return $respuesta;
}
function cam_validavendedor($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
$_SESSION['nomven_s']="";
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("cmd_nomven","value","Debes ingresar un vendedor");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("cmd_nomven","style.color","red");
	$respuesta->script("xajax.$('cmd_codven').focus();");

}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_vendedores('".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nomven","value","Vendedor no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nomven","style.color","red");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nomven_s']=utf8_decode($row["nombre"]);
				$_SESSION['codven_s']=$cod;
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("cmd_nomven","value",$_SESSION['nomven_s']);
		$respuesta->assign("cmd_nomven","style.color","blue");

		}
  }
return $respuesta;
}
function cam_valida_articulo($cod,$loc)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

$_SESSION['nomart_s']="";
/*
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("desc","value","Debes ingresar un articulo");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("desc","style.color","red");
}else{
*/
if ($cod <> ""){
//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
//	$loc = $_SESSION['codloc_s'];
	$pro = substr($cod,0,3);
	$art = substr($cod,3,4);
	$col = substr($cod,7,2);
	$tall = substr($cod,9,3);

	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_inventario('".$loc."','".$pro."','".$art."','".$col."','".$tall."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
		$respuesta->assign("desc","value","Artículo no existe en el Inventario");
//        $var = "no existe" . " ". $loc. " ".$cod;
//		$respuesta->assign("desc","value",$var);

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("desc","style.color","red");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nomart_s'] = utf8_decode($row["nomfa"])." ".utf8_decode($row["nomart"])." ".utf8_decode($row["nomcol"])." ".utf8_decode($row["talla"]);
				$precio = $row["prevta"];
				$desc2 = utf8_decode($row["nomfa"])." ".$pro." ".utf8_decode($row["nomcol"])." ".utf8_decode($row["talla"]);

			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("desc","value",$_SESSION['nomart_s']);
		$respuesta->assign("desc","style.color","blue");
		$respuesta->assign("prec","value",$precio);
		$respuesta->assign("prec","style.color","blue");
        $_SESSION['totpag_s'] = $_SESSION['totpag_s'] + $precio;
		$respuesta->assign("cmd_totpag","value",$_SESSION['totpag_s']);
//		$respuesta->assign("btnAdd","value",$_SESSION['totpag_s']);

    $arr1 = array(); 
    $arr1["prod"] = $cod; 
    $arr1["desc"] = $_SESSION['nomart_s']; 
    $arr1["prec"] = $precio; 
    $arr1["desc2"] = $desc2; 


    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
	
	$contenido = '';
    $contenido .= '		<P><table cellspacing="0" cellpadding="3" align="Left" rules="all" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:700px;border-collapse:collapse;">';
	$contenido .= '		<tr style="color:#000080;background-color:#ffffff;">';
	$contenido .= '			<td width="159">Artículo</td><td width="379">Descripción</td><td width="134">Precio</td>';
	$contenido .= '		</tr>';


    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
        $contenido .= '<tr style="color:#ffffff;background-color:#000080;">'; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["prod"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["desc"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["prec"]."</td>"; 
        $contenido .= "</tr>"; 
    } 


        $contenido .= "<tr>"; 
        $contenido .= "<td><input name='prod' type='text' class='input-normal' id='prod' onBlur='javascript:xajax_cam_valida_articulo(document.Form1.prod.value,document.Form1.cmd_codloc.value)' tabindex='4' size='15' maxlength='13'> ";
		$contenido .= "<input name='imgloc' type='image'  src='ieco/isase458.jpg' width='19' height='19' border='0' onclick='f_SelInventario()' /></td> ";
        $contenido .= "<td><input name='desc' type='text' class='input-normal' id='desc' size='60' readOnly='readonly'></td>"; 
        $contenido .= "<td><input name='prec' type='text' class='input-normal' id='prec' size='10' readOnly='readonly'></td>"; 
//        $contenido .= "<td><input type='submit' name='btnAdd' value='Agregar'></td> ";
        $contenido .= "</tr>"; 
     	$contenido .= '</table></P>';

		$respuesta->assign("det_articulos","innerHTML",$contenido);

/*
	$contenido = "Roxana";
    $contenido = '<div style="border: 2px solid #0000cc; font-size: 8pt; padding:5px; margin-top:10px; width: 300px;">' . $contenido . '</div>';

	$respuesta->Assign("det_articulos","innerHTML",$contenido);
*/	
		}
  }
return $respuesta;
}

//registramos la función creada anteriormente al objeto xajax
$xajax->registerFunction("cam_validalocal");
$xajax->registerFunction("cam_validavendedor");
$xajax->registerFunction("cam_valida_articulo");

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

if (!$_POST)
	{
	$_SESSION['codloc_s']="";
	$_SESSION['nomloc_s']="";
	$_SESSION['codven_s']="";
	$_SESSION['nomven_s']="";
	$_SESSION['codinv_s']="";
	$_SESSION['nomart_s']="";
	$_SESSION["arrDetalles"] = array();
	$_SESSION['totpag_s']="";

	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Punto de Ventas</title>
	    <?php
		//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
		$xajax->printJavascript("../xajax/");
		?>

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
		
		function pregunta()
		{
//		    alert(Form1.cmd_fpago.value);
			if(confirm("¿Confirma Venta?"))
//			document.location.href="ventas_i.php";
//            window.location.href = "cam_validalocal.php";
			window.open('ventas_i.php?FPAGO='+Form1.cmd_fpago.value,'ventas_i','width=350, height=350, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			else
			document.location.href="no.html"; 
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
/*
//if (isset($_POST["btnAdd"])) 
if ($_POST)
{ 
    // recogemos data posteada por el usuario  
    $arr1 = array(); 
    $arr1["prod"] = $_POST["prod"]; 
    $arr1["desc"] = $_POST["desc"]; 
    $arr1["prec"] = $_POST["prec"]; 

    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
	
} 
*/
?>
<div id="encabezado">
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
			<TR>
				<td vAlign="bottom"  align="center" width="500">&nbsp;
					<span id="Label1"  class="texto18">PUNTO DE VENTAS</span></td>
			</TR>
			<TR>
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
							<td style="WIDTH: 254px; HEIGHT: 2px"><input name="cmd_codloc" type="text" maxlength="2" tabindex="1" id="cmd_codloc" class="input-normal" style="width:56px;"  onBlur="javascript:xajax_cam_validalocal(document.Form1.cmd_codloc.value)" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/>
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelLocal()" />
                			<input name="cmd_nomloc" type="text" maxlength="20" id="cmd_nomloc" value="<?php echo $_SESSION['nomloc_s']; ?>" readOnly="readonly" />
							</td>
							<div id="mensaje_loc"></div>
					  </TR>
					  <TR> 
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Nº Venta</td>
						<td style="WIDTH: 254px; HEIGHT: 3px">
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Transacción</td>
						              <?php
				   echo'<td style="width: 314px; height: 3px"> <select name="cmd_transac" id="cmd_transac" class="texto01" tabindex="2">';

				  	echo "\n<option value='1'>Consulta</option>";
				   	echo "\n<option selected='selected' value='2'>Venta</option>";
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
							<td style="WIDTH: 254px; HEIGHT: 2px"><input name="cmd_codven" type="text" maxlength="2" id="cmd_codven" tabindex="3" class="input-normal" style="text-transform: uppercase;width:56px;" onBlur="javascript:xajax_cam_validavendedor(document.Form1.cmd_codven.value)" value="<?php if (isset($_SESSION['codven_s'])){ echo $_SESSION['codven_s']; } ?>" />
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelVendedor()" />
                			<input name="cmd_nomven" type="text" maxlength="20" id="cmd_nomven"  value="<?php echo $_SESSION['nomven_s']; ?>" readOnly="readonly" />
						</td>
						<td style="WIDTH: 90px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp;Nº Separado</td>
						<td style="WIDTH: 224px; HEIGHT: 3px">
<!-- 						<input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>" disabled="disabled" /> </td>
 -->					  </TR>
					  <TR> 
					<td style="WIDTH: 90px; HEIGHT: 19px">&nbsp;&nbsp;&nbsp;&nbsp;Forma Pago</td>
	              <?php
				   echo'<td style="width: 314px; height: 3px"> <select name="cmd_fpago" id="cmd_fpago" class="texto01" tabindex="6" onBlur="pregunta()">';

				  	echo "\n<option selected='selected' value='1'>Contado Efectivo</option>";
				   	echo "\n<option value='2'>Contado Documentado</option>";
				  	echo "\n<option value='3'>Cheque a Fecha</option>";
				  	echo "\n<option value='4'>CR-Camelia</option>";
				  	echo "\n<option value='5'>Tarjetas de Crédito</option>";
				  	echo "\n<option value='6'>Habilitados</option>";
				  	echo "\n<option value='7'>Instituciones</option>";
				  	echo "\n<option value='8'>Créditos Particulares</option>";
				  	echo "\n<option value='9'>Mixta</option>";
				  echo "\n</select></td>";
				?>
					  </TR>
					  <TR> 
						<td style="WIDTH: 90px; HEIGHT: 6px">&nbsp;&nbsp;&nbsp;&nbsp;Total Abono</td>
						<td style="WIDTH: 254px; HEIGHT: 6px">
<!-- 						<input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/></td>
 -->						<td style="WIDTH: 90px; HEIGHT: 6px">&nbsp;&nbsp;&nbsp;&nbsp;Total a pagar</td>
						<td style="WIDTH: 224px; HEIGHT: 6px">
               			<input name="cmd_totpag" type="text" maxlength="10" id="cmd_totpag"  tabindex="5" value="<?php echo $_SESSION['totpag_s']; ?>" readOnly="readonly" />

<!-- 						<input name="cmd_codloc" type="text" id="cmd_codloc" class="input-normal" style="width:96px;" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/></td>
 -->					  </TR>

					  </TABLE>
				</td>
				</TR>
				
		</TABLE>
</div>    			
	<div id="det_articulos">
    		<P><table cellspacing="0" cellpadding="3" align="Left" rules="all" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:700px;border-collapse:collapse;">
			<tr style="color:#000080;background-color:#ffffff;">
				<td width="159">Artículo</td><td width="379">Descripción</td><td width="134">Precio</td>
			</tr>

	<?php
//	$_SESSION["arrDetalles"]
//	$arrRegs
/*
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
        echo '<tr style="color:#ffffff;background-color:#000080;">'; 
        echo "<td>".$_SESSION["arrDetalles"][$i]["prod"]."</td>"; 
        echo "<td>".$_SESSION["arrDetalles"][$i]["desc"]."</td>"; 
        echo "<td>".$_SESSION["arrDetalles"][$i]["prec"]."</td>"; 
        echo "</tr>"; 
    } 
*/
	?>	

        <tr>
        <td><input name='prod' type='text' class='input-normal' id='prod' onBlur='javascript:xajax_cam_valida_articulo(document.Form1.prod.value,document.Form1.cmd_codloc.value)' tabindex='4' size='15' maxlength='13'> 
		<input name='imgloc' type='image'  src='ieco/isase458.jpg' width='19' height='19' border='0' onclick='f_SelInventario()' /></td> 
        <td><input name='desc' type='text' class='input-normal' id='desc' size='60' readOnly='readonly'></td> 
        <td><input name='prec' type='text' class='input-normal' id='prec' size='10' readOnly='readonly'></td>
<!--         <td><input type='submit' name='btnAdd' value='Agregar'></td> 
 -->        </tr>

	</table></P>
	
    </div>
	
  <div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdCodLoc" id="hdCodLoc" />
  </div>

</form>

</body>
</HTML>
