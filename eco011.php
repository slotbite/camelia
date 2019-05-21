<?php
// Sistema			: ECO
// Programa			: ECO11.PHP
// Descripcion		: Ingreso Solicitud de Exámen.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 11/11/2010

session_start();

if (!isset($_SESSION["nompac_s"])){ $_SESSION['nompac_s']="";} 
if (!isset($_SESSION["rutpac_s"])){ $_SESSION['rutpac_s']="";} 
if (!isset($_SESSION["nommed_s"])){ $_SESSION['nommed_s']="";} 
if (!isset($_SESSION["rutmed_s"])){ $_SESSION['rutmed_s']="";} 
if (!isset($_SESSION["nommed2_s"])){ $_SESSION['nommed2_s']="";} 
if (!isset($_SESSION["rutmed2_s"])){ $_SESSION['rutmed2_s']="";} 

//if (!isset($_SESSION["especial_s"])){ $_SESSION['especial_s']="";} 
require_once 'admin/config.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Solicitud de Exámen</title>
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

		function Imprimir_Vtna(cod){
	/*-----------------------------------*/
	
		// alert("imprime");
		pant_emp = window.open("","Imprimir","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
		pant_emp.location = "eco008_i.php?CODIGO=" + cod;
			
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
	$_SESSION['nommed2_s'] = "";
    $_SESSION['rutmed2_s'] = "";

//    $_SESSION['especial_s'] = "";

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

if (isset($_POST['cmd_fecha'])){
	$fecha_w  = $_POST['cmd_fecha'];
	}
else{
	$fecha_w  = date("d/m/Y");
	}
	
if (isset($_POST['cmd_medico'])){
	$nommed_w  = $_POST['cmd_medico'];
	}
else{
	$nommed_w  = "";
	}
if (isset($_POST['ddl_medicos']))
{
	$medico_w  = $_POST['ddl_medicos'];
	}
else
{
	$medico_w  = "";
	}

if (isset($_POST['ddl_prevision'])){
	$prevision_w  = $_POST['ddl_prevision'];
	}
else{
	$prevision_w  = "";
	}
if (isset($_POST['ddl_examen'])){
	$examen_w  = $_POST['ddl_examen'];
	}
else{
	$examen_w  = "";
	}
if (isset($_POST['cmd_desfotos'])){
	$desfotos_w  = $_POST['cmd_desfotos'];
	}
else{
	$desfotos_w  = "";
	}
	
if (isset($_POST['cmd_cantbn'])){
	$cantbn_w  = $_POST['cmd_cantbn'];
	}
else{
	$cantbn_w  = "";
	}
if (isset($_POST['cmd_valbn'])){
	$valbn_w  = $_POST['cmd_valbn'];
	}
else{
	$valbn_w  = "";
	}
if (isset($_POST['cmd_cantcol'])){
	$cantcol_w  = $_POST['cmd_cantcol'];
	}
else{
	$cantcol_w  = "";
	}
if (isset($_POST['cmd_valcol'])){
	$valcol_w  = $_POST['cmd_valcol'];
	}
else{
	$valcol_w  = "";
	}

	
if (isset($_POST['cmd_valexamen'])){
	$valexamen_w  = $_POST['cmd_valexamen'];
	}
else{
	$valexamen_w  = "";
	}

$codliq_w = "";
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
	$consulta="call ECO_PSEL_SOLICITUDES('".$_GET["CODIGO"]."',null,null,null,null,null,null,null,null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$fecha_w     = $row["fecha"];
		$prevision_w = $row["cprevision"];
		$examen_w    = $row["cexamen"];
    	$desfotos_w  = $row["vdesfotos"];
		$cantbn_w  = $row["icantbn"];
		$valbn_w   = $row["vvalbn"];
		$cantcol_w  = $row["icantcol"];
		$valcol_w   = $row["vvalcol"];

		$valexamen_w = $row["vtotexamen"];
		$nommed_w = $row["msolicita"];
		$medico_w = $row["rmedefe"];
		$codliq_w =  $row["codliq"];

				
		$_SESSION['rutpac_s'] = $row["rutpaciente"];
		$_SESSION['nompac_s'] = $row["npaciente"]." ".$row["ppaciente"];
//		$_SESSION['nommed_s'] = $row["nmedico"]." ".$row["pmedico"];
		$_SESSION['nommed_s'] = $row["msolicita"];
      	$_SESSION['rutmed_s'] = $row["rmedsol"];
		$_SESSION['nommed2_s'] = $row["enmedico"]." ".$row["epmedico"];
    	$_SESSION['rutmed2_s'] = $row["rmedefe"];

//    	$_SESSION['especial_s'] = $row["nEspecial"];
		
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


//llena ddl prevision

//$db=mysql_connect("localhost","root","");
//mysql_select_db("eco");
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//mysql_select_db(DB_NAME, $link); 


$query="call ECO_PSEL_DESCRIPCIONES(null,'PREVISION','S')";

$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);

$lst_prevision="<select name='ddl_prevision' id='ddl_prevision' class='input-normal'>\n<option value='0' selected>Prevision</option>";


while($registro=mysqli_fetch_array($r))
{    
	   if ($registro[0] == $prevision_w)
	      {
		   $lst_prevision.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_prevision.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		
		   }
}

$lst_prevision.="\n</select>";

mysqli_close($link);

//llena ddl examen

//$db=mysql_connect("localhost","root","");
//mysql_select_db("eco");
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//mysql_select_db(DB_NAME, $link); 

$query="call ECO_PSEL_DESCRIPCIONES(null,'EXAMEN','S')";

$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);

$lst_examen="<select name='ddl_examen' id='ddl_examen' class='input-normal'>\n<option value='0' selected>Exámen</option>";


while($registro=mysqli_fetch_array($r))
{    
	   if ($registro[0] == $examen_w)
	      {
		   $lst_examen.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_examen.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		
		   }
}

$lst_examen.="\n</select>";

mysqli_close($link);

?> 
    <div>
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 5px; position: absolute; top: 6px; height: 398px; width: 585px;" width="510">
      <tr>
                <td width="32" style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18"> SOLICITUD DE EXAMEN</span></td>
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
                <td align="center" height="100" width="553">
                    <table width="512" border="0" align="left" cellpadding="0" cellspacing="0" class="texto11" id="Table2"
                        style="height: 88px; text-align: left;">
            <tr> 
              <td colspan="2" style="width: 381px; height: 14px"> </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Código Solicitud</td>
              <td width="373" style="width: 314px; height: 3px"> <input name="cmd_codigo" type="text" maxlength="40" id="cmd_codigo2" class="input-normal" style="border:1px solid #FFFFFF;color:Red;"  value="<?php echo $codigo_w; ?>" readonly="readonly"/></td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="139" height="25" style="width: 95px; height: 2px"> &nbsp; 
                Nombre Paciente</td>
              <td width="373" style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" class="input-normal" id="cmd_nombre" style="width:220px;"  value="<?php echo $_SESSION['nompac_s']; ?>" size="40" maxlength="40" readOnly="readonly"/> 
                <input name="imgPaciente" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelPaciente()" /> 
                &nbsp; &nbsp; <span id="PacMalo" style="color:Red;font-weight:bold;display:none;">Paciente 
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
                &nbsp; <span id="FecMala" style="color:Red;font-weight:bold;display:none;">Fecha 
                Errónea</span> </td>
            </tr>
            <tr> 
              <td height="16" style="width: 95px; height: 2px">&nbsp;</td>
              <td style="width: 314px; height: 3px">&nbsp;</td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Médico Solicita 
              </td>
              <td style="width: 314px; height: 3px"> <input name="cmd_medico" type="text" maxlength="60" id="cmd_medico" class="input-normal" style="width:220px;" value="<?php echo $nommed_w;?>" />
                &nbsp; <span id="MSolMalo" style="color:Red;font-weight:bold;display:none;">Ingrese 
                Medico Solicita </span></td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Médico Efectúa 
              </td>
              <td style="width: 314px; height: 3px"> 
			  <?php
			  echo $lst_medicos;
			  echo '&nbsp;<span id="MEfeMalo" style="color:Red;font-weight:bold;display:none;">Ingrese Medico Efectúa </span>';
			  ?>
				</td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"></td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Previsión</td>
              <td style="width: 314px; height: 3px"> 
                <?php
			  echo $lst_prevision;
			  echo '&nbsp; <span id="PrevMalo" style="color:Red;font-weight:bold;display:none;">Seleccione Prevision </span>'
  			  ?>
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Exámen</td>
              <td style="width: 314px; height: 3px"> 
                <?php
			  echo $lst_examen;
  			  echo '&nbsp; <span id="ExaMalo" style="color:Red;font-weight:bold;display:none;">Seleccione Exámen 
                </span>'
  			  ?>
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 135px; height: 2px">&nbsp;Fotos B/N 
                Cantidad</td>
              <td style="width: 314px; height: 3px"> 
                <input name="cmd_cantbn" type="text" class="input-normal" id="cmd_cantbn" value="<?php echo $cantbn_w; ?>" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  />
                &nbsp;&nbsp;Valor unit.&nbsp;&nbsp; 
                <input name="cmd_valbn" type="text" class="input-normal" id="cmd_valbn" value="<?php echo $valbn_w; ?>" size="5"  onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  /> 
                &nbsp; 
				</td>
				
            </tr>
			 <tr> 
              <td height="21" style="width: 135px; height: 2px">&nbsp;Fotos Color 
                Cantidad</td>
              <td style="width: 314px; height: 3px"> 
                <input name="cmd_cantcol" type="text" class="input-normal" id="cmd_cantcol" value="<?php echo $cantcol_w; ?>" size="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" />
                &nbsp;&nbsp;Valor unit.&nbsp;&nbsp; 
                <input name="cmd_valcol" type="text" class="input-normal" id="cmd_valcol" value="<?php echo $valcol_w; ?>" size="5" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  /> 
                &nbsp; 
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
              <td style="width: 135px; height: 3px"> &nbsp; Valor Total Del Examen</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_valexamen" type="text" class="input-normal" id="cmd_valexamen"  value="<?php echo $valexamen_w; ?>" size="15"  onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" /> 
                &nbsp; </td>
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
					if ($codliq_w == "")
					{
                    echo '<td align="center"> <input type="submit" name="cmd_aceptar" value="Grabar" id="cmd_aceptar" class="boton" /></td>';
					}
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
// if(isset($cmd_aceptar))
 if(isset($_POST["cmd_aceptar"]))
  { 
	$rutpac_w    = $_POST['cmd_rut'];
	$nompac_w    = $_POST['cmd_nombre'];
	$fecha_w     = $_POST['cmd_fecha'];
//	$rutmed_w    = $_POST['cmd_rutmed'];
    $rutmed_w    = "";
	$nommed_w    = $_POST['cmd_medico'];
	
	$rutmed2_w    = $_POST["ddl_medicos"];
//	$rutmed2_w   = $_POST['cmd_rutmed2'];
//	$nommed2_w   = $_POST['cmd_medico2'];
	$prevision_w = $_POST["ddl_prevision"];
	$examen_w    = $_POST["ddl_examen"];
//	$desfotos_w  = $_POST['cmd_desfotos'];
	$cantbn_w  = $_POST['cmd_cantbn'];
	$valbn_w  = $_POST['cmd_valbn'];
	$cantcoo_w  = $_POST['cmd_cantcol'];
	$valcol_w  = $_POST['cmd_valcol'];
	$valexamen_w = $_POST['cmd_valexamen'];
	
	//empiezas las validaciones correspondientes 

	$error_w = FALSE;
	if (strlen($nompac_w) == 0) { //que ingrese nombre
        echo "<script type=\"text/javascript\">document.getElementById('PacMalo').style.display=''</script>";
/*
		echo  "<script type=\"text/javascript\">
		alert('Debe ingresar Paciente');
		</script>";    
*/
		$error_w = TRUE;
		}
		 		
	if (strlen($nommed_w) == 0) { //que ingrese nombre
	   echo "<script type=\"text/javascript\">document.getElementById('MSolMalo').style.display=''</script>";
		$error_w = TRUE;
		} 	
		
	if ($rutmed2_w == "0") { //que ingrese médico efectúa
	   echo "<script type=\"text/javascript\">document.getElementById('MEfeMalo').style.display=''</script>";

		$error_w = TRUE;
		} 	
		
	if (strlen($fecha_w) < 10) { //que ingrese fecha
	
        echo "<script type=\"text/javascript\">document.getElementById('FecMala').style.display=''</script>";
		$error_w = TRUE;
		} 		
	
	if ($prevision_w == "0") { //que ingrese pevision
	
        echo "<script type=\"text/javascript\">document.getElementById('PrevMalo').style.display=''</script>";
		$error_w = TRUE;
		} 		
	if ($examen_w == "0") { //que ingrese examen
	
        echo "<script type=\"text/javascript\">document.getElementById('ExaMalo').style.display=''</script>";
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
		$sql1 = "call ECO_PUPD_SOLICITUDES('".$modo_w."','".$codigo_w."','".$rutpac_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'),";
        $sql1 = $sql1."'".$rutmed_w."','".$rutmed2_w."','".$prevision_w."','".$examen_w."','".$cantbn_w."','".$valbn_w."','".$cantcol_w."','".$valcol_w."','".$desfotos_w."',";
        $sql1 = $sql1."'".$valexamen_w."','".$nommed_w."',@cod_w)";
		
// echo $sql1;
// exit();
        $query = mysqli_query($link,$sql1);
		if ( !$query ) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
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
				alert('La Solicitud ha sido registrado de manera satisfactoria.');
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
/*		
			echo '<script type=\'text/javascript\'>Form1.cmd_codigo.value="'.$codigo_w.'"</script>';
			
			echo "<script>opener.document.Form1.submit();</script>";
  	 		echo "<script type=\"text/javascript\"> window.close(); </script>";
*/

		   }//cierras todos los else que abras
      }      


	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";

 }
} 
?>


</body>
</html>
