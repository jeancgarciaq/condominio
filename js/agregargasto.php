<?php  
//Conexión a la Base de Datos
include '../conexion.php';

//Reciben los datos
//Proveedor del Servicio
$proveedor = $_POST['proveedor'];
//var_dump($proveedor);
//Número del Comprobante de Egreso
$comprobante = $_POST['comprobante']; 
//var_dump($comprobante);
//Monto del Gasto
$monto = $_POST['monto']; 
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
$condominio = $_POST['condominio']; 
//var_dump($condominio);

//Buscar el id del condominio
$bid = $conexion->query("SELECT * FROM condominios WHERE Nombre = '$condominio'");
$arrayId = $bid->fetch_array(MYSQLI_ASSOC);
foreach($bid as $valor) {
	$id = $valor['ID'];
}
//Ingresar el gasto
$consulta = "INSERT INTO gastos (ID, Servicio, Comprobante, Monto, Descripcion, Fecha, idcondominio, Condominio) VALUES (null,'$proveedor', '$comprobante', '$monto', '$descripcion', '$fecha', '$id', '$condominio')";

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
		<header id="header" class="">
			<h1><img src="../img/negocios-y-finanzas.png" class="img-fluid" width="5%" height="10%"> MÓDULO 4: GASTOS</h1>
		</header> 
		<section class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<p><strong><i class="las la-store-alt"></i> Proveedor: </strong> <?php   echo '<span>'.$proveedor.'</span>';?></p>
				<p"><strong><i class="las la-cash-register"></i> # Comprobante:</strong> <?php   echo '<span>'.$comprobante.'</span>';?></p>
				<p><strong><i class="las la-coins"></i> Monto:</strong> <?php   echo '<span>'.$monto.'</span>';?></p>
				<p><strong><i class="las la-file-alt"></i> Descripción:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
				<p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.$nfecha.'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
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
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
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