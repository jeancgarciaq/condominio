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
	    <a class="nav-link text-light border-left" href="proveedores.php"><i class="las la-store-alt"></i> Proveedores</a>
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
	<h1><img src="img/negocios-y-finanzas.png" class="img-fluid" id="iconoM4"> MÓDULO 4: GASTOS</h1>
	<p class="fuente">En este módulo puede añadir, modificar, borrar o consultar los gastos mensuales por condominio.</p>
	
	<!-- Empieza las pestañas -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="editar-tab" data-toggle="tab" href="#editar" role="tab" aria-controls="editar" aria-selected="true"><i class="la la-pen"></i> <span class="pestana">Editar</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="buscar-tab" data-toggle="tab" href="#buscar" role="tab" aria-controls="buscar" aria-selected="false"><i class="la la-search"></i> <span class="pestana">Buscar</span></a>
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
  					<div class="row">
  						<div class="col form-group">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id='lista1' class="form-control" name="condominio" required>
									<option value="" selected>Seleccione:</option>
									<?php
									    $query = $conexion->query ("SELECT Nombre FROM condominios");
									    while ($valores = mysqli_fetch_array($query)) {
									        echo '<option value="'.$valores[Nombre].'">'.$valores[Nombre].'</option>';}?>
								</select>
							</div>
							<div class="col form-group" id="select2lista">
								
							</div>
	  					<div class="col form-group">
	  						<label for="comprobante"><i class="las la-cash-register"></i> Nº Comprobante:</label>
	  						<input class="form-control" type="text" name="comprobante" value="" placeholder="Número Comprobante Egreso">
	  					</div>
	  					<div class="col form-group">
								<label for="monto"><i class="las la-coins"></i> Monto:</label>
	  						<input class="form-control" type="number" name="monto" step="any" placeholder="123456789.00" required>
	  					</div>
						</div>
						<div class="row">
	  					<div class="col form-group">
								<label for="descripcion"><i class="las la-file-alt"></i> Descripción:</label>
								<textarea class="form-control" name="descripcion"></textarea>
							</div>
	  					<div class="col form-group">
								<label for="fecha"><i class="las la-calendar"></i> Fecha:</label>
								<input class="form-control" type="date" name="fecha" value="" placeholder="">
							</div>
  					</div>
  					<!-- Botones -->
  					<p style="text-align: center;">
					  	<button type="submit" class="btn btn-lg btn-success"><i class="las la-plus"></i> Añadir</button>
					  	<button type="reset" class="btn btn-lg btn-danger"><i class="las la-eraser"></i> Reiniciar</button>	
					  </p>
  				</form>
  			</article>
  			<article class="col-2"></article>
  			<!-- Script para Select Dinámico -->
				<script type="text/javascript">
					$(document).ready(function(){
						$('#lista1').val(1);
						recargarLista();

						$('#lista1').change(function(){
						recargarLista();});
					})
				</script>
				<script type="text/javascript">
					function recargarLista(){
						$.ajax({
										type:"POST",
										url:"js/listap.php",
										data:"condominio=" + $('#lista1').val(),
										success:function(r){
											$('#select2lista').html(r);
										}
									});
					}
				</script>
				<!-- Fin de Script -->
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