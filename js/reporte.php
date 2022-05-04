<?php 
//Conexion a la base de datos
require_once '../conexion.php';

//Se reciben los datos
$idpropietario = $_POST['inmueble'];
$idcondominio = $_POST['condominio'];
//ID del Condominio

//Buscar el nombre del Condominio
if($idcondominio == 3) {
	$condominio = 'Torre 1 Res. San Francisco';
} else {
	$condominio = 'Res. San Francisco';
}

//Buscar el Nombre
if($idpropietario == 'todos') {
	$nombre = 'todos';
}
else {

	$bnombre = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
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
	<style type="text/css" media="print">
       /* Reglas CSS específicas para imprimir */
       #menu, #pie {
       	display: none;
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
		<div class="row">
			<div class="col">
				<?php 
				//CONDOMINIO TORRE 1
				if($idcondominio == 3) {
					if($nombre == 'todos') {
					$reporte = "SELECT * 
								FROM reporte_cxc 
								INNER JOIN propietarios ON reporte_cxc.idpropietario = propietarios.ID
								LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
								WHERE condominios.ID = '$idcondominio' ORDER BY idpropietario ASC";
					$ejecutarR = $conexion->query($reporte);
					$arrayR = $ejecutarR->fetch_array(MYSQLI_ASSOC);
					?>
					<h3 style="text-align: center;">Condominio <?php echo $condominio; ?></h3><br>
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>Torre</th>
						      <th scope='col'>Presidente J.C.</th>
						      <th scope='col'>Ant</th>
						      <th scope='col'>Ene</th>
						      <th scope='col'>Feb</th>
						      <th scope='col'>Mar</th>
						      <th scope='col'>Abr</th>
						      <th scope='col'>May</th>
						      <th scope='col'>Jun</th>
						      <th scope='col'>Jul</th>
						      <th scope='col'>Ago</th>
						      <th scope='col'>Sep</th>
						      <th scope='col'>Octubre</th>
						      <th scope='col'>Total</th>
						      <!--<th scope='col'>Noviembre</th>
						      <th scope='col'>Diciembre</th>-->
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($ejecutarR as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php $anterior = $value['Anterior']; echo number_format($anterior, 2,',','.'); ?></td>
									<td><?php $enero = $value['Enero']; echo number_format($enero, 2,',','.'); ?></td>
									<td><?php $febrero = $value['Febrero']; echo number_format($febrero, 2,',','.'); ?></td>
									<td><?php $marzo = $value['Marzo']; echo number_format($marzo, 2,',','.'); ?></td>
									<td><?php $abril = $value['Abril']; echo number_format($abril, 2,',','.'); ?></td>
									<td><?php $mayo = $value['Mayo']; echo number_format($mayo, 2,',','.'); ?></td>
									<td><?php $junio = $value['Junio']; echo number_format($junio, 2,',','.'); ?></td>
									<td><?php $julio = $value['Julio']; echo number_format($julio, 2,',','.'); ?></td>
									<td><?php $agosto = $value['Agosto']; echo number_format($agosto, 2,',','.'); ?></td>
									<td><?php $septiembre = $value['Septiembre']; echo number_format($septiembre, 2,',','.'); ?></td>
									<td><?php $octubre = $value['Octubre']; echo number_format($octubre, 2,',','.'); ?></td>
									<td><?php $total = $anterior + $enero + $febrero + $marzo + $abril + $mayo + $junio + $julio + $agosto + $septiembre + $octubre;
										echo number_format($total, 2, ',','.');}?></td>
									<!--
									<td><?php //echo number_format($value['Noviembre'], 2,',','.'); ?></td>
									<td><?php //echo number_format($value['Diciembre'], 2,',','.');} ?></td>-->	
								</tr>
							</tbody>
						</table>
				<?php }
						else {
								$reporte = "SELECT * 
											FROM reporte_cxc 
											INNER JOIN propietarios ON reporte_cxc.idpropietario = propietarios.ID
											LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
											WHERE reporte_cxc.idpropietario = '$idpropietario' AND condominios.ID = '$idcondominio'";
								$ejecutarR = $conexion->query($reporte);
								$arrayR = $ejecutarR->fetch_array(MYSQLI_ASSOC);

							?>
							<h3 style="text-align: center;">Condominio <?php echo $condominio; ?></h3><br>
							<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>Torre</th>
						      <th scope='col'>Presidente J.C.</th>
						      <th scope='col'>Anterior</th>
						      <th scope='col'>Ene</th>
						      <th scope='col'>Feb</th>
						      <th scope='col'>Mar</th>
						      <th scope='col'>Abr</th>
						      <th scope='col'>May</th>
						      <th scope='col'>Jun</th>
						      <th scope='col'>Jul</th>
						      <th scope='col'>Ago</th>
						      <th scope='col'>Sep</th>
						      <th scope='col'>Total</th>
						      <th scope='col'>Octubre</th>
						      <!--<th scope='col'>Noviembre</th>
						      <th scope='col'>Diciembre</th>-->
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($ejecutarR as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php $anterior = $value['Anterior']; echo number_format($anterior, 2,',','.'); ?></td>
									<td><?php $enero = $value['Enero']; echo number_format($enero, 2,',','.'); ?></td>
									<td><?php $febrero = $value['Febrero']; echo number_format($febrero, 2,',','.'); ?></td>
									<td><?php $marzo = $value['Marzo']; echo number_format($marzo, 2,',','.'); ?></td>
									<td><?php $abril = $value['Abril']; echo number_format($abril, 2,',','.'); ?></td>
									<td><?php $mayo = $value['Mayo']; echo number_format($mayo, 2,',','.'); ?></td>
									<td><?php $junio = $value['Junio']; echo number_format($junio, 2,',','.'); ?></td>
									<td><?php $julio = $value['Julio']; echo number_format($julio, 2,',','.'); ?></td>
									<td><?php $agosto = $value['Agosto']; echo number_format($agosto, 2,',','.'); ?></td>
									<td><?php $septiembre = $value['Septiembre']; echo number_format($septiembre, 2,',','.'); ?></td>
									<td><?php $octubre = $value['Octubre']; echo number_format($octubre, 2,',','.'); ?></td>
									<td><?php $total = $anterior + $enero + $febrero + $marzo + $abril + $mayo + $junio + $julio + $agosto + $septiembre + $octubre;
										echo number_format($total, 2, ',','.');} 
									?></td>
									<!--
									<td><?php //echo number_format($value['Noviembre'], 2,',','.'); ?></td>
									<td><?php //echo number_format($value['Diciembre'], 2,',','.'); ?></td>-->
								</tr>
							</tbody>
						</table>
						<br>
						<?php  }
				}
				else {
					if($nombre == 'todos') {
					$reporte = "SELECT * 
								FROM reporte_cxc 
								INNER JOIN propietarios ON reporte_cxc.idpropietario = propietarios.ID
								LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
								WHERE condominios.ID = '$idcondominio' ORDER BY idpropietario ASC";
					$ejecutarR = $conexion->query($reporte);
					$arrayR = $ejecutarR->fetch_array(MYSQLI_ASSOC);
					?>
					<h3 style="text-align: center;">Condominio <?php echo $condominio; ?></h3><br>
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>Torre</th>
						      <th scope='col'>Presidente J.C.</th>
						      <th scope='col'>Anterior</th>
						      <th scope='col'>Ene</th>
						      <th scope='col'>Feb</th>
						      <th scope='col'>Mar</th>
						      <th scope='col'>Abr</th>
						      <th scope='col'>May</th>
						      <th scope='col'>Jun</th>
						      <th scope='col'>Jul</th>
						      <th scope='col'>Ago</th>
						      <th scope='col'>Sep</th>
						      <th scope='col'>Octubre</th>
						      <th scope='col'>Total</th>
						      <!--
						      <th scope='col'>Noviembre</th>
						      <th scope='col'>Diciembre</th>-->
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($ejecutarR as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php $anterior = $value['Anterior']; echo number_format($anterior, 2,',','.'); ?></td>
									<td><?php $enero = $value['Enero']; echo number_format($enero, 2,',','.'); ?></td>
									<td><?php $febrero = $value['Febrero']; echo number_format($febrero, 2,',','.'); ?></td>
									<td><?php $marzo = $value['Marzo']; echo number_format($marzo, 2,',','.'); ?></td>
									<td><?php $abril = $value['Abril']; echo number_format($abril, 2,',','.'); ?></td>
									<td><?php $mayo = $value['Mayo']; echo number_format($mayo, 2,',','.'); ?></td>
									<td><?php $junio = $value['Junio']; echo number_format($junio, 2,',','.'); ?></td>
									<td><?php $julio = $value['Julio']; echo number_format($julio, 2,',','.'); ?></td>
									<td><?php $agosto = $value['Agosto']; echo number_format($agosto, 2,',','.'); ?></td>
									<td><?php $septiembre = $value['Septiembre']; echo number_format($septiembre, 2,',','.'); ?></td>
									<td><?php $octubre = $value['Octubre']; echo number_format($octubre, 2,',','.'); ?></td>
									<td><?php $total = $anterior + $enero + $febrero + $marzo + $abril + $mayo + $junio + $julio + $agosto + $septiembre + $octubre;
										echo '<b>'.number_format($total, 2, ',','.').'</b>';} 
									?></td>
									<!--
									<td><?php //echo number_format($value['Noviembre'], 2,',','.'); ?></td>
									<td><?php //echo number_format($value['Diciembre'], 2,',','.');} ?></td>-->	
								</tr>
							</tbody>
						</table>
				<?php }
						else {
								$reporte = "SELECT * FROM reporte_cxc 
											INNER JOIN propietarios ON reporte_cxc.idpropietario = propietarios.ID
											LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
											WHERE reporte_cxc.idpropietario = '$idpropietario' AND condominios.ID = '$idcondominio'";
								$ejecutarR = $conexion->query($reporte);
								$arrayR = $ejecutarR->fetch_array(MYSQLI_ASSOC);

							?>
							<h3 style="text-align: center;">Condominio <?php echo $condominio; ?></h3><br>
							<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col'>Torre</th>
						      <th scope='col'>Presidente J.C.</th>
						      <th scope='col'>Anterior</th>
						      <th scope='col'>Ene</th>
						      <th scope='col'>Feb</th>
						      <th scope='col'>Mar</th>
						      <th scope='col'>Abr</th>
						      <th scope='col'>May</th>
						      <th scope='col'>Jun</th>
						      <th scope='col'>Jul</th>
						      <th scope='col'>Ago</th>
						      <th scope='col'>Sep</th>
						      <th scope='col'>Octubre</th>
						      <!--<th scope='col'>Noviembre</th>
						      <th scope='col'>Diciembre</th>-->
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($ejecutarR as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
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
									<td><?php echo number_format($value['Octubre'], 2,',','.');} ?></td>
									<!--<td><?php //echo number_format($value['Noviembre'], 2,',','.'); ?></td>
									<td><?php //echo number_format($value['Diciembre'], 2,',','.'); ?></td>-->
								</tr>
							</tbody>
						</table>
						<br>
						<?php  }
				}

				switch ($idcondominio) {
					case 1:
						$totalDeuda = $conexion->query("SELECT SUM(Monto) AS sumatoria
                                        FROM cxc
                                        INNER JOIN propietarios ON cxc.idpropietario = propietarios.ID
                                        LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                        WHERE condominios.ID = '$idcondominio'");
				        //Convierto en un Array Asociativo
				        $ArrayTotalDeuda = $totalDeuda->fetch_array(MYSQLI_ASSOC);
				        //Guardo el valor de Sumatoria
				        foreach ($totalDeuda as $suma) {
				            $sumatoria = $suma['sumatoria'];}
					break;
					default:
							$totalDeuda = $conexion->query("SELECT SUM(Dolar) AS sumatoria
                     	                  FROM cxc
                                          INNER JOIN propietarios ON cxc.idpropietario = propietarios.ID
                                          LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                          WHERE condominios.ID = '$idcondominio'");
					        //Convierto en un Array Asociativo
					        $ArrayTotalDeuda = $totalDeuda->fetch_array(MYSQLI_ASSOC);
					        //Guardo el valor de Sumatoria
					        foreach ($totalDeuda as $suma) {
					            $sumatoria = $suma['sumatoria'];}
									break;}
          			//Vamos a Calcular el Total de la Deuda
				?>
					<h4>Total de Cuentas por Cobrar: <?php 
					if ($idcondominio == 1) {
						echo 'Bs. ' . number_format($sumatoria, 2, ',','.');}
					else {
						echo '$' . number_format($sumatoria, 2, ',','.');
					} ?></h4>
			</div>
		</div>
	</div>
	<footer id="pie">
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
				</footer>
</body>
</html>