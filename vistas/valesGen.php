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
<title>Generacion de Vales</title>
<?php require_once "menu.php"; ?>
</head>
<body>
<form id="vales">
<div class="col-sm-4">
<h1 class="modal-title" id="exampleModalLabel">Generar Vales</h1>

<label>Fecha de Solicitud</label>
<!-- <input id="fecha" type="date" class="form-control input-sm"> -->

<label>Lugar a utilizar</label>
<select id="area" name="area" class="form-control input-sm">
<option selected>Para utilizarse en</option>
<option value="Finanzas">Finanzas</option>
<option value="Restaurante">Restaurante</option>
<option value="Ventas">Ventas</option>
<option value="Compras">Compras</option>
<option value="A&B">A&B</option>
<option value="Cocina">Cocina</option>
<option value="Ama de Llaves">Ama de Llaves</option>
<option value="Lavanderia">Lavanderia</option>
<option value="Mantenimiento">Mantenimiento</option>
<option value="Recepcion">Recepcion</option>
<option value="Piscina">Piscina</option>
<option value="Estacionamiento">Estacionamiento</option>
<option value="Entrada de Personal">Entrada de Personal</option>
<option value="Telefonos">Telefonos</option>
<option value="Site">Site</option>
</select>

<label>Solicitante</label>
<select class="form-control input-sm" id="solicitante" name="solicitante">
    <option selected>Persona a Solicitar</option>
    <option value="FELIPE TOSCA VALENCIA">FELIPE TOSCA VALENCIA</option>
    <option value="DOMINGO DE LA ROSA ALCUDIA">DOMINGO DE LA ROSA ALCUDIA</option>
    <option value="JOSE DEL C. PEREZ OVANDO">JOSE DEL C. PEREZ OVANDO</option>
    <option value="MIGUEL ALEGRIA DIAZ">MIGUEL ALEGRIA DIAZ</option>
    <option value="MACARIO RABELO CRUZ">MACARIO RABELO CRUZ</option>
    <option value="LORENZO CASTILLO DE LA ROSA">LORENZO CASTILLO DE LA ROSA</option>
    <option value="ALFONSO LÓPEZ ÁLVAREZ">ALFONSO LÓPEZ ÁLVAREZ</option>
    <option value="CRISTIAN DE LA ROSA RIVERA">CRISTIAN DE LA ROSA RIVERA</option>
    <option value="LUIS AQUINO CAHUICH">LUIS AQUINO CAHUICH</option>
    <option value="FRANCISCO MATEO SANTOS">FRANCISCO MATEO SANTOS</option>
    <option value="PEDRO LEON SANTIZ">PEDRO LEON SANTIZ</option>
    <option value="JORGE A. IZQUIERDO ARIAS">JORGE A. IZQUIERDO ARIAS</option>
</select>

<label>Cantidad</label>
<input type="text" class="form-control input-sm" id="cantidad" name="cantidad">

<label>Descripción</label>
<input type="text" class="form-control input-sm" id="descripcion" name="descripcion"> <!-- Corregido name="descripcion" -->

<label>Observaciones</label>
<input type="text" class="form-control input-sm" id="observaciones" name="observaciones">

</div>

<button id="btnGenerarVale" type="button" class="btn btn-primary">Generar</button>

</form>
</body>
</html>

<script type="text/javascript">
    document.getElementById("btnGenerarVale").addEventListener("click", function() {
        const area = document.getElementById("area").value.trim();
        const solicitante = document.getElementById("solicitante").value.trim();
        const cantidad = document.getElementById("cantidad").value.trim(); // Corregido a minúscula
        const descripcion = document.getElementById("descripcion").value.trim();
        const observaciones = document.getElementById("observaciones").value.trim();

        if (area === "" || solicitante === "" || cantidad === "" || descripcion === "" || observaciones === "") {
            alert("Debes de llenar todos los campos.");
            return;
        }

        const urlVale = `valePDF.php?area=${encodeURIComponent(area)}&solicitante=${encodeURIComponent(solicitante)}&cantidad=${encodeURIComponent(cantidad)}&descripcion=${encodeURIComponent(descripcion)}&observaciones=${encodeURIComponent(observaciones)}`;
        window.open(urlVale, '_blank');
    });
</script>

<?php
        } else {
            header("location:../../index.php/");
        }
?>