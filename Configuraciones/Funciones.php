<?php
	$host_mysql = "localhost";
	$user_mysql = "root";
	$pass_mysql = "";
	$db_mysql = "colombia_absent";
	$conexion=new mysqli($host_mysql,$user_mysql,$pass_mysql,$db_mysql);
	if($conexion->connect_errno){
		echo "Error al conectar con la base de datos";
	}
?>