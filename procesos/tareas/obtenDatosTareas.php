<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Tareas.php";

	$obj = new tareas();

	echo json_encode($obj->obtenDatosTareas($_POST['idcita']));
?>