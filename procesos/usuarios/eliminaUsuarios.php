﻿<?php
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj = new usuarios();

	echo $obj->eliminaUsuarios($_POST['idusuarios']);

?>