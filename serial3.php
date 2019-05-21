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

	echo "pase";
    if(($handle = @fopen("COM1", "w")) === FALSE){
            die('ERROR:\nNo se puedo Imprimir, Verifique la conexion de la IMPRESORA');
        }

//    fwrite($handle,chr(2).chr(27). "E2".chr(24)."0733547133500".chr(13)."7490       17990      11/10/12".chr(30)."0001".chr(31)."2".chr(23).chr(3));//mensaje
fwrite($handle,chr(2).chr(27). "E2".chr(24)."0733547133500".chr(13)."prueba".chr(30)."0001".chr(31)."2".chr(23).chr(3));
/*
    fwrite($handle,chr(27). chr(64));//REINICIO
    //fwrite($handle, chr(27). chr(112). chr(48));//ABRIR EL CAJON
    fwrite($handle, chr(27). chr(100). chr(0));// SALTO DE CARRO VACIO
    fwrite($handle, chr(27). chr(33). chr(8));// NEGRITA
    fwrite($handle, chr(27). chr(97). chr(1));// CENTRADO
    fwrite($handle,"=================================");
    fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
    fwrite($handle,"IMPRESION DE PRUEBA EN TERMINAL FISCAL");
    fwrite($handle, chr(27). chr(32). chr(0));//ESTACIO ENTRE LETRAS
    fwrite($handle, chr(27). chr(100). chr(0));
    fwrite($handle, chr(29). chr(107). chr(4)); //CODIGO BARRAS
    fwrite($handle, chr(27). chr(100). chr(1));
    fwrite($handle, chr(27). chr(100). chr(1));
    fwrite($handle,"***@xzombiedev***");
    fwrite($handle,"=================================");
    fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
    fwrite($handle, chr(27). chr(100). chr(1));
    fwrite($handle, chr(29). chr(86). chr(49));//CORTA PAPEL
*/
    fclose($handle); // cierra el fichero PRN
    $salida = shell_exec('lpr COM1');
    ?>


</body>
</html>
