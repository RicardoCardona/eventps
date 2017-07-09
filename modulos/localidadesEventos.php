<?php
	// Desicion para descartar errores
	try{
		// conexion a BD
		require "conexion.php";

		// Variable
		$codigo=$_POST['codigo'];

		// consulta
		$sql=$conn->prepare('SELECT * FROM localidades WHERE idEvento = :P1');
		// array de varibales
		$resultado=$sql->execute(array('P1'=>$codigo));
		// selección de resultados
		$resultado=$sql->fetchAll();
		// Conteo de cantidad de Resultados
		$num=$sql->rowCount();

		// decision de resultado
		if ($num>=1) {
				// Dato necesario no repetible sin resultado PHP, se usa para titulos su Enfoque es de "diseño".
				echo '
						<h4 class="center-text">UBICACIÓN Y PRECIOS</h4>
						<h5>
							<table class="table table-condensed">
								<tr>
									<th>LOCALIDAD</th>
									<th>PRECIO</th>
									<th>COMPRAR</th>
								</tr>
					';

			// Ciclo de muestra de Resultados
			foreach ($resultado as $fila) {
				// muestreo de Resultados
				if ($fila['tipoLocalidad'] == "general") {
					echo '

								<tr>
									<td class="localidad" data-id="'.$fila['idLocalidad'].'">'.$fila['localidad'].'</td>
									<td>'.number_format($fila['valor']).'</td>
									<td>
										<button type="button" class="comprarGeneral btn btn-default btn-xs" data-toggle="modal" data-target="#myModal">
											<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
										</button>
									</td>
								</tr>

					';
				}else{
					echo '

								<tr>
									<td class="localidad" data-id="'.$fila['idLocalidad'].'">'.$fila['localidad'].'</td>
									<td>'.number_format($fila['valor']).'</td>
									<td>
										<button type="button" class="comprar btn btn-default btn-xs" data-toggle="modal" data-target="#myModal">
											<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
										</button>
									</td>
								</tr>

					';
				}
			}
				// Dato necesario no repetible sin resultado PHP, se usa para titulos su Enfoque es de "diseño".
				echo '
							</table>
						</h5>
				';
		}else{
			echo '<h5>No Existen Localidades Actualmente</h5>';
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