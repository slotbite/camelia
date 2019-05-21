<?php
// Sistema			: ECO
// Programa			: ECO009.PHP
// Descripcion		: Administración Exámenes Ecotomografia Abdominal.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 08/11/2010
?>

<?php
ob_start();
session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Busqueda</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
        <script language="JavaScript" src="jeco/eco001.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ieco/ivvpp0020.gif";
		
			function fabre_ventana(iparamt,icoord){
			/*---------------------------*/
				pant_emp = window.open("","", icoord + ",status=yes,scrollbars=yes,resizable=no");
				pant_emp.location = iparamt
				
             window.open('eco007.php?RUT=' ,'eco007','width=650, height=550, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
			function f_cliente(iparamt){
			/*-------------------------*/
	//			location.href = iparamt
//	             window.open('eco008.php?CODIGO=' ,'eco008','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
	              window.open('eco_autoriza.php?PAGINA=' + 'eco008.php?CODIGO=' ,'eco008','width=650, height=550, status= no, resizable= yes, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
	        function f_Modificar(cod){
        /*-----------------------------------*/
//		alert(cod);
//            pant_emp = window.open("","Cuatro","top=150,left=200,width=630,height=550,status=yes,scrollbars=yes,resizable=no");
//	        pant_emp.location = "eco008.php?CODIGO=" + cod;
//            window.open('eco008.php?CODIGO=' +cod ,'eco008','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
              window.open('eco_autoriza.php?PAGINA=' + 'eco008.php?CODIGO=' + cod,'eco008','width=650, height=550, status= no, resizable= yes, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();


			
			      		  }
			
	          function Remueve_Opcion(Marcado,RutPer)

	          {
	          var radio = document.getElementById(Marcado,RutPer) ;
	          document.getElementById('hdRutPer').Value = RutPer;
	          document.Form1.Btt_modific.disabled = false;
			  alert("pase por aki");
//             document.getElementById('Btt_modific').removeAttribute("disabled"); 

	               for(var i=3; i < document.getElementById("hdCantReg").value; i++) {
                       if(i<10)
                       {
                       //alert(radio.id+" ***** "+ document.getElementById("dgrid_ctl02_rbnSeleccionar").id);
                           if(radio.id != document.getElementById("dgrid_ctl0" + i + "_rbnSeleccionar").id)
                           {
                             document.getElementById("dgrid_ctl0" + i + "_rbnSeleccionar").checked=false;
                             //var el = document.getElementById("dgrid_ctl0" + i + "_rbnSeleccionar");
                             //el.parentNode.removeChild(el);
                           }
                       } else {
                           if(radio.id != document.getElementById("dgrid_ctl" + i + "_rbnSeleccionar").id)
                           {
                             document.getElementById("dgrid_ctl" + i + "_rbnSeleccionar").checked=false;
                           }
                       }
                   }
	          }
	
	
		    function Remueve_Opcion2()

	          {
	          document.Form1.Btt_modific.disabled = false;
			  
			   var i
				for (i=0;i<document.Form1.rbnRut.length;i++){
				   if (document.Form1.rbnRut[i].checked)
					  break;
				}
				document.getElementById('hdRutPer').Value = document.Form1.rbnRut[i].value
  //             alert(document.getElementById('hdRutPer').Value);
	          }
		  
	    </script>
	    
    <style type="text/css">
	    div.message{ position:absolute; left:0px; top:0px; width:100%; height:100%; background-color:#000; filter:alpha(opacity=20); -moz-opacity: 0.2; opacity: 0.2;}
	    div#myAlert{ position:absolute; left:0px; top:10px; width:100%; text-align:center;}
	    //.myAlert{ position:absolute; left:35%; padding:25px; width:250px; height:150px; background-color:#FFF; border:2px solid #000; margin:auto; text-align:left;}
	    .closeAlert {position:absolute; right:450px; top:-50px; width:70px; height:70px; background-color:#FFF; background:url(ivvpp/ivvpp0020.gif) no-repeat top left;}
    </style>
	    
	</head>
<body leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="Form1">

<?php
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
	}  
}
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


<script src="/desa_vvpp/WebResource.axd?d=3lC5CkLTZo17F4QZ5jLtcw2&amp;t=633964179561718750" type="text/javascript"></script>

<script language="javascript"> var MsgBoxTipoMensaje; var MsgBoxTextoMensaje; window.attachEvent("onfocus", MsgBoxMostrarMensaje); function MsgBoxMostrarMensaje() { if (MsgBoxTextoMensaje) { if (MsgBoxTextoMensaje != "") { if (MsgBoxTipoMensaje==2) { alert(MsgBoxTextoMensaje); } else {if (confirm(MsgBoxTextoMensaje)) { MsgBoxTextoMensaje="";} else { MsgBoxTextoMensaje="";}} MsgBoxTextoMensaje="";  }}} </script>
<?php
$_SESSION['apellido_s'] = "";
$_SESSION['nombre_s'] = "";
$_SESSION['rut_s'] = "";
$_SESSION['fecha1_s'] = date("d/m/Y");
$_SESSION['fecha2_s'] = date("d/m/Y");

if ($_POST) {
    $_SESSION['apellido_s'] = $_POST['cmd_apellido'];
    $_SESSION['nombre_s'] = $_POST['cmd_nombre'];
    $_SESSION['rut_s'] = $_POST['cmd_rut'];
    $_SESSION['fecha1_s'] = $_POST['cmd_fecha1'];
    $_SESSION['fecha2_s'] = $_POST['cmd_fecha2'];

}
?>
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="730" border="0">
			<TR>
				<td background="ivvpp0002.jpg" style="width: 34px"></td>
				<td vAlign="bottom" width="600">&nbsp;
					<span id="Label1" class="texto18">BUSCAR EXAMEN  Ecotomografia Abdominal</span></td>
			</TR>
			<TR>
				<td background="ivvpp0002.jpg" height="5" style="width: 34px">&nbsp;</td>
				<td width="600" background="ivvpp0005.jpg" height="5">&nbsp;</td>
			</TR>
			<TR>
				<td background="ivvpp0002.jpg" height="6" style="width: 34px"></td>
				<td align="left" width="500" height="6">
					<TABLE class="texto01" id="Table2" cellPadding="0" width="589" border="0">
          <TR> 
						<td width="110" style="WIDTH: 80px; HEIGHT: 12px"></td>
						<td width="246" Style="WIDTH: 224px; HEIGHT: 12px"></td>
						<td width="117" style="WIDTH: 70px; HEIGHT: 12px"></td>
						<td width="106" style="HEIGHT: 12px"></td>
					  </TR>
					  <TR> 
						
            <td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Apellido 
              Paciente </td>
						<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_apellido" type="text" id="cmd_apellido" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['apellido_s'])){ echo $_SESSION['apellido_s']; } ?>"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
					  </TR>
					  <TR> 
						
            <td style="WIDTH: 100px; HEIGHT: 20px">&nbsp;&nbsp;&nbsp;&nbsp; Nombre 
              Paciente </td>
						<td style="WIDTH: 224px; HEIGHT: 20px"><input name="cmd_nombre" type="text" id="cmd_nombre" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['nombre_s'])){ echo $_SESSION['nombre_s']; } ?>"/></td>
						<td style="WIDTH: 70px; HEIGHT: 20px" align="center"></td>
						<td style="HEIGHT: 20px" align="center"></td>
					  </TR>
					  <TR> 
						
            <td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Rut 
              Paciente </td>
						<td style="WIDTH: 224px; HEIGHT: 3px"><input name="cmd_rut" type="text" id="cmd_rut" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['rut_s'])){ echo $_SESSION['rut_s']; } ?>"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
						<td style="HEIGHT: 20px" align="center"></td>
					  </TR>
						
         		 	<td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Fecha Desde </td>
						<td style="WIDTH: 174px; HEIGHT: 3px">
						<input name="cmd_fecha1" type="text" id="cmd_fecha1" class="input-normal" style="width:66px" value="<?php if (isset($_SESSION['fecha1_s'])){ echo $_SESSION['fecha1_s']; } ?>"/>
            			&nbsp; Hasta 
            			<input name="cmd_fecha2" type="text" id="cmd_fecha2" class="input-normal" style="width:66px" value="<?php if (isset($_SESSION['fecha2_s'])){ echo $_SESSION['fecha2_s']; } ?>"/>
						</td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" id="cmd_buscar" class="boton" /></td>
<!--						
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_agregar" value="Agregar" onClick="javascript:f_cliente();return false;" id="cmd_agregar" class="boton" /></td>
-->						
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_agregar" value="Agregar" id="cmd_agregar" class="boton" /></td>

					  </TR>

					  </TABLE>
				</td>
				</TR>
<?php	

if ($_POST) 
{
 if (isset($_POST["cmd_buscar"])) 
    {
    
//	$_SESSION['apellido_s'] = $_POST['cmd_apellido'];
	
	$ape_w = $_POST["cmd_apellido"];
	$nom_w = $_POST["cmd_nombre"];
	$rut_w = $_POST["cmd_rut"];
	$fecha1_w = trim($_POST["cmd_fecha1"]);
	$fecha2_w = trim($_POST["cmd_fecha2"]);

	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//	mysql_select_db(DB_NAME, $link); 

	
	//Ejecutamos la sentencia SQL
//	$consulta="call ECO_PSEL_ECOABDOMINAL(null)";
    if (strlen($fecha1_w) == 0){
		$consulta="call ECO_PSEL_ECOABDOMINAL(null,'".$nom_w."','".$ape_w."','".$rut_w."',null,null)";
        }
    elseif (strlen($fecha2_w) == 0) {
		$consulta="call ECO_PSEL_ECOABDOMINAL(null,'".$nom_w."','".$ape_w."','".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),null)";

	    }
	 else {
		$consulta="call ECO_PSEL_ECOABDOMINAL(null,'".$nom_w."','".$ape_w."','".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),STR_TO_DATE('".$fecha2_w."','%d/%m/%Y'))";

	    }
		
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '<td background="ivvpp/ivvpp0002.jpg" height="145" style="width: 34px"></td>';
	echo '	<td vAlign="top" align="center" width="500" height="145">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:454px;border-collapse:collapse;">';
	echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
	echo '	<td>Código</td><td>Apellidos</td><td>Nombres</td><td>Rut</td><td>Fecha</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
		  echo '<td height="15"> <a id="codigo_h" class="link10" href="javascript:f_Modificar(&quot;'.$row["codigo"].'&quot;)">'.$row["codigo"].'</a> ';
		  echo '</td>';
  		  echo '<td>'.$row["ppaciente"].'</td>';
		  echo '<td>'.$row["npaciente"].'</td>';
  		  echo '<td>'.$row["rutpaciente"].'</td>';
		  echo '<td>'.$row["fecha"].'</td>';
		  echo '</tr>';
    	}
		
	echo '<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">';
	echo '	<td colspan="4"><span></span></td>	</tr>';
    echo '</table></P>	</td> </TR>';
	echo '			<TR>';
	echo '				<td background="ivvpp/ivvpp0002.jpg" height="10" style="width: 34px"></td>';
	echo '				<td vAlign="middle" align="center" width="500" height="10">';
	echo '					<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="475"';
	echo '						align="center" border="0">';
	echo '						<TR>';
	echo '							<td style="WIDTH: 173px" align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onclick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>';
//	echo '							<td style="WIDTH: 124px" align="center" width="124"><input type="submit" name="Btt_modific" value="Modificar" id="Btt_modific" disabled="disabled" class="boton" onClick="Modificar_Vtna();return false;" /></td>';
//	echo '							<td align="center"><input type="submit" name="Btt_aceptar" value="Aceptar" id="Btt_aceptar" class="boton" /></td>';
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';
	

	mysqli_free_result($result);
	mysqli_close($link);

	}
 if (isset($_POST["cmd_agregar"])) 
// if(isset($cmd_agregar)) 
    {
//	 include ("eco003.php"); 
    $extra = 'eco_autoriza.php?PAGINA=' . 'eco008.php?CODIGO=' ;
		
    header("Location: $extra");
	ob_end_flush();
	}

}

?>
</TABLE>
  <div>
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
    <input type="hidden" name="hdRutPer" id="hdRutPer" />
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
  </div>

</form>

</body>
</HTML>
