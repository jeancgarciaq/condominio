<?php  
//Conexión a la Base de Datos
require_once '../conexion.php';

//Reciben los datos
//Proveedor del Servicio
//$proveedor = $_POST['proveedor'];
//var_dump($proveedor);
//Número del Comprobante de Egreso
$comprobante = $_POST['comprobante']; 
//var_dump($comprobante);
//Monto del Gasto
$monto = $_POST['monto']; 
$montod = $_POST['montod'];
//var_dump($monto);
//Descripción del Gasto
$descripcion = $_POST['descripcion']; 
//var_dump($descripcion);
//Fecha en la cual se genera el gasto
$fecha = $_POST['fecha']; 
//var_dump($fecha);
//Cambio Formato de Fecha
$nfecha = date("d/m/Y", strtotime($fecha));
//Condominio dónde se generó el gasto
$idcondominio = $_POST['condominio']; 
//var_dump($idcondominio);

//Nombre del Condominio
$bnombre = $conexion->query("SELECT * FROM condominios WHERE ID = '$idcondominio'");
$arrayNombre = $bnombre->fetch_array(MYSQLI_ASSOC);
foreach ($bnombre as $name) {
	$nombre = $name['NombreC'];
	//var_dump($nombre);
}

//Buscar Tasa Dólar para gasto
$bidtasa = $conexion->query("SELECT MAX(tasabcv.ID) AS ID FROM tasabcv");
$arrayidTasa = $bidtasa->fetch_array(MYSQLI_ASSOC);
foreach ($bidtasa as $uid) {
	$id = $uid['ID'];
}

$btasa = $conexion->query("SELECT * FROM tasabcv WHERE ID = '$id'");
$arrayTasa = $btasa->fetch_array(MYSQLI_ASSOC);
foreach ($btasa as $valort) {

	$tasa = $valort['tasa'];
	//$apertura = $valort['Apertura'];
	//var_dump($apertura);
	//$cierre = $valort['Cierre'];
	//var_dump($cierre);
}

//Establecer el valor de la tasa
/*if($cierre == 0) {
	$tasa = $apertura;
} else {
	$tasa = $cierre;
}*/

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

//Ingresar el gasto
$consulta = "INSERT INTO cuotas (ID, Descripcion, Comprobante, Montobs, Montousd, idcondominio, Fecha) VALUES (NULL, '$descripcion', '$comprobante', '$monto', '$montod', '$idcondominio', '$fecha')";

if ($conexion->query($consulta)) {?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agregar Gasto</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
	<article class="container-fluid">
		<!--INICIO BARRA NAVEGACIÓN -->
  <ul class="nav justify-content-center bg-primary">
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
		<header id="header" class="">
			<h1><img src="../img/negocios-y-finanzas.png" class="img-fluid" width="5%" height="10%"> MÓDULO 4: GASTOS</h1>
		</header> 
		<section class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<p><strong><i class="las la-file-alt"></i> Descripción:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
				<p"><strong><i class="las la-cash-register"></i> # Comprobante:</strong> <?php   echo '<span>'.$comprobante.'</span>';?></p>
				<p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.$monto.'</span>';?></p>
				<p><strong><i class="las la-coins"></i> Monto $:</strong> <?php   echo '<span>'.$montod.'</span>';?></p>
				<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.$nfecha.'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
				<div class="alert alert-success" role="alert">
  				<p style="text-align: center">Los Datos se guardaron exitosamente</p>
				</div>
			</div>
			<div class="col-2"></div>
		</section>
<?php }
	else { ?>
			<div class="alert alert-danger" role="alert">
  				<p style="text-align: center">Se ha producido un error, por favor inténtelo de nuevo. <br> Si el error persiste comuníquese con el administrador <a href="mailto:jcvictory@hotmail.com"><i class="las la-envelope"></i> Enviar Correo</a> y/o <a href="https://api.whatsapp.com/send?phone=584144812738"><i class="lab la-whatsapp"></i> Escribir al WhatsApp</a></p>
			</div>
<?php }
/* cerrar la conexión */
$conexion->close();

?>
		<header id="header" class="">
			<div class="row">
				<div class="col-4"></div>
				<div class="col-2">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
				</div>
				<div class="col-2">
					<p style="text-align: center;"><a href="../gastos.php"><img src="../img/negocios-y-finanzas.png" width="60px" height="70px"><br>Gastos</a></p>
				</div>
				<div class="col-4"></div>
			</div>
		</header>
	</article>
</body>
</html>