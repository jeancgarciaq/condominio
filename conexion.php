<?php
//Conexion a Base de Datos por Procedimiento
// Realizamos la conexión
/*$conectar = mysqli_connect('localhost','administrador','jean9010jcBD','condominio');

// Codificamos el juego de caracteres
$conectar->set_charset('utf8');

if(mysqli_connect_errno($conectar)) {
  echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
}
else {
echo "<h1>Has realizado una conexión exitosa!!!</h1>";
}*/


// Conexion a Base de Datos por Objeto
// Defino Servidor, Base de Datos, Usuario y Clave
/*$servidor = 'sql212.byethost.com';
$base = 'b4_22428855_transfiero';
$user = 'b4_22428855';
$pass = 'jean9010jcFH';*/

$servidor = '127.0.0.1';
$base = 'condominio';
$user = 'administrador';
$pass = 'jean9010jcBD';

$conexion = new mysqli ($servidor, $user, $pass, $base);

// Codificamos el juego de caracteres
$conexion->set_charset('utf8mb4');

if(mysqli_connect_errno($conexion)) {
  echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
}
/*else {
echo "<h1>Has realizado una conexión exitosa!!!</h1>";
}*/

?>
