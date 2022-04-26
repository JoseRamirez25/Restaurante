<?php
	require_once 'PHP/Obtener_ordenes.php';
?>

<!DOCTYPE html>
<html lang="es">
		<title>Cocina</title>
	  <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <link rel="stylesheet" type="text/css" href="CSS/CocinaS2.css"/>
	    <script src="../Clientes/JS/jquery-3.4.1.min.js" type="text/javascript"></script>
	  </head>
		<body>
			<section class="sec">
	  		<section class="imgsec">
					<?php if ($nombre[0]!=""): ?>
						<div class="Npedido"><h4>N° Pedido</h4><?php echo$Npedido ?></div>
					<?php else: ?>
						<div class="Npedido"><h4>N° Pedido</h4>#</div>
					<?php endif; ?>
	    	</section>
					<div class="seg">
						<h3 class="h3_1">Ingredientes<h3/>
						<h3 class="h3_2">#</h3>
						<div class="ingredientes">
							<?php if ($nombre[0]!=""): ?>
								<?php for($i=0; $i<sizeof($ingrediente); $i++){ ?>
	                <div class="divs" id="b<?php echo$i?>"><?php echo$nombre[$i]?></div>
									<div class="cant" id="c<?php echo$i?>"><?php echo$CantIng[$i] ?></div>
	              <?php	}?>
								<?php else: ?>
									<div class="P0">No hay pedidos pendientes</div>
							<?php endif; ?>
						</div>
	    		</div>
	  	</section>
	    <section class="sec2">
	      <div class="secFactura">
					<div class="divs" id="pb">Perro</div>
					<?php if ($empty==0): ?>
					<?php for($i=0; $i<sizeof($ingrediente); $i++){ ?>
						<div class="divs1" id="b1<?php echo$i?>"><?php echo$nombre[$i] ?></div>
					<?php	}?>
						<?php else: ?>
								<div class="P0">No se han despachado mas pedidos</div>
						<?php endif; ?>
	      </div>
        <button type="button" id="btndespachar">Orden lista</button>
	    </section>
		</body>
</html>
<script>
	$(document).ready(function(){

		$('.divs1').hide();
		$('.divs1').click(function(){
			var divid = $(this).attr("id");
			<?php for($i=0; $i<sizeof($ingrediente); $i++){ ?>
				if(divid==("b1"+<?php echo$i?>)){
					$('#b1<?php echo$i?>').hide();
					$('#b<?php echo$i?>').show();
					$('#c<?php echo$i?>').show();
				}
			<?php }?>
		})
		$('.divs').click(function(){
			var divid = $(this).attr("id");
			<?php for($i=0; $i<sizeof($ingrediente); $i++){ ?>
				if(divid==("b"+<?php echo$i?>)){
					$('#b<?php echo$i?>').hide();
					$('#c<?php echo$i?>').hide();
					$('#b1<?php echo$i?>').show();
				}
			<?php }?>
		})
		$('#btndespachar').click(function(){
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
				alert("No hay pedidos, que piensa despachar?")
			<?php endif; ?>

		})

	})
</script>
