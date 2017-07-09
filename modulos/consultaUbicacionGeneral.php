<?php
	try{
		require "conexion.php";

		$id=$_POST['localidad'];

		$sql2=$conn->prepare('SELECT * FROM localidades WHERE idLocalidad = :P1');
		$resultado2=$sql2->execute(array('P1'=>$id));
		$resultado2=$sql2->fetchAll();
		$num2=$sql2->rowCount();

		if ($num2>=1) {
			foreach ($resultado2 as $fila) {					
				$idLocalidad=$fila['idLocalidad'];
				$aforoDisponible=$fila['aforoDisponible'];
				$localidad=$fila['tipoLocalidad'];
			}
			$sql=$conn->prepare('SELECT * FROM ubicacion WHERE idLocalidad = :P1 AND estado = "inactivo" ORDER BY idUbicacion ASC');
			$resultado=$sql->execute(array('P1'=>$id));
			$resultado=$sql->fetchAll();
			$num=$sql->rowCount();

			if ($num>=1) {
				echo ' <button type="button" class="center-block btn btn-primary btn-lg btn-block">TARIMA</button><br>
						<table>';

				foreach ($resultado as $fila) {
					if ($localidad == "general") {
						if ($aforoDisponible > 0) {
							echo '
								<div class="col-sm-3 form-horizontal"></div>
								<div class="col-sm-6 form-horizontal">
									<form class="form-horizontal">
										<label class="control-label" style="color: #000;">Seleccione Cantidad de Boletos a Comprar</label>
										<div class="form-group">
											<div class="col-sm-6">
												<input type="hidden" value="'.$idLocalidad.'" class="idLocalidad">
												<select class="form-control cantidadBoletas">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
											</div>
											<div class="col-sm-6">
												<button type="button" class="btn btn-success compraGeneral">Comprar</button>
											</div>
										</div>
									</form>
								</div><br><br><br>
							';
						}
					}
				}
				echo '
					</table>';
			}else{
				echo '
					<div class="alert alert-danger alert-dismissable">
						No Existen Ubicaciones Actualmente
					</div>
				';
			}
		}else{
			echo '
				<div class="alert alert-danger alert-dismissable">
					No Existen Ubicaciones Actualmente
				</div>
			';
		}
		//Cerrar la Conexión
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>