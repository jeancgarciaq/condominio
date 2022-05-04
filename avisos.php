<?php require('conexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 6</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link href="css/line-awesome.min.css" rel="stylesheet">
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
	<h1><img src="img/recibo.png" class="img-fluid" width="10%" height="10%"> MÓDULO 6: AVISOS DE COBRO</h1>
	<p class="fuente">En este módulo puede consultar los avisos de cobro y emitir los mismos mensualmente.</p>
	
	<!-- Empieza las pestañas -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="generar-tab" data-bs-toggle="tab" href="#generar" role="tab" aria-controls="editar" aria-selected="true"><i class="la la-pen"></i> <span class="pestana">Generar</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="cuota-tab" data-bs-toggle="tab" href="#cuota" role="tab" aria-controls="cuota" aria-selected="true"><i class="las la-piggy-bank"></i> <span class="pestana">Cuota Especial</span></a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
	<!-- Inicio Generar -->
  	<div class="tab-pane fade show active" id="generar" role="tabpanel" aria-labelledby="generar-tab">
  		<div class="container-fluid">
		   <section class="row mt-4">
		    <article class="col">
		     <div class="container">
		     <!--AQUI ESTOY MODIFICANDO EL ARCHIVO QUE PROCESA EL FORMULARIO js/avisocobro.php -->
		      <form action="js/avisocobro.php" method="post" accept-charset="utf-8">
		       <div class="row input-group">
		       		<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select class="form-select" name="condominio" id="lista6">
								  <option value="0">Seleccione:</option>
								  <?php
								    $query = $conexion->query("SELECT * FROM condominios");
								    while ($valores = mysqli_fetch_array($query)) {
								     echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
					      </select>
					    </div>
			        <div class="col" id="selectlista6">
							</div>
					    <div class="col">
					    	<label for="mes"><i class="la la-calendar"></i> Mes:</label>
						   	<select name="mes" class="form-select">
						   		<option value="">Seleccione:</option>
						   		<option value="01">01</option>
						   		<option value="02">02</option>
						   		<option value="03">03</option>
						   		<option value="04">04</option>
						   		<option value="05">05</option>
						   		<option value="06">06</option>
						   		<option value="07">07</option>
						   		<option value="08">08</option>
						   		<option value="09" selected>09</option>
						   		<option value="10">10</option>
						   		<option value="11">11</option>
						   		<option value="12">12</option>
						   	</select>
							</div>
							<div class="col">
								<label for="year"><i class="la la-calendar"></i> Año:</label>
								<select name="year" class="form-select">
									<option value="">Seleccione:</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021" selected>2021</option>
								</select>
							</div>
							<div class="col">
								<button type="submit" class="btn btn-primary form-control" style="margin-top: 23px;"><i class="las la-search"></i> Generar</button>
							</div>
		  				</div>
		    		</form>
		    		<!-- Script para Select Dinámico -->
						<script type="text/javascript">
							$(document).ready(function(){
								$('#lista6').val(1);
								recargarLista();
								$('#lista6').change(function(){
								recargarLista();});
							})
						</script>
						<script type="text/javascript">
							function recargarLista(){
								$.ajax({
												type:"POST",
												url:"js/lista.php",
												data:"condominio=" + $('#lista6').val(),
												success:function(r){
													$('#selectlista6').html(r);
												}
											});
							}
						</script>
						<!-- Fin de Script -->     
		  		</div>
		 		</article>
			</section>
		</div>
		<br><br>
	</div>
	<!-- Inicio Cuota Especial -->
	<div class="tab-pane fade" id="cuota" role="tabpanel" aria-labelledby="cuota-tab">
  		<div class="container-fluid">
		   <section class="row mt-4">
		    <article class="col">
		     <div class="container">
		      <form action="js/avisocuotaespecial.php" method="post" accept-charset="utf-8">
		       <div class="row input-group">
		       		<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select class="form-select" name="condominio" id="lista7">
								  <option value="0">Seleccione:</option>
								  <?php
								    $query = $conexion->query("SELECT * FROM condominios");
								    while ($valores = mysqli_fetch_array($query)) {
								     echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
					      </select>
					    </div>
			        <div class="col" id="selectlista7">
							</div>
					    <div class="col">
					    	<label for="mes"><i class="la la-calendar"></i> Mes:</label>
						   	<select name="mes" class="form-select">
						   		<option value="">Seleccione:</option>
						   		<option value="01">01</option>
						   		<option value="02">02</option>
						   		<option value="03">03</option>
						   		<option value="04">04</option>
						   		<option value="05">05</option>
						   		<option value="06">06</option>
						   		<option value="07">07</option>
						   		<option value="08" selected>08</option>
						   		<option value="09">09</option>
						   		<option value="10">10</option>
						   		<option value="11">11</option>
						   		<option value="12">12</option>
						   	</select>
							</div>
							<div class="col">
								<label for="year"><i class="la la-calendar"></i> Año:</label>
								<select name="year" class="form-select">
									<option value="">Seleccione:</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021" selected>2021</option>
								</select>
							</div>
							<div class="col">
								<button type="submit" class="btn btn-primary form-control" style="margin-top: 23px;"><i class="las la-search"></i> Generar</button>
							</div>
		  				</div>
		    		</form>
		    		<!-- Script para Select Dinámico -->
						<script type="text/javascript">
							$(document).ready(function(){
								$('#lista7').val(1);
								recargarLista1();
								$('#lista7').change(function(){
								recargarLista1();});
							})
						</script>
						<script type="text/javascript">
							function recargarLista1(){
								$.ajax({
												type:"POST",
												url:"js/lista.php",
												data:"condominio=" + $('#lista7').val(),
												success:function(r){
													$('#selectlista7').html(r);
												}
											});
							}
						</script>
						<!-- Fin de Script -->     
		  		</div>
		 		</article>
			</section>
		</div>
		<br><br>
	</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>