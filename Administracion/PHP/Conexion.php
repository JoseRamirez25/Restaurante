<?php
  $cn=0;
  $link = mysqli_connect('localhost', 'root', '', 'restaurante', '3306');
  if(!$link){
		echo'No Se Pudo Establecer Conexion Con El Servidor: '. mysql_error();
	}else{
    $cn=1;
  }
 ?>
