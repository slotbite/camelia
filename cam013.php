<?php
// Sistema			: CAMELIA
// Programa			: cam013.PHP
// Descripcion		: Ingreso de Inventario.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 02/09/2011

session_start();

if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
if (!isset($_SESSION["codpro_s"])){ $_SESSION['codpro_s']="";} 
if (!isset($_SESSION["codart_s"])){ $_SESSION['codart_s']="";} 
if (!isset($_SESSION["codcol_s"])){ $_SESSION['codcol_s']="";} 
if (!isset($_SESSION["talla_s"])){ $_SESSION['talla_s']="";} 

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ingreso de Inventario</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
	function vRut(){
   	/*----------------------------------*/

		var variable = Form1.cmd_rut.value.substr(0,Form1.cmd_rut.value.indexOf("-"));
		var digit = Form1.cmd_rut.value.substr(Form1.cmd_rut.value.indexOf("-")+1).toUpperCase();
					
		if ( validaRut(variable,digit) == false )
			  { alert("Rut Invalido") 
			
			} 					
		}
		
	function validaFecha(source, arguments){
	/*------------------------------------*/
		var dia  = Form1.cmd_fec_nac.value.substr(0,2)
		var mes  = Form1.cmd_fec_nac.value.substr(3,2)
		var anno = Form1.cmd_fec_nac.value.substr(6,4)
		
		if (dia.length!==2 || mes.length!==2 || anno.length!==4){
			arguments.IsValid=false
		}				
	}			
		
	function fabre_ventana(iparamt,icoord){
	/*---------------------------*/
		pant_emp = window.open("","", icoord + ",status=no,scrollbars=yes,resizable=no");
		pant_emp.location = iparamt
	}
			
        function f_SelPaciente(){
        /*-----------------------------------*/

  //          window.open('eco_autoriza.php?PAGINA=' + 'eco002.php' ,'Paciente','width=500, height=550, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();
            window.open('eco_autoriza.php?PAGINA=' + 'pacientes2.html' ,'Paciente','width=500, height=550, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			        }
					
	   function f_SelMedico(opc){
	   /*-----------------------------------*/
//	     pant_emp = window.open("","Medico","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
//	     pant_emp.location = "eco006.php?OPC="+ opc;

            window.open('eco_autoriza.php?PAGINA=' + 'eco006.php?OPC='+ opc ,'Medico','width=500, height=550, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

		 }
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
	
		function Imprimir_Vtna(cod){
	/*-----------------------------------*/
	
		// alert("imprime");
		pant_emp = window.open("","Imprimir","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
		pant_emp.location = "eco008_i.php?CODIGO=" + cod;
			
		 }

		</script>
</head>
<?php
    $codloc_w = "";
    $codpro_w = "";
	$codart_w = "";
    $codcol_w = "";
    $talla_w = "";

if (!empty( $_GET["CODIGO"] ) ) {
    $cod_w = $_GET["CODIGO"];   
    $pos = strpos($cod_w, '.');
	if ($pos <> 0) {
		$codloc_w = substr($cod_w, 0, $pos);
		$codpro_w = substr($cod_w, $pos + 1, 3);
		$codart_w = substr($cod_w, $pos + 5, 4);
		$codcol_w = substr($cod_w, $pos + 10, 2);
		$talla_w = substr($cod_w, $pos + 13);
		
		$_SESSION['codloc_s']= $codloc_w;
		$_SESSION['codpro_s']= $codpro_w; 
		$_SESSION['codart_s']= $codart_w; 
		$_SESSION['codcol_s']= $codcol_w; 
		$_SESSION['talla_s']= $talla_w; 

	}
      
}
//echo $codigo_w;
if (!$_POST and empty($_GET["CODIGO"]) )
	{
	//echo 'pase';
	$_SESSION['codloc_s']="";
	$_SESSION['codpro_s']=""; 
	$_SESSION['codart_s']=""; 
	$_SESSION['codcol_s']=""; 
	$_SESSION['talla_s']=""; 
	}
?>

<body bgcolor="#000080" text="#ffffff">
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1"  >
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
	}  
}
*/
//$codigo_w = "";
$fecpre_w = date("d/m/Y");
$modo_w = "I";

$saldo_w = "";
if (isset($_POST['cmd_saldo'])){
	$saldo_w  = $_POST['cmd_saldo'];
	}
$ultpre_w = "";
if (isset($_POST['cmd_ultpre'])){
	$ultpre_w  = $_POST['cmd_ultpre'];
	}
$factura_w = "";
if (isset($_POST['cmd_factura'])){
	$factura_w  = $_POST['cmd_factura'];
	}

if (isset($_POST['cmd_fecpre'])){
	$fecpre_w  = $_POST['cmd_fecpre'];
	}
else{
	$fecpre_w  = date("d/m/Y");
	}
$prevta_w = "";
if (isset($_POST['cmd_prevta'])){
	$prevta_w  = $_POST['cmd_prevta'];
	}
else{
	$prevta_w  = "";
	}
	
$codliq_w = "";
if ($_GET["CODIGO"] > 0)
    {
	$modo_w = "M";
	
	if (!$_POST)
	{
	/*
	echo 'loc '.$codloc_w;
	echo 'prov '.$codpro_w;
	echo 'art '.$codart_w;
	echo 'col '.$codcol_w;
	echo 'tall '.$talla_w;
	 */
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_inventario('".$codloc_w."','".$codpro_w."','".$codart_w."','".$codcol_w."','".$talla_w."')";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$saldo_w     = $row["saldo"];
		$ultpre_w = $row["ultpre"];
		$fecpre_w    = $row["fecpre"];
    	$factura_w  = $row["factura"];
		$prevta_w  = $row["prevta"];
/*
		$_SESSION['rutpac_s'] = $row["rutpaciente"];
		$_SESSION['nompac_s'] = $row["npaciente"]." ".$row["ppaciente"];
		$_SESSION['nommed_s'] = $row["msolicita"];
      	$_SESSION['rutmed_s'] = $row["rmedsol"];
		$_SESSION['nommed2_s'] = $row["enmedico"]." ".$row["epmedico"];
    	$_SESSION['rutmed2_s'] = $row["rmedefe"];
*/
		}
		
	mysqli_free_result($result);
	mysqli_close($link);
	}
}

?> 
    <div>
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 5px; position: absolute; top: 6px; height: 298px; width: 585px;" width="510">
      <tr>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18"> INGRESO DE INVENTARIO</span></td>
            </tr>
          <tr>
                <td align="center" height="100" width="553">
                    <table width="606" border="0" align="left" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
<!--             <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
 -->            
 			<tr> 
              <td width="153" height="25" style="width: 95px; height: 2px"> &nbsp; Código Local</td>
              <td width="403" style="width: 314px; height: 3px"> 
			  <input name="cmd_codloc" type="text" maxlength="2" id="cmd_codloc" class="input-normal" style="width:60px;"  value="<?php echo $_SESSION['codloc_s']; ?>" />
    		<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelLocal()" />
                &nbsp; &nbsp; <span id="LocMalo" style="color:Red;font-weight:bold;display:none;">Local Erróneo</span></td>
            </tr>
            <tr> 
              <td width="153" height="25" style="width: 95px; height: 2px"> &nbsp; Código Proveedor</td>
              <td width="403" style="width: 314px; height: 3px"> <input name="cmd_codpro" type="text" maxlength="3" class="input-normal" id="cmd_codpro" style="width:60px;"  value="<?php echo $_SESSION['codpro_s']; ?>" size="3" />
	      		<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelProveedor()" />
                &nbsp; &nbsp; <span id="ProvMalo" style="color:Red;font-weight:bold;display:none;">Proveedor Erróneo</span></td>
            </tr>
            <tr> 
              <td height="25" style="width: 95px; height: 18px"> &nbsp; Código Artículo</td>
              <td style="width: 314px; height: 18px"> <input name="cmd_codart" type="text" maxlength="4" id="cmd_codart" class="input-normal" style="width:60px;" value="<?php echo $_SESSION['codart_s']; ?>"  /> 
			<input name="imgart" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelArticulo()" />
               &nbsp; &nbsp; <span id="ArtMalo" style="color:Red;font-weight:bold;display:none;">Artículo Erróneo</span></td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 18px"> &nbsp; Código Color</td>
              <td style="width: 314px; height: 18px"> <input name="cmd_codcol" type="text" maxlength="2" id="cmd_codcol" class="input-normal" style="width:60px;" value="<?php echo $_SESSION['codcol_s']; ?>"  /> 
				<input name="imgcol" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelColor()" />
                &nbsp; &nbsp; <span id="ColMalo" style="color:Red;font-weight:bold;display:none;">Color Erróneo</span></td>
            </tr>
            <tr> 
            <tr> 
              <td height="22" style="width: 95px; height: 18px"> &nbsp; Talla</td>
              <td style="width: 314px; height: 18px"> <input name="cmd_talla" type="text" maxlength="3" id="cmd_talla" class="input-normal" style="width:60px;" value="<?php echo $_SESSION['talla_s']; ?>"  /> 
                &nbsp; &nbsp; <span id="TallMala" style="color:Red;font-weight:bold;display:none;">Talla Errónea</span>
              </td>
            </tr>
            <tr> 
              <td height="16" style="width: 95px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 3px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="21" style="width: 135px; height: 2px">&nbsp; Saldo</td>
              <td style="width: 314px; height: 3px"> 
                <input name="cmd_saldo" type="text" class="input-normal" maxlength="6" id="cmd_saldo" value="<?php echo $saldo_w; ?>" size="6" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  />
				</td>
			</tr>
            <tr> 
              <td style="width: 135px; height: 3px"> &nbsp; Último Precio</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_ultpre" type="text" class="input-normal" maxlength="6" id="cmd_ultpre"  value="<?php echo $ultpre_w; ?>" size="6"  onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" /> 
                &nbsp; </td>
            </tr>
            <tr>
              <td style="width: 135px; height: 3px"> &nbsp; Nº Factura</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_factura" type="text" class="input-normal" maxlength="8" id="cmd_factura"  value="<?php echo $factura_w; ?>" size="6" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" /> 
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fecha Factura
              <input name="cmd_fecpre" type="text" 	maxlength="10" id="cmd_fecpre" class="input-normal" value="<?php echo $fecpre_w; ?>"  size="6"/> 
                &nbsp; <span id="FecMala" style="color:Red;font-weight:bold;display:none;">Fecha 
                Errónea</span> </td>
            </tr>
            <tr> 
              <td style="width: 135px; height: 3px"> &nbsp; Precio Venta</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_prevta" type="text" maxlength="6" class="input-normal" id="cmd_prevta"  value="<?php echo $prevta_w; ?>" size="6" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" /> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px;"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 135px; height: 3px" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td style="width: 135px; height: 3px" colspan="2"><table id="Table3" align="center" border="0" cellpadding="1" cellspacing="1"
                        style="width: 310px; height: 8px; background-color: whitesmoke;" width="310">
                  <tr> 
                    <td align="center" style="width: 126px"> <input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" style="width:70px;" /></td>
					<?php
					
				//	if ($codliq_w == "")
					//{
                    echo '<td align="center"> <input type="submit" name="cmd_aceptar" value="Grabar" id="cmd_aceptar" class="boton" /></td>';
					//}
					?>
                  </tr>
                </table></td>
            </tr>
            <tr> 
              <td style="width: 135px; height: 3px" colspan="2">&nbsp;</td>
            </tr>
          </table>
                    <input type="hidden" name="HD_trans" id="HD_trans" />
                    </td>
            </tr>
        </table>
        <br />
        <br />
    
    </div>
    
<?php	
if ($_POST) 
{
 if(isset($_POST["cmd_atras"])) 
    {
    echo "<script type=\"text/javascript\"> window.close(); </script>";
	
	}
}
?>
 
</form>

<?php
if ($_POST){
 if(isset($_POST["cmd_aceptar"]))
  { 
  	$codloc_w  = $_POST["cmd_codloc"];
  	$codpro_w  = $_POST["cmd_codpro"];
	$codart_w  = $_POST["cmd_codart"];
	$codcol_w  = $_POST["cmd_codcol"];
	$talla_w  = $_POST['cmd_talla'];
	$saldo_w  = $_POST['cmd_saldo'];
	$ultpre_w  = $_POST['cmd_ultpre'];
	$factura_w  = $_POST['cmd_factura'];
	$fecpre_w  = $_POST['cmd_fecpre'];
	$prevta_w  = $_POST['cmd_prevta'];
	
	//empiezas las validaciones correspondientes 
	$error_w = FALSE;
	if (strlen($codloc_w) == 0) { //que ingrese ocal
        echo "<script type=\"text/javascript\">document.getElementById('LocMalo').style.display=''</script>";
/*
		echo  "<script type=\"text/javascript\">
		alert('Debe ingresar Paciente');
		</script>";    
*/
		$error_w = TRUE;
		}
		 		
	if (strlen($codpro_w) == 0) { //que ingrese proveedor
	   echo "<script type=\"text/javascript\">document.getElementById('ProvMalo').style.display=''</script>";
		$error_w = TRUE;
		} 	
		
	if (strlen($codart_w) == 0) { //que ingrese artículo
	   echo "<script type=\"text/javascript\">document.getElementById('ArtMalo').style.display=''</script>";
		$error_w = TRUE;
		} 	
		
	if (strlen($codcol_w) == 0) { //que ingrese color
	   echo "<script type=\"text/javascript\">document.getElementById('ColMalo').style.display=''</script>";
		$error_w = TRUE;
		} 	

	if (strlen($talla_w) == 0) { //que ingrese talla
	   echo "<script type=\"text/javascript\">document.getElementById('TallMala').style.display=''</script>";
		$error_w = TRUE;
		} 	
/*				
	if (strlen($fecpre_w) < 10) { //que ingrese fecha
	
        echo "<script type=\"text/javascript\">document.getElementById('FecMala').style.display=''</script>";
		$error_w = TRUE;
		} 		
*/	
/*
	else {  o if {
	
	//mas validaciones
*/
    if ( $error_w )	
	  {
	  exit();
	  }
	else{//el ultimo else tiene que se el de tu insert into
	
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$sql1 = "call cam_pupd_inventario('".$modo_w."','".$codloc_w."','".$codpro_w."','".$codart_w."',";
        $sql1 = $sql1."'".$codcol_w."','".$talla_w."','".$saldo_w."','".$ultpre_w."',STR_TO_DATE('".$fecpre_w."','%d/%m/%Y'),";
        $sql1 = $sql1."'".$factura_w."',null,'".$prevta_w."',null,null,null,null,null)";
		
// echo $sql1;
// exit();
        $query = mysqli_query($link,$sql1);
		if ( !$query ) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El item ya existe....." ;
				} 
				
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();

			}
		else
		   {
			echo "<script type=\"text/javascript\">
				alert('El ítem ha sido registrado de manera satisfactoria.');
				</script>";
			
			//rescato el codigo del examen


		   }//cierras todos los else que abras
      }      


	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";

 }
} 
?>


</body>
</html>
