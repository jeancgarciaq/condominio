<?php  
include('../conexion.php');

//
$tasa = $_POST['tasa'];
$fecha = $_POST['fecha'];

$agregarTasa = "INSERT INTO tasa (ID, Tasa, Fecha) VALUES (null, '$tasa', '$fecha')";
$ejecutarTasa = $conexion->query($agregarTasa);

if ($ejecutarTasa) {
echo "Agregada Exitosamente, regresará a la página anterior en 5 segundos";
	}
else {
	echo 'Ha Ocurrido un Error';
	printf("Mensaje de Error: %s\n", $conexion->error);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="REFRESH"content="5;URL=../pagos.php">
	<title>Tasa</title>
	<link rel="stylesheet" href="">
</head>
<body>
	
</body>
</html>
