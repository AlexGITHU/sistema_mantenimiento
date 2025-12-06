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
    <title>Proovedores</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

<!-- Buenos dias! Sistemas le atiende "Nombre" -->
  <!-- Button Modal Form -->
  <?php if (!esObservador()): ?>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Insertar Proveedor
  </button>
  <?php endif; ?>

  <!-- Modal Form -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalLabel">Insertar Proveedor</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
        	<!-- youuuu sooo sexy, sexy, sexy -->
    <form id="frmProveedor">

	<div class="col-sm-4">

        <label for="nombre" >Nombre</label>
        <input type="text" class="form-control input-sm" id="nombre" name="nombre">
	</div>
    </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button id="btnAgregaProveedor" type="button" class="btn btn-primary">Agregar</button>
             

        </div>
      </div>
    </div>
  </div>
           <div class="col-sm-8">
					<div id="tablaProveedorLoad"></div>
				</div>

					<!-- Button Modal Form Update -->

		<div class="modal fade" id="abremodalProveedorUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualiza Proveedor</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form id="frmProveedorU">
							<input type="text" id="idProveedor" hidden="" name="idProveedor">
							<label>Nombre</label>
              <input type="text" class="form-control" id="nombreU" name="nombreU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaProveedor" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

</body>
</html>

	<script type="text/javascript">
		function agregaDatosProveedor(idproveedor){

			$.ajax({
				type:"POST",
				data:"idproveedor=" + idproveedor,
				url:"../procesos/proveedor/obtenDatosProveedor.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idProveedor').val(dato['id_proveedor']);
					$('#nombreU').val(dato['nombre']);

				}
			});
		}

		function eliminaProveedor(idproveedor){
			alertify.confirm('¿Desea eliminar este proveedor de la lista?', function(){
				$.ajax({
					type:"POST",
					data:"idproveedor=" + idproveedor,
					url:"../procesos/proveedor/eliminaProveedor.php",
					success:function(r){
						if(r==1){
							$('#tablaProveedorLoad').load("tablaProveedor/tablaProveedor.php");
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

			$('#tablaProveedorLoad').load("tablaProveedor/tablaProveedor.php");

			$('#btnAgregaProveedor').click(function(){

				vacios=validarFormVacio('frmProveedor');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmProveedor').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/proveedor/agregaProveedor.php",
					success:function(r){

						if(r==1){
							$('#frmProveedor')[0].reset();
							$('#tablaProveedorLoad').load("tablaProveedor/tablaProveedor.php");
							alertify.success("Proveedor agregado a la lista");
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
			$('#btnActualizaProveedor').click(function(){
				datos=$('#frmProveedorU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/proveedor/actualizaProveedor.php",
					success:function(r){

						if(r==1){
							$('#frmProveedorU')[0].reset();
							$('#tablaProveedorLoad').load("tablaProveedor/tablaProveedor.php");
							alertify.success("Lista Actualizada");
						}else{
							alertify.error("Imposible actualizar");
						}
					}
				});
			})
		})
	</script>

<?php
		} else {
			header("location:../../index.php/");
		}
?>