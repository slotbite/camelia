<?php
// Sistema			: ECO
// Programa			: menueco.html menu5.PHP
// Descripcion		: Menú principal sstema eco.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: /11/2010

// iniciamos sesiones
session_start();

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

<html>
 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ECOCENTRO</title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />
<style type="text/css">
<!--
.solicitud {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #663300;
	text-decoration: none;
	font-weight: normal;
}
a.solicitud:hover {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #660000; text-decoration: underline}
a.solicitud:visited {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #660000}
-->

</style>
<script type="text/javascript" src="muestra_oculta.js"></script>
<script language="javascript" type ="text/javascript" >
	 
		function oPenhtml(pag) {
//		 alert( pag )
		parent.frames['rightFrame'].location.href= "eco_autoriza.php?PAGINA=" + pag ;
		
		}

	function oculta (capa) {
	   document.getElementById(capa).style.visibility="hidden";
	}

	function muestra (capa) {
	   document.getElementById(capa).style.visibility="visible";
	}


	</script>
</head>
 

<body style="background-color: #fffaf0;" >

<div id="capaPrincipal" class="texto18" > 
  <p><strong><em>MEN&Uacute; PRINCIPAL</em></strong> </p>
</div>
<div id="menu1" style="display: inline;" > <a class="texto15" onmouseover="muestra('menu11');"  ><strong>MANTENCIONES</strong></a> 
</div>
    <div id="menu11" onmouseover="muestra('menu11');" >
	        <dl>
				<dt> <input name="" type="image" src="ieco/isase402.gif" ><a class="solicitud" href="#">Tablas Generales</a></dt>
				 	<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=ciudad')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=ciudad')">Ciudades </a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=comuna')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=comuna')">Comunas</a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=prevision')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=prevision')">Prevision</a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=especial')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=especial')">Especialidad</a> </dd> 
					<dd><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco001.php?CONCEPTO=examen')"><a class="solicitud" href="javascript:oPenhtml('eco001.php?CONCEPTO=examen')">Exámenes</a> </dd> 

			
				  
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco006.php?OPC2=I')"><a class="solicitud" href="javascript:oPenhtml('eco006.php?OPC2=I')">Medicos</a></dt>
<!--				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco002.php?OPC=I')"><a class="solicitud" href="javascript:oPenhtml('eco002.php?OPC=I')">Pacientes</a></dt>
-->
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('pacientes.html?OPC=I')"><a class="solicitud" href="javascript:oPenhtml('pacientes.html?OPC=I')">Pacientes</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco004.php?SISTEMA=eco')"><a class="solicitud" href="javascript:oPenhtml('eco004.php?SISTEMA=eco')">Usuarios</a></dt>
				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco013.php')"><a class="solicitud" href="javascript:oPenhtml('eco013.php')">Cambio Password</a></dt>

			</dl> 
    </div>
	
<a class="texto15" onmouseover="muestra('menu12');" > <strong>SOLICITUDES</strong></a> 
<div id="menu12" >
			   <dl>
	   				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco010.php')"><a class="solicitud" href="javascript:oPenhtml('eco010.php')">Ingreso Solicitudes</a></dt>
	   				<dt><input name="" type="image" src="ieco/isase402.gif" onClick="javascript:oPenhtml('eco014.php')"><a class="solicitud" href="javascript:oPenhtml('eco014.php')">Liquidación</a></dt>

				</dl> 
	
<a class="texto15" onmouseover="muestra('menu12');" > <strong>EXAMENES</strong></a> 
<div id="menu13" >
			   <dl>
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

				</dl> 
</body>
 <input name="hd_autoriza" type="hidden" value="">
</html>
