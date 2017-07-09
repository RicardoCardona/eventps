<?php
	$id=uniqid('', true);
	
	$nombres= $_REQUEST['nom'];
	$apellidos= $_REQUEST['ape'];
	$telefono= $_REQUEST['cel'];
	$email= $_REQUEST['correo'];
	$password= base64_encode($_REQUEST["con"]);
	$nivel= "1";

	include "conexion.php";

	$sql=$conn->query("SELECT * FROM user WHERE email = '$email'");
	$num=$sql->rowCount();

	if ($num>=1) {
		echo "Ya Existe un usuario registrado con el mismo E-mail";
	}else{
		$sql2=$conn->query("INSERT INTO user (id, username, email, password, nombres, apellidos, celular, nivel) VALUES ('$id', '$email', '$email', '$password', '$nombres', '$apellidos', '$telefono', '$nivel')");
		$num2=$sql2->rowCount();

		if ($num2>=1) {
			$sql3=$conn->query("INSERT INTO celularUsuario (idUsuario, celular, nombre) VALUES ('$id', '$telefono', '$nombres')");
			$num3=$sql3->rowCount();

			if ($num3>=1) {
				$sql4=$conn->query("SELECT * FROM user WHERE email = '$email'");
				$num4=$sql4->rowCount();

				$datos=array();
				if ($num4>=1) {
					foreach ($sql4 as $fila) {
						$datos[]=$fila;
					}
					echo json_encode($datos);
				}
			}
		}
	}
?>