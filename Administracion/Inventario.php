<?php
 require_once 'PHP/Obtener_ingredientes.php';
?>

<!DOCTYPE html>
<html lang="es">
  <head><title>Inventario</title>
    <link rel="stylesheet" href="CSS/InventarioS1.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <script src="../Clientes/JS/jquery-3.4.1.min.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="tabla">
      <h1 id="h1I">Listado de Ingredientes</h1>
      <div class="busqueda">
          <span class="Bicon"><i class="fas fa-search"></i></span>
          <input id="searchTerm" type="search" onkeyup="doSearch()" autocomplete="off" placeholder="search"/>
      </div>
      <div class="tablaIN">
        <table id="tablaI">
          <tr>
            <th>Ingrediente</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>URL imagen</th>
            <th>ID Ingrediente</th>
          </tr>
          <?php for($i=0; $i<$in; $i++){ ?>
            <tr>
              <td><?php echo$nombre[$i] ?></td>
              <td><?php echo$precio[$i] ?></td>
              <td><?php echo$cant[$i] ?></td>
              <td><div class="url"><?php echo$url[$i] ?></div></td>
              <td><?php echo$IDing[$i] ?></td>
              <?php $vi=$i; ?>
            </tr>
          <?php }?>
        </table>
      </div>
        <form id="FormIns" method="post">
          <table class="insertar">
            <tr>
              <td>Ingrediente<br><input id="nI" name="nombre" type="text" autocomplete="off" placeholder="Ingrediete"></td>
              <td>Precio<br><input id="pI" name="precio" type="number" autocomplete="off" placeholder="Precio"></td>
              <td>Cantidad<br><input id="cI" name="cantidad" type="number" autocomplete="off" placeholder="Cantidad"></td>
              <td>URL imagen<br><input id="uI" name="imagen" type="text" autocomplete="off" placeholder="URL Imagen" value="Clientes/Imagenes/"></td>
              <td>ID producto<input id="idI" name="id" type="number" autocomplete="off" readonly max='<?php echo$vi+1 ?>' min="1" value='<?php echo$vi+2 ?>' onchange="bus()"></td>
            </tr>
          </table>
        </form>
        <input type="checkbox" id="ins">
        <label for="ins">Agregar</label>
        <input type="checkbox" id="mod">
        <label for="mod">Modificar</label>
        <input type="button" id="continuar" value="Continuar">
    </div>
  </body>
</html>
<script>
  $(document).ready(function(){

    $('#mod').click(function(){
      if($('#mod').is(':checked')){
        $('#ins').prop('checked', false);
        $('#idI').attr('readonly', false);
        alert("Para modificar llene la casilla 'ID producto' con el id del ingrediente a modificar");
        if ($('#idI').val()>=<?php echo$vi+1 ?>) {
          $('#idI').val('<?php echo$vi+1 ?>');
          $('#idI').change();
        }
      }
      else {
        $('#idI').attr('readonly', true);
      }
    })
    $('#ins').click(function() {
      if ($('#ins').is(':checked')){
        $('#mod').prop('checked', false);
        $('#nI').val('');
        $('#pI').val('');
        $('#cI').val('');
        $('#uI').val('');
        $('#idI').val('<?php echo$vi+2 ?>');
      }
    })
    $('#continuar').click(function(){
      var datos=$('#FormIns').serialize();
      if ($('#ins').is(':checked')){
        $.ajax({
          type:"POST",
          url:"PHP/Ingresar.php",
          data:datos,
        }).done(function(f){
          if (f==1) {
            alert("Agregado con exito");
            location.reload();
          }
          else {
            alert(f);
            alert("Ha habido un error en el server");
          }
        });
      }
      if ($('#mod').is(':checked')){
        $.ajax({
          type:"POST",
          url:"PHP/Modificar.php",
          data:datos,
        }).done(function(f){
          if (f==1) {
            alert("Modificado con exito");
            location.reload();
          }
          else {
            alert(f);
            alert("Ha habido un error en el server");
          }
        });
      }
      if (!$('#mod').is(':checked') && !$('#ins').is(':checked')) {
        alert("Debe seleccionar lo que desea hacer");
      }
    })
    $('#idI').keyup(function(e){
      if(e.keyCode != 8) {
        var idING=0;
        if ($('#idI').val()><?php echo$in ?>) {
          alert("Ese ID aun no ha sido registrado");
        }
        else {
          <?php for($i=0; $i<$in; $i++){ ?>
            idING = <?php echo$IDing[$i]?>;
            if (idING==$('#idI').val()) {
              $('#nI').val('<?php echo$nombre[$i] ?>');
              $('#pI').val('<?php echo$precio[$i] ?>');
              $('#cI').val('<?php echo$cant[$i] ?>');
              $('#uI').val('<?php echo$url[$i] ?>');
            }
            <?php }?>
        }
      }
    });

  })
  function doSearch(){

      const tableReg = document.getElementById('tablaI');
      const searchText = document.getElementById('searchTerm').value.toLowerCase();

      // Recorremos todas las filas con contenido de la tabla
      for (let i = 1; i < tableReg.rows.length; i++) {
          let found = false;
          const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
          // Recorremos todas las celdas
          for (let j = 0; j < cellsOfRow.length && !found; j++) {
            if(j!=3){
              const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
              // Buscamos el texto en el contenido de la celda
              if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                found = true;
              }
            }
          }
          if (found) {
              tableReg.rows[i].style.display = '';
          } else {
              tableReg.rows[i].style.display = 'none';
          }
        }

  }
  function bus(){
      var idING=0;
      if ($('#idI').val()><?php echo$in ?>) {
        alert("Ese ID aun no ha sido registrado");
      }
      else {
        <?php for($i=0; $i<$in; $i++){ ?>
          idING = <?php echo$IDing[$i]?>;
          if (idING==$('#idI').val()) {
            $('#nI').val('<?php echo$nombre[$i] ?>');
            $('#pI').val('<?php echo$precio[$i] ?>');
            $('#cI').val('<?php echo$cant[$i] ?>');
            $('#uI').val('<?php echo$url[$i] ?>');
          }
          <?php }?>
      }
  }

</script>
