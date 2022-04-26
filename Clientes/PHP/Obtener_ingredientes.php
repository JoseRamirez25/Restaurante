<?php
require_once 'Conexion.php';
$cif=0;
$p=0;
$in=0;
if($cn==0){
  echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
}else{
    $sql = "SELECT * FROM ingredientes";
    $ejecuta_sentencia = $link->query($sql);
    $sql2 = "SELECT * FROM productos WHERE Producto = 'Perro'";
    $ejecuta_sentencia2 = $link->query($sql2);
    if(!$ejecuta_sentencia){
      echo'hay un error en la sentencia de sql: '.$sql;
    }else{
      $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);

      for($i=0; $i<$lista_ingredientes; $i++){
        $cif=intval($lista_ingredientes['Cantidad']);
        if ($cif>0) {
          $precio[$i] = intval($lista_ingredientes['Precio']);
          $nombre[$i] = $lista_ingredientes['Ingrediente'];
          $url[$i] = $lista_ingredientes['Imagen'];
          $cant[$i] = intval($lista_ingredientes['Cantidad']);
          $IDing[$i] = intval($lista_ingredientes['ID_ingrediente']);
          $in++;
          $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        }
        else {
          $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
          $i--;
        }
      }
    }
  }
    if(!$ejecuta_sentencia2){
      echo'hay un error en la sentencia de sql: '.$sql2;
    }else{
      $lista_productos = $ejecuta_sentencia2->fetch_array(MYSQLI_BOTH);

      for($i=0; $i<$lista_productos; $i++){
        $cantcp = intval($lista_productos['CantidadP']);
        if($cantcp > 0){
          $precioP[$i] = intval($lista_productos['PrecioP']);
          $nombreP[$i] = $lista_productos['Producto'];
          $urlP[$i] = $lista_productos['ImagenP'];
          $cantP[$i] = intval($lista_productos['CantidadP']);
          $IDprod[$i] = intval($lista_productos['ID_producto']);
          $p++;
          $lista_productos = $ejecuta_sentencia2->fetch_array(MYSQLI_BOTH);
        }
        else {
          $urlP[$i] = "Imagenes/cantP0.png";
          $precioP[$i] = intval($lista_productos['PrecioP']);
          $nombreP[$i] = "NN";
          $cantP[$i] = intval($lista_productos['CantidadP']);
          $IDprod[$i] = intval($lista_productos['ID_producto']);
          $i--;
          break;
        }
      }
    }
  mysqli_close($link)

?>
