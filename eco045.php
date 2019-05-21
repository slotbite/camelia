<?php
// Sistema			: ECO
// Programa			: ECO45.PHP
// Descripcion		: Mantención de Plantillas de Exámenes.
// Programador(a) 	: Roxana Ramírez Vega
// F.Inicio 		: 04/01/2011.

session_start();
if (!isset($_SESSION["detalle_s"])){ $_SESSION['detalle_s']="";} 

require_once 'admin/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Mantención Plantillas Exámenes</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type"/>
	<link href="/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css"/>
	<link href="ecocss/vvppcss.css" type="text/css" rel="stylesheet" />

</head>
<body>
<?php

if (!empty( $_GET["CODIGO"] ) ) {
   $codigo_w = $_GET["CODIGO"]; 
   $pos = strpos($codigo_w, '.');

	if ($pos > 0) {
	    $cod_w = substr($codigo_w, 0, $pos);
	    $nombre_w = substr($codigo_w, $pos + 1);
	} 
}
else{
   $codigo_w = "";
   $cod_w = "";
   $nombre_w = "";
}
/*
echo $codigo_w ."<br>";
echo $cod_w ."<br>" ;
echo $nombre_w ."<br>" ;
*/
?>
	<!-- This <fieldset> holds the HTML that you will usually find in your pages. -->
	<fieldset title="PLANTILLA EXAMEN">
<?php echo '<legend class="texto18">EXÁMEN '.$nombre_w.' </legend>'; ?>

	<form  id="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>" >
		
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
	}  
}

if (isset($_POST['editor1'])){
	$detalle_w  = $_POST['editor1'];
	}
else{
	$detalle_w = "";
}

if ($_GET["CODIGO"] > 0)
    {
	$modo_w = "M";
	
	if (!$_POST)

	{ 
	
	//Conexion con la base
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	
	//Ejecutamos la sentencia SQL
//	$consulta="call ECO_PSEL_EXAMENES('".$_GET["CODIGO"]."',null,null,null,null,null,'1')";
	$consulta="call ECO_PSEL_DESCRIPCIONES('".$cod_w."','EXAMEN',null)";

	$result=mysqli_query($link,$consulta);

	//Mostramos los registros
	while ($row=mysqli_fetch_array($result))
		{
		$detalle_w  	= html_entity_decode( $row["TPLANTILLA"] );
		}
		
	mysqli_free_result($result);
	mysqli_close($link);
	}
}

?>
			<p>
				<label for="editor1" ></label><br/>
				</label><br/>
			</p>
			<p style="width: 750px; height: 3px">
			<?php

				// Include CKEditor class.
				include_once "ckeditor/ckeditor.php";

				// The initial value to be displayed in the editor.
				$initialValue = $detalle_w;
				if (isset($_POST['editor1'])) 
				{
				$initialValue = $_POST['editor1'];
				}

				// Create class instance.
				$CKEditor = new CKEditor();
				// Path to CKEditor directory, ideally instead of relative dir, use an absolute path:
				//   $CKEditor->basePath = '/ckeditor/'
				// If not set, CKEditor will try to detect the correct path.
				$CKEditor->basePath = 'ckeditor/';
				// Create textarea element and attach CKEditor to it.
				
	//			$CKEditor->editor("editor1", $initialValue);
	
		 		$config = array();
				/*
				$config['toolbar'] = array(
				  array( 'Format', 'Font','FontSize' ),
				  array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ),
				  array( 'NumberedList', 'BulletedList','-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Undo','Redo')
				  );
				  */
				 $config['format_tags'] = 'div;p;h1;h2;h3;h4;h5;h6;pre;address' ;
				 $config['enterMode'] = 3;
				 $config['forceEnterMode'] = true;
				 $config['height'] = 500;
				 $config['width '] = 650;
				 $config['resize_enabled'] = false;
				 $config['tabSpaces'] = 6;

	  			$CKEditor->editor("editor1", $initialValue, $config);
//				$CKEditor->editor("editor1", $initialValue);
				?>
				
				<input type="submit" value="Grabar" name="bt_grabar" id="bt_grabar"/>
				
			</p>
		</form>
		</fieldset>
<?php

if ($_POST)
{
 if(isset($_POST["bt_grabar"])) 
 {

	//$texto_w = $initialValue;
	$texto_w = $_POST["editor1"];
	$_SESSION['detalle_s'] = $texto_w; 
//	echo $texto_w;
	
	if ( get_magic_quotes_gpc() )
		$texto1_w = htmlspecialchars( stripslashes( $texto_w ) ) ;
	else
		$texto1_w = htmlspecialchars( $texto_w ) ;

//	echo $texto_w;
//	exit();
	
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//	$sql1 = "UPDATE prueba SET texto = '".$texto1_w."' WHERE id = 1";
	//		$sql1 = "call ECO_PUPD_DESCRIPCIONES('I',null,'".$desc_w."','S','CIUDAD',null,null,null)";
		$sql1 = "call ECO_PUPD_DESCRIPCIONES('M',".$cod_w.",'".$nombre_w."',null,'EXAMEN',null,null,null,'".$texto1_w."')";
	
// echo $sql1;
// exit();
        $query = mysqli_query($link,$sql1);
		if ( !$query ) 
			{ $error = mysqli_error($link);
			 $merror = "Ocurrio un error al grabar los datos: " . mysqli_errno($link);
		     $nerror  = mysqli_errno($link );
		     if (mysqli_errno($link ) == 1062)
			    {
				$merror = "El registro ya existe....." ;
				} 
				
			echo "<script type=\"text/javascript\">
				alert('Error: \' $merror \' .');
				</script>";

			mysqli_close($link);
			exit();

			}
		else
		   {
			echo "<script type=\"text/javascript\">
				alert('El Examen ha sido registrado de manera satisfactoria.');
				</script>";
			
/*			echo "<script>document.Form1.submit();</script>";
echo "<script>opener.document.Form1.submit();</script>";
*/
		
		echo "<script>window.close();</script>";

		   }//cierras todos los else que abras

 }
} 
?>		
		
	
</body>
</html>
