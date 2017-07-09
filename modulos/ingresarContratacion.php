<?php
	try {
		require "conexion.php";

		$artista= $_POST['artista'];
		$nombreUsuario= $_POST['nombreUsuario'];
		$telefonoUsuario= $_POST['telefonoUsuario'];
		$correoUsuario= $_POST['correoUsuario'];
		$tipoEvento= $_POST['tipoEvento'];
		$ciudad= $_POST['ciudad'];

		$sql2=$conn->prepare('SELECT * FROM ciudades WHERE idCiudades = :P1');
		$resultado2=$sql2->execute(array('P1'=>$ciudad));
		$resultado2=$sql2->fetchAll();
		$num2=$sql2->rowCount();

		if ($num2>=1) {
			foreach ($resultado2 as $fila) {
				$ciudad2=$fila['Ciudad'];
			}
			$sql3=$conn->prepare('SELECT * FROM artistas WHERE idArtista = :P1');
			$resultado3=$sql3->execute(array('P1'=>$artista));
			$resultado3=$sql3->fetchAll();
			$num3=$sql3->rowCount();

			if ($num3>=1) {
				foreach ($resultado3 as $fila) {
					$artista2=$fila['nombreArtista'];
				}
				$sql=$conn->prepare('SELECT * FROM configuracion');
				$resultado=$sql->execute(array());
				$resultado=$sql->fetchAll();
				$num=$sql->rowCount();

				if ($num>=1) {
					foreach ($resultado as $fila) {
						$email=$fila['email'];		
					}
					$mensaje = '
						<html>
						<head>
	 						<title>CONTRATACIÓN ARTISTA</title>
						</head>
						<body>
	 						<p>Artista: '.$artista2.'</p>
	 						<p>Nombre de Usuario: '.$nombreUsuario.'</p>
	 						<p>Telefono: '.$telefonoUsuario.'</p>
	 						<p>Correo: '.$correoUsuario.'</p>
	 						<p>Tipo de Evento: '.$tipoEvento.'</p>
	 						<p>Ciudad: '.$ciudad2.'</p>
						</body>
						</html>
					';

					$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$cabeceras .= 'From: '.$nombreUsuario.' <'.$correoUsuario.'>' . "\r\n";
		
					$contratacion = mail($email, "CONTRATACIÓN ARTISTA", $mensaje, $cabeceras);

					if($contratacion){
						echo "Mensaje Enviado Correctamente";
					}else{
    					echo 'ERROR INESPERADO.';
					}
				}else{
					echo 'HA OCURRIDO UN ERROR';
				}
			}else{
    			echo '¡ERROR! INTENTE NUEVAMENTE';
			}
		}else{
    		echo '¡ERROR INESPERADO!';
		}

		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>