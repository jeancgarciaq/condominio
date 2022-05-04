<?php  
//Clase Base de Datos
require_once '../conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Módulo 8</title>
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
    <section class="row">
      <article class="col"></article>
      <article class="col-8">
        <?php
        //Recibimos los datos
        //Condominio
        $idcondominio = $_POST['condominio'];
        //var_dump($idcondominio);
        //Mes
        $mes = $_POST['mes'];
        //var_dump($mes);
        //Año
        $year = $_POST['year'];
        //var_dump($year);

        if($idcondominio == 1) {

          $condominio = "EDIFICIO BUCARE";
        }
        elseif ($idcondominio == 2) {
          $condominio = "CONDOMINIO GENERAL RES. SAN FRANCISCO";
        }
        else {
          $condominio = "TORRE 1 DE RES. SAN FRANCISCO";
        }

        echo "<h1>CUENTA POR PAGAR DE <br>".$condominio."</h1><br>";

      if(empty($mes AND $year)) {
        $buscarcxp = $conexion->query("SELECT * FROM cxp WHERE idcondominio = '$idcondominio'");
        $arraybcxp = $buscarcxp->fetch_array(MYSQLI_ASSOC);
        
        ?>
              <table class='table table-striped'>
                  <thead>
                  <tr>
                      <th scope='col'>#</th>
                      <th scope='col'>DESCRIPCION</th>
                      <th scope='col'>MONTO $</th>
                      <th scope='col'>MONTO Bs.</th>
                      <th scope='col'>ESTADO</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php foreach ($buscarcxp AS $fila) {
                echo '<tr>';
                echo '<td>'. $fila['ID'].'</td>';
                echo '<td>'. $fila['Descripcion'].'</td>';
                echo '<td>'. $fila['Montousd'].'</td>';
                echo '<td>'. number_format($fila['Montobs'], 2, ',', '.').'</td>';
                echo '<td>'. $fila['Estado'].'</td>';
              }
                echo '</tr>';
            echo "</tbody></table><br>";}         
          
      #BUSQUEDA POR MES
      else {
        $buscarcxpm = $conexion->query("SELECT * FROM cxp WHERE idcondominio = '$idcondominio' AND MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year'");
        $arraybcxp = $buscarcxpm->fetch_array(MYSQLI_ASSOC);
            
            ?>
            <table class='table table-striped'>
                <thead>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>DESCRIPCION</th>
                    <th scope='col'>MONTO $</th>
                    <th scope='col'>MONTO Bs.</th>
                    <th scope='col'>ESTADO</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($buscarcxpm AS $filam) {
                echo '<tr>';
                echo '<td>'. $filam['ID'].'</td>';
                echo '<td>'. $filam['Descripcion'].'</td>';
                echo '<td>'. $filam['Montousd'].'</td>';
                echo '<td>'. number_format($filam['Montobs'], 2, ',', '.').'</td>';
                echo '<td>'. $filam['Estado'].'</td>';
              }
                echo '</tr>';
            echo "</tbody></table><br>";}
               
        ?>
        <footer>
          <div class="row">
            <div class="col-2"></div>
            <div class="col">
              <p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width="70px" height="70px"><br>Inicio</a></p>
            </div>
            <div class="col">
              <p style="text-align: center;"><a href="../cxp.php"><img src="../img/factura.png" class="img-fluid" width="25%" height="35%" alt="Cuentas por Pagar"><br>Cuentas por Pagar</a></p>
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