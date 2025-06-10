<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Tareas.php";

	$obj = new tareas();

	$datos = array(
	        $_POST['personaSelect'],
	        $_POST['nombreTarea'],
	        $_POST['descripcion']
	);

	echo $obj->agregaTareas($datos);
?>