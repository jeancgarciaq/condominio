<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Actualizar Pago</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css" media="screen">
	<link rel="stylesheet" href="../css/" media="screen">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
	<!--INICIO BARRA NAVEGACIÓN -->
  <ul class="nav justify-content-center bg-primary">
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
</div>
<?php  
//Conexion a la base de datos
require_once '../conexion.php';

//id del condominio
$idcondominio = $_POST['condominio'];
//id del propietario
$idpropietario = $_POST['inmueble'];
//Fecha
$fecha = $_POST['fecha'];
//$fecha = '2020-03-12';
//Nueva Referencia
$referencia = $_POST['referencia'];

#INICIO BUSCAR TASA
$bidtasa = $conexion->query("SELECT MAX(tasaparalelo.ID) AS ID FROM tasaparalelo");
$arrayidTasa = $bidtasa->fetch_array(MYSQLI_ASSOC);
foreach ($bidtasa as $uid) {
	$id = $uid['ID'];
}

$btasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
$arrayTasa = $btasa->fetch_array(MYSQLI_ASSOC);
foreach ($btasa as $valort) {
	//$tasa = $valort['tasa']; }
	$apertura = $valort['Apertura'];
	//var_dump($apertura);
	$cierre = $valort['Cierre'];
	//var_dump($cierre);
}

//Establecer el valor de la tasa
if($cierre == 0) {
	$tasa = $apertura;
} else {
	$tasa = $cierre;
}
## FIN BUSCAR TASA


//Buscar el Nombre
$bnombre = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
$arrayNombre = $bnombre->fetch_array(MYSQLI_ASSOC);
foreach ($bnombre as $valor) {
		$nombre = $valor['Nombre'];}

if ($idcondominio == 2 OR $idcondominio == 3 OR $idcondominio == 4) { 
		//Primero Buscamos el Pago y lo Guardamos
		$consultaPago = "SELECT * FROM pagos WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
		//Ejecutamos la consulta
		$pago = $conexion->query($consultaPago);
		//Lo convertimos en un array para extraer el valor
		$fp = $pago->fetch_array(MYSQLI_ASSOC);
		//Lo guardamos en una variable
		$tp = $fp['Dolar'];
		//Necesito saber cuántos filas de deuda tengo
		$filasDeuda = "SELECT * from cxc WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
		//Ejecutamos la consulta
		$ejecutarFD = $conexion->query($filasDeuda);
		//Convertir en un array 
		$arrayD = $ejecutarFD->fetch_array(MYSQLI_ASSOC);
		//Contamos los registros
		$tr = $conexion->affected_rows;
		//Ahora Vamos a consultar el monto de la deuda
		$consultaDeuda = "SELECT SUM(Dolar) AS adeudado from cxc WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
		//Se ejecuta la consulta
		$deuda = $conexion->query($consultaDeuda);
		//Lo convertimos en un array
		$fd = $deuda->fetch_array(MYSQLI_ASSOC);
		//Lo guardamos en una variable
		$td = $fd['adeudado'];
		//Calculamos la diferencia entre lo pagado y adeudado
		$diferencia = $td - $tp;

		//INICIO DE LA COMPARACIÓN
		#CASO 1: PAGADO Y ADEUDADO ES IGUAL
		if ($tp == $td) {

			//Si son iguales voy a cambiar a todo a PAGADO
			$modificarEstado = "UPDATE cxc SET Estado = 'PAGADO', Dolar = '0.00', Monto = '0.00' WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
			//Ejecutamos la consulta
			$consultamE = $conexion->query($modificarEstado);
			//Ahora vamos a comprobar si fue exitosa la operación
			if($consultamE) {
				echo '
					<div class="container-fluid">
						<div class="alert alert-success" role="alert">
		  					<p style="text-align: center">Operación exitosa con Montos Iguales</p>
						</div>
					</div>
					';
				//Actualizamos el pago como CONCILIADO
				$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia' WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
				//Ejecutamos la consulta
				$ejecutarAct = $conexion->query($actualizarpago);
			}
			//Si no se actualiza todo a pagado, se realiza una advertencia.
			else {
				echo '
						<div class="container-fluid">
							<div class="alert alert-danger" role="alert">
			  					<p style="text-align: center">Operación errada</p>
							</div>
						</div>
					';
			}

		}
		#CASO 2: CUANDO LO PAGADO ES MAYOR A LO ADEUDADO
		elseif ($tp > $td) {
			#CASO 2.1: Cuando la Deuda es un sólo mes
			//Calculo el valor para colocar en Monto
			$diferenciam = $diferencia * $tasa;
			$diferenciar = round($diferenciam,2);
			if($tr == 1) {
				//En este caso es fácil, porque vamos cambiar a PAGADO
				$modificarEdoMonto = "UPDATE cxc SET Estado = 'PAGADO', Dolar = '$diferencia', Monto = '$diferenciar' WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
				//Ejecutar consulta
				$consultaEM = $conexion->query($modificarEdoMonto);
				//Comprobamos que se haya realizado exitosa
				if($consultaEM) {
					echo '
							<div class="container-fluid">
								<div class="alert alert-success" role="alert">
				  					<p style="text-align: center">Operación exitosa con Saldo a Favor 1 Registro</p>
								</div>
							</div>
						';
					//Actualizar el Pago
					$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia'  WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
					$ejecutarAct = $conexion->query($actualizarpago);
				}
				//Si no se ejecuta la consulta realizó una advertencia
				else {
					echo '<div class="container-fluid">
									<div class="alert alert-danger" role="alert">
					  					<p style="text-align: center">Operación errada</p>
									</div>
								</div>';
				}
			}
			#CASO 2.2: Cuando la Deuda son varios meses
			elseif ($tr > 1) {
				//Cambio el estado de los registros
				$consultaCestado = "UPDATE cxc SET Estado = 'PAGADO', Dolar = '0.00', Monto = '0.00' WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
				$ejecutarConsulta = $conexion->query($consultaCestado);
				
				//Ahora selecciono el último registro para ello consulto el ID Más Alto
				$seleccion = "SELECT MAX(cxc.ID) AS ID FROM cxc WHERE idpropietario = 'idpropietario'";
				//Ejecuto la consulta
				$consulta = $conexion->query($seleccion);
				//Lo convierto en un array
				$pruebA = $consulta->fetch_array(MYSQLI_ASSOC);
				//Extraigo el ID mediante un foreach
				foreach ($consulta as $key) {	
					//Guardo el ID como una variable
					$id = $key['ID'];
				}
				//Calculo el valor para colocar en Monto
				$diferenciam = $diferencia * $tasa;
				$diferenciar = round($diferenciam,2);
				//Ahora procedo a ejecutar la consulta
				$modificarMonto = "UPDATE cxc SET Dolar = '$diferencia', Monto = '$diferenciar', Estado = 'PAGADO' WHERE ID = '$id'";
				//Ejecuto la consulta
				$modificando = $conexion->query($modificarMonto); 
				//Verifico que la última consulta sea exitosa
				if($modificando) {
					echo '
									<div class="container-fluid">
										<div class="alert alert-success" role="alert">
						  					<p style="text-align: center">Operación exitosa con Varios Registros y Saldo a Favor</p>
										</div>
									</div>
								';
					//Actualizar el Pago
					$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia'  WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
					$ejecutarAct = $conexion->query($actualizarpago);
				}
				//En caso que no sea exitosa muestro una advertencia
				else {
					echo '<div class="container-fluid">
									<div class="alert alert-danger" role="alert">
					  					<p style="text-align: center">Operación errada</p>
									</div>
								</div>';
				}
			}
			
		}
		#CASO 2.3: Cuando el pago es menor a la deuda
		else {
			//Realizo la comprobación
			if($tp < $td) {

				//Realizo la consulta
				$seleccion = "SELECT ID, Dolar FROM cxc WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO' ORDER BY Emision ASC";

				$consulta = $conexion->query($seleccion);

				while ($fila = $consulta->fetch_array(MYSQLI_ASSOC)) {
					$id = $fila['ID'];
					$monto = $fila['Dolar'];
					if($tp > $monto) {

						$tp = $tp - $monto;
						$modificar = "UPDATE cxc SET Dolar = '0.00', Monto = '0.00', Estado = 'PAGADO' WHERE ID = '$id'";
						$ejecutar = $conexion->query($modificar);
						echo '
									<div class="container-fluid">
										<div class="alert alert-success" role="alert">
						  					<p style="text-align: center">Descuento Exitoso</p>
										</div>
									</div>'.'<br>';
					}
					else {
						
						$tp = $monto - $tp;
						//Calculo el valor para colocar en Monto
						$diferenciam = $tp * $tasa;
						$diferenciar = round($diferenciam,2);
						$modificar = "UPDATE cxc SET Dolar = '$tp', Monto = '$diferenciar' WHERE ID = '$id'";
						$ejecutar = $conexion->query($modificar);
						echo '
									<div class="container-fluid">
										<div class="alert alert-success" role="alert">
						  					<p style="text-align: center">Pago Exitoso</p>
										</div>
									</div>'.'<br>';
						//Actualizar el Pago
						$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia' WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
						$ejecutarAct = $conexion->query($actualizarpago);
						//Resolver los qué están en 0.00 y Adeudado
						//Se realiza la consulta
						$adeudadoCero = $conexion->query("UPDATE cxc SET Estado = 'PAGADO' WHERE Dolar = '0.00' AND Estado = 'ADEUDADO' AND idpropietario = '$idpropietario'");
						break;
					}
				}
			}
			else {

				echo '<div class="container-fluid">
								<div class="alert alert-danger" role="alert">
				  					<p style="text-align: center">Esto es una locura</p>
								</div>
							</div>'.'<br>';
			}
		}
}
	
## INICIO CONDOMINIO BUCARE
	
elseif ($idcondominio == 1) {
	
				//Primero Buscamos el Pago y lo Guardamos
		$consultaPago = "SELECT * FROM pagos WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
		//Ejecutamos la consulta
		$pago = $conexion->query($consultaPago);
		//Lo convertimos en un array para extraer el valor
		$fp = $pago->fetch_array(MYSQLI_ASSOC);
		//Lo guardamos en una variable
		$tp = $fp['Monto'];
		//Necesito saber cuántos filas de deuda tengo
		$filasDeuda = "SELECT * from cxc WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
		//Ejecutamos la consulta
		$ejecutarFD = $conexion->query($filasDeuda);
		//Convertir en un array 
		$arrayD = $ejecutarFD->fetch_array(MYSQLI_ASSOC);
		//Contamos los registros
		$tr = $conexion->affected_rows;
		//Ahora Vamos a consultar el monto de la deuda
		$consultaDeuda = "SELECT SUM(Monto) AS adeudado from cxc WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
		//Se ejecuta la consulta
		$deuda = $conexion->query($consultaDeuda);
		//Lo convertimos en un array
		$fd = $deuda->fetch_array(MYSQLI_ASSOC);
		//Lo guardamos en una variable
		$td = $fd['adeudado'];
		//Calculamos la diferencia entre lo pagado y adeudado
		$diferencia = $td - $tp;

		//INICIO DE LA COMPARACIÓN
		#CASO 1: PAGADO Y ADEUDADO ES IGUAL
		if ($tp == $td) {

			//Si son iguales voy a cambiar a todo a PAGADO
			$modificarEstado = "UPDATE cxc SET Estado = 'PAGADO', Monto = '0.00' WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
			//Ejecutamos la consulta
			$consultamE = $conexion->query($modificarEstado);
			//Ahora vamos a comprobar si fue exitosa la operación
			if($consultamE) {
				echo '
					<div class="container-fluid">
						<div class="alert alert-success" role="alert">
		  					<p style="text-align: center">Operación exitosa con Montos Iguales</p>
						</div>
					</div>
					';
				//Actualizamos el pago como CONCILIADO
				$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia' WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
				//Ejecutamos la consulta
				$ejecutarAct = $conexion->query($actualizarpago);
			}
			//Si no se actualiza todo a pagado, se realiza una advertencia.
			else {
				echo '
						<div class="container-fluid">
							<div class="alert alert-danger" role="alert">
			  					<p style="text-align: center">Operación errada</p>
							</div>
						</div>
					';
			}

		}
		#CASO 2: CUANDO LO PAGADO ES MAYOR A LO ADEUDADO
		elseif ($tp > $td) {
			#CASO 2.1: Cuando la Deuda es un sólo mes
			if($tr == 1) {
				//En este caso es fácil, porque vamos cambiar a PAGADO
				$modificarEdoMonto = "UPDATE cxc SET Estado = 'PAGADO', Monto = '$diferencia' WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
				//Ejecutar consulta
				$consultaEM = $conexion->query($modificarEdoMonto);
				//Comprobamos que se haya realizado exitosa
				if($consultaEM) {
					echo '
							<div class="container-fluid">
								<div class="alert alert-success" role="alert">
				  					<p style="text-align: center">Operación exitosa con Saldo a Favor 1 Registro</p>
								</div>
							</div>
						';
					//Actualizar el Pago
					$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia'  WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
					$ejecutarAct = $conexion->query($actualizarpago);
				}
				//Si no se ejecuta la consulta realizó una advertencia
				else {
					echo '<div class="container-fluid">
									<div class="alert alert-danger" role="alert">
					  					<p style="text-align: center">Operación errada</p>
									</div>
								</div>';
				}
			}
			#CASO 2.2: Cuando la Deuda son varios meses
			elseif ($tr > 1) {
				//Cambio el estado de los registros
				$consultaCestado = "UPDATE cxc SET Estado = 'PAGADO', Monto = '0.00' WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO'";
				$ejecutarConsulta = $conexion->query($consultaCestado);
				
				//Ahora selecciono el último registro para ello consulto el ID Más Alto
				$seleccion = "SELECT MAX(cxc.ID) AS ID FROM cxc WHERE idpropietario = 'idpropietario'";
				//Ejecuto la consulta
				$consulta = $conexion->query($seleccion);
				//Lo convierto en un array
				$pruebA = $consulta->fetch_array(MYSQLI_ASSOC);
				//Extraigo el ID mediante un foreach
				foreach ($consulta as $key) {	
					//Guardo el ID como una variable
					$id = $key['ID'];
				}
				//Ahora procedo a ejecutar la consulta
				$modificarMonto = "UPDATE cxc SET Monto = '$diferencia', Estado = 'PAGADO' WHERE ID = '$id'";
				//Ejecuto la consulta
				$modificando = $conexion->query($modificarMonto); 
				//Verifico que la última consulta sea exitosa
				if($modificando) {
					echo '
									<div class="container-fluid">
										<div class="alert alert-success" role="alert">
						  					<p style="text-align: center">Operación exitosa con Varios Registros y Saldo a Favor</p>
										</div>
									</div>
								';
					//Actualizar el Pago
					$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia'  WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
					$ejecutarAct = $conexion->query($actualizarpago);
				}
				//En caso que no sea exitosa muestro una advertencia
				else {
					echo '<div class="container-fluid">
									<div class="alert alert-danger" role="alert">
					  					<p style="text-align: center">Operación errada</p>
									</div>
								</div>';
				}
			}
			
		}
		#CASO 2.3: Cuando el pago es menor a la deuda
		else {
			//Realizo la comprobación
			if($tp < $td) {

				//Realizo la consulta
				$seleccion = "SELECT ID, Monto FROM cxc WHERE idpropietario = '$idpropietario' AND Estado = 'ADEUDADO' ORDER BY Emision ASC";

				$consulta = $conexion->query($seleccion);

				while ($fila = $consulta->fetch_array(MYSQLI_ASSOC)) {
					$id = $fila['ID'];
					$monto = $fila['Monto'];
					if($tp > $monto) {

						$tp = $tp - $monto;
						$modificar = "UPDATE cxc SET Monto = '0.00', Estado = 'PAGADO' WHERE ID = '$id'";
						$ejecutar = $conexion->query($modificar);
						echo '
									<div class="container-fluid">
										<div class="alert alert-success" role="alert">
						  					<p style="text-align: center">Descuento Exitoso</p>
										</div>
									</div>'.'<br>';
					}
					else {
						
						$tp = $monto - $tp;
						$modificar = "UPDATE cxc SET Monto = '$tp' WHERE ID = '$id'";
						$ejecutar = $conexion->query($modificar);
						echo '
									<div class="container-fluid">
										<div class="alert alert-success" role="alert">
						  					<p style="text-align: center">Pago Exitoso</p>
										</div>
									</div>'.'<br>';
						//Actualizar el Pago
						$actualizarpago = "UPDATE pagos SET Conciliado = 'SI', Referencia2 = '$referencia' WHERE idpropietario = '$idpropietario' AND Fecha = '$fecha' AND Conciliado = 'NO'";
						$ejecutarAct = $conexion->query($actualizarpago);
						//Resolver los qué están en 0.00 y Adeudado
						//Se realiza la consulta
						$adeudadoCero = $conexion->query("UPDATE cxc SET Estado = 'PAGADO' WHERE Monto = '0.00' AND Estado = 'ADEUDADO' AND idpropietario = '$idpropietario'");
						break;
					}
				}
			}
			else {

				echo '<div class="container-fluid">
								<div class="alert alert-danger" role="alert">
				  					<p style="text-align: center">Esto es una locura</p>
								</div>
							</div>'.'<br>';
			}
		}
	}	

## FIN CONDOMINIO BUCARE
else {

		echo 'No existe el condominio';
		
	}


?>
	<header id="header" class="">
		<div class="row">
			<div class="col-6"></div>
			<div class="col-1">
				<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
			</div>
			<div class="col-1">
				<p style="text-align: center;"><a href="../pagos.php"><img src="../img/caja.png" width="50px" height="70px"><br>Pagos</a></p>
			</div>
			<div class="col-4"></div>
		</div>
	</header>
</body>
</html>