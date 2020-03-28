<?php 
	require('conexion.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div align="center">                        
    <p>Seleccione un condominio del siguiente menú:</p>
    <p>Condominio:
      <select>
        <option value="0">Seleccione:</option>
        <?php
          $query = $conexion -> query ("SELECT Nombre FROM condominios");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID].'">'.$valores[Nombre].'</option>';
          }
        ?>
      </select>
      <button>Enviar</button>
    </p>
  </div>
</body>
</html>