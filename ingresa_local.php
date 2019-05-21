<?php

session_start();

if (!isset($_SESSION['tipo'])){ $_SESSION['tipo']="";} 

//incluímos la clase ajax
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax(); 
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

require_once 'admin/config.php';
//require_once 'cam_valida.php';

function cam_validalocal($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
$_SESSION['nomloc_s']="";
//if (empty($cod)) return false;
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//	$respuesta->assign("mensaje_loc","innerHTML","Debes ingresar un local");
	$respuesta->assign("cmd_nomloc","value","Debes ingresar un local");
	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("cmd_nomloc","style.color","red");
}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_locales('".$cod."')";

	$result=mysqli_query($link,$consulta);
      if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nomloc","value","Local no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nomloc","style.color","red");

      }else{

			//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nomloc_s']=utf8_decode($row["nombre"]);
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
//		$respuesta->assign("mensaje_loc","innerHTML","Todo correcto");
		$respuesta->assign("cmd_nomloc","value",$_SESSION['nomloc_s']);
		$respuesta->assign("cmd_nomloc","style.color","blue");
		}
  }
return $respuesta;
}

//registramos la función creada anteriormente al objeto xajax
$xajax->registerFunction("cam_validalocal");

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

if (!$_POST)
	{
	$_SESSION['codloc_s']="";
	$_SESSION['nomloc_s']="";

	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Punto de Ventas</title>
	    <?php
		//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
		$xajax->printJavascript("../xajax/");
		?>

		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
					
        function f_SelLocal(){
       /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_locales.php' ,'Locales','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
 		    document.getElementById('cmd_transac').focus();
			
			        }
		  
	    </script>
	    	
	</head>

<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout">
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" id="Form1">

					<span id="Label1"  class="texto18">PUNTO DE VENTAS</span>
					<table>
					<tr>
						<td>Cód.Local</td>
						<td>  
							<input name="cmd_codloc" type="text" maxlength="2" tabindex="1" id="cmd_codloc" class="input-normal" style="width:56px;"  onBlur="javascript:xajax_cam_validalocal(document.Form1.cmd_codloc.value)" value="<?php if (isset($_SESSION['codloc_s'])){ echo $_SESSION['codloc_s']; } ?>"/>
							<input name="imgloc" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelLocal()" />
                			<input name="cmd_nomloc" type="text" maxlength="20" id="cmd_nomloc"  value="<?php echo $_SESSION['nomloc_s']; ?>" readOnly="readonly" />
						
<!-- 							<div id="mensaje_loc"></div>
 -->			
 </td>	
 </tr>
 </table>

</form>

</body>
</HTML>
