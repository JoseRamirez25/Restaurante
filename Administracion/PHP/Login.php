<?php
  require_once 'Conexion.php';
  $nombre = $_POST['userN'];
  $pass = md5($_POST['userP']);
  if($cn==0){
    echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
  }
  else {
    $sql = "SELECT * FROM administracion where nombre = '$nombre' && pass = '$pass'";
    $ejecuta_sentencia = $link->query($sql);
    $lista = $ejecuta_sentencia->fetch_array(MYSQLI_BOTH);
    $n1[0] = $lista['nombre'];
    if ($n1[0] == $nombre) {
        echo "1";
      }
      else {
        echo $pass;
      }

  }
?>
