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
    if(!$ejecuta_sentencia){
      echo'hay un error en la sentencia de sql: '.$sql;
    }else{
      $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);

      for($i=0; $i<$lista_ingredientes; $i++){
          $precio[$i] = intval($lista_ingredientes['Precio']);
          $nombre[$i] = $lista_ingredientes['Ingrediente'];
          $url[$i] = $lista_ingredientes['Imagen'];
          $cant[$i] = intval($lista_ingredientes['Cantidad']);
          $IDing[$i] = intval($lista_ingredientes['ID_ingrediente']);
          $in++;
          $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        }
      }
    }
  mysqli_close($link)

?>
