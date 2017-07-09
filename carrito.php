<?php
    session_start();
    if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>MIDNIGHT</title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="img/plantilla/favicon.png">
	<!-- estilos galeria -->
	<link href="css/magnific-popup.css" rel="stylesheet">
	<!-- fuente -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Oswald" rel="stylesheet">
	<!-- estilos bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- estilos libres css -->
	<link rel="stylesheet" href="css/estilo.css">
	<!-- conexion jquery -->
	<script src="js/jquery.min.js"></script>
	<!-- conexion bootstrap js-->
	<script src="js/bootstrap.min.js"></script>
	<!-- codigo libre js-->
	<script src="js/codigo.js"></script>
	<!-- js tiempo reserva -->
	<script src="js/reload.js"></script>
	<!-- js Menú Pegajoso -->
	<script type="text/javascript" src="js/sticky_menu.js"></script>
</head>
<body>
	<div id="body2">
		<!-- contenedor -->
		<div class="container">
			<!-- cabecera -->
			<header class="col-md-12">
				<div class="navegador">
					<!-- logo -->
					<a href="index.php"><img src="img/plantilla/logo.png" class="col-md-3"></a>
					<!-- menu -->
					<nav role="navigation" class="col-md-9">
					    <div class="navbar-header">
					        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle btn btn-lg">
					            <span class="glyphicon glyphicon-menu-hamburger"></span>
					        </button>
					    </div> 
					    <div id="navbarCollapse" class="collapse navbar-collapse">
					        <ul class="navbar-nav" id="menu">
					            <li><a href="index.php">INICIO</a></li>
					            <li><a href="quienSomos.php">QUIÉNES SOMOS</a></li>
					            <li><a href="artistas.php">ARTISTAS</a></li>
					            <li><a href="contratacion.php">CONTRATACIÓN</a></li>
					            <li><a href="eventos.php" class="active">EVENTOS</a></li>
					            <li><a href="contactenos.php">CONTÁCTENOS</a></li>
					        </ul>
					    </div>
					</nav>
				</div>
			</header>
			<div class="carrito col-md-8">
			</div>
			
			<aside class="col-md-4">		
				<h3>Próximos Eventos</h3>
				<hr>
				<div class="content-container">
					<div id="portfolio-content" class="center-text">
						<div class="portfolio-page" id="page-1">
							<?php include_once "modulos/mostrarEventos.php"; ?>
						</div>
					</div>
				</div>
			</aside>
			<!-- contenedor Fin -->	
			<hr width=100%>
			<footer class="col-md-12">
				<br><br>
				<p class="col-md-3">APLICA RESTRICCIONES TÉRMINOS Y CONDICIONES MIDNIGHT <a href="AdministracionEventos/index.php">Panel</a></p>
				<p class="col-md-3"><img src="img/plantilla/logo.png" width="100%"></p>
				<p class="col-md-3">SI TIENES ALGUNA INQUIETUD CONTACTENOS</p>
				<p class="col-md-3">TEL: (57 1) 656 3653 CARRERA 50 #100-88  - BOGOTÁ</p>
			</footer>
		</div>

		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel" style="color: #000;">Iniciar Sesion</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="AdministracionEventos/login/loginComun.php" method="post">
							<div class="form-group">							
								<div class="col-sm-12">
									<input type="email" class="form-control" name="username" placeholder="E-mail">
								</div>
							</div>
							<div class="form-group">							
								<div class="col-sm-12">
									<input type="password" class="form-control" name="password" placeholder="Contraseña">
								</div>
							</div>
							<div class="form-group">
								<center>
									<div class="col-sm-12">
										<input type="submit" class="btn btn-success btn-block" name="login" value="Entrar"><br>
										<button type="button" data-dismiss="modal" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm2">Recuperar Contraseña</button>
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Registrarse</button>
									</div>
								</center>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel" style="color: #000;">Registro</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="POST" action="modulos/ingresarUsuario.php">
							<div class="form-group">
								<label class="col-sm-2 control-label" style="color: #000;">Nombres*</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nombres" placeholder="Nombres">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" style="color: #000;">Apellidos*</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" style="color: #000;">Email*</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="email" placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" style="color: #000;">Contraseña*</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="password" placeholder="Contraseña">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" style="color: #000;">Telefono*</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="telefono" placeholder="Telefono">
								</div>
							</div>
							<div class="form-group">
								<center>
									<input type="submit" class="btn btn-primary" value="Registrarse">
								</center>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel" style="color: #000;">Restaurar Contraseña</h4>
					</div>
					<div class="modal-body">
						<form id="frmRestablecer" action="cambiarPassword/validarEmail.php" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label" style="color: #000;">E-mail</label>
								<div class="col-sm-9">
									<input type="email" id="email" class="form-control" name="email" placeholder="E-mail Asociado" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<center>
										<input type="submit" class="btn btn-primary" value="Recuperar contraseña">
									</center>
								</div>
							</div>
						</form>
						<div id="mensaje"></div>
					</div>
				</div>
			</div>
		</div>

		<script>
			$(document).ready(function(){
			
				$("#frmRestablecer").submit(function(event){
				event.preventDefault();
				
				$.ajax({
					url:'cambiarPassword/validarEmail.php',
					type:'post',
					dataType:'json',
					data:$("#frmRestablecer").serializeArray()
					}).done(function(respuesta){
						alert(respuesta.mensaje);
						$("#email").val('');
					});
				});
			});
	    </script>
	</div>
</body>
</html>
<?php
    }else{
    	print "<script>window.location='procesoPago.php';</script>";
    }
?>