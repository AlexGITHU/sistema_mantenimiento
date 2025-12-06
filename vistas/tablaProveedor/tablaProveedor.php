<?php
	session_start();
    require_once __DIR__ . '/../../clases/Conexion.php';
	$c= new conectar();
	$conexion=$c->conexion();

	$search = isset($_GET['search']) ? mysqli_real_escape_string($conexion, $_GET['search']) : '';

	$filter = isset($_GET['filter']) ? intval($_GET['filter']) : 0;
	
	$sql="SELECT pro.nombre,
					pro.id_proveedor
				FROM proveedor as pro";
			$result=mysqli_query($conexion, $sql);


	$result = mysqli_query($conexion, $sql);

	function esObservador() {
		return isset($_SESSION['rol']) && $_SESSION['rol'] === 'Observador';
}

?>


	<div class="table-responsive">
        <table class="table table-striped table-hover" style="text-align: center;">
            <h1><label>Inventario</label></h1>
		<thead>
		<tr>	
		<td>Nombre</td>
		<td>Actualizar</td>
		<td>Eliminar</td>
		</thead>
		</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
		<tr>
		<tbody>
		<td><?php echo $ver[0]; ?></td>
		<td>
			<?php if (!esObservador()): ?>
			<button class="btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#abremodalProveedorUpdate" onclick="agregaDatosProveedor('<?php echo $ver[1]; ?>')">
				<i class="bi bi-pencil-square"></i>
			</button> 
			<?php endif; ?>
		</td>
		<td>
			<!-- olizet tio osea en plan wtfk -->
			<?php if (!esObservador()): ?>
			<button class="btn-danger btn-sm" onclick="eliminaProveedor('<?php echo $ver[1]; ?>')">
				<i class="bi bi-trash"></i>
			</button>
			<?php endif; ?>
		</td>
		</tbody>
		</tr>
		<?php endwhile; ?>
        </table>
	</div>