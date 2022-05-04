<?php
//ob_start();
require('../conexion.php');
//Clase Base de Datos
require_once '../class/ConexionBD.php';

//Datos iniciales para el Aviso de Cobro
$condominio = 4;
$mes = 8;
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
  //$enum = 1;
//Vamos a extraer el primer ID del propietario que coincide con el ID del Condominio
$maximoId = $conexion->query("SELECT MAX(ID) as ID FROM propietarios WHERE idcondominio = '$condominio'");
$arrayMaximoId = $maximoId->fetch_array(MYSQLI_ASSOC);
foreach($maximoId as $maxId) {
  $idMax = $maxId['ID'];}

//Lo deducimos al restar el número de registro al máximo id
$ajustarId = $enum - 1;
//echo $ajustarId.'<br>';
$primerId = $idMax - $ajustarId;
//$primerId = 179;
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
	$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
	$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
	foreach($bId as $vid) {$id = $vid['id'];}
	$bTasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
	$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
	foreach ($bTasa as $vTasa) {
		$tasaC = $vTasa['Cierre']; 
	  $tasaA = $vTasa['Apertura'];}
	if($tasaC == 0) {$tasa = $tasaA;} else { $tasa = $tasaC;}
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
	$fecha = date("d/m/Y");?>			

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
			th, tr, td { font: 10px Arial}
			.titulo {font: 16px Arial;}
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
				<img src="../img/logosaman.png" width="150px" height="78px"><br>
				RIF <?php echo $rif;?>
			</p>
			<p class="titulo" style="text-align: center;">
				<b><?php echo $direccion; ?></b><br>
				<b><?php echo $ciudad.', '.$estado; ?></b>
			</p>
		</header>
		<!-- Fin del Encabezado -->

				
		<!-- Inicio consulta de Deuda Propietario -->
		<article class="row">
			<section class="col-2"></section>
			<section class="col">
				<!-- Se va a crear una consulta de toda la deuda del Propietario en PHP -->
				<!--SALTO DE PÁGINA -->
				<!--<div class="saltoDePagina"></div>-->
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
		              <th scope='col'>MONTO Bs./Nva Exp</th>
		              <th scope='col'>MONTO $</th>
		            </tr>
		          </thead>
		          <tbody>
		          <?php foreach ($resultado AS $fila) {
		              $montodolar = $fila['Dolar'];
		              $montobolivar = $montodolar * $tasa;
		              $montobr = round($montobolivar,2);
		              $nvaExp = $montobolivar/1000000;
                	  $montoBd = round($nvaExp,2);
		              echo '<tr>';
			              echo '<td>'. $fila['Inmueble'].'</td>';
			              echo '<td>'. $fila['Nombre'].'</td>';
			              echo '<td>'. $fila['Descripcion'].'</td>';
			              echo '<td>'. number_format($montobr, 2, ',', '.').' ('.number_format($montoBd, 2, ',', '.').')</td>';
			              echo '<td>'. number_format($montodolar,2,',','.').'</td>';}
		              echo '</tr>';
		            $totalDeuda = new ConectarBd();
		            if($resultadoSumaD = $totalDeuda->Sumatoria("cxc", "Dolar", "idpropietario = '$idpropietario'"))
		                {foreach ($resultadoSumaD as $sumausd) {$sumatoriaD = $sumausd['sumatoria'];}}
		            else {echo "Error, no se pudo obtener la sumatoria";}
		            if($resultadoSumaBs = $totalDeuda->Sumatoria("cxc", "Monto", "idpropietario = '$idpropietario'"))
		                {foreach ($resultadoSumaBs as $sumabs) {$sumatoriaBs = $sumabs['sumatoria'];}}
		            else {echo "Error, no se pudo obtener la sumatoria";}
		            $nvaExpT = $sumatoriaBs/1000000;
            		$nvaSumatoria = round($nvaExpT,2);

		            echo "</tbody>
		            </table>
		            <!-- Fin de la Tabla de Deuda Pendiente -->
		            <br>
		            <h2>Total a Pagar Bs. ".number_format($sumatoriaBs, 2, ',','.').'('.number_format($nvaSumatoria,2,',','.').
                ") [$".number_format($sumatoriaD, 2, ',', '.')."]</h2>";}
		        else {echo "<h4>No tiene saldos pendientes.</h4>";}
		     }

				?>
			</section>
			<section class="col-2"></section>			
		</article>
	</section>
	<!-- Fin de Section que centra todo el contenido -->
	<!-- SALTO DE PÁGINA -->
	<div class="saltoDePagina"></div>
</body>
<?php 

}//Fin Bucle For 

?>