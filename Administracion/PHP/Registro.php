<?php
  require_once 'Conexion.php';
  $nombre = $_POST['userN'];
  $pass = md5($_POST['userP']);
  $doc = $_POST['userD'];
  $email = $_POST['userE'];
  if($cn==0){
    echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
  }
  else {
    $sql = "SELECT * FROM administracion where documento = '$doc'";
    $ejecuta_sentencia = $link->query($sql);
    $row_cnt = $ejecuta_sentencia->num_rows;
    if ($row_cnt==1) {
      echo "El documento $doc ya se encuentra registrado";
    }
    else {
    $sql = "INSERT INTO `administracion`(`nombre`, `pass`, `documento`, `email`) VALUES ('$nombre','$pass','$doc','$email')";
    $ejecuta_sentencia = $link->query($sql);
    if (!$ejecuta_sentencia) {
        echo "error";
      }
      else {
        echo "1";
      }
    }

  }
?>
