<?php
	try{
		session_start();		

		require "conexion.php";		
		$idCliente=$_SESSION['idCliente'];

		$sql=$conn->prepare('UPDATE celularUsuario SET estado = "1" WHERE idUsuario = :P1 AND principal = "si"');
		$resultado=$sql->execute(array('P1'=>$idCliente));
		$num=$sql->rowCount();

		if ($num>=1) {
			echo 'NUMERO PRINCIPAL EDITADO CORRECTAMENTE';
		}else{
			echo 'HA OCURRIDO UN ERROR INESPERADO';
		}
		//Cerrar la Conexión
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>