<?php
include_once 'ConexionBD.php';

$user = new ConectarBd();

//Forma de usar: Insertar
/*$u = $user->Insertar("nombre_tabla", "'dato1', 'dato2', 'dato3', 'etc'");
if($u){
echo "Insertado";}
else {
echo "No insertado";}*/

//Forma de usar: Buscar
if($resultado=$user->Buscar("propietarios", "ID = 1")) {
  foreach ($resultado AS $fila) {
    echo $fila['Nombre'].'<br>';
    echo $fila['Inmueble'];
  }
}
else {  echo "No hay registros"; }


//Forma de usar: Actualizar
/*$u = $user->Actualizar("nombre_tabla", "campo_actualizar='valor'", "condicion = valor");
if($u) {
  echo "Actualizado";}
else {
  echo "No actualizado";}*/

//Forma de usar: Borrar
  /*$u = $user->Borrar("nombre_tabla", "condicion=valor");
  if($u) {
    echo "Borrado";
  }
  else {
    echo "No Borrado";
  }*/