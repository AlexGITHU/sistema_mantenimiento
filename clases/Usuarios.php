<?php


	class usuarios{
		public function agregaUsuarios($datos){


		$c= new conectar();
		$conexion = $c->conexion();

		$fecha=date('Y-m-d');

		$sql = "INSERT INTO usuarios (nombre, apellido, rol, contrasenia, fechaCaptura)
			values ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$fecha')";

			return mysqli_query($conexion, $sql);

		}

		public function obtenDatosUsuarios($idusuario){
		$c = new conectar();
		$conexion = $c->conexion();

		$sql = "SELECT id_usuarios,
						nombre,
						apellido,
						rol,
						contrasenia
						from usuarios
						where id_usuarios = '$idusuario'";
		$result=mysqli_query($conexion, $sql);

		$ver=mysqli_fetch_row($result);

		$datos=array(
					'id_usuarios' => $ver[0],
						'nombre' => $ver[1],
						'apellido' => $ver[2],
						'rol' => $ver[3],
						'contrasenia' => $ver[4]
					);
		return $datos;

		}

		public function actualizaUsuario($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuarios set nombre='$datos[1]',
									apellido='$datos[2]',
									rol='$datos[3]',
									contrasenia='$datos[4]'
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

		public function loginUser($datos){
			$c=new conectar();
			$conexion = $c->conexion();

			$usuario = $datos[0];
			$contrasenia=$datos[1];

			$sql = "SELECT * FROM usuarios WHERE nombre='$usuario' AND contrasenia = '$contrasenia'";
			$result=mysqli_query($conexion, $sql);

			if(mysqli_num_rows($result) > 0){
			$userData = mysqli_fetch_assoc($result);
			$_SESSION['usuario'] = $usuario;
			$_SESSION['iduser'] = $userData['id_usuarios'];
			$_SESSION['rol'] = $userData['rol'];
				return 1;
			} else {
				return 0;
			}
		}


		public function traeID($datos){
			$c = new conectar();
			$conexion = $c->conexion();

			$usuario = $datos[0];
			$contrasenia = $datos[1];

			$sql="SELECT id_usuarios from usuarios where nombre='$usuario' AND contrasenia = '$contrasenia'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

	}

?>
