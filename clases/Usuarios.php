<?php


	class usuarios{
		public function agregaUsuarios($datos){


		$c= new conectar();
		$conexion = $c->conexion();

		$fecha=date('Y-m-d');

		$sql = "INSERT INTO usuarios (nombre, apellido, contrasenia, fechaCaptura)
			values ('$datos[0]', '$datos[1]', '$datos[2]', '$fecha')";

			return mysqli_query($conexion, $sql);

		}

		public function obtenDatosUsuarios($idusuarios){
		$c = new conectar();
		$conexion = $c->conexion();

		$sql = "SELECT id_usuarios,
						nombre,
						apellido,
						contrasenia
				from usuarios
				where id_usuarios = '$idusuarios'";
		$result=mysqli_query($conexion, $sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
					'id_usuarios' => $ver[0],
						'nombre' => $ver[1],
						'apellido' => $ver[2],
						'contrasenia' => $ver[3]
					);
		return $datos;

		}

		public function actualizaUsuario($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set nombre='$datos[1]',
									apellido='$datos[2]',
									contrasenia='$datos[3]'
						where id_usuarios='$datos[0]'";
				return mysqli_query($conexion, $sql);

		}

		public function eliminaUsuario($idusuarios){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from usuarios
					where id_usuarios='$idusuarios'";
			return mysqli_query($conexion, $sql);
		}

	}

?>