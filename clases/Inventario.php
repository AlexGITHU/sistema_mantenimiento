<?php

	class inventario{

		public function agregaInventario($datos){

		$c = new conectar();
		$conexion = $c->conexion();

		$sql = "INSERT INTO inventario (nombre_articulo, tipo_modelo, color, marca, medida, existencia, entrada, salida)
				values ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$datos[7]')";
		
		return mysqli_query($conexion, $sql);

		}

		public function obtenDatosInventario($idinventario){
			$c = new conectar();
			$conexion= $c->conexion();

			$sql="SELECT id_inventario,
							nombre_articulo,
							tipo_modelo,
							color,
							marca,
							medida,
							existencia,
							entrada,
							salida
						FROM inventario
						WHERE id_inventario = '$idinventario'";
					$result=mysqli_query($conexion, $sql);

					$ver=mysqli_fetch_row($result);

					$datos=array(
							'id_inventario' => $ver[0],
							'nombre_articulo' => $ver[1],
							'tipo_modelo' => $ver[2],
							'color' => $ver[3],
							'marca' => $ver[4],
							'medida' => $ver[5],
							'existencia' => $ver[6],
							'entrada' => $ver[7],
							'salida' => $ver[8]
								);
					return $datos;
		}

		public function actualizaInventario($datos){

		$c = new conectar();
		$conexion= $c->conexion();

		$sql="UPDATE inventario set nombre_articulo='$datos[1]',
										tipo_modelo='$datos[2]',
										color='$datos[3]',
										marca='$datos[4]',
										medida='$datos[5]',
										existencia='$datos[6]',
										entrada='$datos[7]',
										salida='$datos[8]'
									where id_inventario = '$datos[0]'";
		return mysqli_query($conexion, $sql);

		}

		public function eliminaInventario($idinventario){
			$c = new conectar();
			$conexion= $c->conexion();

			$sql = "DELETE from inventario where id_inventario='$idinventario'";

			return mysqli_query($conexion, $sql);


		}

	}

?>