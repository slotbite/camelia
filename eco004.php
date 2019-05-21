<?php
// Sistema			: ECO
// Programa			: ECO004.PHP
// Descripcion		: Mantención de usuarios del sistema.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 22/10/2010

session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>
	Lista de usuarios </title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script  type="text/javascript">
	
	        function f_Modificar(sUsuario){
        /*-----------------------------------*/
//            pant_emp = window.open("","Cuatro","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
//	        pant_emp.location = "eco_autoriza.php?PAGINA=" + "eco005.php?USUARIO=" + sUsuario;
			
			window.open('eco_autoriza.php?PAGINA=' + 'eco005.php?USUARIO=' + sUsuario ,'eco007','width=550, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();
			
			      		  }

		    function Bloquea() {
  
	          if (window.event.keyCode == 13)
            {
                event.returnValue=false;
                event.cancel = true;
              }
			  }

		function f_Agregar(){
        /*-----------------------------------*/
 /*         pant_emp = window.open("","Cuatro","top=150,left=200,width=530,height=450,status=yes,scrollbars=yes,resizable=no");
	        pant_emp.location = "wsase_0210.aspx?Opcion=2&pId=" + sUsuario 
			*/
			
			hola(150,0);
			document.getElementById('slHabilitado').options(0).selected = true;  
			document.getElementById('txtcodigo').value = "Nuevo";
			document.getElementById('hdElimina').value = "";
			document.getElementById('hdHabilitado').value = "N";
       }

		function hola(x,hab) {
		 /*-----------------------------------*/
          if (hab == 0)
             {
             document.getElementById('slHabilitado').disabled="disabled";
              }
		  else {
            document.getElementById('slHabilitado').removeAttribute("disabled"); 
		       }  
		  document.getElementById('PanelObs').style.left = x;
		  document.getElementById('PanelObs').style.top  = 10;
		}
		
	
    </script>
</head>
<body >

<?php

require_once 'admin/config.php';

$sistema_w = $_GET["SISTEMA"];

?>

<form name="form1"  method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>" id="form1">
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
?>
<script type="text/javascript">

var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}

</script>

<script src="/sase/WebResource.axd?d=4iz2DVGP0akyxBBfOQ5hzQ2&amp;t=633964179561718750" type="text/javascript"></script>

    <div>
        <table style="width: 712px; left: 5px; position: absolute; top: 3px;" cellspacing="0" id="TABLE1" >
            <tr>
                <td style="width: 28px; background-image: url(isase/isase478.jpg);">
                </td>
                
		<td style="width: 636px"> <span id="Label2" class="texto18">LISTADO DE USUARIOS</span></td
		 		  
            ></tr>
            <tr>
                <td style="width: 28px; height: 142px; background-image: url(isase/isase478.jpg);">
                </td>
                <td style="height: 142px; width: 636px; vertical-align: top;">
                    <div> 
            <table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="grdDatos" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:solid;width:655px;border-collapse:collapse;left: 35px;
                        top: 276px">
              <tr style="color:#F7F7F7;background-color:#A55129;"> 
			  			<th scope="col">Usuario</th><th scope="col">Paterno</th><th scope="col">Materno</th><th scope="col">Nombres</th><th scope="col">Rut</th><th scope="col">Fecha Ini.</th><th scope="col">Habilitado</th>

              </tr>
<?php

	//Conexion con la base
//	$link = mysql_connect("localhost","root","");
//	mysql_select_db("eco");
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
	mysqli_select_db($link,DB_NAME); 

	
	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_USUARIO_SISTEMA('".$sistema_w."',null)";
	$result=mysqli_query($link,$consulta);
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		  echo '<tr style="color:#4A3C8C;">'; 
//		  echo '<td height="15"> <a id="grdDatos_ctl02_HyperLink1" class="link10" href="javascript:f_Modificar(&quot;RACEV001&quot;)">'.$row["CDESCRIPCION"].'</a> ';
		  echo '<td height="15"> <a id="grdDatos_ctl03_HyperLink1" class="link10" href="javascript:f_Modificar(&quot;'.$row["usuario"].'&quot;)">'.$row["usuario"].'</a> ';
		  echo '</td>';
		  echo '<td>'.$row["paterno"].'</td>';
		  echo '<td>'.$row["materno"].'</td>';
		  echo '<td>'.$row["nombres"].'</td>';
  		  echo '<td>'.$row["persona"].'</td>';
		  echo '<td>'.$row["fecha_pass"].'</td>';

//		  echo '<td align="center"> <span id="grdDatos_ctl02_lblSN">Sí</span> </td>';
		  echo '<td align="center"> <span id="grdDatos_ctl03_lblSN">'.$row["habilitado"].'</span> </td>';

//		  echo '<td align="center"> <input name="ImgElimina" type="image" src="isase427.gif" width="15" height="15" border="0" onclick="f_Eliminar(&quot;'.$row["CDESCRIPCION"].'&quot,&quot;'.$row["NDESCRIPCION"].'&quot;)"></td> ';
		  echo '</tr>';
	
		}
	mysqli_free_result($result);
	mysqli_close($link);

?>
            </table>
            
          </div>
                </td>
            </tr>
            <tr>
                <td style="width: 28px; height: 48px; background-image: url(isase/isase478.jpg);">
                </td>
                <td style="height: 48px; width: 636px;">
                    <table id="Table4" border="0" cellpadding="0" cellspacing="0" style="width: 620px;
                        height: 27px; background-color: #f2f4f4;">
                        <tr>
                            <td style="width: 119px; height: 25px">
                            </td>
                            <td style="width: 313px; height: 25px">
                                </td>
                            
<!--              <td style="width: 163px; height: 25px"> <input type="button" name="btnNuevo" value="Agregar" id="btnNuevo" style="width:68px;"  onclick="f_Agregar();"/></td>
 -->   
	              <td style="width: 163px; height: 25px"> <input type="button" name="btnNuevo" value="Agregar" id="btnNuevo" style="width:68px;"  onclick="window.open('eco_autoriza.php?PAGINA=' + 'eco005.php?USUARIO=',null,'width=530,height=450,status=yes, resizable= yes, scrollbars=yes, toolbar=no,location=no,menubar=no, top=150,left=200').focus();return false;"/></td>
						
						</tr>
                    </table>
                </td>
            </tr>
        </table>
        
    
    </div>
    
<div>
	<input type="hidden" name="hdElimina" id="hdElimina" value="" />
	<input type="hidden" name="hdHabilitado" id="hdHabilitado" value="" />
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0" />
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0" />
	<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
	<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
</div>
   
</form>

</body>
</html>
