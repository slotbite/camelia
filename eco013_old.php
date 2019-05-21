<?php
// Sistema			: ECO
// Programa			: ECO13.PHP
// Descripcion		: Cambio de Contraseña.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 17/11/2010

// iniciamos sesiones

session_start ();

// archivos necesarios
require_once 'admin/config.php';
require_once 'admin/conexion.php';
require_once 'admin/esUsuario.php';

// obtengo puntero de conexion con la db
$dbConn = conectar();
/*
// verificamos que no este conectado el usuario
if ( !empty( $_SESSION['usuario'] ) && !empty($_SESSION['password']) ) {
	if ( esUsuario( $_SESSION['usuario'], $_SESSION['password'] , $dbConn ) ){
//		header( 'Location: index.php' );
		die;
	}
}
*/

if (isset($_POST['usuario'])){
	$usuario_w  = $_POST['usuario'];
	}
else{
	$usuario_w  = "";
	}

if (isset($_POST['password'])){
	$password  = $_POST['password'];
	}
else{
	$password  = "";
	}
if (isset($_POST['nuepass'])){
	$nuepass  = $_POST['nuepass'];
	}
else{
	$nuepass  = "";
	}

if (isset($_POST['renuepass'])){
	$renuepass  = $_POST['renuepass'];
	}
else{
	$renuepass  = "";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Ingreso de usuario</title>
	<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

</head>

<body>
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"  id="Form1"  >
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
?>

	<div>
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 63px; position: absolute; top: 14px; height: 565px; width: 623px;" width="510">
      <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                
        <td style="height: 24px" valign="bottom"> <span id="Label1" class="texto18"> 
          CAMBIO DE PASSWORD</span></td>
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
              <td colspan="2" style="width: 381px; height: 14px"><div align="center"><img src="file:///X|/Apps/eco/Antecedentes/logo.jpg" width="439" height="421" /> 
                </div></td>
            </tr>
            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 105px; height: 2px"> &nbsp; 
                Nombre de usuario</td>
              <td width="365" style="width: 314px; height: 3px"> <input name="usuario" type="text" value="<?php echo $usuario_w; ?>" />
                &nbsp; &nbsp; <span id="UsuMalo" style="color:Red;font-weight:bold;display:none;">Usuario 
                Erróneo</span></td>
            </tr>
            <tr> 
              <td style="width: 131px; height: 18px">&nbsp; Contraseña Actual</td>
              <td style="width: 314px; height: 18px"> <input name="password" type="password" value="<?php echo $password; ?>" />
			    &nbsp; &nbsp;<span id="PassMala" style="color:Red;font-weight:bold;display:none;">Password 
                Errónea</span> </td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 18px">&nbsp;</td>
	            <td style="width: 314px; height: 18px"> 
	  		    &nbsp; <span id="ErrorGlobal" style="color:Red;font-weight:bold;display:none;">El nombre de usuario o password no coinciden</span> </td>
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
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
		    <tr> 
              <td style="width: 131px; height: 18px">&nbsp; Contraseña Nueva</td>
              <td style="width: 314px; height: 18px"> <input name="nuepass" type="password" value="<?php echo $nuepass; ?>" />
                &nbsp; <span id="NuePassMala" style="color:Red;font-weight:bold;display:none;">Password 
                Nueva Errónea</span> </td>
            </tr>

            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>   
            </tr>
			<tr> 
              <td style="width: 131px; height: 18px">&nbsp; Re_ingrese Contraseña</td>
              <td style="width: 314px; height: 18px"> 
	  			<input name="renuepass" type="password" value="<?php echo $renuepass; ?>" />
			    &nbsp; <span id="NuePassMala2" style="color:Red;font-weight:bold;display:none;">Password No Coincide
                </span> </td>
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
                            <td align="center">
			             <input type="submit" name="cmd_aceptar" value="Ingresar" id="cmd_aceptar" class="boton" /></td>

                        </tr>
                    </table>
                    </td>
            </tr>
        </table>
        <br />
        <br />
    
   </div>
  </form>
<?php  
if ($_POST){
 if(isset($_POST["cmd_aceptar"])) { 

	// definimos las variables
	$usuario_w	= $_POST['usuario'];
	$password 	= $_POST['password'];
	$nuepass 	= $_POST['nuepass'];
	$renuepass 	= $_POST['renuepass'];
	
	// completamos la variable error si es necesario
	$error_w = FALSE;
	if ( empty($usuario_w) ) { 
		echo "<script type=\"text/javascript\">document.getElementById('UsuMalo').style.display=''</script>";
		$error_w = TRUE;
        }
	if ( empty($password) ) { 
		echo "<script type=\"text/javascript\">document.getElementById('PassMala').style.display=''</script>";
		$error_w = TRUE;
        }
	if ( $nuepass <> $renuepass ) { 
		echo "<script type=\"text/javascript\">document.getElementById('NuePassMala2').style.display=''</script>";
		$error_w = TRUE;
        }
	
	// si no hay errores registramos al usuario
	if ( ! $error_w  ) {
		
		// verificamos que los datos ingresados corresopndan a un usuario
		if ( $arrUsuario = esUsuario($usuario_w,md5($password),$dbConn) )
		 {
			
			// definimos las variables
			$_POST['usuario'] 	= $arrUsuario['usuario'];
			$_POST['password']	= $arrUsuario['password'];
			
//			header("Location:menueco.html");
//			exit();

			$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			if (!$link) {
				printf("No se puede conectar a localhost. Error: %s\n", mysqli_connect_error());
				exit();
				}
			if (strlen($nuepass) <> 0 ) 
				{ 
				$sql1 = "call ECO_PUPD_USUARIO_SISTEMA('M','ECO','".$usuario_w."','".md5($nuepass)."',null,null,null,null,null,null,null)";
				}
			else
				{
				$sql1 = "call ECO_PUPD_USUARIO_SISTEMA('M','ECO','".$usuario_w."',null,null,null,null,null,null,null,null)";
				}
					
			mysqli_autocommit($link, TRUE);
			if (!mysqli_query($link,$sql1)) 
				{ $error = mysqli_error();
			  	  $merror = "Ocurrio un error al grabar Usuario/Sistema: " . mysqli_errno($link);
				  $nerror  = mysqli_errno($link);
				  if (mysqli_errno($link) == 1062)
					{
					$merror = "El usuario ya existe....." ;
					} 
					echo "<script type=\"text/javascript\">alert('Error: \' $merror \' .') </script>";
					mysqli_close($link);
					exit();
				}
			else
			   {
				mysqli_close($link);
				
				echo "<script type=\"text/javascript\">
					alert('El Usuario: \' $usuario_w \' ha sido registrado de manera satisfactoria.');
					</script>";
					
				$usuario_w	= "";
				$password 	= "";
				$nuepass 	= "";
				$renuepass 	= "";
/*				
				$usuario_w	= $_POST['usuario'] = "";
				$password 	= $_POST['password'] = "";
				$nuepass 	= $_POST['nuepass'] = "";
				$renuepass 	= $_POST['renuepass'] = "";
*/				
				echo '<script type=\'text/javascript\'>Form1.usuario.value="'.$usuario_w.'"</script>';
				echo '<script type=\'text/javascript\'>Form1.password.value="'.$password.'"</script>';
				echo '<script type=\'text/javascript\'>Form1.nuepass.value="'.$nuepass.'"</script>';
				echo '<script type=\'text/javascript\'>Form1.renuepass.value="'.$renuepass.'"</script>';		   
		   
				echo "<script type=\"text/javascript\">document.Form1.submit();</script>";
				

				}	
			}
	    
	else {
			echo "<script type=\"text/javascript\">document.getElementById('ErrorGlobal').style.display=''</script>";
			$error_w = TRUE;
	//		$error['noExiste'] 		= 'El nombre de usuario o contrase&ntilde;a no coinciden';
			}
		}
 }
}
?>

</body>
</html>
