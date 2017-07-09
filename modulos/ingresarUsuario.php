<?php
	try {
		session_start();
		// Conexión a la base de datos por medio de PDO
		require "conexion.php";

		// Captura las variables que vienen desde el Ajax
		$nombres= $_POST['nombres'];
		$apellidos= $_POST['apellidos'];
		$email= $_POST['email'];
		$password= base64_encode($_POST["password"]);
		$telefono= $_POST['telefono'];
		$nivel= "0";

		$sql=$conn->prepare('SELECT * FROM user WHERE email = :P1');
		$resultado=$sql->execute(array('P1'=>$email));
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			print "<script>alert(\"Ya Existe un usuario registrado con el mismo E-mail.\"); history.back();</script>";
		}else{
			$sql2=$conn->prepare('INSERT INTO user (id, username, email, password, nombres, apellidos, celular, nivel) VALUES (:P1,:P3,:P3,:P4,:P5,:P6,:P7,:P8)');
			$resultado2=$sql2->execute(array('P1'=>$_SESSION['idCliente'], 'P3'=>$email,'P4'=>$password,'P5'=>$nombres,'P6'=>$apellidos,'P7'=>$telefono,'P8'=>$nivel));
			$num2=$sql2->rowCount();

			if ($num2>=1) {
				$sql3=$conn->prepare('INSERT INTO celularUsuario (idUsuario, celular, nombre, principal) VALUES (:P1,:P2,:P3,:P4)');
				$resultado3=$sql3->execute(array('P1'=>$_SESSION['idCliente'], 'P2'=>$telefono, 'P3'=>$nombres, 'P4'=>"si"));
				$num3=$sql3->rowCount();

				if ($num3>=1) {
					$_SESSION["user_id"]=$_SESSION['idCliente'];
					$_SESSION['email']=$email;
					print "<script>alert(\"Usuario Registrado Correctamente.\"); window.location='../procesoPago.php';</script>";
				}else{
					print "<script>alert(\"ha ocurrido un error inesperado.\"); history.back();</script>";
				}
			}else{
				print "<script>alert(\"No se pudo Ingresar.\"); history.back();</script>";
			}
		}

		$conn = null; //cerrar la conexion
	} catch (PDOException $e) {
		echo "ERROR : " . $e->getMessage();
		exit();
	}
?>