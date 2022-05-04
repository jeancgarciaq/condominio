<?php  
require_once '../conexion.php';

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

#INICIO BUSCAR TASA
$bidtasa = $conexion->query("SELECT MAX(tasabcv.ID) AS ID FROM tasabcv");
$arrayidTasa = $bidtasa->fetch_array(MYSQLI_ASSOC);
foreach ($bidtasa as $uid) {
	$id = $uid['ID'];
}

$btasa = $conexion->query("SELECT * FROM tasabcv WHERE ID = '$id'");
$arrayTasa = $btasa->fetch_array(MYSQLI_ASSOC);
foreach ($btasa as $valort) {
	$tasa = $valort['tasa'];
}

//Establecer el valor de la tasa
/*if($cierre == 0) {
	$tasa = $apertura;
} else {
	$tasa = $cierre;
}*/
## FIN BUSCAR TASA

if($monto == 0) {
	$monto = $montod*$tasa;
} else {
	$montod = $monto/$tasa;
}
//Cambiar a Negativo
$monto = $monto * -1;
$montod = $montod * -1;

//Primero busco el nombre y lo guardo
$bnombre = $conexion->query("SELECT Nombre from propietarios WHERE ID = '$inmueble'");
$arrayN = $bnombre->fetch_array(MYSQLI_ASSOC);
foreach ($bnombre as $fila) {
	$nombre = $fila['Nombre'];}

//Buscar el nombre del Condominio
$bNc = $conexion->query("SELECT * FROM condominios WHERE ID = '$condominio'");
$arrayNc = $bNc->fetch_array(MYSQLI_ASSOC);
foreach ($bNc as $name) {
	$nombreC = $name['NombreC'];
}

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
		<style media="print">
		    #menu, #encabezado, #pie, #navegacion { display: none !important;}
		  </style>
	</head>
	<body>
		<section class="container-fluid">
			<!--INICIO BARRA NAVEGACIÓN -->
		  <ul class="nav justify-content-center bg-primary" id="menu">
		    <li class="nav-item">
		      <a class="nav-link active text-light border-start border-white" href="../index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white" href="../condominio.php"><i class="las la-city"></i> Condominio</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white" href="../propietarios.php"><i class="las la-user-alt"></i> Propietarios</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white" href="../proveedores.php"><i class="las la-store-alt"></i> Proveedores</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white" href="../pagos.php"><i class="las la-donate"></i> Pagos</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white" href="../gastos.php"><i class="las la-file-invoice-dollar"></i> Gastos</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white" href="../avisos.php"><i class="las la-receipt"></i> Avisos</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white" href="../cxc.php"><i class="las la-cash-register"></i> Cuentas x Cobrar</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link text-light border-start border-white border-end" href="../cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
		    </li>
		  </ul>
		  <!--FIN BARRA NAVEGACIÓN -->
			<header id="encabezado" class="mt-4">
					<h1><img src= "../img/caja.png" class="img-fluid" id="iconoM5"> MÓDULO 5: PAGOS</h1>
			</header> 
<?php
//Voy a condicionar según 2 casos: Bolívares para Bucare y Dólares para San Francisco
if ($condominio == 1){
	//Realizamos la Consulta
	$ingresarSaldo = $conexion->query("INSERT INTO cxc (ID, idpropietario, Descripcion, Monto, Dolar, Emision, Estado) VALUES (NULL, '$inmueble', '$descripcion', '$monto', '$montod', '$emision', '$estado')");

	$resultado = $conexion->affected_rows;

	if($resultado == 1) {?>
		<section class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
						<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
						<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$nombreC.'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Descripción:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-calendar"></i> Emisión:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($emision)).'</span>';?></p>
						<p><strong><i class="las la-barcode"></i> Estado:</strong> <?php   echo '<span>'.$estado.'</span>';?></p>
						<div class="alert alert-success" role="alert" id="pie">
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
	$ingresarSaldo = $conexion->query("INSERT INTO cxc (ID, idpropietario, Descripcion, Monto, Dolar, Emision, Estado) VALUES (NULL, '$inmueble', '$descripcion', '$monto', '$montod', '$emision', '$estado')");

	$resultado = $conexion->affected_rows;

	if($resultado == 1) {?>
		<section class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
				<p"><strong><i class="las la-hashtag"></i> ID:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$nombreC.'</span>';?></p>
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
			<footer id="navegacion">
				<div class="row">
					<div class="col-3"></div>
					<div class="col-3">
						<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
					</div>
					<div class="col-3">
						<p style="text-align: center;"><a href="../pagos.php"><img src="../img/caja.png" width="60px" height="70px"><br>Pagos</a></p>
					</div>
					<div class="col-3"></div>
				</div>
		</footer>
		</section>
	</body>
</html>