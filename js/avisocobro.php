<?php
require('../conexion.php');
//Clase Base de Datos
require_once '../class/ConexionBD.php';
//SE RECIBEN LOS DATOS DEL FORMULARIO
$idcondominio = $_POST['condominio'];
//var_dump($idcondominio);
$idpropietario = $_POST['inmueble'];
//var_dump($idpropietario);
$mes = $_POST['mes'];
//var_dump($mes);
$year = $_POST['year'];
//var_dump($year);

//Buscar información del condominio
$infoC = $conexion->query("SELECT * FROM condominios WHERE ID = '$idcondominio'");
$arrayInfo = $infoC->fetch_array(MYSQLI_ASSOC);
foreach($infoC as $valor) {
	$nombre = $valor['NombreC'];
	$rif = $valor['RIF'];
	$direccion = $valor['Direccion'];
	$ciudad = $valor['Ciudad'];
	$estado = $valor['Estado'];
}
//Buscar información del propietario
$bcondomino = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
$arrayCondomino = $bcondomino->fetch_array(MYSQLI_ASSOC);
foreach ($bcondomino as $condomino) {
	$nombrep = $condomino['Nombre'];
	//var_dump($nombrep); 
	$alicuota = $condomino['Alicuota'];
	//var_dump($alicuota);
	$inmueble = $condomino['Inmueble'];
	//var_dump($inmueble);
	$correo = $condomino['Correo'];
	//var_dump($correo);
}

//Primero se busca la tasa
$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
foreach($bId as $vid) {
  $id = $vid['id'];
}

$bTasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
foreach ($bTasa as $vTasa) {
  $tasaC = $vTasa['Cierre']; 
  $tasaA = $vTasa['Apertura'];
}

if($tasaC == 0) {
	$tasa = $tasaA;
} else { $tasa = $tasaC;}

/*Buscar Tasa Dólar para gasto
$bidtasa = $conexion->query("SELECT MAX(tasabcv.ID) AS ID FROM tasabcv");
$arrayidTasa = $bidtasa->fetch_array(MYSQLI_ASSOC);
foreach ($bidtasa as $uid) {
	$id = $uid['ID'];
}

$btasa = $conexion->query("SELECT * FROM tasabcv WHERE ID = '$id'");
$arrayTasa = $btasa->fetch_array(MYSQLI_ASSOC);
foreach ($btasa as $valort) {

	$tasa = $valort['tasa'];

}*/


//Fecha
$fecha = date("d/m/Y");
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
	<style type="text/css" media="print">
		  /* Reglas CSS específicas para imprimir */
	    #menu, #pie {display: none !important;}
	    .saltoDePagina { display:block;
													page-break-before:always;}
			th, tr, td { font: 10px Arial}
			.titulo {font: 16px Arial;}
			@page {			
							size: portrait;
							/*size: landscape;*/
							size: letter;
						}
	</style>
</head>
<body>
	<div class="container-fluid">
		<!-- INICIO MENÚ NAV -->
		<ul class="nav justify-content-center bg-primary" id="menu">
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
<section class="container-fluid">
	<header>
			
			<p class="titulo" style="text-align: center;">
				<!--CONDOMINIO <?php //echo strtoupper($nombre);?>-->
				<img src="../img/logosaman.png" width="150px" height="78px"><br>
				RIF <?php echo $rif;?>
			</p>
			<p class="titulo" style="text-align: center;">
				<b><?php echo $direccion; ?></b><br>
				<b><?php echo $ciudad.', '.$estado; ?></b>
			</p>
		</header>
	<hr style="border: solid 2px black;">
	<h2>Aviso de Cobro</h2>
<article class="row">
	<div class="col-2"></div>	
	<div class="col">
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
											echo $alicuotam.'%';
										
						?></td>
						<td class="text-center"><?php echo $fecha; ?></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped table-primary">
				<thead>
					<tr>
						<th scope="col" class="text-center"><b>DESCRIPCION</b></th>
						<th scope="col" class="text-center"><b>MONTO Bs.</b></th>
						<th scope="col" class="text-center"><b>CUOTA Bs.</b></th>
					</tr>
				</thead>
				<tbody>		
						<?php
							//Buscar la sumatoria de los Gastos
							$bSgasto = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM gastos WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$idcondominio'");
							$arraySg = $bSgasto->fetch_array(MYSQLI_ASSOC);
							foreach ($bSgasto as $suma) {
								$totalgt = $suma['sumatoria'];
								
							}

							//Buscar la sumatoria de las Cuotas
							$bScuotas = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM cuotas WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$idcondominio'");
							$arraySc = $bScuotas->fetch_array(MYSQLI_ASSOC);
							foreach ($bScuotas as $sum) {
								$mtotal = $sum['sumatoria'];
								
							}

							//Buscar la información de las Cuotas
							$bCuotas = $conexion->query("SELECT * FROM cuotas WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio='$idcondominio'");
							$arrayGasto = $bCuotas->fetch_array(MYSQLI_ASSOC);
							foreach ($bCuotas as $monto) {
								echo '<tr>';
								$descripcionC = $monto['Descripcion'];
								$montodc = $monto['Montobs'];
								//$montoc = $montodc * $tasa;
								//$rmontoc = round($montodc,2);
								echo '<td>'.$descripcionC.'</td>';
								echo '<td>'.number_format($montodc, 2, ',', '.').'</td>';
								$mcuota = $montodc/64;
								//$mcuotar = round($mcuota,2);
								echo '<td>'.number_format($mcuota, 2,',','.').'</td>';
							}

							//Buscar la información de los Gastos
							$bGasto = $conexion->query("SELECT * FROM gastos WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$idcondominio'");
							$arrayGasto = $bGasto->fetch_array(MYSQLI_ASSOC);
							foreach ($bGasto as $gasto) {
								echo '<tr>';
								$descripcion = $gasto['Descripcion'];
								$montobsg = $gasto['Montobs'];
								//$montog = $montobsg * $tasa;
								//$rmontog = round($montog,2);
								echo '<td>'.$descripcion.'</td>';
								echo '<td>'.number_format($montobsg, 2, ',', '.').'</td>';
								$cuota = $alicuota * $montobsg;
								$cuotar = round($cuota,2);
								echo '<td>'.number_format($cuotar, 2,',','.').'</td></tr>';
							}
							
						?>
					</tr>
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
	<article class="row">
		<section class="col-2"></section>
		<section class="col">
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
								<td class="text-center"><?php $totald = $cuotaT/$tasa;
												$totaldr = round($totald,2);
												echo number_format($totaldr,2, ',','.');
								 ?></td>
							</tr>
						</tbody>
					</table>
		</section>
		<section class="col-2"></section>
	</article>
	<div class="saltoDePagina"></div>
	<article class="row">
		<section class="col-2"></section>
		<section class="col">
			<?php
				#BUSQUEDA PROPIETARIO TODA LA DEUDA
		        if($idpropietario !== 'todos') {
		        $buscarDeuda = new ConectarBd();
		        if($resultado=$buscarDeuda->BuscarUnion("cxc","idpropietario = '$idpropietario' ORDER BY Emision ASC")) { //LIMIT 5,10 ?>
		        	<div class="saltoDePagina"></div>
		              <br><h3>HISTÓRICO</h3>
		              <table class='table table-striped'>
		                  <thead>
		                  <tr>
		                      <th scope='col'>#</th>
		                      <th scope='col'>NOMBRE</th>
		                      <th scope='col'>DESCRIPCION</th>
		                      <th scope='col'>MONTO $</th>
		                      <!--<th scope='col'>MONTO Bs.</th>-->
		                  </tr>
		                  </thead>
		                  <tbody>
		            <?php foreach ($resultado AS $fila) {
		            	$montodolar = $fila['Dolar'];
		                $montobolivar = $montodolar * $tasa;
		                $montobr = round($montobolivar,2);
		                echo '<tr>';
		                echo '<td>'. $fila['Inmueble'].'</td>';
		                echo '<td>'. $fila['Nombre'].'</td>';
		                echo '<td>'. $fila['Descripcion'].'</td>';
		                echo '<td>'. number_format($montodolar,2,',','.').'</td>';}
		                //echo '<td>'. number_format($montobr,2,',','.').'</td>';
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
		            <br>
		            <h2>Total a Pagar: $".number_format($sumatoriaD, 2,',','.')."</h2>";
		            }
		        else {  echo 
		        			"<h4>No tiene saldos pendientes.</h4>"; 

		        		}
		            }
			?>
					 
		</section>
		<section class="col-2"></section>	
	</article>
<footer id="pie">
	<div class="row">
		<div class="col-4"></div>
		<div class="col-2">
			<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
		</div>
		<div class="col-2">
			<p style="text-align: center;"><a href="../avisos.php"><img src="../img/recibo.png" width="60px" height="60px"><br>Avisos</a></p>
			</div>
			<div class="col-4"></div>
		</div>
</footer>
</div>