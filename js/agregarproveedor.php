<?php  
//Conexión a la Base de Datos
require_once '../conexion.php';

//Reciben los datos
//Empresa o Responsable
$empresa = $_POST['empresa'];
//var_dump($empresa);
//Responsable
$responsable = $_POST['responsable'];
//var_dump($responsable);
//Correo electrónico de contacto
$correo = $_POST['correo']; 
//var_dump($correo);
//Nombre del Condominio
$condominio = $_POST['condominio']; 
//var_dump($condominio);
//Número de RIF
$rif = $_POST['rif']; 
//var_dump($rif);
//Número de Teléfono
$telefono = $_POST['telefono']; 
//var_dump($telefono);
//Dirección del Condominio
$direccion = $_POST['direccion']; 
//var_dump($direccion);
//Ciudad
$ciudad = $_POST['ciudad']; 
//var_dump($ciudad);
//Estado
$estado = $_POST['estado']; 
//var_dump($estado);

$consulta = "INSERT INTO proveedores (ID, Servicio, RIF, Condominio, Responsable, Correo, Telefono,  Direccion, Ciudad, Estado) VALUES (null,'$empresa', '$rif', '$condominio', '$responsable', '$correo', '$telefono', '$direccion','$ciudad', '$estado')";

if ($conexion->query($consulta)) {?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agregar Proveedor</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
	<article class="container-fluid">
		<header id="header" class="">
			<h1><img src="../img/obrero.png" class="img-fluid" width="5%" height="10%"> MÓDULO 3: PROVEEDORES</h1>
		</header> 
		<section class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<p><strong><i class="las la-store-alt"></i> Empresa: </strong> <?php   echo '<span>'.$empresa.'</span>';?></p>
				<p"><strong><i class="la la-user-tie"></i> Responsable:</strong> <?php   echo '<span>'.$responsable.'</span>';?></p>
				<p"><strong><i class="las la-barcode"></i> Nº RIF/CI:</strong> <?php   echo '<span>'.$rif.'</span>';?></p>
				<p><strong><i class="la la-envelope-o"></i> Correo:</strong> <?php   echo '<span>'.$correo.'</span>';?></p>
				<p><strong><i class="la la-phone"></i> Teléfono:</strong> <?php   echo '<span>'.$telefono.'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
				<p><strong><i class="la la-location-arrow"></i> Dirección:</strong> <?php   echo '<span>'.$direccion.'</span>';?></p>
				<p><strong><i class="la la-map-marker"></i> Ciudad:</strong> <?php   echo '<span>'.$ciudad.'</span>';?></p>
				<p><strong><i class="la la-map-marked"></i> Estado:</strong> <?php   echo '<span>'.$estado.'</span>';?></p>
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
				<div class="col-6"></div>
				<div class="col-1">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
				</div>
				<div class="col-1">
					<p style="text-align: center;"><a href="../proveedores.php"><img src="../img/obrero.png" width="55px" height="70px"><br>Proveedores</a></p>
				</div>
				<div class="col-4"></div>
			</div>
		</header>
	</article>
</body>
</html>