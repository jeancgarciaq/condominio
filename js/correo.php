<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../../vendor/autoload.php';

// INICIO DE CONSULTA ##->
//Conexión a Base de Datos
include '../conexion.php'; 
//Recibir los datos para el Recibo
//Propietario
//$propietario = $_POST['propietario'];
$propietario = 'Carmen Carreño';
//Número del Inmueble
//$inmueble = $_POST['inmueble'];
$inmueble = '16-C';
//Condominio
//$condominio = $_POST['condominio'];
$condominio = 'Edificio Bucare';
//Pago
//$monto = $_POST['monto'];
//condicion que debe ser conciliado
$condicion = 'SI';
//Estado
$estado = 'PAGADO';
//fecha
$fecha = date('d-m-Y');

//Buscar el Pago Conciliado
$buscarPago = "SELECT * FROM pagos WHERE Nombre = '$propietario' AND Conciliado = '$condicion'";
$ejecutarBusqueda = $conexion->query($buscarPago);
$arrayPago = $ejecutarBusqueda->fetch_array(MYSQLI_ASSOC);
$filaPago = $conexion->affected_rows;
$id = $arrayPago['ID'];

//Buscar Deuda Pagada
$buscarDeuda = "SELECT * FROM cxc WHERE Nombre = '$propietario' AND Estado = '$estado'";
$ejecutarBdeuda = $conexion->query($buscarDeuda);
$arrayDeuda = $ejecutarBdeuda->fetch_array(MYSQLI_ASSOC);
$filaDeuda = $conexion->affected_rows;


//Actualizar pago
$actualizarPago = "UPDATE pagos SET Recibo = 'SI' WHERE ID = '$id'";
$ejecutarActualizar = $conexion->query($actualizarPago);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Módulo 5</title>
  <link rel="stylesheet" type="text/css" href="C:/xampp/htdocs/condominio/css/bootstrap.min.css">
  <link rel="stylesheet" href="C:/xampp/htdocs/condominio/css/estilos.css">
  <link rel="stylesheet" type="text/css" href="C:/xampp/htdocs/condominio/css/line-awesome.min.css">
</head>
<body>
<?php if($condominio == 'Edificio Bucare')  { 
//FIN DE CONSULTA ##->

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'asesoriavictoryca@gmail.com';                     // SMTP username
    $mail->Password   = 'jean9010jcAV';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('pagocondominiobucare@gmail.com', 'Gestión de Cobranza Bucare');
    $mail->addAddress('jcvictory@hotmail.com', 'Jean Carlo Garcia');     // Add a recipient
    $mail->addAddress('blancacrivas@gmail.com');               // Name is optional
    $mail->addReplyTo('asesoriavictoryca@gmail.com', 'Administradora Victory C.A.');
    $mail->addCC('jeansierviodedios@gmail.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('../img/Logo.jpg', 'Ejemplo.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Esto es una Prueba';
    $mail->Body    = '
                      <div class="container-fluid">
                        <section class="row">
                          <article class="col"></article>
                          <article class="col align-self-center">
                            <p style="text-align: center;"><img class="img-fluid" src="C:/xampp/htdocs/condominio/img/Logo Bucare.png" alt="Condominio Edificio Bucare" width="50px" height="75px"><br> CONDOMINIO<br> EDIFICIO BUCARE<br>
                            RIF J-30871998-6   
                            </p>
                          </article>
                          <article class="col"></article>
                        </section>
                        <section class="row">
                          <article class="col"></article>
                          <article class="col">
                            <div class="row">
                              <div class="col" align="right"><p><b>Recibo Nº: </b>'.$id.'-'.$fecha.'</p></div>
                            </div><br>
                            <div class="row">
                              <div class="col-1"></div>
                              <div class="col"><p><b>Nombre:</b> '.$propietario.'</p></div>
                              <div class="col"><p><b>Inmueble:</b> '.$inmueble.'</p></div>
                            </div>
                            <div class="row">
                              <div class="col-1"></div>
                              <div class="col"><p><b>Condominio:</b> '.$condominio.'</p></div>
                              <div class="col"><p><b>Fecha:</b> '.date("d/m/Y", strtotime($fecha)).'</p></div>
                            </div><br><br>
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Descripcion</th>
                                  <th>Monto Bs.</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>'.$arrayDeuda["Descripcion"].'</td>
                                  <td>'.number_format($arrayPago["Monto"],2,",",".").'</td>
                                </tr>
                              </tbody>
                            </table><br>
                          </article>
                          <article class="col"></article>
                        </section>
                      </div>  
                    '; 

    //$mail->AltBody = 'Este es el cuerpo del mensaje en texto plano para clientes de correo que no manejan HTML';

    // Activo codificación utf-8
    $mail->CharSet = 'UTF-8';

    $mail->send();
    echo 'El Mensaje se ha enviado';
    } catch (Exception $e) {
        echo "El Mensaje no se ha Enviado. Error del Envío: {$mail->ErrorInfo}";
    } 
}