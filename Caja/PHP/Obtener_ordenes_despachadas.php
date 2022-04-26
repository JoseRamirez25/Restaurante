<?php
require_once 'Conexion.php';
$found = false;
$nombre[0] = "";
$CantI[0] = "";
$ingrediente[0] = "";
if($cn==0){
  echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
}else{
  $sql = "SELECT * FROM pedidos WHERE Estado = 'Despachado'";
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
        $lista_pedidos = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
      }
    $found = true;
    $j=0;
    $C2 = explode("," ,$CantI[0]);
    $I2 = explode("," ,$ingrediente[0]);
    for ($i=0; $i < sizeof($C2) ; $i++) {
      if ($C2[$i]!=0) {
        $CantIng[$j] = $C2[$i];
        $j++;
      }
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
        $cif=intval($lista_ingredientes['ID_ingrediente']);
        if ($cif==intval($I2[$j])) {
          $nombre[$i] = $lista_ingredientes['Ingrediente'];
          $precioIn[$i] = intval($lista_ingredientes['Precio']);
          $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
          $j++;
        }
        else {
          $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
          $i--;
        }
        if ($j==sizeof($I2)) {
          break;
        }
      }
    }
  }
}
mysqli_close($link)
?>
