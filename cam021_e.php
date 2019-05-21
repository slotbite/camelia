<?php
// Sistema			: CAMELIA
// Programa			: CAM021_e.PHP
// Descripcion		: Elimina bancos al sistema.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 04/10/2011

session_start();

require_once 'admin/config.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Eliminación de Bancos</title>
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
//echo $cod_w;
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
$_SESSION['cod_s'] = $cod_w ;

$nombre_w  = "";
$modo_w = "E";


//if ($_GET["COD"] > 0)
if ( strlen(trim( $_GET["COD"] )) > 0 )

{ 
	if (!$_POST)
	{ 
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call cam_psel_bancos('".$cod_w."',null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nombre_w = $row["nomban"];
		}
	mysqli_free_result($result);
	mysqli_close($link);
	}
}
?>
    <div>
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 1px; position: absolute; top: 2px; height: 200px; width: 606px;" >
      <tr>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18">ELIMINA BANCOS</span></td>
            </tr>
        <td align="top" width="484"> <table width="484" height="115" border="0" cellpadding="0" cellspacing="0" class="texto11" id="Table2"
                        style="text-align: left;">
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="100" style="width: 95px; height: 18px">&nbsp; <span id="Lb_identificador" style="display:inline-block;width:83px;">Código</span></td>
              <?php 
			
 			   echo '<td style="width: 94px; height: 18px"> <input name="cmd_cod" type="text" maxlength="02" id="cmd_cod" class="input-normal" style="text-transform: uppercase;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" value="'.$_SESSION["cod_s"].'" readOnly="readonly"/> ';

              ?>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 2px">&nbsp;Nombre</td>
              <td width="424" style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" maxlength="30" id="cmd_nombre" class="input-normal" style="text-transform: uppercase;width:176px;" value="<?php echo $nombre_w; ?>" readOnly="readonly"/> 
                &nbsp; <span id="NombreMalo" style="color:Red;display:none;">* Nombre inválido</span> </td>
            </tr>
             <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
             <td colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg" value="0" /> 
                <input type="hidden" name="hdCorr" id="hdCorr" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina" value="2" /> 
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
	if ($elim_w == "E") {
//echo "grabar";

		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

		$sql1 = "call cam_pupd_bancos('".$modo_w."','".$cod_w."','".$nombre_w."')";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1451)
			    {
 				$merror = "El banco tiene movimientos asociados....." ;
				} 
				echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
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
