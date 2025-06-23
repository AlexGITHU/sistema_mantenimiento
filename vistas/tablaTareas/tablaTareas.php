	<?php
			session_start(); 
			require_once __DIR__ . '/../../clases/Conexion.php';

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

			function esObservador() {
				return isset($_SESSION['rol']) && $_SESSION['rol'] === 'Observador';
			}
	 ?>

	<div class="table-responsive">
        <table class="table table-striped table-hover" style="text-align: center;">
            <h1><label>Tareas Asignadas</label></h1>
			<thead>
			<tr>
				<td>Nombre Tarea</td>
				<td>Persona Nombre</td>
				<td>Descripción</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</thead>
			</tr>
			<?php while($ver=mysqli_fetch_row($result)): ?>
			<tbody>
			<tr>
				<td><?php echo $ver[0]; ?></td>
				<td><?php echo $ver[1]; ?></td>
				<td><?php echo $ver[2]; ?></td>
				<td>
				<?php if (!esObservador()): ?>
					<button class="btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#abremodalUpdateTarea" onclick="agregaDatosTarea('<?php echo $ver[3]; ?>')">
					<i class="bi bi-pencil-square"></i>
					</button>
				<?php endif; ?>
				</td>
		<td>
			<?php if (!esObservador()): ?>
			<button class="btn-danger btn-sm" onclick="eliminaTarea('<?php echo $ver[3]; ?>')">
				<i class="bi bi-trash"></i>
			</button>
			<?php endif; ?>
		</td>
			</tr>
			</tbody>
			<?php endwhile; ?>
		</table>
	</div>