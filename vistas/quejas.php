<?php
session_start();

?>
<html>
<head>
	<title>Quejas</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Agregar Queja
  </button>
	  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	  		<div class="modal-content">
	  			<div class="modal-header">
	  				<h1 class="modal-title" id="exampleModalLabel">Insertar Queja</h1>
	  				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
	  			</div>
	  			<div class="modal-body">
	  				<form id="frmQuejas">
	  					<div class="col-sm-4">

	  					<label>Queja</label>
	  					<input type="text" class="form-control" id="queja" name="queja"></input>

	  					<label>Descripción</label>
	  					<input type="text" class="form-control" id="descripcion" name="descripcion"></input>

	  					</div>
	  				</form>
	  			</div>
	  			<div class="modal-footer">
	  				<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
	  				<button id="btnAgregaQuejas" type="button" class="btn btn-primary">Agregar</button>
	  			</div>

	  		</div>
	  	</div>
	  </div>
	</div>

	<div class="col-sm-8">
		<div id="tablaQuejasLoad"></div>
	</div>

	<div class="modal fade" id="abremodalInventarioUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Actualiza Inventario</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form id="frmQuejasU">
						<input type="text" id="idQuejas" hidden="" name="idQuejas">
						<label>Queja</label>
						<input type="text" class="form-control" id="quejaU" name="quejaU">
						<label>Descripción</label>
						<input type="text" class="form-control" id="descripcionU" name="descripcionU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaQuejas" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>
</body>
</html>

<script type="text/javascript">
	function agregaDatosQuejas(idquejas){
		$.ajax({
			type: "POST",
			url: "../procesos/quejas/obtenDatosQuejas.php",
			data: "idquejas=" + idquejas,
			success: function(r){
				data = jQuery.parseJSON(r);
				$('#idQuejas').val(dato['id_quejas']);
				$('#quejaU').val(dato['nombre_queja']);
				$('#descripcionU').val(dato['descripcion'])
			}

		});
	}
	function eliminaQuejas(idquejas){
		alertify.confirm('¿Desea eliminar esta queja?', function(){
			$.ajax({
				type:"POST",
				data:"idqueja=" + idqueja,
				url:"../procesos/quejas/eliminaQuejas.php",
				success:function(r){
					if(r==1){
						$('#tablaQuejasLoad').load("tablaQuejas/tablaQuejas.php");
						alertify.success("Eliminada con Exito!");
					} else {
						alertify.error("Imposible eliminar");
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

			$('#tablaQuejasLoad').load("tablaQuejas/tablaQuejas.php");

			$('#btnAgregaQuejas').click(function(){

				vacios=validarFormVacio('frmQuejas');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmQuejas').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/quejas/agregaQuejas.php",
					success:function(r){

						if(r==1){
							$('#frmQuejas')[0].reset();
							$('#tablaQuejasLoad').load("tablaQuejas/tablaQuejas.php");
							alertify.success("Queja agregada con exito");
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
			$('#btnActualizaQuejas').click(function(){
				datos=$('#frmQuejasU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/quejas/actualizaQuejas.php",
					success:function(r){

						if(r==1){
							$('#frmQuejasU')[0].reset();
							$('#tablaQuejasLoad').load("tablaQuejas/tablaQuejas.php");
							alertify.success("Quejas Actualizadas");
						}else{
							alertify.error("Imposible actualizar");
						}
					}
				});
			})
		})
	</script>