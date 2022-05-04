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
require_once '../conexion.php';
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
				<table class="table table-striped tabled-hover">
					<thead>
						<tr>
							<th scope="col" width="420px" class="text-center">Descripcion</th>
							<th scope="col" width="120px" class="text-center">Monto</th>
							<th scope="col" width="120px" class="text-center">Cuota</th>
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