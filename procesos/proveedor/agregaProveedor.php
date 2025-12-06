<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedor.php";

	$obj = new proveedor();
	
	$datos = array(
			$_POST['nombre']
	);
	echo $obj->agregaDatosProveedor($datos);

?>