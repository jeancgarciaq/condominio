<?php  
include '../conexion.php';

//Número del Inmueble
$inmueble = $_POST['inmueble']; 
//var_dump($inmueble);
//Condominio dónde va el pago
$condominio = $_POST['condominio']; 
//var_dump($condominio);
//Monto del Pago
$monto = $_POST['monto'];
$montod = $_POST['montod']; 
//var_dump($monto);
//Referencia Transferencia o billete
$referencia = $_POST['referencia'];
//var_dump($referencia);
//Banco
$banco = $_POST['banco'];
//var_dump($banco);
//Observación del Pago
$observacion = $_POST['observacion']; 
//var_dump($observacion);
//Fecha en la cual se genera el gasto
$fecha = $_POST['fecha']; 
//var_dump($fecha);
//Pagos no conciliado
$conciliado = 'NO';
//Recibo
$recibo = 'NO';

//Buscar el Nombre
if($inmueble == 'todos') {
	$nombre = 'todos';
}
else {

	$bnombre = $conexion->query("SELECT * FROM propietarios WHERE Numero = '$inmueble'");
	$arrayNombre = $bnombre->fetch_array(MYSQLI_ASSOC);
	foreach ($bnombre as $valor) {
		$nombre = $valor['Nombre'];
	}
}

?>
<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<title>Agregar Pago</title>
			<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
			<link rel="stylesheet" href="../css/estilos.css">
			<link href="../css/line-awesome.min.css" rel="stylesheet">
		</head>
		<body>
<?php

if($banco == 'BANESCO') {

	$consulta = $conexion->query("INSERT INTO pagos (ID, Nombre, Inmueble, Condominio, Monto, Dolar, Referencia1, Referencia2, Banco, Observacion, Fecha, Conciliado, Recibo) VALUES (null, '$nombre', '$inmueble', '$condominio', '$monto', '$montod', '$referencia', '$referencia', '$banco', '$observacion', '$fecha', '$conciliado', '$recibo')");
	if($consulta) {?>
			<article class="container-fluid">
				<header id="header" class="">
					<h1><img src="../img/caja.png" class="img-fluid" width="5%" height="10%"> MÓDULO 5: PAGOS</h1>
				</header> 
				<section class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
						<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
						<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-barcode"></i> Referencia:</strong> <?php   echo '<span>'.$referencia.'</span>';?></p>
						<p><strong><i class="la la-landmark"></i> Banco:</strong> <?php   echo '<span>'.$banco.'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Observación:</strong> <?php   echo '<span>'.$observacion.'</span>';?></p>
						<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($fecha)).'</span>';?></p>				
						<div class="alert alert-success" role="alert">
		  				<p style="text-align: center">Los Datos se guardaron exitosamente</p>
						</div>
					</div>
					<div class="col-2"></div>
				</section>
<?php }
		else {

				printf("Error: %s\n", mysqli_error($conexion)).'<br>';?>
				<div class="alert alert-danger" role="alert">
					<p style="text-align: center">Se ha producido un error, por favor inténtelo de nuevo. <br> Si el error persiste comuníquese con el administrador <a href="mailto:jcvictory@hotmail.com"><i class="las la-envelope"></i> Enviar Correo</a> y/o <a href="https://api.whatsapp.com/send?phone=584144812738"><i class="lab la-whatsapp"></i> Escribir al WhatsApp</a></p>
				</div>
<?php  		}
		}
//AGREGAR BNC
elseif($banco == 'BNC') {

	$consulta = $conexion->query("INSERT INTO pagos (ID, Nombre, Inmueble, Condominio, Monto, Dolar, Referencia1, Referencia2, Banco, Observacion, Fecha, Conciliado, Recibo) VALUES (NULL, '$nombre', '$inmueble', '$condominio', '$monto', '$montod', '$referencia', '$referencia', '$banco', '$observacion', '$fecha', '$conciliado', '$recibo')");
	if($consulta) {?>
			<article class="container-fluid">
				<header id="header" class="">
					<h1><img src="../img/caja.png" class="img-fluid" width="5%" height="10%"> MÓDULO 5: PAGOS</h1>
				</header> 
				<section class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
						<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
						<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-barcode"></i> Referencia:</strong> <?php   echo '<span>'.$referencia.'</span>';?></p>
						<p><strong><i class="la la-landmark"></i> Banco:</strong> <?php   echo '<span>'.$banco.'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Observación:</strong> <?php   echo '<span>'.$observacion.'</span>';?></p>
						<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($fecha)).'</span>';?></p>				
						<div class="alert alert-success" role="alert">
		  				<p style="text-align: center">Los Datos se guardaron exitosamente</p>
						</div>
					</div>
					<div class="col-2"></div>
				</section>
<?php }
		else {

				printf("Error: %s\n", mysqli_error($conexion)).'<br>';?>
				<div class="alert alert-danger" role="alert">
					<p style="text-align: center">Se ha producido un error, por favor inténtelo de nuevo. <br> Si el error persiste comuníquese con el administrador <a href="mailto:jcvictory@hotmail.com"><i class="las la-envelope"></i> Enviar Correo</a> y/o <a href="https://api.whatsapp.com/send?phone=584144812738"><i class="lab la-whatsapp"></i> Escribir al WhatsApp</a></p>
				</div>
<?php  		}
		}
// LOS DEMÁS BANCOS
else
	{

		$consulta = $conexion->query("INSERT INTO pagos (ID, Nombre, Inmueble, Condominio, Monto, Dolar, Referencia1, Referencia2, Banco, Observacion, Fecha, Conciliado, Recibo) VALUES (NULL, '$nombre', '$inmueble', '$condominio', '$monto', '$montod', '$referencia','En espera', '$banco', '$observacion', '$fecha', '$conciliado', '$recibo')");

		if ($consulta) {?>
	<article class="container-fluid">
		<header>
			<h1><img src="../img/caja.png" class="img-fluid" width="5%" height="10%"> MÓDULO 5: PAGOS</h1>
		</header> 
		<section class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
				<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
				<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
				<p><strong><i class="las la-coins"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
				<p><strong><i class="las la-barcode"></i> Referencia:</strong> <?php   echo '<span>'.$referencia.'</span>';?></p>
				<p><strong><i class="la la-landmark"></i> Banco:</strong> <?php   echo '<span>'.$banco.'</span>';?></p>
				<p><strong><i class="las la-file-alt"></i> Observación:</strong> <?php   echo '<span>'.$observacion.'</span>';?></p>
				<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($fecha)).'</span>';?></p>
				
				<div class="alert alert-success" role="alert">
  				<p style="text-align: center">Los Datos se guardaron exitosamente</p>
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
		<footer class="container-fluid">
			<div class="row">
				<div class="col-1"></div>
				<div class="col-5">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
				</div>
				<div class="col-5">
					<p style="text-align: center;"><a href="../pagos.php"><img src="../img/caja.png" width="60px" height="70px"><br>Pagos</a></p>
				</div>
				<div class="col-1"></div>
			</div>
		</footer>
	</article>
</body>
</html>