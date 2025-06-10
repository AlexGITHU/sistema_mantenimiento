<!DOCTYPE html>
<html lang="es">
<html>
<head>
<title> Usuarios </title>
	<?php require_once "menu.php"; ?>
	<?php require_once "../clases/Conexion.php"; ?>
	<?php
	
	$c = new conectar();
	$conexion = $c->conexion();
	$sql = "SELECT id_usuarios, nombre, apellido, contrasenia from usuarios";	
	$resultado = mysqli_query($conexion, $sql);
	
	?>

</head>
<body>
<?php require_once "menu.php" ?>

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

<?php require_once "tablaUsuarios/tablaUsuarios.php" ?>
</body>
</html>


	<script type="text/javascript">
		function agregaDatosUsuarios(idusuarios){

			$.ajax({
				type: "POST",
				data: "idusuarios=" + idusuarios,
				url: "../procesos/usuarios/obtenDatosUsuarios.php",
				success:function(r){
					//console.log("Creo que esto no esta funcionando, no eres tu soy yo.");
					dato=jQuery.parseJSON(r);
					$('#idusuariosU').val(dato['id_usuarios']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#contraseniaU').val(dato['contrasenia']);
			}
		});
	}

	function eliminarUsuario(idusuarios){
		alertify.confirm('Desea eliminar este Usuario?', function(){
			$.ajax({
				type: "POST",
				data: "idusuarios=" + idusuarios,
				url: "../procesos/usuarios/eliminarUsuario.php",
				success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
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
	$(document).ready(function(){

		$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
		
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

				$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
				alertify.success("Usuario agregado con exito!");
			} else{
				alertify.error("No se pudo agregar el usuario")
				}
			}
		});
		
			});
		});
	</script>