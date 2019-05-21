<?php
// Sistema			: ECO
// Programa			: ECO010.PHP
// Descripcion		: Administración Solicitudes de Exámenes.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 11/11/2010
?>

<?php
session_start();

require_once 'admin/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
				
             window.open('eco007.php?RUT=' ,'eco007','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
			function f_cliente(iparamt){
			/*-------------------------*/
	//			location.href = iparamt
//	             window.open('eco011.php?CODIGO=' ,'eco008','width=650, height=550, status= no, resizable= yes, menubar=yes, scrollbars=yes, location=no, top=150, left=220').focus();
	              window.open('eco_autoriza.php?PAGINA=' + 'eco011.php?CODIGO=' ,'eco011','width=600, height=450, status= no, resizable=no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
	        function f_Modificar(cod){
        /*-----------------------------------*/
//            pant_emp = window.open("","Cuatro","top=150,left=200,width=630,height=550,status=yes,scrollbars=yes,resizable=no");
//	        pant_emp.location = "eco011.php?CODIGO=" + cod;

             window.open('eco_autoriza.php?PAGINA=' + 'eco011.php?CODIGO=' + cod ,'eco011','width=500, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			
			      		  }
			 function f_Eliminar(cdes){
        /*-----------------------------------*/
             
			  elim = confirm( "¿desea eliminar solicitud " + cdes + " ?" ) ;
			  if (elim)
			  	{ 
				  document.Form1.hdCodigo.value = cdes;
				  document.Form1.hdElimina.value = "E";
				} 
			  else
			  	 { 
				  document.Form1.hdElimina.value = "";
				}
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
		if ($_SESSION['tipo'] <> 'ADM')
		{
		echo "<script type=\"text/javascript\">
				alert('Usuario No Tiene Acceso......');
				</script>";
		exit();	
		}

	}  
}

$_SESSION['apellido_s'] = "";
$_SESSION['nombre_s'] = "";
$_SESSION['rut_s'] = "";
// Restamos 7 días
$fec_w = date("d/m/Y",time()-(7*24*60*60));
$_SESSION['fecha1_s'] = $fec_w;
$_SESSION['fecha2_s'] = date("d/m/Y");

if ($_POST) {
    $_SESSION['apellido_s'] = $_POST['cmd_apellido'];
    $_SESSION['nombre_s'] = $_POST['cmd_nombre'];
    $_SESSION['rut_s'] = $_POST['cmd_rut'];
    $_SESSION['fecha1_s'] = $_POST['cmd_fecha1'];
    $_SESSION['fecha2_s'] = $_POST['cmd_fecha2'];

}

if (isset($_POST['ddl_medicos']))
{
	$medico_w  = $_POST['ddl_medicos'];
	}
else
{
	$medico_w  = "";
	}
	
if (isset($_POST['ddl_prevision'])){
	$prevision_w  = $_POST['ddl_prevision'];
	}
else{
	$prevision_w  = "";
	}
	
if (isset($_POST['ddl_examen'])){
	$examen_w  = $_POST['ddl_examen'];
	}
else{
	$examen_w  = "";
	}

//llena ddl medicos

	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query="call ECO_PSEL_MEDICOS(null,null,null)";
	
	$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);
	
	$lst_medicos="<select name='ddl_medicos' id='ddl_medicos' class='input-normal'>\n<option value='0' selected>Médicos</option>";
	
	while($registro=mysqli_fetch_array($r))
	{    
//	   $lst_medicos.="\n<option value='".$registro[0]."'>".$registro[2]." ".$registro[3]." ".$registro[1]."</option>";
 		if ($registro[0] == $medico_w)
	      {
		   $lst_medicos.="\n<option selected='selected' value='".$registro[0]."'>".$registro[2]." ".$registro[3]." ".$registro[1]."</option>";
          }
		  else
		  {
           $lst_medicos.="\n<option value='".$registro[0]."'>".$registro[2]." ".$registro[3]." ".$registro[1]."</option>";
		
		   }
	}
	
	$lst_medicos.="\n</select>";
	
	mysqli_close($link);

//llena ddl prevision

$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

$query="call ECO_PSEL_DESCRIPCIONES(null,'PREVISION','S')";

$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);

$lst_prevision="<select name='ddl_prevision' id='ddl_prevision' class='input-normal'>\n<option value='0' selected>Prevision</option>";


while($registro=mysqli_fetch_array($r))
{    
	   if ($registro[0] == $prevision_w)
	      {
		   $lst_prevision.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_prevision.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		
		   }
}

$lst_prevision.="\n</select>";

mysqli_close($link);

//llena ddl examen

$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$query="call ECO_PSEL_DESCRIPCIONES(null,'EXAMEN','S')";
$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);
$lst_examen="<select name='ddl_examen' id='ddl_examen' class='input-normal'>\n<option value='0' selected>Exámen</option>";

while($registro=mysqli_fetch_array($r))
{    
	   if ($registro[0] == $examen_w)
	      {
		   $lst_examen.="\n<option selected='selected' value='".$registro[0]."'>".$registro[1]."</option>";
          }
		  else
		  {
            $lst_examen.="\n<option value='".$registro[0]."'>".$registro[1]."</option>";
		
		   }
}

$lst_examen.="\n</select>";

mysqli_close($link);

?>
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="630" border="0">

			<TR>
				<td background="ivvpp0002.jpg" style="width: 34px"></td>
				<td vAlign="bottom" width="500">&nbsp;
					<span id="Label1" class="texto18">BUSCAR SOLICITUD DE EXAMEN</span></td>
			</TR>
			<TR>
				<td background="ivvpp0002.jpg" height="5" style="width: 34px">&nbsp;</td>
				<td width="500" background="ivvpp0005.jpg" height="5">&nbsp;</td>
			</TR>
			<TR>
				<td background="ivvpp0002.jpg" height="6" style="width: 34px"></td>
				<td align="left" width="500" height="6">
					<TABLE class="texto01" id="Table2" cellPadding="0" width="668" border="0">
        <TR> 
						<td width="118" style="WIDTH: 100px; HEIGHT: 12px"></td>
						<td width="254" style="WIDTH: 204px; HEIGHT: 12px"></td>
						<td width="125" style="WIDTH: 70px; HEIGHT: 12px"></td>
						<td width="161" style="HEIGHT: 12px"></td>
					  </TR>
					  <TR> 
						
          <td style="WIDTH: 150px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Apellido 
            Paciente </td>
						<td style="WIDTH: 204px; HEIGHT: 3px"><input name="cmd_apellido" type="text" id="cmd_apellido" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['apellido_s'])){ echo $_SESSION['apellido_s']; } ?>"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
						<td style="HEIGHT: 3px" align="center"></td>
					  </TR>
					  <TR> 
						
          <td style="WIDTH: 150px; HEIGHT: 20px">&nbsp;&nbsp;&nbsp;&nbsp; Nombre 
            Paciente </td>
						
            <td style="WIDTH: 204px; HEIGHT: 20px"><input name="cmd_nombre" type="text" id="cmd_nombre" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['nombre_s'])){ echo $_SESSION['nombre_s']; } ?>"/></td>
						<td style="WIDTH: 70px; HEIGHT: 20px" align="center"></td>
						<td style="HEIGHT: 20px" align="center"></td>
					  </TR>
					  <TR> 
						
          <td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Rut Paciente</td>
						<td style="WIDTH: 204px; HEIGHT: 3px"><input name="cmd_rut" type="text" id="cmd_rut" class="input-normal" style="width:216px;" value="<?php if (isset($_SESSION['rut_s'])){ echo $_SESSION['rut_s']; } ?>"/></td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
						<td style="HEIGHT: 20px" align="center"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Medico Efectua</td>
						<td style="WIDTH: 204px; HEIGHT: 3px">
						<?php
						  echo $lst_medicos;
						  ?>
						</td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
						<td style="HEIGHT: 20px" align="center"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Previsión</td>
						<td style="WIDTH: 204px; HEIGHT: 3px">
						<?php
						  echo $lst_prevision;
						  ?>
						</td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
						<td style="HEIGHT: 20px" align="center"></td>
					  </TR>
					  <TR> 
						<td style="WIDTH: 100px; HEIGHT: 3px">&nbsp;&nbsp;&nbsp;&nbsp; Exámen</td>
						<td style="WIDTH: 204px; HEIGHT: 3px">
						<?php
						  echo $lst_examen;
						  ?>
						</td>
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"></td>
						<td style="HEIGHT: 20px" align="center"></td>
					  </TR>
         		 	<td style="WIDTH: 100px; HEIGHT: 3px">&nbsp; &nbsp;&nbsp;&nbsp;Fecha Desde </td>
						<td style="HEIGHT: 3px">
						<input name="cmd_fecha1" type="text" id="cmd_fecha1" class="input-normal" style="width:66px" value="<?php if (isset($_SESSION['fecha1_s'])){ echo $_SESSION['fecha1_s']; } ?>"/>
            			&nbsp; Hasta 
            			<input name="cmd_fecha2" type="text" id="cmd_fecha2" class="input-normal" style="width:66px" value="<?php if (isset($_SESSION['fecha2_s'])){ echo $_SESSION['fecha2_s']; } ?>"/>

						</td>
									
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" id="cmd_buscar" class="boton" /></td>
						<td style="WIDTH: 70px;HEIGHT: 3px" align="center"><input type="submit" name="cmd_agregar" value="Agregar" onClick="javascript:f_cliente();return false;" id="cmd_agregar" class="boton" /></td>
					  </TR>

					  </TABLE>
				</td>
				</TR>
				
<?php	

if ($_POST) 
{
   if ($_POST["hdElimina"] == "E")
     {
	 
	    $codigo_w = $_POST["hdCodigo"];
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$sql1 = "call ECO_PUPD_SOLICITUDES('E','".$codigo_w."',null,null,";
        $sql1 = $sql1."null,null,null,null,null,null,null,null,null,null,null,@cod_w)";
		
        $query = mysqli_query($link,$sql1);
		if ( !$query ) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al eliminar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
					
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();

			}
		else
		   {
			echo "<script type=\"text/javascript\">
				alert('La Solicitud ha sido eliminada.');
				</script>";
			
		    mysqli_close($link);
			
			 }
	  
	  }
	  
 if (isset($_POST["cmd_buscar"])) 
    {
    
//	$_SESSION['apellido_s'] = $_POST['cmd_apellido'];
	
	$ape_w = $_POST["cmd_apellido"];
	$nom_w = $_POST["cmd_nombre"];
	$rut_w = $_POST["cmd_rut"];
	$fecha1_w = trim($_POST["cmd_fecha1"]);
	$fecha2_w = trim($_POST["cmd_fecha2"]);
	$rutmed_w    = $_POST["ddl_medicos"];
	$prevision_w = $_POST["ddl_prevision"];
	$examen_w    = $_POST["ddl_examen"];

	if ($rutmed_w == "0") {
		$rutmed_w = NULL;
		} 
	if ($prevision_w == "0") {
		$prevision_w = 'null';
		} 
	if ($examen_w == "0") {
		$examen_w = 'null';
		} 
		
// Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
    if (strlen($fecha1_w) == 0){
		$consulta="call ECO_PSEL_SOLICITUDES(null,'".$nom_w."','".$ape_w."','".$rut_w."',null,null,'".$rutmed_w."',".$prevision_w.",".$examen_w.")";
        }
    elseif (strlen($fecha2_w) == 0) {
		$consulta="call ECO_PSEL_SOLICITUDES(null,'".$nom_w."','".$ape_w."','".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),null,'".$rutmed_w."',".$prevision_w.",".$examen_w.")";

	    }
	 else {
		$consulta="call ECO_PSEL_SOLICITUDES(null,'".$nom_w."','".$ape_w."','".$rut_w."',STR_TO_DATE('".$fecha1_w."','%d/%m/%Y'),STR_TO_DATE('".$fecha2_w."','%d/%m/%Y'),'".$rutmed_w."',".$prevision_w.",".$examen_w.")";

	    }
//echo $consulta;
//exit();
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '<td background="ivvpp/ivvpp0002.jpg" height="145" style="width: 34px"></td>';
	echo '	<td vAlign="top" align="center" width="700" height="145">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:700px;border-collapse:collapse;">';
	echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
	echo '	<td>Código</td><td>Apellidos</td><td>Nombres</td><td>Rut</td><td>Fecha</td><td>Efectua</td><td>Prevision</td><td>Examen</td><td>Total</td><td></td>';
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
		  echo '<td>'.$row["epmedico"].' '.$row["emmedico"].' '.$row["enmedico"].'</td>';
  		  echo '<td>'.$row["nPrevision"].'</td>';
		  echo '<td>'.$row["nexamen"].'</td>';
  		  echo '<td>'.number_format($row["vtotexamen"],0, ',', '.').'</td>';
		  if ($row["codliq"] <> NULL)
		  {
	  		  echo '<td align="center"> <img src="ieco/isase462.jpg" width="15" height="15" border="0" ></td> ';
		  }
		  else
		  {
   			  echo '<td align="center"> <input name="ImgEliminar" id="ImgEliminar" type="image" src="isase427.gif" width="15" height="15" border="0" onclick="f_Eliminar(&quot;'.$row["codigo"].'&quot;)"></td> ';
		  }
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
	echo '						</TR>	</TABLE>';
	echo '				</td>';
	echo '			</TR>';
	echo '		</TABLE>';
	
	mysqli_free_result($result);
	mysqli_close($link);

	}

}

?>
</TABLE>
  <div>
  	<input type="hidden" name="hdElimina" id="hdElimina" value="" />
	<input type="hidden" name="hdCodigo" id="hdCodigo" value="" />
  
    <input type="hidden" name="HD_error" id="HD_error" />
    <input type="hidden" name="hdCantReg" id="hdCantReg" value="7" />
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
  </div>

</form>

</body>
</HTML>
