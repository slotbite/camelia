<?php
// Sistema			: ECO
// Programa			: ECO007.PHP
// Descripcion		: Agrega médicos al sistema.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 03/11/2010

session_start();

require_once 'admin/config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Ingreso de Pacientes</title>
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

		</script>
</head>
<?php
$rut_w = $_GET["RUT"];
//echo $rut_w;
?>

<body>
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">
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
$_SESSION['rut_s'] = $rut_w ;

if (isset($_POST['cmd_nombre']))
{
	$nombre_w  = $_POST['cmd_nombre'];
	}
else
{
	$nombre_w  = "";
	}

if (isset($_POST['cmd_apellido1']))
{
	$apepat_w  = $_POST['cmd_apellido1'];
	}
else
{
	$apepat_w  = "";
	}

if (isset($_POST['cmd_apellido2']))
{
	$apemat_w  = $_POST['cmd_apellido2'];
	}
else
{
	$apemat_w  = "";
	}


if (isset($_POST['cmd_habilita']))
{
	$habilitado_w  = $_POST['cmd_habilita'];
	}
else
{
	$habilitado_w  = "S";
	}


if (isset($_POST['ddl_especial']))
{
	$especial_w  = $_POST['ddl_especial'];
	}
else
{
	$especial_w  = "";
	}

$modo_w = "I";

if ($_POST) {
    $_SESSION['rut_s'] = $_POST['cmd_rut'];
}

if ($_GET["RUT"] > 0)
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
	$consulta="call ECO_PSEL_MEDICOS(null,null,'".$rut_w."')";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$nombre_w = $row["nombre"];
		$apepat_w = $row["apaterno"];
		$apemat_w = $row["amaterno"];
		$habilitado_w   = $row["habilitado"];
		$especial_w = $row["cespecial"];

		}
	mysqli_free_result($result);
	mysqli_close($link);
	}
}

//llena ddl comunas

//$db=mysql_connect("localhost","root","");
//mysql_select_db("eco");
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//mysql_select_db(DB_NAME, $link); 

$query="call ECO_PSEL_DESCRIPCIONES(null,'ESPECIAL','S')";

$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);

$lst_especial="<select name='ddl_especial' id='ddl_especial' class='input-normal'>\n<option value='0' selected>Especialidad</option>";


while($registro=mysqli_fetch_array($r))
{    
	   if ($registro[0] == $especial_w)
	      {
		   $lst_especial.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_especial.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		
		   }
}

$lst_especial.="\n</select>";

mysqli_close($link);

?> 
<script type="text/javascript">

var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}

</script>

    <div>
        
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 1px; position: absolute; top: 2px; height: 300px; width: 606px;" >
      <tr>
                <td width="39" style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                <td style="height: 24px" valign="bottom">
                    <span id="Label1" class="texto18"> MEDICOS</span></td>
            </tr>
            <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 5px">
                </td>
                <td style="background-image: url(ivvpp0005.jpg); height: 20px">
                </td>
            </tr>
          <tr>
                
        <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 5px"> 
        </td>
                
        <td align="top" width="584"> <table width="484" height="175" border="0" cellpadding="0" cellspacing="0" class="texto11" id="Table2"
                        style="text-align: left;">
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="5" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td width="100" style="width: 95px; height: 18px"> &nbsp; <span id="Lb_identificador" style="display:inline-block;width:83px;">Rut</span></td>
              <?php 
			
			 if (strlen(trim($rut_w)) == 0)
			 {
			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="'.$_SESSION["rut_s"].'" /> ';
			  }
			 else
			   { 
			//   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="'.$rut_w.'" readOnly="readonly"/> ';
 			   echo '<td width="365" style="width: 314px; height: 18px"> <input name="cmd_rut" type="text" maxlength="10" id="cmd_rut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="'.$_SESSION["rut_s"].'" readOnly="readonly"/> ';
  
              }
			  echo '<span id="RutMalo" style="color:Red;display:none;">* Rut inválido</span> </td>';

              ?>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td height="22" style="width: 95px; height: 2px"> &nbsp; Nombre</td>
              <td width="424" style="width: 314px; height: 3px"> <input name="cmd_nombre" type="text" maxlength="40" id="cmd_nombre" class="input-normal" style="width:176px;"  value="<?php echo $nombre_w; ?>"/> 
                &nbsp; <span id="NombreMalo" style="color:Red;display:none;">* 
                Nombre inválido</span> </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td height="21" style="width: 95px; height: 2px">&nbsp; Apellido 
                Paterno</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_apellido1" type="text" maxlength="40" id="cmd_apellido1" class="input-normal" style="width:176px;" value="<?php echo $apepat_w; ?>"/> 
                &nbsp; <span id="ApeMalo" style="color:Red;display:none;">* Ap.Paterno 
                inválido</span> </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Apellido Materno</td>
              <td style="width: 314px; height: 3px"> <input name="cmd_apellido2" type="text" maxlength="40" id="cmd_apellido2" class="input-normal" style="width:176px;" value="<?php echo $apemat_w; ?>" /> 
                &nbsp; </td>
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
              <td style="width: 95px; height: 3px"> &nbsp; Especialidad</td>
              <td style="width: 314px; height: 3px"> 
                <?php
			  echo $lst_especial;
  			  echo '&nbsp; <span id="EspMalo" style="color:Red;font-weight:bold;display:none;">Seleccione Especialidad 
                </span>'
  			  ?>
              </td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 2px"> &nbsp; Habilitado</td>
              <?php
				   echo'<td style="width: 314px; height: 3px"> <select name="cmd_habilita" id="cmd_habilita" class="texto01">';

				  if ( $habilitado_w == "S" )
				  {
					echo "\n<option selected='selected' value='S'>SI</option>";
				   	echo "\n<option value='N'>NO</option>";
				   }
				  else
				  { 
				  	echo "\n<option value='S'>SI</option>";
				   	echo "\n<option selected='selected'value='N'>NO</option>";
				   }
				  
				  echo "\n</select></td>";
				?>
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
              <td background="ivvpp0003.jpg" colspan="2" style="width: 381px; height: 2px;"> 
              </td>
            </tr>
            <tr> 
              <td colspan="2"> <input type="hidden" name="hdCantReg" id="hdCantReg" value="0" /> 
                <input type="hidden" name="hdCorr" id="hdCorr" value="1" /> <input type="hidden" name="hdPagina" id="hdPagina" value="2" /> 
              </td>
            </tr>
          </table>
          <table id="Table3" align="center" border="0" cellpadding="1" cellspacing="1"
                        style="width: 310px; height: 8px; background-color: whitesmoke;" width="310">
                        <tr>
                            <td align="center" style="width: 126px">
                                <input type="submit" name="cmd_atras" value="Atras" id="cmd_atras" class="boton" style="width:70px;" /></td>
                            <td style="width: 45px">
                            </td>
                            <td align="center">
			             <input type="submit" name="cmd_aceptar" value="Aceptar" id="cmd_aceptar" class="boton" /></td>

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

<div>
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
</div>
</form>

<?php
if ($_POST) {
 if(isset($_POST["cmd_aceptar"])) { 
//echo "grabar";

//	if (isset($_POST["cmd_rut"])){//1
	$rut_w    = $_POST["cmd_rut"];
	$nombre_w = $_POST["cmd_nombre"];
	$apepat_w = $_POST["cmd_apellido1"];
	$apemat_w = $_POST["cmd_apellido2"];
	$habilitado_w   = $_POST["cmd_habilita"];
	$especial_w    = $_POST["ddl_especial"];

	//empiezas las validaciones correspondientes por ejemplo
	$error_w = FALSE;
	if (strlen($rut_w) < "3") { //que el nombre sea mayor a 3
		   echo "<script type=\"text/javascript\">document.getElementById('RutMalo').style.display=''</script>";
/*		ahora dentro del echo pongo un alert que lo q hace es q si sucede q el nombre sea menor a tres manda un mensaje que te permite visualizarlo sin salir de la pagina
		echo  "<script type=\"text/javascript\">
		alert('El campo Nombre debe tener al menos 3 caracteres');
		</script>";    
*/
		 exit();
		}
	if (strlen($nombre_w) == 0) { //que ingrese nombre
        echo "<script type=\"text/javascript\">document.getElementById('NombreMalo').style.display=''</script>";
		$error_w = TRUE;

		} 		
    if (strlen($apepat_w) == 0) { //que ingrese nombre
		   echo "<script type=\"text/javascript\">document.getElementById('ApeMalo').style.display=''</script>";
		$error_w = TRUE;

		} 		
		
	if ($especial_w == "0") { //que ingrese especialidad
	
        echo "<script type=\"text/javascript\">document.getElementById('EspMalo').style.display=''</script>";
		$error_w = TRUE;
		} 		

/*
	else{
	
	//mas validaciones
*/
    if ( $error_w )	
	  {
	   exit();
	  }

	else{//el ultimo else tiene que se el de tu insert into
	
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

		$sql1 = "call ECO_PUPD_MEDICOS('".$modo_w."','".$rut_w."','".$nombre_w."','".$apepat_w."','".$apemat_w."','".$especial_w."','".$habilitado_w."')";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error();
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El médico ya existe....." ;
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
				alert('El Médico: \' $rut_w \' ha sido registrado de manera satisfactoria.');
				</script>";
			mysqli_close($link);
			}	
  		

	   }//cierras todos los else que abras

	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";

 }
}
?>

</body>
</html>
