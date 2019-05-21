<?php
// Sistema			: CAMELIA
// Programa			: CAM028.PHP
// Descripcion		: Consulta de Colores (por Nombre).
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 23/11/2011

session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Consulta de Colores</title>
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
            var cod = cod1 + ',' + cod2;
			window.open('cam028_i.php?CODIGO=' + cod,'cam028_i','width=750, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
				
			 }
		
		
    		function f_valida(){
			/*----------------*/
//			alert(Form1.cmd_codloc2.value.length);
  				if(Form1.cmd_nomcol2.value.length > 0) {
					if(Form1.cmd_nomcol2.value < Form1.cmd_nomcol1.value ) {
					  alert("Rango Erróneo")
					  }
				 }	  
			}

	    </script>
	    
    <style type="text/css">
	    div.message{ position:absolute; left:0px; top:0px; width:100%; height:100%; background-color:#000; filter:alpha(opacity=20); -moz-opacity: 0.2; opacity: 0.2;}
	    div#myAlert{ position:absolute; left:0px; top:10px; width:100%; text-align:center;}
	    //.myAlert{ position:absolute; left:35%; padding:25px; width:250px; height:150px; background-color:#FFF; border:2px solid #000; margin:auto; text-align:left;}
	    .closeAlert {position:absolute; right:450px; top:-50px; width:70px; height:70px; background-color:#FFF; background:url(ivvpp/ivvpp0020.gif) no-repeat top left;}
    </style>
	    
	</head>

<body bgcolor="#000080" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout">
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="Form1">
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

<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
<?php

$_SESSION['nomcol1_s'] = "";
$_SESSION['nomcol2_s'] = "";

if ($_POST) {
    $_SESSION['nomcol1_s'] = $_POST['cmd_nomcol1'];
    $_SESSION['nomcol2_s'] = $_POST['cmd_nomcol2'];

}
?>
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
			<TR>
				<td vAlign="bottom" width="500">&nbsp;
					<span id="Label1" class="texto18">CONSULTA DE COLORES</span></td>
			</TR>
			<TR>
				<td align="left" width="500" height="6">
					<TABLE class="texto13" id="Table2" cellPadding="0" width="535" border="0">
          <TR> 
						<td style="WIDTH: 110px; HEIGHT: 12px"></td>
						<td style="WIDTH: 224px; HEIGHT: 12px"></td>
						<td style="WIDTH: 70px; HEIGHT: 12px"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 110px; HEIGHT: 3px">Ingrese Nombre Desde</td>
						<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_nomcol1" type="text" id="cmd_nomcol1" class="input-normal"  maxlength="15" style="width:116px;" value="<?php if (isset($_SESSION['nomcol1_s'])){ echo $_SESSION['nomcol1_s']; } ?>" onChange="f_valida()"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 110px; HEIGHT: 3px">Ingrese Nombre Hasta</td>
						<td style="WIDTH: 224px; HEIGHT 3px"><input name="cmd_nomcol2" type="text" id="cmd_nomcol2" class="input-normal" style="width:116px;"  maxlength="15" value="<?php if (isset($_SESSION['nomcol2_s'])){ echo $_SESSION['nomcol2_s']; } ?>" onChange="f_valida()"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" onclick="f_valida()" id="cmd_buscar" class="boton" /></td>
					  </TR>
					  </TABLE>
				</td>
				</TR>
<?php	
if ($_POST) 
{
 if (isset($_POST["cmd_buscar"])) 
    {
    $nomcol1_w = $_POST["cmd_nomcol1"];
	$nomcol2_w = $_POST["cmd_nomcol2"];
/*
	if (strlen(trim($cod2_w)) > 0 )
	   {
		if ($cod2_w < $cod1_w) { 
			echo "<script type=\"text/javascript\">alert('Rango Erróneo')</script>";
			exit();
			}
	   }
*/	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$nomc1_w = STR_PAD(TRIM($nomcol1_w),15,' ');
    $nomc2_w = STR_PAD(TRIM($nomcol2_w),15,'Z');
	$consulta="call cam_psel_colores_3('".$nomc1_w."','".$nomc2_w."')";
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="500" height="145">';
    echo '		<P><table class="link13" cellspacing="0" cellpadding="3" align="center" rules="rows" border="2" id="dgrid" style="border-color:#E7E7FF;border-width:2px;border-style:None;height:20px;width:500px;border-collapse:collapse;">';
	echo '<tr style="color:#000080;background-color:#ffffff;">';
	echo '	<td>Nombre Color</td><td>Código Color</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		echo '<tr style="color:#ffffff;background-color:#000080;">';
//		echo '<td></td><td>'.$row["codloc"].'</td>';
		echo '<td>'.utf8_decode($row["nomcol"]).'</td>';
		echo '<td>'.$row["codcol"].'</td>';

		echo '</tr>';
    	}
		
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table></P>	</td> </TR>';
	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '						align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '							<td style="WIDTH: 124px" align="center" width="124"></td>';
    echo '                          <td align="center"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" onClick="Imprimir_Vtna(&quot;'.$nomc1_w.'&quot;,&quot;'.$nomc2_w.'&quot;)" </td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
//	echo '		</TABLE>';
	

	mysqli_free_result($result);
	mysqli_close($link);

	}
}

?>

</TABLE>

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
