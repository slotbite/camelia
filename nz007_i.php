<?php
// Sistema			: NAZARETH
// Programa			: NZ007_i.PHP
// Descripcion		: Ingreso Compras.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 28/08/2012

session_start();

//incluímos la clase ajax
 require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax(); 
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);
//$xajax->configure ( 'debug',true );

require_once 'admin/config.php';

function nz_codigo($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();
if ($cod == "" or $cod == "0"){
//$respuesta->assign("mensaje","innerHTML","Debes escribir algo como nombre de usuario");
	$respuesta->assign("desc","value","Debe ingresar un codigo");
	$respuesta->assign("desc","style.color","red");
	$respuesta->script("xajax.$('prod').focus();");
}else{

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call nz_psel_insumos('".$cod."')";
	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
		$respuesta->assign("desc","value","Insumo no existe");
		$respuesta->assign("desc","style.color","red");
		$respuesta->script("xajax.$('prod').focus();");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$nom_w =utf8_decode($row["descrip"]);
				$uni_w =utf8_decode($row["nomuni"]);
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("desc","value",$nom_w);
//		$respuesta->assign("desc","value",$cod);
		$respuesta->assign("desc","style.color","blue");
		$respuesta->assign("unid","value",$uni_w);
		$respuesta->assign("unid","style.color","blue");
		$respuesta->script("xajax.$('cant').focus();");

		}


}
return $respuesta;
}
function nz_proveedor($codpro)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call nz_psel_proveedores(null,null,null,'".$codpro."')";
	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result) <> 0){
		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$rut_w =utf8_decode($row["rutpro"]);
				$rasoc_w =utf8_decode($row["rasoc"]);
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("cmd_rut","value",$rut_w);
  		$respuesta->assign("cmd_rut","style.color","blue");
		$respuesta->assign("cmd_rasoc","value",$rasoc_w);
  		$respuesta->assign("cmd_rasoc","style.color","blue");
/*
		$respuesta->assign("unid","value",$uni_w);
		$respuesta->assign("unid","style.color","blue");
		*/
		$respuesta->script("xajax.$('cmd_tipdoc').focus();");

		}


return $respuesta;
}

//registramos la función creada anteriormente al objeto xajax
//$xajax->registerFunction("nz_codigo");
$xajax->register(XAJAX_FUNCTION, 'nz_codigo'); 
$xajax->register(XAJAX_FUNCTION, 'nz_proveedor'); 

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

if (!$_POST)
	{
    $_SESSION["arrDetalles"] = array();
    $arrRegs = array(); 
    $_SESSION["totdoc"] = 0;
    $_SESSION["neto"] = 0;
    $_SESSION["total"] = 0;

	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Ingreso de Compras</title>
	    <?php
		//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
		$xajax->printJavascript("../xajax/");
		?>

   		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";

  		    function total_linea()
			//-------------------------
			{ var a=0;
			  var b=0;
			  
	          a = document.Form1.cant.value;
  	          b = document.Form1.prec.value;
			  document.Form1.tot.value = a * b;
	          }

  		    function aplica_descto()
			//-------------------------
			{ var a=0;
			  var b=0;
  			  var c=0;
			  var net=0;
			  var tot=0;
			  var subtot=0;
			  			  
	          a = document.Form1.subtot.value;
  	          b = document.Form1.descto.value;
   	          c = parseInt(document.Form1.otimp.value);
			  net = a - b;
			  document.Form1.neto.value = net;
			  iva = Math.round(net * 0.19);
			  document.Form1.iva.value = iva;
              subtot = net + iva;
              tot = subtot + c;
			  
  			  document.Form1.total.value = tot;
	          }
			  
  		    function aplica_otimp()
			//-------------------------
			{ var a=0;
			  var b=0;
			  var c=0;
			  var tot=0;
			  			  
	          a = parseInt(document.Form1.neto.value);
  	          b = parseInt(document.Form1.iva.value);
   	          c = parseInt(document.Form1.otimp.value);

			  tot = a + b + c;
			  document.Form1.total.value = tot;

	          }

	    </script>
	    

 </head>
<body onload="document.getElementById('ddl_proveedor').focus();" class="pantalla_normal" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >

<?php
if (isset($_POST["btnAdd"])) 
{ 
    if ($_POST["prod"] <> 0)
	{
    // recogemos data posteada por el usuario  
    $arr1 = array(); 
    $arr1["prod"] = $_POST["prod"]; 
    $arr1["desc"] = $_POST["desc"]; 
    $arr1["unid"] = $_POST["unid"]; 
    $arr1["cant"] = $_POST["cant"]; 
    $arr1["prec"] = $_POST["prec"]; 
    $arr1["tot"] = $_POST["tot"]; 
	
	$desc =  $_POST["descto"];
    	
	$totlinea = $_POST["cant"] * $_POST["prec"];
	$_SESSION["totdoc"] += $totlinea;
    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
    $_POST["subtot"] = $_SESSION["totdoc"]; 
    $_POST["neto"] = $_SESSION["totdoc"] - $desc; 
    $_POST["iva"] = round($_POST["neto"] * 0.19); 
    $_POST["total"] = $_POST["neto"] + $_POST["iva"] + $_POST["otimp"]; 
	}
}

if (isset($_SESSION["arrDetalles"]))
    $arrRegs = $_SESSION["arrDetalles"]; 
else 
    $arrRegs = array(); 

if (isset($_POST['ddl_proveedor']))
{
	$proveedor_w  = $_POST['ddl_proveedor'];
	}
else
{
	$proveedor_w  = "";
	}
	
//llena ddl proveedores

	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query="call nz_psel_proveedores(null,null,null,null)";
	
	$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);
	
	$lst_proveedor="<select name='ddl_proveedor' id='ddl_proveedor' onBlur='javascript:xajax_nz_proveedor(document.Form1.ddl_proveedor.value)' class='input-normal'>";
	
	while($registro=mysqli_fetch_array($r))
	{    
 		if ($registro[0] == $proveedor_w)
	      {
		   $lst_proveedor.="\n<option selected='selected' value='".$registro[0]."'>".$registro[3]."</option>";
          }
		  else
		  {
           $lst_proveedor.="\n<option value='".$registro[0]."'>".$registro[3]."</option>";
		
		   }
	}
	
	$lst_proveedor.="\n</select>";
	
	mysqli_close($link);

if (isset($_POST['cmd_tipdoc']))
{
	$tipdoc_w  = $_POST['cmd_tipdoc'];
	}
else
{
	$tipdoc_w  = "F";
	}


if (isset($_POST['cmd_nrodoc']))
{
	$nrodoc_w  = $_POST['cmd_nrodoc'];
	}
else
{
	$nrodoc_w  = 0;

	}

if (isset($_POST['cmd_fecdoc'])){
	$fecdoc_w  = $_POST['cmd_fecdoc'];
	}
else{
	$fecdoc_w  = date("d/m/Y");
	}

if (isset($_POST['cmd_fecven'])){
	$fecven_w  = $_POST['cmd_fecven'];
	}
else{
	$fecven_w  = date("d/m/Y");
	}

if (isset($_POST['subtot'])){
	$subtot_w  = $_POST['subtot'];
	}
else{
	$subtot_w  = 0;
	}

if (isset($_POST['descto'])){
	$descto_w  = $_POST['descto'];
	}
else{
	$descto_w  = 0;
	}

if (isset($_POST['neto'])){
	$neto_w  = $_POST['neto'];
	}
else{
	$neto_w  = 0;
	}
	
if (isset($_POST['iva'])){
	$iva_w  = $_POST['iva'];
	}
else{
	$iva_w  = 0;
	}

if (isset($_POST['otimp'])){
	$otimp_w  = $_POST['otimp'];
	}
else{
	$otimp_w  = 0;
	}

if (isset($_POST['total'])){
	$total_w  = $_POST['total'];
	}
else{
	$total_w  = 0;
	}
/* 
if (isset($_POST['prod']))
{
	$insumo_w  = $_POST['prod'];
	}
else
{
	$insumo_w  = "";
	}
*/	
//llena ddl insumos

	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query="call nz_psel_insumos(null)";
	
	$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);
	
	$lst_prod="<select name='prod' id='prod' onBlur='javascript:xajax_nz_codigo(document.Form1.prod.value)' class='input-normal'>";
	
	while($registro=mysqli_fetch_array($r))
	{    
           $lst_prod.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	
	$lst_prod.="\n</select>";
	
	mysqli_close($link);
 
?>
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">
<div id="encabezado">

  <TABLE id="Table1" cellSpacing="0" cellPadding="0" width="500" border="0">

			<TR>
				<td vAlign="bottom" width="500">&nbsp;
					<span id="Label1" class="texto18">INGRESO DE COMPRA</span></td>
			</TR>
			<TR>
				<td width="500" height="5">&nbsp;</td>
			</TR>
			<TR>
				<td align="left" width="500" height="6">
					<TABLE class="texto01" id="Table2" cellPadding="0" width="500" border="0">
       				 <TR> 
						<td style="WIDTH: 120px; HEIGHT: 12px"></td>
						<td style="WIDTH: 204px; HEIGHT: 12px"></td>
						<td style="WIDTH: 70px; HEIGHT: 12px"></td>
					  </TR>
					  
					  <TR> 
						<td style="WIDTH: 120px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Proveedor</td>
						<td style="WIDTH: 204px; HEIGHT: 3px">
						<?php
						  echo $lst_proveedor;
						  ?>
						</td>
						<td style="WIDTH: 90px; HEIGHT: 3px">
						<input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal"  style="border:0px;background-color:transparent;" value="" readOnly="readonly" />
						</td>
						<td style="WIDTH: 90px; HEIGHT: 3px">
						<input name="cmd_rasoc" type="text" maxlength="20" id="cmd_rasoc" class="input-normal"  style="border:0px;background-color:transparent;" value="" readOnly="readonly" />
						</td>

					  </TR>
					  <tr> 
              
            <td style="width: 120px; height: 2px">&nbsp; &nbsp;&nbsp; Tipo Docto.</td>
              <?php
				   echo'<td style="width: 204px; height: 3px"> <select name="cmd_tipdoc" id="cmd_tipdoc" class="texto01">';
				  	echo "\n<option selected='selected' value='F'>Factura</option>";
				   	echo "\n<option value='G'>Guia</option>";
				  echo "\n</select></td>";
				?>
              
            <td style="width: 95px; height: 2px">Nº Docto.</td>
              <td style="width: 114px; height: 3px"> <input name="cmd_nrodoc" type="text" maxlength="10" id="cmd_nrodoc" class="input-normal" style="width:96px;" value="<?php echo $nrodoc_w; ?>" /> 
                </td>
	
            </tr>
            <tr> 
              <td style="width: 120px; height: 18px">Fecha Docto.</td>
              <td style="width: 214px; height: 18px"> <input name="cmd_fecdoc" type="text" maxlength="10" id="cmd_fecdoc" class="input-normal" style="width:96px;" value="<?php echo $fecdoc_w; ?>"/> 
                &nbsp; <span id="FecDMala" style="color:Red;font-weight:bold;display:none;">Fecha Docto. 
                Errónea</span> </td>
              <td style="width: 95px; height: 18px">Fecha Vencto.</td>
              <td style="width: 214px; height: 18px"> <input name="cmd_fecven" type="text" maxlength="10" id="cmd_fecven" class="input-normal" style="width:96px;" value="<?php echo $fecven_w; ?>"/> 
                &nbsp; <span id="FecVMala" style="color:Red;font-weight:bold;display:none;">Fecha Vencto. 
                Errónea</span> </td>
            </tr>

					  </TABLE>
				</td>

				</TR>

	
	</table>
	</div>    			

	<div id="det_articulos">
    		<table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="all" border="1" id="dgrid" width="400" style="border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;border-collapse:collapse;">
			<tr style="color:#F7F7F7;background-color:#A55129;">
			
		<td>Código</td><td style="WIDTH: 173px">Insumo</td><td>Unidad</td><td>Cantidad</td><td>Precio</td><td>Total</td><td></td>
	</tr>
	<?php

  echo '<tr >'; 
  for ($i = 0; $i < count($arrRegs); $i++) 
    { 
      echo "<tr>"; 
      echo "<td>".$arrRegs[$i]["prod"]."</td>"; 
      echo "<td>".$arrRegs[$i]["desc"]."</td>"; 
      echo "<td>".$arrRegs[$i]["unid"]."</td>"; 
      echo "<td>".$arrRegs[$i]["cant"]."</td>"; 
      echo "<td>".$arrRegs[$i]["prec"]."</td>"; 
      echo "<td>".$arrRegs[$i]["tot"]."</td>"; 
      echo "</tr>"; 
    } 

?>

        <tr>
  		  <td>
		  	<?php
			echo $lst_prod;
		  ?>
<!-- <input name='prod' type='text' class='input-normal' id='prod' style='width:66px;' value="0" maxlength="2" onBlur='javascript:xajax_nz_codigo(document.Form1.prod.value)' >
 --></td> 
          <td><input name='desc' type='text' class='input-normal' id='desc' style="WIDTH: 173px" size='50' readOnly='readonly'></td> 
          <td><input name='unid' type='text' class='input-normal' id='unid' size='10' readOnly='readonly'></td> 
  		  <td align='center'><input name='cant' type='text' class='input-normal' id='cant' style='width:66px;' value='0' onChange='javascript:total_linea()' ></td> 
   		  <td align='center'><input name='prec' type='text' class='input-normal' id='prec' style='width:66px;' value='0' onChange='javascript:total_linea()'></td> 
          <td><input name='tot' type='text' class='input-normal' id='tot' size='10' readOnly='readonly'></td> 
          <td><input type='submit' name='btnAdd' style='width:66px;' value='Agregar'></td> 
          </tr>
  	        <tr>
			<td colspan="4"><span></span></td>
			<td><span>Subtotal</span></td>
  		  <td><input name='subtot' type='text' class='input-normal' id='subtot' style='width:66px;' value="<?php echo $subtot_w; ?>"  readOnly="readonly"></td> 
          <td></td> 
          </tr>
        <tr>
			<td colspan="4"><span></span></td>
			<td><span>Descto</span></td>
  		  <td><input name='descto' type='text' class='input-normal' id='descto' style='width:66px;' value="<?php echo $descto_w; ?>" onChange='javascript:aplica_descto()'></td> 
          <td></td> 
          </tr>
        <tr>
			<td colspan="4"><span></span></td>
			<td><span>Neto</span></td>
  		  <td><input name='neto' type='text' class='input-normal' id='neto' style='width:66px;' value="<?php echo $neto_w; ?>"  readOnly="readonly"></td> 
          <td></td> 
          </tr>
        <tr>
			<td colspan="4"><span></span></td>
			<td><span>Iva</span></td>
  		  <td><input name='iva' type='text' class='input-normal' id='iva' style='width:66px;' value="<?php echo $iva_w; ?>"  readOnly="readonly"></td> 
          <td></td> 
          </tr>
        <tr>
			<td colspan="4"><span></span></td>
			<td><span>Ot.Imptos.</span></td>
  		  <td><input name='otimp' type='text' class='input-normal' id='otimp' style='width:66px;' value="<?php echo $otimp_w; ?>" onChange='javascript:aplica_otimp()'></td> 
          <td></td> 
          </tr>
        <tr>
			<td colspan="4"><span></span></td>
			<td><span>Total</span></td>
  		  <td><input name='total' type='text' class='input-normal' id='total' style='width:66px;' value="<?php echo $total_w; ?>"  readOnly="readonly"></td> 
          <td></td> 
          </tr>

		<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">
		<td colspan="7"><span></span></td>	</tr>
	<tr>			
	<td colspan="7">
		<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="400"
				align="center" border="0">
				<TR>
					<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onClick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>
					<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_grabar" value="Grabar" id="cmd_grabar" class="boton" style="width:70px;" /></td>
				</TR>	</TABLE>
				</td>
	</tr>
	

    </table>	
    </div>

</form>
<?php

 if (isset($_POST["cmd_grabar"])) 
   {
   
  $prov  = $_POST["ddl_proveedor"];
  $tipdoc  = $_POST["cmd_tipdoc"];
  $nrodoc  = $_POST["cmd_nrodoc"];
  $fecdoc  = $_POST["cmd_fecdoc"];
  $fecven  = $_POST["cmd_fecven"];
  $tipo  = "P";
  $subtot  = $_POST["subtot"];
  $desc  = $_POST["descto"];
  $neto  = $_POST["neto"];
  $iva  = $_POST["iva"];
  $otimp  = $_POST["otimp"];
  $tot  = $_POST["total"];

   // Graba encabezado compras
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call nz_pupd_compras_enc('I','".$prov."','".$tipdoc."',".$nrodoc.",STR_TO_DATE('".$fecdoc."','%d/%m/%Y'),STR_TO_DATE('".$fecven."','%d/%m/%Y'),'".$tipo."',".$subtot.",".$desc.",".$neto.",".$iva.",".$otimp.",".$tot.")";
//echo $consulta;

//        $result=mysqli_query($link,$consulta);
		if ( !mysqli_query($link,$consulta) )
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar enc compra: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
			 
 		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El documento ya existe....." ;
				}
				 
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .' );
				</script>";
				
				
			mysqli_close($link);
//			exit();

			}
		else
		   {
		    mysqli_close($link);

			}	
			
	// graba detalle
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
        $cod = $_SESSION["arrDetalles"][$i]["prod"]; 
        $cant = $_SESSION["arrDetalles"][$i]["cant"]; 
        $prec = $_SESSION["arrDetalles"][$i]["prec"]; 

		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
       // cam_pupd_detventa(IN PMODO,PCODLOC,PNUMTRA,PTIPMOV,PCODPRO,PCODART,PCODCOL,PTALLA,PCANTID,PPRECIO) 	
 		$sql1 = "call nz_pupd_compras_det('I','".$prov."','".$tipdoc."',".$nrodoc.",'".$cod."','','".$cant."','".$prec."')";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar detalle compra: " . mysqli_errno($link);
  			 echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";
			 mysqli_close($link);
			 exit();
			}
		else
		   {
			mysqli_close($link);
			}	

     }
	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";
   
   }
?>
</body>
</HTML>
