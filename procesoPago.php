<?php
    session_start();
    if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
        print "<script>alert(\"Acceso invalido!\");window.location='../index.php';</script>";
    }
?>
<!--
	Compañía: Bynary01
	Autor: Ricardo cardona
	Sistema: Midnight
	Fecha: 22/11/2016
	Descripción: Compra final Midnight	
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
					        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle btn btn-lg"><span class="glyphicon glyphicon-menu-hamburger"></span>
					        </button>
					    </div>
					    <div id="navbarCollapse" class="collapse navbar-collapse">
					        <ul class="navbar-nav" id="menu">
					            <li><a href="index.php">INICIO</a></li>
					            <li><a href="quienSomos.php">QUIENES SOMOS</a></li>
					            <li><a href="artistas.php">ARTISTAS</a></li>
					            <li><a href="contratacion.php">CONTRATACIÓN</a></li>
					            <li><a href="eventos.php" class="active">EVENTOS</a></li>
					            <li><a href="contactenos.php">CONTÁCTENOS</a></li>
					        </ul>
					    </div>
					</nav>
				</div><br><br>
			</header>
			<div>
				<?php
					require "modulos/conexion.php";
					
				    $sql = $conn->prepare('SELECT * FROM user WHERE id = :parametro');
				    $resultado = $sql->execute(array('parametro'=>$_SESSION['user_id']));
				    $resultado = $sql->fetchAll();
				    $num = $sql->rowCount();

					if ($num>=1) {
						foreach ($resultado as $nombre) {
							echo "<h4 class='col-md-8'>  Bienvenido : ".$nombre['nombres']." ".$nombre['apellidos']." </h4><a href='AdministracionEventos/login/logoutComun.php' class='col-md-2'>Cerrar Sesión</a> ";
						}
						$sql1 = $conn->prepare('UPDATE buffercarrito SET idUsuario = :P1 WHERE idUsuario = :P2');
						$resultado1 = $sql1->execute(array('P1'=>$_SESSION['user_id'], 'P2'=>$_SESSION['idCliente']));
						$num1 = $sql1->rowCount();

						if ($num1>=1) {
							$_SESSION['idCliente']=$_SESSION['user_id'];
						}
					}
				?>
			</div>
			<div>
				<div class="col-md-8">
					<div class="carrito carrito2 col-md-12"></div>
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
			</div>
			<footer class="col-md-12">
				<br><br>
				<p class="col-md-3">APLICA RESTRICCIONES TÉRMINOS Y CONDICIONES MIDNIGHT <a href="AdministracionEventos/index.php">Panel</a></p>
				<p class="col-md-3"><img src="img/plantilla/logo.png" width="100%"></p>
				<p class="col-md-3">SI TIENES ALGUNA INQUIETUD CONTACTENOS</p>
				<p class="col-md-3">TEL: (57 1) 656 3653 CARRERA 50 #100-88  - BOGOTÁ</p>
			</footer>
		<!-- contenedor Fin -->	
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel" style="color: #000;">Proceso de Pago</h4>
					</div>
					<div class="modal-body" style="color: #000;">
						<div id="alertaNumeros">
							<div class="alert alert-warning">
								<center>Agrega los numeros de telefono a los cuales se les va a enviar el codigo del ticket</center>
							</div>
						</div>

						<table class="table table-condensed numeros">
							<div id="desplegableDestino">
								<form>
									<select id="destinatarios" class="form-control">
										<option>Seleccione</option>
										<option value="no">Enviar solo a mi celular</option>
										<option value="si">Incluir mas personas</option>									
									</select>
								</form>
							</div>
						</table>
					</div>
					<div class="modal-footer">
						<div id="botonPayU">
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
</html>
