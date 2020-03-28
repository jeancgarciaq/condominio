<?php  
//Conexión a la base de datos
include '../conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 2</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/line-awesome.min.css">
</head>
<body>
	<div class="container-fluid">
		<h1><img src="../img/trabajo-en-equipo.png" class="img-fluid" width="10%" height="10%"> MÓDULO 2: PROPIETARIOS</h1><br>
		<section class="row">
			<article class="col"></article>
			<article class="col-8">
				<h2>DATOS PERSONALES</h2>
				<?php
				//Número de Inmueble
				$inmueble = $_POST['inmueble'];
				//var_dump($inmueble);
				//Condominio
				$condominio = $_POST['condominio'];
				//Si seleccionó todos
				if ($inmueble == 'todos') {
					$nombre = 'todos';
				}
				else {
				//Buscar el nombre
				$bnombre = $conexion->query("SELECT * FROM propietarios WHERE Numero = '$inmueble'");
				$arrayNombre = $bnombre->fetch_array(MYSQLI_ASSOC);
				foreach ($bnombre as $fila) {
					$nombre = $fila['Nombre'];
				} }
				//var_dump($nombre);
				//Vamos a Realizar una consulta de todos los Propietario
				if($nombre == 'todos')
				{?>
					<p><b><i class="las la-user-alt"></i> Propietario:</b> <?php echo strtoupper($nombre); ?></p>
					<p><b><i class="la la-home"></i> Inmueble Nº:</b> <?php echo $inmueble; ?></p>
				<?php
					//Vamos a consultar la lista de propietarios
					$listaPropietarios = $conexion->query("SELECT * FROM propietarios WHERE Condominio = '$condominio'");
					//Ahora Vamos a construir una tabla con éstos valores
					?>
					<table class='table table-striped'>
					  <thead>
					    <tr>
					      <th scope='col'>ID</th>
					      <th scope='col'>NOMBRE</th>
					      <th scope='col'>Nº</th>
					      <th scope='col'>CORREO</th>
					      <th scope='col'>TELÉFONO</th>
					      <th scope='col'>CONDOMINIO</th>
					    </tr>
					  </thead>
					  <tbody>
							<?php
								while ($filaPropietarios =  $listaPropietarios->fetch_array(MYSQLI_ASSOC)) {?>
							<tr>
								<td><?php echo $filaPropietarios['ID']; ?></td>
								<td><?php echo $filaPropietarios['Nombre']; ?></td>
								<td><?php echo $filaPropietarios['Numero']; ?></td>
								<td><?php echo $filaPropietarios['Correo']; ?></td>
								<td><?php echo $filaPropietarios['Telefono']; ?></td>
								<td><?php echo $filaPropietarios['Condominio'];}?></td>
							</tr>
						</tbody>
					</table>
					<br>
				<?php 
				} 
				else { 
					//Vamos a Realizar la Consulta
					$buscarPropietario = $conexion->query("SELECT * FROM propietarios WHERE Nombre = '$nombre' AND Condominio = '$condominio' AND Numero = '$inmueble' ");
					$arrayPropietario = $buscarPropietario->fetch_array(MYSQLI_ASSOC);

					foreach ($buscarPropietario as $fila) {

					?>
				<!-- VOY A CONSTRUIR UNA HOJA CON LOS DATOS DEL PROPIETARIO -->
				<div class="row">
					<div class="col"></div>
					<div class="col">
						<strong><i class="las la-user-alt"></i> Propietario:</strong> <?php echo $fila['Nombre'];?><br>
						<strong><i class="la la-home"></i> Inmueble Nº:</strong> <?php echo $fila['Numero']; ?><br>
						<strong><i class="las la-envelope"></i> Correo:</strong> <?php echo $fila['Correo']; ?><br>
						<strong><i class="las la-phone"></i> Teléfono:</strong> <?php echo $fila['Telefono']; ?><br>
						<strong><i class="la la-city"></i> Condominio:</strong> <?php echo $fila['Condominio'];} ?>
					</div>
					<div class="col"></div>
				</div>
					<?php
				} 
				?>
				<header id="header">
					<div class="row">
						<div class="col-2"></div>
						<div class="col">
							<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
						</div>
						<div class="col">
							<p style="text-align: center;"><a href="../propietarios.php"><img src="../img/trabajo-en-equipo.png" width="50px" height="70px"><br>Propietarios</a></p>
						</div>
						<div class="col"></div>
					</div>
				</header>
			</article>
			<article class="col"></article>
		</section>
	</div>
</body>
</html>