<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<h1>Formulario de autenticaci�n</h1>
<?php if ($_GET["errorusuario"]=="si"){?>
<font color="red"><b>Datos incorrectos</b></font>
<?php }else{?>
Introduce tu nombre de usuario y contrase�a
<?php }?>
<form action="autenticacion.php" method="POST">
<table border="0">
<tr><td>Nombre de usuario:</td><td><input name="usuario" size="25" value=""/></td></tr>
<tr><td>Contrase�a:</td><td><input name="contrasena" size="25" type="password"/></td></tr>
<tr><td/>&nbsp;<td><input type="submit" value="Inicio de sesi�n"/></td></tr>
</table>
</form>
Para ingresar, deb�s ingresar <b>usuario</b> en el 1er campo y <b>123</b> en el 2do.

</body>

</html>


