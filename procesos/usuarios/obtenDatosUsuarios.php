<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	header(! isset($_POST['idusuarios']));
	echo json_encode(['error' => 'idusuarios no recibido']);
	exit;

	$obj = new usuarios();
	
	echo json_encode($obj->obtenDatosUsuarios(['idusuarios']));

?>