<?php 
include ('../conexion.php');

$seleccion = "SELECT Nombre, Dolar, MONTH(Emision) FROM cxc ORDER BY MONTH(Emision) ASC";
$ejecutarS = $conexion->query($seleccion);

while($fila = $ejecutarS->fetch_array(MYSQLI_ASSOC)) {
	$monto = $fila['Dolar'];
	$mes = $fila['MONTH(Emision)'];
	$nombre = $fila['Nombre'];
	if ($mes == 1) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Enero = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Res. San Francisco'";
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
		$modificarEdoMonto = "UPDATE reporte_cxc SET Febrero = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Res. San Francisco'";
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
		$modificarEdoMonto = "UPDATE reporte_cxc SET Marzo = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Res. San Francisco'";
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
		$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Res. San Francisco'";
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
		
		$modificarEdoMonto = "UPDATE reporte_cxc SET Anterior = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Res. San Francisco'";
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
}

//CONDOMINIO BUCARE
$seleccion = "SELECT Nombre, Monto, MONTH(Emision) FROM cxc ORDER BY MONTH(Emision) ASC";
$ejecutarS = $conexion->query($seleccion);

while($fila = $ejecutarS->fetch_array(MYSQLI_ASSOC)) {
	$monto = $fila['Dolar'];
	$mes = $fila['MONTH(Emision)'];
	$nombre = $fila['Nombre'];
	if ($mes == 1) {
		$modificarEdoMonto = "UPDATE reporte_cxc SET Enero = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Edificio Bucare'";
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
			$modificarEdoMonto = "UPDATE reporte_cxc SET Febrero = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Edificio Bucare'";
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
			$modificarEdoMonto = "UPDATE reporte_cxc SET Marzo = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Edificio Bucare'";
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
			$modificarEdoMonto = "UPDATE reporte_cxc SET Abril = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Edificio Bucare'";
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
		
				$modificarEdoMonto = "UPDATE reporte_cxc SET Anterior = '$monto' WHERE Propietario = '$nombre' AND Condominio = 'Edificio Bucare'";
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
	}
?>