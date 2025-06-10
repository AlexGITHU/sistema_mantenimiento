<?php
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT id_usuarios,
			nombre,
			apellido,
			contrasenia
		FROM usuarios";
		$result=mysqli_query($conexion, $sql);
?>

	<div class="table-responsive">
	<table class="table table-striped table-hover">
	    <h1><label>Usuarios</label></h1>
		<thead>
		<tr>
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Contraseña</td>
		<td>Actualizar</td>
		<td>Eliminar</td>
		</tr>
		</thead>
		<?php while($ver=mysqli_fetch_row($result)): ?>
		<tbody>
		<td><?php echo $ver[1] ?></td>
		<td><?php echo $ver[2] ?></td>
		<td><?php echo $ver[3] ?></td>
		<td>
			<button class="btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#actualizaUsuario" onclick="agregaDatosUsuarios('<?php echo $ver[0]; ?>')">
				<i class="bi bi-pencil-square"></i>
			</button>
		</td>
		<td>
			<button class="btn-danger btn-sm" onclick="eliminaUsuario('<?php echo $ver[0]; ?>')">
				<i class="bi bi-trash"></i>
			</button>
		</td>
		</tbody>
		</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>