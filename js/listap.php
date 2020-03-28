<?php 
include '../conexion.php';

$condominio=$_POST['condominio'];

	$sql="SELECT 
			 * 
		from proveedores 
		where Condominio ='$condominio'";

	$result=$conexion->query($sql);

	$cadena="<label for='proveedor'><i class='la la-signature'></i> Nombre</label> 
			<select class='form-control'  id='lista2' name='proveedor'>
				<option value='' selected>Seleccione:</option>
				<option value='todos'>Todos</option>
			";
	while ($ver= $result->fetch_array(MYSQLI_ASSOC)) {
		$cadena=$cadena."<option value=".$ver['Servicio'].">".$ver['Servicio']."</option>";
	}

	echo  $cadena."</select>";
	
?>