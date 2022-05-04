<?php  
require_once '../conexion.php';
//ID del Propietario
$idpropietarios = $_POST['inmueble'];
//ID del Condominio
$idcondominio = $_POST['condominio']; 
//var_dump($condominio);
//Monto del Pago
$monto = $_POST['monto'];
$montod = $_POST['montod']; 
//var_dump($monto);
//var_dump($montod);
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
$conciliado = $_POST['conciliado'];
//Recibo
$recibo = 'NO';
//Tasa
$tasa = $_POST['tasa'];
$descripcion = $_POST['descripcion'];
//var_dump($tasa);
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

//Buscar el Nombre y Apartamento del Propietario
$bnombre = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietarios' AND idcondominio = '$idcondominio'");
$arrayNombre = $bnombre->fetch_array(MYSQLI_ASSOC);
	foreach ($bnombre as $valor) {
		$nombre = $valor['Nombre'];
		$inmueble = $valor['Inmueble'];
	}
//Buscar el Nombre del condominio
$bnombreC = $conexion->query("SELECT * FROM condominios WHERE ID = '$idcondominio'");
$arrayNombre = $bnombreC->fetch_array(MYSQLI_ASSOC);
	foreach ($bnombreC as $valorC) {
		$condominio = $valorC['NombreC'];
		$rif = $valorC['RIF'];
		$direccion = $valorC['Direccion'];
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
			<style type="text/css" media="print">
		       /* Reglas CSS específicas para imprimir */
		       #menu, #pie, #titulo, #titulo1, #titulo2, #alerta0, #alerta1, #alerta2 {
		       	display: none !important;
		       }
			</style>
		</head>
		<body>
<div class="container-fluid">
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
</div>
<?php

if($banco == 'BANESCO') {

	$consulta = $conexion->query("INSERT INTO pagos (ID, idpropietario, Monto, Dolar, Tasa, Descripcion, Referencia1, Referencia2, Banco, Observacion, Fecha, Conciliado, Recibo) VALUES (null, '$idpropietarios', '$monto', '$montod', '$tasa', '$descripcion', '$referencia', '$referencia', '$banco', '$observacion', '$fecha', '$conciliado', '$recibo')");
	if($consulta) {
		//Buscar ID de la última consulta
		$buscarID = $conexion->query("SELECT MAX(ID) as IDr FROM pagos WHERE idpropietario = '$idpropietarios'");
		$arrayBid = $buscarID->fetch_array(MYSQLI_ASSOC);
		foreach ($buscarID as $numero) {
			$ID = $numero['IDr'];
		}
		//Fin Buscar ID
		?>
			<article class="container-fluid">
				<header id="titulo">
					<h1><img src="../img/caja.png" class="img-fluid" width="5%" height="10%"> MÓDULO 5: PAGOS</h1>
				</header> 
				<section class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<p> Condominio <?php echo $condominio;?><br>
						    RIF <?php echo $rif;?><br>
							Dirección: <?php echo $direccion;?>
						</p>
						<hr>
						<h2><?php echo 'Fecha: '.date("d/m/Y");?> | Recibo # <?php echo date("m")."-".$ID;?></h2>
						<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
						<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
						<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-dollar"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-chart-line"></i> Tasa Cambio Bs./$:</strong> <?php   echo '<span>'.number_format($tasa, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Por Concepto de:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
						<p><strong><i class="las la-barcode"></i> Referencia:</strong> <?php   echo '<span>'.$referencia.'</span>';?></p>
						<p><strong><i class="la la-landmark"></i> Banco:</strong> <?php   echo '<span>'.$banco.'</span>';?></p>
						<p><strong><i class="las la-comment"></i> Observación:</strong> <?php   echo '<span>'.$observacion.'</span>';?></p>
						<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($fecha)).'</span>';?></p>
						<section class="row">
				          <div class="col"></div>
				          <div class="col"></div>
				          <div class="col"></div>
				          <div class="col"><img src="../img/Pagado.png"></div>          
				        </section>				
						<div class="alert alert-success" role="alert" id="alerta0">
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

	$consulta = $conexion->query("INSERT INTO pagos (ID, idpropietario, Monto, Dolar, Tasa, Descripcion, Referencia1, Referencia2, Banco, Observacion, Fecha, Conciliado, Recibo) VALUES (null, '$idpropietarios', '$monto', '$montod', '$tasa', '$descripcion', '$referencia', '$referencia', '$banco', '$observacion', '$fecha', '$conciliado', '$recibo')");
	if($consulta) {
			//Buscar ID de la última consulta
			$buscarID = $conexion->query("SELECT MAX(ID) as IDr FROM pagos WHERE idpropietario = '$idpropietarios'");
			$arrayBid = $buscarID->fetch_array(MYSQLI_ASSOC);
			foreach ($buscarID as $numero) {
				$ID = $numero['IDr'];	}
			//Fin Buscar ID

		?>
			<article class="container-fluid">
				<header id="titulo1">
					<h1><img src="../img/caja.png" class="img-fluid" width="5%" height="10%"> MÓDULO 5: PAGOS</h1>
				</header> 
				<section class="row">
					<div class="col-2"></div>
					<div class="col-8">
						<p> Condominio <?php echo $condominio;?><br>
						    RIF <?php echo $rif;?><br>
							Dirección: <?php echo $direccion;?>
						</p>
						<hr>
						<h2><?php echo 'Fecha: '.date("d/m/Y");?> | Recibo # <?php echo date("m")."-".$ID;?></h2>
						<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
						<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
						<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
						<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-dollar"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-chart-line"></i> Tasa Cambio Bs./$:</strong> <?php   echo '<span>'.number_format($tasa, 2, ',','.').'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Por Concepto de:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
						<p><strong><i class="las la-barcode"></i> Referencia:</strong> <?php   echo '<span>'.$referencia.'</span>';?></p>
						<p><strong><i class="la la-landmark"></i> Banco:</strong> <?php   echo '<span>'.$banco.'</span>';?></p>
						<p><strong><i class="las la-file-alt"></i> Observación:</strong> <?php   echo '<span>'.$observacion.'</span>';?></p>
						<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($fecha)).'</span>';?></p>
						<section class="row">
				          <div class="col"></div>
				          <div class="col"></div>
				          <div class="col"></div>
				          <div class="col"><img src="../img/Pagado.png"></div>          
				        </section>				
						<div class="alert alert-success" role="alert" id="alerta1">
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

		$consulta = $conexion->query("INSERT INTO pagos (ID, idpropietario, Monto, Dolar, Tasa, Descripcion, Referencia1, Referencia2, Banco, Observacion, Fecha, Conciliado, Recibo) VALUES (null, '$idpropietarios', '$monto', '$montod', '$tasa', '$descripcion', '$referencia', '$referencia', '$banco', '$observacion', '$fecha', '$conciliado', '$recibo')");

		if ($consulta) {
				//Buscar ID de la última consulta
				$buscarID = $conexion->query("SELECT MAX(ID) as IDr FROM pagos WHERE idpropietario = '$idpropietarios'");
				$arrayBid = $buscarID->fetch_array(MYSQLI_ASSOC);
				foreach ($buscarID as $numero) {
					$ID = $numero['IDr'];}
				//Fin Buscar ID
			?>
	<article class="container-fluid">
		<header id="titulo2">
			<h1><img src="../img/caja.png" class="img-fluid" width="5%" height="10%"> MÓDULO 5: PAGOS</h1>
		</header> 
		<section class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<p> Condominio <?php echo $condominio;?><br>
				    RIF <?php echo $rif;?><br>
					Dirección: <?php echo $direccion;?>
				</p>
				<hr>
				<h2><?php echo 'Fecha: '.date("d/m/Y");?> | Recibo # <?php echo date("m")."-".$ID;?></h2>
				<p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
				<p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
				<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
				<p><strong><i class="las la-dollar"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
				<p><strong><i class="las la-chart-line"></i> Tasa Cambio Bs./$:</strong> <?php   echo '<span>'.number_format($tasa, 2, ',','.').'</span>';?></p>
				<p><strong><i class="las la-file-alt"></i> Por Concepto de:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
				<p><strong><i class="las la-barcode"></i> Referencia:</strong> <?php   echo '<span>'.$referencia.'</span>';?></p>
				<p><strong><i class="la la-landmark"></i> Banco:</strong> <?php   echo '<span>'.$banco.'</span>';?></p>
				<p><strong><i class="las la-file-alt"></i> Observación:</strong> <?php   echo '<span>'.$observacion.'</span>';?></p>
				<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($fecha)).'</span>';?></p>
				<section class="row">
				    <div class="col"></div>
				    <div class="col"></div>
				    <div class="col"></div>
				    <div class="col"><img src="../img/Pagado.png"></div>          
				</section>
				<div class="alert alert-success" role="alert" id="alerta2">
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
		<footer class="container-fluid" id="pie">
			<div class="row">
				<div class="col-1"></div>
				<div class="col-5">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
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