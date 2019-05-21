<?php
// Sistema			: ECO
// Programa			: ECO043.PHP
// Descripcion		: Ingreso Exámen Test de Esfuerzo.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 30/12/2010

session_start();

if (!isset($_SESSION["nompac_s"])){ $_SESSION['nompac_s']="";} 
if (!isset($_SESSION["rutpac_s"])){ $_SESSION['rutpac_s']="";} 
if (!isset($_SESSION["nommed_s"])){ $_SESSION['nommed_s']="";} 
if (!isset($_SESSION["rutmed_s"])){ $_SESSION['rutmed_s']="";} 
if (!isset($_SESSION["especial_s"])){ $_SESSION['especial_s']="";} 

require_once 'admin/config.php';
// Include CKEditor class.
include_once "ckeditor/ckeditor.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Test de Esfuerzo</title>
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
        window.open('eco_autoriza.php?PAGINA=' + 'eco043_i.php?CODIGO=' + cod,'eco043_i','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			
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

if (isset($_POST['cmd_diagnostico'])){
	$diagnostico_w  = $_POST['cmd_diagnostico'];
	}
else{
	$diagnostico_w  = "";
	}
if (isset($_POST['cmd_solicitado'])){
	$solicitado_w  = $_POST['cmd_solicitado'];
	}
else{
	$solicitado_w  = "";
	}


if (isset($_POST['cmd_duracion'])){
	$duracion_w  = $_POST['cmd_duracion'];
	}
else{
	$duracion_w  = "";
	}
	
if (isset($_POST['cmd_desnivel'])){
	$desnivel_w  = $_POST['cmd_desnivel'];
	}
else{
	$desnivel_w  = "";
	}
if (isset($_POST['cmd_angina'])){
	$angina_w  = $_POST['cmd_angina'];
	}
else{
	$angina_w  = "";
	}
if (isset($_POST['cmd_disnea'])){
	$disnea_w  = $_POST['cmd_disnea'];
	}
else{
	$disnea_w  = "";
	}
if (isset($_POST['cmd_arrventric'])){
	$arrventric_w  = $_POST['cmd_arrventric'];
	}
else{
	$arrventric_w  = "";
	}
if (isset($_POST['cmd_arrauric'])){
	$arrauric_w  = $_POST['cmd_arrauric'];
	}
else{
	$arrauric_w  = "";
	}
if (isset($_POST['cmd_procedencia'])){
	$procedencia_w  = $_POST['cmd_procedencia'];
	}
else{
	$procedencia_w  = "";
	}
if (isset($_POST['cmd_protocolo'])){
	$protocolo_w  = $_POST['cmd_protocolo'];
	}
else{
	$protocolo_w  = "";
	}
if (isset($_POST['cmd_fcbasal'])){
	$fcbasal_w  = $_POST['cmd_fcbasal'];
	}
else{
	$fcbasal_w  = "";
	}
if (isset($_POST['cmd_fcmax'])){
	$fcmax_w  = $_POST['cmd_fcmax'];
	}
else{
	$fcmax_w  = "";
	}
if (isset($_POST['cmd_fcejerc'])){
	$fcejerc_w  = $_POST['cmd_fcejerc'];
	}
else{
	$fcejerc_w  = "";
	}
if (isset($_POST['cmd_pabasal'])){
	$pabasal_w  = $_POST['cmd_pabasal'];
	}
else{
	$pabasal_w  = "";
	}
if (isset($_POST['cmd_paejerc'])){
	$paejerc_w  = $_POST['cmd_paejerc'];
	}
else{
	$paejerc_w  = "";
	}
if (isset($_POST['cmd_papost'])){
	$papost_w  = $_POST['cmd_papost'];
	}
else{
	$papost_w  = "";
	}

if (isset($_POST['txt_conclusion'])){
	$conclusion_w  = trim($_POST['txt_conclusion']);
	}
else{
	$conclusion_w = "";
	}
	
if (isset($_POST['editor1'])){
	$detalle_w  = $_POST['editor1'];
	}
else{
	$detalle_w = nl2br("
<u><strong>HISTORIA</strong></u>

<u><strong>ECG de Reposo</strong></u>

<u><strong>Descripción</strong></u>

La            se ejercitó en treadmill según protocolo de Bruce durante minutos segundos
alcanzando el          % de la frecuencia cardiaca máxima para la edad.  No presentó
síntomas  ni alteraciones de la repolarización ventricular.

<u><strong>CONCLUSIÓN:</strong></u>

•	Respuesta presora.      
•	Test Ergométrico                                     para isquemia miocárdica.
•	                     capacidad aeróbica de ejercicio   Mets.
");

	
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
	$consulta="call ECO_PSEL_EXAMENES('".$_GET["CODIGO"]."',null,null,null,null,null,'1')";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
	
		$fecha_w  		= $row["fecha"];
		$diagnostico_w 	= $row["tantecedentes"];
		$detalle_w  	= html_entity_decode( $row["tdetalle"] );
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
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 16px; position: absolute; top: 6px; height: 498px; width: 623px;" >
      <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                
        <td style="height: 24px" valign="bottom"> <span id="Label1" class="texto18"> 
          TEST DE ESFUERZO</span></td>
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
              <td width="365" style="width: 314px; height: 3px">
			  <input name="cmd_codigo" type="text" maxlength="40" id="cmd_codigo2" class="input-normal" style="border:1px solid #FFFFFF;color:Red;"  value="<?php echo $codigo_w; ?>" readonly="readonly"/></td>
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
			<!--
			<tr> 
              <td style="width: 95px; height: 18px">&nbsp; Diagnóstico</td>
              <td style="width: 314px; height: 18px"> <input name="cmd_diagnostico" type="text" maxlength="50" id="cmd_diagnostico" class="input-normal" value="<?php echo $diagnostico_w; ?>"/> 
                &nbsp; </td>
            </tr>
			-->
            <tr> 
              <td height="16" style="width: 95px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 3px">&nbsp;</td>
            </tr>
			</table>
			<!--
          <table width="564" border="1" cellspacing="0" cellpadding="0" class="texto11">
            
            <tr> 
              <td width="201" align="left">Duración Exámen:</td>
              <td width="26" style="width: 14px; height: 18px"><input name="cmd_duracion" type="text" class="input-normal" id="cmd_duracion" value="<?php echo $duracion_w; ?>" size="5" maxlength="6" /></td>
              <td width="90">min;seg</td>
              <td width="165" align="left">Frecc.Cardíaca Basal :</td>
              <td width="26" style="width: 14px; height: 18px"><input name="cmd_fcbasal" type="text" class="input-normal" id="cmd_fcbasal" value="<?php echo $fcbasal_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td width="201" align="left">Desnivel ST:</td>
              <td style="width: 14px; height: 18px"><input name="cmd_desnivel" type="text" class="input-normal" id="cmd_desnivel" value="<?php echo $desnivel_w; ?>" size="5" maxlength="6" /></td>
              <td width="90">&nbsp;</td>
              <td width="165" align="left">85% Fec.Card.Max :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_fcmax" type="text" class="input-normal" id="cmd_fcmax" value="<?php echo $fcmax_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td width="201" align="left">Angina :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_angina" type="text" class="input-normal" id="cmd_angina" value="<?php echo $angina_w; ?>" size="5" maxlength="6" /></td>
			  <td width="90">&nbsp;</td>
              <td width="165" align="left">Frec.Cardiaca Ejerc.:</td>
              <td style="width: 14px; height: 18px"><input name="cmd_fcejerc" type="text" class="input-normal" id="cmd_fcejerc" value="<?php echo $fcejerc_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td width="201" align="left">Disnea :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_disnea" type="text" class="input-normal" id="cmd_disnea" value="<?php echo $disnea_w; ?>" size="5" maxlength="6" /></td>
              <td width="90">&nbsp;</td>
              <td width="165" align="left">Presión Art.Basal :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_pabasal" type="text" class="input-normal" id="cmd_pabasal" value="<?php echo $pabasal_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td height="16" colspan="3" style="width: 115px; height: 2px">&nbsp;</td>
             
			  <td width="165" align="left">Presión Arte.Ejerc. :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_paejerc" type="text" class="input-normal" id="cmd_paejerc" value="<?php echo $paejerc_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
               </tr>
            <tr> 
              <td width="201" align="left">Arr. Ventricular :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_arrventric" type="text" class="input-normal" id="cmd_arrventric" value="<?php echo $arrventric_w; ?>" size="5" maxlength="6" /></td>
              <td width="90">&nbsp;</td>
              <td width="165" align="left">P.Art.3 Min.Post.:</td>
              <td style="width: 14px; height: 18px"><input name="cmd_papost" type="text" class="input-normal" id="cmd_papost" value="<?php echo $papost_w; ?>" size="5" maxlength="6" /></td>
              <td width="42">&nbsp;</td>
            </tr>
            <tr> 
              <td width="201" align="left">Arr. Auricular :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_arrauric" type="text" class="input-normal" id="cmd_arrauric" value="<?php echo $arrauric_w; ?>" size="5" maxlength="6" /></td>
              <td  colspan="4">&nbsp;</td>
              
            </tr>
            <tr> 
              <td width="201" align="left">Procedencia :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_procedencia" type="text" class="input-normal" id="cmd_procedencia" value="<?php echo $procedencia_w; ?>" size="5" maxlength="6" /></td>
              <td  colspan="4">&nbsp;</td>
              
            </tr>
            <tr> 
              <td width="201" align="left">Protocolo :</td>
              <td style="width: 14px; height: 18px"><input name="cmd_protocolo" type="text" class="input-normal" id="cmd_protocolo" value="<?php echo $protocolo_w; ?>" size="5" maxlength="6" /></td>
              <td  colspan="4">&nbsp;</td>
              
            </tr>
            <tr> 
              <td colspan="6">&nbsp;</td>
            </tr>
          </table>
		  -->
          <table id="Table3" align="center" border="0" cellpadding="0" cellspacing="0" class="texto11"
                        style="height: 88px; text-align: left;" width="712">
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            
			 
			<tr> 
              <td colspan="2" style="width: 700px; height: 3px"> 
			  	<label for="editor1"></label><br/>
				</label><br/>
				<?php
				// The initial value to be displayed in the editor.
				$initialValue = $detalle_w;
/*
				$initialValue = nl2br("
<u><strong>HISTORIA</strong></u>

<u><strong>ECG de Reposo</strong></u>

<u><strong>Descripción</strong></u>

La            se ejercitó en treadmill según protocolo de Bruce durante minutos segundos
alcanzando el          % de la frecuencia cardiaca máxima para la edad.  No presentó
síntomas  ni alteraciones de la repolarización ventricular.

<u><strong>CONCLUSIÓN:</strong></u>

•	Respuesta presora.      
•	Test Ergométrico                                     para isquemia miocárdica.
•	                     capacidad aeróbica de ejercicio   Mets.
");

*/

                if (isset($_POST['editor1'])) 
				{
				$initialValue = $_POST['editor1'];
				}
				// Create class instance.
				$CKEditor = new CKEditor();
				// Path to CKEditor directory, ideally instead of relative dir, use an absolute path:
				//   $CKEditor->basePath = '/ckeditor/'
				// If not set, CKEditor will try to detect the correct path.
				$CKEditor->basePath = 'ckeditor/';
				// Create textarea element and attach CKEditor to it.
				
	//			$CKEditor->editor("editor1", $initialValue);
		 		$config = array();
				$config['toolbar'] = array(
				  array( 'Format', 'Font','FontSize' ),
				  array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ),
				  array( 'NumberedList', 'BulletedList','-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Undo','Redo')
				  );
				$config['format_tags'] = 'div;p;h1;h2;h3;h4;h5;h6;pre;address' ;
				$config['enterMode'] = 3;
				$config['forceEnterMode'] = true;
  				$CKEditor->editor("editor1", $initialValue, $config);
				?>

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
			              
                            
              <td align="center"> <input type="submit" name="cmd_aceptar" value="Grabar" id="cmd_aceptar" class="boton" /></td>

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
	$duracion_w  = $_POST['cmd_duracion'];
	$desnivel_w  = $_POST['cmd_desnivel'];
	$angina_w  = $_POST['cmd_angina'];
	$disnea_w  = $_POST['cmd_disnea'];
	$arrventric_w  = $_POST['cmd_arrventric'];
	$arrauric_w  = $_POST['cmd_arrauric'];
	$procedencia_w  = $_POST['cmd_procedencia'];
	$protocolo_w  = $_POST['cmd_protocolo'];
	$fcbasal_w  = $_POST['cmd_fcbasal'];
	$fcmax_w  = $_POST['cmd_fcmax'];
	$fcejerc_w  = $_POST['cmd_fcejerc'];
	$pabasal_w  = $_POST['cmd_pabasal'];
	$paejerc_w  = $_POST['cmd_paejerc'];
	$papost_w  = $_POST['cmd_papost'];
//	$conclusion_w  = trim($_POST['txt_conclusion']);
	$detalle_w  = $_POST['editor1'];
	if ( get_magic_quotes_gpc() )
		$detalle_w = htmlspecialchars( stripslashes( $detalle_w ) ) ;
	else
		$detalle_w = htmlspecialchars( $detalle_w ) ;

	
	$rutmed_w    = $_POST["ddl_medicos"];
	$rutpac_w  = $_POST['cmd_rut'];
	$nompac_w  = $_POST['cmd_nombre'];

	
	//empiezas las validaciones correspondientes por ejemplo

	$error_w = FALSE;
	if (strlen($nompac_w) == 0) { //que ingrese paciente
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
		echo  "<script type=\"text/javascript\">
		alert('Debe ingresar Fecha Correcta');
		</script>";    

		$error_w = TRUE;
		} 		
	
    if ( $error_w )	
	  {
	   exit();
	  }
	else{//el ultimo else tiene que se el de tu insert into
	
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

		$sql1 = "call ECO_PUPD_EXAMEN_STD('".$modo_w."','".$codigo_w."','".$rutpac_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'),";
        $sql1 = $sql1."'".$solicitado_w."','".$diagnostico_w."','".$detalle_w."','".$rutmed_w."',@cod_w)";


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
