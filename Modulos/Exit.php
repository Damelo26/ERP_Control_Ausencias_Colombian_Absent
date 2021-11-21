<?php 
	session_start();
	session_destroy();
	header('location: ../index.php');
	$datos_persona = " ";
	$json_string = json_encode($datos_persona);
    $file = '../usuario.json';
    file_put_contents($file, $json_string);
 ?>