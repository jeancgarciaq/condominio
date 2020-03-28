<?php 
include ('../conexion.php');

//Se reciben los datos
$inmueble = $_POST['inmueble'];
$condominio = $_POST['condominio'];

//Buscar el Nombre
if($inmueble == 'todos') {
	$nombre = 'todos';
}
else {

	$bnombre = $conexion->query("SELECT * FROM propietarios WHERE Numero = '$inmueble'");
	$arrayNombre = $bnombre->fetch_array(MYSQLI_ASSOC);
	foreach ($bnombre as $valor) {
		$nombre = $valor['Nombre'];
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Reporte</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css" media="screen">
	<link rel="stylesheet" href="../css/" media="screen">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<?php if($nombre == 'todos') {

					$reporte = "SELECT * FROM reporte_cxc WHERE Condominio = '$condominio' ORDER BY Nm ASC";
					$ejecutarR = $conexion->query($reporte);
					$arrayR = $ejecutarR->fetch_array(MYSQLI_ASSOC);


					?>
					<h3 style="text-align: center;">Condominio <?php echo $condominio; ?></h3><br>
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>Propietario</th>
						      <th scope='col'>Anterior</th>
						      <th scope='col'>Enero</th>
						      <th scope='col'>Febrero</th>
						      <th scope='col'>Marzo</th>
						      <th scope='col'>Abril</th>
						      <th scope='col'>Mayo</th>
						      <th scope='col'>Junio</th>
						      <th scope='col'>Julio</th>
						      <th scope='col'>Agosto</th>
						      <th scope='col'>Septiembre</th>
						      <th scope='col'>Octubre</th>
						      <th scope='col'>Noviembre</th>
						      <th scope='col'>Diciembre</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($ejecutarR as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Nm']; ?></th>
									<td><?php echo $value['Propietario']; ?></td>
									<td><?php echo number_format($value['Anterior'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Enero'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Febrero'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Marzo'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Abril'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Mayo'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Junio'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Julio'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Agosto'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Septiembre'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Octubre'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Noviembre'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Diciembre'], 2,',','.');} ?></td>	
								</tr>
							</tbody>
						</table>
				<?php }
						else {
								$reporte = "SELECT * FROM reporte_cxc WHERE Propietario = '$nombre' AND Condominio = '$condominio'";
								$ejecutarR = $conexion->query($reporte);
								$arrayR = $ejecutarR->fetch_array(MYSQLI_ASSOC);

							?>
							<h3 style="text-align: center;">Condominio <?php echo $condominio; ?></h3><br>
							<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>Propietario</th>
						      <th scope='col'>Anterior</th>
						      <th scope='col'>Enero</th>
						      <th scope='col'>Febrero</th>
						      <th scope='col'>Marzo</th>
						      <th scope='col'>Abril</th>
						      <th scope='col'>Mayo</th>
						      <th scope='col'>Junio</th>
						      <th scope='col'>Julio</th>
						      <th scope='col'>Agosto</th>
						      <th scope='col'>Septiembre</th>
						      <th scope='col'>Octubre</th>
						      <th scope='col'>Noviembre</th>
						      <th scope='col'>Diciembre</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($ejecutarR as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Nm']; ?></th>
									<td><?php echo $value['Propietario']; ?></td>
									<td><?php echo number_format($value['Anterior'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Enero'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Febrero'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Marzo'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Abril'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Mayo'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Junio'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Julio'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Agosto'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Septiembre'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Octubre'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Noviembre'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Diciembre'], 2,',','.');} ?></td>
								</tr>
							</tbody>
						</table>
						<br>
						<?php  }
									if($condominio == 'Edificio Bucare') {
													//Vamos a extraer el Valor Total de la Deuda para colocar el Sub-Total
													$sumaDeudaTotal = "SELECT SUM(Monto) AS sumatoria FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio'";
													$sumatoriaDeudaTotal = $conexion->query($sumaDeudaTotal);
													$filaSumatoria =  $sumatoriaDeudaTotal->fetch_array(MYSQLI_ASSOC);
													//Guardamos el valor en una variable
													$sumatoria = $filaSumatoria['sumatoria'];}
										else {
											//Vamos a extraer el Valor Total de la Deuda para colocar el Sub-Total
													$sumaDeudaTotal = "SELECT SUM(Dolar) AS sumatoria FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio'";
													$sumatoriaDeudaTotal = $conexion->query($sumaDeudaTotal);
													$filaSumatoria =  $sumatoriaDeudaTotal->fetch_array(MYSQLI_ASSOC);
													//Guardamos el valor en una variable
													$sumatoria = $filaSumatoria['sumatoria'];}
						?>
						<h4>Total de Cuentas por Cobrar: <?php 
									if ($condominio == 'Edificio Bucare') {
														echo 'Bs. ' . number_format($sumatoria, 2, ',','.');}
									else {
														echo '$' . number_format($sumatoria, 2, ',','.');
									} ?></h4>
			</div>
		</div>
	</div>
	<header id="header">
					<div class="row">
						<div class="col-2"></div>
						<div class="col">
							<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
						</div>
						<div class="col">
							<p style="text-align: center;"><a href="../cxc.php"><img src="../img/caja-registradora.png" width="50px" height="70px"><br>Cuentas por Cobrar</a></p>
						</div>
						<div class="col"></div>
					</div>
				</header>
</body>
</html>