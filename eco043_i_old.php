﻿<?php
// Sistema			: ECO
// Programa			: eco043_i.PHP
// Descripcion		: Imprime Exámen Test de Esfuerzo.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 04/01/2011

session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Imprime Exámen</title>
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" onload="f_imprimir()">
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
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_EXAMENES('".$_GET["CODIGO"]."',null,null,null,null,null,'1',null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nompac_w = $row["npaciente"] ." ". $row["ppaciente"]." ". $row["mpaciente"];
		$rutpac_w = $row["rutpaciente"];
		$fecha_w = $row["fecha"];
		$edad_w = $row["edad"];
//		$detalle_w   	= $row["tdetalle"];
		$detalle_w  	= html_entity_decode( $row["tdetalle"] );
		$nommed_w = $row["nmedico"] ." ". $row["pmedico"]." ". $row["mmedico"];
		$rutmed_w = $row["rutmedico"];
		$especial_w = $row["nEspecial"];

		}
	mysqli_free_result($result);
	mysqli_close($link);
}
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
<!--
    <table id="Table1" border="0" cellpadding="0" cellspacing="0"  width="750" style="z-index: 101; position: absolute; " >
	-->
    <table id="Table1" border="0" cellpadding="0" cellspacing="0"  align="left" width="650">
	<!--
      <tr> 
        <td style="height: 24px" valign="bottom" colspan="2" align="center" width="500"> <span id="Label1" class="texto18"><?php echo $_SESSION['nomexa_s']; ?>
          </span></td>
      </tr>
	  -->
      <tr> 
        <td  colspan="2" align="left" height="100" width="700">
		 <table height="359" border="0" align="left" cellpadding="0" cellspacing="0" class="texto1313" id="Table2"
             style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 95px; height: 2px">Código</td>
              <td width="365" style="width: 314px; height: 3px"> 
                <?php echo $codigo_w; ?>
              </td>
            </tr>
            <tr style="color: #000000"> </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 95px; height: 2px">Nombre</td>
              <td width="365" style= "height: 3px"> 
                <?php echo $nompac_w ?>
              </td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 18px">Rut</td>
              <td style="width: 314px; height: 18px"> 
                <?php echo $rutpac_w; ?>
              </td>
            </tr>
			 <tr> 
              <td height="22" style="width: 95px; height: 18px">Edad</td>
              <td style="width: 314px; height: 18px"> 
                <?php if($edad_w<>0){echo $edad_w . "  años";} else{echo "";} ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 18px">Fecha Examen</td>
              <td style="width: 314px; height: 18px"> 
                <?php echo $fecha_w; ?>
              </td>
            </tr>
            
           <tr> 
              <td style="width: 105px; height: 2px"></td>
              <td style="width: 314px; height: 3px"></td>
            </tr>
			<tr> 
              <td style="height: 2px; " colspan="2"  >
                <?php 
				echo $detalle_w; 
				?>
              </td>
             </tr>
            
            <tr> 
              <td height="16" style="width: 105px; height: 2px">&nbsp;</td>
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
