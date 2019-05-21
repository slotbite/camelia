<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="59%" border="1">
<?php
 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
  <tr> 
    <td colspan="2" align="center">Ingreso al Sistema</td>
  </tr>
  <tr>
    <td width="21%">Usuario</td>
    <td width="79%">
        <input type="text" name="txtUser">
      </td>
  </tr>
  <tr>
    <td>Contrase&ntilde;a</td>
    <td><input type="text" name="txtLogin"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td><input name="btnSummit" type="submit" value="Enviar"></td>
  </tr>
  </form>
 <?php
 } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $user = $_POST['txtUser'];
   $pass = $_POST['txtLogin'];
   if ( $user <> 'Gabriel') {
   	echo  $user . 'no existe...';
   } else {
    if ( $pass <> '123') {
   	echo  $pass . 'incorrecta...' ;
   } else {
   printf('Acceso permitido...');
   }}
 } else {
   die("This script only works with GET and POST requests.");
 }
?>
</table>
</body>
</html>
