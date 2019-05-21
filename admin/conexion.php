<?php

function conectar () {
	
	$db_con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	if (!$db_con) return false; 
	return $db_con; 

}

?>