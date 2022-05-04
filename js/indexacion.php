<?php  

//Conexión a la base de datos
require_once '../conexion.php';

//Datos de prueba
//nombre
$nombre = 'Hendrick Arteaga';
$condominio = 'Res. San Francisco';
$dia = '14';
$mes = '01';
$anno = '2020';

//Consultar el Monto
$consultarMonto = "SELECT * FROM cxc WHERE Nombre = '$nombre' AND Condominio = '$condominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$anno'";
$ejecutarConsultaM = $conexion->query($consultarMonto);
$arrayConsultaM = $ejecutarConsultaM->fetch_array(MYSQLI_ASSOC);

foreach ($ejecutarConsultaM as $valor) {

	$monto = $valor['Monto'];
}

//Consultar la Tasa de Emisión
$consultarTasa = "SELECT * FROM tasa WHERE DAY(Fecha) = '$dia' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$anno'";
$ejecutarConsultaT = $conexion->query($consultarTasa);
$arrayConsultaT = $ejecutarConsultaT->fetch_array(MYSQLI_ASSOC);

foreach ($ejecutarConsultaT as $valor) {

	$tasa = $valor['Tasa'];
}

$dolar = $monto/$tasa;



?>