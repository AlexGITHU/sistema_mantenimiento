<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj = new usuarios();

	$datos = array(
			$_POST['idusuarios']
			$_POST['nombreU'],
			$_POST['apellidoU'],
			$_POST['contraseniaU']
			);
	
	echo $obj->actualizaUsuario($datos);

?>