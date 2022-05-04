<?php  
//Conexión a la base de datos
require_once '../conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Módulo 7</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" type="text/css" href="../css/line-awesome.min.css">
</head>
<body>
  <div class="container-fluid">
    <!-- INICIO MENU -->
    <ul class="nav justify-content-center bg-primary">
      <li class="nav-item">
        <a class="nav-link active text-light border-left" href="../index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../condominio.php"><i class="las la-city"></i> Condominio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light border-left" href="../propietarios.php"><i class="las la-user-alt"></i> Propietarios</a>
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
        <a class="nav-link text-light border-left border-right" href="../cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
      </li>
    </ul>
    <!-- FIN MENU -->
    <h1><img src="../img/caja-registradora.png" class="img-fluid" width="10%" height="10%" alt="Cuentas por Cobrar"> MÓDULO 7: CUENTAS POR COBRAR</h1><br>
    <section class="row">
      <article class="col"></article>
      <article class="col-8">
        <h2>ESTADO DE CUENTA</h2>
        <?php
        //Recibimos los datos
        //Número de Inmueble
        $idpropietario = $_POST['inmueble'];
        //var_dump($inmueble);
        //Condominio
        $idcondominio = $_POST['condominio'];
        //Mes
        $mes = $_POST['mes'];
        //Año
        $year = $_POST['year'];

        //Ahora trabajo con una tabla relacionalç
        //En primer lugar establezco el id del condominio
        //Mejor trabaja con switch para poder añadir con facilidad otros casos
        switch ($idcondominio) {
          case 1:
            $condominio = "Edificio Bucare";
            break;
          default:
            $condominio = "Res. San Francisco";
            break;
        }
        //Aquí mantengo la condición de todos
        if($idpropietario == 'todos') {
          $nombre = 'todos';
          $inmueble = 'PB';
        }
        else {
            //Primero busco el nombre y lo guardo
            $bnombre = $conexion->query("SELECT * from propietarios WHERE ID = '$idpropietario'");
            $arrayN = $bnombre->fetch_array(MYSQLI_ASSOC);
            foreach ($bnombre as $fila) {
              $nombre = $fila['Nombre'];
              $inmueble = $fila['Inmueble'];}
            }
        ?>
        <!-- Ahora muestro el nombre y número de inmueble -->
          <p><b><i class="las la-city"></i> Condominio:</b> <?php echo strtoupper($condominio); ?></p>
          <p><b><i class="las la-user-alt"></i> Propietario:</b> <?php echo strtoupper($nombre); ?></p>
          <p><b><i class="la la-home"></i> Inmueble Nº:</b> <?php echo $inmueble; ?></p>
        <?php
        #INICIO SAN FRANCISCO BUSQUEDA TODOS
        if($idcondominio == 2 AND $nombre == 'todos') {
          if(empty($mes AND $year)) {
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Dolar) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
              /* liberar el conjunto de resultados */
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio'
                                                  ORDER BY idpropietario ASC");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO $</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo $deudores['Dolar'].'<br>';}
                $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: $ <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
            }//Fin Deuda Total
          else { //Inicio Deuda por Mes
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Dolar) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'
                                                  ORDER BY idpropietario ASC");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO $</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo $deudores['Dolar'].'<br>';}
                    $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: $ <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
          }//Fin Deuda por Mes
        }//FIN SAN FRANCISCO BÚSQUEDA TODOS
        #INICIO SAN FRANCISCO BUSQUEDA PROPIETARIO
        elseif($idcondominio == 2 AND $nombre != 'todos') {
          if(empty($mes AND $year)) {
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Dolar) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio' AND cxc.idpropietario = '$idpropietario'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio' AND cxc.idpropietario = '$idpropietario'
                                                  ORDER BY cxc.Emision ASC");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO $</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo $deudores['Dolar'].'<br>';}
                $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: $ <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
            }//Fin Deuda Total
          else { //Inicio Deuda por Mes
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Dolar) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' AND cxc.idpropietario = '$idpropietario'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' AND cxc.idpropietario = '$idpropietario'
                                                  ");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO $</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo $deudores['Dolar'].'<br>';}
                    $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: $ <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
          }//Fin Deuda por Mes
        }//FIN SAN FRANCISCO BÚSQUEDA PROPIETARIO
        #INICIO BUCARE BUSQUEDA TODOS
        elseif($idcondominio == 1 AND $nombre == 'todos') {
          if(empty($mes AND $year)) {
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Monto) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio'
                                                  ORDER BY idpropietario ASC");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO Bs.</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo number_format($deudores['Monto'], 2, ',', '.').'<br>';}
                    $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: Bs. <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
            }//Fin Deuda Total
          else { //Inicio Deuda por Mes
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Monto) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'
                                                  ORDER BY idpropietario ASC");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO Bs.</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo number_format($deudores['Monto'], 2, ',', '.').'<br>';}
                    $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: Bs. <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
          }//Fin Deuda por Mes
        }//FIN BUCARE BÚSQUEDA TODOS
        #INICIO BUCARE BUSQUEDA PROPIETARIO
        if($idcondominio == 1 AND $nombre != 'todos') {
          if(empty($mes AND $year)) {
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Monto) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio' AND cxc.idpropietario = '$idpropietario'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio' AND cxc.idpropietario = '$idpropietario'
                                                  ORDER BY idpropietario ASC");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO Bs.</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo number_format($deudores['Monto'], 2, ',', '.').'<br>';}
                    $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: Bs. <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
            }//Fin Deuda Total
          else { //Inicio Deuda por Mes
            //PASO 1: Calcular la Sumatoria de la Deuda, para ello se comprueba si es por mes o toda
            $buscarSumatoria = $conexion->query("SELECT SUM(Monto) AS sumatoria
                                                FROM cxc
                                                INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' AND cxc.idpropietario = '$idpropietario'");
            $arrayBuscarSumatoria = $buscarSumatoria->fetch_array(MYSQLI_ASSOC);
            foreach ($buscarSumatoria AS $suma) {
              $sumatoria = $suma['sumatoria'];}
            $buscarSumatoria->close();
            //PASO 2: Extraer toda la información
            $buscarDeudaTotal = $conexion->query("SELECT *
                                                  FROM cxc
                                                  INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                                                  LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                                                  WHERE condominios.ID = '$idcondominio' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year' AND cxc.idpropietario = '$idpropietario'
                                                  ORDER BY cxc.Emision ASC");
            $arrayBuscarDeudaTotal = $buscarDeudaTotal->fetch_array(MYSQLI_ASSOC);?>
            <!-- Empezamos Fabricar la Tabla -->
            <table class='table table-striped'>
            <thead>
              <tr>
                <th scope='col'>NOMBRE</th>
                <th scope='col'>#</th>
                <th scope='col'>DESCRIPCION</th>
                <th scope='col'>MONTO Bs.</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($buscarDeudaTotal AS $deudores) {?>
              <tr>
                <td><?php echo $deudores['Inmueble'].'<br>';?></td>
                <td><?php echo $deudores['Nombre'].'<br>';?></td>
                <td><?php echo $deudores['Descripcion'].'<br>';?></td>
                <td><?php echo number_format($deudores['Monto'], 2, ',', '.').'<br>';}
                $buscarDeudaTotal->close();
                ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <h2>Total de Cuentas por Cobrar: Bs. <?php echo number_format($sumatoria, 2, ',','.');?></h2>
            <?php
          }//Fin Deuda por Mes
        }//FIN SAN BUCARE BÚSQUEDA PROPIETARIO
        ?>
        <footer>
          <div class="row">
            <div class="col-2"></div>
            <div class="col">
              <p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
            </div>
            <div class="col">
              <p style="text-align: center;"><a href="../cxc.php"><img src="../img/caja-registradora.png" width="50px" height="70px"><br>Cuentas por Cobrar</a></p>
            </div>
            <div class="col"></div>
          </div>
        </footer>
      </article>
      <article class="col"></article>
    </section>
  </div>
</body>
</html>