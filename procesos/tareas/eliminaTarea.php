<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Tareas.php";

	$obj = new tareas();

	echo $obj->eliminaTarea($_POST['idtareas']);
?>