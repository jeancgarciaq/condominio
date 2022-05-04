<?php 
//Conexion a la base de datos
require_once '../conexion.php';

$idcondominio = $_POST['condominio'];

	$sql = "SELECT 
			 * 
		from propietarios 
		where idcondominio = '$idcondominio' ORDER BY Inmueble ASC";

	$result = $conexion->query($sql);

	$cadena="<label for='inmueble'><i class='la la-signature'></i> Nombre</label> 
			<select class='form-select'  id='lista2' name='inmueble'>
				<option value='' selected>Seleccione:</option>
				<option value='todos'>Todos</option>
			";
	while ($ver = $result->fetch_array(MYSQLI_ASSOC)) {
		$cadena=$cadena."<option value=".$ver['ID'].">".$ver['Inmueble'].'.- '.$ver['Nombre']."</option>";
	}

	echo  $cadena."</select>";
	
?>