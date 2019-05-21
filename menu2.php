<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
 
<html>
 
<head>
  <title></title>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <style type="text/css">
ul.menu
{
	list-style:none;
}
ul.menu li
{
	position:relative;
	border:1px solid black;
	width:70px;
}
ul.menu ul
{
	position:absolute;
	left:30px;
	top:-1px;
	display:none;
	list-style:none;
}
ul.menu li:hover > ul
{
	display:block;
}

ul.menu2
{
	list-style:none;
}
ul.menu2 li
{
	border:1px solid black;
}
ul.menu2 ul
{
	display:none;
	list-style:none;
}
ul.menu2 li:hover > ul
{
	display:block;
}

ul.menu_color
{
	list-style:none;
}
ul.menu_color li
{
	display:block;
	position:relative;
	padding:1px 5px;
	background:#8888ff;
	border-right:1px solid blue;
	border-bottom:1px solid blue;
	border-top:1px solid #ccccff;
	border-left:1px solid #ccccff;
	width:80px;
}
ul.menu_color ul
{
	position:absolute;
	left:51px;
	top:-1px;
	display:none;
	list-style:none;
}
ul.menu_color li:hover
{
	background:#aaaaff;
	border-right:1px solid #ccccff;
	border-bottom:1px solid #ccccff;
	border-top:1px solid blue;
	border-left:1px solid blue;
}
ul.menu_color li:hover > ul
{
	display:block;
}


ul.menu_color2
{
	list-style:none;
}
ul.menu_color2 li
{
	display:block;
	position:relative;
	padding:1px 5px;
	background:#8888ff;
	border-right:1px solid blue;
	border-bottom:1px solid blue;
	border-top:1px solid #ccccff;
	border-left:1px solid #ccccff;
	width:80px;
}
ul.menu_color2 ul
{
	position:absolute;
	left:51px;
	top:-1px;
	display:none;
	list-style:none;
}
ul.menu_color2 > li > ul
{
	position:absolute;
	left:-41px;
	top:19px;
	display:none;
	list-style:none;
}

ul.menu_color2 li:hover
{
	background:#aaaaff;
	border-right:1px solid #ccccff;
	border-bottom:1px solid #ccccff;
	border-top:1px solid blue;
	border-left:1px solid blue;
}
ul.menu_color2 li:hover > ul
{
	display:block;
}
ul.menu_color2 > li
{
	display:inline;
}
</style>

  
  <script type="text/javascript" src="muestra_oculta.js"></script>
     <script language="javascript" type ="text/javascript" >
	
function oculta (capa) {
   document.getElementById(capa).style.visibility="hidden";
}

function muestra (capa) {
   document.getElementById(capa).style.visibility="visible";
}


		</script>

</head>
 
<body>

    <div id="capaPrincipal">
        <a href="#no ir" >MENÚ</a>
    </div>

    <div style="height:100px">

		<ul class="menu">
		   <li>opcion 1
		  <ul>
			 <li>una a</li>
			 <li>una b</li>
		  </ul>
	   </li>
	   <li>opcion 2
		  <ul>
			 <li>una c
				<ul>
				   <li>otra</li>
				   <li>mas</li>
				</ul>
			 </li>
			 <li>una d</li>
		  </ul>
	   </li>
	</ul>
   </div>
 	
   
</body>
 
</html>
