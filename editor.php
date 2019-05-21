<?php
require_once 'admin/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Ejemplo - CKEditor - PHP</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type"/>
	<link href="/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<h1>
		Ejemplo Edición Detalle
	</h1>
	<!-- This <div> holds alert messages to be display in the sample page. -->
	<div id="alerts">
		<noscript>
			<p>
				<strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
				support, like yours, you should still see the contents (HTML data) and you should
				be able to edit it normally, without a rich editor interface.
			</p>
		</noscript>
	</div>
	<!-- This <fieldset> holds the HTML that you will usually find in your pages. -->
	<fieldset title="EXÁMEN ECOTOMOGRAFÏA ABDOMINAL">
		<legend>EXÁMEN ECOTOMOGRAFÏA ABDOMINAL</legend>
		<form  id="Form1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
		<p>
				<label>Paciente: Juanito Pérez González</label><br/>
				</label><br/>
				
				<label>Fecha: 29/12/2010</label><br/>
				</label><br/>
			</p>
			<p>
				<label for="editor1">
					Detalle:</label><br/>
				</label><br/>
			</p>
			<p>
			<?php

				// Include CKEditor class.
				include_once "ckeditor/ckeditor.php";

				// The initial value to be displayed in the editor.
				$initialValue = '<p>This is some <strong>sample text</strong>.</p>';
				
				$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
				$consulta="select * from prueba where id=1";
				$result=mysqli_query($link,$consulta);

				while ($row=mysqli_fetch_array($result))
					{
					$initialValue   = html_entity_decode($row["texto"]);
					}
					
				mysqli_free_result($result);
				mysqli_close($link);
				

				// Create class instance.
				$CKEditor = new CKEditor();
				// Path to CKEditor directory, ideally instead of relative dir, use an absolute path:
				//   $CKEditor->basePath = '/ckeditor/'
				// If not set, CKEditor will try to detect the correct path.
				$CKEditor->basePath = 'ckeditor/';
				// Create textarea element and attach CKEditor to it.
				
	//			$CKEditor->editor("editor1", $initialValue);
		 		$config = array();
				$config['toolbar'] = array(
				  array( 'Format', 'Font','FontSize' ),
				  array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ),
				  array( 'NumberedList', 'BulletedList','-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Undo','Redo')
				  );
	  
	  			$CKEditor->editor("editor1", $initialValue, $config);
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
//	echo $texto_w;
	
	if ( get_magic_quotes_gpc() )
		$texto1_w = htmlspecialchars( stripslashes( $texto_w ) ) ;
	else
		$texto1_w = htmlspecialchars( $texto_w ) ;

//	echo $texto_w;
//	exit();
	
	$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$sql1 = "UPDATE prueba SET texto = '".$texto1_w."' WHERE id = 1";
	
// echo $sql1;
 //exit();
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
				alert('El Texto ha sido registrado de manera satisfactoria.');
				</script>";
			
			echo "<script>document.Form1.submit();</script>";

		   }//cierras todos los else que abras

 }
} 
?>		
		
	
</body>
</html>
