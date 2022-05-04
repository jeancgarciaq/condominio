<?php
require_once '../conexion.php';
//Recibir los datos
//ID del Propietario
$inmueble = $_POST['inmueble'];
//var_dump($inmueble);
//Condominio dónde va el pago
$condominio = $_POST['condominio']; 
//var_dump($condominio);
//Observación del Pago
$descripcion = $_POST['descripcion'];
//var_dump($descripcion);
//Monto del Pago
$monto = $_POST['monto'];
$montod = $_POST['montod'];
//var_dump($monto);
//var_dump($montod);
//Fecha de emisión
$emision = $_POST['emision'];
//var_dump($emision);
//Estado
$estado = 'ADEUDADO';

/*
LEER PARA JOIN MYSQL
https://www.vichaunter.org/desarrollo-web/joins-mysql-bien-explicado-lo-necesitas-saber
*/

//CONVERTIR EL MONTO EN DÓLARES
//Primero se busca la tasa
$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
foreach($bId as $vid) {
  $id = $vid['id'];
}

$bTasa = $conexion->query("SELECT Cierre FROM tasaparalelo WHERE ID = '$id'");
$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
foreach ($bTasa as $vTasa) {
  $tasa = $vTasa['Cierre']; }
  
//Obtener el valor del Dólar o viceversa
if(empty($monto)) {
  //Calculo el Valor del Monto en Bolívares
  $monto = $montod * $tasa;
  $monto = round($monto, 2);
} else {
  //Calculo el valor del monto en Dólares
  $montod = $monto / $tasa;
  $montod = round($montod, 2);
}

//Primero busco el nombre y lo guardo
$bnombre = $conexion->query("SELECT * from propietarios WHERE ID = '$inmueble'");
$arrayN = $bnombre->fetch_array(MYSQLI_ASSOC);
foreach ($bnombre as $fila) {
		$nombre = $fila['Nombre'];
		//var_dump($nombre);
		$idcondominio = $fila['idcondominio'];
		//var_dump($idcondominio);
		$numero = $fila['Inmueble'];
		//var_dump($numero);
	}

$bNombreC = $conexion->query("SELECT NombreC from condominios WHERE ID = '$condominio'");
$arrayBc = $bNombreC->fetch_array(MYSQLI_ASSOC);
foreach ($bNombreC as $clave) {
	$nCondominio = $clave['NombreC'];
	//var_dump($nCondominio);
}

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
  ## FIN SI TIENE SALDO A FAVOR Y AJUSTARLO

  //Comprobamos que se haya guardado la información
    if (!empty($consulta)) {?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Agregar Cuenta por Cobrar</title>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/estilos.css">
      <link href="../css/line-awesome.min.css" rel="stylesheet">
      <style media="print">
        #menu, #encabezado, #pie, #navegacion {display: none !important;}
      </style>
    </head>
    <body>
      <article class="container-fluid">
        <!-- INICIO MENÚ NAV -->
    <ul class="nav justify-content-center bg-primary" id="menu">
      <li class="nav-item">
        <a class="nav-link active text-light border-left" href="../index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../condominio.php"><i class="las la-city"></i> Condominio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../proveedores.php"><i class="las la-store-alt"></i> Proveedores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../gastos.php"><i class="las la-file-invoice-dollar"></i> Gastos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../pagos.php"><i class="las la-donate"></i> Pagos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../avisos.php"><i class="las la-receipt"></i> Avisos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../cxc.php"><i class="las la-cash-register"></i> Cuentas x Cobrar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left border-right" href="../cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
      </li>
    </ul>
    <?php 

      //Buscar Máximo ID Deuda
      $bMid = $conexion->query("SELECT MAX(ID) as idP FROM cxc WHERE idpropietario = '$inmueble'");
      $arrayMid = $bMid->fetch_array(MYSQLI_ASSOC);
      foreach ($bMid as $mid) {
        $idP = $mid['idP'];
        //var_dump($idP);
      }
    ?>
    <!-- FIN MENÚ NAV-->
        <header id="encabezado" class="">
          <h1><img src="../img/caja-registradora.png" class="img-fluid" width="5%" height="10%"> MÓDULO 7: CUENTAS POR COBRAR</h1>
        </header> 
        <section class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <h2><?php echo 'Fecha: '.date("d/m/Y");?> | Nota de Débito # <?php echo date("m")."-".$idP;?></h2>
            <p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
            <p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$numero.'</span>';?></p>
            <p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$nCondominio.'</span>';?></p>
            <p><strong><i class="las la-file-alt"></i> Descripción:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
            <p><strong><i class="las la-coins"></i> Monto:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
            <p><strong><i class="las la-coins"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
            <p><strong><i class="las la-calendar"></i> Emisión:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($emision)).'</span>';?></p>
            <p><strong><i class="las la-barcode"></i> Estado:</strong> <?php   echo '<span>'.$estado.'</span>';?></p>
            <div class="alert alert-success" role="alert" id="navegacion">
              <p style="text-align: center">Los Datos se guardaron exitosamente y <?php echo $nosaldo; ?></p>
            </div>
          </div>
          <div class="col-2"></div>
        </section>
    <?php
    }
    else {

        printf("Error: %s\n", mysqli_error($conexion)).'<br>';?>
        <div class="alert alert-danger" role="alert">
          <p style="text-align: center">Se ha producido un error, por favor inténtelo de nuevo. <br> Si el error persiste comuníquese con el administrador <a href="mailto:jcvictory@hotmail.com"><i class="las la-envelope"></i> Enviar Correo</a> y/o <a href="https://api.whatsapp.com/send?phone=584144812738"><i class="lab la-whatsapp"></i> Escribir al WhatsApp</a></p>
        </div>
    <?php
      } 
  } 
/* cerrar la conexión */
$conexion->close();

?>
    <header id="pie">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-3">
          <p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
        </div>
        <div class="col-3">
          <p style="text-align: center;"><a href="../cxc.php"><img src="../img/caja-registradora.png" width="60px" height="70px"><br>Cuentas por Cobrar</a></p>
        </div>
        <div class="col-3"></div>
      </div>
    </header>
  </article>
</body>
</html>