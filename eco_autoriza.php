<?php
// Sistema			: CAMELIA
// Programa			: eco_autoriza.PHP
// Descripcion		: Genera variable sesi�n para acceso a las pag del sistema.
// Programador(a) 	: Roxana Ram�rez Vega
// F.Inicio 		: 12/08/2011
// iniciamos sesiones
session_start();

$pagina_w = $_GET["PAGINA"];

if (isset($_SESSION['autoriza'])){$_SESSION['autoriza']="SI";} 

header("Location: $pagina_w");


?>

