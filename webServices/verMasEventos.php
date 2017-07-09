<?php
	try{
		require "conexion.php";
		$idEvento = isset($_GET['idEvento']) ? $_GET['idEvento'] : "";

		$sql=$conn->prepare('SELECT evento.idEvento, evento.nombreEvento, evento.fechaEvento, evento.horaInicio, evento.horaFin, evento.descripcionEvento, sitio.nombreSitio, ciudades.Ciudad FROM evento INNER JOIN sitio ON sitio.idSitio = evento.idSitio INNER JOIN ciudades ON ciudades.idCiudades = evento.idCiudad WHERE evento.estado = "activo" AND evento.idEvento = :P1');
		$resultado=$sql->execute(array('P1'=>$idEvento));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			$jsontext = "[";
			foreach ($resultado as $fila) {
				$jsontext .= '{"idEvento": "'.$fila['idEvento'].'", "nombreEvento": "'.$fila['nombreEvento'].'", "fechaEvento": "'.$fila['fechaEvento'].'", "horaInicio": "'.$fila['horaInicio'].'", "horaFin": "'.$fila['horaFin'].'", "descripcionEvento":"'.$fila['descripcionEvento'].'", "nombreSitio":"'.$fila['nombreSitio'].'", "Ciudad":"'.$fila['Ciudad'].'"},';
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