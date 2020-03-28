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
	<title>Módulo 7</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/line-awesome.min.css">
</head>
<body>
	<div class="container-fluid">
		<h1><img src="../img/caja-registradora.png" class="img-fluid" width="10%" height="10%"> MÓDULO 7: CUENTAS POR COBRAR</h1><br>
		<section class="row">
			<article class="col"></article>
			<article class="col-8">
				<h2>ESTADO DE CUENTA</h2>
				<?php
				//Recibimos los datos
				//Número de Inmueble
				$inmueble = $_POST['inmueble'];
				//var_dump($inmueble);
				//Condominio
				$condominio = $_POST['condominio'];
				//Mes
				$mes = $_POST['mes'];
				//Año
				$year = $_POST['year'];

				if($inmueble == 'todos') {
					$nombre = 'todos';
				}
				else {
					//Primero busco el nombre y lo guardo
					$bnombre = $conexion->query("SELECT * from propietarios WHERE Numero = '$inmueble'");
					$arrayN = $bnombre->fetch_array(MYSQLI_ASSOC);
					foreach ($bnombre as $fila) {
						$nombre = $fila['Nombre'];
					} 
				}
				?>
				
				<p><b><i class="las la-user-alt"></i> Propietario:</b> <?php echo strtoupper($nombre); ?></p>
				<p><b><i class="la la-home"></i> Inmueble Nº:</b> <?php echo $inmueble; ?></p>
				<?php

			//Revisar que mes y año estén vacíos
			if(empty($mes AND $year)) {
				//Ahora Vamos a Buscar en San Francisco
				if($condominio == 'Res. San Francisco') {
					//Vamos a chequear si seleccionó a todos
					if($nombre == 'todos')
					{
						//Vamos a extraer el Valor Total de la Deuda para colocar el Sub-Total
						$sumaDeudaTotal = "SELECT SUM(Dolar) AS sumatoria FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio'";
						$sumatoriaDeudaTotal = $conexion->query($sumaDeudaTotal);
						$filaSumatoria =  $sumatoriaDeudaTotal->fetch_array(MYSQLI_ASSOC);
						//Guardamos el valor en una variable
						$sumatoria = $filaSumatoria['sumatoria'];
						
						//Consultamos lo Adeudado
						$consultaDeudaTotal = "SELECT * FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio' ORDER BY Inmueble ASC";
						$resultadoDeudaTotal = $conexion->query($consultaDeudaTotal);
						$filaDeudaTotal =  $resultadoDeudaTotal->fetch_array(MYSQLI_ASSOC);

						//Ahora Vamos a construir una tabla con éstos valores
						//Va a contener #Inmueble, Nombre, Descripción, Monto?>
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>NOMBRE</th>
						      <th scope='col'>DESCRIPCION</th>
						      <th scope='col'>MONTO $</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoDeudaTotal as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php echo $value['Descripcion']; ?></td>
									<td><?php echo number_format($value['Dolar'], 2,',','.');} ?></td>	
								</tr>
							</tbody>
						</table>
						<br>
						<h2>Total de Cuentas por Cobrar: $ <?php echo number_format($sumatoria, 2, ',','.'); ?></h2>
					<?php }
					//Si selecciono a un propietario
					else {
					//Consultamos lo Pendiente
					$consultaep = "SELECT SUM(Dolar) as totalp FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Estado = 'ADEUDADO'";
					$resultadoep = $conexion->query($consultaep);
					/* array asociativo */
					$row = $resultadoep->fetch_array(MYSQLI_ASSOC);
					$totalp = $row['totalp'];

					echo '<h4><b><i class="las la-cash-register"></i> Total Adeudado: $'. number_format($totalp, 2, ',', '.').'</b></h4><br>';

					echo "<h3 style='text-align: center;'>Historial</h3>";

					$consultah = "SELECT * FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' ORDER BY Emision ASC";

					$resultadoh = $conexion->query($consultah);?>

					<table class='table table-striped'>
					  <thead>
					    <tr>
					      <th scope='col'>DESCRIPCIÓN</th>
					      <th scope='col'>MONTO $</th>
					      <th scope='col'>ESTADO</th>
					    </tr>
					  </thead>
					  <tbody>
							<?php
								foreach ($resultadoh as $value) {?>
								<tr>
								  <th scope='row'><?php echo $value['Descripcion'];?></th>
								  <td><?php echo number_format($value['Dolar'], 2, ',', '.');?></td>
								  <td><?php echo $value['Estado'];}?></td>
								</tr>
						</tbody>
					</table>
								<?php
								} 
				}
				//Cierre de la Llave San Francisco
				//Cambio a elseif para Bucare
				elseif($condominio = 'Edificio Bucare') {
					//Igual anterior, si selecciono todo
					if($nombre == 'todos') {
						//Vamos a extraer el Valor Total de la Deuda para colocar el Sub-Total
					$sumaDeudaTotal = "SELECT SUM(Monto) AS sumatoria FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio'";
					$sumatoriaDeudaTotal = $conexion->query($sumaDeudaTotal);
					$filaSumatoria =  $sumatoriaDeudaTotal->fetch_array(MYSQLI_ASSOC);
					//Guardamos el valor en una variable
					$sumatoria = $filaSumatoria['sumatoria'];
					
					//Consultamos lo Adeudado
					$consultaDeudaTotal = "SELECT * FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio' ORDER BY Inmueble ASC";
					$resultadoDeudaTotal = $conexion->query($consultaDeudaTotal);
					$filaDeudaTotal =  $resultadoDeudaTotal->fetch_array(MYSQLI_ASSOC);

					//Ahora Vamos a construir una tabla con éstos valores
					//Va a contener #Inmueble, Nombre, Descripción, Monto?>
					<table class='table table-striped'>
					  <thead>
					    <tr>
					      <th scope='col'>#</th>
					      <th scope='col'>NOMBRE</th>
					      <th scope='col'>DESCRIPCION</th>
					      <th scope='col'>MONTO Bs.</th>
					    </tr>
					  </thead>
					  <tbody>
							<?php
								foreach ($resultadoDeudaTotal as $value) {?>
							<tr>
								<th scope="row"><?php echo $value['Inmueble']; ?></th>
								<td><?php echo $value['Nombre']; ?></td>
								<td><?php echo $value['Descripcion']; ?></td>
								<td><?php echo number_format($value['Monto'], 2,',','.');} ?></td>	
							</tr>
						</tbody>
					</table>
					<br>
					<h2>Total de Cuentas por Cobrar: Bs. <?php echo number_format($sumatoria, 2, ',','.'); ?></h2>
				<?php } 
					//Si se selecciono 1 propietario en particular
					else {

						//Consultamos lo Pendiente
						$consultaep = "SELECT SUM(Monto) as totalp FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Estado = 'ADEUDADO'";
						$resultadoep = $conexion->query($consultaep);
						/* array asociativo */
						$row = $resultadoep->fetch_array(MYSQLI_ASSOC);
						$totalp = $row['totalp'];

						echo '<h4><b><i class="las la-cash-register"></i> Total Adeudado: Bs. '. number_format($totalp, 2, ',', '.').'</b></h4><br>';

						echo "<h3 style='text-align: center;'>Historial</h3>";

						$consultah = "SELECT * FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble'ORDER BY Emision ASC";

						$resultadoh = $conexion->query($consultah);?>

						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>DESCRIPCIÓN</th>
						      <th scope='col'>MONTO Bs.</th>
						      <th scope='col'>ESTADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoh as $value) {?>
									<tr>
									  <th scope='row'><?php echo $value['Descripcion'];?></th>
									  <td>Bs. <?php echo number_format($value['Monto'], 2, ',', '.');?></td>
									  <td><?php echo $value['Estado'];}?></td>
									</tr>
							</tbody>
						</table>
					<?php } 
					//Cierre del else 1 propietario
				}
			//Cierre del elseif Bucare
			}
			//Cierre del if si está vacío año y mes
			//Inicio de la consultar por mes y año
			else {
				//Vamos a Realizar una consulta de toda la Deuda
				//Para ello la condicionamos
			if($condominio == 'Res. San Francisco') {
				if($nombre == 'todos')
				{
					//Vamos a extraer el Valor Total de la Deuda para colocar el Sub-Total
					$sumaDeudaTotal = "SELECT SUM(Dolar) AS sumatoria FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'";
					$sumatoriaDeudaTotal = $conexion->query($sumaDeudaTotal);
					$filaSumatoria =  $sumatoriaDeudaTotal->fetch_array(MYSQLI_ASSOC);
					//Guardamos el valor en una variable
					$sumatoria = $filaSumatoria['sumatoria'];
					
					//Consultamos lo Adeudado
					$consultaDeudaTotal = "SELECT * FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio'  AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' ORDER BY Inmueble ASC";
					$resultadoDeudaTotal = $conexion->query($consultaDeudaTotal);
					$filaDeudaTotal =  $resultadoDeudaTotal->fetch_array(MYSQLI_ASSOC);

					//Ahora Vamos a construir una tabla con éstos valores
					//Va a contener #Inmueble, Nombre, Descripción, Monto?>
					<table class='table table-striped'>
					  <thead>
					    <tr>
					      <th scope='col'>#</th>
					      <th scope='col'>NOMBRE</th>
					      <th scope='col'>DESCRIPCION</th>
					      <th scope='col'>MONTO $</th>
					    </tr>
					  </thead>
					  <tbody>
							<?php
								foreach ($resultadoDeudaTotal as $value) {?>
							<tr>
								<th scope="row"><?php echo $value['Inmueble']; ?></th>
								<td><?php echo $value['Nombre']; ?></td>
								<td><?php echo $value['Descripcion']; ?></td>
								<td><?php echo number_format($value['Dolar'], 2,',','.');} ?></td>	
							</tr>
						</tbody>
					</table>
					<br>
					<h2>Total de Cuentas por Cobrar: $ <?php echo number_format($sumatoria, 2, ',','.'); ?></h2>
				<?php }
				else {
				//Consultamos lo Pendiente
				$consultaep = "SELECT SUM(Dolar) as totalp FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Estado = 'ADEUDADO' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'";
				$resultadoep = $conexion->query($consultaep);
				/* array asociativo */
				$row = $resultadoep->fetch_array(MYSQLI_ASSOC);
				$totalp = $row['totalp'];

				echo '<h4><b><i class="las la-cash-register"></i> Total Adeudado: $'. number_format($totalp, 2, ',', '.').'</b></h4><br>';

				echo "<h3 style='text-align: center;'>Historial</h3>";

				$consultah = "SELECT * FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble'  AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' ORDER BY Emision ASC";

				$resultadoh = $conexion->query($consultah);?>

				<table class='table table-striped'>
				  <thead>
				    <tr>
				      <th scope='col'>DESCRIPCIÓN</th>
				      <th scope='col'>MONTO $</th>
				      <th scope='col'>ESTADO</th>
				    </tr>
				  </thead>
				  <tbody>
						<?php
							foreach ($resultadoh as $value) {?>
							<tr>
							  <th scope='row'><?php echo $value['Descripcion'];?></th>
							  <td><?php echo number_format($value['Dolar'], 2, ',', '.');?></td>
							  <td><?php echo $value['Estado'];}?></td>
							</tr>
					</tbody>
				</table>
							<?php
							} 
				}
				else {
					if($nombre == 'todos') {
						//Vamos a extraer el Valor Total de la Deuda para colocar el Sub-Total
					$sumaDeudaTotal = "SELECT SUM(Monto) AS sumatoria FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'";
					$sumatoriaDeudaTotal = $conexion->query($sumaDeudaTotal);
					$filaSumatoria =  $sumatoriaDeudaTotal->fetch_array(MYSQLI_ASSOC);
					//Guardamos el valor en una variable
					$sumatoria = $filaSumatoria['sumatoria'];
					
					//Consultamos lo Adeudado
					$consultaDeudaTotal = "SELECT * FROM cxc WHERE Estado = 'ADEUDADO' AND Condominio = '$condominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' ORDER BY Inmueble ASC";
					$resultadoDeudaTotal = $conexion->query($consultaDeudaTotal);
					$filaDeudaTotal =  $resultadoDeudaTotal->fetch_array(MYSQLI_ASSOC);

					//Ahora Vamos a construir una tabla con éstos valores
					//Va a contener #Inmueble, Nombre, Descripción, Monto?>
					<table class='table table-striped'>
					  <thead>
					    <tr>
					      <th scope='col'>#</th>
					      <th scope='col'>NOMBRE</th>
					      <th scope='col'>DESCRIPCION</th>
					      <th scope='col'>MONTO Bs.</th>
					    </tr>
					  </thead>
					  <tbody>
							<?php
								foreach ($resultadoDeudaTotal as $value) {?>
							<tr>
								<th scope="row"><?php echo $value['Inmueble']; ?></th>
								<td><?php echo $value['Nombre']; ?></td>
								<td><?php echo $value['Descripcion']; ?></td>
								<td><?php echo number_format($value['Monto'], 2,',','.');} ?></td>	
							</tr>
						</tbody>
					</table>
					<br>
					<h2>Total de Cuentas por Cobrar: Bs. <?php echo number_format($sumatoria, 2, ',','.'); ?></h2>
				<?php } 

					else {

						//Consultamos lo Pendiente
						$consultaep = "SELECT SUM(Monto) as totalp FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Estado = 'ADEUDADO' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'";
						$resultadoep = $conexion->query($consultaep);
						/* array asociativo */
						$row = $resultadoep->fetch_array(MYSQLI_ASSOC);
						$totalp = $row['totalp'];

						echo '<h4><b><i class="las la-cash-register"></i> Total Adeudado: Bs. '. number_format($totalp, 2, ',', '.').'</b></h4><br>';

						echo "<h3 style='text-align: center;'>Historial</h3>";

						$consultah = "SELECT * FROM cxc WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' ORDER BY Emision ASC";

						$resultadoh = $conexion->query($consultah);?>

						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>DESCRIPCIÓN</th>
						      <th scope='col'>MONTO Bs.</th>
						      <th scope='col'>ESTADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoh as $value) {?>
									<tr>
									  <th scope='row'><?php echo $value['Descripcion'];?></th>
									  <td>Bs. <?php echo number_format($value['Monto'], 2, ',', '.');?></td>
									  <td><?php echo $value['Estado'];}?></td>
									</tr>
							</tbody>
						</table>
					<?php } } }

				?>
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
			</article>
			<article class="col"></article>
		</section>
	</div>
</body>
</html>