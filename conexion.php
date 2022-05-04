<?php
//Variables de conexión
$servidor = '127.0.0.1';
$base = 'condominio';
$user = 'administrador';
$pass = 'jean9010jcBD';

/*try {
      $conexion = new PDO("mysql:host=127.0.0.1;dbname=condominio", $user, $pass);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Conexión realizada Satisfactoriamente";
    }
 catch(PDOException $e) {
          echo "La conexión ha fallado: " .$e->getMessage();
       }

$conexion = null;*/       
$conexion = new mysqli("127.0.0.1", "root", "", "condominio");
if ($conexion->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
}
echo $conexion->host_info . "\n";
?>