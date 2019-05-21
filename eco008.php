<?php
// Sistema			: ECO
// Programa			: ECO008.PHP
// Descripcion		: Ingreso Exámen Ecotomografia Abdominal.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 03/11/2010

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
  
//          window.open('eco_autoriza.php?PAGINA=' + 'eco002.php' ,'Paciente','width=650, height=550, status=yes, resizable=no , menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
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
        window.open('eco_autoriza.php?PAGINA=' + 'eco008_i.php?CODIGO=' + cod,'eco008_i','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();

			
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
//$modo_w = "I";

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

if (isset($_POST['cmd_solicitado'])){
	$solicitado_w  = $_POST['cmd_solicitado'];
	}
else{
	$solicitado_w  = "";
	}
if (isset($_POST['cmd_antecedentes'])){
	$antecedentes_w  = $_POST['cmd_antecedentes'];
	}
else{
	$antecedentes_w  = "";
	}
if (isset($_POST['cmd_higado'])){
	$higado_w  = trim($_POST['cmd_higado']);
	}
else{
//	$higado_w  = "De forma, tamano y estructura conservados. Mide  xxx mm en LAAD. Los margenes son lisos. No hay imagenes focales." ;
	$higado_w  = "De forma, tamaño y estructura conservados. Mide XXXX mm en LAAD. Los márgenes son lisos. No hay imágenes focales.";
	}
if (isset($_POST['cmd_vesicula'])){
	$vesicula_w  = trim($_POST['cmd_vesicula']);
	}
else{
	$vesicula_w  = "Mide XXXX cm. de diámetro longitudinal. Pared lisa de mm de espesor. No hay imágenes ecogénicas en su interior.";
	}
if (isset($_POST['cmd_coledoco'])){
	$coledoco_w  = trim($_POST['cmd_coledoco']);
	}
else{
	$coledoco_w  = "Mide XXXX  mm de diámetro (normal). No hay imágenes ecogénicas en su interior.";
	}
if (isset($_POST['cmd_pancreas'])){
	$pancreas_w  = trim($_POST['cmd_pancreas']);
	}
else{
	$pancreas_w  = "De forma, tamaño y estructura conservados. Sin lesiones focales.";
	}
if (isset($_POST['cmd_rinones'])){
	$rinones_w  = trim($_POST['cmd_rinones']);
	}
else{
	$rinones_w  = "De forma, tamaño y estructura conservados. Senos  renales normales. Área perirrenal normal.";
	}
if (isset($_POST['cmd_bazo'])){
	$bazo_w  = trim($_POST['cmd_bazo']);
	}
else{
	$bazo_w  = "Mide XXXX mm de diámetro longitudinal (normal). Estructura homogénea.";
	}
if (isset($_POST['cmd_vasos'])){
	$vasos_w  = trim($_POST['cmd_vasos']);
	}
else{
	$vasos_w = "Sin alteraciones ecográficas.";
	}
if (isset($_POST['cmd_ascitis'])){
	$ascitis_w  = trim($_POST['cmd_ascitis']);
	}
else{
	$ascitis_w = "No hay.";
	}
if (isset($_POST['txt_impresion'])){
	$impresion_w  = trim($_POST['txt_impresion']);
	}
else{
	$impresion_w = "";
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
	$consulta="call ECO_PSEL_ECOABDOMINAL('".$_GET["CODIGO"]."',null,null,null,null,null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$fecha_w    = $row["fecha"];
		$solicitado_w    = $row["tsolicitado"];
		$antecedentes_w  = $row["TANTECEDENTES"];
		$higado_w    = $row["THIGADO"];
		$vesicula_w  = $row["TVESICULA"];
		$coledoco_w  = $row["TCOLEDOCO"];
		$pancreas_w  = $row["TPANCREAS"];
		$rinones_w   = $row["TRINONES"];
		$bazo_w  = $row["TBAZO"];
		$vasos_w = $row["TVASRETRO"];
		$ascitis_w   = $row["TASCITIS"];
		$impresion_w = $row["TDIAGNOSTICO"];
		$medico_w = $row["rutmedico"];
    	
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
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18"> ECOTOMOGRAFÍA  - ABDOMINAL</span></td>
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
                        style="height: 88px; text-align: left;" width="512">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
			   <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 95px; height: 2px"> &nbsp; Código</td>
			  <!--
              <td width="365" style="width: 314px; height: 3px"> <input name="cmd_codigo" type="text" maxlength="40" id="cmd_codigo2" class="input-normal" style="border:1px solid #FFFFFF;color:Red;"  value="<?php if ( isset($_POST['cmd_codigo']) ) echo $_POST['cmd_codigo']; ?>" readonly="readonly"/></td>
			  -->
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
			   &nbsp; <span id="FecMala" style="color:Red;font-weight:bold;visibility:hidden;">Fecha Errónea</span>
              </td>
            </tr>
            <tr> 
              <td height="16" style="width: 95px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 3px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Solicitado 
                Por </td>
              <td style="width: 314px; height: 3px"> <input name="cmd_solicitado" type="text" maxlength="40" id="cmd_solicitado" class="input-normal" style="width:176px;" value="<?php echo $solicitado_w; ?>"/> 
                &nbsp; </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Antecedentes</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_antecedentes" type="text" class="input-normal" id="cmd_antecedentes"  value="<?php echo $antecedentes_w; ?>" size="80" maxlength="100" /> 
                &nbsp; </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
			<tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr><tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; HÍGADO</td>
              <td style="width: 514px; height: 3px">
			  <textarea name="cmd_higado" cols="50" rows="3" class="input-normal" ><?php echo $higado_w; ?> </textarea>
			    </td>
            </tr>
			 <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td style="width: 95px; height: 3px"> &nbsp; VESÍCULA </td>
              <td style="width: 314px; height: 3px">
			  <textarea name="cmd_vesicula" cols="50" rows="3" class="input-normal" > <?php echo $vesicula_w; ?></textarea>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; COLÉDOCO</td>
              <td style="width: 314px; height: 3px">
			  <textarea name="cmd_coledoco" cols="50" rows="3" class="input-normal" ><?php echo $coledoco_w; ?></textarea>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
           
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; PÁNCREAS</td>
              <td style="width: 314px; height: 3px">
			  <textarea name="cmd_pancreas" cols="50" rows="3" class="input-normal" > <?php echo $pancreas_w; ?></textarea>
                &nbsp; </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 3px"> &nbsp; AMBOS RIÑONES</td>
              <td style="width: 314px; height: 3px">
			  <textarea name="cmd_rinones" cols="50" rows="3" class="input-normal" > <?php echo $rinones_w; ?></textarea>
              </td>
            </tr>
			 <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 3px"> &nbsp; BAZO</td>
              <td style="width: 314px; height: 3px"> 
			  <textarea name="cmd_bazo" cols="50" rows="3" class="input-normal" > <?php echo $bazo_w; ?></textarea>
                &nbsp; </td>
            </tr>
			 <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 115px; height: 2px"> &nbsp; GRANDES VASOS Y RETROPERITONEO</td>
              <td style="width: 314px; height: 3px"> 
  			  <textarea name="cmd_vasos" cols="50" rows="3" class="input-normal" > <?php echo $vasos_w; ?></textarea>
                &nbsp; </td>
            </tr>
			 <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"> &nbsp; ASCITIS</td>
              <td style="width: 314px; height: 3px"> 
			  <textarea name="cmd_ascitis" cols="50" rows="3" class="input-normal" > <?php echo $ascitis_w; ?></textarea>
                &nbsp;</td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px"> &nbsp; IMPRESIÓN DIAGNÓSTICA</td>
              <td style="width: 314px; height: 3px"> <textarea name="txt_impresion" cols="40" rows="3" class="input-normal" ><?php echo $impresion_w; ?></textarea> 
                &nbsp;</td>
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
              <td colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg" value="0" /> 
                <div id="Panel1" style="height:50px;width:440px;"> 
                  <div id="Panel2" style="height:50px;width:125px;"> 
                    <table cellpadding="0" cellspacing="0" class="texto11" style="width: 440px">
                      <tr> 
                        <td colspan="3" style="height: 20px"> </td>
                      </tr>
                      <tr> 
                        <td colspan="3" style="height: 7px"> </td>
                      </tr>
                      <tr> 
                        <td style="width: 106px;"> </td>
                        <td style="width: 152px;"> </td>
                        <td> </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <input type="hidden" name="hdCorr" id="hdCorr" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina" value="2" /> 
              </td>
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

<?php
if ($_POST){
 if(isset($_POST["cmd_aceptar"])) 
 {
// if(isset($cmd_aceptar)) { 

	$fecha_w  = $_POST['cmd_fecha'];
	$solicitado_w  = $_POST['cmd_solicitado'];
	$antecedentes_w  = $_POST['cmd_antecedentes'];
	$higado_w  = $_POST['cmd_higado'];
	$vesicula_w  = $_POST['cmd_vesicula'];
	$coledoco_w  = $_POST['cmd_coledoco'];
	$pancreas_w  = $_POST['cmd_pancreas'];
	$rinones_w  = $_POST['cmd_rinones'];
	$bazo_w  = $_POST['cmd_bazo'];
	$vasos_w  = $_POST['cmd_vasos'];
	$ascitis_w  = $_POST['cmd_ascitis'];
	$impresion_w  = $_POST['txt_impresion'];
	$rutmed_w    = $_POST["ddl_medicos"];
/*	$rutmed_w  = $_POST['cmd_rutmed'];
	$nommed_w  = $_POST['cmd_medico'];
*/
	$rutpac_w  = $_POST['cmd_rut'];
	$nompac_w  = $_POST['cmd_nombre'];
	
	//empiezas las validaciones correspondientes por ejemplo

	$error_w = FALSE;
	if (strlen($nompac_w) == 0) { //que ingrese nombre
/*
        echo "<script type=\"text/javascript\">document.getElementById('PacMalo').style.display=''</script>";
*/
		echo  "<script type=\"text/javascript\">
		alert('Debe ingresar Paciente');
		</script>";    

		$error_w = TRUE;

		} 		
	if ($rutmed_w == "0") { //que ingrese nombre
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
	
//		$link = mysql_connect("localhost","root","");
//		mysql_select_db("eco");
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//		mysql_select_db(DB_NAME, $link); 

//		$sql1 = "call ECO_PUPD_PACIENTES('I','".$rut_w."','".$nombre_w."','".$apepat_w."','".$apemat_w."',null,null,null,null,null,null,null,null,null)";
		$sql1 = "call ECO_PUPD_ECOABDOMINAL('".$modo_w."','".$codigo_w."','".$rutpac_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'),";
        $sql1 = $sql1."'".$solicitado_w."','".$antecedentes_w."','".$higado_w."','".$vesicula_w."','".$coledoco_w."',";
        $sql1 = $sql1."'".$pancreas_w."','".$rinones_w."','".$bazo_w."','".$vasos_w."','".$ascitis_w."','".$impresion_w."','".$rutmed_w."',@cod_w)";

		
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

/*
	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";
*/
 }
 
/*  if(isset($cmd_imprimir)) { 
 
		$codigo_w = "";
		$fecha_w = date("d/m/Y");
		$modo_w = "I";
		
		$solicitado_w  = "";
		$antecedentes_w  = "";
		$higado_w  = "De forma, tamano y estructura conservados. Mide  xxx mm en LAAD. Los margenes son lisos. No hay imagenes focales." ;
		$vesicula_w  = "Mide xx cm. de diametro longitudinal. Pared lisa de mm de espesor. No hay imagenes ecogenicas en su interior.";
		$coledoco_w  = "Mide xx mm de diametro (normal). No hay imagenes ecogenicas en su interior.";
		$pancreas_w  = "De forma, tamano y estructura conservados. Sin lesiones focales.";
		$rinones_w  = "De forma, tamano y estructura conservados. Senos  renales normales. Area perirrenal normal. ";
		$bazo_w  = "Mide  xx  mm de dismetro longitudinal (normal). Estructura homogenea.";
		$vasos_w = "Sin alteraciones ecograficas.";
		$ascitis_w = "No hay.";
		$impresion_w = "";
		$_SESSION['rutpac_s'] = "";
		$_SESSION['nompac_s'] = "";
		$_SESSION['nommed_s'] = "";
		$_SESSION['rutmed_s'] = "";
		$_SESSION['especial_s'] = "";
		$nompac_w  = $_SESSION['nompac_s'];
		$rutpac_w  = $_SESSION['rutpac_s'];
		$nommed_w  = $_SESSION['nommed_s'];
		$rutmed_w  = $_SESSION['rutmed_s'];
		$especial_w  = $_SESSION['especial_s'] = "";
			
	
	echo '<script type=\'text/javascript\'>Form1.cmd_codigo.value="'.$codigo_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_nombre.value="'.$nompac_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_rut.value="'.$rutpac_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_fecha.value="'.$fecha_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_solicitado.value="'.$solicitado_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_antecedentes.value="'.$antecedentes_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_higado.value="'.$higado_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_vesicula.value="'.$vesicula_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_coledoco.value="'.$coledoco_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_pancreas.value="'.$pancreas_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_rinones.value="'.$rinones_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_bazo.value="'.$bazo_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_vasos.value="'.$vasos_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_ascitis.value="'.$ascitis_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.txt_impresion.value="'.$impresion_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_rutmed.value="'.$rutmed_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_medico.value="'.$nommed_w.'"</script>';
	echo '<script type=\'text/javascript\'>Form1.cmd_especial.value="'.$especial_w.'"</script>';
 
 }
 */
 } 
?>


</body>
</html>
