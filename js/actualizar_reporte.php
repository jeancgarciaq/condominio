<?php 
require_once '../conexion.php';

//INICIO ACTUALIZAR DOLAR
$seleccion = "SELECT idpropietario, Dolar, MONTH(Emision) 
              FROM cxc 
              INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
              LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
              WHERE condominios.ID = 2
              ORDER BY MONTH(Emision) ASC";
$ejecutarSd = $conexion->query($seleccion);

while($fila = $ejecutarSd->fetch_array(MYSQLI_ASSOC)) {
	$monto = $fila['Dolar'];
	$mes = $fila['MONTH(Emision)'];
	$idpropietario = $fila['idpropietario'];
	if ($mes == 1) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Enero = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
				//Si no se ejecuta la consulta realizó una advertencia
		else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
	elseif($mes == 2) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Febrero = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
				//Si no se ejecuta la consulta realizó una advertencia
		else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
	elseif($mes == 3) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Marzo = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
				//Si no se ejecuta la consulta realizó una advertencia
		else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
	elseif($mes == 4) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
		//Si no se ejecuta la consulta realizó una advertencia
		else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
	elseif($mes == 5) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
				//Si no se ejecuta la consulta realizó una advertencia
				else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
	elseif($mes == 6) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
				//Si no se ejecuta la consulta realizó una advertencia
				else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
	else {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Anterior = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
				//Si no se ejecuta la consulta realizó una advertencia
		else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
		echo '<h2>FIN ACTUALIZACIÓN MONTO DÓLAR</h2>';
}

//ACTUALIZACION BOLIVARES
$seleccionM = $conexion->query("SELECT idpropietario, Monto, MONTH(Emision) 
              FROM cxc 
              INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
              LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
              WHERE condominios.ID = 1
              ORDER BY MONTH(Emision) ASC");

while($fila = $seleccionM->fetch_array(MYSQLI_ASSOC)) {
	$monto = $fila['Monto'];
	$mes = $fila['MONTH(Emision)'];
	$idpropietario = $fila['idpropietario'];
	if ($mes == 1) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Enero = '$monto' WHERE idpropietario = '$idpropietario'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Operación exitosa</p>
					</div>
				</div>';}
				//Si no se ejecuta la consulta realizó una advertencia
		else {
			echo '<div class="container-fluid">
					<div class="alert alert-danger" role="alert">
						<p style="text-align: center">Operación errada</p>
					</div>
				</div>';}
			}
		elseif($mes == 2) {
			$modificarEdoMonto = "UPDATE reporte_cxc SET Febrero = '$monto' WHERE idpropietario = '$idpropietario'";
			//Ejecutar consulta
			$consultaEM = $conexion->query($modificarEdoMonto);
			//Comprobamos que se haya realizado exitosa
			if($consultaEM) {
				echo '
					<div class="container-fluid">
						<div class="alert alert-success" role="alert">
							<p style="text-align: center">Operación exitosa</p>
						</div>
					</div>';}
					//Si no se ejecuta la consulta realizó una advertencia
			else {
				echo '<div class="container-fluid">
						<div class="alert alert-danger" role="alert">
							<p style="text-align: center">Operación errada</p>
						</div>
					</div>';}
			}
		elseif($mes == 3) {
			$modificarEdoMonto = "UPDATE reporte_cxc SET Marzo = '$monto' WHERE idpropietario = '$idpropietario'";
			//Ejecutar consulta
			$consultaEM = $conexion->query($modificarEdoMonto);
			//Comprobamos que se haya realizado exitosa
			if($consultaEM) {
				echo '
					<div class="container-fluid">
						<div class="alert alert-success" role="alert">
							<p style="text-align: center">Operación exitosa</p>
						</div>
					</div>';}
					//Si no se ejecuta la consulta realizó una advertencia
			else {
				echo '<div class="container-fluid">
						<div class="alert alert-danger" role="alert">
							<p style="text-align: center">Operación errada</p>
						</div>
					</div>';}
				}
		elseif($mes == 4) {
			$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE idpropietario = '$idpropietario'";
			//Ejecutar consulta
			$consultaEM = $conexion->query($modificarEdoMonto);
			//Comprobamos que se haya realizado exitosa
			if($consultaEM) {
				echo '
					<div class="container-fluid">
						<div class="alert alert-success" role="alert">
							<p style="text-align: center">Operación exitosa</p>
						</div>
					</div>';}
					//Si no se ejecuta la consulta realizó una advertencia
			else {
				echo '<div class="container-fluid">
						<div class="alert alert-danger" role="alert">
							<p style="text-align: center">Operación errada</p>
						</div>
					</div>';}
				}
			elseif($mes == 5) {
			$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE idpropietario = '$idpropietario'";
			//Ejecutar consulta
			$consultaEM = $conexion->query($modificarEdoMonto);
			//Comprobamos que se haya realizado exitosa
			if($consultaEM) {
				echo '
					<div class="container-fluid">
						<div class="alert alert-success" role="alert">
							<p style="text-align: center">Operación exitosa</p>
						</div>
					</div>';}
					//Si no se ejecuta la consulta realizó una advertencia
			else {
				echo '<div class="container-fluid">
						<div class="alert alert-danger" role="alert">
							<p style="text-align: center">Operación errada</p>
						</div>
					</div>';}
				}
			elseif($mes == 6) {
			$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE idpropietario = '$idpropietario'";
			//Ejecutar consulta
			$consultaEM = $conexion->query($modificarEdoMonto);
			//Comprobamos que se haya realizado exitosa
			if($consultaEM) {
				echo '
					<div class="container-fluid">
						<div class="alert alert-success" role="alert">
							<p style="text-align: center">Operación exitosa</p>
						</div>
					</div>';}
					//Si no se ejecuta la consulta realizó una advertencia
			else {
				echo '<div class="container-fluid">
						<div class="alert alert-danger" role="alert">
							<p style="text-align: center">Operación errada</p>
						</div>
					</div>';}
				}
			else {
		
				$modificarEdoMonto = "UPDATE reporte_cxc SET Anterior = '$monto' WHERE idpropietario = '$idpropietario'";
				//Ejecutar consulta
				$consultaEM = $conexion->query($modificarEdoMonto);
				//Comprobamos que se haya realizado exitosa
				if($consultaEM) {
					echo '
						<div class="container-fluid">
							<div class="alert alert-success" role="alert">
								<p style="text-align: center">Operación exitosa</p>
							</div>
						</div>';}
						//Si no se ejecuta la consulta realizó una advertencia
				else {
					echo '<div class="container-fluid">
							<div class="alert alert-danger" role="alert">
								<p style="text-align: center">Operación errada</p>
							</div>
						</div>';}
					}
				echo '<h2>FIN ACTUALIZACIÓN MONTO BOLÍVARES</h2>';
	}
echo "Haz clic para: <a href='../cxc.php'>Redirigir a Cuentas por Cobrar</a>";
?>