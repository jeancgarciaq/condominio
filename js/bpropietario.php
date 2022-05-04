<?php  
//Conexión a la base de datos
require_once '../conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 2</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/line-awesome.min.css">
</head>
<body>
	<div class="container-fluid">
		<!-- INICIO MENÚ NAV -->
		<ul class="nav justify-content-center bg-primary">
		  <li class="nav-item">
		    <a class="nav-link active text-light border-left" href="../index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-light border-left" href="../condominio.php"><i class="las la-city"></i> Condominio</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-light border-left" href="../proveedores.php"><i class="las la-store-alt"></i> Proveedores</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-light border-left" href="../gastos.php"><i class="las la-file-invoice-dollar"></i> Gastos</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-light border-left" href="../pagos.php"><i class="las la-donate"></i> Pagos</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-light border-left" href="../avisos.php"><i class="las la-receipt"></i> Avisos</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-light border-left" href="../cxc.php"><i class="las la-cash-register"></i> Cuentas x Cobrar</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link text-light border-left border-right" href="../cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
		  </li>
		</ul>
		<!-- FIN MENÚ NAV-->
		<h1><img src="../img/trabajo-en-equipo.png" class="img-fluid" width="10%" height="10%"> MÓDULO 2: PROPIETARIOS</h1><br>
		<section class="row">
			<article class="col-1"></article>
			<article class="col">
				<h2>DATOS PERSONALES</h2>
				<?php
				//Número de Inmueble
				$idpropietario = $_POST['inmueble'];
				//var_dump($idpropietario);
				//Condominio
				$idcondominio = $_POST['condominio'];
				//var_dump($idcondominio);
				
				//Si selecciono todos
				
				if($idpropietario == 'todos') {
					  $nombre = 'Todos';
					} else {
					  $buscarNombre = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
					  $arrayNombre = $buscarNombre->fetch_array(MYSQLI_ASSOC);
					  foreach($buscarNombre as $nombreP) {
					    $nombre = $nombreP['Nombre'];
					  } 
					}

					if($nombre == 'todos') {
					    //Buscar nombre del Condominio
					    $buscarCondominio = $conexion->query("SELECT * FROM condominios WHERE ID = '$idcondominio'");
					    $arrayCondominio = $buscarCondominio->fetch_array(MYSQLI_ASSOC);
					    foreach ($buscarCondominio as $filaC) {
					      	$nombreCondominio = $filaC['NombreC'];}

					    //Identificación?>
					    <p><b><i class="las la-user-alt"></i> Propietario:</b> <?php echo strtoupper($nombre); ?></p>
					    <p><b><i class="la la-home"></i> Inmueble Nº:</b> PB</p>
					    <p><b><i class="la la-city"></i> Condominio:</b> <?php echo $nombreCondominio; ?></p>
					    <br>
					    <table class='table table-striped'>
					            <thead>
					              <tr>
					                <th scope='col'>Nº</th>
					                <th scope='col'>NOMBRE</th>
					                <th scope='col'>CORREO</th>
					                <th scope='col'>TELÉFONO</th>
					              </tr>
					            </thead>
					            <tbody>
					<?php
					    //Buscar todos los propietarios
					    $buscarPropietarios = $conexion->query("SELECT * 
					    										FROM propietarios 
					    										WHERE idcondominio = '$idcondominio'");
					    while($filaPropietario = $buscarPropietarios->fetch_array(MYSQLI_ASSOC)) {?>
					      <!--Se construye la tabla para mostrar los resultados -->
					              <tr>
					                <td><?php echo $filaPropietario['Inmueble'];?></td>
					                <td><?php echo $filaPropietario['Nombre'];?></td>
					                <td><?php echo $filaPropietario['Correo'];?></td>
					                <td><?php echo $filaPropietario['Telefono'];} ?></td>
					              </tr>
					            </tbody>
					          </table>
					<?php    }
					//Fin IF TODOS
					else {
						//Buscar nombre del Condominio
					    $buscarCondominio = $conexion->query("SELECT * FROM condominios WHERE ID = '$idcondominio'");
					    while($filaCondominio = $buscarCondominio->fetch_array(MYSQLI_ASSOC)) {
					      $nombreCondominio = $filaCondominio['NombreC'];
					    }
					    //Identificación?>
					    <h3><b><i class="la la-city"></i> Condominio:</b> <?php echo $nombreCondominio; ?></h3>
					    <br>
					<?php
					    //Vamos a Realizar la Consulta
					    $buscarPropietario = $conexion->query("SELECT *
					    										FROM propietarios 
					    										WHERE ID = '$idpropietario'");
					    $arrayPropietario = $buscarPropietario->fetch_array(MYSQLI_ASSOC);

					    foreach ($buscarPropietario as $fila) {?>
					    <!-- VOY A CONSTRUIR UNA HOJA CON LOS DATOS DEL PROPIETARIO -->
					    <div class="row">
					      <div class="col"></div>
					      <div class="col">
					        <strong><i class="las la-user-alt"></i> Propietario:</strong> <?php echo $fila['Nombre'];?><br>
					        <strong><i class="la la-home"></i> Inmueble Nº:</strong> <?php echo $fila['Inmueble']; ?><br>
					        <strong><i class="las la-envelope"></i> Correo:</strong> <?php echo $fila['Correo']; ?><br>
					        <strong><i class="las la-phone"></i> Teléfono:</strong> <?php echo $fila['Telefono'];} }?></div>
					      <div class="col"></div>
					    </div>
				</article>
				<article class="col-3"></article>
				<footer class="container-fluid">
					<div class="row">
						<div class="col-2"></div>
						<div class="col">
							<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
						</div>
						<div class="col">
							<p style="text-align: center;"><a href="../propietarios.php"><img src="../img/trabajo-en-equipo.png" width="50px" height="70px"><br>Propietarios</a></p>
						</div>
						<div class="col"></div>
					</div>
				</footer>
		</section>
	</div>
</body>
</html>