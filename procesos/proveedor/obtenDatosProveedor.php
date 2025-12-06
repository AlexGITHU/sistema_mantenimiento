<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedor.php";

	$obj = new proveedor();
	
	echo json_encode($obj->obtenDatosProveedor($_POST['idproveedor']));

?>