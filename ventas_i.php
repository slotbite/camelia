<?php
// Sistema			: CAMELIA
// Programa			: ventas_i.PHP
// Descripcion		: Imprime Vale de Venta.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 23/05/2012

session_start();

require_once 'admin/config.php';

if (isset($_GET["FPAGO"]) and (!empty( $_GET["FPAGO"] ))) {
   $fpago_w = $_GET["FPAGO"];   
}
else{
  $fpago_w = "1";
}

//grabar datos

    $modo_w = "I";
	$codloc_w  = '10';
	$transa_w  = 2 ;
	$locsep_w  = '0';
	$totpag_w = 0;
	if (isset($_SESSION['totpag_s'])){ $totpag_w = $_SESSION['totpag_s'];}
	$subtot_w = 0;
	$descto_w = 0;
	$fecha_w  = date("d/m/Y");
	$codven_w = "";
	if (isset($_SESSION['codven_s'])){ $codven_w = $_SESSION['codven_s'];}

/*
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$ssql = "INSERT INTO cam_cabventa(cve_codloc,cve_numtra) VALUES ('10',1)";
	$result=mysqli_query($conn,$ssql);
	mysqli_close($conn);
*/
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//		$sql1 = "call cam_pupd_cabventa('".$modo_w."','".$cod_w."','".$nombre_w."','".$direcc_w."','".$ciudad_w."','".$fono1_w."','".$fono2_w."','".$fax_w."','".$jefe_w."','".$email_w."')";
//               cam_pupd_cabventa`(PMODO,PCODLOC,PNUMTRA,PTRANSA,PLOCSEP,PNUMSEP,PSUBTOT,PDESCTO,PTOTAL,PFECTRA,PHORTRA,PACTIVO,PCODVEN,PDESENT,OUT NUMTRA_W )
		$sql1 = "call cam_pupd_cabventa('".$modo_w."','".$codloc_w."',null,".$transa_w.",'".$locsep_w."',0,'".$subtot_w."','".$descto_w."','".$totpag_w."',STR_TO_DATE('".$fecha_w."','%d/%m/%Y'),null,'S','".$codven_w."',null,@cod_w)";

//echo $sql1;
		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
/*			 
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El local ya existe....." ;
				} 
*/				
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();

			}
		else
		   {
		   /*
			echo "<script type=\"text/javascript\">
				alert('El Local: \' $cod_w \' ha sido registrado de manera satisfactoria.');
				</script>";
				*/

   			//rescato el número del vale
			$consulta = "SELECT @cod_w";
			$result   = mysqli_query($link,$consulta);
			$row      = mysqli_fetch_array($result);
			$numtra_w = $row[0];

			mysqli_close($link);
			}	
  		
// graba detalle
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
	    $tipmov_w = 1 ; // 1:venta
        $item = $_SESSION["arrDetalles"][$i]["prod"]; 
		$pro_w = substr($item,0,3);
  	    $art_w = substr($item,3,4);
	    $col_w = substr($item,7,2);
	    $tall_w = substr($item,9,3);
        $precio_w = $_SESSION["arrDetalles"][$i]["prec"]; 

		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
       // cam_pupd_detventa(IN PMODO,PCODLOC,PNUMTRA,PTIPMOV,PCODPRO,PCODART,PCODCOL,PTALLA,PCANTID,PPRECIO) 	
 		$sql1 = "call cam_pupd_detventa('".$modo_w."','".$codloc_w."','".$numtra_w."',".$tipmov_w.",'".$pro_w."','".$art_w."','".$col_w."','".$tall_w."',1,'".$precio_w."')";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar detventa: " . mysqli_errno($link);
  			 echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";
			 mysqli_close($link);
			 exit();
			}
		else
		   {
			mysqli_close($link);
			}	
			
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
 		$sql1 = "call cam_rebaja_inventario('".$codloc_w."','".$pro_w."','".$art_w."','".$col_w."','".$tall_w."',1)";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al rebajar inventario: " . mysqli_errno($link);
  			 echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";
			 mysqli_close($link);
			 exit();
			}
		else
		   {
			mysqli_close($link);
			}	

    } 
// graba forma de pago

		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
 		$sql1 = "call cam_pupd_formpago('".$modo_w."','".$codloc_w."','".$numtra_w."',".$fpago_w.",'".$totpag_w."',null,null)";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar formpago: " . mysqli_errno($link);
  			 echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";
			 mysqli_close($link);
			 exit();
			}
		else
		   {
			mysqli_close($link);
			}	
			

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Imprime Vale de Venta</title>
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			
			function Imprimir_Vtna(cod1,cod2){
			/*-----------------------------------*/
//		    alert(cod1+','+cod2);
            var cod=cod1+','+cod2
			window.open('eco_autoriza.php?PAGINA=' + 'cam023_i.php?CODIGO=' + cod,'cam023_i','width=750, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
				
			 }
		
  		function f_imprimir(){
        /*--------------------*/
			window.print();
			window.close();
			        }

	    </script>
	    
	</head>
<!-- onload="f_imprimir()"
 -->
 <body onload="f_imprimir()">
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1"  >
  <table width="300" border="0" cellspacing="0" cellpadding="0" class="texto11">
    <tr> 
      <td><?php echo '...CAMELIA 1';?></td>
      <td><?php echo date("d/m/Y"). ' ' . date("H:i");?> </td>
    </tr>
    <tr> 
      <td><?php echo '...CONDELL 1411';?></td>
      <td><?php echo 'VENTA: '.$codloc_w.'-'.$numtra_w ; ?> </td>
    </tr>
    <tr> 
      <td></td>
      <td><?php echo 'Vendedor: ' . $codven_w ;?> </td>
    </tr>
    <tr> 
    </tr>
    <tr> 
    </tr>
 </table>
 <p><table width="250" border="0" cellspacing="0" cellpadding="0" class="texto11">
  <tr > <td align="center" ><span id="Label1"  style="text-decoration: underline;">VENTA</span></td>
 </tr>

 <tr>
 </tr>
 <tr align="center">
     <td><?php 
	 switch ($fpago_w) {
		case "1":
			echo 'CONTADO EFECTIVO';
			break;
		case "2":
			echo 'CONTADO DOCUMENTADO';
			break;
		case "3":
			echo 'CHEQUE A FECHA';
			break;
		case "4":
			echo 'CR-CAMELIA';
			break;
		case "5":
			echo 'TARJETAS DE CREDITO';
			break;
		case "6":
			echo 'HABILITADOS';
			break;
		case "7":
			echo 'INSTITUCIONES';
			break;
		case "8":
			echo 'CREDITOS PARTICULARES';
			break;
		case "9":
			echo 'MIXTA';
			break;

}

		  ?> </td>
 </tr>

 </table></p>

<?php	
/*
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
    if (strlen(trim($cod1_w)) == 0 and strlen(trim($cod2_w)) == 0) 
	   {
		$consulta="call cam_psel_locales_2(null,null)";
       }
	elseif (strlen(trim($cod1_w)) == 0 )
	   {
		$consulta="call cam_psel_locales_2(null,'".$cod2_w."')";
       }
	elseif (strlen(trim($cod2_w)) == 0 )
	   {
		$consulta="call cam_psel_locales_2('".$cod1_w."',null)";
		       }
	else
	   {
		$consulta="call cam_psel_locales_2('".$cod1_w."','".$cod2_w."')";
		       }
	   
	$result=mysqli_query($link,$consulta);
*/ 
    echo '<P><table width="250" class="texto10" cellspacing="0" cellpadding="3" rules="rows" border="0" id="dgrid" style="background-color:White;border-width:1px;border-style:None;height:20px;border-collapse:collapse;">';
	 echo '<HR color="000000" >';
    echo '<tr>'; 
	echo '	<th>Artículo</th><th>Precio</th>';
	echo '</tr>';
	 echo '<tr >'; 
  		  echo '<td><HR color="000000" width=100%></HR></td>';
		  echo '<td><HR color="000000" width=100%></HR></td>';
  echo '</tr>';
/*
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr>'; 
		echo '<td>'.$row["codloc"].'</td>';
		echo '<td>'.utf8_decode($row["nombre"]).'</td>';
		echo '<td>'.utf8_decode($row["direcc"]).'</td>';
		echo '<td>'.utf8_decode($row["ciudad"]).'</td>';
		echo '<td>'.$row["fono1"].'-'.$row["fono2"].'</td>';
//		echo '<td>'.$row["fono2"].'</td>';
		echo '<td>'.$row["fax"].'</td>';
		echo '<td>'.utf8_decode($row["jefe"]).'</td>';
		echo '<td>'.$row["email"].'</td>';

		echo '</tr>';
    	}
		
	mysqli_free_result($result);
	mysqli_close($link);
*/

  	    echo '<tr>'; 
		echo '<td>'.'...Salidas'.'</td>';
		echo '<td></td>';
		echo '</tr>';
/*
  	    echo '<tr>'; 
		echo '<td>'.'ADIDAS   1111 CARAMELO 121'.'</td>';
		echo '<td>'.'10.990'.'</td>';

		echo '</tr>';
*/
// graba detalle
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
        $desc2 = $_SESSION["arrDetalles"][$i]["desc2"]; 
        $precio_w = $_SESSION["arrDetalles"][$i]["prec"]; 

  	    echo '<tr>'; 
//		echo '<td>'.'ADIDAS   1111 CARAMELO 121'.'</td>';
		echo '<td>'.'...'.$desc2.'</td>';
		echo '<td>'.$precio_w.'</td>';
		echo '</tr>';

			
    } 


		  echo '<tr >'; 
  		  echo '<td><HR color="000000" width=100%></HR></td>';
		  echo '<td><HR color="000000" width=100%></HR></td>';
  		  echo '</tr>';

  	    echo '<tr>'; 
		echo '<td>'.'...Total Salidas'.'</td>';
		echo '<td>'.$totpag_w.'</td>';
		echo '</tr>';
		
    echo '</table>';
    echo '</table></P>	</td> </TR>';

?>



</form>

</body>
</HTML>
