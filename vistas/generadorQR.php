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
<title>Generador QR</title>
<?php require_once "menu.php"; ?>
</head>
<body>
<form id="frmQR">
	<div>
		
		<label for="nombreEvento">Nombre del Evento</label>
		<input type="text" class="form-control input-sm" id="nombreEvento" name="nombreEvento">

		<label for="nombreSalon">Nombre del Salon</label>
		<input type="text" class="form-control input-sm" id="nombreSalon" name="nombreSalon">

		<label for="limiteSalida">Limite de Salida</label>
		<input type="time" class="form-control input-sm" id="limiteSalida" name="limiteSalida">

		<label for="iteraciones">Cantidad a Imprimir</label>
		<input type="text" class="form-control input-sm" id="iteraciones" name="iteraciones">

		<button id="btnGenerarQR" type="button" class="btn btn-primary">Generar QR</button>

		<div id="contenedorQR" style="margin-top: 20px;"></div>

	</div>

</form>
</body>
</html>


<script type="text/javascript">
document.getElementById("btnGenerarQR").addEventListener("click", function () {
    const evento = document.getElementById("nombreEvento").value.trim();
    const salon = document.getElementById("nombreSalon").value.trim();
    const salida = document.getElementById("limiteSalida").value.trim();
    const iteraciones = document.getElementById("iteraciones").value.trim();

    if (evento === "" || salon === "" || salida === "" || iteraciones === "") {
        alert("Debes llenar ambos campos.");
        return;
    }

    
    const urlQR = `QR.php?nombreEvento=${encodeURIComponent(evento)}&nombreSalon=${encodeURIComponent(salon)}&limiteSalida=${encodeURIComponent(salida)}&iteraciones=${encodeURIComponent(iteraciones)}`;
    window.open(urlQR, '_blank');
});


</script>

<?php
		} else {
			header("location:../../index.php/");
		}
?>