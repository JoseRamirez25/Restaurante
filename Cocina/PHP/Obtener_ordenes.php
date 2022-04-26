<?php
require_once 'Conexion.php';
$cif=0;
$nombre[0]="";
$empty=0;
$ingrediente=[];
if($cn==0){
  echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
}else{
  $sql = "SELECT * FROM pedidos WHERE Estado = 'Pendiente'";
  $ejecuta_sentencia = $link->query($sql);
  $filas =  mysqli_num_rows($ejecuta_sentencia);
  if(!$ejecuta_sentencia){
    echo'no se ejecuto la sentencia de sql: '.$sql;
  }else{
    if($filas!=0){
      $lista_pedidos = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
      $Npedido = intval($lista_pedidos['Num_Pedido']);
      $ingrediente = explode(",", $lista_pedidos['ID_ingrediente']);
      $CantI = explode(",", $lista_pedidos['CantPorIngrediente']);
      $j=0;
      for ($i=0; $i < sizeof($CantI) ; $i++) {
        if ($CantI[$i]!=0) {
          $CantIng[$j] = $CantI[$i];
          $j++;
        }
      }
      $sql = "SELECT Ingrediente, ID_ingrediente FROM ingredientes";
      $ejecuta_sentencia = $link->query($sql);
      if(!$ejecuta_sentencia){
        echo'hay un error en la sentencia de sql: '.$sql;
      }
      else {
        $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        $j=0;
        for($i=0; $i<$lista_ingredientes; $i++){
          $cif=intval($lista_ingredientes['ID_ingrediente']);
          if ($cif==intval($ingrediente[$j])) {
            $nombre[$i] = $lista_ingredientes['Ingrediente'];
            $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
            $j++;
          }
          else {
            $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
            $i--;
          }
          if ($j==sizeof($ingrediente)) {
            break;
          }
        }
      }
    }else {
      $empty=1;
    }
  }
}
mysqli_close($link)
?>
