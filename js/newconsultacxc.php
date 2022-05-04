<?php  
//Clase Base de Datos
require_once '../class/ConexionBD.php';
include('../conexion.php');
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
  <style type="text/css" media="print">
          /* Reglas CSS específicas para imprimir */
        #menu, #pie, #encabezado {display: none !important;}
        .saltoDePagina { display:block;
                        page-break-before:always;}
            th, tr, td { font: 11px Arial}
            .titulo {font: 14px Arial;}
        </style>
</head>
<body>
  <div class="container-fluid">
    <!--INICIO BARRA NAVEGACIÓN -->
  <div id="menu">
  <ul class="nav justify-content-center bg-primary" id="navegación">
    <li class="nav-item">
      <a class="nav-link active text-light border-start border-white" href="../index.html"><i class="las la-grip-horizontal"></i> Inicio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="../condominio.php"><i class="las la-city"></i> Condominio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="../propietarios.php"><i class="las la-user-alt"></i> Propietarios</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="../proveedores.php"><i class="las la-store-alt"></i> Proveedores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="../pagos.php"><i class="las la-donate"></i> Pagos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="../gastos.php"><i class="las la-file-invoice-dollar"></i> Gastos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="../avisos.php"><i class="las la-receipt"></i> Avisos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white" href="../cxc.php"><i class="las la-cash-register"></i> Cuentas x Cobrar</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light border-start border-white border-end" href="../cxp.php"><i class="las la-credit-card"></i> Cuentas x Pagar</a>
    </li>
  </ul>
  </div>
  <!--FIN BARRA NAVEGACIÓN -->
    <header id="encabezado">
      <h1><img src="../img/caja-registradora.png" class="img-fluid" width="10%" height="10%" alt="Cuentas por Cobrar"> MÓDULO 7: CUENTAS POR COBRAR</h1><br>
    </header>
    <section class="row">
      <article class="col"></article>
      <article class="col-8">

        <?php
        //Recibimos los datos
        //Número de Inmueble
        $idpropietario = $_POST['inmueble'];
        //var_dump($idpropietario);
        //Condominio
        $idcondominio = $_POST['condominio'];
        //Mes
        $mes = $_POST['mes'];
        //Año
        $year = $_POST['year'];

        #NOMBRE DEL CONDOMINIO
        if($idcondominio == 2) { $condominio = "JUNTA CENTRAL RES. SAN FRANCISCO";}
          else {$condominio = "SAMAN";}

        #LA TASA
        //Buscar Tasa Dólar para gasto
        /*$bidtasa = $conexion->query("SELECT MAX(tasabcv.ID) AS ID FROM tasabcv");
        $arrayidTasa = $bidtasa->fetch_array(MYSQLI_ASSOC);
        foreach ($bidtasa as $uid) {
          $id = $uid['ID'];
        }*/
        $bidtasa = $conexion->query("SELECT MAX(tasaparalelo.ID) AS ID FROM tasaparalelo");
        $arrayidTasa = $bidtasa->fetch_array(MYSQLI_ASSOC);
        foreach ($bidtasa as $uid) {
          $id = $uid['ID'];
        }

        $btasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
        $arrayTasa = $btasa->fetch_array(MYSQLI_ASSOC);
        foreach ($btasa as $valort) { $tasa1 = $valort['Apertura']; $tasa2 = $valort['Cierre']; }

        if ($tasa2 == 0) {
        	$tasa2 = $tasa1;
        }

        #BUSQUEDA PROPIETARIO TODA LA DEUDA
        if(empty($mes AND $year) AND $idpropietario !== 'todos') {
        $buscarDeuda = new ConectarBd();
        if($resultado=$buscarDeuda->BuscarUnion("cxc","idpropietario = '$idpropietario' ORDER BY Emision ASC")) {?>
              <h2>CONDOMINIO <?php echo $condominio; ?></h2>
              <h3>DEUDA DE CONDOMINIO ACTUALIZADA</h3><br>
              <table class='table table-striped table-hover'>
                  <thead>
                  <tr>
                      <th scope='col' class="text-center">#</th>
                      <th scope='col' class="text-center">NOMBRE</th>
                      <th scope='col' class="text-center">DESCRIPCION</th>
                      <th scope='col' class="text-center">MONTO $</th>
                      <th scope='col' class="text-center">MONTO Bs./Nva Exp.</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php foreach ($resultado AS $fila) {
                $montodolar = $fila['Dolar'];
                $montobolivar = $montodolar * $tasa2;
                $montobr = round($montobolivar,2);
                $nvaExp = $montobolivar/1000000;
                $montoBd = round($nvaExp,2);
                echo '<tr>';
                echo '<td>'. $fila['Inmueble'].'</td>';
                echo '<td>'. $fila['Nombre'].'</td>';
                echo '<td>'. $fila['Descripcion'].'</td>';
                echo '<td>'. $montodolar .'</td>';
                echo '<td>'. number_format($montobr, 2, ',', '.').' ('.number_format($montoBd, 2, ',', '.').')</td>';}
                echo '</tr>';
            $totalDeuda = new ConectarBd();
            if($resultadoSumaD = $totalDeuda->Sumatoria("cxc", "Dolar", "idpropietario = '$idpropietario' AND Dolar > 0"))
                {foreach ($resultadoSumaD as $sumausd) {$sumatoriaD = $sumausd['sumatoria'];}}
            else {echo "Error, no se pudo obtener la sumatoria";}

            $calcbs = $sumatoriaD * $tasa2;
            $sumatoria = round($calcbs,2);
            $nvaExpT = $sumatoria/1000000;
            $nvaSumatoria = round($nvaExpT,2);
            echo "</tbody>
            </table>
            <br>
            <h2>Total de Cuentas por Cobrar: Bs. ".number_format($sumatoria, 2, ',','.').'('.number_format($nvaSumatoria,2,',','.').
                ") [$".number_format($sumatoriaD, 2, ',', '.')."]</h2>";
            }
        else {  echo "No hay registros"; }
            }
      #BUSQUEDA PROPIETARIO DEUDA POR MES
      elseif(!empty($mes AND $year) AND $idpropietario !== 'todos') {
            $buscarDeuda = new ConectarBd();
            if($resultado=$buscarDeuda->BuscarUnion("cxc","idpropietario = '$idpropietario' AND MONTH(Emision) = 
            '$mes' AND YEAR(Emision) = '$year'")) {?>
            <h2>CONDOMINIO <?php echo $condominio; ?></h2>
            <h3>DEUDA DE CONDOMINIO ACTUALIZADA</h3><br>
            <table class='table table-striped table-hover'>
                <thead>
                <tr>
                    <th scope='col' class="text-center">#</th>
                    <th scope='col' class="text-center">NOMBRE</th>
                    <th scope='col' class="text-center">DESCRIPCION</th>
                    <th scope='col' class="text-center">MONTO $</th>
                    <th scope='col' class="text-center">MONTO Bs.</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($resultado AS $fila) {
                    $montodolar = $fila['Dolar'];
                    $montobolivar = $montodolar * $tasa2;
                    $montobr = round($montobolivar,2);
                    echo '<tr>';
                    echo '<td>'. $fila['Inmueble'].'</td>';
                    echo '<td>'. $fila['Nombre'].'</td>';
                    echo '<td>'. $fila['Descripcion'].'</td>';
                    echo '<td>'. $montodolar .'</td>';
                    echo '<td>'. number_format($montobr, 2, ',', '.').'</td>';
                    echo '</tr>';
                }
                $totalDeuda = new ConectarBd();
                if($resultadoSumaD = $totalDeuda->Sumatoria("cxc", "Dolar", "idpropietario = '$idpropietario' AND Dolar > 0"))
                {foreach ($resultadoSumaD as $sumausd) {$sumatoriaD = $sumausd['sumatoria'];}}
                else {echo "Error, no se pudo obtener la sumatoria";}
                $calcbs = $sumatoriaD * $tasa2;
                $sumatoria = round($calcbs,2);
                echo "</tbody>
                      </table>
                      <br>
                      <h2>Total de Cuentas por Cobrar: Bs. ".number_format($sumatoria, 2, ',','.').
                                " ($".number_format($sumatoriaD, 2, ',', '.').")</h2>";
                }
                else {echo "No hay registros";}
            }
            #BUSQUEDA CONDOMINIO TODA LA DEUDA
            elseif(empty($mes AND $year) AND $idpropietario === 'todos') {
                $buscarDeuda = new ConectarBd();
                if($resultado=$buscarDeuda->BuscarUnion("cxc","idcondominio = '$idcondominio' ORDER BY idpropietario ASC")) {?>
                <h2>CONDOMINIO <?php echo $condominio; ?></h2>
                <h3>DEUDA DE CONDOMINIO ACTUALIZADA</h3><br>
                <table class='table table-striped table-hover'>
                    <thead>
                    <tr>
                        <th scope='col' class="text-center">#</th>
                        <th scope='col' class="text-center">NOMBRE</th>
                        <th scope='col' class="text-center">DESCRIPCION</th>
                        <th scope='col' class="text-center">MONTO $</th>
                        <th scope='col' class="text-center">MONTO Bs.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resultado AS $fila) {
                        $montodolar = $fila['Dolar'];
                        $montobolivar = $montodolar * $tasa2;
                        $montobr = round($montobolivar,2);
                        echo '<tr>';
                        echo '<td>'. $fila['Inmueble'].'</td>';
                        echo '<td>'. $fila['Nombre'].'</td>';
                        echo '<td>'. $fila['Descripcion'].'</td>';
                        echo '<td>'. $montodolar .'</td>';
                        echo '<td>'. number_format($montobr, 2, ',', '.').'</td>';
                        echo '</tr>';
                    }
                    $totalDeuda = new ConectarBd();
                    if($resultadoSumaD = $totalDeuda->Sumatoria("cxc", "Dolar", "condominios.ID = '$idcondominio' AND Dolar > 0"))
                        {foreach ($resultadoSumaD as $sumausd) {$sumatoriaD = $sumausd['sumatoria'];}}
                    else {echo "Error, no se pudo obtener la sumatoria";}
                    $calcbs = $sumatoriaD * $tasa2;
                    $sumatoria = round($calcbs,2);
                    echo "</tbody>
                        </table>
                        <br>
                        <h2>Total de Cuentas por Cobrar: Bs. ".number_format($sumatoria, 2, ',','.').
                                    " ($".number_format($sumatoriaD, 2, ',', '.').")</h2>";
                    }
                    else {  echo "No hay registros"; }
                    }
            elseif(!empty($mes AND $year) AND $idpropietario === 'todos') {
                    $buscarDeuda = new ConectarBd();
                    if($resultado=$buscarDeuda->BuscarUnion("cxc","idcondominio = '$idcondominio' AND MONTH(Emision) = 
                                    '$mes' AND YEAR(Emision) = '$year' ORDER BY idpropietario")) {?>
                    <h2>CONDOMINIO <?php echo $condominio; ?></h2>
                    <h3>DEUDA DE CONDOMINIO ACTUALIZADA</h3><br>
                    <table class='table table-striped table-hover'>
                        <thead>
                        <tr>
                            <th scope='col' class="text-center">#</th>
                            <th scope='col' class="text-center">NOMBRE</th>
                            <th scope='col' class="text-center">DESCRIPCION</th>
                            <th scope='col' class="text-center">MONTO $</th>
                            <th scope='col' class="text-center">MONTO Bs.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($resultado AS $fila) {
                            $montodolar = $fila['Dolar'];
                            $montobolivar = $montodolar * $tasa2;
                            $montobr = round($montobolivar,2);
                            echo '<tr>';
                            echo '<td>'. $fila['Inmueble'].'</td>';
                            echo '<td>'. $fila['Nombre'].'</td>';
                            echo '<td>'. $fila['Descripcion'].'</td>';
                            echo '<td>'. $montodolar .'</td>';
                            echo '<td>'. number_format($montobr, 2, ',', '.').'</td>';
                            echo '</tr>';
                        }
                        $totalDeuda = new ConectarBd();
                        if($resultadoSumaD = $totalDeuda->Sumatoria("cxc", "Dolar", "condominios.ID = '$idcondominio'
                            AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$year'"))
                            {foreach ($resultadoSumaD as $sumausd) {$sumatoriaD = $sumausd['sumatoria'];}}
                        else {echo "Error, no se pudo obtener la sumatoria";}
                        $calcbs = $sumatoriaD * $tasa2;
                        $sumatoria = round($calcbs,2);
                        echo "</tbody>
                        </table>
                        <br>
                        <h2>Total de Cuentas por Cobrar: Bs. ".number_format($sumatoria, 2, ',','.').
                            " ($".number_format($sumatoriaD, 2, ',', '.').")</h2>";
                        }
                        else {  echo "No hay registros"; }
                        }
            else {
                echo "Error grave";
            }
        ?>
        <div class="saltoDePagina"></div>
        <footer id="pie">
          <div class="row">
            <div class="col-2"></div>
            <div class="col">
              <p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="60px" height="60px"><br>Inicio</a></p>
            </div>
            <div class="col">
              <p style="text-align: center;"><a href="../cxc.php"><img src="../img/caja-registradora.png" width="50px" height="70px" alt="Cuentas por Cobrar"><br>Cuentas por Cobrar</a></p>
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