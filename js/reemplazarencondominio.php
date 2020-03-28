<?php  
//Conexión a la Base de Datos
include '../conexion.php';

//Reciben los datos
//Persona Responsable
$nombre = $_POST['nombre'];
//var_dump($nombre);
$nombrer = $_POST['nombrer'];
//var_dump($nombrer);
$telefonor = $_POST['telefonor'];
//var_dump($telefonor);
$condominio = $_POST['condominio'];

//$consulta1 = $conexion->query("UPDATE condominios SET Responsable = '$nombrer' WHERE Responsable = '$nombre'");

$consulta = $conexion->query("UPDATE condominios SET Responsable = '$nombrer', Telefono = '$telefonor' WHERE condominios.Responsable = '$nombre'");


if ($consulta){ ?>

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
			<h1><img src="../img/pueblo.png" class="img-fluid" width="5%" height="10%"> MÓDULO 1: CONDOMINIOS</h1>
		</header> 
		<section class="row">
			<article class="col-3"></article>
			<article class="col-6">
				<h3><b>Se sustituyó a:</b></h3>
				<ul>
					<li><b>Responsable:</b> <?php echo $nombre; ?></li>
				</ul>
				<p><b>Por:</b></p>
				<ul>
					<li><b>Responsable:</b> <?php echo $nombrer; ?></li>
					<li><b>Teléfono:</b> <?php echo $telefonor; ?></li>
				</ul>
				<p><b>En el Condominio:</b> <?php echo $condominio; ?></p>
				<div class="alert alert-success" role="alert">
					<strong>Cambio Realizado Exitosamente</strong>
				</div>
			</article>
			<article class="col-3"></article>
			</article>
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
					<p style="text-align: center;"><a href="../condominio.php"><img src="../img/pueblo.png" width="50px" height="70px"><br>Condominio</a></p>
				</div>
				<div class="col-4"></div>
			</div>
		</header>
	</article>
</body>
</html>