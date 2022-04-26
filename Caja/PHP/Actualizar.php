<?php
  require_once 'Conexion.php';
  if($cn==0){
    echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
  }else{
    $sql = "SELECT Num_Pedido FROM pedidos WHERE Estado = 'Despachado'";
    $ejecuta_sentencia = $link->query($sql);
    if(!$ejecuta_sentencia){
      echo'hay un error en la sentencia de sql: '.$sql;
    }else{
      $lista_pedidos = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
      $Npedido = intval($lista_pedidos['Num_Pedido']);
      $sql = "UPDATE `pedidos` SET `Estado`= 'Pagado' WHERE Num_Pedido = '$Npedido'";
      $ES = $link->query($sql);
      if(!$ES){
        echo "error ".$sql;
      }
      else {
        echo "1";
      }
    }
  }
?>
