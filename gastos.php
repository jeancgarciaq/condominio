<?php require('conexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 4</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/line-awesome.min.css">
	<script	src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<!--INICIO BARRA NAVEGACIÓN -->
  <ul class="nav justify-content-center bg-primary">
    <li class="nav-item">
      <a class="nav-link active text-light border-start border-white" href="index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="condominio.php"><i class="las la-city"></i> Condominio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="propietarios.php"><i class="las la-user-alt"></i> Propietarios</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="proveedores.php"><i class="las la-store-alt"></i> Proveedores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="pagos.php"><i class="las la-donate"></i> Pagos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="gastos.php"><i class="las la-file-invoice-dollar"></i> Gastos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="avisos.php"><i class="las la-receipt"></i> Avisos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="cxc.php"><i class="las la-cash-register"></i> Cuentas x Cobrar</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white border-end" href="cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
    </li>
  </ul>
  <!--FIN BARRA NAVEGACIÓN -->
	<h1><img src="img/negocios-y-finanzas.png" class="img-fluid" id="iconoM4"> MÓDULO 4: GASTOS</h1>
	<p class="fuente">En este módulo puede añadir, modificar, borrar o consultar los gastos mensuales por condominio.</p>
	
	<!-- Empieza las pestañas -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="editar-tab" data-bs-toggle="tab" href="#editar" role="tab" aria-controls="editar" aria-selected="true"><i class="la la-pen"></i> <span class="pestana">Añadir</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="cuota-tab" data-bs-toggle="tab" href="#cuota" role="tab" aria-controls="cuota" aria-selected="true"><i class="las la-piggy-bank"></i> <span class="pestana">Cuota</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="cuotaespecial-tab" data-bs-toggle="tab" href="#cuotaespecial" role="tab" aria-controls="cuotaespecial" aria-selected="true"><i class="las la-piggy-bank"></i> <span class="pestana">Cuota Especial</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="buscar-tab" data-bs-toggle="tab" href="#buscar" role="tab" aria-controls="buscar" aria-selected="false"><i class="la la-search"></i> <span class="pestana">Buscar</span></a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
  	<div class="tab-pane fade show active" id="editar" role="tabpanel" 	aria-labelledby="editar-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete todos los datos del formulario.</p>
  		<!--Aquí Inicia el Formulario -->
  		<section id="consultamc" class="row">
  			<article class="col-2"></article>
  			<article class="col-8">
  				<form action="js/agregargasto.php" method="post" accept-charset="utf-8">
  					<div class="row input-group">
  						<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id='lista1' class="form-select" name="condominio" required>
									<option value="" selected>Seleccione:</option>
									<?php
									    $query = $conexion->query ("SELECT * FROM condominios");
									    while ($valores = mysqli_fetch_array($query)) {
									        echo '<option value='.$valores[ID].'>'.$valores[NombreC].'</option>';}?>
								</select>
							</div>
	  					<div class="col">
	  						<label for="comprobante"><i class="las la-cash-register"></i> Nº Comprobante:</label>
	  						<input class="form-control" type="text" name="comprobante" value="" placeholder="Número Comprobante Egreso">
	  					</div>
	  					<div class="col">
								<label for="monto"><i class="las la-coins"></i> Monto Bs.:</label>
	  						<input class="form-control" type="number" name="monto" step="any" placeholder="123456789.00">
	  					</div>
	  					<div class="col">
								<label for="montod"><i class="las la-coins"></i> Monto $:</label>
	  						<input class="form-control" type="number" name="montod" step="any" placeholder="123456789.00">
	  					</div>
						</div>
						<div class="row input-group">
	  					<div class="col-8">
								<label for="descripcion"><i class="las la-file-alt"></i> Descripción:</label>
								<textarea class="form-control" name="descripcion"></textarea>
							</div>
	  					<div class="col-4">
								<label for="fecha"><i class="las la-calendar"></i> Fecha:</label>
								<input class="form-control" type="date" name="fecha" value="" placeholder="">
						</div>
						<!--<div class="col-2">
							<label for="fecha"><i class="las la-question-circle"></i> ¿CxP?</label>
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" name="cxp" value="No" id="flexCheckDefault">
							  <label class="form-check-label" for="flexCheckDefault">
							    Si
							  </label>
							</div>
						</div>-->
  					</div><br>
  					<!-- Botones -->
  					<p style="text-align: center;">
					  	<button type="submit" class="btn btn-lg btn-success"><i class="las la-plus"></i> Añadir</button>
					  	<button type="reset" class="btn btn-lg btn-danger"><i class="las la-eraser"></i> Reiniciar</button>	
					  </p>
  				</form>
  			</article>
  			<article class="col-2"></article>
		</section>		
  	</div>
  	<div class="tab-pane fade" id="cuota" role="tabpanel" 	aria-labelledby="cuota-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete todos los datos del formulario.</p>
  		<!--Aquí Inicia el Formulario -->
  		<section class="row">
  			<article class="col-2"></article>
  			<article class="col-8">
  				<form action="js/agregarcuota.php" method="post" accept-charset="utf-8">
  					<div class="row input-group">
  						<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id='lista2' class="form-select" name="condominio" required>
									<option value="" selected>Seleccione:</option>
									<?php
									    $query = $conexion->query ("SELECT * FROM condominios");
									    while ($valores = mysqli_fetch_array($query)) {
									        echo '<option value='.$valores[ID].'>'.$valores[NombreC].'</option>';}?>
								</select>
							</div>
	  					<div class="col">
	  						<label for="comprobante"><i class="las la-cash-register"></i> Nº Comprobante:</label>
	  						<input class="form-control" type="text" name="comprobante" value="" placeholder="Número Comprobante Egreso">
	  					</div>
	  					<div class="col">
								<label for="monto"><i class="las la-coins"></i> Monto Bs.:</label>
	  						<input class="form-control" type="number" name="monto" step="any" placeholder="123456789.00">
	  					</div>
	  					<div class="col">
								<label for="montod"><i class="las la-coins"></i> Monto $:</label>
	  						<input class="form-control" type="number" name="montod" step="any" placeholder="123456789.00">
	  					</div>
						</div>
						<div class="row input-group">
	  					<div class="col-8">
								<label for="descripcion"><i class="las la-file-alt"></i> Descripción:</label>
								<textarea class="form-control" name="descripcion"></textarea>
							</div>
	  					<div class="col-4">
								<label for="fecha"><i class="las la-calendar"></i> Fecha:</label>
								<input class="form-control" type="date" name="fecha" value="" placeholder="">
							</div>
  					</div><br>
  					<!-- Botones -->
  					<p style="text-align: center;">
					  	<button type="submit" class="btn btn-lg btn-success"><i class="las la-plus"></i> Añadir</button>
					  	<button type="reset" class="btn btn-lg btn-danger"><i class="las la-eraser"></i> Reiniciar</button>	
					  </p>
  				</form>
  			</article>
  			<article class="col-2"></article>
		</section>		
  	</div>
  	<div class="tab-pane fade" id="cuotaespecial" role="tabpanel" 	aria-labelledby="cuotaespecial-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete todos los datos del formulario.</p>
  		<!--Aquí Inicia el Formulario -->
  		<section class="row">
  			<article class="col-2"></article>
  			<article class="col-8">
  				<form action="js/agregarcuotaespecial.php" method="post" accept-charset="utf-8">
  					<div class="row input-group">
  						<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id='lista2' class="form-select" name="condominio" required>
									<option value="" selected>Seleccione:</option>
									<?php
									    $query = $conexion->query ("SELECT * FROM condominios");
									    while ($valores = mysqli_fetch_array($query)) {
									        echo '<option value='.$valores[ID].'>'.$valores[NombreC].'</option>';}?>
								</select>
							</div>
	  					<div class="col">
	  						<label for="comprobante"><i class="las la-cash-register"></i> Nº Comprobante:</label>
	  						<input class="form-control" type="text" name="comprobante" value="" placeholder="Número Comprobante Egreso">
	  					</div>
	  					<div class="col">
								<label for="monto"><i class="las la-coins"></i> Monto Bs.:</label>
	  						<input class="form-control" type="number" name="monto" step="any" placeholder="123456789.00">
	  					</div>
	  					<div class="col">
								<label for="montod"><i class="las la-coins"></i> Monto $:</label>
	  						<input class="form-control" type="number" name="montod" step="any" placeholder="123456789.00">
	  					</div>
						</div>
						<div class="row input-group">
	  					<div class="col-8">
								<label for="descripcion"><i class="las la-file-alt"></i> Descripción:</label>
								<textarea class="form-control" name="descripcion"></textarea>
							</div>
	  					<div class="col-4">
								<label for="fecha"><i class="las la-calendar"></i> Fecha:</label>
								<input class="form-control" type="date" name="fecha" value="" placeholder="">
							</div>
  					</div><br>
  					<!-- Botones -->
  					<p style="text-align: center;">
					  	<button type="submit" class="btn btn-lg btn-success"><i class="las la-plus"></i> Añadir</button>
					  	<button type="reset" class="btn btn-lg btn-danger"><i class="las la-eraser"></i> Reiniciar</button>	
					  </p>
  				</form>
  			</article>
  			<article class="col-2"></article>
		</section>		
  	</div>
  	<div class="tab-pane fade" id="editar" role="tabpanel" aria-labelledby="editar-tab">
  		<h1>Aquí va a futuro el modificar de datos, por si nos equivocamos</h1>
  	</div>
  	<div class="tab-pane fade" id="buscar" role="tabpanel" aria-labelledby="buscar-tab">
  		<div class="container-fluid">
		    <section class="row mt-4">
		        <article class="col">
		            <div class="container">
		                <form accept-charset="utf-8">
		                        <div class="form-row">
		                            <div class="col-xs-12 col-sm-12 col-md-7">
		                                <input class="form-control" type="text" name="busqueda" id="busqueda">
		                            </div>
		                            <!--<div class="col-xs-12 col-sm-12 col-md-2">
		                                <input class="form-control" type="date" name="fecha" id="fecha">
		                            </div>-->
		                            <div class="col-xs-12 col-sm-12 col-md-5">
		                                <button type="button" class="btn btn-primary" onclick="buscarInmueble()">Buscar</button> <button id="boton" type="button" class="btn btn-warning">Resaltar Coincidencias</button>
		                                <span id="results"></span>
		                            </div>
		                        </div>
		                </form>     
		            </div>
		        </article>
		    </section>
		  </div><br><br>
		</div>
</div>
<!-- Fin Contenedor Centrar Contenido -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>