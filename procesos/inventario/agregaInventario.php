<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Inventario.php";

	$obj = new inventario();
	
	$datos = array(
			$_POST['articulo'],
			$_POST['tipoModelo'],
			$_POST['color'],
			$_POST['marca'],
			$_POST['medida'],
			$_POST['existencia'],
			$_POST['entrada'],
			$_POST['salida']
	);
	echo $obj->agregaInventario($datos);

?>