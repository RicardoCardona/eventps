<?php
	try{
		session_start();

		require "conexion.php";
		$idCliente=$_SESSION['idCliente'];
		$estado="activo";

		$sql=$conn->prepare('SELECT * FROM buffercarrito WHERE idUsuario = :P1');
		$resultado=$sql->execute(array());
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {
			foreach ($resultado as $fila) {
				$idUbicacion = $fila['idUbicacion'];
			
				$sql2=$conn->prepare('UPDATE ubicacion SET estado = :P2 WHERE idUbicacion = :P1');
				$resultado2=$sql2->execute(array('P1'=>$idUbicacion, 'P2'=>$estado));
				$num2=$sql2->rowCount();

				if ($num2>=1) {
					$sql3=$conn->prepare('DELETE FROM buffercarrito WHERE idUbicacion = :P1');
					$resultado3=$sql3->execute(array('P1'=>$idUbicacion));
					$num3=$sql3->rowCount();
				}
			}
		}

		$conn=NULL;
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>