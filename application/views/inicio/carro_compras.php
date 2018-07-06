<!DOCTYPE html>
<html lang="es">
<head>
	<?php echo $head; ?>
</head>
<body>
	
	<!-- Header -->
	<?php echo $menu; ?>

	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table id="table-libros" class="table table-bordered table-dashed">
								<thead>
									<tr>
										<th colspan="2">Libro</th>
										<th>Precio</th>
										<th>Cantidad</th>
										<th>Total</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$granTotal = 0;
										if($cantidad_carrito > 0){
											$librosAct = $this->session->userdata('libros_carrito');
											foreach ($librosAct as $key => $value){
												$idSelect = $value["id"];
												$cantidadSelect = $value["cantidad"];

												$libroSelect = $libros[$idSelect];

												$idLibro = $libroSelect->id_libro;
												$nombreLibro = $libroSelect->nombre_libro;
												$cantidadLibro = $libroSelect->cantidad_libro;
												$precioLibro = $libroSelect->precio_libro;
												$imagenLibro = $libroSelect->imagen_libro;

												$total = $precioLibro * $cantidadSelect;
												$granTotal += $total;

												$precioLibroText = number_format($precioLibro, 0, ",", ".");
												$totalText = number_format($total, 0, ",", ".");

												echo '
													<tr data-id="'.$key.'" data-precio="'.$precioLibro.'" data-cantidad="'.$cantidadSelect.'" class="table_row">
														<td>
															<img style="width:60px;" src="'.base_url().'public/img/libros/'.$imagenLibro.'" alt="IMG">
														</td>
														<td>'.$nombreLibro.'</td>
														<td>$'.$precioLibroText.'</td>
														<td>
															<select class="form-control select-cantidad">';

															for ($i = 1; $i <= $cantidadLibro ; $i++){ 
																$selected = ($i == $cantidadSelect)? 'selected' : '';
																echo '<option '.$selected.'>'.$i.'</option>';
															}

												echo '		</select>
														</td>
														<td class="content-total">$'.$totalText.'</td>
														<td class="text-center"><a href="#" style="color:#fff;" class="btn btn-xs btn-danger btn-eliminar"><span class="fa fa-close"></span></a></td>
													</tr>
												';
											}
										}
										else{
											echo '<tr><td colspan="6" class="text-center">No se encuentrar pedidos</td></tr>';
										}
										$textGranTotal = number_format($granTotal, 0, ",", ".");
									?>
								</tbody>
							</table>
						</div>
						<?php if($cantidad_carrito > 0){ ?>
						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" id="btn-cancelar-compra">
								Cancelar compra
							</div>
						</div>
						<?php } ?>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Resumen compra
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Total:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2" id="content-gran-total">
									$<?php echo $textGranTotal; ?>
								</span>
							</div>
						</div>


						<?php if($cantidad_carrito > 0){ ?>
						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer m-t-50" id="btn-finalizar-compra">
							Finalizar compra
						</button>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Footer -->
	<?php echo $footer; ?>

	<!-- Scripts -->
	<?php echo $scripts; ?>

	<?php
	$logueado = 0;
	if($this->session->userdata('login')){
		$logueado = 1;
	}

	?>
	<script>
		var login = <?php echo $logueado; ?>;
		$(document).ready(function(){
			$("#table-libros").on("change", ".select-cantidad", function(){
				var selectAct = $(this),
					cantidadAct = selectAct.val(),
					trAct = selectAct.parent().parent(),
					id = trAct.attr("data-id");


				trAct.attr("data-cantidad", cantidadAct);
				actualizarCantidadPedido(id, cantidadAct);
				actualizarTotal();
			});

			$("#table-libros").on("click", ".btn-eliminar", function(e){
				e.preventDefault();
				var btn = $(this),
					trAct = btn.parent().parent(),
					id = trAct.attr("data-id"),
					registros = $("#table-libros tbody tr");

				swal({
					title: 'Eliminar articulo',
					text: "¿Realmente desea eliminar el libro?",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						eliminarLibroPedido(id);
						trAct.remove();
						console.log(registros.length);
						if(registros.length == 1){
							agregarRegistroVacio();
						}
						swal(
							'Eliminado',
							'Libro eliminado',
							'success'
						);
						actualizarTotal();
					}
				});
			});

			$("#btn-cancelar-compra").click(function(e){
				e.preventDefault();
				swal({
					title: 'Cancelar compra',
					text: "¿Realmente desea cancelar la compra?",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						cancelarCompra();
						swal(
							'Compra cancelada',
							'',
							'success'
						);
						vaciarTabla();
						actualizarTotal();
					}
				});
			});

			$("#btn-finalizar-compra").click(function(e){
				e.preventDefault();

				if(login == 1){
					swal({
						title: 'Finalizar compra',
						text: "¿Realmente desea finalizar la compra?",
						type: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Si',
						cancelButtonText: 'No'
					}).then((result) => {
						if (result.value) {
							finalizarCompra();
						}
					});
				}
				else{
					swal(
						'Inicia sesión',
						'Por favor inicia sesión para poder finalizar la compra',
						'warning'
					);
				}
			});
		});

		function finalizarCompra(){
			window.location.href = "<?php echo base_url(); ?>carro_compras/finalizar_compra";
		}

		function cancelarCompra(){
			var url = "<?php echo base_url(); ?>carro_compras/cancelar_compra";
			$.post(url, function(data){});
		}

		function eliminarLibroPedido(id){
			var url = "<?php echo base_url(); ?>carro_compras/eliminar_pedido";
			$.post(url, {id: id}, function(data){});
		}

		function actualizarCantidadPedido(id, cantidadAct){
			var url = "<?php echo base_url(); ?>carro_compras/actualizar_cantidad";
			$.post(url, {id: id, cantidad: cantidadAct}, function(data){});
		}

		function actualizarTotal(){
			var tabla = $("#table-libros"),
				libros = tabla.find("tbody tr");

			var granTotal = 0;
			if(libros.length > 0){
				var contador = 0;
				libros.each(function(){
					var libroAct = this;
					libroAct = $(this);

					var precioAct = libroAct.attr("data-precio"),
						cantidadAct = libroAct.attr("data-cantidad"),
						$total = libroAct.find(".content-total"),
						total = precioAct * cantidadAct;

					libroAct.attr("data-id", contador);

					granTotal += total;
					total = seperadorMiles(total, ".");
					$total.html("$"+total);
					
					contador++;
				});

				granTotal = seperadorMiles(granTotal, ".");
			}
			$("#content-gran-total").html("$"+granTotal);
		}

		function agregarRegistroVacio(){
			var tabla = $("#table-libros"),
				container = tabla.find("tbody"),
				content = '<tr><td colspan="6" class="text-center">No se encuentrar pedidos</td></tr>';

			container.html(content);
			$("#btn-cancelar-compra").remove();
			$("#btn-finalizar-compra").remove();
		}

		function vaciarTabla(){
			var tabla = $("#table-libros"),
				registros = tabla.find(".tbody tr");

			registros.remove();
			agregarRegistroVacio();
		}

		function seperadorMiles(numero, separador){
			var	number_string = numero.toString(),
			rest 	  = number_string.length % 3,
			result 	  = number_string.substr(0, rest),
			thousands = number_string.substr(rest).match(/\d{3}/gi);

			if (thousands) {
				separator = rest ? separador : '';
				result += separator + thousands.join(separador);
			}

			return result;
		}
	</script>

</body>
</html>