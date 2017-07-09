<?php
	try {
		require "conexion.php";

		$nombreUsuario= $_POST['nombreUsuario'];
		$telefonoUsuario= $_POST['telefonoUsuario'];
		$correoUsuario= $_POST['correoUsuario'];
		$mensajeUsuario= $_POST['mensajeUsuario'];

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
	 				<title>CONTACTO</title>
				</head>
				<body>
	 				<p>Nombre de Usuario: '.$nombreUsuario.'</p>
	 				<p>Telefono: '.$telefonoUsuario.'</p>
	 				<p>Correo: '.$correoUsuario.'</p>
	 				<p>Mensaje: '.$mensajeUsuario.'</p>
				</body>
				</html>
			';

			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$cabeceras .= 'From: '.$nombreUsuario.' <'.$correoUsuario.'>' . "\r\n";
		
			$contacto = mail($email, "CONTACTO", $mensaje, $cabeceras);

			if($contacto){
				echo "Mensaje Enviado Correctamente";
			}else{
    			echo 'ERROR INESPERADO';
			}
		}else{
			echo 'ERROR INESPERADO';
		}
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>