<?php
// Sistema			: ECO
// Programa			: ECO046.PHP
// Descripcion		: Administración Liquidaciones.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 10/02/2011
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
	              window.open('eco_autoriza.php?PAGINA=' + 'eco014.php?CODIGO=' ,'eco014','width=800, height=750, status= no, resizable=no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			}
			
	        function f_Modificar(cod){
        /*-----------------------------------*/

             window.open('eco_autoriza.php?PAGINA=' + 'eco047.php?CODIGO=' + cod ,'eco047','width=800, height=750, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();

			
			      		  }
			 function f_Eliminar(cdes){
        /*-----------------------------------*/
             
			  elim = confirm( "¿desea eliminar liquidacion " + cdes + " ?" ) ;
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

	               for(var i=3; i < document.getElementById("hdCantReg").value; i++) {
                       if(i<10)
                       {
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
/*
// Restamos 7 días
$fec_w = date("d/m/Y",time()-(7*24*60*60));
$_SESSION['fecha1_s'] = $fec_w;
$_SESSION['fecha2_s'] = date("d/m/Y");
*/
if (isset($_POST['ddl_medicos']))
{
	$medico_w  = $_POST['ddl_medicos'];
	}
else
{
	$medico_w  = "";
	}
	
//llena ddl medicos

	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$query="call ECO_PSEL_MEDICOS(null,null,null)";
	
	$r=mysqli_query($link,$query) or die("No se pudo ejecutar la consulta ".$query);
	
	$lst_medicos="<select name='ddl_medicos' id='ddl_medicos' class='input-normal'>";
	
	while($registro=mysqli_fetch_array($r))
	{    
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

if (isset($_POST['DDL_mes']))
{
	$mes_w  = $_POST['DDL_mes'];
	}
else
{
//	$mes_w  = "";
	$mes_w  = date("n");

	}
	//llena ddl mes
	
	$cont_w = 1;
	$nmes_w = "";
	$lst_mes = "<select name='DDL_mes' id='DDL_mes' class='input-normal'>\n<option selected>Mes</option>";
	
	while($cont_w <= 12)
	{	switch ($cont_w) {
		case 1:
			$nmes_w = "Enero";
			break;
		case 2:
			$nmes_w = "Febrero";
			break;
		case 3:
			$nmes_w = "Marzo";
			break;
		case 4:
			$nmes_w = "Abril";
			break;
		case 5:
			$nmes_w = "Mayo";
			break;
		case 6:
			$nmes_w = "Junio";
			break;
		case 7:
			$nmes_w = "Julio";
			break;
		case 8:
			$nmes_w = "Agosto";
			break;
		case 9:
			$nmes_w = "Septiembre";
			break;
		case 10:
			$nmes_w = "Octubre";
			break;
		case 11:
			$nmes_w = "Noviembre";
			break;
		case 12:
			$nmes_w = "Diciembre";
			break;

	}
	  if ( $cont_w == $mes_w )
		  {
		   $lst_mes.="\n<option selected='selected' value='".$cont_w."'>".$nmes_w."</option>";
		   }
	   else
		  { 
		  $lst_mes.="\n<option value='".$cont_w."'>".$nmes_w."</option>";
		   }
			  
	   $cont_w ++;
	}
	
	$lst_mes.="\n</select>";


if (isset($_POST['DDL_anno']))
{
	$ano_w  = $_POST['DDL_anno'];
	}
else
{
//	$ano_w  = "";
	$ano_w  = date("Y");

	}
	//llena ddl anno
	
	$cont_w = date ("Y") - 2;
	$lst_ano="<select name='DDL_anno' id='DDL_anno' class='input-normal'>\n<option selected>Año</option>";
	
	while($cont_w <= date ("Y"))
				
	  { if ( $cont_w == $ano_w )
			  {
			   $lst_ano.="\n<option selected='selected' value='".$cont_w."'>".$cont_w."</option>";
			   }
		   else
			  { 
			  $lst_ano.="\n<option value='".$cont_w."'>".$cont_w."</option>";
			   }
										
		$cont_w ++;
	  }
	
	$lst_ano.="\n</select>";
?>
		<TABLE id="Table1" cellSpacing="0" cellPadding="0" width="630" border="0">

			<TR>
				<td background="ivvpp0002.jpg" style="width: 34px"></td>
				<td vAlign="bottom" width="500">&nbsp;
					<span id="Label1" class="texto18">BUSCAR LIQUIDACION APROBADA</span></td>
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
         		 	
            <td style="WIDTH: 100px; HEIGHT: 3px">&nbsp; &nbsp;&nbsp;&nbsp;Mes 
              / Año</td>
						<td style="HEIGHT: 3px">
						<?php
						  echo $lst_mes;
  						  echo $lst_ano;
						  ?>
						</td>
									
						<td style="WIDTH: 70px; HEIGHT: 3px" align="center"><input type="submit" name="cmd_buscar" value="Buscar" id="cmd_buscar" class="boton" /></td>
						<td style="WIDTH: 70px;HEIGHT: 3px" align="center"><input type="submit" name="cmd_agregar" value="Nueva Liquidación" onClick="javascript:f_cliente();return false;" id="cmd_agregar" class="boton" /></td>
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
		$sql1 = "call ECO_PUPD_LIQUIDACIONES('E','".$codigo_w."',null,null,null,@cod_w)";
		
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
				alert('La Liquidación ha sido eliminada.');
				</script>";
			
		    mysqli_close($link);
			
			 }
	  
	  }
	  
 if (isset($_POST["cmd_buscar"])) 
    {
	$mes_w = $_POST["DDL_mes"];
	$ano_w = $_POST["DDL_anno"];
	$rutmed_w  = $_POST["ddl_medicos"];

	if ($rutmed_w == "0") {
		$rutmed_w = NULL;
		} 
		
// Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
		$consulta="call ECO_PSEL_LIQUIDACIONES(null,'".$mes_w."','".$ano_w."','".$rutmed_w."')";

//echo $consulta;
//exit();
	$result=mysqli_query($link,$consulta);
	
	echo '<TR>';
	echo '<td background="ivvpp/ivvpp0002.jpg" height="145" style="width: 34px"></td>';
	echo '	<td vAlign="top" align="center" width="700" height="145">';
    echo '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="dgrid" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:None;height:20px;width:700px;border-collapse:collapse;">';
	echo '<tr style="color:#F7F7F7;background-color:#A55129;">';
	echo '	<td>Código</td><td>Medico</td><td>F.Desde</td><td>F.Hasta</td><td>Eliminar</td>';
	echo '</tr>';

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
		  echo '<td height="15"> <a id="codigo_h" class="link10" href="javascript:f_Modificar(&quot;'.$row["codigo"].'&quot;)">'.$row["codigo"].'</a> ';
		  echo '</td>';
		  echo '<td>'.$row["epmedico"].' '.$row["emmedico"].' '.$row["enmedico"].'</td>';
  		  echo '<td>'.$row["fdesde"].'</td>';
		  echo '<td>'.$row["fhasta"].'</td>';
  		  echo '<td align="center"> <input name="ImgElimina" id="ImgElimina" type="image" src="isase427.gif" width="15" height="15" border="0" onclick="f_Eliminar(&quot;'.$row["codigo"].'&quot;)"></td> ';
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
