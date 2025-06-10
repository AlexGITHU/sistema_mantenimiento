<?php

	class tareas {
		public function agregaTareas($datos){
			$c= new conectar();
			$conexion = $c->conexion();

			$sql = "INSERT INTO tareas(id_usuarios, nombreTarea, descripcion) 
					VALUES ('$datos[0]', '$datos[1]', '$datos[2]')";
			return mysqli_query($conexion, $sql);
		}

		public function obtenDatosTarea($idtareas){
			$c = new conectar();
			$conexion = $c->conexion();

			$sql = "SELECT id_tareas,
						   id_usuarios,
						   nombreTarea,
						   personaNombre,
						   descripcion
						   FROM tareas
						   WHERE id_tareas='$idtareas'";
			$result = mysqli_query($conexion, $sql);

			$ver = mysqli_fetch_row($result);

			$datos=array(
					"id_tareas" => $ver[0],
					"id_usuarios" => $ver[1],
					"nombreTarea" => $ver[2],
					"descripcion" => $ver[4]
						);

			return $datos;
		}

		public function actualizaTareas($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE tareas set id_usuarios='$datos[1]', 
										nombreTarea='$datos[2]',
										descripcion='$datos[3]'
						where id_tareas='$datos[0]'";

			return mysqli_query($conexion,$sql);
		}


		public function eliminaTarea($idtareas){
			$c = new conectar();
			$conexion = $c->conexion();

			$sql = "DELETE FROM tareas
					WHERE id_tareas='$idtareas'";

			return mysqli_query($conexion, $sql);
		}
	}

?>