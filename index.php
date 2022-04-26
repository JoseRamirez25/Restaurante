<?php
	require_once 'Clientes/PHP/Obtener_ingredientes.php';
?>

<!DOCTYPE html>
<html lang="es">
		<title>Perro</title>
	  <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <link rel="stylesheet" type="text/css" href="Clientes/CSS/indexS.css"/>
			<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <script src="Clientes/JS/jquery-3.4.1.min.js" type="text/javascript"></script>
	  </head>
		<body>
	    <div class="accesosDirectos" id="cocina"><a href="Cocina/Cocina.php" style="text-decoration:none;color:white;"><abbr title="Cocina"><span class="material-icons">kitchen</span></abbr></a></div>
			<div class="accesosDirectos" id="caja"><a href="Caja/Caja.php"style="text-decoration:none;color:white"> <abbr title="Facturación"><span class="material-icons">account_balance_wallet</span></abbr> </a></div>
	    <header>
	      <div class="wrapper">
	        <div class="logo">UNPA<a href="Administracion/Login.html" style="text-decoration:none;"> <abbr title="ADMIN"><span class="material-icons md-48">admin_panel_settings</span></abbr> </a></div>
	        <nav>
	          <a href="#">Pizzas</a>
	          <a href="#">Hamburquesas</a>
	          <a href="#">Hot-Dogs</a>
	          <a href="#">Picadas</a>
	          <a href="#">Salchipapas</a>
	        </nav>
	      </div>
	    </header>
			<section class="sec">
	  		<section class="imgsec">
						<img class = "perro" src=<?php echo$urlP[0]?> alt="no se pudo cargar la imagen :/">
						<?php for($i=0; $i<$in; $i++){ ?>
							<img class="img<?php echo$i?>" src=<?php echo $url[$i]?> alt="no se pudo cargar la imagen :/">
						<?php }?>
	    	</section>
					<div class="seg">
						<h3 class="h3_1">Ingredientes<h3/>
						<h3 class="h3_2">#</h3>
						<div class="ingredientes">
							<form id="frmajax" method="POST">
								<?php $bot =0 ?>
									<?php for($i=0; $i<$in; $i++){ ?>
											<?php if($cantP[0]>0 && $cant[$i]>0){ ?>
												<input class="cbox" type="checkbox" name="salsas[]" value="<?php echo$IDing[$i]?>" id="a<?php echo$i?>">
												<label for="a<?php echo$i?>"><?php echo $nombre[$i] ?></label>
												<input onchange="m()" class="cn" id="c<?php echo$i?>" type="number" name="cantidadin[]" value="0" readonly min="0" max="2" autocomplete="off">
												<?php $bot =1 ?>
											<?php }?>
											<?php if ($cantP[0]==0){ ?>
												<div class="Dog-out">No hay perro :/</div>
												<script>
													$('.perro').attr('src', "Clientes/Imagenes/cantP0-1.png");
												</script>
												<?php $i = $in ?>
											<?php } ?>
									<?php }?>
									<input type="number" name="total" class="total">
							</form>
							<?php if ($in==0): ?>
							<div class="Ings-out">No hay ingredientes :/</div>
							<?php endif; ?>
						</div>
	    		</div>
	  	</section>
	    <section class="sec2">
	      <div class="secFactura">
	          <tr>
							<?php if ($cantP[0]==0){ ?>
								<div id="pb"><br>NO PERRO >:(<br><br></div>
							<?php } ?>
							<?php if ($cantP[0]>0){ ?>
								<div id="pb"><br><?php echo "Precio perro inicial: $$precioP[0]" ?><br><br></div>
								<?php for($i=0; $i<$in; $i++){ ?>
									<div class = "divs" id="b<?php echo$i?>"><?php echo "$nombre[$i]: $$precio[$i]" ?></div>
								<?php	}?>
							<?php } ?>
	          </tr>
	      </div>
				<?php if ($cantP[0]==0){ ?>
					<div class="vt">$###</div>
				<?php } ?>
				<?php if ($cantP[0]>0){ ?>
					<div class="vt"><?php echo "$ $precioP[0]" ?></div>
				<?php } ?>
					<button type="button" id="btnguardar">Pedir</button>
	    </section>
		</body>
</html>
<script>
	$(document).ready(function(){
		var Resultado = <?php echo $precioP[0]; ?>, alto = 0, np = 0;

		<?php for($i=0; $i<$in; $i++){ ?>
			$('#c<?php echo$i?>').css({'top': alto});
			alto += 46;
			$('.img<?php echo$i?>').css({'position': 'absolute', 'height': '380px', 'width': '150px', 'display': 'block', 'left': '160px', 'top': '10px'});
			$('.img<?php echo$i?>').hide();
			$('#b<?php echo$i?>').hide();
		<?php }?>

		$('.divs').click(function(){
			precio = 0;
			var divid = $(this).attr("id");
			<?php for($i=0; $i<$in; $i++){ ?>
				if(divid==("b"+<?php echo$i?>)){
					$('#a<?php echo$i?>').prop('checked', false);
					$('#c<?php echo$i?>').val(0);
					$('#c<?php echo$i?>').attr('readonly', true);
					$('#b<?php echo$i?>').hide();
					$('.img<?php echo$i?>').hide();
					precio = <?php echo$precio[$i]; ?>;
					Resultado=Resultado-precio;
					$('.total').val(Resultado);
				}
				<?php }?>
				$('.vt').html("$ "+Resultado);
		})

		$('.cbox').click(function(){
			Resultado = <?php echo$precioP[0]; ?>;
			precio = 0;
			<?php for($i=0; $i<$in; $i++){ ?>
				if ($('#a<?php echo$i?>').is(':checked')) {
					if ($('#c<?php echo$i?>').val()==0){
						$('#c<?php echo$i?>').val(1);
						$('#c<?php echo$i?>').attr('readonly', false);
					}
						$('#b<?php echo$i?>').show();
						$('.img<?php echo$i?>').show();
						precio = <?php echo$precio[$i]; ?>;
						Resultado = Resultado + (precio*$('#c<?php echo$i?>').val());
						$('.total').val(Resultado);
				}else {
					$('#b<?php echo$i?>').hide();
					$('#c<?php echo$i?>').val(0);
					$('#c<?php echo$i?>').attr('readonly', true);
					$('.img<?php echo$i?>').hide();
				}
				<?php }?>
				$('.vt').html("$ "+Resultado);
		})

		$('#btnguardar').click(function(){
			var datos=$('#frmajax').serialize(), cc=0, op;
			<?php for($i=0; $i<$in; $i++){ ?>
				if (Resultado==3000) {
					alert("Lo lamentamos pero por politicas de la empresa no puede pedir el perro sin ingredientes, por favor elija almenos un ingrediente ;)");
					return false;
				}
				else {
					if ($('#c<?php echo$i?>').val()<=2 && $('#c<?php echo$i?>').val()>=0){
						if ($('#c<?php echo$i?>').val()>(<?php echo$cant[$i]?>)){
							alert("no hay suficiente de este ingrediente, solo queda "+<?php echo$cant[$i] ?>+" porcion de "+'<?php echo$nombre[$i] ?>');
						}
						else{
							cc++;
						}
					}
					else{
						if ($('#c<?php echo$i?>').val()>2) {
							alert("Se pueden pedir maximo 2 porciones por unidad");
							$('#c<?php echo$i?>').val(1);
						}
						if ($('#c<?php echo$i?>').val()<0) {
							alert("No se pueden usar numeros negativos -_-");
							$('#c<?php echo$i?>').val(1);
						}
					}
				}
			<?php } ?>
			if(cc==<?php echo$in ?>){
					op = confirm("¿Esta usted seguro que su orden esta bien?");
					if(op == true){
						$.ajax({
							type:"POST",
							url:"Clientes/PHP/Actualizar.php",
							data:datos,
						}).done(function(f){
							if (f==1) {
									alert("Orden en camino :)"+f);
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
			}
			return false;
		});

	})
	function m(){
		Resultado = <?php echo$precioP[0]; ?>;
		precio = 0;
		<?php for($i=0; $i<$in; $i++){ ?>
			if ($('#a<?php echo$i?>').is(':checked')) {
				if ($('#c<?php echo$i?>').val()==0){
					$('#c<?php echo$i?>').val(1);
					$('#c<?php echo$i?>').attr('readonly', false);
				}
					np = <?php echo$precio[$i];  ?>;
					$('#b<?php echo$i?>').html('<?php echo$nombre[$i]?>'+": $"+(np*$('#c<?php echo$i?>').val()));
					$('#b<?php echo$i?>').show();
					$('.img<?php echo$i?>').show();
					precio = <?php echo$precio[$i]; ?>;
					Resultado = Resultado + (precio*$('#c<?php echo$i?>').val());
					$('.total').val(Resultado);
			}else {
				$('#b<?php echo$i?>').hide();
				$('#c<?php echo$i?>').val(0);
				$('#c<?php echo$i?>').attr('readonly', true);
				$('.img<?php echo$i?>').hide();
			}
			<?php }?>
			$('.vt').html("$ "+Resultado);
	}
</script>
