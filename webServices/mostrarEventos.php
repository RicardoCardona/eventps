<?php
	try{
		date_default_timezone_set('America/Bogota');
		require "conexion.php";

		$fechaHoy=date('Y-m-d');

		$sql=$conn->prepare('SELECT relacionimagenes.idrelacionImagenes, evento.idEvento, evento.nombreEvento, evento.horaInicio, evento.fechaEvento, imagenes.imagen, imagenes.nombreImagen, sitio.nombreSitio, ciudades.Ciudad FROM relacionimagenes INNER JOIN evento ON evento.idEvento = relacionimagenes.idEvento INNER JOIN imagenes ON imagenes.idImagen = relacionimagenes.idImagen INNER JOIN sitio ON sitio.idSitio = evento.idSitio INNER JOIN ciudades ON ciudades.idCiudades = evento.idCiudad WHERE evento.estado = "activo" AND evento.tipoEvento = "venta" AND evento.fechaFinPublicacion >= :P1 AND relacionimagenes.tipoImagen = "principal" ORDER BY evento.idEvento DESC');
		$resultado=$sql->execute(array('P1'=>$fechaHoy));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			// foreach ($resultado as $fila) {
			// 	$responseEvento["idEvento"]=$fila['idEvento'];
			// 	$responseEvento["imagen"]=$fila['imagen'];
			// 	$responseEvento["nombreEvento"]=$fila['nombreEvento'];
			// 	$responseEvento["fechaEvento"]=$fila['fechaEvento'];
			// 	$responseEvento["horaInicio"]=$fila['horaInicio'];
			// 	$responseEvento["Ciudad"]=$fila['Ciudad'];
			// 	$responseEvento["nombreSitio"]=$fila['nombreSitio'];			
			// }
			// 	echo json_encode($responseEvento, JSON_UNESCAPED_SLASHES);
			
			$jsontext = "[";
			foreach ($resultado as $fila) {
				$jsontext .= '{"idEvento": "'.$fila['idEvento'].'", "imagen": "'.$fila['imagen'].'", "nombreEvento": "'.$fila['nombreEvento'].'", "fechaEvento": "'.$fila['fechaEvento'].'", "horaInicio": "'.$fila['horaInicio'].'", "Ciudad":"'.$fila['Ciudad'].'", "nombreSitio":"'.$fila['nombreSitio'].'"},';
			}
			$jsontext = substr_replace($jsontext, '', -1); // to get rid of extra comma
			$jsontext .= "]";
			echo $jsontext;
		}else{
			$responseEvento["state"] = "unexpected-error";
			$responseEvento["message"] = mysqli_error();
			echo json_encode($responseEvento);
		}
		$conn=NULL;
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>