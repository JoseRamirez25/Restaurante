<?php
  require_once 'Conexion.php';
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $imagen = $_POST['imagen'];
    $ID = $_POST['id'];
  if($cn==0){
    echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
  }
  else {

    $sql = "UPDATE `ingredientes` SET `Ingrediente`='$nombre',`Precio`='$precio',`Imagen`='$imagen',`Cantidad`='$cantidad',`ID_ingrediente`='$ID' WHERE  ID_ingrediente = '$ID'";
    $ejecuta_sentencia = $link->query($sql);
    if (!$ejecuta_sentencia) {
      echo "fallo la sentencia".$sql;
    }
    else {
      echo "1";
    }
  }
?>
