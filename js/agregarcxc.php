<?php  
include '../conexion.php';
//Recibir los datos
//Número del Inmueble
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
//Fecha de emisión
$emision = $_POST['emision']; 
//var_dump($emision);
//Estado
$estado = 'ADEUDADO';

//Primero busco el nombre y lo guardo
$bnombre = $conexion->query("SELECT Nombre from propietarios WHERE Numero = '$inmueble'");
$arrayN = $bnombre->fetch_array(MYSQLI_ASSOC);
foreach ($bnombre as $fila) {
	$nombre = $fila['Nombre'];}

if($condominio == 'Edificio Bucare') {
	$consulta = $conexion->query("INSERT INTO cxc (ID, Nombre, Inmueble, Condominio, Descripcion, Monto, Emision, Estado) VALUES (NULL, '$nombre', '$inmueble', '$condominio', '$descripcion', '$monto', '$emision', '$estado')");

	## BUSCAR SI TIENE SALDO A FAVOR Y AJUSTARLO
	//Realizar la consulta en cuentas por cobrar
	$saldoFavor = "SELECT Monto FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Condominio = '$condominio' AND Monto < 0";
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
		}
		//Realizar la búsqueda de la Deuda
		$deuda = "SELECT Monto FROM cxc WHERE Nombre = '$nombre' AND Inmueble ='$inmueble' AND Condominio = '$condominio' AND Monto > 0";
		//ejecutar la consulta
		$consultaDeuda = $conexion->query($deuda);
		//Lo convertimos en array
		$arrayDeuda = $consultaDeuda->fetch_array(MYSQLI_ASSOC);
		//Voy a extraer el Saldo a Favor con un foreach
		foreach ($consultaDeuda as $valor) {
			$montoDeuda = $valor['Monto'];
		}
		//Se calcula la diferencia
		$diferencia = $montoDeuda + $saldo;
		//Ahora Voy Actualizar el Saldo A Favor
		$modificarSaldo = "UPDATE cxc SET Monto = '0.00' WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND  Condominio = '$condominio' AND Monto < 0";
		//Ejecutar
		$consultaModificaSaldo = $conexion->query($modificarSaldo);

		//Ahora Voy Actualizar el Saldo Deudor
		$modificarDeuda = "UPDATE cxc SET Monto = '$diferencia' WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND  Condominio = '$condominio' AND Monto > 0";
		//Ejecutar
		$consultaModificaDeuda = $conexion->query($modificarDeuda);
		$nosaldo = 'Ya se descontó el Saldo a Favor';
		}
	## FIN SI TIENE SALDO A FAVOR Y AJUSTARLO

	//Comprobamos que se haya guardado la información
		if ($consulta) {

		?>
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
		</head>
		<body>
			<article class="container-fluid">
				<header id="header" class="">
					<h1><img src="../img/caja-registradora.png" class="img-fluid" width="5%" height="10%"> MÓDULO 7: CUENTAS POR COBRAR</h1>
				</header> 
				<section class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
						<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
						<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Descripción:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-calendar"></i> Emisión:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($emision)).'</span>';?></p>
						<p><strong><i class="las la-barcode"></i> Estado:</strong> <?php   echo '<span>'.$estado.'</span>';?></p>
						<div class="alert alert-success" role="alert">
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
else {

	$consulta = $conexion->query("INSERT INTO cxc (ID, Nombre, Inmueble, Condominio, Descripcion, Monto, Dolar, Emision, Estado) VALUES (NULL, '$nombre', '$inmueble', '$condominio', '$descripcion', '$monto', '$montod', '$emision', '$estado')");

	## BUSCAR SI TIENE SALDO A FAVOR Y AJUSTARLO
	//Realizar la consulta en cuentas por cobrar
	$saldoFavor = "SELECT Dolar FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Condominio = '$condominio' AND Dolar < 0";
	//Ejecutar la consulta
	$consultaSaldoFavor = $conexion->query($saldoFavor);
	//Ahora vamos a convertir en Array
	$arraySaldoFavor = $consultaSaldoFavor->fetch_array(MYSQLI_ASSOC);

	if(empty($consultaSaldoFavor)) {
		$nosaldo = 'No hay Saldo a Favor';
	}
	else {
	//Voy a extraer el Saldo a Favor con un foreach
	foreach ($consultaSaldoFavor as $valor) {
		$saldo = $valor['Dolar'];
	}
	//Realizar la búsqueda de la Deuda
	$deuda = "SELECT Dolar FROM cxc WHERE Nombre = '$nombre' AND Inmueble ='$inmueble' AND Condominio = '$condominio' AND Dolar > 0";
	//ejecutar la consulta
	$consultaDeuda = $conexion->query($deuda);
	//Lo convertimos en array
	$arrayDeuda = $consultaDeuda->fetch_array(MYSQLI_ASSOC);
	//Voy a extraer el Saldo a Favor con un foreach
	foreach ($consultaDeuda as $valor) {
		$montoDeuda = $valor['Dolar'];
	}
	//Se calcula la diferencia
	$diferencia = $montoDeuda + $saldo;
	//Ahora Voy Actualizar el Saldo A Favor
	$modificarSaldo = "UPDATE cxc SET Dolar = '0.00' WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND  Condominio = '$condominio' AND Dolar < 0";
	//Ejecutar
	$consultaModificaSaldo = $conexion->query($modificarSaldo);
	//Ahora Voy Actualizar el Saldo Deudor
	$modificarDeuda = "UPDATE cxc SET Dolar = '$diferencia' WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND  Condominio = '$condominio' AND Dolar > 0";
	//Ejecutar
	$consultaModificaDeuda = $conexion->query($modificarDeuda);
	$nosaldo = 'Ya se descontó el Saldo a Favor';
	}
	
	## FIN SI TIENE SALDO A FAVOR Y AJUSTARLO

		//Comprobamos que se guardaron los datos
		if ($consulta) {

		?>
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
		</head>
		<body>
			<article class="container-fluid">
				<header id="header" class="">
					<h1><img src="../img/caja-registradora.png" class="img-fluid" width="5%" height="10%"> MÓDULO 7: CUENTAS POR COBRAR</h1>
				</header> 
				<section class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
						<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
						<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Descripción:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-calendar"></i> Emisión:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($emision)).'</span>';?></p>
						<p><strong><i class="las la-barcode"></i> Estado:</strong> <?php   echo '<span>'.$estado.'</span>';?></p>
						<div class="alert alert-success" role="alert">
		  				<p style="text-align: center">Los Datos se guardaron exitosamente y <?php echo $nosaldo;?></p>
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
		<header id="header" class="">
			<div class="row">
				<div class="col-3"></div>
				<div class="col-3">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
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