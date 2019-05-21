<?php

function esUsuario ( $usuario, $password, $conexion ) {
	
	// verifica que esten los dos campos completos.
	if ($usuario=='' || $password=='') return false;
	
	// busqueda de los datos de usuarios para loguear.
//	$query = "SELECT idUsuario, usuario, password, tipo FROM `usuarios` WHERE usuario = '$usuario'";
	$query ="call CAM_PSEL_USUARIO_SISTEMA('CAME','".$usuario."')";
	
	$resultado = mysqli_query($conexion, $query);
//	$resultado = mysql_query($query);

	$row = mysqli_fetch_array($resultado);
	$password_from_db = $row['password'];
	unset($query);
			
	// verifica que el pass enviado sea igual al pass de la db.
	if ( $password_from_db == $password ) {
		return $row;
	} else return false;
	
}

?>