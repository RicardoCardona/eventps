<?php
	// Desicion para descartar errores
	try{
		session_start();
		// conexion a BD
		require "conexion.php";
		$idCliente=0;
		$idCliente=$_SESSION['idCliente'];

		// Variable
		$id2=$_POST['ubicacion'];

		// CRUD sql
		$sql=$conn->prepare('INSERT INTO buffercarrito (idUbicacion, idLocalidad, idEvento) SELECT ubicacion.idUbicacion, ubicacion.idLocalidad, localidades.idEvento FROM ubicacion INNER JOIN localidades ON localidades.idLocalidad = ubicacion.idLocalidad WHERE ubicacion.idUbicacion = :P1');
		// array de varibales
		$resultado=$sql->execute(array('P1'=>$id2));
		// Conteo de cantidad de Resultados
		$num=$sql->rowCount();

		// decision de resultado
		if ($num>=1) {
			// CRUD sql dentro de desicion
			$sql2=$conn->prepare('UPDATE buffercarrito SET idUsuario = :P3 WHERE idUbicacion = :P2');
			// array de varibales
			$resultado2=$sql2->execute(array('P2'=>$id2, 'P3'=>$idCliente));
			// Conteo de cantidad de Resultados
			$num2=$sql2->rowCount();
		
			if ($num2>=1) {
				// CRUD sql dentro de desicion
				$sql3=$conn->prepare('UPDATE ubicacion SET estado = "reservado" WHERE idUbicacion = :P4');
				// array de varibales
				$resultado3=$sql3->execute(array('P4'=>$id2));
				// Conteo de cantidad de Resultados
				$num3=$sql3->rowCount();
			}

			// muestreo de Resultados
			echo '
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					La Boleta Fue Agregada Al Carrito Correctamente.
				</div>
				';
		}else{
			// muestreo de Resultados
			echo '
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					La Boleta No Fue Agregada Al Carrito.
				</div>
				';
		}
			
	
		//Cerrar la Conexión
		$conn=NULL;		
	}catch(PDOException $e){
		//decision de errores
		echo "ERROR: ".$e->getMessage();
		//salida
		exit();
	}
?>