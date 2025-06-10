<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inventario</title>
	<?php require_once "menu.php"; ?>
	<?php require_once "../clases/Conexion.php"; ?>
	<?php
	$c = new conectar();
	$conexion = $c->conexion();
	$sql = "SELECT id_inventario, nombre_articulo, tipo_modelo, color, marca, medida, existencia, entrada, salida from inventario";
	$resultado = mysqli_query($conexion, $sql);
	?>
</head>
<body>

<!-- Buenos dias! Sistemas le atiende "Nombre" -->
  <!-- Button Modal Form -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Insertar articulos en el Inventario
  </button>

  <!-- Modal Form -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Insertar Inventario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">

    <form id="frmInventario">

	<div class="col-sm-4">

        <label for="articulo" >Articulo</label>
        <input type="text" class="form-control input-sm" id="articulo" name="articulo">


        <label for="tipoModelo">Tipo Modelo</label>
        <input type="text" class="form-control input-sm" id="tipoModelo" name="tipoModelo">


        <label for="color">Color</label>
        <input type="text" class="form-control input-sm" id="color" name="color">


        <label for="marca" >Marca</label>
        <input type="text" class="form-control input-sm" id="marca" name="marca">


        <label for="medida" >Medida</label>
        <input type="text" class="form-control input-sm" id="medida" name="medida">

        <label for="existencia" >Existencia</label>
        <input type="text" class="form-control input-sm" id="existencia" name="existencia">

        <label for="entrada" >Entrada</label>
        <input type="text" class="form-control input-sm" id="entrada" name="entrada">

        <label for="salida">Salida</label>
        <input type="text" class="form-control input-sm" id="salida" name="salida">

	</div>
    </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button id="btnAgregaInventario" type="button" class="btn btn-primary">Agregar</button>
             
        <div class="col-sm-8">
					<div id="tablaArticulosLoad"></div>
				</div>

        </div>

      </div>
    </div>
  </div>
       

    <?php require_once "tablaInventario/tablaInventario.php"; ?>

					<!-- Button Modal Form Update -->


		<div class="modal fade" id="abremodalUpdateInventario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualiza Inventario</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
					</div>
					<div class="modal-body">
						<form id="frmInventarioU" enctype="multipart/form-data">
              <input type="text" id="idinventario" hidden="" name="idinventario">			
              <label>Articulo</label>
              <input type="text" class="form-control" id="nombre_articuloU" name="nombre_articuloU">
              <label>Tipo Modelo</label>
              <input type="text" class="form-control" id="tipo_modeloU" name="tipo_modeloU">
              <label>Color</label>
              <input type="text" class="form-control" id="colorU" name="colorU">
              <label>Marca</label>
              <input type="text" class="form-control" id="marcaU" name="marcaU">
              <label>Medida</label>
              <input type="text" class="form-control" id="medidaU" name="medidaU">
              <label>Existencia</label>
              <input type="text" class="form-control" id="existenciaU" name="existenciaU">
              <label>Entrada</label>
              <input type="text" class="form-control" id="entradaU" name="entradaU">
              <label>Salida</label>
              <input type="text" class="form-control" id="salidaU" name="salidaU">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaInventario" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>
		<button id="btnActualizaInventario" class="btn btn-success" onclick="window.location.href='exportarInventario.php'">
						<i class="bi bi-file-earmark-excel">Generar Excel</i>
					  </button>

</body>
</html>

	<script type="text/javascript">
		function agregaDatosInventario(idinventario){
			$.ajax({
				type:"POST",
				data:"idinventario=" + idinventario,
				url:"../procesos/inventario/obtenDatosInventario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idinventario').val(dato['id_inventario']);
					$('#nombre_articuloU').val(dato['nombre_articulo']);
					$('#tipo_modeloU').val(dato['tipo_modelo']);
					$('#colorU').val(dato['color']);
					$('#marcaU').val(dato['marca']);
					$('#medidaU').val(dato['medida']);
					$('#existenciaU').val(dato['existencia']);
					$('#entradaU').val(dato['entrada']);
					$('#salidaU').val(dato['salida']);


				}
			});


		}

		function eliminaInventario(idinventario){
			alertify.confirm('¿Desea eliminar este articulo del inventario?', function(){
				$.ajax({
					type:"POST",
					data:"idinventario=" + idinventario,
					url:"../procesos/inventario/eliminaInventario.php",
					success:function(r){
						if(r==1){
							$('#tablaInventarioLoad').load("tablaInventario/tablaInventario.php");
							alertify.success("Eliminado con Exito!");
						} else {
								alertify.error("No fue posible eliminar");
						}
					}
				});
			}, function(){
				alertify.error('Cancelado!');
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnActualizaInventario').click(function() {

				datos=$('#frmInventarioU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/inventario/actualizaInventario.php",
					success: function(r){
						if(r==1){
							$('#tablaInventarioLoad').load("tablaInventario/tablaInventario.php");
							alertify.success("Inventario Actualizado");
						} else {
								alertify.error("No se pudo actualizar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaInventarioLoad').load("tablaInventario/tablaInventario.php");
		
		$('#btnAgregaInventario').click(function(){

			vacios=validarFormVacio('frmInventario');

			if(vacios > 0){
				alertify.alert("Debes de llenar todos los campos!!");
				return false;
			}

			datos=$('#frmInventario').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/inventario/agregaInventario.php",
				success:function(r){
					if(r==1){
				$('#frmInventario')[0].reset();

				$('#tablaInventarioLoad').load("tablaInventario/tablaInventario.php");
				alertify.success("Articulo agregado al inventario");
			} else{
				alertify.error("No se pudo agregar el articulo")
				}
			}
		});
		
			});
		});
	</script>