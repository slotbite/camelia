<?php
// Sistema			: ECO
// Programa			: ECO016_i.PHP
// Descripcion		: Imprime Exámen EcoCardiograma.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 03/11/2010

session_start();

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Imprime Ecotomografia Abdominal</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	 
		 function f_imprimir(){
        /*-----------------------------------*/
			window.print()
			        }

		</script>
</head>
<?php

if (!empty( $_GET["CODIGO"] ) ) {
   $codigo_w = $_GET["CODIGO"];   
}
else{
  $codigo_w = "";
}


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
	
if ($_GET["CODIGO"] > 0)
    {
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_ECOCARDIOGRAMA('".$_GET["CODIGO"]."',null,null,null,null,null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$fecha_w  		= $row["fecha"];
		$diastole_w  	= $row["IDIASTOLE"];
		$sistole_w  	= $row["ISISTOLE"];
		$septum_w  		= $row["ISEPTUM"];
		$ppost_w  		= $row["IPAREDPOST"];
		$aorta_w  		= $row["IAORTA"];
		$aizq_w  		= $row["IAURIZQ"];
		$infundib_w  	= $row["IINFUNDIBVI"];
		$apulm_w  		= $row["IARTPULM"];
		$facort_w  		= $row["IFRACCACORT"];
		$feyecc_w  		= $row["IFRACCEYECC"];
		$debitoc_w  	= $row["IDEBITOCARD"];
		$dpdt_w  		= $row["IDPDTVI"];
		$ea_w  			= $row["IEA"];
		$triv_w  		= $row["ITRIV"];
		$tpfr_w  		= $row["ITPFR"];
		$pendef_w  		= $row["IPENDEF"];
		$vaortica_w  	= $row["TVAORTICA"];
		$vmitral_w  	= $row["TVMITRAL"];
		$cavidadvi_w  	= $row["TCAVIDADVI"];
		$espesorp_w  	= $row["TESPESORP"];
		$dinamicag_w  	= $row["TDINAMICAG"];
		$dinamicas_w  	= $row["TDINAMICAS"];
		$vderecho_w  	= $row["TVENTRICULOD"];
		$auriculas_w  	= $row["TAURICULAS"];
		$pericardio_w  	= $row["TPERICARDIO"];
		$mintra_w  		= $row["TMASASINTRAC"];
		$gvasos_w  		= $row["TGRANDESV"];
		$faortico_w  	= $row["TFLUJOAOR"];
		$fmitral_w  	= $row["TFLUJOMIT"];
		$ftricuspide_w  = $row["TFLUJOTRI"];
		$fpulmonar_w  	= $row["TFLUJOPUL"];
		$conclusion_w  	= $row["TCONCLUSION"];
		$otflujos_w  	= $row["TOTFLUJOS"];
		$medico_w    	= $row["rutmedico"];
		$nompac_w = $row["npaciente"] ." ". $row["ppaciente"]." ". $row["mpaciente"];
		$rutpac_w = $row["rutpaciente"];
		$nommed_w = $row["nmedico"] ." ". $row["pmedico"]." ". $row["mmedico"];
		$rutmed_w = $row["rutmedico"];
		$especial_w = $row["nEspecial"];


		}
		
	mysqli_free_result($result);
	mysqli_close($link);
}
//llena ddl medicos

	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query="call ECO_PSEL_MEDICOS(null,null,null)";
	
	$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);
	
	$lst_medicos="<select name='ddl_medicos' id='ddl_medicos' class='input-normal'>\n<option value='0' selected>Médicos</option>";
	
	while($registro=mysqli_fetch_array($r))
	{    
//	   $lst_medicos.="\n<option value='".$registro[0]."'>".$registro[2]." ".$registro[3]." ".$registro[1]."</option>";
 		if ($registro[0] == $medico_w)
	      {
		   $lst_medicos.="\n<option selected='selected' value='".$registro[0]."'>".$registro[2]." ".$registro[3]." ".$registro[1]."</option>";
          }
		  else
		  {
           $lst_medicos.="\n<option value='".$registro[0]."'>".$registro[2]." ".$registro[3]." ".$registro[1]."</option>";
		
		   }
	}
	
	$lst_medicos.="\n</select>";
	
	mysqli_close($link);

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
<!--        
   <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 16px; position: absolute; top: 86px; height: 498px; width: 723px;" >
   -->
 <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; position: absolute; top: 86px; width: 723px;" >

      <tr>
        <td colspan="2" style="height: 20px" valign="bottom" align="center" width="500"> 
          <span id="Label1" class="texto18"> ECOCARDIOGRAFÍA - DOPPLER</span></td>
            </tr>
           
          <tr>
			<td style="width: 14px; height: 24px">
			</td>
			<td align="center" height="100" width="480">
			   <table id="Table2" align="center" border="0" cellpadding="0" cellspacing="0" class="texto13"
					style="height: 88px; text-align: left;" width="569">
            <tr> 
              <td colspan="4" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="105" height="21" >Código</td>
              <td  colspan="3" style="width: 314px; height: 3px"> <?php echo $codigo_w; ?></td>

            </tr>
            
            <tr style="color: #000000"> 
              <td height="21" style="width: 105px">Nombre Paciente</td>
              <td  colspan="3" style="width: 314px; height: 3px"><?php echo $nompac_w ?> </td> 

            </tr>
            <tr> 
              <td height="22" style="width: 105px">Rut</td>
              <td width="158" style="width: 95px; height: 18px" ><?php echo $rutpac_w; ?></td>
               <td width="130" style="width: 95px; height: 18px" >&nbsp;Fecha Exámen</td>
                <td width="160" style="width: 114px; height: 18px">&nbsp;<?php echo $fecha_w; ?></td>

            </tr>
          </table>
			
          <table width="538" border="0" cellspacing="0" cellpadding="0" class="texto13">
		   
			<tr> 
              <td height="16" colspan="6" style="height: 2px"><hr></hr></td>
            </tr>
            <tr> 
              <td colspan="3" style="width: 250px; height: 2px" class="txtngr">VENTRÍCULO 
                IZQUIERDO </td>
              <td colspan="3" style="width: 250px; height: 2px" class="txtngr">FUNCIÓN 
                SISTÓLICA </td>
            </tr>
            <tr> 
              <td width="145" align="left">Diástole :</td>
              <td width="30" style="height: 18px"><?php echo $diastole_w; ?></td>
              <td width="59" align="left">mm</td>
              <td width="139" align="left">Fracc.Acort :</td>
              <td width="30" style="width: 14px; height: 18px"><?php echo $facort_w; ?></td>
              <td width="59" align="left">%</td>
            </tr>
            <tr> 
              <td width="145" align="left">Sístole :</td>
              <td style="width: 30px; height: 18px"><?php echo $sistole_w; ?></td>
              <td width="59" align="left">mm</td>
              <td width="139" align="left">Fracc.Eyecc :</td>
              <td style="width: 30px; height: 18px"><?php echo $feyecc_w; ?></td>
              <td width="59" align="left">%</td>
            </tr>
            <tr> 
              <td width="145" align="left">Septum :</td>
              <td style="width: 30px; height: 18px"><?php echo $septum_w; ?></td>
			  <td width="59" align="left">mm</td>
              <td width="139" align="left">Débito Card.:</td>
              <td style="width: 30px; height: 18px"><?php echo $debitoc_w; ?></td>
              <td width="59" align="left">%</td>
            </tr>
            <tr> 
              <td width="145" align="left">Pared Post. :</td>
              <td style="width: 30px; height: 18px"><?php echo $ppost_w; ?></td>
              <td width="59" align="left">mm</td>
              <td width="139" align="left">dp/dt.VI :</td>
              <td style="width: 30px; height: 18px"><?php echo $dpdt_w; ?></td>
              <td width="59">&nbsp;</td>
            </tr>
            <tr> 
              <td height="16" colspan="3" style="width: 115px; height: 2px">&nbsp;</td>
             
              <td height="16" colspan="3" style="width: 250px; height: 2px" class="txtngr">FUNCIÓN 
                DIASTÓLICA </td>
               </tr>
            <tr> 
              <td width="145" align="left">AORTA :</td>
              <td style="width: 30px; height: 18px"><?php echo $aorta_w; ?></td>
              <td width="59" align="left">mm</td>
              <td width="139" align="left">E/A :</td>
              <td style="width: 30px; height: 18px"><?php echo $ea_w; ?></td>
              <td width="59">&nbsp;</td>
            </tr>
            <tr> 
              <td width="145" align="left">AURÍCULA IZQDA :</td>
              <td style="width: 30px; height: 18px"><?php echo $aizq_w; ?></td>
              <td width="59" align="left">mm</td>
              <td width="139" align="left">TRIV :</td>
              <td style="width: 30px; height: 18px"><?php echo $triv_w; ?></td>
              <td width="59">&nbsp;</td>
            </tr>
            <tr> 
              <td width="145" align="left">INFUNDIB.VI :</td>
              <td style="width: 30px; height: 18px"><?php echo $infundib_w; ?></td>
              <td width="59" align="left">mm</td>
              <td width="139" align="left">TPFR :</td>
              <td style="width: 30px; height: 18px"><?php echo $tpfr_w; ?></td>
              <td width="59">&nbsp;</td>
            </tr>
            <tr> 
              <td width="145" align="left">ARTERIA PULM. :</td>
              <td style="width: 30px; height: 18px"><?php echo $apulm_w; ?></td>
              <td width="59" align="left">mm</td>
              <td width="139" align="left">Pendiente EF :</td>
              <td style="width: 30px; height: 18px"><?php echo $pendef_w; ?></td>
              <td width="59">&nbsp;</td>
            </tr>
			<tr> 
              <td height="16" colspan="6" style="height: 2px"><hr></hr></td>
            </tr>
            <tr> 
                      
          </table>
          <table id="Table3" align="center" border="0" cellpadding="0" cellspacing="0" class="texto13"
                        style="height: 88px; text-align: left;" width="612">
            
            <tr> 
              <td colspan="2" style="width: 255px; height: 2px" class="txtngr">ECO MODO-M Y BIDIMENSIONAL</td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            
            <tr> 
              <td style="width: 95px; height: 2px">Válvula Aórtica</td>
              <td style="width: 514px; height: 3px"> <?php echo $vaortica_w; ?> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td style="width: 95px; height: 3px">Válvula Mitral </td>
              <td style="width: 314px; height: 3px"> <?php echo $vmitral_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px">Cavidad del VI</td>
              <td style="width: 314px; height: 3px"> <?php echo $cavidadvi_w; ?> 
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 195px; height: 3px">Espesor de paredes</td>
              <td style="width: 314px; height: 3px"> <?php echo $espesorp_w; ?>
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px">Dinámica Global</td>
              <td style="width: 314px; height: 3px"><?php echo $dinamicag_w; ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 155px; height: 3px">Dinámica Segementaria</td>
              <td style="width: 314px; height: 3px"> <?php echo $dinamicas_w; ?>
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 115px; height: 2px">Ventrículo Derecho</td>
              <td style="width: 314px; height: 3px"><?php echo $vderecho_w; ?>
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px">Aurículas</td>
              <td style="width: 314px; height: 3px"><?php echo $auriculas_w; ?> 
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px">Pericardio</td>
              <td style="width: 314px; height: 3px"><?php echo $pericardio_w; ?>
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			<tr> 
              <td style="width: 155px; height: 2px">Masas Intracardiacas</td>
              <td style="width: 314px; height: 3px"><?php echo $mintra_w; ?>
                &nbsp;</td>
            </tr>

            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">Grandes Vasos</td>
              <td style="width: 314px; height: 3px"><?php echo $gvasos_w; ?>
                &nbsp;</td>
            </tr>
			<tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">Otros Flujos</td>
              <td style="width: 314px; height: 3px"><?php echo $otflujos_w; ?>
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			 <tr> 
              <td colspan="2" style="width: 255px; height: 2px" class="txtngr">DOPPLER ESPECTRAL Y FLUJO-COLOR</td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">Flujo Aórtico</td>
              <td style="width: 314px; height: 3px"><?php echo $faortico_w; ?>
                &nbsp;</td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">Flujo Mitral</td>
              <td style="width: 314px; height: 3px"><?php echo $fmitral_w; ?>
                &nbsp;</td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">Flujo Tricúspide</td>
              <td style="width: 314px; height: 3px"><?php echo $ftricuspide_w; ?>
                &nbsp;</td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">Flujo Pulmonar</td>
              <td style="width: 314px; height: 3px"><?php echo $fpulmonar_w; ?>
                &nbsp;</td>
            </tr>

            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			 <tr> 
              <td colspan="2" style="width: 255px; height: 2px;text-decoration: underline;" class="txtngr">CONCLUSIÓN</td>
            </tr>
			<tr> 
              <td colspan="2" align="justify" style="width: 514px; height: 3px"><?php echo nl2br($conclusion_w);?></td>
               </tr>
			  <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
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
              <td height="27" style="width: 105px; height: 2px"></td>

              <td  align="center" style="width: 314px; height: 3px"> 
                <?php echo $nommed_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"></td>

              <td  align="center" style="width: 314px; height: 3px"> 
                <?php echo $rutmed_w; ?>
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"></td>

              <td  align="center" style="width: 314px; height: 3px"> 
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
	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";
	
	}
}
?>
   
</form>

</body>
</html>
