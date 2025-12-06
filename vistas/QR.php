<?php
require '../vendor/autoload.php';

use Mpdf\Mpdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;

function generarCodigoAleatorio($longitud = 12) {
    return str_pad(mt_rand(1, 999999999999), $longitud, '0', STR_PAD_LEFT);
}

if (isset($_GET['nombreEvento']) && isset($_GET['nombreSalon']) && isset($_GET['iteraciones'])) {
    $nombreEvento = htmlspecialchars($_GET['nombreEvento']);
    $nombreSalon = htmlspecialchars($_GET['nombreSalon']);
    $limiteSalida = htmlspecialchars($_GET['limiteSalida']);
    $iteraciones = intval($_GET['iteraciones']);

    if ($iteraciones <= 0) {
        die("Cantidad inválida.");
    }


    $codigoQR = generarCodigoAleatorio();

    // Crear QR
    $qrCode = new QrCode($codigoQR);
    $qrCode->setEncoding(new Encoding('UTF-8'));
    $qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh());
    $qrCode->setSize(200);
    $qrCode->setMargin(10);
    $qrCode->setRoundBlockSizeMode(new RoundBlockSizeModeMargin());

    $writer = new PngWriter();
    $qrResult = $writer->write($qrCode);
    $qrBase64 = base64_encode($qrResult->getString());

    // Crear PDF
    $mpdf = new Mpdf([
        'format' => [85, 120], // Las dimensionesss en verticalll 8.5 cm x 12 cm
        'margin_top' => 10,
        'margin_bottom' => 10,
        'margin_left' => 10,
        'margin_right' => 10,
    ]);

    $html = "
    <div style='text-align: center; font-family: Arial, sans-serif;'>
        <h3 style='margin:0;'>TICKET DE CORTESIA</h3>
        <h3 style='margin:0;'>HYATT REGENCY VILLAHERMOSA</h3>
        <p style='margin: 5px 0;'>Salón: <strong>{$nombreSalon}</strong></p>
        <img src='data:image/png;base64,{$qrBase64}' style='width:120px; height:120px; margin:10px 0;' />
        <p style='margin: 5px 0;'>Limite de salida: {$limiteSalida}</p>
        <p style='margin: 5px 0;'>Costo de boleto perdido $200 pesos</p>
        <p style='margin: 5px 0;'><strong>{$nombreEvento}</strong></p>

    </div>";
            //<p style='margin: 0;'>Código: <strong>{$codigoQR}</strong></p>


    for ($i = 1; $i <= $iteraciones; $i++) {
        $mpdf->WriteHTML($html);
        if ($i < $iteraciones) {
            $mpdf->AddPage();
        }
    }

    $mpdf->Output("tickets_qr.pdf", \Mpdf\Output\Destination::INLINE);
    exit;

} else {
    echo "Faltan datos del evento o cantidad.";
}
?>