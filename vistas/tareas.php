<html>
	<head>
		<title>Tareas</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; ?>
		<?php
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "SELECT id_usuarios, nombre from usuarios";
		$result = mysqli_query($conexion, $sql);
		?>
	</head>
	<body>

  <!-- Button modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Añadir Tarea
  </button>

  <!-- modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Insertar Tarea</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
		<form id="frmTareas" class="row g-3">
			<div class="col-sm-4">
			<label for="nombreTarea">Nombre Tarea</label>
			<input class="form-control input-sm" type="text" id="nombreTarea" name="nombreTarea">

			<label for="personaSelect">Persona</label>
			<select class="form-control imput-sm" id="personaSelect" name="personaSelect">
				<option value="A">Selecciona Persona</option>
					<?php while($ver=mysqli_fetch_row($result)): ?>
					<option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
				<?php endwhile; ?>
			</select>
			
			<label for="descripcion">Descripcion</label>
			<input class="form-control input-sm" type="text" id="descripcion" name="descripcion">

	</div>
		</form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button id="btnAgregaTareas" type="button" class="btn btn-primary">Agregar</button>


        </div>

      </div>
    </div>
  </div>
  
    <div class="col-sm-8">
		<div id="tablaTareasLoad"></div>
		<?php require_once "tablaTareas/tablaTareas.php"; ?>
		</div>

				<!-- Formulario de actualizacion -->
				<div class="modal fade" id="abremodalUpdateTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualiza Tareas</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
					</div>
					<div class="modal-body">
						<form id="frmTareasU" enctype="multipart/form-data">
              <input type="text "id="idTarea" hidden="" name="idTarea"></input>			
              <label>Nombre Tarea</label>
              <input type="text" class="form-control" id="nombreTareaU" name="nombreTareaU">
              <label>Persona</label>
							<select class="form-control imput-sm" id="personaSelectU" name="personaSelectU">
								<option value="A">Selecciona Persona</option>
									<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
							</select>
              <label>Descripcion</label>
              <input type="text" class="form-control" id="decripcionU" name="decripcionU">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaTareas" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
</html>

<script type="text/javascript">
    function agregaDatosTarea(idtarea){
	$.ajax({
      type:"POST",
	    data:"idtarea=" + idtarea,
	    url:"../procesos/tareas/obtenDatosTareas.php",
	    success: function(r){

	        dato=jQuery.parseJSON(r);
	        $('#idTarea').val(dato['id_tareas']);
	        $('#nombreTareaU').val(dato['nombreTarea']);
	        $('#personaSelectU').val(dato['id_usuarios']);
	        $('#descripcionU').val(dato['decripcion']);
	    }
	)};
    };

    //When te pierdes en Peru
		//Soy una causa perdida

				function eliminaTarea(idtarea){
			alertify.confirm('Se eliminara la tarea del inventario', function(){
				$.ajax({
					type:"POST",
					data:"idtareas=" + idtarea,
					url:"../procesos/tareas/eliminaTarea.php",
					success:function(r){
						if(r==1){
							$('#tablaTareasLoad').load("tablaTareas/tablaTareas.php");
							alertify.success("Tarea Eliminada");
						} else {
								alertify.error("Imposible eliminar tarea");
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
			$('#btnActualizaTareas').click(function() {

				datos=$('#frmTareasU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/tareas/actualizaTarea.php",
					success: function(r){
						if(r==1){
							$('#tablaTareasLoad').load("tablaInventario/tablaTareas.php");
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

		$('#tablaTareasLoad').load("tablaTareas/tablaTareas.php");
		
		$('#btnAgregaTareas').click(function(){

			vacios=validarFormVacio('frmTareas');

			if(vacios > 0){
				alertify.alert("Faltan campos por rellenar");
				return false;
			}

			datos=$('#frmTareas').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/tareas/agregaTareas.php",
				success:function(r){
					if(r==1){
				$('#frmTareas')[0].reset();

				$('#tablaTareasLoad').load("tablaTareas/tablaTareas.php");
				alertify.success("Tarea agregada con exito");
			} else{
				alertify.error("Error al agregar")
				}
			}
		});
		
			});
		});
	</script>