<?php
	$c= new conectar();
	$conexion=$c->conexion();
	
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
?>


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
			<button class="btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#abremodalUpdateInventario" onclick="agregaDatosInventario('<?php echo $ver[8]; ?>')">
				<i class="bi bi-pencil-square"></i>
			</button>
		</td>
		<td>
			<button class="btn-danger btn-sm" onclick="eliminaInventario('<?php echo $ver[8]; ?>')">
				<i class="bi bi-trash"></i>
			</button>
		</td>
		</tbody>
		</tr>
		<?php endwhile; ?>
        </table>
	</div>