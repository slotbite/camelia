<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
 
<html>
 
<head>
  <title></title>
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
ul#menu a {  padding: 5px 15px 5px;
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
  background: #EEE;
  color: #666;
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
}
</style>

  
     <script language="javascript" type ="text/javascript" >
	
			function f_open(pag,nombre){
			/*-------------------------*/
	              window.open( pag,nombre,'width=550, height=350, status= no, resizable= no, menubar=no, scrollbars=yes, location=no, top=150, left=200').focus();
			
			}

		</script>

</head>
 
<body>

<ul id="menu">
	<li><a class="selected" tihref="#">Inicio</a></li>
	<li><a href="#">Descargas</a>
		<ul>
			<li><a href="javascript:f_open('cam007.php','ventana');">Soft Desktop</a></li>
			<li><a href="#">Soft Móvil</a></li>
		</ul>
</li>
<li><a href="#">Localización</a>
		<ul>
			<li><a href="#">aa</a></li>
			<li><a href="#">zz</a></li>
		</ul>

</li>
<li><a href="#">Contacto</a></li>
</ul>   
</body>
 
</html>
