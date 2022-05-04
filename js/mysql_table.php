<?php 
ob_start();
//incluimos el archivo que genera los datos
//include_once('tabla_pdf.php');
//Incluimos la librería para poder utilizarla autoloader
require_once '../dompdf/autoload.inc.php';
require '../conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <style type="text/css" media="print">
      /* Reglas CSS específicas para imprimir */
      #menu, #pie {display: none !important;}
      .saltoDePagina { display:block;
                          page-break-before:always;}
      th, tr, td { font: 10px Arial}
      .titulo {font: 16px Arial;}
      @page {     
              size: portrait;
              /*size: landscape;*/
              size: letter;
            }
   </style>
</head>
<body>
  <?php 
  //Datos Básicos para armar el Aviso de Cobro
  $condominio = 4;
  $idpropietario = 131;
  $mes = 8;
  $year = 2021;
  //Buscamos la información del Condominio
  $infoC = $conexion->query("SELECT * FROM condominios WHERE ID = '$condominio'");
  $arrayInfo = $infoC->fetch_array(MYSQLI_ASSOC);
  foreach($infoC as $valor) {
    $nombre = $valor['NombreC'];
    $rif = $valor['RIF'];
    $direccion = $valor['Direccion'];
    $ciudad = $valor['Ciudad'];
    $estado = $valor['Estado'];}
  //Fin información del condominio

  //Establezco la tasa de cambio
  //Primero se busca la tasa
  $bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
  $arrayId = $bId->fetch_array(MYSQLI_ASSOC);
  foreach($bId as $vid) {$id = $vid['id'];}
  $bTasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
  $arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
  foreach ($bTasa as $vTasa) {
    $tasaC = $vTasa['Cierre']; 
    $tasaA = $vTasa['Apertura'];}
  if($tasaC == 0) {$tasa = $tasaA;} else { $tasa = $tasaC;}
  //Fin de la Tasa

  //<!-- Buscamos los Datos del Propietario -->
  $bPropietario = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
  $arrayPropietario = $bPropietario->fetch_array(MYSQLI_ASSOC);
  foreach ($bPropietario as $name) {
      $nombre = $name['Nombre'];
      $inmueble = $name['Inmueble'];
      $alicuota = $name['Alicuota'];
      $alicuotar = $alicuota * 100;
      $alicuotam = round($alicuotar,2);
      number_format($alicuotam, 2, '.', ',');
     //$alicuotam.'%';
                   }

  //Fecha de Hoy para el Aviso de Cobro
  $fecha = date("d/m/Y");

  ?>
  <!-- Inicio de Section que centra todo el contenido -->
  <section class="container-fluid" id="contenedor">
    <!-- El Encabezado del Documento -->
    <header>
      
      <p class="titulo" style="text-align: center;">
        <!--CONDOMINIO <?php //echo strtoupper($nombre);?>-->
        <img src="../img/logosaman.png" width="150px" height="78px"><br>
        RIF <?php echo $rif;?>
      </p>
      <p class="titulo" style="text-align: center;">
        <b><?php echo $direccion; ?></b><br>
        <b><?php echo $ciudad.', '.$estado; ?></b>
      </p>
    </header>
    <!-- Fin del Encabezado -->

    <!-- Título del Documento -->
      <hr style="border: solid 2px black;">
      <h2>Aviso de Cobro</h2>
    <!-- Fin del Título -->

  <!-- Inicio de las Tablas que contienen el Aviso de Cobro -->
  <article class="row">
      <div class="col-1"></div> 
      <div class="col">
        <!-- Aquí va 1 Tabla -->
        <!-- Tabla de Datos del Propietario -->
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col" class="text-center" style="border-bottom: 1px solid black;"><b>Propietario</b></th>
              <th scope="col" class="text-center" style="border-bottom: 1px solid black;"><b>Inmueble</b></th>
              <th scope="col" class="text-center" style="border-bottom: 1px solid black;"><b>Alicuota</b></th>
              <th scope="col" class="text-center" style="border-bottom: 1px solid black;"><b>Fecha</b></th>
            </tr>
          </thead>
          <tbody>  
            <tr>
              <td class="text-center">Nombre</td>
              <td class="text-center">Apartamento</td>
              <td class="text-center">Alicuota</td>
              <td class="text-center">Fecha</td>
            </tr>
          </tbody>
        </table>
        <?php echo $nombre;?>
        <?php echo $inmueble;?>
        <?php echo $alicuotam.'%';?>
        <?php echo $fecha;?>
      </div>
      <div class="col-1"></div>
  </article>
</section>
</body>
</html>
<?php

//Instanciamos la clase
//use Dompdf\Dompdf;
//Generar el Archivo PDF
# Instanciamos un objeto de la clase DOMPDF.
//$mipdf = new DOMPDF();

# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
//$mipdf ->set_paper("Letter", "portrait");

# Cargamos el contenido HTML.
//$mipdf ->load_html(ob_get_clean());

# Renderizamos el documento PDF.
//$mipdf ->render();

# Enviamos el fichero PDF al navegador.
//$mipdf->stream("Prueba.pdf", array("Attachment" => false));

//exit(0);
//echo $dompdf->output();
?>