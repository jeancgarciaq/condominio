<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agregar Gasto</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link href="../css/line-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php 
//Incluyo la base de datos
include '../conexion.php';
//Condominio
$condominio = 'Edificio Bucare';
//$condominio = $_POST['condominio']
//Mes de Cobranza
$mes = 03;
//Vamos a consultar todos los gastos
$bgastos = $conexion->query("SELECT * FROM gastos WHERE Condominio = '$condominio' AND MONTH(Fecha) = '$mes'");
	//Los voy poner en una tabla
?>
<div class="container">
	<div class="row">
		<div class="col-1"></div>
		<div class="col">
			<div class="container-fluid">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col" width="420px" style="text-align: center;">Descripcion</th>
							<th scope="col" width="120px" style="text-align: center;">Monto</th>
							<th scope="col" width="120px" style="text-align: center;">Cuota</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($fila = $bgastos->fetch_array(MYSQLI_ASSOC)){?>
						<tr>
							<td width="200px"><?php echo $fila['Descripcion'];?></td>
							<td style="text-align: right;" width="120px"><?php echo number_format($fila['Monto'], 2, ',', '.');?></td>
							<td style="text-align: right;" width="120px"><?php $alicuota = $fila['Monto'] * 0.156;
							echo number_format($alicuota, 2, ',', '.');}?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-1"></div> 
	</div>
</div>
<?php
//Se ejecuta el siguiente script
//Contamos los propietarios
//$tr = $conexion->affected_rows;

/* Formato para la Alicuota 
$alicuota = number_format($alicuota, 2,',','.');
echo $alicuota ."%";*/
			
	$conexion->close();

?>
</body>
</html>