<?php
	require_once "clases/Conexion.php";
	$c = new conectar();
	$conexion = $c -> conexion();
	$sql = "SELECT * FROM usuarios WHERE nombre='admin'";
	$result = mysqli_query($conexion, $sql);
	$validar = 0;
	if(mysqli_num_rows($result) > 0){
		$validar = 1;
	}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title>
<link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<script src="../librerias/jquery-3.2.1.min.js"></script>
<script src="../js/funciones.js"></script>
</head>
<body>
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<b><center><div class="panel panel-heading">Login</div></center></b>
					<div class="panel panel-body">
						<p>
						</p>
						<form id="frmLogin">
    						<label>Nombre</label>
    						<input type="text" class="form-control" name="usuario" id="usuario">
    						<label>Contraseña</label>
    						<input type="password" class="form-control" name="contrasenia" id="contrasenia">
    						<p></p>
  						<span class="btn btn-primary" id="entrarSistema">Ingresar</span>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){

			vacios=validarFormVacio('frmLogin');

			if (vacios > 0) {
				alert("Faltan campos por rellenar");
				return false;
			}

			datos=$('#frmLogin').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/regLogin/login.php",
				success: function(r){

					if (r==1) {
						window.location="../vistas/inicio.php";
					} else {
						alert("Imposible Ingresar");
					}
				}
			});
		});
	});
</script>