<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Plantilla en PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3"><div align="right">Logotipo y Titulo</div></td>
</tr>
<tr>
<td width="20%"><p>Menu principal</p>
<ul>
<li><a href="eco001.php?CONCEPTO=AFP">Seccion 1 </a></li>
<li><a href="">Seccion 2 </a></li>
<li><a href="">Seccion 3 </a></li>
</ul></td>
<td colspan="2" valign="top">
<?php
if(empty($sec))
{
include("presentacion.html");
}
else
{
if(file_exists($sec.".php"))
	include($sec.".php");
elseif(file_exists($sec.".html"))
	include($sec.".html");
else
	echo 'Perdón pero la página solicitada no existe';
}
?>
</td>
</tr>
<tr>
<td colspan="3">Pie de pagina </td>
</tr>
</table>
</body>
</html> 