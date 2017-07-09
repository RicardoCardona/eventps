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
</head>
<body>
	<div id="body2">
		<!-- contenedor -->
		<div class="container">
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
					            <li><a href="eventos.php">EVENTOS</a></li>
					            <li><a href="contactenos.php">CONTÁCTENOS</a></li>
					        </ul>
					    </div>
					</nav>
				</div>
			</header>
			<section class="col-md-12">
			<?php
				$transactionState = $_REQUEST['transactionState'];

				if ($_REQUEST['transactionState'] == 4 ) {
					$estadoTx = "Transacción aprobada";

					echo '
						<center>
							<br><br><br><br>
							<h1 class="activeH">GRACIAS POR TU COMPRA</h1>
							<h3>- Via E-mail se ha enviado enviado Información de la Factura</h3>
							<h3>- Vía SMS se ha enviado el enlace de Descarga del Ticket</h3>
							<br><br><br><br><br><br><br><br><br><br>
						</center>
					';
				}else if ($_REQUEST['transactionState'] == 6 ) {
					$estadoTx = "Transacción rechazada";

					echo '
						<center>
							<br><br><br><br>
							<h1 class="activeH">TRANSACCIÓN INVALIDA</h1>
							<h3>- Ha Ocurrido un Error Inesperado</h3>
							<br><br><br><br><br><br><br><br><br><br>
						</center>
					';
				}else if ($_REQUEST['transactionState'] == 104 ) {
					$estadoTx = "Error";

					echo '
						<center>
							<br><br><br><br>
							<h1 class="activeH">ERROR</h1>
							<h3>- Ha Ocurrido un Error Inesperado</h3>
							<br><br><br><br><br><br><br><br><br><br>
						</center>
					';
				}else if ($_REQUEST['transactionState'] == 7 ) {
					$estadoTx = "Transacción pendiente";

					echo '
						<center>
							<br><br><br><br>
							<h1 class="activeH">TRANSACCIÓN PENDIENTE</h1>
							<h2>Una vez aprobada la Transacción se le notificara:</h2>
							<h3>- Via E-mail con Información de la Factura</h3>
							<h3>- Vía SMS con el enlace de Descarga del Ticket</h3>
							<br><br><br><br><br><br><br><br><br><br>
						</center>
					';

				}else {
					$estadoTx=$_REQUEST['mensaje'];

					echo '
						<center>
							<br><br><br><br>
							<h1 class="activeH">'.$estadoTx.'</h1>
							<br><br><br><br><br><br><br><br><br><br>
						</center>
					';
				}
			?>

			</section>
			<footer class="col-md-12">
				<br><br>
				<p class="col-md-3">APLICA RESTRICCIONES TÉRMINOS Y CONDICIONES MIDNIGHT <a href="AdministracionEventos/index.php">Panel</a></p>
				<p class="col-md-3"><img src="img/plantilla/logo.png" width="100%"></p>
				<p class="col-md-3">SI TIENES ALGUNA INQUIETUD CONTACTENOS</p>
				<p class="col-md-3">TEL: (57 1) 656 3653 CARRERA 50 #100-88  - BOGOTÁ</p>
			</footer>
		</div>		
	</div>
</body>
</html>