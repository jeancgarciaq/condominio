<?php require('conexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 2</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/line-awesome.min.css">
	<script	src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
<!-- 
Quiero crear dos pestañas que van a mostrar los diferentes formularios, y voy a tener una hoja de resultados que mostrará la consulta que se hagan sobre la base de datos.
-->
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
	<h1><img src="img/trabajo-en-equipo.png" class="img-fluid" id="iconoM2"> MÓDULO 2: PROPIETARIOS</h1>
	<p class="fuente">En este módulo puede añadir, modificar, borrar o consultar los propietarios registrados actualmente.</p>
	
	<!-- Empieza las pestañas -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="añadir-tab" data-bs-toggle="tab" href="#añadir" role="tab" aria-controls="añadir" aria-selected="true"><i class="la la-pen"></i> <span class="pestana">Añadir</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="editar-tab" data-bs-toggle="tab" href="#editar" role="tab" aria-controls="editar" aria-selected="false"><i class="la la-pen"></i> <span class="pestana">Editar</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="buscar-tab" data-bs-toggle="tab" href="#buscar" role="tab" aria-controls="buscar" aria-selected="false"><i class="la la-search"></i> <span class="pestana">Buscar</span></a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="añadir" role="tabpanel" 	aria-labelledby="añadir-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete los datos del formulario, iniciando con el nombre y apellido del propietario.</p>
			<!--Aquí Inicia el Formulario -->
  		<section id="consultamc" class="row">
  			<article class="col-2"></article>
  			<article class="col-8 mt-4 mb-4">
  				<form accept-charset="utf-8" action="js/agregarpropietario.php" method="POST" class="container-fluid">
						<div class="row input-group">
							<div class="col">
								<label><i class="la la-signature"></i> Nombre:<br> <input class="form-control" type="text" name="nombre" required data-toggle="tooltip" data-placement="bottom" title="Coloque el nombre de la persona de contacto del Condominio" placeholder="Nombre Apellido" required></label>
							</div>
							<div class="col">
								<label><i class="las la-envelope"></i> Correo:<br> <input class="form-control"  type="email" name="correo" data-toggle="tooltip" data-placement="bottom" title="Coloque el correo del Condominio"  placeholder="condominio@correo.com" required></label>
							</div>
							<div class="col">
								<label><i class="las la-envelope"></i> Otro Correo:<br> <input class="form-control"  type="email" name="correo2" data-toggle="tooltip" data-placement="bottom" title="Coloque el correo del Condominio"  placeholder="condominio@correo.com"></label>
							</div>
							<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio:</label>
						  	<select class="form-select" name="condominio">
					        <option value="0">Seleccione:</option>
					        <?php
					          $query = $conexion -> query ("SELECT NombreC FROM condominios");
					          while ($valores = mysqli_fetch_array($query)) {
					            echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';
					          }
					        ?>
					      </select>	
							</div>
							<div class="col">
								<label><i class="las la-home"></i> Nº Inmueble:<br> <input class="form-control"  type="text" name="inmueble"data-toggle="tooltip" data-placement="bottom" title="Indique el número de la Unidad Inmobiliaria"placeholder="00-00" required> </label>	
							</div>
						</div>
						<div class="row mt-4">
							<div class="col">
								<label><i class="las la-home"></i> Alicuota:<br> <input class="form-control" type="text" name="alicuota" data-placement="bottom" title="Si la alicuota es 1.56% se debe escribir 0.0156" placeholder="0.0156" required></label>
							</div>
							<div class="col">
								<label><i class="las la-phone"></i> Teléfono:<br> <input class="form-control" type="tel" name="telefono" pattern="[+][0-9]{2}[-][0-9]{3}[-][0-9]{7}" data-toggle="tooltip" data-placement="bottom" title="Coloque el signo '+' seguido del código de país, un guión con el código de la región, un guión y el número de teléfono" placeholder="+012-123-0123456" required></label>
							</div>
							<div class="col">
								<label><i class="las la-directions"></i> Dirección:<br> <textarea class="form-control"  name="direccion" data-toggle="tooltip" data-placement="bottom" title="Indique la dirección de habitación lo más exacta posible" placeholder="Av o calle, Conjunto, etc." autocomplete="on"></textarea></label>
							</div>
							<div class="col">
								<label><i class="las la-map-marker"></i> Ciudad:<br> <input class="form-control"  type="text" name="ciudad" data-toggle="tooltip" data-placement="bottom" title="Indique la Ciudad o Población donde habita" placeholder="Población o Ciudad" required autocomplete="on"></label>	
							</div>
							<div class="col">
								<label><i class="las la-location-arrow"></i> Estado:<br>
					      <select name="estado" class="form-select" data-toggle="tooltip" data-placement="bottom" title="Seleccione un Estado" placeholder="Carabobo" required>
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
					      </select></label>	
							</div>
						</div>
						<div class="row mt-4">
							<div class="col"></div>
							<div class="col">
	  						<button  type="submit" class="btn btn-lg btn-success form-control"><i class="las la-plus"></i> Agregar</button>
	  					</div>
	  					<div class="col form-group">
	  						<button type="reset" class="btn btn-lg btn-danger form-control"><i class="las la-eraser"></i> Reiniciar</button>		
	  					</div>
	  					<div class="col"></div>
						</div>
  				</form>
  			</article>
  			<article class="col-2"></article>
			</section>
		</div>
  	<div class="tab-pane fade" id="editar" role="tabpanel" 	aria-labelledby="editar-tab">
  	<section class="row">
  		<article class="col"></article>
  		<article class="col-8">
  				<form class="mt-4" action="js/reemplazarenpropietarios.php" method="POST">
  					<small>Buscar:</small>
  					<div class="row input-group">
					    <div class="col">
					    	<label for="numero"><i class="la la-home"></i> # Inmueble</label>
					      <input type="text" name="numero" class="form-control" placeholder="Inmueble a Actualizar">
					    </div>
					    <div class="col">
					      <label for="condominio"><i class="la la-city"></i> Condominio:</label>
						  	<select class="form-select" name="condominio">
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
					  <small>Reemplazar con:</small>
					  <div class="row input-group">
					  	<div class="col">
					  		<label for="nombre"><i class="la la-signature"></i> Nombre:</label>
					      <input type="text" name="nombre" class="form-control" placeholder="Nombre y Apellido">
					  	</div>
					  	<div class="col">
					  		<label><i class="la la-phone"></i> Teléfono:</label>
					  		<input type="text" name="telefono" class="form-control">
					  	</div>
					    <div class="col">
								<label><i class="las la-envelope"></i> Correo:<br> <input class="form-control"  type="email" name="correo" data-toggle="tooltip" data-placement="bottom" title="Coloque el correo del Propietario"  placeholder="propietario@correo.com" required></label>
							</div>
					  </div><br>
					  <p style="text-align: center;">
					  	<button type="submit" class="btn btn-lg btn-primary"><i class="las la-pen"> </i> Reemplazar</button>
					  	<button type="reset" class="btn btn-lg btn-danger"><i class="las la-eraser"> </i>Reiniciar</button>	
					  </p>
  				</form>
  			</article>
  		<article class="col"></article>
  	</section>			
  	</div>
  	<div class="tab-pane fade" id="buscar" role="tabpanel" aria-labelledby="buscar-tab">
  		<div class="container-fluid">
		    <section class="row mt-4">
		        <article class="col">
		            <div class="container">
		                <form action="js/bpropietario.php" method="post" accept-charset="utf-8">
										<div class="row form-group">
											<div class="col">
												<label for="condominio"><i class="la la-city"></i> Condominio</label>
												<select id="lista1" class="form-control" name="condominio" required>
											        <option value="0">Seleccione:</option>
											        <?php
											          $query = $conexion -> query ("SELECT * FROM condominios");
											          while ($valores = mysqli_fetch_array($query)) {
											            echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';
											          }
											        ?>
											      </select>
											</div>
											<div id="select2lista" class="col">
											</div>
											<div class="col">
												<button type="submit" class="btn btn-primary form-control" style="margin-top: 30px;"><i class="las la-search"></i> Buscar</button>
											</div>
										</div>
									</form>
		            </div>
		        </article>
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
												url:"js/lista.php",
												data:"condominio=" + $('#lista1').val(),
												success:function(r){
													$('#select2lista').html(r);
												}
											});
							}
						</script>
						<!-- Fin de Script -->  
		    </section>
		  </div><br><br>
		</div>
	</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>