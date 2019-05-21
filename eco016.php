<?php
// Sistema			: ECO
// Programa			: ECO016.PHP
// Descripcion		: Ingreso Exámen EcoCardiograma.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 02/11/2010

session_start();

if (!isset($_SESSION["nompac_s"])){ $_SESSION['nompac_s']="";} 
if (!isset($_SESSION["rutpac_s"])){ $_SESSION['rutpac_s']="";} 
if (!isset($_SESSION["nommed_s"])){ $_SESSION['nommed_s']="";} 
if (!isset($_SESSION["rutmed_s"])){ $_SESSION['rutmed_s']="";} 
if (!isset($_SESSION["especial_s"])){ $_SESSION['especial_s']="";} 

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ecotomografia Abdominal</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
        function f_SelPaciente(){
        /*-----------------------------------*/
		  
 //         window.open('eco_autoriza.php?PAGINA=' + 'eco002.php' ,'Paciente','width=650, height=550, status=yes, resizable=no , menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
            window.open('eco_autoriza.php?PAGINA=' + 'pacientes2.html' ,'Paciente','width=650, height=550, status=no, resizable=no , menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();

			        }
					
	   function f_SelMedico(){
	   /*-----------------------------------*/
//	     pant_emp = window.open("","Medico","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
//	     pant_emp.location = "eco006.php" 
		 
         window.open('eco_autoriza.php?PAGINA=' + 'eco006.php','Medico','width=650, height=550, status=yes, resizable=no , menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();


		 }

		function Imprimir_Vtna(cod){
	/*-----------------------------------*/
	
//		 alert("imprime");
//		pant_emp = window.open("","Imprimir","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
//		pant_emp.location = "eco008_i.php?CODIGO=" + cod;
        window.open('eco_autoriza.php?PAGINA=' + 'eco016_i.php?CODIGO=' + cod,'eco016_i','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();

			
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

//echo $rut_w;
if (!$_POST and empty($_GET["CODIGO"]) ){
	
//echo 'pase';

    $_SESSION['rutpac_s'] = "";
	$_SESSION['nompac_s'] = "";
	$_SESSION['nommed_s'] = "";
    $_SESSION['rutmed_s'] = "";
    $_SESSION['especial_s'] = "";

}
?>

<body>
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

//$codigo_w = "";
$fecha_w = date("d/m/Y");
$modo_w = "I";

if (isset($_POST['cmd_codigo'])){
	$codigo_w  = $_POST['cmd_codigo'];
	}

if (!empty($codigo_w)) {
   $modo_w = "M";

}
else{
  $modo_w = "I";
}

if (isset($_POST['cmd_fecha'])){
	$fecha_w  = $_POST['cmd_fecha'];
	}
else{
	$fecha_w  = date("d/m/Y");
	}

if (isset($_POST['cmd_diastole'])){
	$diastole_w  = $_POST['cmd_diastole'];
	}
else{
	$diastole_w  = "";
	}
	
if (isset($_POST['cmd_sistole'])){
	$sistole_w  = $_POST['cmd_sistole'];
	}
else{
	$sistole_w  = "";
	}
if (isset($_POST['cmd_septum'])){
	$septum_w  = $_POST['cmd_septum'];
	}
else{
	$septum_w  = "";
	}
if (isset($_POST['cmd_ppost'])){
	$ppost_w  = $_POST['cmd_ppost'];
	}
else{
	$ppost_w  = "";
	}
if (isset($_POST['cmd_aorta'])){
	$aorta_w  = $_POST['cmd_aorta'];
	}
else{
	$aorta_w  = "";
	}
if (isset($_POST['cmd_aizq'])){
	$aizq_w  = $_POST['cmd_aizq'];
	}
else{
	$aizq_w  = "";
	}
if (isset($_POST['cmd_infundib'])){
	$infundib_w  = $_POST['cmd_infundib'];
	}
else{
	$infundib_w  = "";
	}
if (isset($_POST['cmd_apulm'])){
	$apulm_w  = $_POST['cmd_apulm'];
	}
else{
	$apulm_w  = "";
	}
if (isset($_POST['cmd_facort'])){
	$facort_w  = $_POST['cmd_facort'];
	}
else{
	$facort_w  = "";
	}
if (isset($_POST['cmd_feyecc'])){
	$feyecc_w  = $_POST['cmd_feyecc'];
	}
else{
	$feyecc_w  = "";
	}
if (isset($_POST['cmd_debitoc'])){
	$debitoc_w  = $_POST['cmd_debitoc'];
	}
else{
	$debitoc_w  = "";
	}
if (isset($_POST['cmd_dpdt'])){
	$dpdt_w  = $_POST['cmd_dpdt'];
	}
else{
	$dpdt_w  = "";
	}
if (isset($_POST['cmd_ea'])){
	$ea_w  = $_POST['cmd_ea'];
	}
else{
	$ea_w  = "";
	}
if (isset($_POST['cmd_triv'])){
	$triv_w  = $_POST['cmd_triv'];
	}
else{
	$triv_w  = "";
	}
if (isset($_POST['cmd_tpfr'])){
	$tpfr_w  = $_POST['cmd_tpfr'];
	}
else{
	$tpfr_w  = "";
	}
if (isset($_POST['cmd_pendef'])){
	$pendef_w  = $_POST['cmd_pendef'];
	}
else{
	$pendef_w  = "";
	}

if (isset($_POST['cmd_vaortica'])){
	$vaortica_w  = trim($_POST['cmd_vaortica']);
	}
else{
//	$higado_w  = "De forma, tamano y estructura conservados. Mide  xxx mm en LAAD. Los margenes son lisos. No hay imagenes focales." ;
	$vaortica_w  = "Levemente engrosada, de apertura conservada.";
	}
if (isset($_POST['cmd_vmitral'])){
	$vmitral_w  = trim($_POST['cmd_vmitral']);
	}
else{
	$vmitral_w  = "De morfología y movilidad normales.";
	}
if (isset($_POST['cmd_cavidadvi'])){
	$cavidadvi_w  = trim($_POST['cmd_cavidadvi']);
	}
else{
	$cavidadvi_w  = "";
	}
if (isset($_POST['cmd_espesorp'])){
	$espesorp_w  = trim($_POST['cmd_espesorp']);
	}
else{
	$espesorp_w  = "";
	}
if (isset($_POST['cmd_dinamicag'])){
	$dinamicag_w  = trim($_POST['cmd_dinamicag']);
	}
else{
	$dinamicag_w  = "";
	}
if (isset($_POST['cmd_dinamicas'])){
	$dinamicas_w  = trim($_POST['cmd_dinamicas']);
	}
else{
	$dinamicas_w  = "";
	}

if (isset($_POST['cmd_vderecho'])){
	$vderecho_w  = trim($_POST['cmd_vderecho']);
	}
else{
	$vderecho_w = "";
	}
if (isset($_POST['cmd_auriculas'])){
	$auriculas_w  = trim($_POST['cmd_auriculas']);
	}
else{
	$auriculas_w = "";
	}
if (isset($_POST['cmd_pericardio'])){
	$pericardio_w  = trim($_POST['cmd_pericardio']);
	}
else{
	$pericardio_w = "";
	}
if (isset($_POST['cmd_mintra'])){
	$mintra_w  = trim($_POST['cmd_mintra']);
	}
else{
	$mintra_w = "(-)";
	}
if (isset($_POST['cmd_gvasos'])){
	$gvasos_w  = trim($_POST['cmd_gvasos']);
	}
else{
	$gvasos_w = "Normales.";
	}
if (isset($_POST['cmd_otflujos'])){
	$otflujos_w  = trim($_POST['cmd_otflujos']);
	}
else{
	$otflujos_w = "";
	}
	
if (isset($_POST['cmd_faortico'])){
	$faortico_w  = trim($_POST['cmd_faortico']);
	}
else{
	$faortico_w = "";
	}
if (isset($_POST['cmd_fmitral'])){
	$fmitral_w  = trim($_POST['cmd_fmitral']);
	}
else{
	$fmitral_w = "";
	}
if (isset($_POST['cmd_ftricuspide'])){
	$ftricuspide_w  = trim($_POST['cmd_ftricuspide']);
	}
else{
	$ftricuspide_w = "Normal.";
	}
if (isset($_POST['cmd_fpulmonar'])){
	$fpulmonar_w  = trim($_POST['cmd_fpulmonar']);
	}
else{
	$fpulmonar_w = "Normal.";
	}

if (isset($_POST['txt_impresion'])){
	$impresion_w  = trim($_POST['txt_impresion']);
	}
else{
	$impresion_w = "";
	}
if (isset($_POST['txt_conclusion'])){
	$conclusion_w  = trim($_POST['txt_conclusion']);
	}
else{
	$conclusion_w = "";
	}

if (isset($_POST['ddl_medicos']))
{
	$medico_w  = $_POST['ddl_medicos'];
	}
else
{
	$medico_w  = "";
	}

	
if ($_GET["CODIGO"] > 0)
    {
	$modo_w = "M";
	
	if (!$_POST)

	{ 
	
	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//	mysql_select_db(DB_NAME, $link); 

	
	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_ECOCARDIOGRAMA('".$_GET["CODIGO"]."',null,null,null,null,null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		
		/*e.CCODIGO      codigo,
        e.CRUTPAC      rutpaciente,
        p.nnombre      npaciente,
        p.nappaterno   ppaciente,
        p.napmaterno   mpaciente,
        date_format(e.DFECHA, '%d/%m/%Y')  fecha,
        e.IDIASTOLE,
        e.ISISTOLE,
        e.ISEPTUM,
        e.IPAREDPOST,
        e.IAORTA,
        e.IAURIZQ,
        e.IINFUNDIBVI,
        e.IARTPULM,
        e.IFRACCACORT,
        e.IFRACCEYECC,
        e.IDEBITOCARD,
        e.IDPDTVI,
        e.IEA,
        e.ITRIV,
        e.ITPFR,
        e.IPENDEF,
        e.TVAORTICA,
        e.TVMITRAL,
        e.TCAVIDADVI,
        e.TESPESORP,
        e.TDINAMICAG,
        e.TDINAMICAS,
        e.TVENTRICULOD,
        e.TAURICULAS,
        e.TPERICARDIO,
        e.TMASASINTRAC,
        e.TGRANDESV,
        e.TFLUJOAOR,
        e.TFLUJOMIT,
        e.TFLUJOTRI,
        e.TFLUJOPUL,
        e.TCONCLUSION,
        e.CRUTMED       rutmedico,
        m.nnombre       nmedico,
        m.nappaterno    pmedico,
        m.napmaterno    mmedico,
        d.nDescripcion   nEspecial,
        m.cespecial     cespecial
        */
		
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
    	
		$_SESSION['rutpac_s'] = $row["rutpaciente"];
		$_SESSION['nompac_s'] = $row["npaciente"]." ".$row["ppaciente"];
		$_SESSION['nommed_s'] = $row["nmedico"]." ".$row["pmedico"];
    	$_SESSION['rutmed_s'] = $row["rutmedico"];
    	$_SESSION['especial_s'] = $row["nEspecial"];
		
		}
		
	mysqli_free_result($result);
	mysqli_close($link);
	}
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
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 16px; position: absolute; top: 6px; height: 498px; width: 623px;" width="510">
      <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                
        <td style="height: 24px" valign="bottom"> <span id="Label1" class="texto18"> 
          ECOCARDIOGRAMA</span></td>
            </tr>
            <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                <td style="background-image: url(ivvpp0005.jpg); height: 21px">
                </td>
            </tr>
          <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                <td align="center" height="100" width="480">
                   <table id="Table2" align="center" border="0" cellpadding="0" cellspacing="0" class="texto11"
                        style="height: 88px; text-align: left;" width="612">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="131" height="21" style="width: 95px; height: 2px"> &nbsp; 
                Código</td>
              <td width="365" style="width: 314px; height: 3px"> <input name="cmd_codigo" type="text" maxlength="40" id="cmd_codigo2" class="input-normal" style="border:1px solid #FFFFFF;color:Red;"  value="<?php echo $codigo_w; ?>" readonly="readonly"/></td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Nombre Paciente</td>
              <td width="365" style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" maxlength="40" id="cmd_nombre" class="input-normal" style="width:176px;"  value="<?php echo $_SESSION['nompac_s']; ?>" readOnly="readonly"/> 
                <input name="imgPaciente" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelPaciente()" /> 
                &nbsp; &nbsp; <span id="PacMalo" style="color:Red;font-weight:bold;visibility:hidden;">Paciente 
                Erróneo</span></td>
            </tr>
            <tr> 
              <td height="22" style="width: 95px; height: 18px"> &nbsp; <span id="Lb_identificador" style="display:inline-block;width:83px;">Rut</span></td>
              <td style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="border:1px solid #FFFFFF;" value="<?php echo $_SESSION['rutpac_s']; ?>" readOnly="readonly" /> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 18px">&nbsp; Fecha Examen</td>
              <td style="width: 314px; height: 18px"> <input name="cmd_fecha" type="text" maxlength="10" id="cmd_fecha" class="input-normal" value="<?php echo $fecha_w; ?>"/> 
                &nbsp; <span id="FecMala" style="color:Red;font-weight:bold;visibility:hidden;">Fecha 
                Errónea</span> </td>
            </tr>
            <tr> 
              <td height="16" style="width: 95px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 3px">&nbsp;</td>
            </tr>
			</table>
			
          <table width="564" border="1" cellspacing="0" cellpadding="0" class="texto11">
            <tr> 
              <td colspan="3" style="width: 130px; height: 2px" class="txtngr">VENTRICULO 
                IZQUIERDO </td>
              <td colspan="3" style="width: 115px; height: 2px" class="txtngr">FUNCION 
                SISTOLICA </td>
            </tr>
            <tr> 
              <td width="130" align="left">Diástole :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_diastole" type="text" class="input-normal" id="cmd_diastole" value="<?php echo $diastole_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">mm</td>
              <td width="130" align="left">Fracc.Acort :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_facort" type="text" class="input-normal" id="cmd_facort" value="<?php echo $facort_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">%</td>
            </tr>
            <tr> 
              <td width="130" align="left">Sístole :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_sistole" type="text" class="input-normal" id="cmd_sistole" value="<?php echo $sistole_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">mm</td>
              <td width="130" align="left">Fracc.Eyecc :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_feyecc" type="text" class="input-normal" id="cmd_feyecc" value="<?php echo $feyecc_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">%</td>
            </tr>
            <tr> 
              <td width="130" align="left">Septum :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_septum" type="text" class="input-normal" id="cmd_septum" value="<?php echo $septum_w; ?>" size="5" maxlength="6" /></td>
			  <td width="42">mm</td>
              <td width="130" align="left">Débito Card.:</td>
              <td style="width: 14px; height: 18px"><input name="cmd_debitoc" type="text" class="input-normal" id="cmd_debitoc" value="<?php echo $debitoc_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">%</td>
            </tr>
            <tr> 
              <td width="130" align="left">Pared Post. :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_ppost" type="text" class="input-normal" id="cmd_ppost" value="<?php echo $ppost_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">mm</td>
              <td width="130" align="left">dp/dt.VI :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_dpdt" type="text" class="input-normal" id="cmd_dpdt" value="<?php echo $dpdt_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td height="16" colspan="3" style="width: 115px; height: 2px">&nbsp;</td>
             
              <td height="16" colspan="3" style="width: 115px; height: 2px" class="txtngr">FUNCION 
                DIASTOLICA </td>
               </tr>
            <tr> 
              <td width="130" align="left">AORTA :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_aorta" type="text" class="input-normal" id="cmd_aorta" value="<?php echo $aorta_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">mm</td>
              <td width="130" align="left">E/A :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_ea" type="text" class="input-normal" id="cmd_ea" value="<?php echo $ea_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td width="130" align="left">AURICULA IZQDA :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_aizq" type="text" class="input-normal" id="cmd_aizq" value="<?php echo $aizq_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">mm</td>
              <td width="130" align="left">TRIV :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_triv" type="text" class="input-normal" id="cmd_triv" value="<?php echo $triv_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td width="130" align="left">INFUNDIB.VI :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_infundib" type="text" class="input-normal" id="cmd_infundib" value="<?php echo $infundib_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">mm</td>
              <td width="130" align="left">TPFR :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_tpfr" type="text" class="input-normal" id="cmd_tpfr" value="<?php echo $tpfr_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td width="130" align="left">ARTERIA PULM. :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_apulm" type="text" class="input-normal" id="cmd_apulm" value="<?php echo $apulm_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">mm</td>
              <td width="130" align="left">Pendiente EF :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_pendef" type="text" class="input-normal" id="cmd_pendef" value="<?php echo $pendef_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table id="Table3" align="center" border="0" cellpadding="0" cellspacing="0" class="texto11"
                        style="height: 88px; text-align: left;" width="612">
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td colspan="2" style="width: 255px; height: 2px" class="txtngr">ECO MODO-M Y BIDIMENSIONAL</td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp;Válvula Aórtica</td>
              <td style="width: 514px; height: 3px"> <textarea name="cmd_vaortica" cols="50" rows="3" class="input-normal" ><?php echo $vaortica_w; ?> </textarea> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td style="width: 95px; height: 3px"> &nbsp;Válvula Mitral </td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_vmitral" cols="50" rows="3" class="input-normal" > <?php echo $vmitral_w; ?></textarea> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp;Cavidad del VI</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_cavidadvi" cols="50" rows="3" class="input-normal"><?php echo $cavidadvi_w; ?></textarea> 
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp;Espesor de paredes</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_espesorp" cols="50" rows="3" class="input-normal"><?php echo $espesorp_w; ?></textarea> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp;Dinámica Global</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_dinamicag" cols="50" rows="3" class="input-normal" > <?php echo $dinamicag_w; ?></textarea> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 3px">&nbsp;Dinámica Segementaria</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_dinamicas" cols="50" rows="3" class="input-normal" > <?php echo $dinamicas_w; ?></textarea> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 115px; height: 2px">&nbsp;Ventrículo Derecho</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_vderecho" cols="50" rows="3" class="input-normal" > <?php echo $vderecho_w; ?></textarea> 
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px">&nbsp;Aurículas</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_auriculas" cols="50" rows="3" class="input-normal" > <?php echo $auriculas_w; ?></textarea> 
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px">&nbsp;Pericardio</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_pericardio" cols="50" rows="3" class="input-normal" > <?php echo $pericardio_w; ?></textarea> 
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">&nbsp;Masas Intracardiacas</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_mintra" cols="50" rows="3" class="input-normal" > <?php echo $mintra_w; ?></textarea> 
                &nbsp;</td>
            </tr>

            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">&nbsp;Grandes Vasos</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_gvasos" cols="50" rows="3" class="input-normal" > <?php echo $gvasos_w; ?></textarea> 
                &nbsp;</td>
            </tr>
  			<tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">&nbsp;Otros Flujos</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_otflujos" cols="50" rows="3" class="input-normal" > <?php echo $otflujos_w; ?></textarea> 
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
              <td style="width: 105px; height: 2px">&nbsp;Flujo Aórtico</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_faortico" cols="50" rows="3" class="input-normal" > <?php echo $faortico_w; ?></textarea> 
                &nbsp;</td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">&nbsp;Flujo Mitral</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_fmitral" cols="50" rows="3" class="input-normal" > <?php echo $fmitral_w; ?></textarea> 
                &nbsp;</td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">&nbsp;Flujo Tricúspide</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_ftricuspide" cols="50" rows="3" class="input-normal" > <?php echo $ftricuspide_w; ?></textarea> 
                &nbsp;</td>
            </tr>
			<tr> 
              <td style="width: 105px; height: 2px">&nbsp;Flujo Pulmonar</td>
              <td style="width: 314px; height: 3px"> <textarea name="cmd_fpulmonar" cols="50" rows="3" class="input-normal" > <?php echo $fpulmonar_w; ?></textarea> 
                &nbsp;</td>
            </tr>

            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			 <tr> 
              <td colspan="2" style="width: 255px; height: 2px" class="txtngr">CONCLUSION</td>
            </tr>
			<tr> 
              <td colspan="2" style="width: 314px; height: 3px"> <textarea name="txt_conclusion" cols="100" rows="3" class="input-normal" ><?php echo $conclusion_w; ?></textarea>
                &nbsp; </tr>
			  <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"> &nbsp; MEDICO FIRMANTE</td>
              <td style="width: 314px; height: 3px"> 
                <?php
			  echo $lst_medicos;
			  ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
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
              <td colspan="2"> </td>
            </tr>
			<tr> 
              <td colspan="2"> </td>
            </tr>
          </table>
                    <table id="Table3" align="center" border="0" cellpadding="1" cellspacing="1"
                        style="width: 310px; height: 8px; background-color: whitesmoke;" width="310">
                        <tr>
<!--                            <td align="center" style="width: 126px"><input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" style="width:70px;" /></td>
-->
            				<?php
//							 echo '<td style="width: 45px"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" disabled="disabled" onClick="Imprimir_Vtna(&quot;'.$codigo_w.'&quot;)" </td>';
							 if ($codigo_w > 0 ) {
							     echo '<td align="center" style="width: 126px"><input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" style="width:70px;" /></td>';

	 							 echo '<td style="width: 45px"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" onClick="Imprimir_Vtna(&quot;'.$codigo_w.'&quot;)" </td>';
								}
							 else {	
 							     echo '<td align="center" style="width: 126px"><input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" disabled="disabled" style="width:70px;" /></td>';

								 echo '<td style="width: 45px"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" disabled="disabled" onClick="Imprimir_Vtna(&quot;'.$codigo_w.'&quot;)" </td>';
								}
							?>
			              
                            <td align="center">
			             <input type="submit" name="cmd_aceptar" value="Grabar" id="cmd_aceptar" class="boton" /></td>

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

<?php
if ($_POST){
 if(isset($_POST["cmd_aceptar"])) 
 {
	$fecha_w  = $_POST['cmd_fecha'];
	$diastole_w  = $_POST['cmd_diastole'];
	$sistole_w  = $_POST['cmd_sistole'];
	$septum_w  = $_POST['cmd_septum'];
	$ppost_w  = $_POST['cmd_ppost'];
	$aorta_w  = $_POST['cmd_aorta'];
	$aizq_w  = $_POST['cmd_aizq'];
	$infundib_w  = $_POST['cmd_infundib'];
	$apulm_w  = $_POST['cmd_apulm'];
	$facort_w  = $_POST['cmd_facort'];
	$feyecc_w  = $_POST['cmd_feyecc'];
	$debitoc_w  = $_POST['cmd_debitoc'];
	$dpdt_w  = $_POST['cmd_dpdt'];
	$ea_w  = $_POST['cmd_ea'];
	$triv_w  = $_POST['cmd_triv'];
	$tpfr_w  = $_POST['cmd_tpfr'];
	$pendef_w  = $_POST['cmd_pendef'];
	$vaortica_w  = trim($_POST['cmd_vaortica']);
	$vmitral_w  = trim($_POST['cmd_vmitral']);
	$cavidadvi_w  = trim($_POST['cmd_cavidadvi']);
	$espesorp_w  = trim($_POST['cmd_espesorp']);
	$dinamicag_w  = trim($_POST['cmd_dinamicag']);
	$dinamicas_w  = trim($_POST['cmd_dinamicas']);
	$vderecho_w  = trim($_POST['cmd_vderecho']);
	$auriculas_w  = trim($_POST['cmd_auriculas']);
	$pericardio_w  = trim($_POST['cmd_pericardio']);
	$mintra_w  = trim($_POST['cmd_mintra']);
	$gvasos_w  = trim($_POST['cmd_gvasos']);
	$otflujos_w  = trim($_POST['cmd_otflujos']);
	$faortico_w  = trim($_POST['cmd_faortico']);
	$fmitral_w  = trim($_POST['cmd_fmitral']);
	$ftricuspide_w  = trim($_POST['cmd_ftricuspide']);
	$fpulmonar_w  = trim($_POST['cmd_fpulmonar']);
	$conclusion_w  = trim($_POST['txt_conclusion']);
	
	$rutmed_w    = $_POST["ddl_medicos"];
	$rutpac_w  = $_POST['cmd_rut'];
	$nompac_w  = $_POST['cmd_nombre'];
	
	//empiezas las validaciones correspondientes por ejemplo

	$error_w = FALSE;
	if (strlen($nompac_w) == 0) { //que ingrese paciente
/*
        echo "<script type=\"text/javascript\">document.getElementById('PacMalo').style.display=''</script>";
*/
		echo  "<script type=\"text/javascript\">
		alert('Debe ingresar Paciente');
		</script>";    

		$error_w = TRUE;

		} 		
	if ($rutmed_w == "0") { //que ingrese medico
		echo  "<script type=\"text/javascript\">
		alert('Debe ingresar Médico');
		</script>";    

		$error_w = TRUE;
		} 	
		
	if (strlen($fecha_w) < 10) { //que ingrese fecha
	/*
        echo "<script type=\"text/javascript\">document.getElementById('FecMala').style.display=''</script>";
*/
		echo  "<script type=\"text/javascript\">
		alert('Debe ingresar Fecha Correcta');
		</script>";    

		$error_w = TRUE;
		} 		
	
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

//		$sql1 = "call ECO_PUPD_PACIENTES('I','".$rut_w."','".$nombre_w."','".$apepat_w."','".$apemat_w."',null,null,null,null,null,null,null,null,null)";
		$sql1 = "call ECO_PUPD_ECOCARDIOGRAMA('".$modo_w."','".$codigo_w."','".$rutpac_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'),";
        $sql1 = $sql1."'".$diastole_w."','".$sistole_w."','".$septum_w."','".$ppost_w."','".$aorta_w."','".$aizq_w."',";
        $sql1 = $sql1."'".$infundib_w."','".$apulm_w."','".$facort_w."','".$feyecc_w."','".$debitoc_w."',";
        $sql1 = $sql1."'".$dpdt_w."','".$ea_w."','".$triv_w."','".$tpfr_w."','".$pendef_w."','".$vaortica_w."','".$vmitral_w."',";
        $sql1 = $sql1."'".$cavidadvi_w."','".$espesorp_w."','".$dinamicag_w."','".$dinamicas_w."','".$vderecho_w."','".$auriculas_w."',";
        $sql1 = $sql1."'".$pericardio_w."','".$mintra_w."','".$gvasos_w."','".$faortico_w."','".$fmitral_w."','".$ftricuspide_w."',";
        $sql1 = $sql1."'".$fpulmonar_w."','".$conclusion_w."','".$otflujos_w."','".$rutmed_w."',@cod_w)";


/*
 `ECO_PUPD_ECOCARDIOGRAMA`(IN PMODO VARCHAR(1),
  PCCODIGO varchar(10) ,
  PCRUTPAC varchar(13) ,
  PDFECHA date  ,
  
  
  PTVENTRICULOD varchar(500) ,
  PTAURICULAS varchar(500) ,
  PTPERICARDIO varchar(500) ,
  PTMASASINTRAC varchar(500) ,
  PTGRANDESV varchar(500) ,
  PTFLUJOAOR varchar(500) ,
  PTFLUJOMIT varchar(500) ,
  PTFLUJOTRI varchar(500) ,
  PTFLUJOPUL varchar(500) ,
  PTCONCLUSION text ,
  PCRUTMED varchar(13) ,
OUT CODSAL_W VARCHAR(10))
*/


		
// echo $sql1;
// exit();
        $query = mysqli_query($link,$sql1);
		if ( !$query ) 
			{ $error = mysqli_error();
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link );
		     $nerror  = mysqli_errno($link );
		     if (mysqli_errno($link ) == 1062)
			    {
				$merror = "El examen ya existe....." ;
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
				alert('El Examen ha sido registrado de manera satisfactoria.');
				</script>";
			
			//rescato el codigo del examen

			$consulta = "SELECT @cod_w";
			$result   = mysqli_query($link,$consulta);
			$row      = mysqli_fetch_array($result);
			$codigo_w = $row[0];
//			$_POST['cmd_codigo'] = $codigo_w;
			$modo_w = "M";	
			mysqli_free_result($result); 
		    mysqli_close($link);
		
			echo '<script type=\'text/javascript\'>Form1.cmd_codigo.value="'.$codigo_w.'"</script>';
			echo '<script type=\'text/javascript\'>document.Form1.cmd_imprimir.disabled = false </script>';
			echo "<script>document.Form1.submit();</script>";


		   }//cierras todos los else que abras
      }      

 }

 } 
?>


</body>
</html>
