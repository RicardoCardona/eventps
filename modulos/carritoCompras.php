<?php
	// Desicion para descartar errores
	try{
		session_start();
		// conexion a BD
		require "conexion.php";		
		$idCliente=$_SESSION['idCliente'];
		$valorTotal=0;

		// consulta
		$sql=$conn->prepare('SELECT buffercarrito.idBuffer, ubicacion.columna, ubicacion.fila, evento.nombreEvento, localidades.idLocalidad, localidades.localidad, localidades.tipoLocalidad, localidades.valor FROM buffercarrito INNER JOIN ubicacion ON ubicacion.idUbicacion=buffercarrito.idUbicacion INNER JOIN evento ON evento.idEvento=buffercarrito.idEvento INNER JOIN localidades ON localidades.idLocalidad=buffercarrito.idLocalidad WHERE buffercarrito.idUsuario = :P1');
		// array de varibales
		$resultado=$sql->execute(array('P1'=>$idCliente));
		// selección de resultados
		$resultado=$sql->fetchAll();
		// Conteo de cantidad de Resultados
		$num=$sql->rowCount();
			
		// decision de resultado
		if ($num>=1) {
			echo '
					<div id="notificacionCarrito"></div>
					<h3>Resumen Carrito</h3>
					<table class="table table-condensed">
						<h5>
							<tr>
								<th>EVENTO</th>
								<th>LOCALIDAD</th>
								<th>UBICACIÓN</th>
								<th>VALOR</th>
								<th>ACCIÓN</th>
							</tr>
					';
			foreach ($resultado as $fila) {
				echo '
						<tr>
							<td>'.$fila['nombreEvento'].'</td>
							<td>'.$fila['localidad'].'</td>
							<td>'.$fila['columna'].'-'.$fila['fila'].'</td>
							<td>'.number_format($fila['valor']).'</td>					
							<td>
								<input class="llave1" type="hidden" value="'.$fila['idBuffer'].'"/>
								<input class="localidaGeneral" type="hidden" value="'.$fila['idLocalidad'].'"/>
								<button type="button" class="'.$fila['tipoLocalidad'].'eliminar btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
							</td>
						</tr>
				';
				$valorTotal=$fila['valor']+$valorTotal;	
			}
			echo '
							</h5>
						</table>						
						<div id="Total" class="col-md-offset-9">
							<h4> Valor Total: $ '.number_format($valorTotal).'</h4>
						</div>
						<button type="button" class="Regresar btn btn-primary">Seguir Comprando</button>
						<button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">Finalizar Compra</button>
				
				';
		}else{
				echo '<h4>No Existen Boletos Cargados En El Carrito</h4>';
			}

		//Cerrar la Conexión
		$conn=NULL;
		
	}catch(PDOException $e){
		//decision de errores
		echo "ERROR: ".$e->getMessage();
		//salida
		exit();
	}
?>