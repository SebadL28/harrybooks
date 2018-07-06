<!DOCTYPE html>
<html lang="es">
<head>
	<?php echo $head; ?>
</head>
<body>
	
	<!-- Header -->
	<?php echo $menu; ?>

	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1" style="background-image: url(<?php echo base_url(); ?>public/img/banner.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 " data-appear="rollIn" data-delay="0">
								<span class="ltext-101 cl2 respon2" style="color: #fff;">
									Lorem ipsum dolor 
								</span>
							</div>
								
							<div class="layer-slick1 " data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1" style="color: #fff;">
									sit amet, consectetur
								</h2>
							</div>
								
							<div class="layer-slick1 " data-appear="slideInUp" data-delay="1600">
								<a href="#" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									 Comprar ahora
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140" style="margin-top: 50px;">
		<div class="container">
			<div style="margin-bottom: 50px;" class="p-b-10">
				<h3 class="ltext-103 cl5">
					Libros a la venta
				</h3>
			</div>

			<div class="row isotope-grid">
				<?php
				foreach ($libros->result() as $key => $fila){
					$idLibro = $fila->id_libro;
					$nombreLibro = $fila->nombre_libro;
					$cantidadLibro = $fila->cantidad_libro;
					$precioLibro = $fila->precio_libro;
					$imagenLibro = $fila->imagen_libro;

					$textCantidad = $cantidadLibro;
					if($cantidadLibro == 0){
						$textCantidad = 'Agotado';
					}

					$precioLibro = number_format($precioLibro, 0, ",", ".");

					echo '
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
							<a href="#" class="btn-libro" data-id="'.$idLibro.'" data-nombre="'.$nombreLibro.'" data-cantidad="'.$cantidadLibro.'" data-precio="'.$precioLibro.'" data-imagen="'.$imagenLibro.'" class="block2">
								<div class="block2-pic hov-img0">
									<img src="'.base_url().'public/img/libros/'.$imagenLibro.'" alt="IMG-PRODUCT">

									<span class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
										Ver producto
									</span>
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<span class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											'.$nombreLibro.'
										</span>

										<span class="stext-105 cl3">
											Precio: $'.$precioLibro.' COP
										</span>
										<span class="stext-105 cl3">
											Cantidad: '.$textCantidad.'
										</span>
									</div>
								</div>
							</a>
						</div>
					';
				}
				?>
			</div>
		</div>
	</section>


	<!-- Footer -->
	<?php echo $footer; ?>

	<div class="modal fade" id="modal-libros" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Libro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-b-30">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div style="display: block;width: 100%;" class="content-img"></div>
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="p-t-5 p-lr-0-lg">
								<h4 class="mtext-105 cl2 js-name-detail p-b-14 title-libro"></h4>

								<span class="mtext-106 cl2 precio-libro"></span>
								<!--  -->
								<div class="p-t-33">
									<div class="flex-w flex-r-m p-b-10">
										<div class="size-203 flex-c-m respon6">
											Cantidad disponible
										</div>

										<div class="size-204 respon6-next">
											<b class="cantidad-libro"></b>
										</div>
									</div>

									<div class="flex-w flex-r-m p-b-10 content-cantidad-select">
										<div class="size-203 flex-c-m respon6">
											Agregar al carrito
										</div>

										<div class="size-204 respon6-next">
											<select class="select-cantidad-libro form-control"></select>
										</div>
									</div>

									<div class="flex-w flex-r-m p-b-10">
										<div class="size-204 flex-w flex-m respon6-next">
											<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail btn-agregar-carro">
												Añadir al carrito
											</button>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<?php echo $scripts; ?>

	<script>
		var cantidadProtuctosCarrito = <?php echo $cantidad_carrito; ?>,
			libroAct = -1;

		$(document).ready(function(){
			$(".btn-libro").click(function(e){
				e.preventDefault();
				var btn = $(this),
					id = btn.attr("data-id"),
					nombre = btn.attr("data-nombre"),
					cantidad = btn.attr("data-cantidad"),
					precio = btn.attr("data-precio"),
					imagen = btn.attr("data-imagen"),
					rutaImg = "<?php echo base_url(); ?>public/img/libros/"+imagen,
					modal = $("#modal-libros"),
					parentSelect = modal.find(".content-cantidad-select"),
					selecCantidad = modal.find(".select-cantidad-libro"),
					optionsSelect = selecCantidad.find("option"),
					contentCantidad = '',
					textCantidad = cantidad,
					btnCarro = $(".btn-agregar-carro");

				if(optionsSelect.length > 0){
					optionsSelect.remove();
				}
				if(cantidad > 0){
					for (var i = 1; i <= cantidad; i++){
						contentCantidad += '<option value="'+i+'">'+i+'</option>';
					}
					selecCantidad.append(contentCantidad);
					parentSelect.show();
					btnCarro.show();
				}
				else{
					textCantidad = 'Agotado';
					parentSelect.hide();
					btnCarro.hide();
				}

				libroAct = id;

				modal.find(".modal-body .cantidad-libro").html(textCantidad);
				modal.find(".modal-body .title-libro").html(nombre);
				modal.find(".modal-body .precio-libro").html("$"+precio+" COP");
				modal.find(".content-img").html('<img style="width: 100%;" src="'+rutaImg+'">');
				modal.modal("show");
			});

			$(".btn-agregar-carro").click(function(e){
				e.preventDefault();
				var btn = $(this),
					cantidadSelect = $(".select-cantidad-libro").val(),
					modal = $("#modal-libros"),
					url = "<?php echo base_url(); ?>carro_compras/agregar_libro";

				btn.addClass("disabled").html('<span class="fa fa-spinner fa-pulse"></span>');

				$.post(url, {id: libroAct, cantidad: cantidadSelect}, function(data){
					btn.removeClass("disabled");
					btn.html('Añadir al carrito');

					cantidadProtuctosCarrito++;
					actualizarCantidadCarrito();

					swal({
						type: 'success',
						title: 'Libro agregado',
						text: 'Libro agregado a carro de compras'
					});

					modal.modal("hide");
				});
			});

			<?php
			if($this->session->userdata('msj_function')){
				if($this->session->userdata('msj_function') == 1){
					?>
					swal({
						title: 'Compra realizada',
						text: 'Hemos recibido su solicitud y será procesada por nuestros agentes. Gracias por su compra',
						type: 'success',
						confirmButtonText: 'Ok',
						confirmButtonColor: '#98b732'
					});
					<?php
				}
				$this->session->unset_userdata('msj_function');
			}

			?>
		});

		function actualizarCantidadCarrito(){
			var content = $("#content-cantidad-carrito");
			content.attr("data-notify", cantidadProtuctosCarrito);
		}
	</script>
</body>
</html>