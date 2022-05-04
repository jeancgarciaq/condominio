<?php
ob_start();
require('../conexion.php');
//Clase Base de Datos
require_once '../class/ConexionBD.php';

//Datos iniciales para el Aviso de Cobro
$condominio = 1;
$mes = 9;
$year = 2021;

/* Se va a crear un Bucle que buscará los datos de los propietarios que coincidan con el id del condominio
* En el caso del Samán es del 131 al 194
* Para establecer el número de veces que se ejecutará el bucle, se va realizar una consulta que determina el número de propietarios 
* del condominio a consultar, tomando como valor el id
*/
//Consulta para determinar el número de propietarios y determinar el número de veces que se va a ejecutar el bucle
$contar = $conexion->query("SELECT COUNT(ID) as registro FROM propietarios WHERE idcondominio = '$condominio'");
$arrayContar = $contar->fetch_array(MYSQLI_ASSOC);
foreach($contar as $todos) {
  $enum = $todos['registro'];}
  $enum = 1;
//Vamos a extraer el primer ID del propietario que coincide con el ID del Condominio
$maximoId = $conexion->query("SELECT MAX(ID) as ID FROM propietarios WHERE idcondominio = '$condominio'");
$arrayMaximoId = $maximoId->fetch_array(MYSQLI_ASSOC);
foreach($maximoId as $maxId) {
  $idMax = $maxId['ID'];}

//Lo deducimos al restar el número de registro al máximo id
$ajustarId = $enum - 1;
//echo $ajustarId.'<br>';
$primerId = $idMax - $ajustarId;
$primerId = 68;
//Ahora vamos a usar un bucle for que nos permita ejecutar un código
for ($i = 1; $i <= $enum; $i++) {

	//Buscamos la información del Condominio
	$infoC = $conexion->query("SELECT * FROM condominios WHERE ID = '$condominio'");
	$arrayInfo = $infoC->fetch_array(MYSQLI_ASSOC);
	foreach($infoC as $valor) {
		$nombre = $valor['NombreC'];
		$rif = $valor['RIF'];
		$direccion = $valor['Direccion'];
		$ciudad = $valor['Ciudad'];
		$estado = $valor['Estado'];}
	//Fin información del condominio

	//Establezco la tasa de cambio
	//Primero se busca la tasa
	/*$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
	$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
	foreach($bId as $vid) {$id = $vid['id'];}
	$bTasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
	$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
	foreach ($bTasa as $vTasa) {
		$tasaC = $vTasa['Cierre']; 
	  $tasaA = $vTasa['Apertura'];}
	if($tasaC == 0) {$tasa = $tasaA;} else { $tasa = $tasaC;}*/

	//Tasa BCV
	$bcvId = $conexion->query("SELECT MAX(ID) AS id FROM tasabcv");
	$arrayIdBcv = $bcvId->fetch_array(MYSQLI_ASSOC);
	foreach ($bcvId as $valor) {$id = $valor['id'];}
	$bTasaBcv = $conexion->query("SELECT * FROM tasabcv WHERE ID = '$id'");
	$arrayTasaBcv = $bTasaBcv->fetch_array(MYSQLI_ASSOC);
	foreach ($bTasaBcv as $vtasa) {$tasa = $vtasa['tasa'];}
	//Fin de la Tasa

	//Buscar información del propietario
  $idpropietario = $primerId++;
	$bcondomino = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
	$arrayCondomino = $bcondomino->fetch_array(MYSQLI_ASSOC);
	foreach ($bcondomino as $condomino) {
		$inmueble = $condomino['Inmueble'];
		$nombrep = $condomino['Nombre'];
		$alicuota = $condomino['Alicuota'];
		$correo = $condomino['Correo'];}
	//Fin de extraer la información del propietario

	//Fecha de Hoy para el Aviso de Cobro
	//$fecha = date("d/m/Y", strtotime("2021-08-13"));
		$fecha = date("d/m/Y");
	;?>

	<!-- PAUSA PHP para inyectar el código html -->
	<!-- Inicio Encabezado del Documento HTML -->
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
		<style type="text/css" media="print">
		  /* Reglas CSS específicas para imprimir */
	    #menu, #pie {display: none !important;}
	    .saltoDePagina { display:block;
													page-break-before:always;}
			th, tr, td { font: 11px Arial}
			.titulo {font: 14px Arial;}
		</style>
	</head>
	<!-- Fin del Encabezado -->
<!-- Cuerpo del HTML -->
<body>
	<!-- Inicio de Section que centra todo el contenido -->
	<section class="container-fluid" id="contenedor">
		<!-- El Encabezado del Documento -->
		<header>
			
			<p class="titulo" style="text-align: center;">
				<!--CONDOMINIO <?php //echo strtoupper($nombre);?>-->
				<img src="../img/Logo Bucare.png" width="150px" height="150px"><br>
				RIF <?php echo $rif;?>
			</p>
			<p class="titulo" style="text-align: center;">
				<b><?php echo $direccion; ?></b><br>
				<b><?php echo $ciudad.', '.$estado; ?></b>
			</p>
		</header>
		<!-- Fin del Encabezado -->

		<!-- Título del Documento -->
			<hr style="border: solid 2px black;">
			<h2>Aviso de Cobro</h2>
		<!-- Fin del Título -->

		<!-- Inicio de las Tablas que contienen el Aviso de Cobro -->
		<article class="row">
			<div class="col-2"></div>	
			<div class="col">
				<!-- Tabla de Datos del Propietario -->
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th scope="col" class="text-center"><b>Propietario</b></th>
							<th scope="col" class="text-center"><b>Inmueble</b></th>
							<th scope="col" class="text-center"><b>Alicuota</b></th>
							<th scope="col" class="text-center"><b>Fecha</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center"><?php echo $nombrep; ?></td>
							<td class="text-center"><?php echo $inmueble; ?></td>
							<td class="text-center"><?php $alicuotar = $alicuota * 100;
																						$alicuotam = round($alicuotar,2);
																						echo $alicuotam.'%';?></td>
							<td class="text-center"><?php echo $fecha; ?></td>
						</tr>
					</tbody>
				</table>
				<!-- Fin de Tabla Propietario -->

				<!-- Tabla con contenido de los Items del Aviso de Cobro-->
				<table class="table table-striped table-primary" width="100%">
					<thead>
						<tr>
							<th scope="col" class="text-center"><b>DESCRIPCION</b></th>
							<th scope="col" class="text-center"><b>MONTO Bs.</b></th>
							<th scope="col" class="text-center"><b>CUOTA Bs.</b></th>
						</tr>
					</thead>
					<tbody>
					<!-- Pausa de la Tabla para inyección PHP -->
					<?php 
						//Buscar la sumatoria de los Gastos
						$bSgasto = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM gastos WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$condominio'");
						$arraySg = $bSgasto->fetch_array(MYSQLI_ASSOC);
						foreach ($bSgasto as $suma) {$totalgt = $suma['sumatoria'];}

						//Buscar la sumatoria de las Cuotas
						$bScuotas = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM cuotas WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$condominio'");
						$arraySc = $bScuotas->fetch_array(MYSQLI_ASSOC);
						foreach ($bScuotas as $sum) {$mtotal = $sum['sumatoria'];}

						//Buscar la información de las Cuotas
						$bCuotas = $conexion->query("SELECT * FROM cuotas WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio='$condominio'");
						$arrayGasto = $bCuotas->fetch_array(MYSQLI_ASSOC);
						foreach ($bCuotas as $monto) {
						//Continuación de la Tabla
						echo '<tr>';
							$descripcionC = $monto['Descripcion'];
							$montodc = $monto['Montobs'];
							echo '<td>'.$descripcionC.'</td>';
							echo '<td>'.number_format($montodc, 2, ',', '.').'</td>';
							$mcuota = $montodc/64;
							echo '<td>'.number_format($mcuota, 2,',','.').'</td>';}
						echo '</tr>';
							//Buscar la información de los Gastos
							$bGasto = $conexion->query("SELECT * FROM gastos WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$condominio'");
							$arrayGasto = $bGasto->fetch_array(MYSQLI_ASSOC);
							foreach ($bGasto as $gasto) {
								echo '<tr>';
									$descripcion = $gasto['Descripcion'];
									$montobsg = $gasto['Montobs'];
									echo '<td>'.$descripcion.'</td>';
									echo '<td>'.number_format($montobsg, 2, ',', '.').'</td>';
									$cuota = $alicuota * $montobsg;
									$cuotar = round($cuota,2);
									echo '<td>'.number_format($cuotar, 2,',','.').'</td></tr>';}

									//Hacemos una pausa para inyección HTML
					?>
							<tr>
								<th scope="col" class="text-right"><b>SUB-TOTAL</b></th>
								<th scope="col"><?php 
									$totalST = ($totalgt + $mtotal);
									$rtotalST = round($totalST,2); 
									echo number_format($rtotalST, 2, ',', '.')?></th>
								<th scope="col">
									<?php
									$talicST = ($alicuota * $totalgt);
									$tcuotaST = ($mtotal/64);
									$tCuotaST = ($talicST + $tcuotaST);
									$cuotaST = round($tCuotaST,2);
									echo number_format($cuotaST,2, ',','.');
									?>
								</th>
							</tr>
							<tr>
								<th scope="col" class="text-right"><b>FONDO RESERVA (10%)</b></th>
								<th scope="col"><?php 
											$totalFR = ($totalgt + $mtotal)*0.10;
											$rtotalFR = round($totalFR,2); 
											echo number_format($rtotalFR, 2, ',', '.')?></th>
								<th scope="col">
									<?php
									$talicF = ($alicuota * $totalgt);
									$cuotaiF = ($mtotal/64);
									$cuotatF = ($talicF + $cuotaiF)*0.10;
									$cuotaTF = round($cuotatF,2);
									echo number_format($cuotaTF,2, ',','.');
									?>
								</th>
							</tr>
							<tr>
								<th scope="col" class="text-right"><b>TOTAL</b></th>
								<th scope="col"><?php 
											$totalG = ($totalgt + $mtotal + $totalFR);
											$rtotalG = round($totalG,2); 
											echo number_format($rtotalG, 2, ',', '.')?></th>
								<th scope="col">
									<?php
									$talic = ($alicuota * $totalgt);
									$cuotai = ($mtotal/64);
									$cuotat = $talic + $cuotai + $cuotaTF;
									$cuotaT = round($cuotat,2);
									echo number_format($cuotaT,2, ',','.');
									?>
								</th>
							</tr>
					</tbody>
				</table>
			</div>
			<section class="col-2"></section>
		</article>
		<!-- Fin de la Tabla Datos del Aviso de Cobro -->
		<!-- Inicio de los Totales -->
		<article class="row">
			<section class="col-2"></section>
			<section class="col">
				<!-- Tabla para mostrar los totales -->
				<table class="table table-striped table-success">
					<thead>
							<tr>
								<th scope="col" class="text-center"><b>TASA DOLAR Bs.</b></th>
								<th scope="col" class="text-center"><b>MONTO $</b></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><?php echo number_format($tasa,2,',','.');?></td>
								<td class="text-center"><?php $totald = $tCuotaST/$tasa;//$totald = $cuotaT/$tasa;
																					$totaldr = round($totald,2);
																					echo number_format($totaldr,2, ',','.');
								?></td>
							</tr>
						</tbody>
				</table>
			</section>
			<section class="col-2"></section>
		</article>
		<!-- Fin de la Tabla Tasa -->
		<div class="saltoDePagina"></div>
		<!-- Inicio consulta de Deuda Propietario -->
		<article class="row">
			<section class="col-2"></section>
			<section class="col">
				<!-- Se va a crear una consulta de toda la deuda del Propietario en PHP -->
				<!--SALTO DE PÁGINA -->
				<!--<div class="saltoDePagina"></div>-->
				<?php 
					#BUSQUEDA PROPIETARIO TODA LA DEUDA
		      /*if($idpropietario !== 'todos') {
		      	$buscarDeuda = new ConectarBd();
		        if($resultado=$buscarDeuda->BuscarUnion("cxc","idpropietario = '$idpropietario' ORDER BY Emision ASC")) { //LIMIT 5,10*/ ?>
		        <!--<div class="saltoDePagina"></div>
		        <br><h3>HISTÓRICO</h3>
		        <table class='table table-striped'>
		          <thead>
		            <tr>
		              <th scope='col'>#</th>
		              <th scope='col'>NOMBRE</th>
		              <th scope='col'>DESCRIPCION</th>
		              <th scope='col'>MONTO $</th>
		            </tr>
		          </thead>
		          <tbody>-->
		          <?php /* foreach ($resultado AS $fila) {
		            	$montodolar = $fila['Dolar'];
		              $montobolivar = $montodolar * $tasa;
		              $montobr = round($montobolivar,2);
		              echo '<tr>';
			              echo '<td>'. $fila['Inmueble'].'</td>';
			              echo '<td>'. $fila['Nombre'].'</td>';
			              echo '<td>'. $fila['Descripcion'].'</td>';
			              echo '<td>'. number_format($montodolar,2,',','.').'</td>';}
		              echo '</tr>';
		            $totalDeuda = new ConectarBd();
		            if($resultadoSumaD = $totalDeuda->Sumatoria("cxc", "Dolar", "idpropietario = '$idpropietario'"))
		                {foreach ($resultadoSumaD as $sumausd) {$sumatoriaD = $sumausd['sumatoria'];}}
		            else {echo "Error, no se pudo obtener la sumatoria";}
		            if($resultadoSumaBs = $totalDeuda->Sumatoria("cxc", "Monto", "idpropietario = '$idpropietario'"))
		                {foreach ($resultadoSumaBs as $sumabs) {$sumatoriaBs = $sumabs['sumatoria'];}}
		            else {echo "Error, no se pudo obtener la sumatoria";}
		            
		            echo "</tbody>
		            </table>
		            <!-- Fin de la Tabla de Deuda Pendiente -->
		            <br>
		            <h2>Total a Pagar: $".number_format($sumatoriaD, 2,',','.')."</h2>";}
		        else {echo "<h4>No tiene saldos pendientes.</h4>";}
		     }*/

				?>
			<!--</section>
			<section class="col-2"></section>			
		</article>-->
		<!-- Fin Consulta Deuda Propietario -->
	</section>
	<!-- Fin de Section que centra todo el contenido -->
	<!-- SALTO DE PÁGINA -->
	<!--<div class="saltoDePagina"></div>-->
</body>
<?php 
/*$monto = $cuotaT;
$montod = $totaldr;
$descripcion = "Condominio Septiembre 2021";
$fecha = date("Y-m-d");
$estado = "ADEUDADO";*/

//SE VA AÑADIR LA DEUDA A CXC
/*if($condominio == 1 OR $condominio == 2 OR $condominio == 3 OR $condominio == 4) { 

	//Vamos a ingresar la consulta a la Base de Datos
  $consulta = $conexion->query("INSERT INTO cxc (ID, idpropietario, Descripcion, Monto, Dolar, Emision, Estado) VALUES (NULL, '$idpropietario', '$descripcion', '$monto', '$montod', '$fecha', '$estado')");

  ## BUSCAR SI TIENE SALDO A FAVOR Y AJUSTARLO
  //Realizar la consulta en cuentas por cobrar
  $saldoFavor = "SELECT Monto,Dolar FROM cxc WHERE idpropietario = '$idpropietario' AND Monto < 0";
  //Ejecutar la consulta
  $consultaSaldoFavor = $conexion->query($saldoFavor);
  //Ahora vamos a convertir en Array
  $arraySaldoFavor = $consultaSaldoFavor->fetch_array(MYSQLI_ASSOC);
  //Verifico que el Array no esté vacío
  if(empty($arraySaldoFavor)) {
      $nosaldo = 'No hay Saldo a Favor';
    }
  else {
    //Voy a extraer el Saldo a Favor con un foreach
    foreach ($consultaSaldoFavor as $valor) {   
      		$saldo = $valor['Monto'];
      		$saldod = $valor['Dolar'];
  		} 

		  //Realizar la búsqueda de la Deuda
		  $deuda = "SELECT Monto,Dolar FROM cxc WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
		  //ejecutar la consulta
		  $consultaDeuda = $conexion->query($deuda);
		  //Lo convertimos en array
		  $arrayDeuda = $consultaDeuda->fetch_array(MYSQLI_ASSOC);
		  //Voy a extraer el Saldo a Favor con un foreach
		  foreach ($consultaDeuda as $valor) {
		      $montoDeuda = $valor['Monto'];
		      $montoDolar = $valor['Dolar'];
		  }
		  //Se calcula la diferencia
		  $diferencia = $montoDeuda + $saldo;
		  $diferenciad = $montoDolar + $saldod;
		  //Ahora Voy Actualizar el Saldo A Favor
		  $modificarSaldo = "UPDATE cxc SET Monto = 0, Dolar = 0 WHERE idpropietario = '$idpropietario' AND Monto < 0";
		  //Ejecutar
		  $consultaModificaSaldo = $conexion->query($modificarSaldo);

		  //Buscar Máximo ID Deuda
		  $bMid = $conexion->query("SELECT MAX(ID) as idP FROM cxc WHERE idpropietario = '$idpropietario'");
		  $arrayMid = $bMid->fetch_array(MYSQLI_ASSOC);
		  foreach ($bMid as $mid) {
		  	$idP = $mid['idP'];
		    //var_dump($idP);
		  }

		  //Ahora Voy Actualizar el Saldo Deudor
		  $modificarDeuda = "UPDATE cxc SET Monto = '$diferencia', Dolar = '$diferenciad' WHERE idpropietario = '$idpropietario' AND ID = '$idP'";
		  //Ejecutar
		  $consultaModificaDeuda = $conexion->query($modificarDeuda);
		  $nosaldo = 'Ya se descontó el Saldo a Favor';}
		  ## FIN SI TIENE SALDO A FAVOR Y AJUSTARLO*/			
	/*}*/
	

}//Fin Bucle For 