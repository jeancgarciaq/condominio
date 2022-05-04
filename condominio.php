<?php require('conexion.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 1</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link href="css/line-awesome.min.css" rel="stylesheet">
	<script	src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
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
	<h1><img src="img/pueblo.png" class="img-fluid" id="iconoM1"> <!--width="50px" height="70px"--> MÓDULO 1: CONDOMINIOS</h1>
	<p class="fuente">En este módulo puede añadir, modificar, borrar o consultar los condominios registrados actualmente.</p>
	
	<!-- Empieza las pestañas -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="editar-tab" data-bs-toggle="tab" href="#editar" role="tab" aria-controls="editar" aria-selected="true"><i class="las la-plus"></i> <span class="pestana">Agregar</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="modificar-tab" data-bs-toggle="tab" href="#modificar" role="tab" aria-controls="modificar" aria-selected="false"><i class="la la-pen"></i> <span class="pestana">Modificar</span></a>
		</li>
		<!-- Inicio Pestaña Borrar
		<li class="nav-item">
			<a class="nav-link" id="borrar-tab" data-toggle="tab" href="#borrar" role="tab" aria-controls="borrar" aria-selected="false"><i class="las la-eraser"></i> <span class="pestana">Borrar</span></a>
		</li>
		Fin Pestaña Borrar -->
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="buscar-tab" data-bs-toggle="tab" href="#buscar" role="tab" aria-controls="buscar" aria-selected="false"><i class="la la-search"></i> <span class="pestana">Buscar</span></a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
  	<div class="tab-pane fade show active" id="editar" role="tabpanel" 	aria-labelledby="editar-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete los datos del formulario, iniciando con el nombre de la persona responsable del condominio, luego añada todos los datos correspondiente al Condominio.</p>
  		<!--Aquí Inicia el Formulario -->
  		<section class="row">
  			<article class="col-2"></article>
  			<article class="col-8 mt-4 mb-4">
  				<form accept-charset="utf-8" action="js/agregarcondominio.php" method="POST">
  					<div class="row input-group">
							<div class="col">
								<label><i class="las la-city"></i> Condominio: <br> 
								<input class="form-control"  type="text" name="condominio" data-toggle="tooltip" data-placement="bottom" title="Escriba el nombre del Condominio" placeholder="Condominio XXXX" required></label>
							</div>
							<div class="col">
								<label><i class="la la-signature"></i> Responsable: <br> 	
								<input class="form-control" type="text" name="nombre" required data-toggle="tooltip" data-placement="bottom" title="Coloque el nombre de la persona de contacto del Condominio" placeholder="Nombre Apellido" required></label>
							</div>
							<div class="col">
								<label><i class="las la-address-card"></i> Cargo:<br> <input class="form-control" type="text" name="cargo" data-toggle="tooltip" data-placement="bottom" title="Coloque el cargo que ocupa la persona de contacto del Condominio" placeholder="Presidente, Secretario, Administrador, etc." required></label>
							</div>
							<div class="col">
								<label><i class="las la-envelope"></i> Correo:<br> <input class="form-control"  type="email" name="correo" data-toggle="tooltip" data-placement="bottom" title="Coloque el correo del Condominio"  placeholder="condominio@correo.com" required></label>
							</div>
						</div>
						<div class="row mt-4 input-group">
							<div class="col">
								<label><i class="las la-barcode"></i> RIF:<br> <input class="form-control"  type="text" name="rif"data-toggle="tooltip" data-placement="bottom" title="Indique el número de RIF del Condominio"placeholder="J-12345678-9" required> </label>
							</div>
							<div class="col">
								<label><i class="las la-phone"></i> Teléfono:<br> <input class="form-control" type="tel" name="telefono" pattern="[+][0-9]{2}[-][0-9]{4}[-][0-9]{7}" data-toggle="tooltip" data-placement="bottom" title="Coloque el signo '+' seguido del código de país, un guión con el código de la región, un guión y el número de teléfono" placeholder="+01-0123-1234567" required></label>
							</div>
							<div class="col">
								<label><i class="las la-directions"></i> Dirección:<br> <textarea class="form-control"  name="direccion" data-toggle="tooltip" data-placement="bottom" title="Indique la dirección del Condominio lo más exacta posible" placeholder="Av o calle, Conjunto, etc." required></textarea></label>
							</div>
							<div class="col">
								<label><i class="las la-map-marker"></i> Ciudad:<br> <input class="form-control"  type="text" name="ciudad" data-toggle="tooltip" data-placement="bottom" title="Indique la Ciudad o Población del Condominio" placeholder="Población o Ciudad" required></label>	
							</div>
						</div>
						<div class="row mt-2 input-group">
							<div class="col">
								<label><i class="las la-location-arrow"></i> Estado:<br>
						     <select name="estado" class="form-select" data-toggle="tooltip" data-placement="bottom" title="Seleccione un Estado" required>
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
							<div class="col">
								<label><i class="las la-map"></i> Mapa:<br> <textarea class="form-control"  name="mapa"  data-toggle="tooltip" data-placement="bottom" title="Copie y pegue el html de Google Maps" placeholder="Html de Google Maps" required></textarea></label>	
							</div>
							<div class="col p-4">
		  					<button  type="submit" class="btn btn-lg btn-success form-control"><i class="las la-plus"></i> Agregar</button>
		  				</div>
		  				<div class="col p-4">
		  					<button type="reset" class="btn btn-lg btn-danger form-control"><i class="las la-eraser"></i> Reiniciar</button>		
		  				</div>
		  			</div>
  				</form>
  			</article>
  			<article class="col-2"></article>
		</section>
		<!-- Fin de Formulario -->		
  </div>
  <div class="tab-pane fade" id="modificar" role="tabpanel" aria-labelledby="modificar-tab">
  		<!--Aquí Inicia el Formulario--> 
  		<section class="row">
  			<article class="col-2"></article>
  			<article class="col-8">
  				<form class="mt-4" action="js/reemplazarencondominio.php" method="POST">
  					<small>Buscar:</small>
  					<div class="form-row">
					    <div class="col form-group">
					    	<label for="nombre"><i class="la la-signature"></i> Nombre</label>
					      <input type="text" name="nombre" class="form-control" placeholder="Nombre y Apellido">
					    </div>
					    <div class="form-group col">
					      <label for="condominio"><i class="la la-city"></i> Condominio:</label>
						  	<select class="form-control" name="condominio">
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
					  <div class="form-row">
					  	<div class="form-group col">
					  		<label for="nombrer"><i class="la la-signature"></i> Nombre</label>
					      <input type="text" name="nombrer" class="form-control" placeholder="Nombre y Apellido">
					  	</div>
					  	<div class="form-group col">
					      <label for="telefonor"><i class="la la-phone"></i> Teléfono</label>
					      <input type="tel" class="form-control" name="telefonor" value="1234-1234567" placeholder="+01-1234-1234567">
					    </div>
					  </div>
					  <p style="text-align: center;">
					  	<button type="submit" class="btn btn-lg btn-primary"><i class="las la-pen"> </i> Reemplazar</button>
					  	<button type="reset" class="btn btn-lg btn-danger"><i class="las la-eraser"> </i>Reiniciar</button>	
					  </p>
  				</form>
  			</article>
  			<article class="col-2"></article>
		</section>
  	</div>
  	<!-- Inicio Módulo Borrar
  	<div class="tab-pane fade" id="borrar" role="tabpanel" aria-labelledby="borrar-tab">
  		<h1>Prueba</h1>
  	</div>
  	Fin Módulo Borrar--> 
  	<div class="tab-pane fade" id="buscar" role="tabpanel" aria-labelledby="buscar-tab">
		  <section class="row mt-4">
		  	<article class="col-3"></article>
		      <article class="col-9">
		        <div class="container">
		          <form accept-charset="utf-8" action="js/bcondominio.php" method="POST">
		            <div class="form-row">
		              <div class="col">
		              	<label for="condominio"><i class="la la-city"></i> Condominio:</label>
		                <select class="form-control" name="condominio" required>
											<option value="0">Seleccione:</option>
											<?php
											  $query = $conexion-> query ("SELECT * FROM condominios");
											  while ($valores = mysqli_fetch_array($query)) {
											    echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
										</select>
		              </div>
		             	<div class="col">
		             		<br>
		                <button type="submit" class="btn btn-primary mt-2"><i class="las la-search"></i> Buscar</button>
		              </div>
		            </div>
		          </form>
		        </div>
		      </article>
		  </section>
		  <br><br>
		</div>
	</div>
</div> 

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="js/jquery-3.3.1.slim.min.js" type="text/javascript" charset="utf-8" async defer></script>-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--Script Funciones Php -->
	<script src="js/index.js"></script>
</body>
</html>