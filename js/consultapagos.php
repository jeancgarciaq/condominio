<?php  
//Conexión a la base de datos
require_once '../conexion.php';
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
       #menu, #pie, #titulo, #total {display: none !important;}
	</style>
</head>
<body>
	<div class="container-fluid">
		<!--INICIO BARRA NAVEGACIÓN -->
	  <ul class="nav justify-content-center bg-primary" id="menu">
	    <li class="nav-item">
	      <a class="nav-link active text-light border-start border-white" href="../index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white" href="../condominio.php"><i class="las la-city"></i> Condominio</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white" href="../propietarios.php"><i class="las la-user-alt"></i> Propietarios</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white" href="../proveedores.php"><i class="las la-store-alt"></i> Proveedores</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white" href="../pagos.php"><i class="las la-donate"></i> Pagos</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white" href="../gastos.php"><i class="las la-file-invoice-dollar"></i> Gastos</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white" href="../avisos.php"><i class="las la-receipt"></i> Avisos</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white" href="../cxc.php"><i class="las la-cash-register"></i> Cuentas x Cobrar</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link text-light border-start border-white border-end" href="../cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
	    </li>
	  </ul>
	  <!--FIN BARRA NAVEGACIÓN -->
		<h1 id="titulo"><img src="../img/caja.png" class="img-fluid" width="10%" height="10%"> MÓDULO 5: PAGOS</h1><br>
		<section class="row">
			<article class="col-1"></article>
			<article class="col-10">
				<h2>HISTÓRICO DE PAGOS</h2>
				<?php
				//Recibimos los datos
				//Nombre del propietario
				$idpropietario = $_POST['inmueble'];
				//var_dump($nombre);
				//Condominio
				$idcondominio = $_POST['condominio'];
				//Mes
				$mes = $_POST['mes'];
				//Año
				$year = $_POST['year'];
				?>
				
				<?php
				//Asignamos el Nombre
				if ($idpropietario == 'todos') {
					$nombre = 'todos';
					$inmueble = 'PB';
				} else {
					//Buscar Inmueble y Nombre del Propietario
					$buscarPropietario = $conexion->query("SELECT * FROM propietarios WHERE idcondominio = '$idcondominio' AND ID = '$idpropietario'");
					$arrayPropietario = $buscarPropietario->fetch_array(MYSQLI_ASSOC);
					foreach ($buscarPropietario as $dato) {
						$nombre = $dato['Nombre'];
						$inmueble = $dato['Inmueble'];}
					$buscarPropietario->close();
				}
				if($idcondominio == 1) {
					$condominio = 'Edificio Bucare';
				} elseif ($idcondominio == 2) {
					$condominio = 'Res. San Francisco';
				} elseif ($idcondominio == 3) {
					$condominio = 'Torre 1 Res. San Francisco';
				} else {
					$condominio = 'Condominio Samán';
				}

				/*switch($idcondominio) {
                    case 1:
                        $condominio = 'Edificio Bucare';
                        break;
                    case 2:
                    	$condominio = 'Res. San Francisco';
                    default:
                        $condominio = 'Torre 1 Res. San Francisco';
                        break;
                }*/
				?>
                <p><b><i class="las la-city"></i> Condominio:</b> <?php echo strtoupper($condominio); ?></p>
                <p><b><i class="las la-user-alt"></i> Propietario:</b> <?php echo strtoupper($nombre); ?></p>
				<p><b><i class="la la-home"></i> Inmueble Nº:</b> <?php echo $inmueble; ?></p>
				<?php
				//Si es San Francisco
				if($idcondominio == 2) {
					//Vamos a Realizar una consulta de toda la Deuda
					//Para ello la condicionamos
					if($nombre == 'todos') {
						#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO CONCILIADO EN DÓLARES
						if(!empty($mes AND $year)) {
								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotal = "SELECT SUM(Dolar) AS Conciliado 
													FROM pagos
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
													LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE pagos.Conciliado = 'SI' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND condominios.ID = '$idcondominio'";
								$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
								$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                $sumatoriaPagoTotal->close();
								} 
						else  {
								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotal = "SELECT SUM(Dolar) AS Conciliado 
													FROM pagos
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
													LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE pagos.Conciliado = 'SI' AND condominios.ID = '$idcondominio'";
								$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
								$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                $sumatoriaPagoTotal->close();
								}
						#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO NO CONCILIADO EN DÓLARES
						if(!empty($mes AND $year)) {
							//Vamos a extraer los pagos No Conciliados
							$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar 
														FROM pagos 
														INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
														LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
														WHERE condominios.ID = '$idcondominio' AND Conciliado = 'NO' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
							$sumatoriaPagoS = $conexion->query($sumaPagoS);
							$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
							//Guardamos el valor en una variable
							$sumatoriaS = $filaSumatoriaS['sinconciliar'];	//var_dump($sumatoriaS);
                            $sumatoriaPagoS->close();
						}
					 	else {
							//Vamos a extraer los pagos No Conciliados
							$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar 
										FROM pagos 
										INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
										LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
										WHERE condominios.ID = '$idcondominio' AND Conciliado = 'NO'";
							$sumatoriaPagoS = $conexion->query($sumaPagoS);
							$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
							//Guardamos el valor en una variable
							$sumatoriaS = $filaSumatoriaS['sinconciliar']; //var_dump($sumatoriaS);
                            $sumatoriaPagoS->close();
						}
						//Sumatoria Total de Pagos Recibidos
						$sumatoriaTotal = $sumatoria + $sumatoriaS;
						//var_dump($sumatoriaTotal);
						#AHORA VOY HACER LO MISMO PERO PARA LOS BOLÍVARES
						if(!empty($mes AND $year)) {
								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotalBs = "SELECT SUM(Monto) AS Conciliado 
													FROM pagos
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
													LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE pagos.Conciliado = 'SI' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND condominios.ID = '$idcondominio'";
								$sumatoriaPagoTotalBs = $conexion->query($sumaPagoTotalBs);
								$filaSumatoriaBs =  $sumatoriaPagoTotalBs->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoriaBs = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                $sumatoriaPagoTotalBs->close();
								} 
						else  {
								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotalBs = "SELECT SUM(Monto) AS Conciliado 
													FROM pagos
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
													LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE pagos.Conciliado = 'SI' AND condominios.ID = '$idcondominio'";
								$sumatoriaPagoTotalBs = $conexion->query($sumaPagoTotalBs);
								$filaSumatoriaBs =  $sumatoriaPagoTotalBs->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoriaBs = $filaSumatoriaBs['Conciliado']; //var_dump($sumatoria);
                                $sumatoriaPagoTotalBs->close();
								}
						#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO NO CONCILIADO EN DÓLARES
						if(!empty($mes AND $year)) {
							//Vamos a extraer los pagos No Conciliados
							$sumaPagoBsc = "SELECT SUM(Monto) AS sinconciliar 
														FROM pagos 
														INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
														LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
														WHERE condominios.ID = '$idcondominio' AND Conciliado = 'NO' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
							$sumatoriaPagoBsc = $conexion->query($sumaPagoBsc);
							$filaSumatoriaBsc =  $sumatoriaPagoBsc->fetch_array(MYSQLI_ASSOC);
							//Guardamos el valor en una variable
							$sumatoriaBsc = $filaSumatoriaBsc['sinconciliar'];	//var_dump($sumatoriaS);
                            $sumatoriaPagoBsc->close();
						}
					 	else {
							//Vamos a extraer los pagos No Conciliados
							$sumaPagoBs = "SELECT SUM(Monto) AS sinconciliar 
										FROM pagos 
										INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
										LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
										WHERE condominios.ID = '$idcondominio' AND Conciliado = 'NO'";
							$sumatoriaPagoBs = $conexion->query($sumaPagoBs);
							$filaSumatoriaBs =  $sumatoriaPagoBs->fetch_array(MYSQLI_ASSOC);
							//Guardamos el valor en una variable
							$sumatoriaBsc = $filaSumatoriaBs['sinconciliar']; //var_dump($sumatoriaS);
                            $sumatoriaPagoBs->close();
                        	}
                            //Sumatoria Total de Pagos Recibidos
							$sumatoriaTotalBs = $sumatoriaBs + $sumatoriaBsc;

						#EXTRAEMOS TODA LA INFORMACIÓN PARA PRESENTARLA EN UNA TABLA
						if(!empty($mes AND $year)) {
						//Consultamos lo Pagado
						$consultaPagoTotal = "SELECT * 
												FROM pagos 
												INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
												LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
												WHERE condominios.ID = '$idcondominio' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'
												ORDER BY idpropietario ASC";
						$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
						$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);}
						else {
							$consultaPagoTotal = "SELECT * 
													FROM pagos 
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
										    		LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE condominios.ID = '$idcondominio'
													ORDER BY idpropietario ASC";
							$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
							$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);
						}
						//Ahora Vamos a construir una tabla con éstos valores
						//Va a contener #Inmueble, Nombre, Descripción, Monto
						?>
						<table class='table table-striped tabled-hover'>
						  <thead>
						    <tr>
						      <th scope='col' class="text-center">#</th>
						      <th scope='col' class="text-center">NOMBRE</th>
						      <th scope='col' class="text-center">MONTO Bs.</th>
						      <th scope='col' class="text-center">MONTO $</th>
						      <th scope='col' class="text-center">BANCO</th>
						      <th scope='col' class="text-center">REFERENCIA</th>
						      <th scope='col' class="text-center">FECHA</th>
                  <th scope='col' class="text-center">TASA Bs.</th>
                  <th scope='col' class="text-center">CONCILIADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoPagoTotal as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php echo number_format($value['Monto'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Dolar'], 2,',','.'); ?></td>
                                    <td><?php echo $value['Banco'];?></td>
									<td><?php echo $value['Referencia1'];?></td>	
									<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham)); ?></td>
                                    <td><?php echo number_format($value['Tasa'], 2,',','.'); ?></td>
									<td style="text-align: center"><?php echo $value['Conciliado'];}
									$resultadoPagoTotal->close();
									?></td>
								</tr>
							</tbody>
						</table>
						<br>
						<div class='row'>
							<div class="col-10">
							<p><b>Total Pagos Sin Conciliar:</b> $<?php echo 'Bs. '.number_format($sumatoriaBsc, 2,',','.').' $ '. number_format($sumatoriaS, 2,',','.');?><br>
							<b>Total Pagos Conciliado:</b> $<?php echo 'Bs. '.number_format($sumatoriaBs, 2,',','.').' $ '. number_format($sumatoria, 2,',','.');?><br>
							<span style="font-size: 24px;"><strong>Total de Pagos Recibidos:</strong> $<?php echo 'Bs. '. number_format($sumatoriaTotalBs, 2,',','.').' $ '. number_format($sumatoriaTotal, 2,',','.'); ?></span></p></div>
						</div>
					<?php }
					#DESDE AQUÍ LA BÚSQUEDA PARA PROPIETARIO
					else {
								#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO CONCILIADO DÓLARES
								if(!empty($mes AND $year)) {
										//Vamos a extraer los pagos Conciliados
										$sumaPagoTotal = "SELECT SUM(Dolar) AS Conciliado 
															FROM pagos
															INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
															LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
															WHERE pagos.Conciliado = 'SI' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
										$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                        $sumatoriaPagoTotal->close();
									} 
								else {
										//Vamos a extraer los pagos Conciliados
										$sumaPagoTotal = "SELECT SUM(Dolar) AS Conciliado 
															FROM pagos
															INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
															LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
															WHERE pagos.Conciliado = 'SI' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
										$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                        $sumatoriaPagoTotal->close();
							}
							#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO NO CONCILIADO EN DÓLARES
							if(!empty($mes AND $year)) {
										//Vamos a extraer los pagos No Conciliados
										$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar 
														FROM pagos 
														INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
														LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
														WHERE pagos.Conciliado = 'NO' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoS = $conexion->query($sumaPagoS);
										$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoriaS = $filaSumatoriaS['sinconciliar'];
										//var_dump($sumatoriaS);
                                        $sumatoriaPagoS->close();
								} 
							else {
									//Vamos a extraer los pagos No Conciliados
										$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar 
														FROM pagos 
														INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
														LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
														WHERE pagos.Conciliado = 'NO' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoS = $conexion->query($sumaPagoS);
										$filaSumatoriaS = $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoriaS = $filaSumatoriaS['sinconciliar'];
										//var_dump($sumatoriaS);
                                        $sumatoriaPagoS->close();
								}
								//Sumatoria Total de Pagos Recibidos
								$sumatoriaTotal = $sumatoria + $sumatoriaS;
								//var_dump($sumatoriaTotal);

								#EXTRAE TODA LA INFORMACIÓN PARA PRESENTARLA
								if (!empty($mes AND $year)) {
										//Consultamos lo Pagado
										$consultaPagoTotal = "SELECT * 
													            FROM pagos 
																INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
																LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
																WHERE condominios.ID = '$idcondominio' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND pagos.idpropietario = '$idpropietario' 
																ORDER BY Fecha ASC";
										$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
										$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);}
								else {
										//Consultamos lo Pagado
										$consultaPagoTotal = "SELECT * 
															    FROM pagos 
															    INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
															    LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
															    WHERE condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario' 
															    ORDER BY Fecha ASC";
										$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
										$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);}

								//Ahora Vamos a construir una tabla con éstos valores
								//Va a contener #Inmueble, Nombre, Descripción, Monto?>
								<table class='table table-striped tabled-hover'>
								  <thead>
								    <tr>
								      <th scope='col' class="text-center">#</th>
								      <th scope='col' class="text-center">NOMBRE</th>
								      <th scope='col' class="text-center">MONTO Bs.</th>
								      <th scope='col' class="text-center">MONTO $</th>
								      <th scope='col' class="text-center">BANCO</th>
								      <th scope='col' class="text-center">REFERENCIA</th>
								      <th scope='col' class="text-center">FECHA</th>
                      <th scope='col' class="text-center">TASA Bs.</th>
								      <th scope='col' class="text-center">CONCILIADO</th>
								    </tr>
								  </thead>
								  <tbody>
										<?php
											foreach ($resultadoPagoTotal as $value) {?>
										<tr>
											<th scope="row"><?php echo $value['Inmueble']; ?></th>
											<td><?php echo $value['Nombre']; ?></td>
											<td><?php echo number_format($value['Monto'], 2,',','.'); ?></td>
											<td><?php echo number_format($value['Dolar'], 2,',','.'); ?></td>
											<td><?php echo $value['Banco']; ?></td>
											<td><?php echo $value['Referencia1'];?></td>	
											<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham)); ?></td>
                                            <td><?php echo number_format($value['Tasa'], 2,',','.'); ?></td>
											<td style="text-align: center"><?php echo $value['Conciliado'];}
											$resultadoPagoTotal->close();
											?></td>
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
					<?php } }
					else {
					//Vamos a Realizar una consulta de toda la Deuda
					//Para ello la condicionamos
					if($nombre == 'todos') {
						#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO CONCILIADO EN DÓLARES
						if(!empty($mes AND $year)) {
								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotal = "SELECT SUM(Dolar) AS Conciliado 
													FROM pagos
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
													LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE pagos.Conciliado = 'SI' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND condominios.ID = '$idcondominio'";
								$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
								$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                $sumatoriaPagoTotal->close();
								} 
						else  {
								//Vamos a extraer los pagos Conciliados
								$sumaPagoTotal = "SELECT SUM(Dolar) AS Conciliado 
													FROM pagos
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
													LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE pagos.Conciliado = 'SI' AND condominios.ID = '$idcondominio'";
								$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
								$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
								//Guardamos el valor en una variable
								$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                $sumatoriaPagoTotal->close();
								}
						#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO NO CONCILIADO
						if(!empty($mes AND $year)) {
							//Vamos a extraer los pagos No Conciliados
							$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar 
											FROM pagos 
											INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
											LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
											WHERE condominios.ID = '$idcondominio' AND Conciliado = 'NO' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'";
							$sumatoriaPagoS = $conexion->query($sumaPagoS);
							$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
							//Guardamos el valor en una variable
							$sumatoriaS = $filaSumatoriaS['sinconciliar'];	//var_dump($sumatoriaS);
                            $sumatoriaPagoS->close();
						}
					 	else {
							//Vamos a extraer los pagos No Conciliados
							$sumaPagoS = "SELECT SUM(Dolar) AS sinconciliar 
										FROM pagos 
										INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
										LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
										WHERE condominios.ID = '$idcondominio' AND Conciliado = 'NO'";
							$sumatoriaPagoS = $conexion->query($sumaPagoS);
							$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
							//Guardamos el valor en una variable
							$sumatoriaS = $filaSumatoriaS['sinconciliar']; //var_dump($sumatoriaS);
                            $sumatoriaPagoS->close();
						}
						//Sumatoria Total de Pagos Recibidos
						$sumatoriaTotal = $sumatoria + $sumatoriaS;
						//var_dump($sumatoriaTotal);
						#EXTRAEMOS TODA LA INFORMACIÓN PARA PRESENTARLA EN UNA TABLA
						if(!empty($mes AND $year)) {
						//Consultamos lo Pagado
						$consultaPagoTotal = "SELECT * 
												FROM pagos 
												INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
												LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
											    WHERE condominios.ID = '$idcondominio' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'
												ORDER BY idpropietario ASC";
						$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
						$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);}
						else {
							$consultaPagoTotal = "SELECT * 
												    FROM pagos 
													INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
													LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
													WHERE condominios.ID = '$idcondominio'
													ORDER BY idpropietario ASC";
							$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
							$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);
						}
						//Ahora Vamos a construir una tabla con éstos valores
						//Va a contener #Inmueble, Nombre, Descripción, Monto
						?>
						<table class='table table-striped'>
						  <thead>
						    <tr>
						      <th scope='col' class="text-center">#</th>
						      <th scope='col' class="text-center">NOMBRE</th>
						      <th scope='col' class="text-center">MONTO Bs.</th>
						      <th scope='col' class="text-center">MONTO $</th>
						      <th scope='col' class="text-center">BANCO</th>
						      <th scope='col' class="text-center">REFERENCIA</th>
						      <th scope='col' class="text-center">FECHA</th>
                  <th scope='col' class="text-center">TASA Bs.</th>
						      <th scope='col' class="text-center">CONCILIADO</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php
									foreach ($resultadoPagoTotal as $value) {?>
								<tr>
									<th scope="row"><?php echo $value['Inmueble']; ?></th>
									<td><?php echo $value['Nombre']; ?></td>
									<td><?php echo number_format($value['Monto'], 2,',','.'); ?></td>
									<td><?php echo number_format($value['Dolar'], 2,',','.'); ?></td>
									<td><?php echo $value['Banco']; ?></td>
									<td><?php echo $value['Referencia1'];?></td>
                                    <td><?php echo number_format($value['Tasa'], 2,',','.'); ?>
									<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham)); ?></td>
									<td style="text-align: center"><?php echo $value['Conciliado'];}
									$resultadoPagoTotal->close();
									?></td>
								</tr>
							</tbody>
						</table>
						<br>
						<!-- CALCULO DE LA TASA DE CAMBIO -->
							<?php 
							$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasabcv");
							$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
							foreach($bId as $vid) {
							  $id = $vid['id'];
							}
							$bTasa = $conexion->query("SELECT * FROM tasabcv WHERE ID = '$id'");
							$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
							foreach ($bTasa as $vTasa) {
							  $tasa = $vTasa['tasa']; }
							?>
						<!-- FIN DE LA TASA DE CAMBIO -->
						<div class='row' id="total">
							<div class="col-10">
							<p><b>Total Pagos Sin Conciliar:</b> $<?php echo number_format($sumatoriaS, 2,',','.');?><br>
							<b>Total Pagos Conciliado:</b> $<?php echo number_format($sumatoria, 2,',','.');?><br>
							<span style="font-size: 24px;"><strong>Total de Pagos Recibidos:</strong> $<?php echo number_format($sumatoriaTotal, 2,',','.'); ?></span></p></div>
						</div>
					<?php }
					#DESDE AQUÍ LA BÚSQUEDA PARA PROPIETARIO
					else {
								#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO CONCILIADO
								if(!empty($mes AND $year)) {
										//Vamos a extraer los pagos Conciliados
										$sumaPagoTotal = "SELECT SUM(Monto) AS Conciliado 
															FROM pagos
															INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
															LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
															WHERE pagos.Conciliado = 'SI' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
										$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                        $sumatoriaPagoTotal->close();
									} 
								else {
										//Vamos a extraer los pagos Conciliados
										$sumaPagoTotal = "SELECT SUM(Monto) AS Conciliado 
															FROM pagos
															INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
															LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
															WHERE pagos.Conciliado = 'SI' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoTotal = $conexion->query($sumaPagoTotal);
										$filaSumatoria =  $sumatoriaPagoTotal->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoria = $filaSumatoria['Conciliado']; //var_dump($sumatoria);
                                        $sumatoriaPagoTotal->close();
							}
							#SE COMPRUEBA SI MES Y AÑO ESTÁN VACIOS PARA OBTENER LA SUMATORIA DE LO NO CONCILIADO
							if(!empty($mes AND $year)) {
										//Vamos a extraer los pagos No Conciliados
										$sumaPagoS = "SELECT SUM(Monto) AS sinconciliar 
														FROM pagos 
														INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
														LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
														WHERE pagos.Conciliado = 'NO' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoS = $conexion->query($sumaPagoS);
										$filaSumatoriaS =  $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoriaS = $filaSumatoriaS['sinconciliar'];
										//var_dump($sumatoriaS);
                                        $sumatoriaPagoS->close();
								} 
							else {
									//Vamos a extraer los pagos No Conciliados
										$sumaPagoS = "SELECT SUM(Monto) AS sinconciliar 
														FROM pagos 
														INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
														LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
														WHERE pagos.Conciliado = 'NO' AND condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario'";
										$sumatoriaPagoS = $conexion->query($sumaPagoS);
										$filaSumatoriaS = $sumatoriaPagoS->fetch_array(MYSQLI_ASSOC);
										//Guardamos el valor en una variable
										$sumatoriaS = $filaSumatoriaS['sinconciliar'];
										//var_dump($sumatoriaS);
                                        $sumatoriaPagoS->close();
								}
								//Sumatoria Total de Pagos Recibidos
								$sumatoriaTotal = $sumatoria + $sumatoriaS;
								//var_dump($sumatoriaTotal);
								#EXTRAE TODA LA INFORMACIÓN PARA PRESENTARLA
								if (!empty($mes AND $year)) {
										//Consultamos lo Pagado
										$consultaPagoTotal = "SELECT * 
																FROM pagos 
																INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
																LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
																WHERE condominios.ID = '$idcondominio' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND pagos.idpropietario = '$idpropietario' 
																ORDER BY Fecha ASC";
										$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
										$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);}
								else {
										//Consultamos lo Pagado
										$consultaPagoTotal = "SELECT * 
																FROM pagos 
																INNER JOIN propietarios ON propietarios.ID = pagos.idpropietario
																LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
																WHERE condominios.ID = '$idcondominio' AND pagos.idpropietario = '$idpropietario' 
																ORDER BY Fecha ASC";
										$resultadoPagoTotal = $conexion->query($consultaPagoTotal);
										$filaPagoTotal =  $resultadoPagoTotal->fetch_array(MYSQLI_ASSOC);}

								//Ahora Vamos a construir una tabla con éstos valores
								//Va a contener #Inmueble, Nombre, Descripción, Monto?>
								<table class='table table-striped'>
								  <thead>
								    <tr>
								      <th scope='col'>#</th>
								      <th scope='col'>NOMBRE</th>
								      <th scope='col'>MONTO Bs.</th>
								      <th scope='col'>MONTO $</th>
								      <th scope='col'>BANCO</th>
								      <th scope='col'>REFERENCIA</th>
								      <th scope='col'>FECHA</th>
                                      <th scope='col'>TASA Bs.
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
											<td><?php echo number_format($value['Dolar'], 2,',','.'); ?></td>
											<td><?php echo $value['Banco']; ?></td>
											<td><?php echo $value['Referencia1'];?></td>	
											<td><?php $fecham = $value['Fecha']; echo date("d/m/Y", strtotime($fecham)); ?></td>
                                            <td><?php echo number_format($value['Tasa'], 2,',','.'); ?>
											<td style="text-align: center"><?php echo $value['Conciliado'];}
											$resultadoPagoTotal->close();
                                                ?></td>
										</tr>
									</tbody>
								</table>
								<br>
								<div class='row' id="total1">
									<div class="col-10">
									<p><b>Total Pagos Sin Conciliar:</b> Bs. <?php echo number_format($sumatoriaS, 2,',','.');?><br>
									<b>Total Pagos Conciliado:</b> Bs. <?php echo number_format($sumatoria, 2,',','.');?><br>
									<span style="font-size: 24px;"><strong>Total de Pagos Recibidos:</strong> Bs. <?php echo number_format($sumatoriaTotal, 2,',','.'); ?></span></p></div>
								</div>
					<?php } 
						 } 
							/* cerrar la conexión */
							$conexion->close();?>
						</span></p></div>
					</div>
				<footer id="pie">
					<div class="row">
						<div class="col-2"></div>
						<div class="col">
							<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
						</div>
						<div class="col">
							<p style="text-align: center;"><a href="../pagos.php"><img src="../img/caja.png" width="50px" height="70px"><br>Pagos</a></p>
						</div>
						<div class="col-2"></div>
					</div>
				</footer>
			</article>
			<article class="col-1"></article>
		</section>
	</div>
</body>
</html>