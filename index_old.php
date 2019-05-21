<?php
// Sistema			: CAMELIA
// Programa			: INDEX.PHP
// Descripcion		: Inicio de Sesión.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 11/08/2011

// iniciamos sesiones
ob_start();
session_start();

if (!isset($_SESSION['usuario'])){ $_SESSION['usuario']="";} 
if (!isset($_SESSION['password'])){ $_SESSION['password']="";} 
if (!isset($_SESSION['tipo'])){ $_SESSION['tipo']="";} 
if (!isset($_SESSION['autoriza'])){ $_SESSION['autoriza']="";}

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

if (!$_POST){
	$_SESSION['usuario']="";
	$_SESSION['password']="";
	$_SESSION['tipo']="";
	$_SESSION['autoriza']="";
}
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
	<div>
    <table id="Table1" border="0" cellpadding="0" cellspacing="0" style="z-index: 101; left: 63px; position: absolute; top: 14px; height: 398px; width: 623px;" width="510">
      <tr>
                <td style="background-image: url(ivvpp0002.jpg); width: 34px; height: 24px">
                </td>
                
        <td style="height: 24px" valign="bottom"> <span id="Label1" class="texto18"> 
          INICIO DE SESION</span></td>
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
<!--             <tr> 
              <td colspan="2" style="width: 381px; height: 14px"><div align="center"><img src="ieco/logo2.jpg" width="274" height="350" /> 
                </div></td>
            </tr>
 -->            <tr> 
              <td background="ivvpp0003.jpg" colspan="2" height="4" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td background="ivvpp0003.jpg" colspan="2" height="2" style="width: 381px"> 
              </td>
            </tr>
            <tr style="color: #000000"> 
              <td width="131" height="25" style="width: 105px; height: 2px"> &nbsp; 
                Nombre de usuario</td>
              <td width="365" style="width: 314px; height: 3px"> 
  			<input name="usuario" type="text" value="<?php echo $usuario_w; ?>" />
               &nbsp; &nbsp; <span id="UsuMalo" style="color:Red;font-weight:bold;display:none;">Usuario 
                Erróneo</span></td>
            </tr>
            <tr> 
              <td style="width: 95px; height: 18px">&nbsp; Contraseña</td>
              <td style="width: 314px; height: 18px"> 
	  			<input name="password" type="password" value="<?php echo $password; ?>" />
			    &nbsp; <span id="PassMala" style="color:Red;font-weight:bold;display:none;">Password 
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
	
	// si no hay errores registramos al usuario
	if ( ! $error_w  ) {
		
		// verificamos que los datos ingresados corresopndan a un usuario
		if ( $arrUsuario = esUsuario($usuario_w,md5($password),$dbConn) ) {
			
			// definimos las sesiones
			$_SESSION['usuario'] 	= $arrUsuario['usuario'];
			$_SESSION['password']	= $arrUsuario['password'];
			$_SESSION['tipo']	=  $arrUsuario['tipo'];
			$_SESSION['autoriza']	= "SI";
			
			header("Location:menueco.html");
			ob_end_flush();
			exit();
			
		} else {
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
