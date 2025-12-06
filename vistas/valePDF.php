<?php
require '../vendor/autoload.php';

use Mpdf\Mpdf;

if (isset($_GET['area']) && isset($_GET['solicitante']) && isset($_GET['cantidad']) && isset($_GET['descripcion']) && isset($_GET['observaciones'])) {
    $area = htmlspecialchars($_GET['area']);
    $solicitante = htmlspecialchars($_GET['solicitante']);
    $cantidad = htmlspecialchars($_GET['cantidad']);
    $descripcion = htmlspecialchars($_GET['descripcion']);
    $observaciones = htmlspecialchars($_GET['observaciones']);

    $fechaActual = getdate();
    $fecha = sprintf("%02d/%02d/%04d", $fechaActual['mday'], $fechaActual['mon'], $fechaActual['year']);

    // Configuración del PDF
    $mpdf = new Mpdf([
        'format' => [210, 297], // Tamaño A4 (El papel pues) en mm (puedes ajustar según necesites)
        'margin_top' => 20,
        'margin_bottom' => 20,
        'margin_left' => 20,
        'margin_right' => 20,
    ]);

    // HTML del formato del vale
    $html = "
    <html>
    <body style='font-family: Arial, sans-serif;'>
        <div style='text-align: center;'>
            <img src='../logo-menu.png' alt='Hyatt Logo' style='width: 200px; height: auto;'>
            <h2>Hyatt Regency Villahermosa</h2>
            <h3>Dirección de Ingeniería y Mantenimiento</h3>
            <h3>Vale de Salida de Almacén</h3>
        </div>
        <br>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr>
                <td style='width: 33%;'><strong>Fecha de Solicitud:</strong> $fecha </td>
                <td style='width: 33%;'><strong>Solicitante:</strong> $solicitante</td>
                <td style='width: 33%;'><strong>Para utilizar en:</strong> $area</td>
            </tr>
        </table>
        <br>
        <table style='width: 100%; border: 1px solid #000; border-collapse: collapse;'>
            <tr>
                <td style='width: 33%; border: 1px solid #000; padding: 10px;'><strong>Cantidad</strong><br>$cantidad</td>
                <td style='width: 33%; border: 1px solid #000; padding: 10px;'><strong>Descripción</strong><br>$descripcion</td>
                <td style='width: 33%; border: 1px solid #000; padding: 10px;'><strong>Observaciones</strong><br>$observaciones</td>
            </tr>
        </table>
        <br>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr>
                <td style='width: 33%;'><strong>Entregó</strong><br>_____________________<br>Domingo de la Rosa</td>
                <td style='width: 33%;'><strong>VoBo</strong><br>_____________________<br>Jefe de Departamento</td>
                <td style='width: 33%;'><strong>Recibió</strong><br>_____________________<br>Solicitante</td>
            </tr>
        </table>
    </body>
    </html>
    ";

    // Generar el PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output("vale_salida.pdf", \Mpdf\Output\Destination::INLINE);
    exit;

} else {
    echo "Faltan datos para generar el vale.";
}
?>