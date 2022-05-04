<?php
	define("HOST", "localhost");
    define("USUARIO", "administrador");
    define("CLAVE", "jean9010jcBD");
    define("BD", "condominio");    
    /* Entrega un objeto con la conexión MySQL */
    function conectObj(){
        $my = new mysqli(HOST, USUARIO, CLAVE, BD);
        if($my->connect_errno){
            echo "<p>No se ha logrado la conexión</p>";
            exit(0);
        }else return $my;
    }
?>