<?php
  require_once 'Conexion.php';
  $Npedido[0] = "";
  $nombre[0] = "";
  $ingrediente[0] = "";
  if($cn==0){
    echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
  }else{
    $sql = "SELECT * FROM `pedidos` WHERE Estado = 'Pagado' ORDER BY `pedidos`.`Num_Pedido` ASC";
    $ejecuta_sentencia = $link->query($sql);
    if(!$ejecuta_sentencia){
      echo'hay un error en la sentencia de sql: '.$sql;
    }else{
        $lista_pedidos = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        for($i=0; $i<$lista_pedidos; $i++){
          $Npedido[$i] = intval($lista_pedidos['Num_Pedido']);
          $ingrediente[$i] = $lista_pedidos['ID_ingrediente'];
          $CantI[$i] = $lista_pedidos['CantPorIngrediente'];
          $Precio[$i] = intval($lista_pedidos['Total']);
          $Fecha[$i] = $lista_pedidos['Fecha_Pedido'];
          $lista_pedidos = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        }
      $sql = "SELECT Ingrediente, ID_ingrediente, Precio FROM ingredientes";
      $ejecuta_sentencia = $link->query($sql);
      if(!$ejecuta_sentencia){
          echo'hay un error en la sentencia de sql: '.$sql;
      }
      else {
        $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        $j=0;
        for($i=0; $i<$lista_ingredientes; $i++){
            $IDing[$i]=intval($lista_ingredientes['ID_ingrediente']);
            $nombre[$i] = $lista_ingredientes['Ingrediente'];
            $precioIn[$i] = intval($lista_ingredientes['Precio']);
            $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        }
      }
    }
  }
  mysqli_close($link)
?>
