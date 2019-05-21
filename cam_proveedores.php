<?php
// Sistema			: CAMELIA
// Programa			: CAM_proveedores.PHP
// Descripcion		: Seleción de Proveedores.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 01/09/2011

session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Proveedores</title>
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";
		
			function f_cliente(){
			/*-------------------------*/
	//			location.href = iparamt
//	             window.open('eco007.php?RUT=' ,'eco007','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
	              window.open('eco_autoriza.php?PAGINA=' + 'cam007.php?COD=' ,'cam007','width=650, height=350, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();
			
			}
			
		</script>
		<script language="javascript" type="text/javascript" >
		
		    function Remueve_Opcion2(cod,opc)
			//-------------------------
	          {
              if(opc!=='C')
			    {
	          document.Form1.Btt_modific.disabled = false;
			  	}
				
			  document.getElementById('hdCodLoc').Value = cod;
	          }


		  
	    </script>
	    
    <style type="text/css">
	    div.message{ position:absolute; left:0px; top:0px; width:100%; height:100%; background-color:#000; filter:alpha(opacity=20); -moz-opacity: 0.2; opacity: 0.2;}
	    div#myAlert{ position:absolute; left:0px; top:10px; width:100%; text-align:center;}
	    //.myAlert{ position:absolute; left:35%; padding:25px; width:250px; height:150px; background-color:#FFF; border:2px solid #000; margin:auto; text-align:left;}
	    .closeAlert {position:absolute; right:450px; top:-50px; width:70px; height:70px; background-color:#FFF; background:url(ivvpp/ivvpp0020.gif) no-repeat top left;}
    </style>
	    
	</head>
<?php
if (isset($_GET["OPC"]) and (!empty( $_GET["OPC"] ))) {
   $opc_w = $_GET["OPC"];   
}
else{
  $opc_w = "1";
}

$opc2_w = "";  
if ( isset($_GET["OPC2"]) ) {
   $opc2_w = $_GET["OPC2"];   
}
/*
elseif ($_SESSION['tipo'] == 'ADM') {
  $opc2_w = "";  
  }
else {
  $opc2_w = "C";  //solo consulta
}
*/
//echo 'opc '.$opc_w;
?>

<body bgcolor="#993399" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout">
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" id="Form1">

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

<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
<?php

if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
if (!isset($_SESSION["codpro_s"])){ $_SESSION['codpro_s']="";} 
if (!isset($_SESSION["codpro1_s"])){ $_SESSION['codpro1_s']="";} 
if (!isset($_SESSION["codpro2_s"])){ $_SESSION['codpro2_s']="";} 

//$_SESSION['codloc_s'] = "";
/*
if ($_POST) {
/    $_SESSION['codloc_s'] = $_POST['cmd_codloc'];

}
*/
?>
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="530" border="0">
			<TR>
				
    <td vAlign="bottom" width="500">&nbsp; <span id="Label1" class="texto18">PROVEEDORES</span></td>
			</TR>
				<td align="left" width="500" height="6">
				 </td>
				</TR>
<?php	
//echo 'pase';
/* 
 if (isset($_POST["cmd_buscar"])) 
     {
    
	$cod_w = $_POST["cmd_codloc"];
*/	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_proveedores(null,null,null,null)";

	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '	<td vAlign="top" align="center" width="300" height="145">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:300px;border-collapse:collapse;">';
	echo '<tr style="color:#993399;background-color:#ffffff;">';
	echo '	<td>&nbsp;</td><td>Código</td><td>Nombre</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		echo '<tr style="color:#ffffff;background-color:#993399;">';
		echo '<td></td><td>';
		echo '<input type="radio" name="rbnRut" value="'.$row["codpro"].'" onClick="Remueve_Opcion2(&quot;'.$row["codpro"].'&quot;,&quot;'.$opc_w.'&quot;)"/>';
		echo '<label for="rbnRut">'.$row["codpro"].'</label>';
		echo '</td><td>'.utf8_decode($row["nomfa"]).'</td>';
		echo '</tr>';
    	}
		
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table></P>	</td> </TR>';
	echo '			<TR>';
	echo '				<td vAlign="middle" align="center" width="300" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 300px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="300"';
	echo '						align="center" border="0">';
	echo '						<TR>';
	echo '							<td align="center"><input type="submit" name="Btt_aceptar" value="Aceptar" id="Btt_aceptar" class="boton" /></td>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';
	

	mysqli_free_result($result);
	mysqli_close($link);

//	}
/*	
 if (isset($_POST["cmd_agregar"])) 
    {
    $extra = 'eco007.php?RUT=';
    header("Location: $extra");
	}
*/

 if (isset($_POST["Btt_aceptar"])) 
    {
	
//	echo $opc_w ;
//	exit();
	
	 if (isset($_POST['rbnRut'])){ 
//	    echo 'El valor es: <strong>'.$_POST['rbnRut'].'</strong><br />';
		if ($opc_w == "2") {
 			$_SESSION['codloc2_s'] = $_POST['rbnRut'] ;
			$_SESSION['codpro2_s'] = $_POST['rbnRut'] ;

    			}
        else {
			$_SESSION['codpro_s'] = $_POST['rbnRut'] ;
			$_SESSION['codpro1_s'] = $_POST['rbnRut'] ;
			}
		$cod_w = $_POST['rbnRut'];
		
		//Conexion con la base
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		
		//Ejecutamos la sentencia SQL
		$consulta="call cam_psel_proveedores(null,null,null,'".$cod_w."')";
		$result=mysqli_query($link,$consulta);
	
		//Mostramos los r8egistros
		while ($row=mysqli_fetch_array($result))
			{
			if ($opc_w == "2") {
 				$_SESSION['nommed2_s'] = $row["nombre"]." ".$row["apaterno"] ;
    			}
            else {
				$_SESSION['nommed_s'] = $row["nombre"]." ".$row["apaterno"] ;
				$_SESSION['especial_s'] = $row["nEspecial"] ;
				}
			}
	
		mysqli_free_result($result);
		mysqli_close($link);

	}
	
	echo "<script>opener.document.Form1.submit()</script>";
   	echo "<script type=\"text/javascript\"> window.close(); </script>";
	  
	}

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
