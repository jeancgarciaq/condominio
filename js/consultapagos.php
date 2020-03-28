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
	<title>Módulo 5</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/line-awesome.min.css">
</head>
<body>
	<div class="container-fluid">
		<h1><img src="../img/caja.png" class="img-fluid" width="10%" height="10%"> MÓDULO 5: PAGOS</h1><br>
		<section class="row">
			<article class="col-2"></article>
			<article class="col-8">
				<h2>ESTADO DE CUENTA</h2>
				<?php
				//Recibimos los datos
				//Nombre del propietario
				$nombre = $_POST['nombre'];
				//var_dump($nombre);
				//Número de Inmueble
				$inmueble = $_POST['inmueble'];
				//var_dump($inmueble);
				//Condominio
				$condominio = $_POST['condominio'];
				//Mes
				$mes = $_POST['mes'];
				//Año
				$year = $_POST['year'];
				?>
				<p><b><i class="las la-user-alt"></i> Propietario:</b> <?php echo strtoupper($nombre); ?></p>
				<p><b><i class="la la-home"></i> Inmueble Nº:</b> <?php echo $inmueble; ?></p>
				<?php

				//Si es San Francisco
				if($condominio == 'Res. San Francisco') {
					//Vamos a Realizar una consulta de toda la Deuda
					//Para ello la condicionamos
					if($nombre == 'todos')
					{
						//Vamos a extraer los pagos Conciliados
						$sumaPagoTotal = "SELECT SUM(Dolar) AS conciliado FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'SI' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
						$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
						$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
						//Guardamos el valor en una variable
						$sumatoria = $filaSumatoria['conciliado'];

						//Vamos a extraer los pagos No Conciliados
						$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'NO' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
						$sumatoriaPagoS = $conexion->query($sumaPagoS);
						$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
						//Guardamos el valor en una variable
						$sumatoriaS = $filaSumatoriaS['sinconciliar'];
						
						//Sumatoria Total de Pagos Recibidos
						$sumatoriaTotal = $sumatoria + $sumatoriaS;

						//Consultamos lo Pagado
						$consultaPagoTotal = "SELECT * FROM pagos WHERE Condominio = '$condominio'  AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' ORDER BY Fecha ASC";
						$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
						$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);

						//Ahora Vamos a construir una tabla con éstos valores
						//Va a contener #Inmueble, Nombre, Descripción, Monto?>
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>NOMBRE</th>
						      <th scope='col'>MONTO $</th>
						      <th scope='col'>REFERENCIA</th>
						      <th scope='col'>FECHA</th>
						      <th scope='col'>CONCILIADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoPagoTotal as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php echo number_format($value['Dolar'], 2,',','.'); ?></td>
									<td><?php echo $value['Referencia1'];?></td>	
									<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham)); ?></td>
									<td style="text-align: center"><?php echo $value['Conciliado'];} ?></td>
								</tr>
							</tbody>
						</table>
						<br>
						<div class='row'>
							<div class="col-10">
							<p><b>Total Pagos Sin Conciliar:</b> $<?php echo number_format($sumatoriaS, 2,',','.');?><br>
							<b>Total Pagos Conciliado:</b> $<?php echo number_format($sumatoria, 2,',','.');?><br>
							<span style="font-size: 24px;"><strong>Total de Pagos Recibidos:</strong> $<?php echo number_format($sumatoriaTotal, 2,',','.'); ?></span></p></div>
						</div>
					<?php }
					else {

								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotal = "SELECT SUM(Dolar) AS conciliado FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'SI' AND Nombre = '$nombre' AND Inmueble = '$inmueble' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
								$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
								$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoria = $filaSumatoria['conciliado'];

								//Vamos a extraer los pagos No Conciliados
								$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'NO' AND Nombre = '$nombre' AND Inmueble = '$inmueble' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
								$sumatoriaPagoS = $conexion->query($sumaPagoS);
								$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoriaS = $filaSumatoriaS['sinconciliar'];
								
								$sumatoriaTotal = $sumatoria + $sumatoriaS;
								//Realiza la búsqueda de los pagos
								$consultaPp = "SELECT * FROM pagos WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Condominio = '$condominio' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
								$resultadoPp = $conexion->query($consultaPp);
								//Convierto en un array
								$filaPp = $resultadoPp->fetch_array(MYSQLI_ASSOC);
						?>
						<!-- Ahora construyo una tabla para mostrar el Array -->
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>NOMBRE</th>
						      <th scope='col'>MONTO $</th>
						      <th scope='col'>REFERENCIA</th>
						      <th scope='col'>FECHA</th>
						      <th scope='col'>CONCILIADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoPp as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php echo number_format($value['Dolar'], 2,',','.');?></td>
									<td><?php echo $value['Referencia1'];?></td>	
									<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham));?></td>
									<td><?php echo $value['Conciliado'];}?></td>
								</tr>
							</tbody>
						</table>
						<br>
						<div class='row'>
							<div class="col-10">
							<p><b>Total Pagos Sin Conciliar:</b> $<?php echo number_format($sumatoriaS, 2,',','.');?><br>
							<b>Total Pagos Conciliado:</b> $<?php echo number_format($sumatoria, 2,',','.');?><br>
							<span style="font-size: 24px;"><strong>Total de Pagos Recibidos:</strong> $<?php echo number_format($sumatoriaTotal, 2,',','.');} 
					}
					else {

						//Vamos a Realizar una consulta de toda la Deuda
					//Para ello la condicionamos
					if($nombre == 'todos')
					{
						//Vamos a extraer los pagos Conciliados
						$sumaPagoTotal = "SELECT SUM(Monto) AS conciliado FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'SI' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
						$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
						$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
						//Guardamos el valor en una variable
						$sumatoria = $filaSumatoria['conciliado'];

						//Vamos a extraer los pagos No Conciliados
						$sumaPagoS = "SELECT SUM(Monto) AS sinconciliar FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'NO' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
						$sumatoriaPagoS = $conexion->query($sumaPagoS);
						$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
						//Guardamos el valor en una variable
						$sumatoriaS = $filaSumatoriaS['sinconciliar'];
						
						//Sumatoria Total de Pagos Recibidos
						$sumatoriaTotal = $sumatoria + $sumatoriaS;

						//Consultamos lo Pagado
						$consultaPagoTotal = "SELECT * FROM pagos WHERE Condominio = '$condominio'  AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' ORDER BY Fecha ASC";
						$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
						$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);

						//Ahora Vamos a construir una tabla con éstos valores
						//Va a contener #Inmueble, Nombre, Descripción, Monto?>
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>NOMBRE</th>
						      <th scope='col'>MONTO Bs.</th>
						      <th scope='col'>REFERENCIA</th>
						      <th scope='col'>FECHA</th>
						      <th scope='col'>CONCILIADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoPagoTotal as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php echo number_format($value['Monto'], 2,',','.'); ?></td>
									<td><?php echo $value['Referencia1'];?></td>	
									<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham)); ?></td>
									<td style="text-align: center"><?php echo $value['Conciliado'];} ?></td>
								</tr>
							</tbody>
						</table>
						<br>
						<div class='row'>
							<div class="col-10">
							<p><b>Total Pagos Sin Conciliar:</b> Bs. <?php echo number_format($sumatoriaS, 2,',','.');?><br>
							<b>Total Pagos Conciliado:</b> Bs. <?php echo number_format($sumatoria, 2,',','.');?><br>
							<span style="font-size: 24px;"><strong>Total de Pagos Recibidos:</strong> Bs. <?php echo number_format($sumatoriaTotal, 2,',','.'); ?></span></p></div>
						</div>
					<?php }
					else {

								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotal = "SELECT SUM(Monto) AS conciliado FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'SI' AND Nombre = '$nombre' AND Inmueble = '$inmueble' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
								$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
								$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoria = $filaSumatoria['conciliado'];

								//Vamos a extraer los pagos No Conciliados
								$sumaPagoS = "SELECT SUM(Monto) AS sinconciliar FROM pagos WHERE Condominio = '$condominio' AND Conciliado = 'NO' AND Nombre = '$nombre' AND Inmueble = '$inmueble' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
								$sumatoriaPagoS = $conexion->query($sumaPagoS);
								$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoriaS = $filaSumatoriaS['sinconciliar'];
								
								$sumatoriaTotal = $sumatoria + $sumatoriaS;
								//Realiza la búsqueda de los pagos
								$consultaPp = "SELECT * FROM pagos WHERE Nombre = '$nombre' AND Inmueble = '$inmueble' AND Condominio = '$condominio' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
								$resultadoPp = $conexion->query($consultaPp);
								//Convierto en un array
								$filaPp = $resultadoPp->fetch_array(MYSQLI_ASSOC);
						?>
						<!-- Ahora construyo una tabla para mostrar el Array -->
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>NOMBRE</th>
						      <th scope='col'>MONTO Bs.</th>
						      <th scope='col'>REFERENCIA</th>
						      <th scope='col'>FECHA</th>
						      <th scope='col'>CONCILIADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoPp as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php echo number_format($value['Monto'], 2,',','.');?></td>
									<td><?php echo $value['Referencia1'];?></td>	
									<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham));?></td>
									<td><?php echo $value['Conciliado'];}?></td>
								</tr>
							</tbody>
						</table>
						<br>
						<div class='row'>
							<div class="col-10">
							<p><b>Total Pagos Sin Conciliar:</b> $<?php echo number_format($sumatoriaS, 2,',','.');?><br>
							<b>Total Pagos Conciliado:</b> $<?php echo number_format($sumatoria, 2,',','.');?><br>
							<span style="font-size: 24px;"><strong>Total de Pagos Recibidos:</strong> $<?php echo number_format($sumatoriaTotal, 2,',','.');}
					}
							/* cerrar la conexión */
							$conexion->close();?>
						</span></p></div>
					</div>
				<footer>
					<div class="row">
						<div class="col-2"></div>
						<div class="col">
							<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.jpg"><br>Inicio</a></p>
						</div>
						<div class="col">
							<p style="text-align: center;"><a href="../pagos.php"><img src="../img/caja.png" width="50px" height="70px"><br>Pagos</a></p>
						</div>
						<div class="col-2"></div>
					</div>
				</footer>
			</article>
			<article class="col-2"></article>
		</section>
	</div>
</body>
</html>