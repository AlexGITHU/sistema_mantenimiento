<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Quejas.php";

	$obj = new quejas();

	$datos = array(
		$_POST['nombre_queja'],
		$_POST['descripcion']
	);

	echo $obj->agregaQuejas($datos);
?>