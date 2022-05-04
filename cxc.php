<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 7</title>
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
	<h1><img src="img/caja-registradora.png" class="img-fluid" width="10%" height="10%"> MÓDULO 7: CUENTAS POR COBRAR</h1>
	<p class="fuente">En este módulo puede consultar las cuentas por cobrar que presenta los propietarios, asímismo se le podrá añadir cuentas por cobrar específicas a los propietarios.</p>
	<!-- Menú de las Pestañas -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="añadircxc-tab" data-bs-toggle="tab" href="#añadircxc" role="tab" aria-controls="añadircxc" aria-selected="true"><i class="la la-plus"></i> <span class="pestana">Añadir CxC</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="consulta-tab" data-bs-toggle="tab" href="#consulta" role="tab" aria-controls="consulta" aria-selected="false"><i class="las la-glasses"></i> <span class="pestana">Consultar Deuda</span></a>
		</li>
		<!--<li class="nav-item">
			<a class="nav-link" id="añadir-tab" data-toggle="tab" href="#saldo" role="tab" aria-controls="saldo" aria-selected="false"><i class="las la-plus"></i> <span class="pestana">Añadir Saldo</span></a>
		</li>-->
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="reporte-tab" data-bs-toggle="tab" href="#reporte" role="tab" aria-controls="reporte" aria-selected="false"><i class="las la-chart-bar"></i> <span class="pestana">Reporte</span></a>
		</li>
	</ul>
	<!-- Fin del Menu -->
	<!-- Pestaña Añadir -->
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="añadircxc" role="tabpanel" 	aria-labelledby="añadircxc-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete todos los datos del formulario.</p>
			<section class="row">
				<article class="col"></article>
				<article class="col-10">
					<form action="js/agregarcxc.php" method="POST" accept-charset="utf-8">
						<div class="row input-group">
							<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id='lista1' class="form-select" name="condominio" required>
									<option value="" selected>Seleccione:</option>
									<?php
									    $query = $conexion->query ("SELECT * FROM condominios");
									    while ($valores = mysqli_fetch_array($query)) {
									        echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
								</select>
							</div>
							<div class="col" id="select2lista">
								
							</div>
							<div class="col">
								<label for="descripcion"> Descripción</label>
								<select class="form-select" aria-label="descripcion" name="descripcion">
									<option value="Condominio Septiembre 2021">Condominio Septiembre 2021</option>
									<option value="Cuota Especial 1/2 Impermeabilización de Azotea: Presupuesto de Materiales">Cuota Especial 1/2 Impermeabilización de Azotea: Presupuesto de Materiales</option>
									<option value="Cuota Especial 2/2 Impermeabilización de Azotea: Presupuesto de Mano de Obra">Cuota Especial 2/2 Impermeabilización de Azotea: Presupuesto de Mano de Obra</option>
									<option value="Cuota de Gas: Cobro para la próxima recarga">Cuota de Gas: Cobro para la próxima recarga</option>
									<option value="Cuota Mantenimiento Condominio Externo">Cuota Mantenimiento Condominio Externo</option>
								</select>
							</div>
						</div>
						<div class="row input-group">
							<div class="col">
								<label for="monto"><i class="la la-coins"></i> Monto Bs.</label>
								<input type="number" class="form-control" name="monto" placeholder="1234567,00" step="any">
							</div>
							<div class="col">
								<label for="montod"><i class="la la-coins"></i> Monto $</label>
								<input type="number" class="form-control" name="montod" placeholder="1234567,00" step="any">
							</div>
							<div class="col">
								<label for="emision"><i class="la la-calendar"></i> Emisión</label>
								<input type="date" class="form-control" name="emision" placeholder="00/00/0000" required>
							</div>
						</div><br>
						<p style="text-align: center;">
						  	<button type="submit" class="btn btn-success btn-lg"><i class="las la-plus"> </i>Añadir</button>
						  	<button type="reset" class="btn btn-danger btn-lg"><i class="las la-eraser"> </i>Reiniciar</button>	
						</p>
					</form>
				</article>
				<article class="col"></article>
			</section>
		</div>
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
		<!--Fin Pestaña Añadir -->
		<!-- Pestaña Consultar Deuda -->
		<div class="tab-pane fade" id="consulta" role="tabpanel" aria-labelledby="consulta-tab">
			<section class="row">
				<article class="col container-fluid mt-4">
					<form action="js/newconsultacxc.php" method="post" accept-charset="utf-8">
						<div class="row info-group">
							<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id="lista3" class="form-select" name="condominio">
								  <option value="0" selected>Seleccione:</option>
								  <?php
								    $query = $conexion->query("SELECT * FROM condominios");
								    while ($valores = mysqli_fetch_array($query)) {
								     echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
					      </select>
					    </div>
							<div id="select3lista" class="col">
							</div>
					    <div class="col">
					    	<label for="mes"><i class="la la-calendar"></i> Mes:</label>
						   	<select name="mes" class="form-select">
						   		<option value="" selected>Elija mes...</option>
						   		<option value="01">01</option>
						   		<option value="02">02</option>
						   		<option value="03">03</option>
						   		<option value="04">04</option>
						   		<option value="05">05</option>
						   		<option value="06">06</option>
						   		<option value="07">07</option>
						   		<option value="08">08</option>
						   		<option value="09">09</option>
						   		<option value="10">10</option>
						   		<option value="11">11</option>
						   		<option value="12">12</option>
						   	</select>
							</div>
							<div class="col">
								<label for="year"><i class="la la-calendar"></i> Año:</label>
								<select name="year" class="form-select">
									<option value="" selected>Elija año..</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
								</select>
							</div>
							<div class="col">
								<button type="submit" class="btn btn-primary form-control" style="margin-top: 23px;"><i class="las la-search"></i> Buscar</button>
							</div>
						</div>
					</form>
				</article>
			</section>
		</div>
		<!-- Script para Select Dinámico en Añadir Cuenta por Cobrar -->
			<script type="text/javascript">
				$(document).ready(function(){
					$('#lista3').val(1);
					recargarLista3();

					$('#lista3').change(function(){
					recargarLista3();});
				})
			</script>
			<script type="text/javascript">
				function recargarLista3(){
					$.ajax({
									type:"POST",
									url:"js/lista.php",
									data:"condominio=" + $('#lista3').val(),
									success:function(r){
										$('#select3lista').html(r);
									}
								});
				}
			</script>
			<!-- Fin de Script -->
		<!-- Fin Pestaña Consultar Deuda -->
		
		<!-- Pestaña Reporte -->
		<div class="tab-pane fade" id="reporte" role="tabpanel" aria-labelledby="reporte-tab">
			<section class="row">
				<article class="col-2"></article>
				<article class="col container-fluid mt-4">
					<form action="js/reporte.php" method="post" accept-charset="utf-8">
						<div class="row form-group">
							<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id='lista5' class="form-control" name="condominio" required>
									<option value="" selected>Seleccione:</option>
									<?php
									    $query = $conexion->query ("SELECT * FROM condominios");
									    while ($valores = mysqli_fetch_array($query)) {
									        echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
								</select>
							</div>
							<div class="col" id="select5lista">
								
							</div>
							<div class="col">
								<button type="submit" class="btn btn-primary form-control" style="margin-top: 30px;"><i class="las la-search"></i> Buscar</button>
							</div>
						</div>
					</form>
				</article>
				<article class="col-2"></article>
			</section>
		</div>
		<!-- Fin Reporte -->
		<!-- Script para Select Dinámico en Reporte -->
			<script type="text/javascript">
				$(document).ready(function(){
					$('#lista5').val(1);
					recargarLista5();

					$('#lista5').change(function(){
					recargarLista5();});
				})
			</script>
			<script type="text/javascript">
				function recargarLista5(){
					$.ajax({
									type:"POST",
									url:"js/lista.php",
									data:"condominio=" + $('#lista5').val(),
									success:function(r){
										$('#select5lista').html(r);
									}
								});
				}
			</script>
			<!-- Fin de Script -->
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
		
</body>
</html>