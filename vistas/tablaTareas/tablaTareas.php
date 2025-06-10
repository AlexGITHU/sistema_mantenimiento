	<?php 
			require_once "../clases/Conexion.php";

			$c= new conectar();
			$conexion=$c->conexion();

			$sql = "SELECT tar.nombreTarea,
				   tar.descripcion,
				   usu.nombre,
				   tar.id_tareas,
				   usu.nombre
			FROM tareas as tar
			inner join usuarios as usu on tar.id_usuarios=usu.id_usuarios";
			$result=mysqli_query($conexion,$sql);
	 ?>

    <div class="table-responsive">


		<table class="table table-striped table-hover">
			<h1><label>Tareas Asignadas<label></h1>
			<thead>	
			<tr>
				<td>Nombre Tarea</td>
				<td>Persona Nombre</td>
				<td>Descripción</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
			</thead>
			<?php while($ver=mysqli_fetch_row($result)): ?>
			<tbody>
			<tr>
				<td><?php echo $ver[0]; ?></td>
				<td><?php echo $ver[1]; ?></td>
				<td><?php echo $ver[2]; ?></td>
				<td>
	
					<button class="btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#abremodalUpdateTarea" onclick="agregaDatosTarea('<?php echo $ver[3]; ?>')">
					<i class="bi bi-pencil-square"></i>
					</button>
				</td>
		<td>
			<button class="btn-danger btn-sm" onclick="eliminaTarea('<?php echo $ver[3]; ?>')">
				<i class="bi bi-trash"></i>
			</button>
		</td>
			</tr>
			</tbody>
			<?php endwhile; ?>
		</table>
	</div>