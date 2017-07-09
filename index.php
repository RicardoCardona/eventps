<!--
	Compañía: Bynary01
	Autor: Brayan Rojas
	Sistema: Midnight
	Fecha: 13/02/2017
	Descripción: Sitio Web Midnight
-->
<?php
	session_start();
	if (!isset ($_SESSION['idCliente'] )){		
		$id=uniqid('', true);
		$_SESSION['idCliente']=$id;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>MIDNIGHT</title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="img/plantilla/favicon.png">
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
	<!-- js Menú Pegajoso -->
	<script type="text/javascript" src="js/sticky_menu.js"></script>
</head>
<body id="body">
	<!-- Boton Carrito -->
	<div id="caja"></div>
	<div id="caja2" class="hidden-xs hidden-md">
		<a href="carrito.php" id="carrito"><img src="img/plantilla/carrito.png"></a>
	</div>

	<div class="container">
		<header class="col-md-12">
			<div class="navegador">
				<!-- logo -->
				<a href="index.php"><img src="img/plantilla/logo.png" class="col-md-3 col-xs-10 col-sm-12"></a>
				<!-- menu -->
				<nav role="navigation" class="col-md-9">
				    <div class="navbar-header col-xs-offset-12">
				        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle btn btn-lg">
				            <span class="glyphicon glyphicon-menu-hamburger"></span>
				        </button>
				    </div> 
				    <div id="navbarCollapse" class="collapse navbar-collapse">
				        <ul class="navbar-nav" id="menu">
				            <li><a href="index.php" class="active">INICIO</a></li>
				            <li><a href="quienSomos.php">QUIÉNES SOMOS</a></li>
				            <li><a href="artistas.php">ARTISTAS</a></li>
				            <li><a href="contratacion.php">CONTRATACIÓN</a></li>
				            <li><a href="eventos.php">EVENTOS</a></li>
				            <li><a href="contactenos.php">CONTÁCTENOS</a></li>
				        </ul>
				    </div>
				</nav>
			</div>
		</header>		
		<section class="col-md-12">
			<article class="contSlider">
				<!-- Include de Slider -->
				<?php require "modulos/consultaSlider.php"; ?>
			</article>
			<article class="eventos">
				<div class="content-container">
					<div id="portfolio-content" class="center-text">
						<div class="portfolio-page" id="page-1">
							<!-- Include de Eventos -->
							<?php include_once "modulos/mostrarEventos.php"; ?>
						</div>
					</div>
				</div>
			</article>
		</section>
		<hr width=100%>
		<section class="col-md-12 masPedidos">
			<center><h1>LOS MÁS PEDIDOS</h1></center>
			<?php include_once "modulos/artistasMasVistos.php"; ?>
		</section>
		<section class="col-md-12">			
			<article class="col-md-3">
				<h2>RECOMENDADOS</h2>
				<?php include_once "modulos/artistasRecomendados.php"; ?>
			</article>

			<article class="col-md-6">
				<div clas="scroll">
					<h2>LISTA EVENTOS</h2>
					<?php include_once "modulos/consultaEventosLista.php"; ?>
				</div>
			</article>

			<article class="col-md-3">
				<h2>INSTAGRAM</h2>
				<script src="//lightwidget.com/widgets/lightwidget.js"></script>
				<iframe src="//lightwidget.com/widgets/809e964aa93f570bbe0279ef6237f237.html" id="lightwidget_809e964aa9" name="lightwidget_809e964aa9" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0px; overflow: hidden; height: 600px;"></iframe>
			</article>			
		</section>
		<hr width=100%>
		<footer class="col-md-12">
			<br><br>
			<p class="col-md-3">APLICA RESTRICCIONES TÉRMINOS Y CONDICIONES MIDNIGHT <a href="AdministracionEventos/index.php">Panel</a></p>
			<p class="col-md-3"><img src="img/plantilla/logo.png" width="100%"></p>
			<p class="col-md-3">SI TIENES ALGUNA INQUIETUD CONTACTENOS</p>
			<p class="col-md-3">TEL: (57 1) 656 3653 CARRERA 50 #100-88  - BOGOTÁ</p>
		</footer>
	</div>
</body>
</html>