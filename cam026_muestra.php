<?php
// Sistema			: CAMELIA
// Programa			: CAM026_muestra.PHP
// Descripcion		: Buscador de Art�culos por ango de c�digos.
// Programador(a) 	: Roxana Ram�rez Vega
// F.Inicio 		: 08/11/2011

// iniciamos sesiones

session_start();

require_once 'admin/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
	<head><title>Busqueda de Art�culos</title>
		<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
		
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>  
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			function fabre_ventana(iparamt,icoord){
			/*---------------------------*/
				pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
				pant_emp.location = iparamt
				
             window.open('cam003.php?COD=' ,'cam003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
			function f_cliente(iparamt){
			/*-------------------------*/
	             window.open('eco_autoriza.php?PAGINA=' + 'cam003.php?COD=' ,'cam003','width=600, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=70, left=150').focus();

			}
			
			function Imprimir_Vtna(cod1,cod2){
			/*-----------------------------------*/
//		    alert(cod1+','+cod2);
            var cod = cod1 + ',' + cod2;
//			window.open('eco_autoriza.php?PAGINA=' + 'cam024_i.php?CODIGO=' + cod,'cam024_i','width=750, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			window.open('cam024_i.php?CODIGO=' + cod,'cam024_i','width=750, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
			
			 }

			function f_error(){
			/*----------------*/
				if(Form1.HD_error.value.length > 1 ) {
				  if(Form1.HD_error.value == "UPDATE" ) {
				     alert("La persona seleccionada no registra fecha de nacimiento...")
				     Form1.Btt_modific.onclick()
				  } else {
    				  alert(Form1.HD_error.value)
				  }
                  Form1.HD_error.value = ''
				}
			}
			
		    function Remueve_Opcion2(cod,opc)
			/*-------------------------*/
	          {
//			  alert(opc);
			
              if(opc!=='C')
			    {
	          document.Form1.Btt_modific.disabled = false;
  	          document.Form1.Btt_eliminar.disabled = false;

			  	}
			  document.getElementById('hdCodPro').Value = cod;
	          }
		  
	    </script>
	    
	</head>
<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >

<form name="Form1" method="post"  id="Form1">
<?php
if ( isset($_GET["p�gina"]) ) {
   $p�gina = $_GET["p�gina"];   
}
/*
if (!$_POST)
{
	if (!isset($_SESSION['autoriza']) or $_SESSION['autoriza'] <> "SI") 
	  {
		echo "<script type=\"text/javascript\">
				alert('Acceso denegado......');
				</scipt>";
		exit();			
	  }				
	else
	{ 
		$_SESSION['autoriza'] = "NO";
		
		if (($_SESSION['tipo'] <> 'ADM') and ($opc_w <> 'C')) 
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
<script type="text/javascript">
<!-- 
var theForm = document.forms['Form1'];
if (!theForm) {
    theForm = document.Form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
// -->
</script>


<?php

    $codpro1_w = $_SESSION['codpro1_s'];
    $codpro2_w = $_SESSION['codpro2_s'];
    $codart1_w = $_SESSION['codart1_s'];
    $codart2_w = $_SESSION['codart2_s'];

    $registros = 20;
	if (!isset($p�gina)) {
 		$inicio = 0;
   		$p�gina = 1;
		}
	else {
   		$inicio = ($p�gina - 1) * $registros;
		}

//echo $opc_w;
//echo $p�gina;

	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call CAM_PSEL_ARTICULOS_2('".$codpro1_w."','".$codpro2_w."','".$codart1_w."','".$codart2_w."')";
	$result = mysqli_query($link,$consulta);

//echo $consulta;
	
	$total_registros = mysqli_num_rows($result);
	
	$codp1_w = STR_PAD(TRIM($codpro1_w),3,' ');
    $codp2_w = STR_PAD(TRIM($codpro2_w),3,'Z');
	$coda1_w = STR_PAD(TRIM($codart1_w),4,' ');
    $coda2_w = STR_PAD(TRIM($codart2_w),4,'Z');

//echo $cod1_w ;
//echo $cod2_w ;
/*
	$select_w = "Select pro_rutpro,pro_nomfa,pro_rasoc,pro_codpro,pro_direcc,pro_comuna,pro_ciudad,pro_fono,pro_fax,pro_vendedor From cam_proveedores
           Where pro_codpro >= '$codp1_w'
		   And pro_codpro <= '$codp2_w'
           Order By pro_codpro
           LIMIT $inicio, $registros"; 
*/		   
		   
	$select_w = "Select art_codpro,pro_nomfa,art_codart,art_nomart   
          From cam_articulos  
          Left Join cam_proveedores  
            On art_codpro = pro_codpro 
         Where art_codpro   >= '$codp1_w'
           And art_codpro   <= '$codp2_w'
           And art_codart   >= '$coda1_w'
           And art_codart   <= '$coda2_w'
        Order By art_codpro,art_codart 
		LIMIT $inicio, $registros"; 
	
//echo $select_w;
		   
//	$result = mysqli_query("SELECT * FROM art�culos WHERE visible = 1 ORDER BY fecha DESC LIMIT $inicio, $registros");
	mysqli_free_result($result);
	mysqli_close($link);
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	$result = mysqli_query($link,$select_w);
	$total_p�ginas = ceil($total_registros / $registros);
		
	echo '<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="500" border="0">';
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="500" height="145">';
    echo '		<P><table class="link13" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:500px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
	echo '	<td>C�d.Prov.</td></td><td>Nombre Proveedor</td><td>Cod.Art.</td><td>Nombre Art�culo</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
//		echo '<tr align="left" style="background-color:#F7F7F7;" >';
		echo '<tr style="color:#ffffff;background-color:#000080;">';
		echo '<td>'.$row["art_codpro"].'</td>';
		echo '<td>'.utf8_decode($row["pro_nomfa"]).'</td>';
		echo '<td>'.$row["art_codart"].'</td>';
		echo '<td>'.utf8_decode($row["art_nomart"]).'</td>';
		echo '</tr>';
    	}
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table>';
	echo '</P>	</td> </TR>';
	
	echo '<TR>';
	echo '<td vAlign="middle" align="center" width="500" height="10">';

	if(($p�gina - 1) > 0) {
     echo "<a href='eco_autoriza.php?PAGINA=cam026_muestra.php?p�gina=".($p�gina-1)."'>< Anterior</a> ";
	}
	for ($i=1; $i<=$total_p�ginas; $i++){
 	  if ($p�gina == $i) {
    	  echo "<b>".$p�gina."</b> ";
		} 
	  else {
		  echo "<a href='eco_autoriza.php?PAGINA=cam026_muestra.php?p�gina=$i'>$i</a> ";
		}
    }		
	if(($p�gina + 1)<=$total_p�ginas) {
		$destino_w = "eco_autoriza.php?PAGINA=cam026_muestra.php?p�gina=".($p�gina+1);
	   	echo " <a target='mainFrame' href='".$destino_w."'>Siguiente ></a>;";
	}
	
	echo '			</TR></td>';
	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '					align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '							<td style="WIDTH: 124px" align="center" width="124"></td>';
    echo '                          <td align="center"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" onClick="Imprimir_Vtna(&quot;'.$codpro1_w.'&quot;,&quot;'.$codpro2_w.'&quot;)" </td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';

  
	mysqli_free_result($result);
	mysqli_close($link);


?>

<div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdCodPro" id="hdCodPro"  />
    <input type="hidden" name="hdNomPer" id="hdNomPer" />

</div>
</form>


</body>
</HTML>
