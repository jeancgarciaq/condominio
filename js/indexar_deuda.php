<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conexion.php';
/*
 * CONSULTA PARA DOLARIZAR LA DEUDA PARA ADAPTAR A PHP
 *  SET @ID = (SELECT MAX(tasa.ID) AS ID FROM tasa);
    SET @TASA = (SELECT Cierre FROM tasa WHERE ID = @ID);
    SET @MONTO = (SELECT Monto FROM cxc WHERE MONTH(Emision) = 3 AND idpropietario = 7);
    SET @INDEXACION = (SELECT @MONTO / @TASA);
    UPDATE cxc SET Dolar = @INDEXACION WHERE MONTH(Emision) = 3 AND idpropietario = 7;
 */
/*
 * CONSULTA PARA INDEXAR LA DEUDA PARA ADAPTAR A PHP
 *  SET @ID = (SELECT MAX(tasa.ID) AS ID FROM tasa);
    SET @TASA = (SELECT Cierre FROM tasa WHERE ID = @ID);
    SET @MONTO = (SELECT Dolar FROM cxc WHERE MONTH(Emision) = 3 AND idpropietario = 7);
    SET @INDEXACION = (SELECT @MONTO / @TASA);
    UPDATE cxcprueba SET Dolar = @INDEXACION WHERE MONTH(Emision) = 3 AND idpropietario = 7;
 */

$bId = $conexion->query("SELECT MAX(tasa.ID) AS ID FROM TASA");
$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
foreach ($bId as $valor) {
  $ID = $valor['ID'];
}
$bTasa = $conexion->query("SELECT Cierre FROM tasa WHERE ID = '$ID'");
$arrayBtasa = $bTasa->fetch_array(MYSQLI_ASSOC);
foreach ($bTasa as $fila) {
  $tasa = $fila['Cierre'];
}

  $bDeuda = $conexion->query("SELECT Monto FROM cxc WHERE idpropietario = 7");
  $arrayBdeuda = $bDeuda->fetch_array(MYSQLI_ASSOC);
  foreach ($bDeuda as $row) {
    $monto = $row['Monto'];
    $dolarizacion = $monto/$tasa;
    $dolar = round($dolarizacion,2);
    $consulta = $conexion->query("UPDATE cxc SET Dolar = '$dolar' WHERE idpropietario =7");
    if($consulta) {
      echo "Todo un éxito".'<br>';
    }
    else {
      echo "Hay algún error".'<br>';
    }
  }