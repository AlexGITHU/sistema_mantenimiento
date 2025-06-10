<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj = new usuarios();

	$datos = array(
			$_POST['nombre'],
			$_POST['apellido'],
			$_POST['contrasenia']
	);
	echo $obj->agregaUsuarios($datos);

?>