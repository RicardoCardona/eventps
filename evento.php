<!--
	Compañía: Bynary01
	Autor: Ricardo Cardona
	Sistema: 2park
	Fecha: 25/09/2016
	Descripción: Index Midnight	
-->
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
	<!-- js galeria -->
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<!-- js galeria -->
	<script type="text/javascript" src="js/modernizr.2.5.3.min.js"></script>
	<!-- js galeria -->
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<!-- js galeria -->
	<script type="text/javascript" src="js/templatemo_script.js"></script>
	<!-- js tiempo reserva -->
	<script src="js/reload.js"></script>
	<!-- js Menú Pegajoso -->
	<script type="text/javascript" src="js/sticky_menu.js"></script>
</head>
<body>
	<div id="body2">
		<!-- Boton Carrito -->
		<div id="caja"></div>
		<div id="caja2" class="hidden-xs hidden-md">
			<a href="carrito.php" id="carrito"><img src="img/plantilla/carrito.png"></a>
		</div>

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
			<div id="infoEvento">
				<!-- Include Evento Completo -->
				<?php include_once "modulos/verMasEventos.php"; ?>
			</div>
			<!-- contenedor Fin -->
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br>			
			<div class="hidden-xs">
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<br><br><br><br><br><br><br>
			</div>
			<hr width=100%>
			<footer class="col-md-12">
				<br><br>
				<p class="col-md-3">APLICA RESTRICCIONES TÉRMINOS Y CONDICIONES MIDNIGHT <a href="AdministracionEventos/index.php">Panel</a></p>
				<p class="col-md-3"><img src="img/plantilla/logo.png" width="100%"></p>
				<p class="col-md-3">SI TIENES ALGUNA INQUIETUD CONTACTENOS</p>
				<p class="col-md-3">TEL: (57 1) 656 3653 CARRERA 50 #100-88  - BOGOTÁ</p>
			</footer>
		</div>
		

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel" color="black"><font color="black">SELECCIONE UBICACIÓN</font></h4>
					</div>
					<div class="modal-body">
						<div id="notificacion"></div>
		        		<div id="lugares"><img src="img/plantilla/loading.gif"></div>	        		
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
						<a href="carrito.php" class="btn btn-success">Ver Carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
