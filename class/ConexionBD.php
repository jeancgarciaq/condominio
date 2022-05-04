<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConexionBD
 *
 * @author Usuario
 */
class ConectarBd
{
    private $host = "127.0.0.1";
    private $usuario = "administrador";
    private $clave = "jean9010jcBD";
    private $db = "condominio";
    public $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->db);

        if(mysqli_connect_errno($this->conexion)) {
            echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
        } else {
        $this->conexion->set_charset("utf8");}
    }

    //INSERTAR
    public function Insertar($tabla, $datos)
    {
        $query = "INSERT INTO $tabla VALUES(NULL, $datos)";
        $resultado = $this->conexion->query($query);
        if ($resultado) {return true;} else {return false;}
    }

    //BUSCAR TODO
    public function Buscar($tabla, $condicion)
    {
        $query = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $this->conexion->query($query);
        if ($resultado) {return $resultado->fetch_all(MYSQLI_ASSOC);} else{return false;}
    }

    //BUSCAR UNIENDO TABLAS
    public function BuscarUnion ($tabla, $condicion)
    {
        $query = "SELECT * FROM $tabla 
                    INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario 
                    LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio 
                    WHERE $condicion";
        $resultado = $this->conexion->query($query);
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    //ACTUALIZAR
    public function Actualizar($tabla, $campos, $condicion) {
        $query = "UPDATE FROM $tabla SET $campos WHERE $condicion";
        $resultado = $this->conexion->query($query);
        if($resultado){return true;} else {return false;}
    }

    //ELIMINAR
    public function Borrar($tabla, $condicion) {
        $resultado = $this->conexion->query("DELETE FROM $tabla WHERE $condicion")
            or die ($this->conexion->error);
    if($resultado){return true;} else{return false;}
    }

    //SUMATORIA
    public function Sumatoria($tabla, $campo, $condicion) {
        $query = "SELECT SUM($campo) AS sumatoria 
                    FROM $tabla
                    INNER JOIN propietarios ON propietarios.ID = cxc.idpropietario
                    LEFT JOIN condominios ON condominios.ID = propietarios.idcondominio
                    WHERE $condicion";
        $resultado = $this->conexion->query($query);
        if($resultado){return $resultado->fetch_all(MYSQLI_ASSOC);} else{return false;}
    }
}
    //BUSCAR ID Tasas
    /*public function Idtasa($tabla, $campo, $condicion) {

      //Buscar Tasa Dólar para gasto
      $query = "SELECT MAX($campo) AS ID FROM $tabla");
      $resultado = $this->conexion->query($bidtasa);
      if($resultado){return $resultado->fetch_all(MYSQLI_ASSOC);} else{return false;}

      /*$btasa = $conexion->query("SELECT * FROM tasabcv WHERE ID = '$id'");
      $arrayTasa = $btasa->fetch_array(MYSQLI_ASSOC);
      foreach ($btasa as $valort) {

        $tasa = $valort['tasa'];

      }

    }*/
//FALTA CREAR LAS FUNCIONES PARA BUSCAR LA DEUDA DEL CONDOMINIO