<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Inventario.php";

	$obj = new inventario();
	
	echo json_encode($obj->obtenDatosInventario($_POST['idinventario']));

?>