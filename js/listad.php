<?php 
//Conexion a la base de datos
require_once '../conexion.php';

$idcondominio = $_POST['condominio'];

	$sql = "SELECT 
			 * 
		from cxp 
		where idcondominio = '$idcondominio' AND Estado = 'ADEUDADO'";

	$result = $conexion->query($sql);

	$cadena="<label for='deuda'><i class='la la-signature'></i> Descripción</label> 
			<select class='form-select'  id='lista1' name='deuda'>
				<option value='' selected>Seleccione:</option>
			";
	while ($ver = $result->fetch_array(MYSQLI_ASSOC)) {
		$cadena=$cadena."<option value=".$ver['ID'].">".$ver['ID'].'.- '.$ver['Descripcion']."</option>";
	}

	echo  $cadena."</select>";
	
?>