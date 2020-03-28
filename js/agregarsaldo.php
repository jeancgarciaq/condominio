<?php  
include '../conexion.php';

//Recibir los datos
$nombre = $_POST['nombre'];
//var_dump($nombre);
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
$estado = 'PAGADO';
//Primero busco el nombre y lo guardo
$bnombre = $conexion->query("SELECT Nombre from propietarios WHERE Numero = '$inmueble'");
$arrayN = $bnombre->fetch_array(MYSQLI_ASSOC);
foreach ($bnombre as $fila) {
	$nombre = $fila['Nombre'];}
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
		<section class="container-fluid">
			<header id="header" class="">
					<h1><img src="../img/caja-registradora.png" class="img-fluid" width="5%" height="10%"> MÓDULO 7: CUENTAS POR COBRAR</h1>
			</header> 
<?php
//Voy a condicionar según 2 casos: Bolívares para Bucare y Dólares para San Francisco
if ($condominio == 'Edificio Bucare' ){
	//Realizamos la Consulta
	$ingresarSaldo = $conexion->query("INSERT INTO cxc (ID, Nombre, Inmueble, Condominio, Descripcion, Monto, Dolar, Emision, Estado) VALUES (NULL, '$nombre', '$inmueble', '$condominio', '$descripcion', '$monto', '$montod', '$emision', '$estado')");

	$resultado = $conexion->affected_rows;

	if($resultado == 1) {?>
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
		  				<p style="text-align: center">Los Datos se guardaron exitosamente</p>
						</div>
					</div>
					<div class="col-2"></div>
				</section>
<?php
	}
	else {
		echo "Se ha producido el siguiente error: ".$conexion->error;
	}
}
else {
	//Realizamos la Consulta
	$ingresarSaldo = $conexion->query("INSERT INTO cxc (ID, Nombre, Inmueble, Condominio, Descripcion, Monto, Dolar, Emision, Estado) VALUES (NULL, '$nombre', '$inmueble', '$condominio', '$descripcion', '$monto', '$montod', '$emision', '$estado')");

	$resultado = $conexion->affected_rows;

	if($resultado == 1) {?>
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
					<p style="text-align: center">Los Datos se guardaron exitosamente</p>
				</div>
			</div>
			<div class="col-2"></div>
		</section>
<?php
	}
	else {
		echo "Se ha producido el siguiente error: ".$conexion->error;
	}
}
?>
			<header>
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
		</section>
	</body>
</html>