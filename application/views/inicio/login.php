<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!--bootstrap css-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/login.css">
	<!-- bootstrap jquery -->
	<title>Harry Books - Administración</title>
</head>
<body>
	<div class="wrapper">
		<div style="min-width: 400px;" class="container">
			<h1>Harry <b>Books</b></h1>

			<form class="form" id="form-login" action="?" method="post">
				<input id="usuario" type="text" placeholder="Usuario" required>
				<input id="password" type="password" placeholder="Contraseña" required>
				<div style="display: none;" class="error-msj">¡Datos incorrectos!</div>
				<button type="submit" id="login-button">Iniciar sesión</button>
			</form>
		</div>

		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
	<script>
		$("#form-login").submit(function(e){
			e.preventDefault();
			var form = $(this),
				btn = form.find("button[type='submit']"),
				$usuario = $("#usuario"),
				usuario = $usuario.val(),
				$password = $("#password"),
				password = $password.val(),
				url = "<?php echo base_url(); ?>login/iniciar_sesion";

			$usuario.addClass("disabled").blur();
			$password.addClass("disabled").blur();

			btn.html('<span class="fa fa-spinner fa-pulse"></span>').addClass("disabled");
			$(".error-msj").fadeOut();
			$.post(url, {usuario:usuario, password:password}, function(data){
				if(data == 1){
					location.reload();
				}
				else{
					$usuario.removeClass("disabled");
					$password.removeClass("disabled");
					btn.html('Iniciar sesión').removeClass("disabled");
					$(".error-msj").fadeIn();
				}
			});
		});
	</script>
</body>
</html>