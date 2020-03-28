<?php
//Cargamos el html
ob_start();
include 'prueba_sentencia.php';
$html = ob_get_clean();

// include autoloader
require_once '../dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

//Intentamos imprimir el PDF
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

//Nombre del Documento
$documento = 'Deuda.pdf';

// Output the generated PDF to Browser
$dompdf->stream($documento);

?>