<?php
	try{
		session_start();		

		require "conexion.php";		

		$idUsuario=$_SESSION['idCliente'];
		$celular= $_POST['celular'];
		$nombre= $_POST['usuario'];

		$sql2=$conn->prepare('INSERT INTO celularUsuario (celular, nombre, idUsuario) VALUES (:P1,:P2,:P3)');
		$resultado2=$sql2->execute(array('P1'=>$celular, 'P2'=>$nombre,'P3'=>$idUsuario));
		$num2=$sql2->rowCount();

		if ($num2>=1) {
			echo '
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h5 class="center-text">Numero Ingresado Correctamente</h5>
				</div>
			';
		}else{
			echo '
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h5 class="center-text">Ha Ocurrido Un Error Inesperado</h5>
				</div>
			';
		}
		$conn = null; //cerrar la conexion
	} catch (PDOException $e) {
		echo "ERROR : " . $e->getMessage();
		exit();
	}
?>