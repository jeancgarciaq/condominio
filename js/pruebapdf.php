<?php
//Importamos la libreria
require("../fpdf/fpdf.php");
//La conexión a la base de Datos
include "../conexion.php";
//Datos del Formulario
//Ahora voy a recibir del Formulario los datos
$condominio = 4;    //$_POST['condominio']; //id del condominio
$mes = 8;           //$_POST['mes']; //mes del aviso de cobro
$year = 2021;       //$_POST['year']; //año del aviso de cobro



/*
//Establezco la tasa de cambio
//Primero se busca la tasa
$bId = $conexion->query("SELECT MAX(ID) AS id FROM tasaparalelo");
$arrayId = $bId->fetch_array(MYSQLI_ASSOC);
foreach($bId as $vid) {
  $id = $vid['id'];}

$bTasa = $conexion->query("SELECT * FROM tasaparalelo WHERE ID = '$id'");
$arrayTasa = $bTasa->fetch_array(MYSQLI_ASSOC);
foreach ($bTasa as $vTasa) {
  $tasaC = $vTasa['Cierre']; 
  $tasaA = $vTasa['Apertura'];
}

if($tasaC == 0) {
    $tasa = $tasaA;
} else { $tasa = $tasaC;}

//Buscamos la información del Condominio
$infoC = $conexion->query("SELECT * FROM condominios WHERE ID = '$condominio'");
$arrayInfo = $infoC->fetch_array(MYSQLI_ASSOC);
foreach($infoC as $valor) {
    $nombre = $valor['NombreC'];
    $rif = $valor['RIF'];
    $direccion = $valor['Direccion'];
    $ciudad = $valor['Ciudad'];
    $estado = $valor['Estado'];
}

class PDF extends FPDF{
        function Header(){
            $servidor = '127.0.0.1';
            $base = 'condominio';
            $user = 'administrador';
            $pass = 'jean9010jcBD';

            $conexion = new mysqli ($servidor, $user, $pass, $base);

            // Codificamos el juego de caracteres
            $conexion->set_charset('utf8mb4');

            if(mysqli_connect_errno($conexion)) {
                echo "Fallo al conectar a MySQL: " . mysqli_connect_error();}

            
            $condominio = 4;
            //Buscamos la información del Condominio
            $infoC = $conexion->query("SELECT * FROM condominios WHERE ID = '$condominio'");
            $arrayInfo = $infoC->fetch_array(MYSQLI_ASSOC);
            foreach($infoC as $valor) {
                $nombre = $valor['NombreC'];
                $rif = $valor['RIF'];
                $direccion = $valor['Direccion'];
                $ciudad = $valor['Ciudad'];
                $estado = $valor['Estado'];
            }

            $this->SetFont('Arial', 'B', 10);
            $this->Image('../img/logosaman.png', 1, 1, 3);
            $this->Cell(3,3.8,'$rif',0,0,'C');
            $this->Cell(6);
            $this->SetFont('Arial', '', 24);
            $this->Cell(10, 2, utf8_decode('AVISO DE COBRO'), 1, 1, 'C');
            $this->Line(1.0,3.5,20.0,3.5);
        }
        function Body(){}
            /* INICIA CONSULTA PARA ELABORAR EL AVISO DE COBRO */
            //Primero vamos a extraer los datos de la tasa de Cambio

     /*********       $hay = $stm->num_rows();
            if($hay==0){
                $this->Cell(10, 3, "No hay registros que mostrar", 1, 1, 'C');
            }else{
                $this->SetFont("Arial", 'B', 14);
                $this->Ln();
                $this->SetTextColor(62, 72, 204);
                $this->Cell(10,1,"Nombre", 1, 0, 'C');
                $this->Cell(4.5,1,"Inmueble", 1, 0, 'C');
                $this->Cell(4.5,1,"Alicuota", 1, 1, 'C');
                $this->SetFont("Arial", '', 14);
                $this->SetTextColor(0, 0, 0);
                while($stm->fetch()){
                    $nombre = utf8_decode($nombre);
                    $this->Cell(10,1,$nombre, 1, 0, 'C');
                    $this->Cell(4.5,1,$inmueble, 1, 0, 'C');
                    $this->Cell(4.5,1,$alicuota, 1, 1, 'C');
                }
            }
            //Cerramos la consulta
            $stm->close();
        }*********/
  /*      function Footer(){
            $this->SetY(-2);
            $this->SetFont("Arial", 'I', 10);
            $this->Line(1.0,25.7,20.0,25.7);
            $this->Image("../img/Logo.png", 6, 26, 1);
            $this->Cell(0, 1, "Elaborado por Administradora Victory C.A.", 0, 0, 'C');
        }
    }
    $pdf = new PDF('P', 'cm','letter');
    $pdf->SetAuthor("Administradora Victory", true);
    $pdf->SetTitle("Aviso de Cobro", true);
    $pdf->AddPage();
    $pdf->Body();
    // Encabezado del documento
    $pdf->Output();
    //$pdf->Output("F", "C:/xampp/htdocs/condominio/avisos/Documento Final.pdf"); */
?>