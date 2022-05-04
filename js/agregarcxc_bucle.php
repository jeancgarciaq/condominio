<?php
require_once '../conexion.php';

$condominio = 4; 
$descripcion = "Condominio Septiembre 2021";
$emision = date("d/m/Y");
$estado = 'ADEUDADO';
$mes = 9;
$year = 2021;

/*
LEER PARA JOIN MYSQL
https://www.vichaunter.org/desarrollo-web/joins-mysql-bien-explicado-lo-necesitas-saber
*/

//Consulta para determinar el número de propietarios y determinar el número de veces que se va a ejecutar el bucle
$contar = $conexion->query("SELECT COUNT(ID) as registro FROM propietarios WHERE idcondominio = '$condominio'");
$arrayContar = $contar->fetch_array(MYSQLI_ASSOC);
foreach($contar as $todos) {
  $enum = $todos['registro'];}
  //$enum = 1;
//Vamos a extraer el primer ID del propietario que coincide con el ID del Condominio
$maximoId = $conexion->query("SELECT MAX(ID) as ID FROM propietarios WHERE idcondominio = '$condominio'");
$arrayMaximoId = $maximoId->fetch_array(MYSQLI_ASSOC);
foreach($maximoId as $maxId) {
  $idMax = $maxId['ID'];}

//Lo deducimos al restar el número de registro al máximo id
$ajustarId = $enum - 1;
//echo $ajustarId.'<br>';
$primerId = $idMax - $ajustarId;
//$primerId = 131;
//Ahora vamos a usar un bucle for que nos permita ejecutar un código
for ($i = 1; $i <= $enum; $i++) {

  //Establezco la tasa de cambio
  //Primero se busca la tasa
  $bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
  $arrayId = $bId->fetch_array(MYSQLI_ASSOC);
  foreach($bId as $vid) {$id = $vid['id'];}
  $bTasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
  $arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
  foreach ($bTasa as $vTasa) {
    $tasaC = $vTasa['Cierre']; 
    $tasaA = $vTasa['Apertura'];}
  if($tasaC == 0) {$tasa = $tasaA;} else { $tasa = $tasaC;}
  //Fin de la Tasa

  //Buscar información del propietario
  $idpropietario = $primerId++;
  echo $idpropietario.'<br>';
  $bcondomino = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
  $arrayCondomino = $bcondomino->fetch_array(MYSQLI_ASSOC);
  foreach ($bcondomino as $condomino) {
    //$inmueble = $condomino['Inmueble'];
    //$nombrep = $condomino['Nombre'];
    $alicuota = $condomino['Alicuota'];}
    //$correo = $condomino['Correo'];
  //Fin de extraer la información del propietario


  //Buscar la sumatoria de los Gastos
  $bSgasto = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM gastos WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$condominio'");
  $arraySg = $bSgasto->fetch_array(MYSQLI_ASSOC);
  foreach ($bSgasto as $suma) {$totalgt = $suma['sumatoria'];}

  //Buscar la sumatoria de las Cuotas
  $bScuotas = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM cuotas WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$condominio'");
  $arraySc = $bScuotas->fetch_array(MYSQLI_ASSOC);
  foreach ($bScuotas as $sum) {$mtotal = $sum['sumatoria'];}

  $totalAlicuota = ($alicuota * $totalgt);
  $totalCuota = ($mtotal/64);
  $subTotal = ($totalAlicuota + $totalCuota);
  echo $subTotal.'<br>';
  $totalFondoReserva = ($subTotal)*0.10;
  $totalGeneral = $subTotal + $totalFondoReserva;
  echo $totalGeneral.'<br>';
  $rmonto = $totalGeneral;
  $monto = round($rmonto,2);
  echo $monto.'<br>';
  $rmontod = $monto/$tasa;
  $montod = round($rmontod,2);
  echo $montod.'<br>';
  
}//Fin Bucle For


//SE VA AÑADIR LA DEUDA A CXC
if($condominio == 1 OR $condominio == 2 OR $condominio == 3 OR $condominio == 4) {
	//Vamos a ingresar la consulta a la Base de Datos
  $consulta = $conexion->query("INSERT INTO cxc (ID, idpropietario, Descripcion, Monto, Dolar, Emision, Estado) VALUES (NULL, '$inmueble', '$descripcion', '$monto', '$montod', '$emision', '$estado')");

  ## BUSCAR SI TIENE SALDO A FAVOR Y AJUSTARLO
  //Realizar la consulta en cuentas por cobrar
  $saldoFavor = "SELECT Monto,Dolar FROM cxc WHERE idpropietario = '$inmueble' AND Monto < 0";
  //Ejecutar la consulta
  $consultaSaldoFavor = $conexion->query($saldoFavor);
  //Ahora vamos a convertir en Array
  $arraySaldoFavor = $consultaSaldoFavor->fetch_array(MYSQLI_ASSOC);
  //Verifico que el Array no esté vacío
  if(empty($arraySaldoFavor)) {
      $nosaldo = 'No hay Saldo a Favor';
    }
  else {
    //Voy a extraer el Saldo a Favor con un foreach
    foreach ($consultaSaldoFavor as $valor) {   
      		$saldo = $valor['Monto'];
      		$saldod = $valor['Dolar'];
  		} 
  //Realizar la búsqueda de la Deuda
  $deuda = "SELECT Monto,Dolar FROM cxc WHERE idpropietario = '$inmueble' AND Estado = 'ADEUDADO'";
  //ejecutar la consulta
  $consultaDeuda = $conexion->query($deuda);
  //Lo convertimos en array
  $arrayDeuda = $consultaDeuda->fetch_array(MYSQLI_ASSOC);
  //Voy a extraer el Saldo a Favor con un foreach
  foreach ($consultaDeuda as $valor) {
      $montoDeuda = $valor['Monto'];
      $montoDolar = $valor['Dolar'];
  }
  //Se calcula la diferencia
  $diferencia = $montoDeuda + $saldo;
  $diferenciad = $montoDolar + $saldod;
  //Ahora Voy Actualizar el Saldo A Favor
  $modificarSaldo = "UPDATE cxc SET Monto = 0, Dolar = 0 WHERE idpropietario = '$inmueble' AND Monto < 0";
  //Ejecutar
  $consultaModificaSaldo = $conexion->query($modificarSaldo);

  //Buscar Máximo ID Deuda
  $bMid = $conexion->query("SELECT MAX(ID) as idP FROM cxc WHERE idpropietario = '$inmueble'");
  $arrayMid = $bMid->fetch_array(MYSQLI_ASSOC);
  foreach ($bMid as $mid) {
  	$idP = $mid['idP'];
    //var_dump($idP);
  }

  //Ahora Voy Actualizar el Saldo Deudor
  $modificarDeuda = "UPDATE cxc SET Monto = '$diferencia', Dolar = '$diferenciad' WHERE idpropietario = '$inmueble' AND ID = '$idP'";
  //Ejecutar
  $consultaModificaDeuda = $conexion->query($modificarDeuda);
  $nosaldo = 'Ya se descontó el Saldo a Favor';}
  /* FIN SI TIENE SALDO A FAVOR Y AJUSTARLO */
 ?>