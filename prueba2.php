<html>
<head>
<title>Me llamo a mi mismo...</title>
</head>

<body>
<?php
if (!$_POST) {
?>
<form action="prueba2.php" method="post">
Nombre: <input type="text" name="nombre" size="30">
<br>
Empresa: <input type="text" name="empresa" size="30">
<br>
Telefono: <input type="text" name="telefono" size=14 value="+34 " >
<br>
<input type="submit" value="Enviar">
</form> 
<?php 
} else {
$valido=1;
Foreach ($_POST as $clave=>$valor) {
if(!$valor) $valido=0;
}
if ($valido==1) {
echo "<br>Su nombre: " . $_POST["nombre"];
echo "<br>Su empresa: " . $_POST["empresa"];
echo "<br>Su Teléfono: " . $_POST["telefono"]; 
} else { 
echo "Faltan Datos en el Formulario, Vuelva a Intentarlo.";
?>
<a href ="prueba2.php">Atras</a>
<?php 
}
}
?>
</body>
</html>