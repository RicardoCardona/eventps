<?php
	try{
		session_start();
		require "conexion.php";

		$idCliente=0;
		$idCliente=$_SESSION['idCliente'];
		$idLocalidad=$_POST['idLocalidad'];
		$cantidadBoletas=$_POST['cantidadBoletas'];

		$sql=$conn->prepare('SELECT * FROM localidades WHERE idLocalidad = :P1');
		$resultado=$sql->execute(array('P1'=>$idLocalidad));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			foreach ($resultado as $fila) {
				$aforoDisponible=$fila['aforoDisponible'];
				$idEvento=$fila['idEvento'];
			}
			if ($aforoDisponible >= $cantidadBoletas) {
				$sql2=$conn->prepare('SELECT * FROM ubicacion WHERE idLocalidad = :P1');
				$resultado2=$sql2->execute(array('P1'=>$idLocalidad));
				$resultado2=$sql2->fetchAll();
				$num2=$sql2->rowCount();

				if ($num2>=1) {
					foreach ($resultado2 as $fila) {
						$idUbicacion=$fila['idUbicacion'];
					}
					for ($i=1; $i<=$cantidadBoletas; $i++) {
						$sql3=$conn->prepare('INSERT INTO buffercarrito (idUsuario, idUbicacion, idEvento, idLocalidad) VALUES (:P1, :P2, :P3, :P4)');
						$resultado3=$sql3->execute(array('P1'=>$idCliente, 'P2'=>$idUbicacion, 'P3'=>$idEvento, 'P4'=>$idLocalidad));
						$num3=$sql3->rowCount();
					}

					if ($num3>=1) {
						echo '
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								Las Boletas ('.$cantidadBoletas.') Fueron Agregadas Al Carrito Correctamente.
							</div>
						';
					}else{
						echo '
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								Las Boletas No Fueron Agregadas Al Carrito.
							</div>
						';
					}
				}else{
					echo '
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							Ha Ocurrido un Error Inesperado.
						</div>
					';
				}
			}else{
				echo '
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						El Numero de Boletas Seleccionado, No se Encuentra Disponible.
					</div>
				';
			}
		}else{
			echo '
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					Ha Ocurrido un Error Inesperado.
				</div>
			';
		}

		$conn=NULL;
	}catch(PDOException $e){
		//decision de errores
		echo "ERROR: ".$e->getMessage();
		//salida
		exit();
	}
?>