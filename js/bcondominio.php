<?php  
	include('../conexion.php');

//Reciben la búsqueda
$buscar = $_POST['condominio']; 
//$buscar = "Res. San Francisco";

$consulta = "SELECT * FROM condominios WHERE Nombre LIKE '$buscar'";

if ($resultado = $conexion->query($consulta)) {

    /* obtener el array de objetos */
    echo '<ul>';
		foreach ($resultado as $row) {?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Buscar Condominio</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
	<article class="container-fluid">
		<header id="header" class="">
			<h1><img src="../img/pueblo.png" class="img-fluid" width="5%" height="10%"> MÓDULO 1: CONDOMINIOS</h1>
		</header><!-- /header -->
		<section class="row">
			<div class="col-4"></div>
			<div class="col-8">
				<p><strong><i class="la la-hashtag"></i>ID: </strong><?php echo '<span>'.$row['ID'].'</span>';?></p>
				<p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$row['Nombre'].'</span>';?></p>
				<p><strong><i class="la la-user-tie"></i> Responsable: </strong> <?php   echo '<span>'.$row['Responsable'].'</span>';?></p>
				<p"><strong><i class="la la-address-card"></i> Cargo:</strong> <?php   echo '<span>'.$row['Cargo'].'</span>';?></p>
				<p><strong><i class="la la-envelope-o"></i> Correo:</strong> <?php   echo '<span>'.$row['Correo'].'</span>';?></p>
				<p><strong><i class="la la-barcode"></i> Nº RIF:</strong> <?php   echo '<span>'.$row['RIF'].'</span>';?></p>
				<p><strong><i class="la la-phone"></i> Teléfono:</strong> <?php   echo '<span>'.$row['Telefono'].'</span>';?></p>
				<p><strong><i class="la la-location-arrow"></i> Dirección:</strong> <?php   echo '<span>'.$row['Direccion'].'</span>';?></p>
				<p><strong><i class="la la-map-marker"></i> Ciudad:</strong> <?php   echo '<span>'.$row['Ciudad'].'</span>';?></p>
				<p><strong><i class="la la-map-marked"></i> Estado:</strong> <?php   echo '<span>'.$row['Estado'].'</span>';?></p>
				<p><strong><i class="la la-map-marked"></i> Mapa:</strong><br> <?php   echo '<span>'.$row['Mapa'].'</span>';?></p>
			</div>
			<div class="col-4"></div>
		</section>
		<header id="header" class="">
			<div class="row">
				<div class="col-6"></div>
				<div class="col-1">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
				</div>
				<div class="col-1">
					<p style="text-align: center;"><a href="../condominio.php"><img src="../img/pueblo.png" width="50px" height="70px"><br>Condominio</a></p>
				</div>
				<div class="col-4"></div>
			</div>
		</header><!-- /header -->
	</article>
</body>
</html>				
     
<?php }
		echo '</ul>';

    /* liberar el conjunto de resultados */
    $resultado->close();
}

/* cerrar la conexión */
$conexion->close();

?>