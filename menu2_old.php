<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
 
<html>
 
<head>
  <title></title>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <link rel="stylesheet" href="menu_estilo.css" type="text/css">
  <script type="text/javascript" src="muestra_oculta.js"></script>
     <script language="javascript" type ="text/javascript" >
	
function oculta(capa) {
   document.getElementById(capa).style.visibility="hidden";
}

function muestra(capa) {
   document.getElementById(capa).style.visibility="visible";
}


	</script>

</head>
 
<body>
    <div id="capaPrincipal">
        <a href="#no ir" onmouseover="muestra('menu1');" onmouseout="oculta('menu1');">MENÚ</a>
    </div>
 
    <div id="menu1" >
        <ul>
            <li><a href="#no ir" onmouseover="muestra('menu2');" onmouseout="oculta('menu2');">enlace 1</a>
			    <div id="menu2"">

			 <ul>
            	<li><a href="#no ir">enlace 1</a>
			</ul>
			    </div>
	
			</li>
            <li><a href="#no ir">enlace 2</a></li>
            <li><a href="#no ir">enlace 3</a></li>
            <li><a href="#no ir">enlace 4</a></li>
            <li><a href="#no ir">enlace 5</a></li>
            <li><a href="#no ir">enlace 6</a></li>
        </ul>
    </div>
 
</body>
 
</html>
