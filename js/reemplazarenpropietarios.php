<?php  
//Conexión a la Base de Datos
include '../conexion.php';

//Reciben los datos
//Número del Inmueble
$numero = $_POST['numero'];
var_dump($numero);
//Condominio
$condominio = $_POST['condominio'];
var_dump($condominio);
//Nombre
$nombre = $_POST['nombre'];
var_dump($nombre);
//Correo
$correo = $_POST['correo'];
var_dump($correo);
//Telefono
$telefono = $_POST['telefono'];
var_dump($telefono);

$buscar = $conexión->query("SELECT Numero FROM propietarios WHERE propietario.Numero = '$numero'");

$filas = $conexion->affected_rows($buscar);

if ($filas = 1) {

	echo 'Hay 1 registro';
}
else if ($filas > 1) {

	echo 'Hay más de 1 Registro';
}

else {

	echo 'No hay registros';
}



/*$consulta = $conexion->query("UPDATE propietarios SET Nombre = '$nombre', Telefono = '$telefono', Correo = '$correo' WHERE propietarios.Numero = '$numero' AND propietarios.Condominio = '$condominio'");
 		?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Modificar Miembro Condominio</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
	<article class="container-fluid">
		<header id="header" class="">
			<h1><img src="../img/trabajo-en-equipo.png" class="img-fluid" width="5%" height="10%"> MÓDULO 2: PROPIETARIOS</h1>
		</header> 
		<section class="row">
			<article class="col-3"></article>
			<article class="col-6">
				<h3><b>Se sustituyó a:</b></h3>
				<ul>
					<li><b>Inmueble:</b> <?php echo $numero; ?></li>
				</ul>
				<p><b>Por:</b></p>
				<ul>
					<li><b>Nombre:</b> <?php echo $nombre; ?></li>
					<li><b>Teléfono:</b> <?php echo $telefono; ?></li>
					<li><b>Correo:</b> <?php echo $correo; ?></li>
				</ul>
				<p><b>En el Condominio:</b> <?php echo $condominio; ?></p>
				<div class="alert alert-success" role="alert">
					<strong>Cambio Realizado Exitosamente</strong>
				</div>
			</article>
			<article class="col-3"></article>
			</article>
		</section>
			

			<div class='alert alert-danger' role='alert'>
  				<p style='text-align: center'>Se ha producido un error, por favor inténtelo de nuevo. <br> Si el error persiste comuníquese con el administrador <a href='mailto:jcvictory@hotmail.com'><i class='las la-envelope'></i> Enviar Correo</a> y/o <a href='https://api.whatsapp.com/send?phone=584144812738'><i class='lab la-whatsapp'></i> Escribir al WhatsApp</a></p>
			</div>
 		
<?php

/* cerrar la conexión */
//$conexion->close();

?>
<!--		<header id="header" class="">
			<div class="row">
				<div class="col-4"></div>
				<div class="col-2">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
				</div>
				<div class="col-2">
					<p style="text-align: center;"><a href="../propietarios.php"><img src="../img/trabajo-en-equipo.png" width="50px" height="70px"><br>Propietarios</a></p>
				</div>
				<div class="col-4"></div>
			</div>
		</header>
	</article>
</body>
</html>