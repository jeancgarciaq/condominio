<?php 
include '../conexion.php';

$condominio=$_POST['condominio'];

	$sql="SELECT 
			 * 
		from propietarios 
		where Condominio ='$condominio'";

	$result=$conexion->query($sql);

	$cadena="<label for='nombre'><i class='la la-signature'></i> Nombre</label> 
			<select class='form-control'  id='lista2' name='inmueble'>
				<option value='' selected>Seleccione:</option>
				<option value='todos'>Todos</option>
			";
	while ($ver= $result->fetch_array(MYSQLI_ASSOC)) {
		$cadena=$cadena."<option value=".$ver['Numero'].">".$ver['Numero'].'.- '.$ver['Nombre']."</option>";
	}

	echo  $cadena."</select>";
	
?>