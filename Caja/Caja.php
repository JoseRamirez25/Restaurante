<?php
	require_once 'PHP/Obtener_ordenes_despachadas.php';
?>

<!DOCTYPE html>
<html lang="es">
		<title>Cocina</title>
	  <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <link rel="stylesheet" type="text/css" href="CSS/CajaS12.css"/>
	    <script src="../Clientes/JS/jquery-3.4.1.min.js" type="text/javascript"></script>
	  </head>
		<body>
			<section class="sec">
	  		<section class="imgsec">
					<?php if ($nombre[0]!=""): ?>
						<div class="tabla">
              <table>
								<h3>Actual</h3
                <thead>
                  <tr>
                    <th>N° de Pedido</th>
                    <th>Precio</th>
                  </tr>
                </thead>
								<tbody>
									<?php if ($found==true): ?>
											<td><?php echo$Npedido[0] ?></td>
											<td><?php echo$Precio[0] ?></td>
										<?php else: ?>
										<?php endif; ?>
								</tbody>
              </table>
							<?php if (sizeof($Npedido)>1): ?>
								<table class="tabla2"><br>
									<h3>Siguiente</h3>
									<thead>
										<tr>
											<th>N° de Pedido</th>
											<th>Precio</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($found==true): ?>
											<td><?php echo$Npedido[1] ?></td>
											<td><?php echo$Precio[1] ?></td>
										<?php else: ?>
										<?php endif; ?>
									</tbody>
								</table>
							<?php endif; ?>
            </div>
					<?php else: ?>
						<div class="tabla">
              <table>
                <thead>
                  <tr>
                    <th>N° de Pedido</th>
                    <th>Precio</th>
                  </tr>
                </thead>
								<tbody>
									<?php if ($found==true): ?>
											<td>NN</td>
											<td>#</td>
										<?php else: ?>
										<?php endif; ?>
								</tbody>
              </table>
            </div>
					<?php endif; ?>
	    	</section>
					<div class="seg">
						<h3  id="h31">Actual</h3>
						<div class="ingredientes">
							<?php if ($nombre[0]!=""): ?>
								<?php for($i=0; $i<sizeof($I2); $i++){ ?>
                  <div class="cant" id="c<?php echo$i?>"><?php echo$CantIng[$i]?></div>
	                <div class="divs" id="b<?php echo$i?>"><?php echo$nombre[$i].": $".($precioIn[$i]*$CantIng[$i]) ?></div>
	              <?php	}?>
								<?php else: ?>
									<div class="P0">No se han despachado mas pedidos</div>
							<?php endif; ?>
						</div>
            <button type="button" id="btnpagar">Pagar</button>
	    		</div>
	  	</section>
		</body>
</html>
<script>
	$(document).ready(function(){

		$('.divs1').hide();
		$('#btnpagar').click(function(){
			<?php if ($nombre[0]!=""): ?>
			op = confirm("¿Esta usted seguro que la orden esta bien?");
			if(op == true){
				$.ajax({
					type:"POST",
					url:"PHP/Actualizar.php"
				}).done(function(f){
					if (f==1) {
							alert("Orden despachada :)"+f);
							location.reload();
					}
					else {
						alert("Ha habido un error en el server"+f);
					}
				});
			}
			else {
				alert("Ok, por favor elija con cuidado");
			}
			<?php else: ?>
				alert("No hay pedidos, que piensa pagar?")
			<?php endif; ?>

		})

	})
</script>
