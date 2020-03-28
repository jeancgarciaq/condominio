<?php  
//Conexión a la base de datos
include '../conexion.php';
?>
<!DOCTYPE html>
<html>
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
    <h1><img src="../img/caja-registradora.png" class="img-fluid" width="10%" height="10%"> MÓDULO 7: CUENTAS POR COBRAR</h1><br>
    <section class="row">
      <article class="col"></article>
      <article class="col-8">
        <h2>Reporte Mensual de Cuentas por Cobrar al <?php $fecha?></h2>
        <?php
        //Recibimos los datos
        //Nombre del propietario
        $nombre = 'todos';
        //$nombre = $_POST['nombre'];
        //var_dump($nombre);
        //Número de Inmueble
        $inmueble = 'PB';
        //$inmueble = $_POST['inmueble'];
        //var_dump($inmueble);
        //Condominio
        //$condominio = $_POST['condominio'];
        $condominio = 'Edificio Bucare';
        //fecha
        $fecha = date('d-m-Y');
        //Mes
        $mes = '09';
        //Año
        $anno = '2019';

        
        //Consultar Deuda por Fecha
        $consultarDeuda = "SELECT * FROM cxc WHERE Condominio = 'Edificio Bucare' AND Estado = 'ADEUDADO' AND MONTH(Emision) = '$mes' AND YEAR(Emision) = '$anno' ORDER BY Emision ASC";
        $ejecutarConsulta = $conexion->query($consultarDeuda);
        $arrayDeuda = $ejecutarConsulta->fetch_array(MYSQLI_ASSOC);

        foreach ($ejecutarConsulta as $valor) {

          echo $valor['Nombre'].': '.number_format($valor['Monto'],2,'.',',').'<br>';
        }

        ?>
      </article>
      <article class="col"></article>
</body>
</html>