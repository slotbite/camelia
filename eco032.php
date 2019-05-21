<?php
// Sistema			: ECO
// Programa			: ECO032.PHP
// Descripcion		: Ingreso Exámen EcoDoppler Extremidad Superior.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 13/12/2010

session_start();

if (!isset($_SESSION["nompac_s"])){ $_SESSION['nompac_s']="";} 
if (!isset($_SESSION["rutpac_s"])){ $_SESSION['rutpac_s']="";} 
if (!isset($_SESSION["nommed_s"])){ $_SESSION['nommed_s']="";} 
if (!isset($_SESSION["rutmed_s"])){ $_SESSION['rutmed_s']="";} 
if (!isset($_SESSION["especial_s"])){ $_SESSION['especial_s']="";} 

require_once 'admin/config.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>EcoDoppler Exremdad Superior</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
    <script language="javascript" type ="text/javascript" >
	
	function fabre_ventana(iparamt,icoord){
	/*---------------------------*/
		pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
		pant_emp.location = iparamt
			}
			
        function f_SelPaciente(){
        /*-----------------------------------*/
		  
 //         window.open('eco_autoriza.php?PAGINA=' + 'eco002.php' ,'Paciente','width=650, height=550, status=yes, resizable=no , menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
            window.open('eco_autoriza.php?PAGINA=' + 'pacientes2.html' ,'Paciente','width=650, height=550, status=no, resizable=no , menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();

			       }
				   
	   function f_SelMedico(){
	   /*-----------------------------------*/
		 
         window.open('eco_autoriza.php?PAGINA=' + 'eco006.php','Medico','width=650, height=550, status=yes, resizable=no , menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();

			 }

		function Imprimir_Vtna(cod){
	/*-----------------------------------*/
	
        window.open('eco_autoriza.php?PAGINA=' + 'eco032_i.php?CODIGO=' + cod,'eco032_i','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			
		 }

		</script>
</head>
<?php
if (!$_POST and empty($_GET["CODIGO"]) ){
	
//echo 'pase';

    $_SESSION['rutpac_s'] = "";
	$_SESSION['nompac_s'] = "";
	$_SESSION['nommed_s'] = "";
    $_SESSION['rutmed_s'] = "";
    $_SESSION['especial_s'] = "";
		  
}

if (!empty( $_GET["CODIGO"] ) ) {
   $codigo_w = $_GET["CODIGO"];   
}
else{
  $codigo_w = "";
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

if (isset($_POST['cmd_antecedentes'])){
	$antecedentes_w  = $_POST['cmd_antecedentes'];
	}
else{
	$antecedentes_w  = "años.";
	}
if (isset($_POST['txt_detalle'])){
	$detalle_w  = trim($_POST['txt_detalle']);
	}
else{
	$detalle_w  = "	Se utiliza una sonda doppler color lineal de 7.5 Mhz, de alta capacidad de resolución.  Se examina en forma continua FAV distal del antebrazo y se toma fotos B/N y color sólo en algunos sitios de interés.
	Se observa la arteria radial de calibre dilatado, permeable en el doppler color y con curvas de doppler y velocidades normales. Se encuentra la FAV radio cefálica parcialmente obstruida por trombo en zona aneurismática venosa. La vena cefálica se aprecia permeable, compresible y de calibre muy amplio en el antebrazo y codo.
";
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
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_ECODOPEXTSUPERIOR('".$_GET["CODIGO"]."',null,null,null,null,null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$fecha_w    	= $row["fecha"];
		$antecedentes_w = $row["tantecedentes"];
		$detalle_w   	= $row["tdetalle"];
		$conclusion_w 	= $row["tconclusion"];
		$medico_w 		= $row["rutmedico"];
    	
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

//echo $modo_w;
?> 

    <div>
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 16px; position: absolute; top: 6px; height: 498px; width: 623px;" width="510">
      <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                
        <td style="height: 24px" valign="bottom"> <span id="Label1" class="texto18"> 
          ECODOPPLER COLOR EXTREMIDAD SUPERIOR</span></td>
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
                     
            <tr> 
              <td style="width: 105px; height: 2px">DETALLE EXAMEN</td>
              <td style="width: 414px; height: 3px"> 
			  <textarea name="txt_detalle" cols="80" rows="20" class="input-normal" ><?php echo $detalle_w; ?></textarea>
                </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 105px; height: 2px">CONCLUSION</td>
              <td style="width: 314px; height: 3px"> <textarea name="txt_conclusion" cols="60" rows="4" class="input-normal" ><?php echo $conclusion_w; ?></textarea>
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
                     </table>
                    <table id="Table3" align="center" border="0" cellpadding="1" cellspacing="1"
                        style="width: 310px; height: 8px; background-color: whitesmoke;" width="310">
                        <tr>
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
	$fecha_w   = $_POST['cmd_fecha'];
	$antecedentes_w  = $_POST['cmd_antecedentes'];
	$detalle_w  = $_POST['txt_detalle'];
	$conclusion_w  = $_POST['txt_conclusion'];
	$rutmed_w  = $_POST["ddl_medicos"];
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
	
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

//		$sql1 = "call ECO_PUPD_PACIENTES('I','".$rut_w."','".$nombre_w."','".$apepat_w."','".$apemat_w."',null,null,null,null,null,null,null,null,null)";
		$sql1 = "call ECO_PUPD_ECODOPEXTSUPERIOR('".$modo_w."','".$codigo_w."','".$rutpac_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'),";
        $sql1 = $sql1."'".$antecedentes_w."','".$detalle_w."','".$conclusion_w."','".$rutmed_w."',@cod_w)";

		
 //echo $sql1;
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
			$_GET["CODIGO"] = $codigo_w;
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
