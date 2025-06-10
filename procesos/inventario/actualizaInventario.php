<?php

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Inventario";

	$obj = new inventario();

	$datos = array(
			$_POST['idInventario'],
			$_POST['nombre_articuloU'],
			$_POST['tipo_modeloU'],
			$_POST['colorU'],
			$_POST['marcaU'],
			$_POST['medidaU'],
			$_POST['exitenciaU'],
			$_POST['entradaU'],
			$_POST['salidaU']
				);
	echo $obj->actualizaInventario($datos);
?>