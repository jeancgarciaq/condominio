<?php  
include '../conexion.php';

//CONVERTIR EL MONTO EN DÓLARES
//Primero se busca la tasa
$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasabcv");
$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
foreach($bId as $vid) {
  $id = $vid['id'];
}
$bTasa = $conexion->query("SELECT * FROM tasabcv WHERE ID = '$id'");
$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
foreach ($bTasa as $vTasa) {
  $tasa = $vTasa['tasa']; }


$buscarDatos = $conexion->query("SELECT * FROM cxc WHERE idpropietario = 6");
$arrayBusqueda = $buscarDatos->fetch_array(MYSQLI_ASSOC);
foreach ($buscarDatos as $dato) {
	
	$dolar = $dato['Dolar'];

	$actualizar = $conexion->query("UPDATE cxc SET Monto = $dolar * $tasa WHERE idpropietario = 6");
}

?>