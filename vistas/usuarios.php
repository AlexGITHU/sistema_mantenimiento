<?php 
session_start();

if (!isset($_SESSION['usuario'])) {
	header("location:../../index.php/");
	exit();

}

if ($_SESSION['rol'] !== 'Administrador') {
    header("location:inicio.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<html>
<head>
<title> Usuarios </title>
	<?php require_once "menu.php"; ?>

</head>
<body>

  <!-- Button modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Insertar Usuarios
  </button>

  <!-- modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuarios</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
	<div class="modal-body">

				<div class="col-sm-4">

					<form id="frmUsuarios">

						<label for="nombre">Nombre</label>
						<input type="text" class="form-control input-sm" name="nombre" id="nombre">

						<label for="apellido">Apellido</label>
						<input type="text" class="form-control input-sm" name="apellido" id="apellido">

						<label for="rol">Rol</label>
						<select class="form-control imput-sm" id="rol" name="rol">
  						<option selected>Selecciona un Rol</option>
  						<option value="Administrador">Administrador</option>
  						<option value="Observador">Observador</option>
  						<option value="General">General</option>
  					</select>

						<label for="contrasenia">Password</label>
						<input type="text" class="form-control input-sm" name="contrasenia" id="contrasenia">


				</div>
					</form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button id="btnAgregaUsuarios" type="button" class="btn btn-primary">Agregar</button>
        </div>

      </div>
    </div>
  </div>

     <div class="col-sm-8">
    	<div id="tablaUsuariosLoad"></div>
    	<div>

				<!-- Formulario de actualizacion -->
				<div class="modal fade" id="abremodalUpdateUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Actualiza Tareas</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
					</div>
					<div class="modal-body">
						<form id="frmUsuariosU">
						<input type="text" id="idUsuario" hidden="" name="idUsuario"></input>
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">

						<label for="apellido">Apellido</label>
						<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">

						<label for="rol">Rol</label>
						<select class="form-control imput-sm" id="rolU" name="rolU">
  						<option selected>Selecciona un Rol</option>
  						<option value="Administrador">Administrador</option>
  						<option value="Observador">Observador</option>
  						<option value="General">General</option>
						</select>

						<label for="contrasenia">Password</label>
						<input type="text" class="form-control input-sm" name="contraseniaU" id="contraseniaU">


				</div>
					</form>
										<div class="modal-footer">
						<button id="btnActualizaUsuarios" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
					</div>
				</div>
			</div>
		</div>

</body>
</html>


	<script type="text/javascript">
		function agregaDatosUsuarios(idusuario){

			$.ajax({
				type: "POST",
				data: "idusuario=" + idusuario,
				url: "../procesos/usuarios/obtenDatosUsuarios.php",
				success:function(r){
					//console.log("Creo que esto no esta funcionando, no eres tu soy yo.");
					dato=jQuery.parseJSON(r);
					$('#idUsuario').val(dato['id_usuarios']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#rolU').val(dato['rol']);
					$('#contraseniaU').val(dato['contrasenia']);
			}
		});
	}

	function eliminaUsuario(idusuarios){
		alertify.confirm('Desea eliminar este Usuario?', function(){
			$.ajax({
				type: "POST",
				data: "idusuarios=" + idusuarios,
				url: "../procesos/usuarios/eliminaUsuarios.php",
				success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load("tablaUsuarios/tablaUsuarios.php");
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
		/* Script que actualiza la pagina en tiempo real cuando se actualiza un dato */
		$(document).ready(function() {
			$('#btnActualizaUsuarios').click(function() {

				datos=$('#frmUsuariosU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success: function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load("tablaUsuarios/tablaUsuarios.php");
							alertify.success("Usuario Actualizado");
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

		$('#tablaUsuariosLoad').load("tablaUsuarios/tablaUsuarios.php");
		
		$('#btnAgregaUsuarios').click(function(){

			vacios=validarFormVacio('frmUsuarios');

			if(vacios > 0){
				alertify.alert("Debes de llenar todos los campos!!");
				return false;
			}

			datos=$('#frmUsuarios').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/usuarios/agregaUsuarios.php",
				success:function(r){
					if(r==1){
				$('#frmUsuarios')[0].reset();

				$('#tablaUsuariosLoad').load("tablaUsuarios/tablaUsuarios.php");
				alertify.success("Usuario agregado con exito!");
			} else{
				alertify.error("No se pudo agregar el usuario")
				}
			}
		});
		
			});
		});
	</script>