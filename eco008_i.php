<?php
// Sistema			: ECO
// Programa			: eco008_i.PHP
// Descripcion		: Imprime Exámen Ecotomografia Abdominal.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 05/11/2010

session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Imprime Ecotomografia Abdominal</title>
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
			pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
			pant_emp.location = iparamt
		}
		
        function f_SelPaciente(){
        /*-----------------------------------*/
          pant_emp = window.open("","Cuatro","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
	      pant_emp.location = "eco002.php" 
	/*						
			document.getElementById('txtcodigo').value = cdes;
			document.getElementById('txtdesc').value = ndes;
			document.getElementById('hdElimina').value = "E";
			document.getElementById('hdHabilitado').value = "";
		*/	
			        }
        function f_SelMedico(){
        /*-----------------------------------*/
           pant_emp = window.open("","Cuatro","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
	       pant_emp.location = "eco006.php" 
			        }
					
		function f_imprimir(){
        /*-----------------------------------*/
			window.print()
			        }
				
		</script>
</head>
<?php
require_once 'admin/config.php';

$codigo_w = $_GET["CODIGO"];
// echo $codigo_w;
?>

<body onload="f_imprimir()">
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1"  >
<?php
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

/// trae datos del examen
if ($codigo_w > 0)
{ 
	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//	mysql_select_db(DB_NAME, $link); 

	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_ECOABDOMINAL('".$codigo_w."',null,null,null,null,null)";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nompac_w = $row["npaciente"] ." ". $row["ppaciente"]." ". $row["mpaciente"];
		$rutpac_w = $row["rutpaciente"];
		$fecha_w = $row["fecha"];
		$solicitado_w = $row["tsolicitado"];
		$antecedentes_w = $row["TANTECEDENTES"];
		$higado_w = $row["THIGADO"];
		$vesicula_w = $row["TVESICULA"];
		$coledoco_w = $row["TCOLEDOCO"];
		$pancreas_w = $row["TPANCREAS"];
		$rinones_w = $row["TRINONES"];
		$bazo_w = $row["TBAZO"];
		$vasos_w = $row["TVASRETRO"];
		$ascitis_w = $row["TASCITIS"];
		$impresion_w = $row["TDIAGNOSTICO"];
		$nommed_w = $row["nmedico"] ." ". $row["pmedico"]." ". $row["mmedico"];
		$rutmed_w = $row["rutmedico"];
		$especial_w = $row["nEspecial"];

		}
	mysqli_free_result($result);
	mysqli_close($link);
}
/*
echo 'hola . <br>';
echo 'ECOCENTRO   LTDA.';
echo 'EDIFICIO PROSALUD';
echo '14 NORTE 571 OF.323 – 324';
echo 'FONO 2686062 – 2691645';
echo 'VIÑA DEL MAR';
*/
?>
	   
  <div> 
  
  <table width="300" border="0" cellspacing="0" cellpadding="0" class="texto11">
  <tr>
    <td><?php echo 'ECOCENTRO   LTDA.';?></td>
  </tr>
  <tr>
      <td><?php echo 'EDIFICIO PROSALUD';?></td>
  </tr>
  <tr>
     <td><?php echo '14 NORTE 571 OF.323 – 324';?></td>
  </tr>
  <tr>
    <td><?php echo 'FONO 2686062 – 2691645';?></td>
  </tr>
  <tr>
     <td><?php echo 'VIÑA DEL MAR';?></td>
  </tr>
</table>

</table>
<!--    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 41px; position: absolute; top: 134px; height: 468px; width: 756px;" width="510">
-->	
	 <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; position: absolute; width: 723px;" >

      <tr> 
        <td  width="500" style="height: 24px" align="center" ><span id="Label1" class="texto18"> 
          ECOTOMOGRAFÍA - ABDOMINAL</span></td>
      </tr>
      <tr> 
        <td align="left" height="100" width="480">
		 <table width="512" height="448" border="0" align="left" cellpadding="0" cellspacing="0" class="texto13" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> </tr>
            <tr> 
              <td width="131" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Código</td>
              <td width="365" style="width: 314px; height: 3px"> 
                <?php echo $codigo_w; ?>
              </td>
            </tr>
            <tr style="color: #000000"> </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Nombre</td>
              <td width="365" style= "height: 3px"> 
                <?php echo $nompac_w ?>
              </td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 18px"> &nbsp; Rut</td>
              <td style="width: 314px; height: 18px"> 
                <?php echo $rutpac_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 18px">&nbsp; Fecha Examen</td>
              <td style="width: 314px; height: 18px"> 
                <?php echo $fecha_w; ?>
              </td>
            </tr>
            <tr> 
              <td height="16" style="width: 95px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 3px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Solicitado 
                Por </td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $solicitado_w; ?>
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Antecedentes</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $antecedentes_w; ?>
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> HÍGADO</td>
              <td style="width: 514px; height: 3px"> 
                <?php echo $higado_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td style="width: 95px; height: 3px"> VESÍCULA </td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $vesicula_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> COLÉDOCO</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $coledoco_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> PÁNCREAS</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $pancreas_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 115px; height: 3px"> AMBOS RIÑONES</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $rinones_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 3px"> BAZO</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $bazo_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 125px; height: 2px"> GRANDES VASOS Y RETROPERITONEO</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $vasos_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"> ASCITIS</td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $ascitis_w; ?>
              </td>
            </tr>
			<tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            
			 <tr> 
              <td colspan="2" height="2" style="width: 381px">&nbsp; 
              </td>
            </tr>
            <tr> 
              <td colspan="2" height="2" style="width: 381px">&nbsp;
              </td>
            </tr>
            <tr> 
              <td  colspan="2" style="width: 400px; height: 2px;text-decoration: underline;"> IMPRESIÓN DIAGNÓSTICA</td>
            </tr>
			<tr> 
              <td colspan="2" style="width: 400px; height: 3px"> 
                <?php echo $impresion_w; ?>
              </td>
            </tr>
            <tr> 
              <td colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="37" style="width: 105px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 2px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="27" style="width: 105px; height: 2px">&nbsp;  </td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $nommed_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"></td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $rutmed_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"></td>
              <td style="width: 314px; height: 3px"> 
                <?php echo $especial_w; ?>
              </td>
            </tr>
          </table>
          <table id="Table3" align="center" border="0" cellpadding="1" cellspacing="1"
                        style="width: 310px; height: 8px; background-color: whitesmoke;" width="310">
            <tr> 
              <td align="center" style="width: 126px">&nbsp; </td>
              <td style="width: 45px">&nbsp; </td>
              <td align="center">&nbsp; </td>
            </tr>
          </table></td>
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
//	 include ("eco003.php"); 
/*
    $extra = 'eco002.php';
    header("Location: $extra");
*/	
	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";
	
	}
}
?>
   
</form>

</body>
</html>
