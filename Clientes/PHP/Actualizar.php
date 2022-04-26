<?php
  require 'Conexion.php';
  $in=0;
  $total=$_POST['total'];
  if($cn==0){
    echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
  }
  else{
    $sql = "UPDATE `productos` SET `CantidadP`= CantidadP-1";
    $ejecuta_sentencia = $link->query($sql);
    $sql = "SELECT * FROM ingredientes";
    $ejecuta_sentencia = $link->query($sql);
    if(!$ejecuta_sentencia){
      echo'hay un error en la sentencia de sql: '.$sql;
    }
    else{
      $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
      for($i=0; $i<$lista_ingredientes; $i++){
        $cif=intval($lista_ingredientes['Cantidad']);
        if ($cif>0) {
          $cant[$i] = intval($lista_ingredientes['Cantidad']);
          $nombre[$i] = $lista_ingredientes['Ingrediente'];
          $in++;
          $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
        }
        else {
          $lista_ingredientes = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
          $i--;
        }
      }
    }
    $pedAenviar="";
    $cantPedido="";
    for ($i=0; $i <sizeof($id_ingrediente=$_POST['salsas']); $i++) {
      if ($i==sizeof($id_ingrediente=$_POST['salsas'])-1) {
        $pedAenviar=$pedAenviar.$id_ingrediente[$i]."";
      }
      else {
        $pedAenviar=$pedAenviar.$id_ingrediente[$i].",";
      }
    }
    for($i=0; $i<$in; $i++){
        $cantidad=$_POST['cantidadin'];
        if ($i==$in-1) {
          $cantPedido=$cantPedido.$cantidad[$i]."";
        }
        else {
          $cantPedido=$cantPedido.$cantidad[$i].",";
        }
        $cantidad[$i] = $cant[$i] - $cantidad[$i];
        $sqlI="UPDATE `ingredientes` SET `Cantidad`= '$cantidad[$i]' WHERE Ingrediente = '$nombre[$i]'";
        $Acant = $link->query($sqlI);
        if(!$Acant){
          echo'hay un error en la sentencia de sql: ';
        }
    }
    if($Acant) {
      $sql="INSERT INTO `pedidos`(`ID_ingrediente`, `CantPorIngrediente`, `Estado`, `Total`, `Fecha_Pedido`) VALUES ('$pedAenviar','$cantPedido','Pendiente','$total',  CURDATE())";
      $inPedido = $link->query($sql);
      if ($inPedido) {
        echo "1";
      }
      else {
        echo "Fallo la sentencia".$sql;
      }
    }
  }
?>
