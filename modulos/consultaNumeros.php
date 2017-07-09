<?php
	try{
		session_start();		

		require "conexion.php";		
		$idCliente=$_SESSION['idCliente'];
		$valorTotal=0;
		$numerosFaltantes=0;

		$sql3=$conn->prepare('UPDATE celularUsuario SET estado = "0" WHERE idUsuario = :P1');
		$resultado3=$sql3->execute(array('P1'=>$idCliente));
		$num3=$sql3->rowCount();

		if ($num3>=1) {
			$sql=$conn->prepare('SELECT * FROM buffercarrito WHERE idUsuario = :P1');
			$resultado=$sql->execute(array('P1'=>$idCliente));
			$resultado=$sql->fetchAll();
			$num=$sql->rowCount();
		}else{
			$sql=$conn->prepare('SELECT * FROM buffercarrito WHERE idUsuario = :P1');
			$resultado=$sql->execute(array('P1'=>$idCliente));
			$resultado=$sql->fetchAll();
			$num=$sql->rowCount();
		}

		for ($i=0; $i<$num; $i++) {
			$sql2=$conn->prepare('SELECT * FROM celularUsuario WHERE idUsuario = :P1');
			$resultado2=$sql2->execute(array('P1'=>$idCliente));
			$resultado2=$sql2->fetchAll();
			$num2=$sql2->rowCount();


			if ($num2>=1) {
				echo '
					<table>
						<tr>
							<td>
								<select class="form-control nombreCelular">
				';
				foreach ($resultado2 as $fila) {
					echo '
									<option value="'.$fila['idCelularUsuario'].'">'.$fila['nombre'].' ('.$fila['celular'].')</option>
					';
				}
				echo '
								</select>
							</td>
							<td>
								<button type="button" class="btn btn-success guardarNombre">OK</button>
							</td>
						</tr>
					</table>
				';
			}else{
				echo '<h2>No Ha Registrado Ningun Numero</h2>';
			}
		}
		echo '
			<br><br>
			<hr>
			<div id="botonMas">
				<button type="button" class="btn masNumeros">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
			</div>
		';

		//Cerrar la Conexión
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>