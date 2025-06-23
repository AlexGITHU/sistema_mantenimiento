<?php 
session_start();

function esObservador() {
  return isset($_SESSION['rol']) && $_SESSION['rol'] === 'Observador';
}
if(isset($_SESSION['usuario'])){

	?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventario</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

<!-- Buenos dias! Sistemas le atiende "Nombre" -->
  <!-- Button Modal Form -->
  <?php if (!esObservador()): ?>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Insertar articulos en el Inventario
  </button>
  <?php endif; ?>

  <!-- Modal Form -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Insertar Inventario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
        	<!-- youuuu sooo sexy, sexy, sexy -->
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
             

        </div>
      </div>
    </div>
  </div>
           <div class="col-sm-8">
					<div id="tablaInventarioLoad"></div>
				</div>

					<!-- Button Modal Form Update -->

		<div class="modal fade" id="abremodalInventarioUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualiza Inventario</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form id="frmInventariosU">
							<input type="text" id="idInventario" hidden="" name="idInventario">
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

		<?php if (!esObservador()): ?>
		<button id="btnexportarInventario" class="btn btn-success" onclick="window.location.href='exportarInventario.php'">
				<i class="bi bi-file-earmark-excel">Generar Excel</i>
		</button>
		<?php endif; ?>

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
					$('#idInventario').val(dato['id_inventario']);
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
		/* Script que actualiza la tabla en tiempo real con cada dato agregado */
		$(document).ready(function(){

			$('#tablaInventarioLoad').load("tablaInventario/tablaInventario.php");

			$('#btnAgregaInventario').click(function(){

				vacios=validarFormVacio('frmInventario');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
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
						}else{
							alertify.error("Error al agregar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		/* Script que actualiza la pagina en tiempo real cuando se actualiza un dato */
		$(document).ready(function(){
			$('#btnActualizaInventario').click(function(){
				datos=$('#frmInventariosU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/inventario/actualizaInventario.php",
					success:function(r){

						if(r==1){
							$('#frmInventariosU')[0].reset();
							$('#tablaInventarioLoad').load("tablaInventario/tablaInventario.php");
							alertify.success("Inventario Actualizado");
						}else{
							alertify.error("Imposible actualizar");
						}
					}
				});
			})
		})
	</script>


	<script>
function cargarTabla(search, filter){
  $('#tablaInventarioLoad').load(
    "tablaInventario/tablaInventario.php?search=" + encodeURIComponent(search)
    + "&filter=" + filter
  );
}
$(document).ready(function(){
  // Carga inicial sin filtros
  cargarTabla('', 0);

  // Intercepta el submit del buscador
  $(document).on('submit', '#busqueda', function(e){
    e.preventDefault();
    const texto = $('#inputBusqueda').val();
    const filtro = $('#filtro').val();
    cargarTabla(texto, filtro);
  });

  // Cuando cambie el select de filtros
  $(document).on('change', '#filtro', function(){
    const texto = $('#inputBusqueda').val();
    const filtro = $(this).val();
    cargarTabla(texto, filtro);
  });
});
</script>

<?php
		} else {
			header("location:../../index.php/");
		}
?>