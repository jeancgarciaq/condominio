<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Módulo 8</title>
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
<!-- DESCRIPCIÓN DEL MÓDULO -->
	<h1><img src="img/factura.png" class="img-fluid" width="10%" height="10%" alt="Cuentas por Pagar"> MÓDULO 8: CUENTAS POR PAGAR</h1>
	<p class="fuente">En este módulo puede consultar las cuentas por pagar que presenta los condominios.</p>
<!-- INICIO DE LAS PESTAÑAS -->

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="consultacxp-tab" data-bs-toggle="tab" href="#consultacxp" role="tab" aria-controls="consultacxp" aria-selected="true"><i class="las la-glasses"></i> <span class="pestana">Consultar Deuda</span></a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="saldo-tab" data-bs-toggle="tab" href="#añadirpago" role="tab" aria-controls="añadirpago" aria-selected="false"><i class="las la-plus"></i> <span class="pestana">Pagar Deuda</span></a>
		</li>
		<!--<li class="nav-item">
			<a class="nav-link" id="reporte-tab" data-toggle="tab" href="#reporte" role="tab" aria-controls="reporte" aria-selected="false"><i class="las la-chart-bar"></i> <span class="pestana">Reporte</span></a>
		</li>-->
	</ul>
<!-- FIN DE LAS PESTAÑAS -->
<!-- INICIO PESTAÑA CONSULTAR -->
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="consultacxp" role="tabpanel" aria-labelledby="consultacxp-tab">
			<section class="row">
				<article class="col container-fluid mt-4">
					<form action="js/newconsultacxp.php" method="post" accept-charset="utf-8">
						<div class="row input-group">
							<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id="lista3" class="form-select" name="condominio">
								  <option value="0" selected>Seleccione:</option>
								  <?php
								    $query = $conexion->query("SELECT * FROM condominios");
								    while ($valores = mysqli_fetch_array($query)) {
								     echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';} ?>
					      </select>
					    </div>
					    <div class="col">
					    	<label for="mes"><i class="la la-calendar"></i> Mes:</label>
						   	<select name="mes" class="form-select">
						   		<option value="" selected></option>
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
									<option value="" selected></option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
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
<!-- FIN PESTAÑA CONSULTAR -->
<!-- INICIO PESTAÑA AÑADIR PAGO -->
<div class="tab-pane fade show" id="añadirpago" role="tabpanel" aria-labelledby="añadirpago-tab">
	<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete todos los datos del formulario.</p>
  <!--Aquí Inicia el Formulario -->
  <section class="row">
  	<article class="col-2"></article>
  	<article class="col-8">
      <form class="mt-4" action='js/agregarpagop.php' accept-charset="utf-8" method="POST">
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
          <div class="col form-group" id="select1lista">
          </div>
        </div>
        <div class="row input-group">
          <div class="col">
            <label for="monto"><i class="la la-coins"></i> Monto Bs.</label>
          	<input type="number" class="form-control" name="monto" placeholder="1234567,00" step="any">
          </div>
	        <div class="col">
	          <label for="montod"><i class="la la-coins"></i> Monto $.</label>
	        	<input type="number" class="form-control" name="montod" placeholder="1234567,00" step="any">
	        </div>
	        <div class="col">
	          <label for="tasa"><i class="la la-city"></i> Tasa</label>
	          <select id='listatasa' class="form-select" name="tasa" required>
	            <option value="" selected>Seleccione:</option>
	            <?php
	              $query = $conexion->query("SELECT tasaparalelo.Fecha, tasaparalelo.Apertura, tasaparalelo.Cierre, tasabcv.tasa
								FROM tasabcv
								INNER JOIN tasaparalelo ON tasaparalelo.Fecha = tasabcv.Fecha 
								ORDER BY tasabcv.Fecha DESC");
	              while ($valores = mysqli_fetch_array($query)) {
	               	$date = date_create($valores['Fecha']);
	               	$fecha = date_format($date, 'd/m/Y');
	               	$apertura = $valores['Apertura'];
	               	$cierre = $valores['Cierre'];
	               	$tasa = $valores['tasa'];
	               	echo '<option value="'.$valores['Apertura'].'">'.$fecha.' - '. number_format($apertura, 2, ',', '.').'</option>';
	               	echo '<option value="'.$valores['Cierre'].'">'.$fecha.' - '. number_format($cierre, 2, ',', '.').'</option>';
	               	echo '<option value="'.$valores['tasa'].'">'.$fecha.' - '. number_format($tasa, 2, ',', '.').'</option>';
	                  }?>
						</select>
	        </div>
        </div>
        <div class="row input-group">
          <div class="col">
            <label for="descripcion"><i class="la la-file-alt"></i> Descripción:</label>
            <input type="text" class="form-control" name="descripcion" placeholder="Descripción..." required>
          </div>
          <div class="col">
         		<label for="referencia"><i class="la la-barcode"></i> Número Referencia</label>
         		<input type="text" class="form-control" name="referencia" placeholder="0123456789" required>
          </div>
        	<div class="col">
						<label for="banco"><i class="la la-landmark"></i> Banco</label>
						<select name="banco" class="form-select" required>
              <option value="" selected>Seleccione:</option>
              <option value="DIVISA/EFECTIVO">0000-DIVISA/EFECTIVO</option>
              <option value="BANESCO">0134-BANESCO BANCO UNIVERSAL</option>
              <option value="BNC">0191-BANCO NACIONAL DE CREDITO</option>
            </select>
          </div>
        </div>
        <div class="row input-group">
          <div class="col-3">
            <label for="observacion"><i class="la la-file-alt"></i> Conciliado</label>
            <select name="conciliado" class="form-control">
              <option value="SI">SI</option>
              <option value="NO" selected>NO</option>
            </select>
          </div>
          <div class="col-6">
						<label for="observacion"><i class="la la-comment"></i> Observación</label>
						<textarea class="form-control" aria-label="observacion" name="observacion" autocomplete="on"></textarea>
          </div>
          <div class="col-3">
						<label for="fecha"><i class="la la-calendar"></i> Fecha</label>
						<input type="date" class="form-control" name="fecha" placeholder="00/00/0000" required>
          </div>
        </div><br>  
          <p style="text-align: center;">
            <button type="submit" class="btn btn-success btn-lg"><i class="las la-plus"> </i>Añadir</button>
           <button type="reset" class="btn btn-danger btn-lg"><i class="las la-eraser"> </i>Reiniciar</button>	
          </p>
      </form>
  	</article>
  	<article class="col-2"></article>
  </section>
  <!-- Script para Select Dinámico -->
		<script type="text/javascript">
	    $(document).ready(function(){
	      $('#lista1').val();
	      recargarLista();

	      $('#lista1').change(function(){
	      recargarLista();});
	            })
		</script>
		<script type="text/javascript">
	          function recargarLista(){
	            $.ajax({
	              type:"POST",
	              url:"js/listad.php",
	              data:"condominio=" + $('#lista1').val(),
	              success:function(r){
	                $('#select1lista').html(r);
			}
	              });
	            }
		</script>
	<!-- Fin de Script -->
<!-- FIN PESTAÑA AÑADIR PAGO -->
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--    <script src="js/jquery-3.3.1.slim.min.js"></script> -->
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>