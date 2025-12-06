<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedor.php";

	$obj = new proveedor();

	echo $obj->eliminaProveedor($_POST['idproveedor']);
?>