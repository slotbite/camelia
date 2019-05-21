<?php
// Sistema			: CAMELIA
// Programa			: menueco.html menu5.PHP
// Descripcion		: Menú principal sistema CAMELIA.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 11/08/2011

// iniciamos sesiones
session_start();
require_once 'admin/config.php';

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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CAMELIA</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />
<style type="text/css">
<!--
.solicitud {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #ffffff;
	text-decoration: none;
	font-weight: normal;
}
a.solicitud:hover {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #808080; text-decoration: underline}
a.solicitud:visited {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #ffffff}
-->

</style>
<script type="text/javascript" src="muestra_oculta.js"></script>
<script language="javascript" type ="text/javascript" >
	 
		function oPenhtml(pag) {
//		 alert( pag )
		parent.frames['rightFrame'].location.href= "eco_autoriza.php?PAGINA=" + pag ;
	
		}

	function oculta(capa) {
	   document.getElementById(capa).style.visibility="hidden";
	}

	function muestra(capa) {
	   document.getElementById(capa).style.visibility="visible";
	}

	</script>

</head>

<!-- <body style="background-color: #fffaf0;" >
 -->
 <body bgcolor="#000080" text="#ffffff" link="#ffff33" vlink="#ffffcc" alink="ffff00"> 

<div id="capaPrincipal" class="texto18" > 
  <p><strong><em>MEN&Uacute; PRINCIPAL</em></strong> </p>
</div>
<div id="menu1" style="display: inline;" > <a class="texto15"  onmouseover="muestra('menu11');"  ><strong>MANTENCIONES</strong></a> 
</div>
    <div id="menu11" onmouseover="muestra('menu11');" >
	        <dl>
<!-- 				<dt> <input name="" type="image" src="ieco/isase402.gif" ><a class="solicitud" href="#">Tablas Generales</a></dt>
				 	<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=ciudad')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=ciudad')">Ciudades </a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=comuna')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=comuna')">Comunas</a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=prevision')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=prevision')">Prevision</a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=especial')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=especial')">Especialidad</a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=examen')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=examen')">Exámenes</a> </dd> 
 -->
<!--			
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam006.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam006.php?OPC2=I')">Locales</a></dt>
-->
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam006.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam006.php?OPC2=I')">Locales</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('proveedores.html?OPC=I')"><a class="solicitud" href="javascript:oPenhtml('proveedores.html?OPC=I')">Proveedores</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('articulos.html?OPC=I')"><a class="solicitud" href="javascript:oPenhtml('articulos.html?OPC=I')">Artículos</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam010.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam010.php?OPC2=I')">Colores</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('inventario.html?OPC=I')"><a class="solicitud" href="javascript:oPenhtml('inventario.html?OPC=I')">Inventario</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam014.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam014.php?OPC2=I')">Vendedores</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam016.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam016.php?OPC2=I')">Habilitados</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam018.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam018.php?OPC2=I')">Instituciones</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam020.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam020.php?OPC2=I')">Bancos</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam022.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('cam022.php?OPC2=I')">Parámetros</a></dt>

				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco004.php?SISTEMA=eco')"><a class="solicitud" href="javascript:oPenhtml('eco004.php?SISTEMA=eco')">Usuarios</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco013.php')"><a class="solicitud" href="javascript:oPenhtml('eco013.php')">Cambio Password</a></dt>

			</dl> 
    </div>
	
<a class="texto15" onmouseover="muestra('menu12');"> <strong>CONSULTAS E INFORMES</strong></a> 
<div id="menu12" >
			   <dl>
	   				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam023.php')"><a class="solicitud" href="javascript:oPenhtml('cam023.php')">Locales</a></dt>
  				    <dt> <input name="" type="image" src="ieco/isase402.gif" ><a class="solicitud" href="#">Proveedores</a></dt>
						<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('proveedores2.html')"><a class="solicitud" href="javascript:oPenhtml('proveedores2.html')">Por Código</a> </dd> 
						<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('proveedores3.html')"><a class="solicitud" href="javascript:oPenhtml('proveedores3.html')">Por Nombre</a> </dd> 
	   				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('articulos2.html')"><a class="solicitud" href="javascript:oPenhtml('articulos2.html')">Articulos</a></dt>
  				    <dt> <input name="" type="image" src="ieco/isase402.gif" ><a class="solicitud" href="#">Colores</a></dt>
						<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam027.php')"><a class="solicitud" href="javascript:oPenhtml('cam027.php')">Por Código</a> </dd> 
						<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam028.php')"><a class="solicitud" href="javascript:oPenhtml('cam028.php')">Por Nombre</a> </dd> 
  				    <dt> <input name="" type="image" src="ieco/isase402.gif" ><a class="solicitud" href="#">Inventario</a></dt>
						<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('inventario_det.html')"><a class="solicitud" href="javascript:oPenhtml('inventario_det.html')">Detallado</a> </dd> 
  				    <dt> <input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam031.php')"><a class="solicitud" href="javascript:oPenhtml('cam031.php')">Cuadratura Caja</a></dt>
  				    <dt> <input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('cam030.php')"><a class="solicitud" href="javascript:oPenhtml('cam030.php')">Vtas. x Fecha</a></dt>

				</dl> 
	
<a class="texto15" onmouseover="muestra('menu12');" > <strong>PROVEEDORES</strong></a> 
<div id="menu13" >
			   <dl>
  	   				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco010.php')"><a class="solicitud" href="javascript:oPenhtml('eco010.php')">Doctos. de Proveedores</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco046.php')"><a class="solicitud" href="javascript:oPenhtml('eco046.php')">Pagos a Proveedores</a></dt>

<!--			   
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco009.php')"><a class="solicitud" href="javascript:oPenhtml('eco008.php?CODIGO=')">Ecotomografia Abdominal</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco015.php')"><a class="solicitud" href="javascript:oPenhtml('eco016.php?CODIGO=')">EcoCardiograma</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco017.php')"><a class="solicitud" href="javascript:oPenhtml('eco018.php?CODIGO=')">EcoDoppler Venoso Una Pierna</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco019.php')"><a class="solicitud" href="javascript:oPenhtml('eco020.php?CODIGO=')">EcoPelviana Femenina</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco021.php')"><a class="solicitud" href="javascript:oPenhtml('eco022.php?CODIGO=')">Ecografía Renal</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco023.php')"><a class="solicitud" href="javascript:oPenhtml('eco024.php?CODIGO=')">EcoDoppler Brazo</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco025.php')"><a class="solicitud" href="javascript:oPenhtml('eco026.php?CODIGO=')">EcoDoppler Carotideo</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco027.php')"><a class="solicitud" href="javascript:oPenhtml('eco028.php?CODIGO=')">EcoDoppler Arterial</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco029.php')"><a class="solicitud" href="javascript:oPenhtml('eco030.php?CODIGO=')">EcoDoppler Venoso Bilateral</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco031.php')"><a class="solicitud" href="javascript:oPenhtml('eco032.php?CODIGO=')">EcoDoppler Extremidad Superior</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco033.php')"><a class="solicitud" href="javascript:oPenhtml('eco034.php?CODIGO=')">EcoPelviana Masculina</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco035.php')"><a class="solicitud" href="javascript:oPenhtml('eco036.php?CODIGO=')">EcoDoppler Extremidades Inferiores</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco037.php')"><a class="solicitud" href="javascript:oPenhtml('eco038.php?CODIGO=')">Eco Arterial Normal</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco039.php')"><a class="solicitud" href="javascript:oPenhtml('eco040.php?CODIGO=')">EcoDoppler Arterial Brazo</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco041.php')"><a class="solicitud" href="javascript:oPenhtml('eco042.php?CODIGO=')">EcoDoppler Pierna</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase458.jpg" onClick="javascript:oPenhtml('eco044.php')"><a class="solicitud" href="javascript:oPenhtml('eco043.php?CODIGO=')">Test de Esfuerzo</a></dt>
-->
				</dl> 
</body>
 <input name="hd_autoriza" type="hidden" value="">
</html>
