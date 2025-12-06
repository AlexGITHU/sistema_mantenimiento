<?php

	class proveedor{

		public function agregaDatosProveedor($datos){

		$c = new conectar();
		$conexion = $c->conexion();

		$sql = "INSERT INTO proveedor (nombre)
				values ('$datos[0]')";
		
		return mysqli_query($conexion, $sql);

		}

		public function obtenDatosProveedor($idproveedor){
			$c = new conectar();
			$conexion = $c->conexion();

			$sql="SELECT id_proveedor, 
							nombre
				FROM proveedor
				WHERE id_proveedor = '$idproveedor'";
			$result = mysqli_query($conexion, $sql);

			$ver = mysqli_fetch_row($result);

			$datos=array(
					'id_proveedor' => $ver[0],
					'nombre' => $ver[1]
						);
			return $datos;
			echo $datos;
		}

		// Afroamericano Judio Ortodoxo

		public function actualizaProveedor($datos){

		$c = new conectar();
		$conexion= $c->conexion();

		$sql="UPDATE proveedor set nombre='$datos[1]'
									where id_proveedor = '$datos[0]'";
		return mysqli_query($conexion, $sql);

		}

		public function eliminaProveedor($idproveedor){
			$c = new conectar();
			$conexion= $c->conexion();

			$sql = "DELETE from proveedor where id_proveedor='$idproveedor'";

			return mysqli_query($conexion, $sql);


		}

	}