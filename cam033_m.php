<?php
// Sistema			: CAMELIA
// Programa			: CAM033_m.PHP
// Descripcion		: Modifica Compra.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 23/04/2014

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

function cam_valida_doc_existe($pro, $tip, $num)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

// if (!isset($_SESSION["codloc_s"])){ $_SESSION['codloc_s']="";} 
if ($num == ""){
	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
	$respuesta->assign("NumMalo","style.display","");
	$respuesta->assign("DocMalo","style.display","none");

	//Cambiamos a rojo el color del texto de la capa mensaje
//	$respuesta->assign("cmd_nomven","style.color","red");
	$respuesta->script("xajax.$('cmd_numdoc').focus();");

}else{

//echo "pase";
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call cam_psel_locales('".$cod_w."')";
	$consulta="call cam_psel_comprasxdocto('".$pro."',".$tip.",".$num.")";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result) == 0){
		//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
		$respuesta->assign("DocMalo","style.display","");
   		$respuesta->assign("NumMalo","style.display","none");
	
		//Cambiamos a rojo el color del texto de la capa mensaje
	//	$respuesta->assign("cmd_nomven","style.color","red");
		$respuesta->script("xajax.$('cmd_numdoc').focus();");

		}
	else{
   		$respuesta->assign("DocMalo","style.display","none");
   		$respuesta->assign("NumMalo","style.display","none");
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
	$consulta="call cam_psel_localesxcod('".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nomres","value","Local no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nomres","style.color","red");
		$respuesta->script("xajax.$('cmd_locres').focus();");

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
	$consulta="call cam_psel_localesxcod('".$cod."')";

	$result=mysqli_query($link,$consulta);
    if (mysqli_num_rows($result)==0){
        	//escribimos en la capa con id="mensaje" que no se ha escrito nombre de usuario
//		$respuesta->assign("mensaje_loc","innerHTML","Local no existe");
		$respuesta->assign("cmd_nomexi","value","Local no existe");

		//Cambiamos a rojo el color del texto de la capa mensaje
		$respuesta->assign("cmd_nomexi","style.color","red");
		$respuesta->script("xajax.$('cmd_locexi').focus();");


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

if ($pvta < $pcomp)
{
	$respuesta->alert("PRECIO VENTA MENOR QUE COSTO");

}
elseif ($cant > 0 and $pcomp > 0 and $pvta > 0 ){
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
        $contenido .= "<td><input name='cant' type='text' class='input-normal' id='cant' size='10' tabindex='13' value=0 onChange='javascript:xajax_cam_calcula_totales(document.Form1.cant.value,document.Form1.pcomp.value,document.Form1.cmd_des1.value,document.Form1.cmd_des2.value,document.Form1.cmd_flete.value)'></td> "; 
        $contenido .= "<td><input name='pcomp' type='text' class='input-normal' id='pcomp' size='10' tabindex='14' value=0 onChange='javascript:xajax_cam_calcula_totales(document.Form1.cant.value,document.Form1.pcomp.value,document.Form1.cmd_des1.value,document.Form1.cmd_des2.value,document.Form1.cmd_flete.value)'></td> "; 
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

function cam_calcula_totales($cant,$pcomp,$porde1,$porde2,$flete)
//---------------------------
{
//instanciamos el objeto para generar la respuesta con ajax
$respuesta = new xajaxResponse();

	$totlinea = $cant * $pcomp;
	$neto = 0;
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
        $neto += $_SESSION["arrDetalles"][$i]["cant"] * $_SESSION["arrDetalles"][$i]["pcomp"]; 
    } 
    $neto += $totlinea;
	
	$valde1 = round($neto * ( $porde1 / 100 ),0);
	$valafe = $neto - $valde1;
	
	$valde2 = round($valafe * ( $porde2 / 100 ),0);
	$valafe = ($valafe - $valde2) + $flete ;

    $valiva = round( $valafe * 0.19, 0);
	$valtot = $valafe + $valiva;
	
	$valdes = $valde1 + $valde2;
	
	$respuesta->assign("cmd_neto","value",$neto);
	$respuesta->assign("cmd_valdes","value",$valdes);
	$respuesta->assign("cmd_iva","value",$valiva);
	$respuesta->assign("cmd_total","value",$valtot);
//		$respuesta->script("xajax.$('art').focus();");
		
return $respuesta;
}

//registramos la función creada anteriormente al objeto xajax
$xajax->registerFunction("cam_valida_proveedor");
$xajax->registerFunction("cam_valida_doc_existe");
$xajax->registerFunction("cam_validalocres");
$xajax->registerFunction("cam_validalocexi");
$xajax->registerFunction("cam_valida_color");
$xajax->registerFunction("cam_valida_talla");
$xajax->registerFunction("cam_llena_arreglo");
$xajax->registerFunction("cam_calcula_totales");

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
    $_SESSION["valdes_s"] = 0;
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
		<title>Modificación de Compras</title>
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
		  alert(obj.name);
		  tecla=(document.all) ? e.keyCode : e.which; 
		  if(tecla!=13) return; 
		  frm=obj.form; 
		  for(i=0;i<frm.elements.length;i++) 
			if(frm.elements[i]==obj) { 
			  if (i==frm.elements.length-1) i=-1; 
			  break } 
			/*
					  else if(obj.name =='prod' && obj.value == '')
			  {document.getElementById('cmd_fecdoc').focus();}
  */
		  if(obj.name =='cmd_codpro')
			  {document.getElementById('cmd_tipdoc').focus();}
		  else if(obj.name =='cmd_tipdoc')
			  {document.getElementById('cmd_numdoc').focus();}
		  else if(obj.name =='cmd_numdoc')
			  {document.getElementById('cmd_fecdoc').focus();}
  		  else if(obj.name =='cmd_fecdoc')
			  {document.getElementById('cmd_locres').focus();}
  		  else if(obj.name =='cmd_locres')
			  {document.getElementById('cmd_locexi').focus();}
		  else if(obj.name =='cmd_locexi')
			  {document.getElementById('cmd_des1').focus();}
		  else if(obj.name =='cmd_des1')
			  {document.getElementById('cmd_des2').focus();}
		  else if(obj.name =='cmd_des2')
			  {document.getElementById('cmd_flete').focus();}
		  else if(obj.name =='cmd_flete')
			  {document.getElementById('art').focus();}
  		  else if(obj.name =='art')
			  {document.getElementById('col').focus();}
  		  else if(obj.name =='col')
			  {document.getElementById('tall').focus();}
  		  else if(obj.name =='tall')
			  {document.getElementById('cant').focus();}
  		  else if(obj.name =='cant')
			  {document.getElementById('pcomp').focus();}
  		  else if(obj.name =='pcomp')
			  {document.getElementById('pvta').focus();}
		  else
			  {   
			  frm.elements[i+1].focus(); 
//			  }
		  return false; 
		} 

		function valida_art(e,obj) { 
		  var a = '';				  
  		  tecla=(document.all) ? e.keyCode : e.which; 
		  if(tecla!=9) return;    // no es tabulador 

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
if (isset($_POST["btn_imprimir"])) 
{ 
    // recogemos data posteada por el usuario  
    $arr1 = array(); 
	
    $arr1["art"] = $_POST["art"];
    $arr1["col"] = $_POST["col"];
    $arr1["tall"] = $_POST["tall"];
    $arr1["desc"] = $_POST["desc"];
    $arr1["cant"] = $_POST["cant"];
    $arr1["pcomp"] = $_POST["pcomp"];
    $arr1["pvta"] = $_POST["pvta"];
	$codpro = $_POST["cmd_codpro"];
    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
	
	// La siguiente línea ejecutará una orden en DOS. Esto solo debe ejecutarse una vez.
	// Las comillas hacen que lo ejecute Windows directamente
	`mode com1: BAUD=9600 PARITY=E data=7 stop=1`;

//	echo "imprimir";
	if(($handle = @fopen("COM1", "w")) === FALSE){
        die('ERROR:\nNo se puedo Imprimir, Verifique la conexion de la IMPRESORA');
     }
	
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    {   
		$cod = $codpro . $_SESSION["arrDetalles"][$i]["art"] . $_SESSION["arrDetalles"][$i]["col"] . $_SESSION["arrDetalles"][$i]["tall"]."0";
		$txt = $_SESSION["arrDetalles"][$i]["pcomp"] ."     ". $_SESSION["arrDetalles"][$i]["pvta"] ;
//        $neto += $_SESSION["arrDetalles"][$i]["cant"] * $_SESSION["arrDetalles"][$i]["pcomp"]; 
//		fwrite($handle,chr(2).chr(27). "E2".chr(24)."0733547133500".chr(13)."desde programa".chr(30)."0001".chr(31)."2".chr(23).chr(3));
		fwrite($handle,chr(2).chr(27). "E2".chr(24). $cod .chr(13). $txt .chr(30)."0001".chr(31)."2".chr(23).chr(3));

    } 
    fclose($handle); // cierra el fichero PRN
    $salida = shell_exec('lpr COM1');

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
					<span id="Label1" class="texto18">MODIFICA COMPRA</span></td>
			</TR>
			<TR>
				<td align="left" width="100%" height="6">
				<TABLE class="texto13" id="Table2" cellPadding="0" width="100%" border="0">
					
            	<TR> 
						
              <td width="120" height="25" style="WIDTH: 130px; HEIGHT: 3px">Número 
                Interno :</td>
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
			  <input name="cmd_numdoc" type="text" maxlength="8" id="cmd_numdoc"  tabindex="3" value="<?php echo $_SESSION['numdoc_s']; ?>" onkeypress="return tabular(event,this)" onBlur="javascript:xajax_cam_valida_doc_existe(document.Form1.cmd_codpro.value,document.Form1.cmd_tipdoc.value, document.Form1.cmd_numdoc.value)" />
            			  <span id="NumMalo" style="color:Red;display:none;">* Debe Ingresar un Número</span> 
            			  <span id="DocMalo" style="color:Red;display:none;">* Documento NO Existe</span> </td> 
				</tr>
            <tr> 
              <td height="22" style="width: 120px; height: 18px">Fecha Documento 
                :</td>
              <td style="width: 214px; height: 18px">
			     <input name="cmd_fecdoc" type="text" maxlength="10" id="" class="input-normal" tabindex="4" value="<?php echo $fecdoc_w; ?>"  size="8"/> 
                &nbsp; <span id="FecMala" style="color:Red;font-weight:cmd_fecdocbold;display:none;">Fecha 
                Errónea</span>  </td>
              <td style="width: 110px; height: 18px">Monto Abonado :</td>
              <td style="width: 214px; height: 18px">  </td>
            </tr>
            <tr> 
              <td style="width: 120px; height: 18px">Local Respons. :</td>
              <td style="width: 214px; height: 18px"> <input name="cmd_locres" type="text" maxlength="2" tabindex="5" id="cmd_locres" class="input-normal" style="width:56px;"  onBlur="javascript:xajax_cam_validalocres(document.Form1.cmd_locres.value)" onKeyPress="return tabular(event,this)" value="<?php if (isset($_SESSION['locres_s'])){ echo $_SESSION['locres_s']; } ?>" />
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
        <td><input name='cant' type='text' class='input-normal' id='cant' size='10' tabindex='13' value=0 onChange="javascript:xajax_cam_calcula_totales(document.Form1.cant.value,document.Form1.pcomp.value,document.Form1.cmd_des1.value,document.Form1.cmd_des2.value,document.Form1.cmd_flete.value)"> </td>
        <td><input name='pcomp' type='text' class='input-normal' id='pcomp' size='10' tabindex='14' value=0 onChange="javascript:xajax_cam_calcula_totales(document.Form1.cant.value,document.Form1.pcomp.value,document.Form1.cmd_des1.value,document.Form1.cmd_des2.value,document.Form1.cmd_flete.value)"> </td>
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
  		  <td width="116"> 
		  	<input name="cmd_valdes" type="text" id="cmd_valdes"  value="<?php echo $_SESSION['valdes_s']; ?>" size="5" maxlength="6" readOnly="readonly" />
		  </td>
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
					<td  align="center" width="173"><input type="submit" name="btn_imprimir" value="Imprimir" id="btn_imprimir" class="boton" style="width:70px;" /></td>

              <td  align="center" width="173">&nbsp;</td>
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
   // recogemos data posteada por el usuario  
    $arr1 = array(); 
	
    $arr1["art"] = $_POST["art"];
    $arr1["col"] = $_POST["col"];
    $arr1["tall"] = $_POST["tall"];
    $arr1["desc"] = $_POST["desc"];
    $arr1["cant"] = $_POST["cant"];
    $arr1["pcomp"] = $_POST["pcomp"];
    $arr1["pvta"] = $_POST["pvta"];
	$codpro = $_POST["cmd_codpro"];
    // agregamos la data posteada al array almacenado en la variable de sesion 
    if (isset($_SESSION["arrDetalles"])) 
        $arrRegs = $_SESSION["arrDetalles"]; 
     else 
        $arrRegs = array(); 

    $arrRegs[] = $arr1;
	$_SESSION["arrDetalles"] = $arrRegs;
	
  $fecint  = date("d/m/Y");  //fecha actual
  $anoint = date("Y");   // año actual
  $numint = 0;
  $prov  = $_POST["cmd_codpro"];
  $estado  = " ";
  $fecdoc  = $_POST["cmd_fecdoc"];
  $fecven  = $fecven_w;
  $tipdoc  = $_POST["cmd_tipdoc"];
  $nrodoc  = $_POST["cmd_numdoc"];

//  $afecto = $valafe;
  $afecto = 0;
  $vald1 = 0;
  $vald2 = 0;
  $exento = 0;
  $especi = 0;
  
  $iva = $_POST["cmd_iva"];
  $reten = 0;
  
  $total = $_POST["cmd_total"];
  $flete = $_POST["cmd_flete"];
  $porde1 = $_POST["cmd_des1"];
  $porde2 = $_POST["cmd_des2"];
  
  $pagado = 0;
  $locres  = $_POST["cmd_locres"];
  $locexi  = $_POST["cmd_locexi"];
  $facaso = 0;
  $congui = " ";
  $motivo = "";
  $invent = " ";

   // Graba encabezado compras
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
// `cam_pupd_ctactepr`(             PMODO ,panoint ,    pnumint,      pestado,   pcodpro,  pfecdoc ,                            pfecvto,                                 ptipdoc,       pnumdoc ,       pfecint ,                         pafecto ,    pexento  , pespeci,   piva ,    preten , total ,   pagado ,locres ,        motivo ,          locexi ,porde1 ,          valde1 ,    facaso ,          congui ,invent ,       flete ,         porde2 ,    valde2 ,OUT numint_w )
	$consulta="call cam_pupd_ctactepr('I',".$anoint.",".$numint.",'".$estado."','".$prov."',STR_TO_DATE('".$fecdoc."','%d/%m/%Y'),STR_TO_DATE('".$fecven."','%d/%m/%Y'),".$tipdoc.",".$nrodoc.",STR_TO_DATE('".$fecint."','%d/%m/%Y'),".$afecto.",".$exento.",".$especi.",".$iva.",".$reten.",".$total.",".$pagado.",'".$locres."','".$motivo."','".$locexi."',".$porde1.",".$vald1.",".$facaso.",'".$congui."','".$invent."',".$flete.",".$porde2.",".$vald2.",@numint_w)";
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
			//rescato el número interno de la compra
			$consulta = "SELECT @numint_w";
			$result   = mysqli_query($link,$consulta);
			$row      = mysqli_fetch_array($result);
			$numi_w = $row[0];

		    mysqli_close($link);

			}	
	
	// graba detalle
    for ($i = 0; $i < count($_SESSION["arrDetalles"]); $i++) 
    { 
	
	    $art =$_SESSION["arrDetalles"][$i]["art"]; 
       if ($art <> "") {
				$col = $_SESSION["arrDetalles"][$i]["col"]; 
				$tall = $_SESSION["arrDetalles"][$i]["tall"]; 
				$desc = $_SESSION["arrDetalles"][$i]["desc"]; 
				$cant = $_SESSION["arrDetalles"][$i]["cant"]; 
				$pcomp = $_SESSION["arrDetalles"][$i]["pcomp"]; 
				$pvta = $_SESSION["arrDetalles"][$i]["pvta"]; 
				$numsec = $i + 1;
		
		
				$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		//	                                        panoint ,pnumint     ,pcodloc , pcodpro  , pcodart  , pcodcol  , ptalla  HAR(3), punid  INT(6),pprecom,ppreven ,pdesart  ,pnumsec ,ptipdoc int(2),pfecdoc date ) 		
		   $sql1 = "call cam_pupd_compras('I',".$anoint.",".$numi_w.",".$locres.",'".$prov."','".$art."','".$col."','".$tall."',".$cant.",".$pcomp.",".$pvta.",'".$desc."',".$numsec.",".$tipdoc.",STR_TO_DATE('".$fecdoc."','%d/%m/%Y'))";
		echo $sql1;
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
     }
	 
	 echo "<script>opener.document.Form1.submit()</script>";
    echo "<script type=\"text/javascript\"> window.close(); </script>";
   

	
   }
?>
</body>
</HTML>
