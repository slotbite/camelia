<?php
// Sistema			: CAMELIA
// Programa			: CAM027_i.PHP
// Descripcion		: Imprime Colores.
// Programador(a) 	: Roxana Ram�rez Vega
// F.Inicio 		: 10/11/2011

session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Imprime Colores</title>
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			
  		function f_imprimir(){
        /*--------------------*/
			window.print()
			        }

	    </script>
	    
	</head>
<?php

$codigo_w  = $_GET["CODIGO"];
$pos1 = strpos($codigo_w, ',');

$cod1_w = substr($_GET["CODIGO"], 0, $pos1) ;
$cod2_w = substr($_GET["CODIGO"], $pos1 + 1, 2) ;
//echo 'cod:' . $codigo_w;
?>

<body onload="f_imprimir()">
    <form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1"  >
<?php
/*
if (!$_POST)
{
	if (!isset($_SESSION['autoriza']) or $_SESSION['autoriza'] <> "SI") 
	  {
		echo "<script type=\"text/javascript\">
				alert('Acceso denegado......');
				</script>";
		exit();			
	  }				
	else
	{ 
		$_SESSION['autoriza'] = "NO";
		if (($_SESSION['tipo'] <> 'ADM') and ($opc2_w <> 'C'))
		{
		echo "<script type=\"text/javascript\">
				alert('Usuario No Tiene Acceso......');
				</script>";
		exit();	
		}

	}  
}
*/
?>
  <table width="300" border="0" cellspacing="0" cellpadding="0" class="texto11">
  <tr>
    <td><?php echo 'CAMELIA CUEROS';?></td>
  </tr>
</table>

 <table align="center"> 
  <tr> <td><span id="Label1" class="texto18_i" >INFORME DE COLORES</span></td>
 </tr>
 </table>
 
 <table class="texto11">
 <tr>
 </tr>
 <tr >
 </tr>
  <tr >
 </tr>
 <tr >
     <td><?php echo 'Fecha: ' . date("d/m/Y");?> </td>
      <td><?php echo 'Hora: ' . date("H:i:s");?> </td>
 </tr>

 </table>

<?php	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
    if (strlen(trim($cod1_w)) == 0 and strlen(trim($cod2_w)) == 0) 
	   {
		$consulta="call cam_psel_colores_2(null,null)";
       }
	elseif (strlen(trim($cod1_w)) == 0 )
	   {
		$consulta="call cam_psel_colores_2(null,'".$cod2_w."')";
       }
	elseif (strlen(trim($cod2_w)) == 0 )
	   {
		$consulta="call cam_psel_colores_2('".$cod1_w."',null)";
		       }
	else
	   {
		$consulta="call cam_psel_colores_2('".$cod1_w."','".$cod2_w."')";
		       }
	   
	$result=mysqli_query($link,$consulta);
 
    echo '<P><table class="texto09" cellspacing="0" cellpadding="3" align="center" rules="rows" border="0" id="dgrid" style="background-color:White;border-width:1px;border-style:None;height:20px;width:500px;border-collapse:collapse;">';
	 echo '<HR color="000000" >';
    echo '<tr>'; 
	echo '	<th>C�digo Color</th><th>Nombre Color</th>';
	echo '</tr>';
			  echo '<tr >'; 
  		  echo '<td><HR color="000000" width=100%></HR></td>';
		  echo '<td><HR color="000000" width=100%></HR></td>';
  		  echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr>'; 
		echo '<td align="center">'.$row["codcol"].'</td>';
		echo '<td align="center">'.utf8_decode($row["nomcol"]).'</td>';

		echo '</tr>';
    	}
		
	mysqli_free_result($result);
	mysqli_close($link);

		  echo '<tr >'; 
  		  echo '<td><HR color="000000" width=100%></HR></td>';
		  echo '<td><HR color="000000" width=100%></HR></td>';
  		  echo '</tr>';
		
    echo '</table>';
    echo '</table></P>	</td> </TR>';

?>


  <div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdCodLoc" id="hdCodLoc" />
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
  </div>

</form>

</body>
</HTML>
