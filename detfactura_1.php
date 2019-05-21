<?php
session_start();
?>

<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php 
if (!$_POST)
{
   $arrRegs = array(); 

}

if (isset($_POST["btnAdd"])) 
{ 
    // recogemos data posteada por el usuario  
    $arr1 = array(); 
    $arr1["prod"] = $_POST["prod"]; 
    $arr1["cant"] = $_POST["cant"]; 
    $arr1["prec"] = $_POST["prec"]; 

    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
	
} 
?> 

<!-- todo el codigo html --> 
 
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" id="Form1">

<table> 
    <tr> 
        <td>Producto</td> 
        <td>Cantidad</td> 
        <td>Precio</td> 
    </tr> 
<?php 
    echo count($arrRegs);
    for ($i = 0; $i < count($arrRegs); $i++) 
    { 
        echo "<tr>"; 
        echo "<td>".$arrRegs[$i]["prod"]."</td>"; 
        echo "<td>".$arrRegs[$i]["cant"]."</td>"; 
        echo "<td>".$arrRegs[$i]["prec"]."</td>"; 
        echo "</tr>"; 
    } 
?> 
    <tr> 
        <td><input type="loQueConvenga" name="prod"></td> 
        <td><input type="loQueConvenga" name="cant"></td> 
        <td><input type="loQueConvenga" name="prec"></td> 
        <td><input type="submit" name="btnAdd" value="Agregar Detalle"></td> 
    </tr> 
</table> 
</form> 
</body>
</html>
