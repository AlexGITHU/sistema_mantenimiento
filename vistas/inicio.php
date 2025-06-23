<?php 
session_start();
if(isset($_SESSION['usuario'])){

    ?>

<html>
<head>
<title>index</title>
<?php require_once "menu.php";
      require_once "../clases/Conexion.php";
?>
<script src="../librerias/chart.js-4.5.0/package/dist/chart.umd.min.js"></script>
<?php 
$c = new conectar();
$conexion = $c->conexion();

$mostrarExistencia = "SELECT SUM(existencia) as totalExistencia from inventario";
$resultExistencia = mysqli_query($conexion, $mostrarExistencia);
$existenciaDatoUno = mysqli_fetch_assoc($resultExistencia);
$totalExistencia = $existenciaDatoUno['totalExistencia'];

$mostrarEntrada = "SELECT SUM(entrada) as totalEntrada from inventario";
$resultEntrada = mysqli_query($conexion, $mostrarEntrada);
$existenciaDatoDos = mysqli_fetch_assoc($resultEntrada);
$totalEntrada = $existenciaDatoDos['totalEntrada'];

$mostrarSalida = "SELECT SUM(salida) as totalSalida from inventario";
$resultSalida = mysqli_query($conexion, $mostrarSalida);
$existenciaDatoTres = mysqli_fetch_assoc($resultSalida);
$totalSalida = $existenciaDatoTres['totalSalida'];


// public function mostrarSalida($salida){

// }

?>
</head>
<body>

<h1> Bienvenido al Sistema </h1>
<style>
  .grafica-contenedor {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 40px; /* Espacio superior opcional */
  }
</style>

<div class="grafica-contenedor">
  <canvas id="myChart" width="600" height="600"></canvas>
</div>
	    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Existencia', 'Entrada', 'Salida'],
                datasets: [{
                    label: 'Actividad Actual del Inventario',
                    data: [<?php echo $totalExistencia; ?>, <?php echo $totalEntrada; ?>, <?php echo $totalSalida; ?>],

                }]
            },

            options: {
                responsive: false,
            }

        });
    </script>
</body>
</html>

<?php
    } else{
        header("location:../../index.php/");
    }
?>