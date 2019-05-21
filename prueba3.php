<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php

 if (! $_POST){
	 $_POST["rr"] = "aa";
	 }
  if (isset($_POST['rr'])) {
// No es vacío, por lo que procedemos a imprimir o cualquier cosa
// que se haga dentro de un formulario enviado
    $_POST['dddd'] = $_POST['rr'];
  }

// Rescatando o revisando que el formulario enviado no sea vacío
  if (isset($_POST['dddd']) AND !empty($_POST['dddd'])) {
// No es vacío, por lo que procedemos a imprimir o cualquier cosa
// que se haga dentro de un formulario enviado
    echo 'El valor es: <strong>'.$_POST['dddd'].'</strong><br />';
  }
?>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
<?php
  
// Imprimo la caja que se verá públicamente con su nombre único
  echo '<input type="text" name="rr"  />';
// Imprimo un elemento de tipo hidden con valor == $nombre
  echo '<input type="hidden" name="dddd" value="'.$_POST["rr"].'" />';
// Siempre es bueno desocupar la mayor cantidad de memoria posible
  unset($nombre);
?>
<br /><input type="submit" value="Aceptar" />
</form>
</body>
</html>
