<?php
// Sistema			: CAMELIA
// Programa			: CAM009_e.PHP
// Descripcion		: Eliminación de artículos.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 28/09/2011

session_start();

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Eliminación de Artículos</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
		
			function fabre_ventana(iparamt,icoord){
			/*---------------------------*/
				pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
				pant_emp.location = iparamt
			}

			function f_elimina(){
    	    /*-------------------*/
				  if(confirm('¿Está Seguro de Eliminar?'))
				     {
				     document.Form1.hdElimina.value = "E";
					 document.Form1.submit();
		     	     }
				  else{
  					 document.getElementById('hdElimina').Value = "";
					 window.close()
				   }  
              }


		</script>
</head>
<?php

$cod_w = $_GET["COD"];

$codpro_w = "";
$codart_w = "";

if (!empty( $cod_w ) ) {
   
    $pos = strpos($cod_w, '.');

	if ($pos == 0) {
		$codpro_w = "";
		$codart_w = "";
//	    $cdes_w = substr($cod_w, $pos + 1);
	} 
	else
	{
		$codpro_w = substr($cod_w, 0, $pos);
		$codart_w = substr($cod_w, $pos + 1);

	}
      
}
else{
  $codpro_w = "";
  $codart_w = "";
}


?>
<body bgcolor="#000080" text="#ffffff">
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">
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
$_SESSION['codpro_s'] = $codpro_w ;
$_SESSION['codart_s'] = $codart_w ;


$nomart_w  = "";
$modo_w = "E";

// if (strlen(trim($rut_w)) > 0)
if ( strlen(trim( $_GET["COD"] )) > 0 )
{ 
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_articulos('".$codpro_w."','".$codart_w."',null)";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nomart_w = $row["nomart"];
		
		}
	mysqli_free_result($result);
	mysqli_close($link);
}

?> 
<script type="text/javascript">

var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}

</script>

    <div>
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 3px; position: absolute; top: 6px; height: 159px; width: 511px;" >
      <tr>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18">ELIMINA ARTICULOS</span></td>
            </tr>
          <tr>
        <td > <table width="512" height="15" border="0" align="left" cellpadding="0" cellspacing="0" class="texto11" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>

            <tr> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; Código Proveedor</td>
            <?php 
			
 			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codpro" type="text" maxlength="3" id="cmd_codpro" class="input-normal" style="text-transform: uppercase; width:60px;""  value="'.$_SESSION["codpro_s"].'" readOnly="readonly"/> ';
			  echo '<span id="CodProMalo" style="color:Red;display:none;">* Código inválido</span> </td>';
  			  echo '<span id="CodProMalo_2" style="color:Red;display:none;">* Proveedor No Existe</span> </td>';

              ?>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; Código Artículo</td>
            <?php 
			
 			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codart" type="text" maxlength="4" id="cmd_codart" class="input-normal" style="text-transform: uppercase; width:60px;""  value="'.$_SESSION["codart_s"].'" readOnly="readonly"/> ';
			  echo '<span id="CodArtMalo" style="color:Red;display:none;">* Código inválido</span> </td>';

              ?>
            </tr>

            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 2px">&nbsp; Nombre Artículo</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_nomart" stype="text" maxlength="15" id="cmd_nomart" class="input-normal" style="width:176px;"  value="<?php echo $nomart_w; ?>" readOnly="readonly"/> 
                &nbsp; <span id="RequiredFieldValidator2" style="display:inline-block;color:Red;font-weight:bold;width:8px;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            
              <td height="92" colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg2" value="0" /> 
               <input type="hidden" name="hdCorr" id="hdCorr2" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina2" value="2" /> 
              </td>
            </tr>
          </table>
          <input type="hidden" name="HD_trans" id="HD_trans" />
                    </td>
            </tr>
        </table>
        <br />
        <br />
    
    </div>
    
<div>

	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
    <input type="hidden" name="hdElimina" id="hdElimina" />

</div>

</form>

<?php
if (!$_POST)
{
echo "<script type=\"text/javascript\">f_elimina();</script>";
}

if ($_POST) {
 	$elim_w = $_POST["hdElimina"];
//	echo 'elim: '. $elim_w ;
	if ($elim_w == "E")
       {
  
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);;

		$sql1 = "call cam_pupd_articulos('".$modo_w."','".$codpro_w."','".$codart_w."','".$nomart_w."')";

//echo $sql1;
//exit();
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1451)
			    {
				$merror = "El artículo tiene inventario asociado....." ;
				} 
				
//			echo $error;	
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .' );
				</script>";
				
			mysqli_close($link);
			exit();

			}

	   }//cierras todos los else que abras

	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";

}
?>

</body>
</html>
