<?php
	require_once 'PHP/Obtener_ordenes_pagadas.php';
?>

<!DOCTYPE html>
<html lang="es">
		<title>Ventas</title>
	  <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <link rel="stylesheet" type="text/css" href="CSS/Ventas.css"/>
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	    <script src="../Clientes/JS/jquery-3.4.1.min.js" type="text/javascript"></script>
	  </head>
		<body>
			<section class="sec">
	  		<section class="imgsec">
					<div class="cn">
						<input type="checkbox" class="fecha" id="dia" value=""><input type="number" min="0" max="30" readonly placeholder="Dia" class="num" id="ndia" value=""></input>
					</div>
					<div class="cn">
						<input type="checkbox" class="fecha" id="mes" value=""><input type="number" min="0" max="12" readonly placeholder="Mes" class="num" id="nmes" value=""></input>
					</div>
					<div class="cn">
						<input type="checkbox" class="fecha" id="año" value=""><input type="number" min="2019" max="2040" readonly placeholder="Año" class="num" id="naño" value=""></input>
					</div>
					<?php if ($Npedido[0]!=""): ?>
						<div class="tabla">
              <table>
                <thead>
                  <tr>
                    <th>N° de Pedido</th>
                    <th>Precio</th>
                  </tr>
                </thead>
								<tbody id="tbody">
									<?php if ($Npedido[0]!=""): ?>
										<?php for ($i=0; $i < sizeof($Npedido); $i++) {?>
												<td value='<?php echo$i ?>' class="tds" id="td<?php echo$i ?>"><span><?php echo$Npedido[$i] ?></span><span><?php echo$Precio[$i] ?></span> </td>
										<?php } ?>
										<?php endif; ?>
								</tbody>
              </table>
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
									<?php if ($Npedido[0]==""): ?>
											<td class="tds" id="td0"><span>NN</span><span>#</span> </td>
										<?php endif; ?>
								</tbody>
              </table>
            </div>
					<?php endif; ?>
					<div class="nped">N° Pedidos</div>
					<div class="vt">Total</div>
	    	</section>
					<div class="seg">
						<h3  id="h31">Actual</h3>
						<div class="ingredientes">
							<?php if ($Npedido[0]!=""): ?>
	                <div class="divs" id="b">Seleccione un pedido</div>
									<div class="cant" id="c">#</div>
								<?php else: ?>
									<div class="P0">No hay pedidos pendientes</div>
							<?php endif; ?>
						</div>
	    		</div>
	  	</section>
		</body>
</html>
<script>
	$(document).ready(function(){

		var ingrediente=[], cantI=[], dia=[], mes=[], año=[], npedido=[], precio=[], v=0, vt1=0, nped=0, IDdeING=[], NAMEdeING=[], VALdeING=[], i=0;

		<?php for($i=0; $i<sizeof($nombre); $i++){ ?>
				IDdeING[i] = '<?php echo$IDing[$i] ?>'
				NAMEdeING[i] = '<?php echo$nombre[$i] ?>'
				VALdeING[i] = '<?php echo intval($precioIn[$i]) ?>'
				i++;
		<?php }?>
		i=0;
		<?php for($i=0; $i<sizeof($ingrediente); $i++){ ?>
			var fecha="";
			ingrediente[i] = '<?php echo$ingrediente[$i] ?>';
			cantI[i] = '<?php echo$CantI[$i] ?>';
			fecha = '<?php echo$Fecha[$i] ?>'.split("-");
			npedido[i] = '<?php echo$Npedido[$i] ?>';
			precio[i] = '<?php echo$Precio[$i] ?>';
			dia[i] = fecha[2];
			mes[i] = fecha[1];
			año[i] = fecha[0];
			nped++;
			vt =+ precio[i];
			vt1 += vt;
			i++;
		<?php }?>

		$('.nped').html("N° Pedidos: "+nped);
		$('.vt').html("Total: $"+vt1);

		$('.tds').click(function(){
			var id_ingrediente = "", cant_ingrediente = "", ican=[], j=0, creacion="<div class=divs id=b><h3>Perro: $3000</h3></div><div class=cant id=c>1</div>";
			v = $(this).attr("value");
			id_ingrediente = ingrediente[v].split(",");
			cant_ingrediente = cantI[v].split(",");
			for (var i = 0; i < cant_ingrediente.length; i++) {
				if (cant_ingrediente[i]>0) {
					ican[j] = cant_ingrediente[i];
					j++;
				}
			}
			for (var i = 0; i < id_ingrediente.length; i++) {
				for (var j = 0; j < IDdeING.length; j++) {
					if (id_ingrediente[i]==IDdeING[j]) {
					break;
					}
				}
				creacion+="<div class=divs id=b> "+NAMEdeING[j]+": $"+(ican[i]*VALdeING[j])+"</div><div class=cant id=c>"+ican[i]+" </div>";
			}
			$('.ingredientes').html(creacion);
		})
		$('#dia').click(function(){
			if ($('#dia').is(":checked")) {
				$('#ndia').attr("readonly", false);
				$('#nmes').attr('readonly', false);
				$('#naño').attr('readonly', false);
				$('#mes').prop('checked', true);
				$('#año').prop('checked', true);
			}else {
				$('#ndia').attr('readonly', true);
				$('#ndia').val("");
				$('.num').change();
			}
		})
		$('#mes').click(function(){
			if ($('#mes').is(":checked")) {
				$('#nmes').attr('readonly', false);
				$('#naño').attr('readonly', false);
				$('#año').prop('checked', true);
			}else {
				$('#nmes').attr('readonly', true);
				$('#ndia').attr('readonly', true);
				$('#dia').prop('checked', false);
				$('#nmes').val("");
				$('#ndia').val("");
			}
		})
		$('#año').click(function(){
			if ($('#año').is(":checked")) {
				$('#naño').attr('readonly', false);
			}else {
				$('#ndia').attr("readonly", true);
				$('#nmes').attr("readonly", true);
				$('#naño').attr('readonly', true);
				$('#dia').prop('checked', false);
				$('#mes').prop('checked', false);
				$('#ndia').val("");
				$('#nmes').val("");
				$('#naño').val("");
				$('.tds').show();
			}
		})
		$('.fecha').click(function() {
			$('.num').change();
		})
		$('.num').keyup(function(){
				$('.num').change();
		})
		$('.num').change(function(){
				vt1=0;
				nped=0;
				$('.tds').hide();
				if ($('#dia').is(":checked")) {
					if($('#ndia').val()!="" && $('#nmes').val()!="" && $('#naño').val()!=""){
						for (var i = 0; i < dia.length; i++) {
							if (dia[i]==$('#ndia').val() && mes[i]==$('#nmes').val() && año[i]==$('#naño').val()) {
								$('#td'+i).show();
								nped++;
								vt =+ precio[i];
								vt1 += vt;
							}
						}
						$('.nped').html("N° Pedidos: "+nped)
						$('.vt').html("Total: $"+vt1)
					}
					else {
						$('.tds').show();
					}
				}
				if (!$('#dia').is(":checked") && $('#mes').is(":checked")) {
					if($('#nmes').val()!="" && $('#naño').val()!=""){
						for (var i = 0; i < mes.length; i++) {
							if (mes[i]==$('#nmes').val() && año[i]==$('#naño').val()) {
								$('#td'+i).show();
								nped++;
								vt =+ precio[i];
								vt1 += vt;
							}
						}
						$('.nped').html("N° Pedidos: "+nped)
						$('.vt').html("Total: $"+vt1)
					}
					else {
						$('.tds').show();
					}
				}
				if (!$('#mes').is(":checked")){
					if($('#naño').val()!=""){
						for (var i = 0; i < mes.length; i++) {
							if (año[i]==$('#naño').val()) {
								$('#td'+i).show();
								nped++;
								vt =+ precio[i];
								vt1 += vt;
							}
						}
						$('.nped').html("N° Pedidos: "+nped)
						$('.vt').html("Total: $"+vt1)
					}
					else {
						$('.tds').show();
					}
				}
				if (!$('#dia').is(":checked") && !$('#mes').is(":checked") && !$('#año').is(":checked")) {
						for (var i = 0; i < mes.length; i++) {
								nped++;
								vt =+ precio[i];
								vt1 += vt;
						}
						$('.nped').html("N° Pedidos: "+nped);
						$('.vt').html("Total: $"+vt1);
						$('.tds').show();
				}
		})

	})

</script>
