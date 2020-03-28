<?php 
include ('../conexion.php');

$seleccion = "SELECT Nombre, Condominio FROM propietarios ORDER BY Nombre ASC";
$ejecutarS = $conexion->query($seleccion);

while($fila = $ejecutarS->fetch_array(MYSQLI_ASSOC)) {
	
	$condominio = $fila['Condominio'];
	$nombre = $fila['Nombre'];
	
		$modificarEdoMonto = "UPDATE reporte_cxc SET Condominio = '$condominio' WHERE Propietario = '$nombre'";
		//Ejecutar consulta
		$consultaEM = $conexion->query($modificarEdoMonto);
		//Comprobamos que se haya realizado exitosa
		if($consultaEM) {
			echo '
				<div class="container-fluid">
					<div class="alert alert-success" role="alert">
						<p style="text-align: center">Se agregaron los Condominios Exitosamente</p>
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
?>