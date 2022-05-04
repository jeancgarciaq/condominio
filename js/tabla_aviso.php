<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<?php
#*** A PARTIR DE AQUÍ REALIZAR LA CONSULTA PHP PARA COLOCARLA EN EL CUERPO DEL CORREO ***#
//Conexión a la Base de Datos
require '../conexion.php';

//Ahora voy a recibir del Formulario los datos
$condominio = 4;//$_POST['condominio']; //id del condominio
$mes = 8;//$_POST['mes']; //mes del aviso de cobro
$year = 2021;//$_POST['year']; //año del aviso de cobro

//Establezco la tasa de cambio
//Primero se busca la tasa
$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
foreach($bId as $vid) {
  $id = $vid['id'];
}

$bTasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
foreach ($bTasa as $vTasa) {
  $tasaC = $vTasa['Cierre']; 
  $tasaA = $vTasa['Apertura'];
}

if($tasaC == 0) {
	$tasa = $tasaA;
} else { $tasa = $tasaC;}

/* Se va a crear un Bucle que buscará los datos de los propietarios que coincidan con el id del condominio
* En el caso del Samán es del 131 al 194
* Para establecer el número de veces que se ejecutará el bucle, se va realizar una consulta que determina el número de propietarios 
* del condominio a consultar, tomando como valor el id
*/
//Consulta para determinar el número de propietarios y determinar el número de veces que se va a ejecutar el bucle
$contar = $conexion->query("SELECT COUNT(ID) as registro FROM propietarios WHERE idcondominio = '$condominio'");
$arrayContar = $contar->fetch_array(MYSQLI_ASSOC);
foreach($contar as $todos) {
  $enum = $todos['registro'];}
  $enum = 1;
//Vamos a extraer el primer ID del propietario que coincide con el ID del Condominio
$maximoId = $conexion->query("SELECT MAX(ID) as ID FROM propietarios WHERE idcondominio = '$condominio'");
$arrayMaximoId = $maximoId->fetch_array(MYSQLI_ASSOC);
foreach($maximoId as $maxId) {
  $idMax = $maxId['ID'];}

//Lo deducimos al restar el número de registro al máximo id
$ajustarId = $enum - 1;
//echo $ajustarId.'<br>';
$primerId = $idMax - $ajustarId;
//echo $primerId.'<br>';
//Las veces que se va ejecutar
$primerId = 131;

//Ahora vamos a usar un bucle While que nos permita ejecutar un código
for ($i = 1; $i <= $enum; $i++) {
    
  //Buscar información del propietario
  $idpropietario = $primerId++;
	$bcondomino = $conexion->query("SELECT * FROM propietarios WHERE ID = '$idpropietario'");
	$arrayCondomino = $bcondomino->fetch_array(MYSQLI_ASSOC);
	foreach ($bcondomino as $condomino) {
	$inmueble = $condomino['Inmueble'];
	//var_dump($inmueble);
	$nombrep = $condomino['Nombre'];
	//var_dump($nombrep);
	$alicuota = $condomino['Alicuota'];
	//var_dump($alicuota);
	$correo = $condomino['Correo'];
	//var_dump($correo);
	}
	//Ajustar la Alicuota
	$alicuota = $alicuota * 100;
	$alicuotar = round($alicuota,2);
	//Fecha
	$fecha = date("d/m/Y");
	//Buscar la sumatoria de los Gastos
	$bSgasto = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM gastos WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$condominio'");
	$arraySg = $bSgasto->fetch_array(MYSQLI_ASSOC);
	foreach ($bSgasto as $suma) {
		$totalgt = $suma['sumatoria'];}

	//Buscar la sumatoria de las Cuotas
	$bScuotas = $conexion->query("SELECT SUM(Montobs) as sumatoria FROM cuotas WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio = '$condominio'");
	$arraySc = $bScuotas->fetch_array(MYSQLI_ASSOC);
		foreach ($bScuotas as $sum) {
			$mtotal = $sum['sumatoria'];}

	//Buscar la información de las Cuotas
	$bCuotas = $conexion->query("SELECT * FROM cuotas WHERE MONTH(Fecha) = '$mes' AND YEAR(Fecha) = '$year' AND idcondominio='$condominio'");
	$arrayGasto = $bCuotas->fetch_array(MYSQLI_ASSOC);
	foreach ($bCuotas as $monto) {
		$descripcionC = $monto['Descripcion'];
		$montodc = $monto['Montobs'];}
#*** FIN LA CONSULTA PHP PARA COLOCARLA EN EL CUERPO DEL CORREO ***#

//Create una variable de instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    
	//Código para poder enviar desde un localhost
	$mail->SMTPOptions = array(
		'ssl' => array (
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true));
    //Server settings
    $mail->SMTPDebug = 0; 																		//SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP();                                          //Send using SMTP
    $mail->CharSet = 'UTF-8';																	//Código de caracteres
    $mail->Host       = 'smtp.gmail.com';               	    //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
    $mail->Username   = 'asesoriavictoryca@gmail.com';        //SMTP username
    $mail->Password   = 'jean9010jcAV';                       //SMTP password
    $mail->SMTPSecure = 'ssl';																//Encriptación ssl para gmail
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
    $mail->Port       = 465;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('administradoravictoryca@gmail.com', 'Administradora Victory C.A.');
    $mail->addAddress('jeansiervodedios@gmail.com', 'Jean Carlo Garcia');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('administradoravictoryca@gmail.com', 'Administradora Victory C.A.');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Esto es una prueba';
    //Aquí va el cuerpo de las consultas
    $mail->Body    = '<p>Buen día, a continuación el Aviso de Cobro correspondiente al mes de Septiembre.</p>
    									<h1 style:"text-align: center;">Aviso de Cobro</h1>
    									<table style:"text-align: center;" width="100%">
    										<thead>
    											<tr>
    												<th scope="col" width="40%" style:"text-align: center;">Propietario</th>
    												<th scope="col "width="30%" style:"text-align: center;">Inmueble</th>
    												<th scope="col" "width="30%" style:"text-align: center;">Alicuota</th>
    											</tr>
    										</thead>
    										<tbody style="text-align:center;">
    											<tr>
    												<td style="text-align:center;">'.$nombrep.'</td>
    												<td style="text-align:center;">'.$inmueble.'</td>
    												<td style="text-align:center;">'.$alicuota.'%</td>
    											</tr>
    										</tbody>
    									</table>

    									<p>Sin más que agregar, atentamente,</p>
    									<p>Administradora Victory</p> 
    									<img src="../img/Logo.png" alt="Logo" width="60px" height="60px"><br>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo '<p style="text-align:center">El mensaje fue enviado con éxito</p>
    <footer id="pie">
			<div class="row">
				<div class="col-4"></div>
				<div class="col-2">
					<p style="text-align: center;"><a href="../index.html"><img src="../img/Logo.png" width ="60px" height="60px"><br>Inicio</a></p>
				</div>
				<div class="col-2">
					<p style="text-align: center;"><a href="../avisos.php"><img src="../img/recibo.png" width="60px" height="60px"><br>Avisos</a></p>
					</div>
					<div class="col-4"></div>
				</div>
		</footer>';} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar. Mailer Error: {$mail->ErrorInfo}<br>
    <footer id="pie">
			<div class="row">
				<div class="col-4"></div>
				<div class="col-2">
					<p style="text-align: center;"><img src="../img/Logo.jpg" alt="Logo" width="60px" height="60px"><br>Inicio</a></p>
				</div>
				<div class="col-2">
					<p style="text-align: center;"><a href="../avisos.php"><img src="../img/recibo.png" width="60px" height="60px"><br>Avisos</a></p>
					</div>
					<div class="col-4"></div>
				</div>
		</footer>';
}

}