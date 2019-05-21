<?php
// Sistema			: ECO
// Programa			: ECO005.PHP
// Descripcion		: Agrega / Modifica datos de usuarios del sistema.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 22/10/2010
?>

<!--
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Mantenedor usuarios</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script language="javascript" type ="text/javascript" >
	
	function vRut(){
   	/*----------------------------------*/

		var variable = Form1.txtRut.value.substr(0,Form1.txtRut.value.indexOf("-"));
		var digit = Form1.txtRut.value.substr(Form1.txtRut.value.indexOf("-")+1).toUpperCase();
					
		if ( validaRut(variable,digit) == false )
			  { alert("Rut Invalido") 
			
			} 					
		}
	
	function valEmail(){
	/*----------------------------------*/
		var valor = Form1.txtEmail.value;
		re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
		if(!re.exec(valor))    {
			alert("La dirección de correo no es correcta");
			return false;
		}
		else{
			return true;
			}
		}

	function valPass(){
	/*----------------------------------*/
		//var valor = trim(Form1.txtpass.value);
		var valor = Form1.txtpass.value;
					
		if( valor.length == 0 )  {
			alert("Debe ingresar una password");
			return false;
		}
		else{
			return true;
			}
		}
		
		function valRePass(){
	/*----------------------------------*/
		//var valor = trim(Form1.txtpass.value);
		var valor1 = Form1.txtpass.value;
		var valor2 = Form1.txtpass2.value;

		if( valor2 != valor1 )  {
			alert("La password no coincide");
			return false;
		}
		else{
			return true;
			}
		}
		function trim(myString)
		/*----------------------------------*/
		{
		return myString.replace(/^\s+/g,'').replace(/\s+$/g,'');
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

require_once 'admin/config.php';

$usuario_w = $_GET["USUARIO"];

?>

<body>
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">

<?php

$rut_w = "";
$nombre_w = "";
$paterno_w = "";
$materno_w = "";
$email_w = "";
$password_w = "";
$repassword_w = "";
$finicio_w = date("d/m/Y");
$habilitado_w = "";
$tipo_w = "";
$opc_w = 'I';

//	$usuario_w = $_POST["txtUsuario"];
if ( !empty($_POST['txtRut']) ) $rut_w = $_POST['txtRut'];
if ( !empty($_POST['txtNombre']) ) $nombre_w = $_POST['txtNombre'];
if ( !empty($_POST['txtPaterno']) ) $paterno_w = $_POST['txtPaterno'];
if ( !empty($_POST['txtMaterno']) ) $materno_w = $_POST['txtMaterno'];
if ( !empty($_POST['txtEmail']) ) $email_w = $_POST['txtEmail'];
if ( !empty($_POST['txtpass']) ) $password_w = $_POST['txtpass'];
if ( !empty($_POST['txtpass2']) ) $repassword_w = $_POST['txtpass2'];
if ( !empty($_POST['TB_inicio']) ) $finicio_w = $_POST['TB_inicio'];
if ( !empty($_POST['cmbElegir']) ) $habilitado_w = $_POST['cmbElegir'];
if ( !empty($_POST['cmbUsuario']) ) $tipo_w = $_POST['cmbUsuario'];
if ( !empty($_POST['txtUsuario']) ) $usuario_w = $_POST['txtUsuario'];


if (strlen(trim($_GET["USUARIO"])) > 0)
{
	$opc_w = 'M';
	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// 	mysql_select_db(DB_NAME, $link); 

	
	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_USUARIOS('".$usuario_w."')";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$rut_w = $row["rut"];
		$nombre_w = $row["nombres"];
		$paterno_w = $row["paterno"];
		$materno_w = $row["materno"];
		$email_w = $row["email"];
		}
	mysqli_free_result($result);
	mysqli_close($link);
	
	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//	mysql_select_db(DB_NAME, $link); 

	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_USUARIO_SISTEMA('ECO','".$usuario_w."')";
	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$password_w = trim($row["password"]);
		$repassword_w = trim($row["password"]);
		$finicio_w = $row["fecha_pass"];
		$habilitado_w = $row["habilitado"];
		$tipo_w = $row["tipo"];
		}
		
	mysqli_free_result($result);
	mysqli_close($link);
	
}

?> 
    
  <div>
    <table width="484" border="0" cellpadding="0" cellspacing="0" style="width: 444px; height: 261px;">
      <tr> 
        <td width="473" valign="bottom" style="height: 25px; width: 173px;"> <span id="lblTit" class="texto18" style="display:inline-block;width:436px;">DATOS 
          USUARIO</span></td>
      </tr>
      <tr> 
        <td style="background-image: url(ieco/isase473.jpg); width: 173px; height: 18px;">&nbsp; 
        </td>
      </tr>
      <tr> 
        <td style="height: 79px; width: 173px;"> <div style="text-align: center"> 
            <table border="0" cellpadding="0" cellspacing="0" class="texto01" style="width: 328px">
              <tr> 
                <td style="width: 75px; height: 18px"> <div style="text-align: left"> 
                    RUT</div></td>
                <td style="width: 318px; height: 18px"> <div style="text-align: left"> 
                    <input name="txtRut" type="text" maxlength="10" id="txtRut" class="input-normal" style="text-transform: uppercase;" onchange="vRut()" value="<?php echo $rut_w; ?>" />
                    &nbsp; </div>
                  <span id="RutMalo" style="color:Red;display:none;">* Rut inválido</span> 
                </td>
              </tr>
              <tr> 
                <td height="343" colspan="2" style="background-image: url(ieco/isase476.jpg); height: 2px"> 
                </td>
              </tr>
              <tr> 
                <td style="width: 75px; height: 19px"> <div style="text-align: left"> 
                    Nombres</div></td>
                <td style="width: 318px; height: 19px"> <div style="text-align: left"> 
                    <input name="txtNombre" type="text" maxlength="20" id="txtNombre" class="input-normal" style="width:248px;" value="<?php echo $nombre_w; ?>" />
                    &nbsp;</div>
                  <span id="NombreMalo" style="color:Red;display:none;">* Nombre inválido</span> 
					</td>
              </tr>
              <tr> 
                <td colspan="2" style="background-image: url(ieco/isase476.jpg); height: 3px"> 
                </td>
              </tr>
              <tr> 
                <td style="width: 75px; height: 19px"> <div style="text-align: left"> 
                    Paterno</div></td>
                <td style="width: 318px; height: 19px"> <div style="text-align: left"> 
                    <input name="txtPaterno" type="text" maxlength="20" id="txtPaterno" class="input-normal" style="width:247px;" value="<?php echo $paterno_w; ?>" />
                    &nbsp;</div>
                   <span id="ApeMalo" style="color:Red;display:none;">* Ap.Paterno inválido</span> 
					</td>
              </tr>
              <tr> 
                <td colspan="2" style="background-image: url(ieco/isase476.jpg); height: 3px"> 
                </td>
              </tr>
              <tr> 
                <td style="width: 75px; height: 19px"> <div style="text-align: left"> 
                    Materno</div></td>
                <td style="width: 318px; height: 19px"> <div style="text-align: left"> 
                    <input name="txtMaterno" type="text" maxlength="20" id="txtMaterno" class="input-normal" style="width:246px;" value="<?php echo $materno_w; ?>" />
                    &nbsp;</div></td>
              </tr>
              <tr> 
                <td style="width: 75px; height: 19px"> <div style="text-align: left"> 
                    E-mail</div></td>
                <td style="width: 318px; height: 19px"> <div style="text-align: left"> 
                    <input name="txtEmail" type="text" maxlength="60" id="txtEmail" class="input-normal" style="width:245px;" onchange="valEmail()" value="<?php echo $email_w; ?>" />
                    &nbsp;</div></td>
              </tr>
              <tr> 
                <td colspan="2" style="background-image: url(ieco/isase476.jpg); height: 3px"> 
                </td>
              </tr>
            </table>
          </div>
          <span id="emailMalo" class="texto01" style="color:Red;visibility:hidden;">Email 
          inválido</span></td>
      </tr>
      <tr> 
        <td style="width: 173px; height: 79px"> <table id="Table2" border="0" cellpadding="0" cellspacing="0" class="texto01" style="width: 396px">
            <tr> 
              <td style="width: 51px; height: 12px"> </td>
              <td style="width: 286px; height: 12px"> </td>
            </tr>
            <tr> 
              <td colspan="2" style="background-image: url(ieco/isase476.jpg); height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 51px; height: 21px"> Usuario</td>
             <?php 
			 if ($opc_w == 'I')
			 {
			   echo '<td style="width: 286px; height: 21px"> <input name="txtUsuario" type="text" maxlength="8" id="txtUsuario" class="input-normal" style="width:113px;" value="'.$usuario_w.'" />';
			  }
			 else
			   { 
			   echo '<td style="width: 286px; height: 21px"> <input name="txtUsuario" type="text" maxlength="8" id="txtUsuario" class="input-normal" style="width:113px;" value="'.$usuario_w.'" readOnly="readonly" />' ;
               
              }
              echo '<span id="UsuMalo" style="color:Red;display:none;">* Usuario inválido</span> </td>' ;
              ?>
            </tr>
            <tr> 
              <td colspan="2" style="background-image: url(ieco/isase476.jpg); height: 2px"> 
              </td>
            </tr>
            <tr> 
              <td style="width: 51px; height: 20px">Password</td>
			  <?php 
			 if ($opc_w == 'I')
			 {
			   echo '<td style="width: 286px; height: 21px"> <input name="txtpass" type="password" maxlength="10" id="txtpass" class="input-normal" onchange="valPass()" value="'.$password_w.'" />';
			  }
			 else
			   { 
			   echo '<td style="width: 286px; height: 21px"> <input name="txtpass" type="password" maxlength="10" id="txtpass" class="input-normal" onchange="valPass()"  value="'.$password_w.'" readOnly="readonly" />' ;
               
              }
              echo '<span id="PassMalo" style="color:Red;display:none;">* Password inválida</span> </td>' ;
              ?>

            </tr>
            <tr> 
              <td style="width: 51px; height: 20px">Re-Password</td>
  			  <?php 
			 if ($opc_w == 'I')
			 {
			   echo '<td style="width: 286px; height: 21px"> <input name="txtpass2" type="password" maxlength="10" id="txtpass2" class="input-normal" onchange="valRePass()" value="'.$repassword_w.'" /></td>';
			  }
			 else
			   { 
			   echo '<td style="width: 286px; height: 21px"> <input name="txtpass2" type="password" maxlength="10" id="txtpass2" class="input-normal" onchange="valRePass()"  value="'.$repassword_w.'" readOnly="readonly" /></td>' ;
               
              }
              ?>

            </tr>
            <tr> 
              <td style="width: 51px; height: 20px">Tipo</td>
			<?php
				if ($tipo_w == 'ADM')
			 {
			   echo '<td style="width: 286px; height: 23px"> <select name="cmbUsuario" id="cmbUsuario" tabindex="3" class="texto01">';
               echo '   <option value="USU">USUARIO</option>';
               echo '  <option value="ADM" selected="selected">ADMINISTRADOR</option>';
               echo ' </select></td>';
			  }
			 else
			   { 
			   echo '<td style="width: 286px; height: 23px"> <select name="cmbUsuario" id="cmbUsuario" tabindex="3" class="texto01">';
    			echo ' <option value="USU" selected="selected">USUARIO</option>>';
                echo ' <option value="ADM">ADMINISTRADOR</option>';
               echo ' </select></td>';
               
              }
              ?>
				
            </tr>
            <tr> 
              <td style="width: 51px; height: 20px"> F.Inicio</td>
              <td style="width: 286px; height: 20px"> <input name="TB_inicio" type="text" value="<?php echo $finicio_w; ?>" maxlength="10" readonly="readonly" id="TB_inicio" tabindex="2" class="input-normal" style="width:79px;" /> 
                &nbsp; &nbsp; </td>
            </tr>
            <tr> 
              <td colspan="2" style="background-image: url(ieco/isase476.jpg); width: 24px;
                                            height: 2px"> </td>
            </tr>
            <tr> 
              <td style="width: 51px; height: 23px"> Habilitado</td>
             <?php 
			 if ($habilitado_w == 'N')
			 {
			   echo '<td style="width: 286px; height: 23px"> <select name="cmbElegir" id="cmbElegir" tabindex="3" class="texto01">';
               echo '   <option value="S">Si</option>';
               echo '  <option value="N" selected="selected">No</option>';
               echo ' </select></td>';
			  }
			 else
			   { 
			   echo '<td style="width: 286px; height: 23px"> <select name="cmbElegir" id="cmbElegir" tabindex="3" class="texto01">';
    			echo '   <option value="S" selected="selected">Si</option>';
                echo '  <option value="N">No</option>';
               echo ' </select></td>';
              }

              ?>
            </tr>
            <tr> 
              <td colspan="2" style="background-image: url(ieco/isase476.jpg); width: 286px;
                                            height: 2px"> </td>
            </tr>
            <tr> 
              <td colspan="2" style="background-image: url(ieco/isase476.jpg); width: 286px;
                                            height: 2px"> </td>
            </tr>
            <tr> 
              <td style="width: 51px; height: 20px"> </td>
              <td style="width: 286px; height: 20px"> </td>
            </tr>
          </table></td>
      </tr>
      <tr> 
        <td style="width: 173px"> <div style="text-align: center"> 
            <table border="0" cellpadding="0" cellspacing="0" style="width: 316px; height: 24px;
                                        background-color: #f2f4f4; text-align: center">
              <tr> 
                <td style="width: 158px; height: 24px"> <div style="text-align: center"> 
                    <span class="solicitud"> 
                    <input type="submit" name="btnCancelar" value="Cancelar" id="btnCancelar" class="boton" onclick="javascript:window.close();"/>
                    </span></div></td>
                <td style="width: 158px; height: 24px; text-align: center"> <div style="text-align: center"> 
                    <span class="solicitud"> 
                    <input type="submit" name="btnAceptar" value="Aceptar" id="btnAceptar" class="boton" />
                    </span></div></td>
              </tr>
            </table>
          </div></td>
      </tr>
    </table>
    <br />
        <br />
    
    </div>
    
<?php	
if ($_POST) 
{
 if (isset($_POST{"btnCancelar"})) 
    {
//	 include ("eco003.php"); 
    $extra = 'eco004.php?SISTEMA=eco';
    header("Location: $extra");
	}
}	
?>

</form>

<?php	
if ($_POST) 
{ 
//if (isset($btnAceptar)) { 
 if (isset($_POST{"btnAceptar"})) 
{
 
 
//echo "grabar";
	$usuario_w = $_POST["txtUsuario"];
	$rut_w     = $_POST["txtRut"];
	$nombre_w  = $_POST["txtNombre"];
	$paterno_w = $_POST["txtPaterno"];
	$materno_w = $_POST["txtMaterno"];
	$email_w   = $_POST["txtEmail"];
	$password_w   = $_POST["txtpass"];
	$repassword_w  = $_POST["txtpass2"];
	$finicio_w = $_POST["TB_inicio"];
	$habilitado_w = $_POST["cmbElegir"];
	$tipo_w = $_POST["cmbUsuario"];

	//empiezas las validaciones correspondientes por ejemplo
	$error_w = FALSE;
	if (strlen($rut_w) < "3") { //que el rut sea mayor a 3
		   echo "<script type=\"text/javascript\">document.getElementById('RutMalo').style.display=''</script>";
/*		ahora dentro del echo pongo un alert que lo q hace es q si sucede q el nombre sea menor a tres manda un mensaje que te permite visualizarlo sin salir de la pagina
		echo  "<script type=\"text/javascript\">
		alert('El campo Nombre debe tener al menos 3 caracteres');
		</script>";    
*/
//		 exit();
		$error_w = TRUE;
		}
    if (strlen($nombre_w) == 0) { //que ingrese nombre
		   echo "<script type=\"text/javascript\">document.getElementById('NombreMalo').style.display=''</script>";
//		 exit();
		$error_w = TRUE;

		} 		
    if (strlen($paterno_w) == 0) { //que ingrese nombre
		   echo "<script type=\"text/javascript\">document.getElementById('ApeMalo').style.display=''</script>";
//		 exit();
		$error_w = TRUE;

		} 		

    if (strlen($usuario_w) == 0) { //que ingrese cod usuario
		   echo "<script type=\"text/javascript\">document.getElementById('UsuMalo').style.display=''</script>";
//		 exit();
		$error_w = TRUE;

		} 		
		
 	if (strlen($password_w) == 0) { //que ingrese password
		   echo "<script type=\"text/javascript\">document.getElementById('PassMalo').style.display=''</script>";
//		 exit();
		$error_w = TRUE;

		} 		
	
    if ( $error_w )	
	  {
	   exit();
	  }

	else{
//		$link = mysql_connect("localhost","root","");
//		mysql_select_db("eco");
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//		mysql_select_db(DB_NAME, $link); 
		if (!$link) {
			printf("No se puede conectar a localhost. Error: %s\n", mysqli_connect_error());
			exit();
		}
		
		$sql1 = "call ECO_PUPD_USUARIOS('".$opc_w."','".$usuario_w."','".$rut_w."','".$nombre_w."','".$paterno_w."','".$materno_w."','".$email_w."')";
		
		mysqli_autocommit($link, TRUE);
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error();
			 $merror = "Ocurrio un error al grabar Usuario: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El usuario ya existe....." ;
				} 
				
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();

			}
		else
		   {
			mysqli_close($link);
			}	

//		mysql_query($sql1);
//		mysql_close($link);

//		$link = mysql_connect("localhost","root","");
//		mysql_select_db("eco");
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//		mysql_select_db(DB_NAME, $link); 
		if (!$link) {
			printf("No se puede conectar a localhost. Error: %s\n", mysqli_connect_error());
			exit();
		}

		$sql1 = "call ECO_PUPD_USUARIO_SISTEMA('".$opc_w."','ECO','".$usuario_w."','".md5($password_w)."',STR_TO_DATE('".$finicio_w."','%d/%m/%Y'),null,null,null,null,'".$habilitado_w."','".$tipo_w."')";
		
		mysqli_autocommit($link, TRUE);

//		mysql_query($sql1);
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error();
			 $merror = "Ocurrio un error al grabar Usuario/Sistema: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El usuario ya existe....." ;
				} 
				
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();


			}
		else
		   {
			mysqli_close($link);
			echo "<script type=\"text/javascript\">
			alert('El Usuario: \' $usuario_w \' ha sido registrado de manera satisfactoria.');
			</script>";

			}	

//		mysql_close($link);
	
	   }//cierras todos los else que abras
	   
   echo "<script>opener.document.form1.submit()</script>";
   echo "<script type=\"text/javascript\"> window.close(); </script>";

//	$extra = 'eco004.php?SISTEMA=eco';
// 	header("Location:".$extra);
	
 }
}
?>

</body>
</html>
