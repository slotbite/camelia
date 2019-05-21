<?php
// Sistema			: NAZARETH
// Programa			: control.php.PHP
// Descripcion		: Menú principal sistema NAZARETH.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 17/05/2012

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/strict.dtd">
 
<html>
 
<head>
<title>CAMELIA</title>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <style type="text/css">

body{
	background:#fff;
}

/* Root = Horizontal, Secondary = Vertical */
ul#menu {
	ba
  margin: 0;
  border: 0 none;
  padding: 0;
/*  width: 500px;*/ /*For KHTML*/
width:360px;
  list-style: none;
  height: 20px;
  border:1px solid #eee;
  padding-bottom:5px;
}

ul#menu li {
  margin: 0;
  border: 0 none;
  padding: 0;
  float: left; /*For Gecko*/
  display: inline;
  list-style: none;
  position: relative;
  height: 20px;
}
ul#menu li{
	padding-bottom:5px;
}
ul#menu li:hover{
	background:#ddd;
}

ul#menu  ul {
  margin: 0;
  border: 0 none;
  padding: 0;
  width: 160px;
  list-style: none;
  display: none;
  position: absolute;
  top: 25px;
  left: 10px;
  background: #eee;
  border: none;
  opacity: 0.8;
  -moz-opacity: 0.8;
  filter:alpha(opacity=80);
}

ul#menu ul:after /*From IE 7 lack of compliance*/{
  clear: both;
  display: block;
  font: 1px/0px serif;
  content: ".";
  height: 0;
  visibility: hidden;
}

ul#menu ul li {
  width: 160px;
  float: left; /*For IE 7 lack of compliance*/
  display: block !important;
  display: inline; /*For IE*/
}

/* Root Menu */
ul#menu a {
  padding: 5px 15px 5px;
  float: none !important; /*For Opera*/
  float: left; /*For IE*/
  display: block;
  color: #9fcf21;
  text-decoration: none;
  font-weight: bold;
  font-family:Arial, Helvetica, sans-serif;
  font-size:12px;
  font-weight:bold;
/*  border-right:1px solid #818181;*/
  text-decoration: none;
  height: auto !important;
  height: 1%; /*For IE*/
}

/* Root Menu Hover Persistence */
ul#menu a:hover,
ul#menu li:hover a,
ul#menu li.iehover a {
color: #003300;

}

/* 2nd Menu */
ul#menu li:hover li a,
ul#menu li.iehover li a {
  float: none;
  border:none;
}

/* 2nd Menu Hover Persistence */
ul#menu li:hover li a:hover,
ul#menu li:hover li:hover a,
ul#menu li.iehover li a:hover,
ul#menu li.iehover li.iehover a {
 background:#ddd;
  color: #003300;
}

/* 3rd Menu */
ul#menu li:hover li:hover li a,
ul#menu li.iehover li.iehover li a {
  float: none;
  border:none;
}

/* 3rd Menu Hover Persistence */

ul#menu li:hover li:hover li a:hover,
ul#menu li:hover li:hover li:hover a,
ul#menu li.iehover li.iehover li a:hover,
ul#menu li.iehover li.iehover li.iehover a {
background:#ddd;
  color: #FFF;
}

/* 4th Menu */
ul#menu li:hover li:hover li:hover li a,
ul#menu li.iehover li.iehover li.iehover li a {
background:#ddd;
  color: #666;
}

/* 4th Menu Hover */
ul#menu li:hover li:hover li:hover li a:hover,
ul#menu li.iehover li.iehover li.iehover li a:hover {
  background: #CCC;
  color: #FFF;
}

ul#menu ul ul,
ul#menu ul ul ul {
  display: none;
  position: absolute;
  top: 0;
  left: 160px;
}

/* Do Not Move - Must Come Before display:block for Gecko */
ul#menu li:hover ul ul,
ul#menu li:hover ul ul ul,
ul#menu li.iehover ul ul,
ul#menu li.iehover ul ul ul {
  display: none;
}

ul#menu li:hover ul,
ul#menu ul li:hover ul,
ul#menu ul ul li:hover ul,
ul#menu li.iehover ul,
ul#menu ul li.iehover ul,
ul#menu ul ul li.iehover ul {
  display: block;
}
ul#menu .selected{
	color: #003300;
}</style>

  
     <script language="javascript" type ="text/javascript" >
	
			function f_open(pag,nombre){
			/*-------------------------*/
	              window.open( pag,nombre,'width=650, height=450, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=200, left=100').focus();
			
			}

		</script>

</head>
 
<body>
<div id="capaPrincipal" > 
<p><strong><em>CAMELIA CUEROS</em></strong> </p> 

<!--  <div align="left"><img src="ieco/logo_naz.jpg" width="364" height="99" /> 
  </div>
 -->  
</div>
<ul id="menu">
	<li><a class="selected" tihref="#">Inicio</a></li>
	<li><a href="#">Descargas</a>
		<ul>
			<li><a href="#">Soft Desktop</a>
				<ul>
					<li><a href="#">aaa</a></li>
					<li><a href="#">bbb</a></li>
				</ul>
			</li>
			<li><a href="#">Soft Móvil</a></li>
		</ul>
</li>
<li><a href="#">Localización</a></li>
<li><a href="#">Contacto</a></li>
</ul>
<div>
<ul id="menu11">
	
<!--   <li><a class="selected" tihref="#">Inicio</a></li>
 -->	
    <li><a href="#">Maestros</a> 
      <ul>
        <li><a href="javascript:f_open('nz001.php','ventana');">Productos</a></li>
        <li>
		<a href="javascript:f_open('nz003.php','ventana');">Insumos</a></li>
        <li><a href="javascript:f_open('nz006.php','ventana');">Rendimiento</a></li>
        <li><a href="javascript:f_open('nz004.php','ventana');">Proveedores</a></li>
        <li><a href="javascript:f_open('nz005.php','ventana');">Clientes</a></li>
        <li><a href="#">Tablas Generales</a> 
          <ul>
            <li><a href="javascript:f_open('nz002.php?CONCEPTO=tproducto','ventana');">Tipos 
              de Producto</a></li>
            <li><a href="javascript:f_open('nz002.php?CONCEPTO=fpago','ventana');">Formas 
              de Pago</a></li>
            <li><a href="javascript:f_open('nz002.php?CONCEPTO=unidad','ventana');">Unidades 
              de Medida</a></li>
            <li><a href="javascript:f_open('nz002.php?CONCEPTO=ciudad','ventana');">Ciudades</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="#">Movimientos</a> 
      <ul>
        <li><a href="javascript:f_open('nz007.php','ventana');">Compras</a></li>
        <li><a href="javascript:f_open('nz008.php','ventana');">Pedidos de Clientes</a></li>
        <li><a href="#">O/T Diarias</a></li>
        <li><a href="#">Emisión de Facturas</a></li>
        <li><a href="#">Pago de Facturas</a></li>
        <li><a href="#">Vales de Consumo</a></li>
        <li><a href="#">Pérdidas</a></li>
      </ul>
    </li>
    <li><a href="#">Informes</a> 
      <ul>
        <li><a href="#">Stock</a> 
          <ul>
            <li><a href="#">x Tipo Pan</a></li>
            <li><a href="#">x Insumo</a></li>
          </ul>
        </li>
        <li><a href="#">Compras</a> 
          <ul>
            <li><a href="#">x Fecha</a></li>
            <li><a href="#">x Proveedor</a></li>
            <li><a href="#">x Insumo</a></li>
          </ul>
        </li>
        <li><a href="#">Ventas</a> 
          <ul>
            <li><a href="#">x Fecha</a></li>
            <li><a href="#">x Cliente</a></li>
            <li><a href="#">x Tipo de Pan</a></li>
            <li><a href="#">x Forma de Pago</a></li>
          </ul>
        </li>
        <li><a href="#">Pagos</a></li>
        <li><a href="#">Mov. Tipos de Pan</a></li>
        <li><a href="#">Mov. Insumos</a></li>
      </ul>
    </li>

</ul>
</div>   
</body>
 
</html>
