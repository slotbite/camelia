<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
<title>Iluminar Celda</title>
<style type="text/css">

body {text-align:center;}
td.row1 { background-color: #EFEFEF; }
td.row2 { background-color: #AFAFAF;}
th.row1 { background-color: #AFAFAF; }
#menu {margin:auto;text-align:center;width:50%;font-family: Verdana, Arial, Helvetica,
sans-serif; font-size: 7.5pt; border: 2px dashed Black; padding: 1px; background=#FAFAFF;}
#menu a {display:block;width:100%; text-decoration:none;color:#000000}
#menu a:active,#menu a:link,#menu a:visited{background-color: #EFEFEF;}
#menu a:hover{background-color: #FAFAFF;}

</style>
</head>

<body>
<table id="menu" cellpadding='0' cellspacing='0'>
<tr>
<th class="row1" colspan=3>Encabezado</th></tr>

<?php
	$link= array("direccion1&Link1","direccion2&Link2","direccion3&Link3",
	"direccion4&Link4","direccion5&Link5","direccion6&Link6",
	"direccion7&Link7","direccion8&Link8","direccion9&Link9",);
	
	$cambio=0;
	for ($i=0;$i<count($link);$i++)
	{
	$datos=explode("&",$link[$i]);
	if ($cambio==0) { echo "<tr>"; }
?> 
	<td class="row1"><a href="http://<?=$datos[0]?>"><?=$datos[1]?></a></td>
<?php
	$cambio++;
	if ($cambio==3) { echo "</tr>"; $cambio=0;}
	}
?> 
<tr><td class="row2" colspan=3><marquee>Ejemplo de menu</marquee></td></tr>
</table>
</body>
</html>