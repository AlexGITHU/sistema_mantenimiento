<?php
	session_start();
    require_once __DIR__ . '/../../clases/Conexion.php';
	$c= new conectar();
	$conexion=$c->conexion();

	$search = isset($_GET['search']) ? mysqli_real_escape_string($conexion, $_GET['search']) : '';

	$filter = isset($_GET['filter']) ? intval($_GET['filter']) : 0;
	
	$sql="SELECT inv.nombre_articulo,
					inv.tipo_modelo,
					inv.color,
					inv.marca,
					inv.medida,
					inv.existencia,
					inv.entrada,
					inv.salida,
					inv.id_inventario
				FROM inventario as inv";
			$result=mysqli_query($conexion, $sql);

	if ($search !== ''){
		$sql .= " WHERE (
		inv.nombre_articulo LIKE '%{$search}%'
		OR inv.tipo_modelo LIKE '%{$search}%'
		OR inv.color LIKE '%{$search}%'
		OR inv.marca LIKE '%{$search}%'
		OR inv.medida LIKE '%{$search}%'
	)";

	}

	switch ($filter) {
		case 1:
			$sql .= " ORDER BY inv.existencia DESC";
			break;

		case 2:
			$sql .= " ORDER BY inv.entrada DESC";
			break;

		case 3:
			$sql .= " ORDER BY inv.salida DESC";
			break;

		case 4:
			$sql .= " ORDER BY inv.nombre_articulo ASC";
			break;
		
		default:
			// code... WTX-66-05
			break;
	}

	$result = mysqli_query($conexion, $sql);

	function esObservador() {
		return isset($_SESSION['rol']) && $_SESSION['rol'] === 'Observador';
}

?>

	  <form class="d-flex mb-2" role="search" id="busqueda">
        <input class="form-control me-2" type="search" placeholder="Buscar" id="inputBusqueda" name="search" aria-label="Buscar" value="<?php echo htmlspecialchars($search); ?>" />
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>

      <select class="form-select form-select-sm mb-3" id="filtro" aria-label="Small select example">
  	  <option value="0" <?php echo $filter === 0 ? 'selected' : ''; ?> >Filtrar por...</option>
  	  <option value="1" <?php echo $filter === 1 ? 'selected' : ''; ?> >Existencia</option>
  	  <option value="2" <?php echo $filter === 2 ? 'selected' : ''; ?>>Entrada</option>
  	  <option value="3" <?php echo $filter === 3 ? 'selected' : ''; ?>>Salida</option>
  	  <option value="4" <?php echo $filter === 4 ? 'selected' : ''; ?>>Alfabetico</option>
	  </select>

	<div class="table-responsive">
        <table class="table table-striped table-hover" style="text-align: center;">
            <h1><label>Inventario</label></h1>
		<thead>
		<tr>	
		<td>Articulo</td>
		<td>Tipo Modelo</td>
		<td>Color</td>
		<td>Marca</td>
		<td>Medida</td>
		<td>Existencia</td>
		<td>Entrada</td>
		<td>Salida</td>
		<td>Actualizar</td>
		<td>Eliminar</td>
		</thead>
		</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
		<tr>
		<tbody>
		<td><?php echo $ver[0]; ?></td>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>
		<td><?php echo $ver[6]; ?></td>
		<td><?php echo $ver[7]; ?></td>
		<td>
			<?php if (!esObservador()): ?>
			<button class="btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#abremodalInventarioUpdate" onclick="agregaDatosInventario('<?php echo $ver[8]; ?>')">
				<i class="bi bi-pencil-square"></i>
			</button> 
			<?php endif; ?>
		</td>
		<td>
			<!-- olizet tio osea en plan wtfk -->
			<?php if (!esObservador()): ?>
			<button class="btn-danger btn-sm" onclick="eliminaInventario('<?php echo $ver[8]; ?>')">
				<i class="bi bi-trash"></i>
			</button>
			<?php endif; ?>
		</td>
		</tbody>
		</tr>
		<?php endwhile; ?>
        </table>
	</div>