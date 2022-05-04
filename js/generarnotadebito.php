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
  <title>Módulo 5</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" type="text/css" href="../css/line-awesome.min.css">
  <style media="print">
    #menu, #encabezado, #pie, #navegacion { display: none !important;}
  </style>
</head>
<body>
  <div class="container-fluid">
    <!-- INICIO MENU -->
    <ul class="nav justify-content-center bg-primary" id="menu">
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
  <!-- FORMULARIO -->
  <?php 
      $buscarNombre = $conexion->query("SELECT * from propietarios WHERE ID = 126");
      $arrayNombre = $buscarNombre->fetch_array(MYSQLI_ASSOC);
      foreach ($buscarNombre as $columna) {
        $nombre = $columna['Nombre'];
        $inmueble = $columna['Inmueble'];
        $idcondominio = $columna['idcondominio'];
      }

      if($idcondominio == 2) {
        $condominio = "Res. San Francisco";
      } else {
        $condominio = "Torre 1, Res. San Francisco";
      }

      $buscarIdRecibo = $conexion->query("SELECT MAX(ID) as ID FROM cxc WHERE idpropietario = 126");
      $arrayMaxId = $buscarIdRecibo->fetch_array(MYSQLI_ASSOC);
      foreach ($buscarIdRecibo as $fila) {
        $ID = $fila['ID'];
      }
      $buscarRecibo = $conexion->query("SELECT * FROM cxc WHERE ID = $ID");
      $arrayRecibo = $buscarRecibo->fetch_array(MYSQLI_ASSOC);
      foreach ($buscarRecibo as $valor) {
        $idn = $valor['ID'];
        $monto = $valor['Monto'];
        $montod = $valor['Dolar'];
        $descripcion = $valor['Descripcion'];
        $fecha = $valor['Emision'];
      }

      

  ?>

    <article class="container-fluid">
        <section class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <h2><?php echo 'Fecha: '.date("d/m/Y");?> | Nota de Débito # <?php echo date("m")."-".$idn;?></h2>
            <p><strong><i class="la la-signature"></i> Nombre: </strong> <?php   echo '<span>'.$nombre.'</span>';?></p>
            <p"><strong><i class="las la-hashtag"></i> # Inmueble:</strong> <?php   echo '<span>'.$inmueble.'</span>';?></p>
            <p><strong><i class="la la-city"></i> Condominio: </strong> <?php   echo '<span>'.$condominio.'</span>';?></p>
            <p><strong><i class="las la-coins"></i> Monto Bs.:</strong> <?php   echo '<span>'.number_format($monto, 2, ',','.').'</span>';?></p>
            <p><strong><i class="las la-dollar"></i> Monto $:</strong> <?php   echo '<span>'.number_format($montod, 2, ',','.').'</span>';?></p>
            <p><strong><i class="las la-file-alt"></i> Por Concepto de:</strong> <?php   echo '<span>'.$descripcion.'</span>';?></p>
            <p><strong><i class="las la-calendar"></i> Fecha:</strong> <?php   echo '<span>'.date("d/m/Y", strtotime($fecha)).'</span>';?></p>
          </div>
          <div class="col-2"></div>
        </section>   
  </article>

