<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
 
<html>
 
<head>
  <title></title>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">

  

</head>
 
<body>
<?php

$file = "vale.lst"; //tu archivo a imprimir
$handle = printer_open("BIXOLO123N SRP-270");
printer_write($handle, $file);
printer_close($handle);
?> 


</body>
 
</html>
