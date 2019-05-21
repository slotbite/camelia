<?php
// Sistema			: ECO
// Programa			: ECO01.PHP
// Descripcion		: Mantención de Descripciones.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 10/2010

// iniciamos sesiones
ob_start();
session_start();
if (!isset($_SESSION["detalle_s"])){ $_SESSION['detalle_s']="";} 
$_SESSION['detalle_s']="";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>Lista de descripciones </title>
<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

    <script  type="text/javascript">
		    function Bloquea() {
  
	          if (window.event.keyCode == 13)
            {
                event.returnValue=false;
                event.cancel = true;
              }
			  }
        function f_Modificar(cdes,ndes,mvig,tdet){
        /*-----------------------------------*/
			hola(150,1);
			
			  document.form1.txtcodigo.value = cdes;
			  document.form1.txtdesc.value = ndes;
			  document.form1.hdElimina.value = "";
			  document.form1.hdHabilitado.value = "S";

  			if (mvig == 'S')
				{ document.getElementById('slHabilitado').options(0).selected = true;  }
		    else
				{ document.getElementById('slHabilitado').options(1).selected = true;  }

        }
        function f_Eliminar(cdes,ndes){
        /*-----------------------------------*/
						
 			  document.form1.txtcodigo.value = cdes;
			  document.form1.txtdesc.value = ndes;
			  document.form1.hdElimina.value = "E";
			  document.form1.hdHabilitado.value = "";
						
			        }

		function f_Agregar(){
        /*-----------------------------------*/
			
			hola(150,0);
			
		  	  document.getElementById('slHabilitado').options(0).selected = true;  
			  document.form1.txtcodigo.value = "Nuevo";
			  document.form1.txtdesc.value = "";
			  document.form1.hdElimina.value = "";
			  document.form1.hdHabilitado.value = "N"
		
       }
	      function f_Plantilla(cdes,ndes){
        /*-----------------------------------*/
              window.open('eco_autoriza.php?PAGINA=' + 'eco045.php?CODIGO=' + cdes+'.'+ndes,'eco045','width=950, height=750, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=220').focus();
               }			


        function f_grupos(sId){
            location.href("wsase_020.aspx?pId=" + sId );
        }
        function TABLE1_onclick() {

        }
		
		function hola(x,hab) {
		
		if (hab == 0)
             {
              document.form1.slHabilitado.disabled="disabled";
              }
		  else {
             document.form1.slHabilitado.removeAttribute("disabled"); 
		       }  
   		  document.getElementById('PanelObs').style.left = x;
		  document.getElementById('PanelObs').style.top  = 10;

		 
		}
		
	
    </script>
</head>
<body>

<?php
//echo $_SESSION['autoriza'];

require_once 'admin/config.php';

$concepto_w = $_GET["CONCEPTO"];
?>

<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>" id="form1">

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

<?php
if ($_POST) {

// if (isset($_POST["btnAceptar"]) )
//   {
// echo 'pase';
/*
    if (!isset($detalle_w))
       { 
	   $detalle_w = "";
	   }
	   */
	   
	$detalle_w = $_SESSION['detalle_s'];   
//	$detalle_w = $_POST["hdDetalle"];   
	$codigo_w = $_POST["txtcodigo"];
	$desc_w = $_POST["txtdesc"];
	$elim_w = $_POST["hdElimina"];
	$habil_w = 'S'; 
	$var_w = $_POST["hdHabilitado"];
	
	$desc_w = strtoupper($desc_w);
	
//echo $desc_w;
	
	if ($var_w == "S")
	   {
	   $slhabil_w = $_POST["slHabilitado"];
	 
//echo $slhabil_w;
	
	    if ($slhabil_w == 'NO') 
	       {
	      $habil_w = 'N';
	       }
		else{
		   $habil_w = 'S';
			}
	}		   

	$modo_w ="";

    if ($elim_w == 'E')
		{
	 	$modo_w = 'E';
		$cod_w = "'".$codigo_w."'";

	   }  
 	elseif($codigo_w == "Nuevo") {
	    $modo_w = 'I';
		$cod_w = 'null';
		}
	else {
		$modo_w = 'M';
		$cod_w = "'".$codigo_w."'";
		}
 
 	if (strlen( trim($desc_w) ) > 0) {
	
		//Conexion con la base
		
		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		
		if (!$link) {
			printf("No se puede conectar a localhost. Error: %s\n", mysqli_connect_error());
			exit();
		}
		
//		$sql1 = "call ECO_PUPD_DESCRIPCIONES('I',null,'".$desc_w."','S','CIUDAD',null,null,null)";
		$sql1 = "call ECO_PUPD_DESCRIPCIONES_2('".$modo_w."',".$cod_w.",'".$desc_w."','".$habil_w."','".$concepto_w."',null,null,null)";
// echo $sql1;
		mysqli_autocommit($link, TRUE);
		
		if (!mysqli_query($link, $sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El item ya existe....." ;
				} 
				
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
				alert('El Item: \' $desc_w\' ha sido registrado de manera satisfactoria.');
				</script>";
				*/
			mysqli_close($link);
			$_SESSION['autoriza'] = "SI";
//			header("Location:menueco.html");
?>
			<script>
			top.frames['mainFrame'].location.href = 'menu5.php';
			</script>
<?php			
			ob_end_flush();
			}	
  	
	}

//  }
}

?>

    <div>
        
    <table style="width: 712px; left: 5px; position: absolute; top: 3px; height: 193px;" cellspacing="0" id="TABLE1" onclick="return TABLE1_onclick()">
      <tr>
                <td style="width: 28px; background-image: url(isase/isase478.jpg);">
                </td>
                
 
<?php
      echo '<td style="width: 636px"> <span id="Label2" class="texto18">LISTADO DE '.strtoupper($concepto_w).'</span></td>';
?>		  
		  
            </tr>
            <tr>
                <td style="width: 28px; height: 142px; background-image: url(isase/isase478.jpg);">
                </td>
                <td style="height: 142px; width: 636px; vertical-align: top;">
                    <div> 
            <table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="rows" border="1" id="grdDatos" style="background-color:White;border-color:#E7E7FF;border-width:1px;border-style:solid;width:655px;border-collapse:collapse;left: 35px;
                        top: 276px">
              <tr style="color:#F7F7F7;background-color:#A55129;"> 
                <th scope="col">Código</th>
                <th scope="col">Descripción</th>
                <th scope="col">Habilitado</th>
                <th scope="col">Eliminar</th>
				<?php
	          if (strtoupper($concepto_w) == 'EXAMEN')
					{
					  echo '<th scope="col">Plantilla</th>';
					}	  
			?>
              </tr>
              <?php

	//Conexion con la base
	
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
	$consulta="call ECO_PSEL_DESCRIPCIONES(null,'".$concepto_w."',null)";
	$result=mysqli_query($link,$consulta);

//	$detalle_w = "";
	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
	      $detalle_w = html_entity_decode( $row["TPLANTILLA"] ) ;
		  echo '<tr style="color:#4A3C8C;">'; 
		  echo '<td height="15"> <a id="grdDatos_ctl02_HyperLink1" class="link10" href="javascript:f_Modificar(&quot;'.$row["CDESCRIPCION"].'&quot,&quot;'.$row["NDESCRIPCION"].'&quot,&quot;'.$row["MVIGENTE"].'&quot;)">'.$row["CDESCRIPCION"].'</a> ';
		  echo '</td>';
		  echo '<td>'.$row["NDESCRIPCION"].'</td>';
		  echo '<td align="center"> <span id="grdDatos_ctl02_lblSN">'.$row["MVIGENTE"].'</span> </td>';

		  echo '<td align="center"> <input name="ImgElimina" id="ImgElimina" type="image" src="isase427.gif" width="15" height="15" border="0" onclick="f_Eliminar(&quot;'.$row["CDESCRIPCION"].'&quot,&quot;'.$row["NDESCRIPCION"].'&quot;)"></td> ';
          if (strtoupper($concepto_w) == 'EXAMEN')
		  	{
			  echo '<td align="center"> <input name="ImgPlantilla" id="ImgPlantilla" type="image" src="isase404.gif" width="15" height="15" border="0" onclick="f_Plantilla(&quot;'.$row["CDESCRIPCION"].'&quot,&quot;'.$row["NDESCRIPCION"].'&quot;)"></td> ';
			}	  
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
                            
              <td style="width: 163px; height: 25px"> <input type="button" name="btnNuevo" value="Agregar" id="btnNuevo" style="width:68px;"  onclick="f_Agregar();"/></td>
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
   
  <div id="PanelObs" style="background-color:White;border-color:#404040;border-width:3px;border-style:Solid;height:150px;width:368px;left:-711px; position: absolute; top: 64px"> 
    <table width="332" height="140" cellpadding="0" cellspacing="0" class="texto11" >
      <tr> 
        <td width="31" background="ivvpp0002.jpg" style="width: 34px"></td>
        <td width="68" height="18" style="width: 20px; height: 6px"> </td>
        <td width="218" style="width: 200px; height: 6px"> </td>
        <td width="42" colspan="6" style="height: 6px; width: 38px;"> </td>
      </tr>
      <tr> 
        <td background="ivvpp0002.jpg" style="width: 34px"></td>
        <td height="20" style="width: 20px; height: 6px"> </td>
        <td style="width: 150px; height: 6px"> <span id="lblTitObs" class="texto15">Descripciones</span></td>
        <td colspan="6" style="height: 6px; width: 20px;"> </td>
      </tr>
      <tr> 
        <td background="ivvpp0002.jpg" style="width: 34px"></td>
        <td height="30" colspan="2" bgcolor='#A55129' style="width: 40px; height:4px">&nbsp;</td>
        <td colspan="6" bgcolor='#A55129' style="width: 20px; height: 4px"></td>
      </tr>
      <tr> 
        <td background="ivvpp0002.jpg" style="width: 34px"></td>
        <td height="30" style="width: 40px; height:4px">Codigo</td>
        <td style="width: 150px; height: 4px"><input name="txtcodigo"  id="txtcodigo" type="text" style="border:1px solid #f2f4f4;background-color: #f2f4f4;"  readonly="readonly"/></td>
        <td colspan="6" style="width: 20px; height: 4px"> </td>
      </tr>
      <tr> 
        <td background="ivvpp0002.jpg" style="width: 34px"></td>
        <td height="43" style="width: 40px; height: 4px">Descripcion</td>
        <td style="width: 150x; height: 4px"><input type="text" name="txtdesc"  id="txtdesc" style="text-transform: uppercase;"/></td>
        <td colspan="6" style="height: 4px; width: 20px;"></td>
      </tr>
      <tr> 
        <td background="ivvpp0002.jpg" style="width: 34px"></td>
        <td height="43" style="width: 40px; height: 4px">Habilitado </td>
        <td style="width: 150x; height: 4px"><select id="slHabilitado" name="slHabilitado">  
            <option selected="selected">SI</option>
            <option>NO</option>
          </select> </td>
        <td colspan="6" style="height: 4px; width: 20px;"> </td>
      </tr>
      <tr> 
        <td background="ivvpp0002.jpg" style="width: 34px"></td>
        <td style="width: 20px; height: 6px"> </td>
        <td style="width: 200px; height: 6px"> <input type="submit" name="btnNuevo2" value="Cerrar" id="btnNuevo2" class="boton" style="width:75px;"  onclick="javascript:hola(-1500);"/> 
          &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="btnAceptar" value="Aceptar" id="btnAceptar" class="boton" style="width:75px;" /> 
        </td>
      </tr>
    </table>
      
</div>

</form>


</body>
</html>
