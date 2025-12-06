<?php
	session_start();
	require_once "../../clases/Conexion.php";

	$c = new conectar();
	$conexion = $c->conexion();

	$sql = "SELECT id_quejas,
				   nombre_queja,
				   descripcion
			FROM wo_quejas";
	$result = mysqli_query($conexion, $sql);
?>
<div class="table-responsibe">
	<table class="table table-striped table-hover">
		<h1><label>Quejas</label></h1>
	<thead>
		<tr>
			<td>Quejas</td>
			<td>Descripción</td>
			<td>Actualizar</td>
			<td>Eliminar</td>
		</tr>
	</thead>
	<?php while($ver = mysqli_fetch_row($result)): ?>
	<tbody>
		<tr>
			<td><?php echo $ver[1]; ?></td>
			<td><?php echo $ver[2]; ?></td>
			<td><button class="btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#abremodalQuejasUpdate" onclick="agregaDatosQuejas('<?php echo $ver[0]; ?>')">
				<i></i>
				</button>
			</td>
			<td>
				<button class="btn-danger btn-sm" onclick="eliminaQuejas('<?php echo $ver[0]; ?>')">
					<i></i>
				</button>
			</td>
			<!-- ¿Podria ser el fin del hombre araña? -->
			</tbody>
		</tr>
	<?php endwhile; ?>
	</table>
</div>