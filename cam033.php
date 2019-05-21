<?php
// Sistema			: CAMELIA
// Programa			: CAM033.PHP
// Descripcion		: Documentos con Inventario.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 26/12/2012

session_start();

require_once 'admin/config.php';


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
			function f_ingresar(){
			/*-------------------------*/
	              window.open('eco_autoriza.php?PAGINA=' + 'cam033_i.php' ,'cam033_i','width=850, height=550, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=200').focus();
			
			}
			
			function f_modificar(){
			/*-------------------------*/
	              window.open('eco_autoriza.php?PAGINA=' + 'cam033_m.php' ,'cam033_m','width=850, height=550, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=200').focus();
			
			}


	    </script>
	    

 </head>
<body class="pantalla_normal" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >
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
 
?>
<p class="input-grilla">&nbsp;</p>
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">
<div id="encabezado">

  <TABLE id="Table1" cellSpacing="0" cellPadding="0" width="500" border="0">

			<TR>
				<td Align="center" width="100%">&nbsp;
					<span id="Label1" class="texto18">COMPRAS</span></td>
			</TR>
			<TR>
				<td align="left" width="500" height="6">
					<TABLE class="texto13" id="Table2" cellPadding="0" width="500" border="0">
				  
					  <TR> 
						
              <td style="WIDTH: 130px; HEIGHT: 3px">Número Interno :</td>
						<td style="WIDTH: 204px; HEIGHT: 3px">
						</td>
						<td style="WIDTH: 100px; HEIGHT: 3px">Proveedor :</td>
						<td style="WIDTH: 90px; HEIGHT: 3px">
						</td>

					  </TR>
					  <tr> 
              
              <td style="width: 120px; height: 2px">Tipo Documento :</td>
			<td style="WIDTH: 204px; HEIGHT: 3px">
			</td>
            <td style="width: 95px; height: 2px">Nº Documento :</td>
              <td style="width: 114px; height: 3px"> 
                </td>
	
            </tr>
            <tr> 
              <td style="width: 120px; height: 18px">Fecha Documento :</td>
              <td style="width: 214px; height: 18px">  </td>
              <td style="width: 110px; height: 18px">Monto Abonado :</td>
              <td style="width: 214px; height: 18px">  </td>
            </tr>
            <tr> 
              <td style="width: 120px; height: 18px">Local Respons. :</td>
              <td style="width: 214px; height: 18px">  </td>
              <td style="width: 95px; height: 18px">Local Existen. :</td>
              <td style="width: 214px; height: 18px">  </td>
            </tr>

					  </TABLE>
				</td>

				</TR>

	
	</table>
	</div>    			

	<div id="det_articulos">
    	<table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="all" border="1" id="dgrid" width="100%" style="border-color:#E7E7FF;border-width:1px;border-style:None;border-collapse:collapse;">
		<tr>
		 <td height="20" colspan="7"><span></span></td>
		</tr>

		<tr>
		<td  height="120" colspan="7"><span></span></td>
		</tr>

        <tr>
			<td colspan="6"><span></span></td>
			<td width="120"><span>Valor Neto</span></td>
  		  
          </tr>

        <tr>
			<td colspan="5"><span></span></td>
			
        <td><span>Des1&nbsp; &nbsp; %</span></td>

			<td><span>Des2&nbsp; &nbsp; %</span></td>
  		  
          </tr>
        <tr>
			<td colspan="6"><span></span></td>
			
        <td>Flete</td>
  		  
          </tr>
        <tr>
			<td colspan="6"><span></span></td>
			
        <td><span>I.V.A.</span></td>
  		  
          </tr>
        <tr>
			<td colspan="6"><span></span></td>
			<td><span>Total</span></td>
  		  
          </tr>

		<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">
		<td colspan="7"><span></span></td>	</tr>
	<tr>			
	<td colspan="7">
		<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="400"
				align="center" border="0">
				<TR>
					<td  align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onClick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>
					<td  align="center" width="173"><input type="submit" name="cmd_ingresar" value="Ingresar" id="cmd_ingresar" class="boton" style="width:70px;" onClick="javascript:f_ingresar();return false;" /></td>
					<td  align="center" width="173"><input type="submit" name="cmd_grabar" value="Modificar" id="cmd_grabar" class="boton" style="width:70px;" onClick="javascript:f_modificar();return false;"/></td>
					<td align="center" width="173"><input type="submit" name="cmd_grabar" value="Eliminar" id="cmd_grabar" class="boton" style="width:70px;" /></td>
					<td align="center" width="173"><input type="submit" name="cmd_grabar" value="Consultar" id="cmd_grabar" class="boton" style="width:70px;" /></td>
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
