<?php
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
$_SESSION['nompro_s']="";
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("cmd_nompro","value","Debe ingresar un proveedor");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("cmd_nompro","style.color","red");
	$respuesta->script("xajax.$('cmd_nompro').focus();");

}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_proveedores(null,null,null,'".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nompro","value","Proveedor no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nompro","style.color","red");
		$respuesta->script("xajax.$('cmd_nompro').focus();");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nompro_s']=utf8_decode($row["nomfa"]);
				$_SESSION['codpro_s']=$cod;
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("cmd_nompro","value",$_SESSION['nompro_s']);
		$respuesta->assign("cmd_nompro","style.color","blue");

		}
?>

<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

</body>
</html>
