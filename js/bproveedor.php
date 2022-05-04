<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Buscar Proveedor</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
	<article class="container-fluid">
		<header id="header" class="">
			<h1><img src="../img/obrero.png" class="img-fluid" width="5%" height="10%"> MÓDULO 3: PROVEEDORES</h1>
		</header><!-- /header -->
<?php  
//Conexion a la base de datos
require_once '../conexion.php';

//Reciben la búsqueda
$buscar = $_POST['proveedor']; 
//Condominio
$condominio = $_POST['condominio'];
//$buscar = "Res. San Francisco";

if($buscar == 'todos') {
	$consulta = "SELECT * FROM proveedores WHERE Condominio LIKE '$condominio'";
	if ($resultado = $conexion->query($consulta)) {?> 
		<section class="row">
			<div class="col"></div>
			<div class="col-10">
				<table class='table table-striped'>
						<thead>
						 <tr>
						  <th scope='col'>Servicio</th>
						  <th scope='col'>Responsable</th>
						  <th scope='col'>RIF</th>
						  <th scope='col'>Correo</th>
						  <th scope='col'>Teléfono</th>
						</tr>
					</thead>
				 <tbody>
				 	<?php 
							while($row = $resultado->fetch_array(MYSQLI_ASSOC)) {?>
						<tr style="border-bottom: solid 1px black;">
							<td><?php echo $row['Servicio']; ?></td>
							<td><?php echo $row['Responsable']; ?></td>
							<td><?php echo $row['RIF']; ?></td>
							<td><?php echo $row['Correo']; ?></td>
							<td><?php echo $row['Telefono'];}?></td>
						</tr>
					</tbody>
				</table>
							<?php  
							} 
							/* liberar el conjunto de resultados */
    					$resultado->close();

						}
else {
	$consulta = "SELECT * FROM proveedores WHERE Servicio LIKE '$buscar' AND Condominio LIKE '$condominio'";
	if ($resultado = $conexion->query($consulta)) {?> 
		<section class="row">
			<div class="col"></div>
			<div class="col-10">
				<table class='table table-striped'>
						<thead>
						 <tr>
						  <th scope='col'>Servicio</th>
						  <th scope='col'>Responsable</th>
						  <th scope='col'>RIF</th>
						  <th scope='col'>Correo</th>
						  <th scope='col'>Teléfono</th>
						</tr>
					</thead>
				 <tbody>
				 	<?php 
							while($row = $resultado->fetch_array(MYSQLI_ASSOC)) {?>
						<tr style="border-bottom: solid 1px black;">
							<td><?php echo $row['Servicio']; ?></td>
							<td><?php echo $row['Responsable']; ?></td>
							<td><?php echo $row['RIF']; ?></td>
							<td><?php echo $row['Correo']; ?></td>
							<td><?php echo $row['Telefono'];}?></td>
						</tr>
					</tbody>
				</table>
							<?php  
							} 
							/* liberar el conjunto de resultados */
    					$resultado->close();
}
						/* cerrar la conexión */
						$conexion->close();
						?>	
		</div>
			<div class="col"></div>
		</section>
	     
	<header class="container-fluid">
				<div class="row">
					<div class="col-3"></div>
					<div class="col">
						<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
					</div>
					<div class="col">
						<p style="text-align: center;"><a href="../proveedores.php"><img src="../img/obrero.png" width="55px" height="70px"><br>Proveedores</a></p>
					</div>
					<div class="col-3"></div>
				</div>
	</header><!-- /header -->
</article>
</body>
</html>