<?php
// Sistema			: CAMELIA
// Programa			: CAM_valida.PHP
// Descripcion		: Validación de Local.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 30/03/2012

session_start();

require_once 'admin/config.php';

function cam_validalocal()
{
if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 

//echo 'pase';
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_locales('".$_SESSION['codloc_s']."')";

	$result=mysqli_query($link,$consulta);
	

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
			$_SESSION['nomloc_s']=utf8_decode($row["nombre"]);

    	}
		

	mysqli_free_result($result);
	mysqli_close($link);

	
	echo "<script>opener.document.Form1.submit()</script>";
	  
}
?>

