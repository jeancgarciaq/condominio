<?php require('conexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 3</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/line-awesome.min.css">
</head>
<body>
<!-- 
Quiero crear dos pestañas que van a mostrar los diferentes formularios, y voy a tener una hoja de resultados que mostrará la consulta que se hagan sobre la base de datos.
-->
<div class="container-fluid">
	<ul class="nav justify-content-center bg-primary">
	  <li class="nav-item">
	    <a class="nav-link active text-light border-left" href="index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link text-light border-left" href="condominio.php"><i class="las la-city"></i> Condominio</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link text-light border-left" href="propietarios.php"><i class="las la-user-alt"></i> Propietarios</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link text-light border-left" href="gastos.php"><i class="las la-file-invoice-dollar"></i> Gastos</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link text-light border-left" href="pagos.php"><i class="las la-donate"></i> Pagos</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link text-light border-left" href="avisos.php"><i class="las la-receipt"></i> Avisos</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link text-light border-left" href="cxc.php"><i class="las la-cash-register"></i> Cuentas x Cobrar</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link text-light border-left border-right" href="cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
	  </li>
	</ul>
	<h1><img src="img/obrero.png" class="img-fluid" id="iconoM3"> MÓDULO 3: PROVEEDORES</h1>
	<p class="fuente">En este módulo puede añadir, modificar, borrar o consultar los proveedores registrados actualmente.</p>
	
	<!-- Empieza las pestañas -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="editar-tab" data-toggle="tab" href="#editar" role="tab" aria-controls="editar" aria-selected="true"><i class="las la-plus"></i> <span class="pestana">Añadir</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="buscar-tab" data-toggle="tab" href="#buscar" role="tab" aria-controls="buscar" aria-selected="false"><i class="la la-search"></i> <span class="pestana">Buscar</span></a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
  	<div class="tab-pane fade show active" id="editar" role="tabpanel" 	aria-labelledby="editar-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete los datos del formulario, iniciando con el nombre y apellido del Representante de la Empresa/Servicio.</p>
  		<!--Aquí Inicia el Formulario -->
  		<section id="consultamc" class="row">
  			<article class="col-2"></article>
  			<article class="col-8">
  				<form class="mt-4" action="js/agregarproveedor.php" method="POST" accept-charset="utf-8">
	  				<div class="form-row">
					    <div class="col form-group">
					    	<label for="empresa"><i class="las la-store-alt"></i> Empresa o Profesional</label>
					      <input type="text" class="form-control" placeholder="Nombre Empresa o Profesional" name="empresa" required>
					    </div>
					    <div class="col form-group">
					    	<label for="responsable"><i class="la la-user-tie"></i> Responsable:</label>
					      <input type="text" name="responsable" class="form-control" placeholder="Persona de Contacto">
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="form-group col">
					      <label for="correo"><i class="la la-envelope-o"></i> Correo</label>
					      <input type="email" name="correo" class="form-control" id="inputCorreo" placeholder="condominio@correo.com">
					    </div>
					    <div class="form-group col">
					      <label for="condominio"><i class="la la-city"></i> Condominio</label>
					      <select class="form-control" name="condominio" required>
					        <option value="0">Seleccione:</option>
					        <?php
					          $query = $conexion -> query ("SELECT Nombre FROM condominios");
					          while ($valores = mysqli_fetch_array($query)) {
					            echo '<option value="'.$valores[Nombre].'">'.$valores[Nombre].'</option>';
					          }
					        ?>
					      </select>
					    </div>
					  </div>
					  <div class="form-row">
					  	<div class="form-group col">
					  		<label for="rif"><i class="las la-barcode"></i> Registros de Información Fiscal (RIF)</label>
					    	<input type="text" class="form-control" name="rif" placeholder="J-012345678-9">
					  	</div>
					  	<div class="form-group col">
					      <label for="telefono"><i class="la la-phone"></i> Teléfono</label>
					      <input class="form-control" type="tel" name="telefono" pattern="[+][0-9]{2}[-][0-9]{3}[-][0-9]{7}" data-toggle="tooltip" data-placement="bottom" title="Coloque el signo '+' seguido del código de país, un guión con el código de la región, un guión y el número de teléfono" placeholder="+01-012-0123456">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="direccion"><i class="la la-location-arrow"></i> Dirección</label>
					    <input type="text" class="form-control" name="direccion" placeholder="Calle o Avenida">
					  </div>
					  <div class="form-row">
					    <div class="form-group col">
					      <label for="ciudad"><i class="la la-map-marker"></i> Ciudad</label>
					      <input type="text" class="form-control" name="ciudad" placeholder="Ciudad o Población">
					    </div>
					    <div class="form-group col">
					      <label for="estado"><i class="la la-map-marked"></i> Estado</label>
					      <select name="estado" class="form-control">
					        <option selected>Carabobo</option>
					        <option>Amazonas</option>
					        <option>Anzoátegui</option>
					        <option>Apure</option>
					        <option>Aragua</option>
					        <option>Barinas</option>
					        <option>Bolívar</option>
					        <option>Cojedes</option>
					        <option>Delta Amacuro</option>
					        <option>Distrito Capital</option>
					        <option>Falcón</option>
					        <option>Guárico</option>
					        <option>Lara</option>
					        <option>Mérida</option>
					        <option>Miranda</option>
					        <option>Monagas</option>
					        <option>Nueva Esparta</option>
					        <option>Portuguesa</option>
					        <option>Sucre</option>
					        <option>Táchira</option>
					        <option>Trujillo</option>
					        <option>Vargas</option>
					        <option>Yaracuy</option>
					        <option>Zulia</option>
					      </select>
					    </div>
					  </div>
					  <p style="text-align: center;">
					  	<button type="submit" class="btn btn-lg btn-success"><i class="las la-plus"></i> Añadir</button>
					  	<button type="reset" class="btn btn-lg btn-danger"><i class="las la-eraser"></i> Reiniciar</button>	
					  </p>
					</form>
  			</article>
  			<article class="col-2"></article>
			</section>		
  	</div>
  	<div class="tab-pane fade" id="buscar" role="tabpanel" aria-labelledby="buscar-tab">
  		<div class="container-fluid">
		    <section class="row mt-4">
		        <article class="col">
		            <div class="container">
		                <form accept-charset="utf-8" action="js/bproveedor.php" method="POST">
					            <div class="form-row">
					              <div class="col">
					              	<label for="empresa"><i class="las la-store-alt"></i> Servicio</label>
					                <select class="form-control" name="proveedor" id="proveedor">
										<option value="0">Seleccione:</option>
										<option value="todos">Todos</option>
										  <?php
										    $query = $conexion -> query ("SELECT Servicio FROM proveedores");
										    while ($valores = mysqli_fetch_array($query)) {
											    echo '<option value="'.$valores[Servicio].'">'.$valores[Servicio].'</option>';}?>
									</select>
					              </div>
					              <div class="form-group col">
								      <label for="condominio"><i class="la la-city"></i> Condominio</label>
								      <select class="form-control" name="condominio" required>
								        <option value="0">Seleccione:</option>
								        <?php
								          $query = $conexion -> query ("SELECT Nombre FROM condominios");
								          while ($valores = mysqli_fetch_array($query)) {
								            echo '<option value="'.$valores[Nombre].'">'.$valores[Nombre].'</option>';
								          }
								        ?>
								      </select>
								    </div>
					             	<div class="col">
					             	<br>
					                <button type="submit" class="btn btn-primary mt-2"><i class="la la-search"></i> Buscar</button>
					              </div>
					            </div>
					          </form>         
		            </div>
		        </article>
		    </section>
		    <br><br>
		</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>