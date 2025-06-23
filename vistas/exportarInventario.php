<?php
	require_once "../clases/Conexion.php";

	$c = new conectar();
	$conexion= $c->conexion();

	$sql= "SELECT id_inventario,
							nombre_articulo,
							tipo_modelo,
							color,
							marca,
							medida,
							existencia,
							entrada,
							salida
						FROM inventario";

	$result = mysqli_query($conexion, $sql);

	header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
	header("Content-Disposition: attachment; filename=Inventario_".date("Y-m-d").".xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo "<table border='1'>";

	echo "<tr>";
			echo "<th>Articulo</th>";
			echo "<th>Tipo Modelo</th>";
			echo "<th>Color</th>";
			echo "<th>Marca</th>";
			echo "<th>Medida</th>";
			echo "<th>Existencia</th>";
			echo "<th>Entrada</th>";
			echo "<th>Salida</th>";
	echo "<tr>";

	while ($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
			echo "<td>" . utf8_decode($row['nombre_articulo']) . "</td>";
			echo "<td>" . utf8_decode($row['tipo_modelo']) . "</td>";
			echo "<td>" . utf8_decode($row['color']) . "</td>";
			echo "<td>" . utf8_decode($row['marca']) . "</td>";
			echo "<td>" . utf8_decode($row['medida']) . "</td>";
			echo "<td>" . $row['existencia'] . "</td>";
			echo "<td>" . $row['entrada'] . "</td>";
			echo "<td>" . $row['salida'] . "</td>";
		echo "</tr>";
	}

	echo "</table>";

	exit;
?>