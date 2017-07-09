<?php
	try {
		// Conexión a la base de datos por medio de PDO
		require "conexion.php";

		// Captura las variables que vienen desde el Ajax
		$idCelularUsuario= $_POST['nombreCelular'];


		$sql=$conn->prepare('UPDATE celularUsuario SET estado = "1" WHERE idCelularUsuario = :P1');
		$resultado=$sql->execute(array('P1'=>$idCelularUsuario));
		$num=$sql->rowCount();

		if ($num>=1) {
			echo '
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h5 class="center-text">Numero Editado Correctamente</h5>
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