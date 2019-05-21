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
		CKEditor Ejemplo
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
	<fieldset title="Output">
		<legend>Output</legend>
		<form action="/ckeditor/_samples/sample_posteddata.php" method="post">
			<p>
				<label for="editor1">
					Editor 1:</label><br/>
			</p>
			<p>
			<?php
				// Include CKEditor class.
				include_once "/ckeditor/ckeditor.php";
				// The initial value to be displayed in the editor.
				$initialValue = '<p>This is some <strong>sample text</strong>.</p>';
				// Create class instance.
				$CKEditor = new CKEditor();
				// Path to CKEditor directory, ideally instead of relative dir, use an absolute path:
				//   $CKEditor->basePath = '/ckeditor/'
				// If not set, CKEditor will try to detect the correct path.
				$CKEditor->basePath = '/ckeditor/';
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
				
				<input type="submit" value="Submit"/>
				
			</p>
		</form>
	</fieldset>
	<div id="footer">
		<hr />
		
	</div>
</body>
</html>
