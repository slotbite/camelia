<?php
// Sistema			: CAM
// Programa			: CAM003_e.PHP
// Descripcion		: Eliminación de proveedores.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 28/09/2011

session_start();

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Eliminación de Provedores</title>
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

$codpro_w = $_GET["COD"];
//echo $_GET["COD"];
//echo $codpro_w;

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

$rutpro_w  = "";
$rasoc_w  = "";
$nomfa_w  = "";
$direcc_w  = "";
$ciudad_w  = "";
$fono_w  = "";
$fax_w  = "";
$vendedor_w  = "";
$comuna_w  = "";
$email_w  = "";
$modo_w = "E";


// if (strlen(trim($rut_w)) > 0)
if ( strlen(trim( $_GET["COD"] )) > 0 )
{ 
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call CAM_PSEL_PROVEEDORES(null,null,null,'".$codpro_w."')";
	
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$rutpro_w = $row["rutpro"];
		$rasoc_w = $row["rasoc"];
		$nomfa_w = $row["nomfa"];
		$direcc_w = $row["direcc"];
		$ciudad_w   = $row["ciudad"];
		$fono_w = $row["fono"];
		$fax_w = $row["fax"];
 		$vendedor_w = $row["vendedor"];
		$comuna_w   = $row["comuna"];
		$email_w     = $row["email"];
		
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
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 3px; position: absolute; top: 6px; height: 479px; width: 611px;" width="590">
       <tr>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18">ELIMINA PROVEEDORES</span></td>
            </tr>
          <tr>
                
        <td align="center" height="100" width="591"> <table width="512" height="415" border="0" align="left" cellpadding="0" cellspacing="0" class="texto11" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
			            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>

            <tr> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; Código</td>
            <?php 
			   echo '<td style="width: 314px; height: 3px"> <input name="cmd_codpro" type="text" maxlength="3" id="cmd_codpro" class="input-normal" style="text-transform: uppercase; width:60px;""  value="'.$_SESSION["codpro_s"].'" readOnly="readonly"/> ';
   			   echo '<span id="CodMalo" style="color:Red;display:none;">* Código inválido</span> </td>';

              ?>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="131" style="width: 95px; height: 18px"> &nbsp; <span id="Lb_identificador" >Rut</span></td>
            <?php 
			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rutpro" type="text" maxlength="13" id="cmd_rutpro" class="input-normal" style="text-transform: uppercase; width:76px;" onchange="vRut()" value="'.$rutpro_w.'" readOnly="readonly"/> ';
			  echo '<span id="RutMalo" style="color:Red;display:none;">* Rut inválido</span> </td>';
              ?>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr > 
              <td height="22" style="width: 95px; height: 2px">&nbsp; Razón Social</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_rasoc" stype="text" maxlength="30" id="cmd_rasoc" class="input-normal" style="width:176px;"  value="<?php echo $rasoc_w; ?>" readOnly="readonly"/> 
                &nbsp; <span id="RequiredFieldValidator2" style="display:inline-block;color:Red;font-weight:bold;width:8px;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Nombre Fantasía</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_nomfa" type="text" maxlength="15" id="cmd_nomfa" class="input-normal" style="width:176px;" value="<?php echo $nomfa_w; ?>" readOnly="readonly"/> 
                &nbsp; <span id="RequiredFieldValidator3" style="color:Red;font-weight:bold;visibility:hidden;">???</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Dirección</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_direcc" type="text" maxlength="40" id="cmd_direcc" class="input-normal" style="width:314px;" value="<?php echo $direcc_w; ?>" readOnly="readonly"/> 
                </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Ciudad</td>
		        <td style="width: 314px; height: 3px"> <input name="cmd_ciudad" type="text" maxlength="15" id="cmd_ciudad" class="input-normal" style="width:176px;" value="<?php echo $ciudad_w; ?>" readOnly="readonly"/> 
                </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 3px"> &nbsp; Comuna</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_comuna" type="text" maxlength="15" id="cmd_comuna" class="input-normal" style="width:112px;" value="<?php echo $comuna_w; ?>" readOnly="readonly"/> 
               </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>

            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Fono</td>
                <td style="width: 314px; height: 3px"> <input name="cmd_fono" type="text" maxlength="12" id="cmd_fono" class="input-normal" style="width:176px;" value="<?php echo $fono_w; ?>" readOnly="readonly"/> 
                </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Fax</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_fax" type="text" maxlength="12" id="cmd_fax" class="input-normal" style="width:176px;" value="<?php echo $fax_w; ?>" readOnly="readonly"/> 
               </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; Vendedor </td>
              <td style="width: 314px; height: 3px"> <input name="cmd_vendedor" type="text" maxlength="20" id="cmd_vendedor" class="input-normal" style="width:312px;" value="<?php echo $vendedor_w; ?>" readOnly="readonly"/> 
               </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Email</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_email" type="text" maxlength="60" id="cmd_email2" class="input-normal" style="width:176px;" value="<?php echo $email_w; ?>" readOnly="readonly"/> 
                &nbsp; <span id="RegularExpressionValidator1" style="color:Red;visibility:hidden;">e-mail 
                no valido</span></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            
              <td height="92" colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg2" value="0" /> 
          <input type="hidden" name="HD_trans" id="HD_trans" />
                    </td>
            </tr>
        </table>
        <br />
        <br />
        </table>
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

		$sql1 = "call cam_pupd_proveedores('".$modo_w."','".$codpro_w."','".$rutpro_w."','".$rasoc_w."','".$nomfa_w."','".$direcc_w."','".$ciudad_w."','".$fono_w."','".$fax_w."','".$vendedor_w."','".$comuna_w."','".$email_w."')";

//echo $sql1;
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1451)
			    {
				$merror = "El proveedor tiene artículos asociados....." ;
				} 
				
//			echo $error;	
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .' );
				</script>";
				
			mysqli_close($link);
//			exit();

			}

	   }//cierras todos los else que abras

	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";

}
?>

</body>
</html>
