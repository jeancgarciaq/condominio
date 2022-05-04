<?php  
//Conexión a la Base de Datos
require_once '../conexion.php';

//Reciben los datos
//Persona Responsable
$nombre = $_POST['nombre'];
//var_dump($nombre);
//Correo electrónico de contacto
$correo = $_POST['correo'];
$correo2 = $_POST['correo2']; 
//var_dump($correo);
//Nombre del Condominio
$idcondominio = $_POST['condominio']; 
//var_dump($idcondominio);
//Número de RIF
$inmueble = $_POST['inmueble']; 
//var_dump($inmueble);
$alicuota = $_POST['alicuota'];
//var_dump($alicuota);
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

//NOMBRE DEL CONDOMINIO
if($idcondominio == 1) {
	$condominio = 'Edificio Bucare';
} elseif($idcondominio == 2) {
	$condominio = 'Res. San Francisco';
} elseif($idcondominio == 3) {
	$condominio = 'Torre 1, Res. San Francisco';
} else {
	$condominio = 'Condominio Samán';
}

//Forzar ID a 4
if ($idcondominio == 0){
	$idcondominio = 4;
}


/* SENTENCIA SQL PARA CREAR UN FOREIGN KEY
ALTER TABLE `nombretabla1` ADD CONSTRAINT `nombreclave` FOREIGN KEY (`columnatabla1`) REFERENCES `nombretabla2`(`clave2`) ON DELETE RESTRICT ON UPDATE CASCADE;
*/
$consulta = "INSERT INTO propietarios (ID, Nombre, Inmueble, idcondominio,  Telefono, Correo, Correo2, Direccion, Ciudad, Estado, Alicuota) VALUES (null,'$nombre', '$inmueble', '$idcondominio', '$telefono', '$correo', '$correo2', '$direccion','$ciudad', '$estado', '$alicuota')";

if ($conexion->query($consulta)) {?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agregar Propietario</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
	<article class="container-fluid">
		<!-- INICIO MENÚ NAV -->
		<ul class="nav justify-content-center bg-primary">
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
		<!-- FIN MENÚ NAV-->
		<header id="header" class="">
			<h1><img src="../img/trabajo-en-equipo.png" class="img-fluid" width="5%" height="10%"> MÓDULO 2: PROPIETARIOS</h1>
		</header> 
		<section class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<p><strong><i class="la la-user-tie"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
				<p"><strong><i class="la la-home"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
				<p><strong><i class="la la-phone"></i> Teléfono:</strong> <?php   echo '<span>'.$telefono.'</span>';?></p>
				<p><strong><i class="la la-envelope-o"></i> Correo:</strong> <?php   echo '<span>'.$correo.'</span>';?></p>
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
  				<p style="text-align: center">Se ha producido el siguiente <?php  printf(" Error: %s\n", $conexion->error); ?> por favor inténtelo de nuevo. <br> Si el error persiste comuníquese con el administrador <a href="mailto:jcvictory@hotmail.com"><i class="las la-envelope"></i> Enviar Correo</a> y/o <a href="https://api.whatsapp.com/send?phone=584144812738"><i class="lab la-whatsapp"></i> Escribir al WhatsApp</a></p>
			</div>
<?php }
/* cerrar la conexión */
$conexion->close();

?>
		<header id="header" class="">
			<div class="row">
				<div class="col-6"></div>
				<div class="col-1">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
				</div>
				<div class="col-1">
					<p style="text-align: center;"><a href="../propietarios.php"><img src="../img/trabajo-en-equipo.png" width="50px" height="70px"><br>Propietarios</a></p>
				</div>
				<div class="col-4"></div>
			</div>
		</header>
	</article>
</body>
</html>