<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
 // La siguiente línea ejecutará una orden en DOS. Esto solo debe ejecutarse una vez.
 // Las comillas hacen que lo ejecute Windows directamente
 `mode com1: BAUD=9600 PARITY=E data=7 stop=1`;
 
 //Abrimos el puerto com1
 $fp = fopen ("COM1:", "w+");
 if (!$fp) {
 echo "Error al abrir COM1.";
 } else {
// $datos= escapeshellcmd($_REQUEST["datos"]);
 $datos= 'hola';
 fputs ($fp, $datos );
 fclose ($fp);
 }
?>

</body>
</html>
