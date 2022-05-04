<?php require('conexion.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Módulo 5</title>
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
  <h1><img src= "img/caja.png" class="img-fluid" id="iconoM5"> MÓDULO 5: PAGOS</h1>
  <p class="fuente">En este módulo puede añadir, modificar, borrar o consultar los pagos realizados por los propietarios y los ejecutados por el condominio a los proveedores.</p>
	
  <!-- Inicio Pestañas -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="propietario-tab" data-bs-toggle="tab" href="#propietario" role="tab" aria-controls="propietario" aria-selected="true"><i class="la la-money-bill-wave"></i> <span class="pestana">Pago Propietario</span></a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="actualizar-tab" data-bs-toggle="tab" href="#actualizar" role="tab" aria-controls="actualizar" aria-selected="false"><i class="la la-money-bill-wave-alt"></i> <span class="pestana"> Actualizar Pago</span></a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="saldo-tab" data-bs-toggle="tab" href="#saldo" role="tab" aria-controls="saldo" aria-selected="false"><i class="las la-plus"></i> <span class="pestana">Añadir Saldo</span></a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="buscar-tab" data-bs-toggle="tab" href="#buscar" role="tab" aria-controls="buscar" aria-selected="false"><i class="la la-search"></i> <span class="pestana">Buscar</span></a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tasa-tab" data-bs-toggle="tab" href="#tasa" role="tab" aria-controls="tasa" aria-selected="false"><i class="las la-chart-line"></i> <span class="pestana">Actualizar Tasa $</span></a>
    </li>
  </ul>
  <!-- Fin Pestañas -->
  <!-- Inicia Formulario-->
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="propietario" role="tabpanel" 	aria-labelledby="propietario-tab">
      <p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete todos los datos del formulario.</p>
      <!--Aquí Inicia el Formulario -->
      <section class="row">
  	   <article class="col-2"></article>
  	   <article class="col-8">
          <form class="mt-4" action='js/agregarpago.php' accept-charset="utf-8" method="POST">
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
                  }
            		  ?>
            		</select>
              </div>
            </div>
            <div class="row input-group">
              <div class="col">
                <label for="descripcion"><i class="la la-file-alt"></i> Descripción:</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Condominio de.." required>
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
                  <option value="DIVISA/EFECTIVO">0001-ZELLE</option>
                  <option value="BANESCO">0134-BANESCO BANCO UNIVERSAL</option>
                  <option value="BNC">0191-BANCO NACIONAL DE CREDITO</option>
                  <option value="BVC">0104-BANCO VENEZOLANO DE CREDITO</option>
                  <option value="MERCANTIL">0105-BANCO MERCANTIL C.A.</option>
                  <option value="VENEZUELA">0102-BANCO DE VENEZUELA S.A.I.C.A.</option>
                              <option value="PROVINCIAL">0108-BANCO PROVINCIAL BBVA</option>
                              <option value="BFC">0151-FONDO COMUN</option>
                              <option value="BOD">0116-BANCO OCCIDENTAL DE DESCUENTO.</option>
                              <option value="BANPLUS">0174-BANPLUS BANCO COMERCIAL C.A</option>
                              <option value="BANCARIBE">0114-BANCO DEL CARIBE C.A.</option>
                              <option value="BICENTENARIO">0175-BANCO BICENTENARIO</option>
                              <option value="TESORO">0163-BANCO DEL TESORO</option>
                              <option value="100% BANCO">0156-100% BANCO</option>
                              <option value="ACTIVO">0171-BANCO ACTIVO BANCO COMERCIAL, C.A.</option>
                              <option value="AGRICOLA">0166-BANCO AGRICOLA</option>
                              <option value="CARONI">0128-BANCO CARONI, C.A. BANCO UNIVERSAL</option>
                              <option value="EXTERIOR">0115-BANCO EXTERIOR C.A.</option>
                              <option value="BID">0173-BANCO INTERNACIONAL DE DESARROLLO, C.A.</option>
                              <option value="PLAZA">0138-BANCO PLAZA</option>
                              <option value="SOFITASA">0137-SOFITASA</option>
                              <option value="CITIBANK">0190-CITIBANK</option>
                              <option value="DELSUR">0157-DELSUR BANCO UNIVERSAL</option>
                              <option value="BANCAMIGA">0172-BANCAMIGA BANCO MICROFINANCIERO, C.A.</option>
                              <option value="BANCRECER">0168-BANCRECER S.A. BANCO DE DESARROLLO</option>
                              <option value="BANGENTE">0146-BANGENTE</option>
                              <option value="MIBANCO">0169-MIBANCO BANCO DE DESARROLLO, C.A.</option>
                              <option value="INDUSTRIAL">0003-BANCO INDUSTRIAL DE VENEZUELA.</option>
                              <option value="SOBERANO">0149-BANCO DEL PUEBLO SOBERANO C.A.</option>
                              <option value="MUNICIPAL">0601-INSTITUTO MUNICIPAL DE CR&#201;DITO POPULAR</option>
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
            </div>  
            <p style="text-align: center;" class="mt-4">
              <button type="submit" class="btn btn-success btn-lg"><i class="las la-plus"> </i>Añadir</button>
              <button type="reset" class="btn btn-danger btn-lg"><i class="las la-eraser"> </i>Reiniciar</button>	
            </p>
          </form>
  	</article>
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
              url:"js/lista.php",
              data:"condominio=" + $('#lista1').val(),
              success:function(r){
                $('#select2lista').html(r);
		}
              });
            }
	</script>
	<!-- Fin de Script -->
  	<article class="col-2"></article>
      </section>		
    </div>
    <div class="tab-pane fade" id="actualizar" role="tabpanel" 	aria-labelledby="actualizar-tab">
			<p class="container-fluid"><strong><i class="la la-book"></i> Instrucciones:</strong> Complete todos los datos del formulario.</p>
  		<!--Aquí Inicia el Formulario -->
  		<section id="consultamc" class="row">
  			<article class="col-2"></article>
  			<article class="col-8">
  				<form class="mt-4" action="js/actualizarpago.php" method="post" accept-charset="utf-8">
	  				<div class="row input-group">
					    <div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select id='lista3' class="form-select" name="condominio" required>
									<option value="" selected>Seleccione:</option>
									<?php
									    $query = $conexion->query ("SELECT * FROM condominios");
									    while ($valores = mysqli_fetch_array($query)) {
									        echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
								</select>
							</div>
							<div class="col" id="select3lista">
								
							</div>
					    <div class="col">
						    <label for="fecha"><i class="la la-calendar"></i> Fecha</label>
						    <input type="date" class="form-control" name="fecha" placeholder="00/00/0000" required>
					  	</div>
					  	<div class="col">
						    <label for="referencia"><i class="la la-barcode"></i> Nº Referencia:</label>
						    <input type="number" class="form-control" name="referencia" placeholder="00000000">
					  	</div>
					  </div>
					  <br>
					  <p style="text-align: center;">
					  	<button type="submit" class="btn btn-success btn-lg"><i class="las la-pen"></i> Actualizar</button>
					  	<button type="reset" class="btn btn-danger btn-lg"><i class="las la-eraser"></i> Reiniciar</button>	
					  </p>
					</form>
  			</article>
  			<!-- Script para Select Dinámico -->
				<script type="text/javascript">
					$(document).ready(function(){
						$('#lista3').val();
						recargarLista1();

						$('#lista3').change(function(){
						recargarLista1();});
					})
				</script>
				<script type="text/javascript">
					function recargarLista1(){
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
  			<article class="col-2"></article>
			</section>		
  	</div>
    <!-- Inicio Añadir Saldo -->
    <div class="tab-pane fade" id="saldo" role="tabpanel" aria-labelledby="saldo-tab">
      <section class="row mt-4">
        <article class="col"></article>
        <article class="col-10">
          <form action="js/agregarsaldo.php" method="POST" accept-charset="utf-8">
            <div class="row form-group">
              <div class="col">
                <label for="condominio"><i class="la la-city"></i> Condominio</label>
                <select id='lista4' class="form-select" name="condominio" required>
                  <option value="" selected>Seleccione:</option>
                  <?php
                      $query = $conexion->query ("SELECT * FROM condominios");
                      while ($valores = mysqli_fetch_array($query)) {
                          echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
                </select>
              </div>
              <div class="col" id="select4lista">
                
              </div>
              <div class="col">
                <label for="descripcion"> Descripción</label>
                <textarea class="form-control" aria-label="descripcion" name="descripcion"></textarea>
              </div>
            </div>
            <div class="row form-group">
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
            </div>
            <br>
            <p style="text-align: center;">
                <button type="submit" class="btn btn-success btn-lg"><i class="las la-plus"> </i>Añadir</button>
                <button type="reset" class="btn btn-danger btn-lg"><i class="las la-eraser"> </i>Reiniciar</button> 
            </p>
          </form>
        </article>
        <article class="col"></article>
      </section>
    </div>
    <!-- Script para Select Dinámico en Añadir Saldo a Favor -->
      <script type="text/javascript">
        $(document).ready(function(){
          $('#lista4').val();
          recargarLista3();

          $('#lista4').change(function(){
          recargarLista3();});
        })
      </script>
      <script type="text/javascript">
        function recargarLista3(){
          $.ajax({
                  type:"POST",
                  url:"js/lista.php",
                  data:"condominio=" + $('#lista4').val(),
                  success:function(r){
                    $('#select4lista').html(r);
                  }
                });
        }
      </script>
      <!-- Fin de Script -->
    <!-- Fin Añadir Saldo -->
    <!-- Inicio Buscar -->
  	<div class="tab-pane fade" id="buscar" role="tabpanel" aria-labelledby="buscar-tab">
  		<div class="container-fluid">
		   <section class="row mt-4">
		    <article class="col">
		     <div class="container">
		      <form action="js/consultapagos.php" method="post" accept-charset="utf-8">
		       <div class="row input-group">
		       		<div class="col">
								<label for="condominio"><i class="la la-city"></i> Condominio</label>
								<select class="form-select" name="condominio" id="lista5">
								  <option value="0">Seleccione:</option>
								  <?php
								    $query = $conexion->query("SELECT * FROM condominios");
								    while ($valores = mysqli_fetch_array($query)) {
								     echo '<option value="'.$valores[ID].'">'.$valores[NombreC].'</option>';}?>
					      </select>
					    </div>
			        <div class="col" id="selectlista5">
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
								<button type="submit" class="btn btn-primary form-control" style="margin-top: 30px;"><i class="las la-search"></i> Buscar</button>
							</div>
		  				</div>
		    		</form>
		    		<!-- Script para Select Dinámico -->
						<script type="text/javascript">
							$(document).ready(function(){
								$('#lista5').val();
								recargarLista4();
								$('#lista5').change(function(){
								recargarLista4();});
							})
						</script>
						<script type="text/javascript">
							function recargarLista4(){
								$.ajax({
												type:"POST",
												url:"js/lista.php",
												data:"condominio=" + $('#lista5').val(),
												success:function(r){
													$('#selectlista5').html(r);
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
		<div class="tab-pane fade" id="tasa" role="tabpanel" aria-labelledby="tasa-tab">
			<div class="container-fluid">
				<article class="col"></article>
				<article class="col">
					<form action="js/agregartasa.php" method="post" accept-charset="utf-8">
						<div class="row input-group">
							<div class="col">
								<label for="tasa"><i class="la la-coins"></i> Tasa Bs.:</label>
					   <input type="number" class="form-control" name="tasa" placeholder="73567,00" step="any" required>
							</div>
							<div class="col">
								<label for="fecha"><i class="la la-calendar"></i> Fecha</label>
						    <input type="date" class="form-control" name="fecha" placeholder="00/00/0000" required>
							</div>
							<div class="col">
								<br>
									<button type="submit" class="btn btn-success btn-lg"><i class="las la-plus"> </i>Añadir</button>
					  	<button type="reset" class="btn btn-danger btn-lg"><i class="las la-eraser"> </i>Reiniciar</button>	
							</div>
						</div>
					</form>
				</article>
				<article class="col"></article>
			</div>
		</div>

	<!--Fin Formulario -->
	</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>