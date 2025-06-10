<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Inventario.php";

	$obj = new inventario();

	echo $obj->eliminaInventario($_POST['idinventario']);
?>