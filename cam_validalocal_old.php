<?php
// Sistema			: CAMELIA
// Programa			: CAM_valida.PHP
// Descripcion		: Validación de Local.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 30/03/2012

session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Valida Locales</title>
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
			
			function Modificar_Vtna()
	          {
 	              window.open('eco_autoriza.php?PAGINA=' + 'cam007.php?COD=' + document.getElementById('hdCodLoc').Value ,'cam007','width=650, height=350, status= no, resizable= yes, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();
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

if ( isset($_GET["OPC2"]) ) {
   $opc2_w = $_GET["OPC2"];   
}
elseif ($_SESSION['tipo'] == 'ADM') {
  $opc2_w = "";  
  }
else {
  $opc2_w = "C";  //solo consulta
}
?>

<!-- <body bgcolor="#993399" text="#ffffff" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout">
 -->
<body> 
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

<!-- <script src="/desa_vvpp/WebResource.axd?d=3lC5CkLTZo17F4QZ5jLtcw2&amp;t=633964179561718750" type="text/javascript"></script>
 -->
<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
<?php

if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 

//$_SESSION['codloc_s'] = "";
/*
if ($_POST) {
/    $_SESSION['codloc_s'] = $_POST['cmd_codloc'];

}
*/
?>
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
	$consulta="call cam_psel_locales('".$_SESSION['codloc_s']."')";

	$result=mysqli_query($link,$consulta);
	

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
			$_SESSION['nomloc_s']=utf8_decode($row["nombre"]);

    	}
		

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

	
	echo "<script>opener.document.Form1.submit()</script>";
//   	echo "<script type=\"text/javascript\"> window.close(); </script>";
	  

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
