<?php
// Sistema			: CAMELIA
// Programa			: CAM033_i.PHP
// Descripcion		: Ingresa Compra.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 20/02/2013

session_start();

//incluímos la clase ajax
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax(); 
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

require_once 'admin/config.php';


function cam_valida_proveedor($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
$_SESSION['nompro_s']="";
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("cmd_nompro","value","Debe ingresar un proveedor");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("cmd_nompro","style.color","red");
	$respuesta->script("xajax.$('cmd_nompro').focus();");

}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_proveedores(null,null,null,'".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nompro","value","Proveedor no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nompro","style.color","red");
		$respuesta->script("xajax.$('cmd_nompro').focus();");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nompro_s']=utf8_decode($row["nomfa"]);
				$_SESSION['codpro_s']=$cod;
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("cmd_nompro","value",$_SESSION['nompro_s']);
		$respuesta->assign("cmd_nompro","style.color","blue");

		}
  }
return $respuesta;
}

function cam_valida_numdoc($num)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
if ($num == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("TotMalo","style.display","");

	//Cambiamos a rojo el color del texto de la capa mensaje
//	$respuesta->assign("cmd_nomven","style.color","red");
	$respuesta->script("xajax.$('cmd_numdoc').focus();");

}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_proveedores(null,null,null,'".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nompro","value","Proveedor no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nompro","style.color","red");
		$respuesta->script("xajax.$('cmd_nompro').focus();");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nompro_s']=utf8_decode($row["nomfa"]);
				$_SESSION['codpro_s']=$cod;
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("cmd_nompro","value",$_SESSION['nompro_s']);
		$respuesta->assign("cmd_nompro","style.color","blue");

		}
  }
return $respuesta;
}
function cam_validalocres($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
$_SESSION['nomres_s']="";
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("cmd_nomres","value","Debes ingresar un local");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("cmd_nomres","style.color","red");
	$respuesta->script("xajax.$('cmd_locres').focus();");
  
}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_locales('".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nomres","value","Local no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nomres","style.color","red");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nomres_s']=utf8_decode($row["nombre"]);
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("cmd_nomres","value",$_SESSION['nomres_s']);
		$respuesta->assign("cmd_nomres","style.color","blue");

		}
  }
return $respuesta;
}

function cam_validalocexi($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
$_SESSION['nomexi_s']="";
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("cmd_nomexi","value","Debes ingresar un local");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("cmd_nomexi","style.color","red");
	$respuesta->script("xajax.$('cmd_locexi').focus();");
  
}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_locales('".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nomexi","value","Local no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nomexi","style.color","red");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$_SESSION['nomexi_s']=utf8_decode($row["nombre"]);
				$_SESSION['locexi_s']=$cod;
	
			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		
		$respuesta->assign("cmd_nomexi","value",$_SESSION['nomexi_s']);
		$respuesta->assign("cmd_nomexi","style.color","blue");

		}
  }
return $respuesta;
}

function cam_valida_color($cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("desc","value","Debes ingresar un color");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("desc","style.color","red");
	$respuesta->script("xajax.$('col').focus();");
  
}
elseif (strlen(trim($cod)) < 2)
{
	$respuesta->assign("desc","value","Debes ingresar un color");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("desc","style.color","red");
	$respuesta->script("xajax.$('col').focus();");

}
else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	$col = $cod;

	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_colores('".$col."',null)";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
		$respuesta->assign("desc","value","Color No Existe");
//        $var = "no existe" . " ". $loc. " ".$cod;
//		$respuesta->assign("desc","value",$var);

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("desc","style.color","red");

    }else{

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$nomcol = utf8_decode($row["nomcol"]);

			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("desc","value",$nomcol);
		$respuesta->assign("desc","style.color","blue");

//		$respuesta->script("xajax.$('prod').focus();");
/*
	$contenido = "Roxana";
    $contenido = '<div style="border: 2px solid #0000cc; font-size: 8pt; padding:5px; margin-top:10px; width: 300px;">' . $contenido . '</div>';

	$respuesta->Assign("det_articulos","innerHTML",$contenido);
*/	
		}
  }
return $respuesta;
}
function cam_valida_talla($art,$col,$cod)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();
if ($cod == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("desc","value","Debes ingresar la talla");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("desc","style.color","red");
	$respuesta->script("xajax.$('tall').focus();");
  
}
elseif (strlen(trim($cod)) < 3)
{
	$respuesta->assign("desc","value","Debes ingresar la talla");

	//Cambiamos a rojo el color del texto de la capa mensaje
	$respuesta->assign("desc","style.color","red");
	$respuesta->script("xajax.$('tall').focus();");

}
else{
/*
		$respuesta->assign("desc","value",$art.' '.$col);
		$respuesta->assign("desc","style.color","blue");
*/

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	$loc = $_SESSION['locexi_s'];
	$pro = $_SESSION['codpro_s'];
	$tall = $cod;

	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_inventario('".$loc."','".$pro."','".$art."','".$col."','".$tall."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result) > 0){

		//Mostramos los registros
		while ($row=mysqli_fetch_array($result))
			{
				$ultpre = utf8_decode($row["ultpre"]);
				$prevta = utf8_decode($row["prevta"]);

			}
			
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("pcomp","value",$ultpre);
		$respuesta->assign("pvta","value",$prevta);
//		$respuesta->assign("desc","style.color","blue");

		$respuesta->script("xajax.$('cant').focus();");

		}

    else {

					
		mysqli_free_result($result);
		mysqli_close($link);
		$respuesta->assign("pcomp","value",0);
		$respuesta->assign("pvta","value",0);
//		$respuesta->assign("desc","style.color","blue");

		$respuesta->script("xajax.$('cant').focus();");

		}

  }
return $respuesta;
}
function cam_llena_arreglo($art,$col,$tall,$desc,$cant,$pcomp,$pvta)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

if ($cant > 0 and $pcomp > 0 and $pvta > 0 ){
//echo "pase";
	
    $arr1 = array(); 
    $arr1["art"] = $art; 
    $arr1["col"] = $col;
    $arr1["tall"] = $tall; 
    $arr1["desc"] = $desc; 
    $arr1["cant"] = $cant; 
    $arr1["pcomp"] = $pcomp; 
    $arr1["pvta"] = $pvta; 


    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
	
	$contenido = '';
    $contenido .= '		<P><table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="all" border="1" id="dgrid" width="98%" style="border-color:#E7E7FF;border-width:1px;border-style:None;border-collapse:collapse;">';
	$contenido .= '		<tr style="color:#000080;background-color:#ffffff;">';
	$contenido .= '			<td width="50">ART</td><td width="50">CO</td><td width="50">TALL</td><td width="353">DESCRIPCION</td><td width="161">CANT</td><td width="134">P.COMP</td><td width="116">P.VENT</td>';
	$contenido .= '		</tr>';


    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
        $contenido .= '<tr style="color:#ffffff;background-color:#000080;">'; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["art"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["col"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["tall"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["desc"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["cant"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["pcomp"]."</td>"; 
        $contenido .= "<td>".$_SESSION["arrDetalles"][$i]["pvta"]."</td>"; 
        $contenido .= "</tr>"; 
    } 


        $contenido .= "<tr>"; 
        $contenido .= "<td><input name='art' type='text' class='input-normal' id='art' onBlur='return valida_art(this)' tabindex='10' size='10' maxlength='4' ></td>  ";
		$contenido .= "<td><input name='col' type='text' class='input-normal' id='col' onBlur='javascript:xajax_cam_valida_color(document.Form1.col.value)' onkeypress='return tabular(event,this)' tabindex='11' size='10' maxlength='2'></td>  ";
        $contenido .= "<td><input name='tall' type='text' class='input-normal' id='tall' onBlur='javascript:xajax_cam_valida_talla(document.Form1.art.value,document.Form1.col.value,document.Form1.tall.value)' onkeypress='return tabular(event,this)' tabindex='12' size='10' maxlength='3'></td> </td>"; 
        $contenido .= "<td><input name='desc' type='text' class='input-normal' id='desc' size='30' readOnly='readonly'></td> "; 
        $contenido .= "<td><input name='cant[]' type='text' class='input-normal' id='cant' size='10' tabindex='13' value=0 onChange='javascript:totales()'></td> "; 
        $contenido .= "<td><input name='pcomp[]' type='text' class='input-normal' id='pcomp' size='10' tabindex='14' value=0 ></td> "; 
        $contenido .= "<td><input name='pvta' type='text' class='input-normal' id='pvta' size='10' tabindex='15' value=0 onBlur='javascript:xajax_cam_llena_arreglo(document.Form1.art.value,document.Form1.col.value,document.Form1.tall.value,document.Form1.desc.value,document.Form1.cant.value,document.Form1.pcomp.value,document.Form1.pvta.value)'></td> "; 
        $contenido .= "</tr>"; 
        $contenido .= "<tr>"; 
        $contenido .= "<td  height='120' colspan='7'><span></span></td>"; 
        $contenido .= "</tr>"; 
      	$contenido .= '</table></P>';
	
		$respuesta->assign("det_articulos","innerHTML",$contenido);
		$respuesta->script("xajax.$('art').focus();");
/*
	$contenido = "Roxana";
    $contenido = '<div style="border: 2px solid #0000cc; font-size: 8pt; padding:5px; margin-top:10px; width: 300px;">' . $contenido . '</div>';

	$respuesta->Assign("det_articulos","innerHTML",$contenido);
*/	
		
  }
return $respuesta;
}

//registramos la función creada anteriormente al objeto xajax
$xajax->registerFunction("cam_valida_proveedor");
$xajax->registerFunction("cam_valida_numdoc");
$xajax->registerFunction("cam_validalocres");
$xajax->registerFunction("cam_validalocexi");
$xajax->registerFunction("cam_valida_color");
$xajax->registerFunction("cam_valida_talla");
$xajax->registerFunction("cam_llena_arreglo");

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

if (!$_POST)
	{
	$_SESSION['codpro_s']="";
	$_SESSION['nompro_s']="";
	$_SESSION['numdoc_s']="";
	$_SESSION['locres_s']="";
	$_SESSION['nomres_s']="";
	$_SESSION['locexi_s']="";
	$_SESSION['nomexi_s']="";

    $_SESSION["arrDetalles"] = array();
    $arrRegs = array(); 
    $_SESSION["des1_s"] = 0;
    $_SESSION["des2_s"] = 0;
    $_SESSION["flete_s"] = 0;
    $_SESSION["totdoc"] = 0;
    $_SESSION["neto_s"] = 0;
    $_SESSION["iva_s"] = 0;
    $_SESSION["total_s"] = 0;

	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<head>
		<title>Ingreso de Compras</title>
	    <?php
		//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
		$xajax->printJavascript("../xajax/");
		?>

   		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="ecocss/vvppcss.css" type="text/css" rel="stylesheet">
<!--         <script language="JavaScript" src="jvvpp/vvpp009.js" type="text/javascript"></script>
 -->	    <script language="JavaScript" src="jcam/cam001.js" type="text/javascript"></script>
		<script language="javascript">
		
		imagen = new Image(); 
        imagen.src = "ivvpp/ivvpp0020.gif";

        function f_SelProveedor(){
        /*-----------------------------------*/
            window.open('eco_autoriza.php?PAGINA=' + 'cam_proveedores.php' ,'Proveedores','width=400, height=350, status=no, resizable=no , menubar=no, scrollbars=yes, location=no, top=100, left=350').focus();
			        }
	
		function tabular(e,obj) { 
//		  alert(obj.name);
		  tecla=(document.all) ? e.keyCode : e.which; 
		  if(tecla!=13) return; 
		  frm=obj.form; 
		  for(i=0;i<frm.elements.length;i++) 
			if(frm.elements[i]==obj) { 
			  if (i==frm.elements.length-1) i=-1; 
			  break } 
			  
/*		  if(obj.name =='cmd_codloc')
			  {document.getElementById('cmd_transac').focus();}
		  else if(obj.name =='cmd_transac')
			  {document.getElementById('cmd_codven').focus();}
		  else if(obj.name =='cmd_codven')
			  {document.getElementById('prod').focus();}
		  else if(obj.name =='prod' && obj.value == '')
			  {document.getElementById('cmd_totpag').focus();}
  		  else if(obj.name =='cmd_totpag')
			  {document.getElementById('cmd_fpago').focus();}
		  else
			  {   
			  */
			  frm.elements[i+1].focus(); 
//			  }
		  return false; 
		} 

		function valida_art(obj) { 
		  var a = '';
		  // alert(obj.name);
	      a = trim(obj.value);		
		  if(a.length==0) { //¿Tiene 0 caracteres?
//			document.getElementById('art').focus()
		    alert('Debe ingresar un valor'); //Mostramos el mensaje
			obj.focus();
		    return false; //devolvemos el foco
			}

		  if(a.length < 4) { 
		    alert('Debe ingresar 4 caracteres'); //Mostramos el mensaje
			obj.focus();
		    return false; //devolvemos el foco
			}
		} 

  		    function total_linea()
			//-------------------------
			{ var a=0;
			  var b=0;
			  
	          a = document.Form1.cant.value;
  	          b = document.Form1.prec.value;
			  document.Form1.tot.value = a * b;
	          }

  		    function aplica_descto()
			//-------------------------
			{ var a=0;
			  var b=0;
  			  var c=0;
			  var net=0;
			  var tot=0;
			  var subtot=0;
			  			  
	          a = document.Form1.subtot.value;
  	          b = document.Form1.descto.value;
   	          c = parseInt(document.Form1.otimp.value);
			  net = a - b;
			  document.Form1.neto.value = net;
			  iva = Math.round(net * 0.19);
			  document.Form1.iva.value = iva;
              subtot = net + iva;
              tot = subtot + c;
			  
  			  document.Form1.total.value = tot;
	          }

  		    function totales()
			//-------------------------
			{ var a=0;
			  var b=0;
  			  var c=0;
			  var net=0;
			  var tot=0;
			  var subtot=0;
			  var acant = document.getElementsByName("cant[]");
			  
			  alert(acant.length);
			  for (i=0;i<acant.length;i++){
			     alert(acant[i].value);
//    			document.write("Posición " + i + " del array: " + miArray[i])
//		    	document.write("<br>")
				}

/*			  			  
	          a = document.Form1.subtot.value;
  	          b = document.Form1.descto.value;
   	          c = parseInt(document.Form1.otimp.value);
			  net = a - b;
			  document.Form1.neto.value = net;
			  iva = Math.round(net * 0.19);
			  document.Form1.iva.value = iva;
              subtot = net + iva;
              tot = subtot + c;
			  
  			  document.Form1
			  .total.value = tot;
*/			  
	          }
			  
  		    function aplica_otimp()
			//-------------------------
			{ var a=0;
			  var b=0;
			  var c=0;
			  var tot=0;
			  			  
	          a = parseInt(document.Form1.neto.value);
  	          b = parseInt(document.Form1.iva.value);
   	          c = parseInt(document.Form1.otimp.value);

			  tot = a + b + c;
			  document.Form1.total.value = tot;

	          }

	    </script>
	    

 </head>
<body onload="document.getElementById('cmd_codpro').focus();" class="pantalla_normal" leftMargin="0" topMargin="0" MS_POSITIONING="GridLayout" >

<?php
if (isset($_POST["btnAdd"])) 
{ 
    if ($_POST["prod"] <> 0)
	{
    // recogemos data posteada por el usuario  
    $arr1 = array(); 
    $arr1["prod"] = $_POST["prod"]; 
    $arr1["desc"] = $_POST["desc"]; 
    $arr1["unid"] = $_POST["unid"]; 
    $arr1["cant"] = $_POST["cant"]; 
    $arr1["prec"] = $_POST["prec"]; 
    $arr1["tot"] = $_POST["tot"]; 
	
	$desc =  $_POST["descto"];
    	
	$totlinea = $_POST["cant"] * $_POST["prec"];
	$_SESSION["totdoc"] += $totlinea;
    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
    $_POST["subtot"] = $_SESSION["totdoc"]; 
    $_POST["neto"] = $_SESSION["totdoc"] - $desc; 
    $_POST["iva"] = round($_POST["neto"] * 0.19); 
    $_POST["total"] = $_POST["neto"] + $_POST["iva"] + $_POST["otimp"]; 
	}
}

if (isset($_SESSION["arrDetalles"]))
    $arrRegs = $_SESSION["arrDetalles"]; 
else 
    $arrRegs = array(); 

if (isset($_POST['ddl_proveedor']))
{
	$proveedor_w  = $_POST['ddl_proveedor'];
	}
else
{
	$proveedor_w  = "";
	}
	

if (isset($_POST['cmd_tipdoc']))
{
	$tipdoc_w  = $_POST['cmd_tipdoc'];
	}
else
{
	$tipdoc_w  = "F";
	}


if (isset($_POST['cmd_nrodoc']))
{
	$nrodoc_w  = $_POST['cmd_nrodoc'];
	}
else
{
	$nrodoc_w  = 0;

	}

if (isset($_POST['cmd_fecdoc'])){
	$fecdoc_w  = $_POST['cmd_fecdoc'];
	}
else{
	$fecdoc_w  = date("d/m/Y");
	}

if (isset($_POST['cmd_fecven'])){
	$fecven_w  = $_POST['cmd_fecven'];
	}
else{
	$fecven_w  = date("d/m/Y");
	}

if (isset($_POST['subtot'])){
	$subtot_w  = $_POST['subtot'];
	}
else{
	$subtot_w  = 0;
	}

if (isset($_POST['descto'])){
	$descto_w  = $_POST['descto'];
	}
else{
	$descto_w  = 0;
	}

if (isset($_POST['neto'])){
	$neto_w  = $_POST['neto'];
	}
else{
	$neto_w  = 0;
	}
	
if (isset($_POST['iva'])){
	$iva_w  = $_POST['iva'];
	}
else{
	$iva_w  = 0;
	}

if (isset($_POST['otimp'])){
	$otimp_w  = $_POST['otimp'];
	}
else{
	$otimp_w  = 0;
	}

if (isset($_POST['total'])){
	$total_w  = $_POST['total'];
	}
else{
	$total_w  = 0;
	}
/* 
if (isset($_POST['prod']))
{
	$insumo_w  = $_POST['prod'];
	}
else
{
	$insumo_w  = "";
	}
*/	
 
?>
<form name="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>"  id="Form1">
<div id="encabezado">

  <TABLE id="Table1" cellSpacing="0" cellPadding="0" width="100%" border="0">

			<TR>
				<td Align="center" width="100%">&nbsp;
					<span id="Label1" class="texto18">INGRESA COMPRA</span></td>
			</TR>
			<TR>
				<td align="left" width="100%" height="6">
					<TABLE class="texto13" id="Table2" cellPadding="0" width="100%" border="0">
            <TR> 
						
              <td width="120" style="WIDTH: 130px; HEIGHT: 3px">Número Interno :</td>
			  <td width="100" style="WIDTH: 100px; HEIGHT: 3px"></td>
			  <td width="100" style="WIDTH: 100px; HEIGHT: 3px">Proveedor :</td>
			  <td width="250" style="WIDTH: 250px; HEIGHT: 3px">
				<input name="cmd_codpro" type="text" maxlength="3" id="cmd_codpro" tabindex="1" class="input-normal" style="text-transform: uppercase;width:56px;" onkeypress="return tabular(event,this)" onBlur="javascript:xajax_cam_valida_proveedor(document.Form1.cmd_codpro.value)" value="<?php if (isset($_SESSION['codpro_s'])){ echo $_SESSION['codpro_s']; } ?>"/>
				<input name="imgprov" type="image"  src="ieco/isase458.jpg" width="19" height="19" border="0" onclick="f_SelProveedor()" />
       			<input name="cmd_nompro" type="text" maxlength="20" id="cmd_nompro"   value="<?php echo $_SESSION['nompro_s']; ?>" readOnly="readonly" />
				</td>

		  </TR>

		  <tr> 
              <td style="width: 120px; height: 2px">Tipo Documento :</td>
					 <?php
				   echo'<td style="width: 214px; height: 3px"> <select name="cmd_tipdoc" id="cmd_tipdoc" class="texto01" tabindex="2" onkeypress="return tabular(event,this)">';
				  	echo "\n<option selected='selected' value='1'>Factura</option>";
				   	echo "\n<option value='2'>Nota Débito</option>";
				  	echo "\n<option value='3'>Nota Crédito</option>";
				  	echo "\n<option value='4'>Recibo</option>";
				  	echo "\n<option value='5'>Boleta</option>";
				  	echo "\n<option value='6'>Guía Despacho</option>";
				  	echo "\n<option value='7'>Otro</option>";
				  echo "\n</select></td>";
				?>

            <td style="width: 95px; height: 2px">Nº Documento :</td>
              <td style="width: 114px; height: 3px">
			  <input name="cmd_numdoc" type="text" maxlength="8" id="cmd_numdoc"  tabindex="3" value="<?php echo $_SESSION['numdoc_s']; ?>" onkeypress="return tabular(event,this)" onBlur="javascript:xajax_cam_valida_numdoc(document.Form1.cmd_numdoc.value)" />
            			  <span id="DocMalo" style="color:Red;display:none;">* Documento YA Existe</span> </td> 

            </tr>
            <tr> 
              <td height="22" style="width: 120px; height: 18px">Fecha Documento 
                :</td>
              <td style="width: 214px; height: 18px">
			     <input name="cmd_fecdoc" type="text" maxlength="10" id="cmd_fecdoc" class="input-normal" tabindex="4" value="<?php echo $fecdoc_w; ?>"  size="6"/> 
                &nbsp; <span id="FecMala" style="color:Red;font-weight:bold;display:none;">Fecha 
                Errónea</span>  </td>
              <td style="width: 110px; height: 18px">Monto Abonado :</td>
              <td style="width: 214px; height: 18px">  </td>
            </tr>
            <tr> 
              <td style="width: 120px; height: 18px">Local Respons. :</td>
              <td style="width: 214px; height: 18px">  
			  <input name="cmd_locres" type="text" maxlength="2" tabindex="5" id="cmd_locres" class="input-normal" style="width:56px;"  onBlur="javascript:xajax_cam_validalocres(document.Form1.cmd_locres.value)" onkeypress="return tabular(event,this)" value="<?php if (isset($_SESSION['locres_s'])){ echo $_SESSION['locres_s']; } ?>" />
  			  <input name="cmd_nomres" type="text" maxlength="20" id="cmd_nomres" value="<?php echo $_SESSION['nomres_s']; ?>" readOnly="readonly" />
				</td>
              <td style="width: 95px; height: 18px">Local Existen. :</td>
              <td style="width: 214px; height: 18px">  
			  <input name="cmd_locexi" type="text" maxlength="2" tabindex="6" id="cmd_locexi" class="input-normal" style="width:56px;"  onBlur="javascript:xajax_cam_validalocexi(document.Form1.cmd_locexi.value)" onkeypress="return tabular(event,this)" value="<?php if (isset($_SESSION['locexi_s'])){ echo $_SESSION['locexi_s']; } ?>" />
  			  <input name="cmd_nomexi" type="text" maxlength="20" id="cmd_nomexi" value="<?php echo $_SESSION['nomexi_s']; ?>" readOnly="readonly" />
			  </td>
            </tr>

					  </TABLE>
				</td>

				</TR>

	
	</table>
	</div>    			

	<div id="det_articulos">
    	<table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="all" border="1" id="dgrid" width="98%" style="border-color:#E7E7FF;border-width:1px;border-style:None;border-collapse:collapse;">
			<tr style="color:#000080;background-color:#ffffff;">
				<td width="50">ART</td><td width="50">CO</td><td width="50">TALL</td><td width="353">DESCRIPCION</td><td width="161">CANT</td><td width="134">P.COMP</td><td width="116">P.VENT</td>
			</tr>
		
        <tr>
        <td><input name='art' type='text' class='input-normal' id='art' onBlur="return valida_art(this)" tabindex='10' size='10' maxlength='4' ></td> 
        <td><input name='col' type='text' class='input-normal' id='col' onBlur="javascript:xajax_cam_valida_color(document.Form1.col.value)" onkeypress="return tabular(event,this)" tabindex='11' size='10' maxlength='2'></td> 
        <td><input name='tall' type='text' class='input-normal' id='tall' onBlur="javascript:xajax_cam_valida_talla(document.Form1.art.value,document.Form1.col.value,document.Form1.tall.value)" onkeypress="return tabular(event,this)" tabindex='12' size='10' maxlength='3'></td> 
        <td><input name='desc' type='text' class='input-normal' id='desc' size='30' readOnly='readonly'></td> 
        <td><input name='cant[]' type='text' class='input-normal' id='cant' size='10' tabindex='13' value=0 onChange="javascript:totales()"> </td>
        <td><input name='pcomp[]' type='text' class='input-normal' id='pcomp' size='10' tabindex='14' value=0></td>
        <td><input name='pvta' type='text' class='input-normal' id='pvta' size='10' tabindex='15' value=0 onBlur="javascript:xajax_cam_llena_arreglo(document.Form1.art.value,document.Form1.col.value,document.Form1.tall.value,document.Form1.desc.value,document.Form1.cant.value,document.Form1.pcomp.value,document.Form1.pvta.value)"></td>
        </tr>

		<tr>
		<td  height="120" colspan="7"><span></span></td>
		</tr>
		    </table>	

	</div>    			

	<div id="totales">
    	<table class="link10" cellspacing="0" cellpadding="3" align="Left" rules="all" border="1" id="dgrid" width="98%" style="border-color:#E7E7FF;border-width:1px;border-style:None;border-collapse:collapse;">

        <tr>
			<td colspan="5"><span></span></td>
			<td width="134"><span>Valor Neto</span></td>
  		  <td width="116"> 
		  	 <input name="cmd_neto" type="text" id="cmd_neto"  value="<?php echo $_SESSION['neto_s']; ?>" size="5" maxlength="6" readOnly="readonly" />
			</td>
  		  
          </tr>

        <tr>
			<td colspan="4"><span></span></td>
			
        <td width="161"><span>Des1 </span>
		<input name="cmd_des1" type="text" id="cmd_des1"  tabindex="7" onkeypress="return tabular(event,this)" value="<?php echo $_SESSION['des1_s']; ?>" size="4" maxlength="5" />
          % </td>
			<td><span>Des2 </span>
		<input name="cmd_des2" type="text" id="cmd_des2"  tabindex="8" onkeypress="return tabular(event,this)" value="<?php echo $_SESSION['des2_s']; ?>" size="4" maxlength="5" />
		  %	</td>
  		  <td width="116"> </td>
          </tr>
        <tr>
			<td colspan="5"><span></span></td>
			<td>Flete
			</td>
  		  <td width="116"> 
		  	  <input name="cmd_flete" type="text" id="cmd_flete"  tabindex="9" onkeypress="return tabular(event,this)" value="<?php echo $_SESSION['flete_s']; ?>" size="5" maxlength="6" />
			</td>
  		  
          </tr>
        <tr>
			<td colspan="5"><span></span></td>
			
        <td><span>I.V.A.</span></td>
  		   <td width="116"> 
		   	 <input name="cmd_iva" type="text" id="cmd_iva"  value="<?php echo $_SESSION['iva_s']; ?>" size="5" maxlength="6" readOnly="readonly" />
			</td>

          </tr>
        <tr>
			<td colspan="5"><span></span></td>
			<td><span>Total</span></td>
  		  <td width="116"> 
		  	<input name="cmd_total" type="text" id="cmd_total"  value="<?php echo $_SESSION['total_s']; ?>" size="5" maxlength="6" readOnly="readonly" />
			</td>
  		  
          </tr>

		<tr class="texto01" align="center" style="color:#4A3C8C;background-color:#E7E7FF;">
		<td colspan="7"><span></span></td>	</tr>
	<tr>			
	<td colspan="7">
		<TABLE id="Table3" style="WIDTH: 475px; HEIGHT: 25px; background-color: whitesmoke;" cellSpacing="1" cellPadding="1" width="400"
				align="center" border="0">
				<TR>
					<td  align="center" width="173"><input type="submit" name="cmd_atras" value="Cerrar" onClick="javascript:return window.close();" id="cmd_atras" class="boton" style="width:70px;" /></td>
					<td  align="center" width="173"><input type="submit" name="cmd_grabar" value="Grabar" id="cmd_grabar" class="boton" style="width:70px;" /></td>
					<td  align="center" width="173"><input type="submit" name="cmd_imprimir" value="Imprimir" id="cmd_imprimir" class="boton" style="width:70px;" /></td>
<!-- 					<td align="center" width="173"><input type="submit" name="cmd_grabar" value="Eliminar" id="cmd_grabar" class="boton" style="width:70px;" /></td>
					<td align="center" width="173"><input type="submit" name="cmd_grabar" value="Consultar" id="cmd_grabar" class="boton" style="width:70px;" /></td>
 -->				</TR>	</TABLE>
				</td>
	</tr>
	

    </table>	
    </div>

</form>
<?php

 if (isset($_POST["cmd_grabar"])) 
   {
   
  $prov  = $_POST["ddl_proveedor"];
  $tipdoc  = $_POST["cmd_tipdoc"];
  $nrodoc  = $_POST["cmd_nrodoc"];
  $fecdoc  = $_POST["cmd_fecdoc"];
  $fecven  = $_POST["cmd_fecven"];
  $tipo  = "P";
  $subtot  = $_POST["subtot"];
  $desc  = $_POST["descto"];
  $neto  = $_POST["neto"];
  $iva  = $_POST["iva"];
  $otimp  = $_POST["otimp"];
  $tot  = $_POST["total"];

   // Graba encabezado compras
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$consulta="call nz_pupd_compras_enc('I','".$prov."','".$tipdoc."',".$nrodoc.",STR_TO_DATE('".$fecdoc."','%d/%m/%Y'),STR_TO_DATE('".$fecven."','%d/%m/%Y'),'".$tipo."',".$subtot.",".$desc.",".$neto.",".$iva.",".$otimp.",".$tot.")";
//echo $consulta;

//        $result=mysqli_query($link,$consulta);
		if ( !mysqli_query($link,$consulta) )
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar enc compra: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link);
			 
 		     if (mysqli_errno($link) == 1062)
			    {
				$merror = "El documento ya existe....." ;
				}
				 
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .' );
				</script>";
				
				
			mysqli_close($link);
//			exit();

			}
		else
		   {
		    mysqli_close($link);

			}	
			
	// graba detalle
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
        $cod = $_SESSION["arrDetalles"][$i]["prod"]; 
        $cant = $_SESSION["arrDetalles"][$i]["cant"]; 
        $prec = $_SESSION["arrDetalles"][$i]["prec"]; 

		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
       // cam_pupd_detventa(IN PMODO,PCODLOC,PNUMTRA,PTIPMOV,PCODPRO,PCODART,PCODCOL,PTALLA,PCANTID,PPRECIO) 	
 		$sql1 = "call nz_pupd_compras_det('I','".$prov."','".$tipdoc."',".$nrodoc.",'".$cod."','','".$cant."','".$prec."')";

		if (!mysqli_query($link,$sql1)) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar detalle compra: " . mysqli_errno($link);
  			 echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";
			 mysqli_close($link);
			 exit();
			}
		else
		   {
			mysqli_close($link);
			}	

     }
	echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";
   
   }
?>
</body>
</HTML>
