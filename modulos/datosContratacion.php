<?php
	try{
		require "conexion.php";

		$sql=$conn->prepare('SELECT * FROM artistas WHERE estado = "activo"');
		$resultado=$sql->execute(array());
		$resultado=$sql->fetchAll();
		$num=$sql->rowCount();

		if ($num>=1) {				
			echo '
				
					<h3 class="activeH">SOLICITE SU ARTISTA, LE RESPONDEREMOS</h3>
					<form>
						<div class="form-group col-md-6 contenedorText">
							<label for="">SELECCIONE SU ARTISTA</label>
							<select id="artista" class="form-control col-sm-12 textbox">
					
			';
			foreach ($resultado as $fila) {
				echo '
								<option value="'.$fila['idArtista'].'">'.$fila['nombreArtista'].'</option>
				';				
			}
			echo '
							</select>
						</div>
						<div class="col-md-6 col-sm-12 contenedorText">
							<label for="">NOMBRE</label>
							<input type="text" id="nombreUsuario" class="form-control col-sm-12 textbox">
						</div>
						<div class="col-md-6 col-sm-12 contenedorText">
							<label for="">TELÉFONO</label>
							<input type="number" id="telefonoUsuario" class="form-control col-sm-12 textbox">
						</div>
						<div class="col-md-6 col-sm-12 contenedorText">
							<label for="">CORREO ELECTRÓNICO</label>
							<input type="text" id="correoUsuario" class="form-control col-sm-12 textbox">
						</div>
						<div class="col-md-6 col-sm-12 contenedorText">
							<label for="">TIPO EVENTO</label>
							<select id="tipoEvento" class="form-control col-sm-12 textbox">
								<option value="publico">Público</option>
								<option value="privado">Privado</option>
								<option value="lanzamiento">Lanzamiento/Activación</option>
							</select>
						</div>
			';
			$sql2=$conn->prepare('SELECT * FROM ciudades WHERE Paises_Codigo = "CO"');
			$resultado2=$sql2->execute(array());
			$resultado2=$sql2->fetchAll();
			$num2=$sql2->rowCount();

			if ($num2>=1) {
				echo '
						<div class="col-md-6 col-sm-12 contenedorText">
							<label for="">CIUDAD</label>
							<select id="ciudad" class="form-control col-sm-12 textbox">
				';
				foreach ($resultado2 as $fila) {
					echo '
								<option value="'.$fila['idCiudades'].'">'.$fila['Ciudad'].'</option>
					';				
				}
				echo '
							</select>
						</div>
						<div class="col-md-12 col-sm-12 contenedorText">
							<button type="button" class="contratacion col-md-12">ENVIAR SOLICITUD</button>
						</div>
					</form>
				';
			}else{

			}

		}else{
			echo '<h2>No Existen Imagenes Actualmente</h2>';
		}
		$conn=NULL;		
	}catch(PDOException $e){
		echo "ERROR: ".$e->getMessage();
		exit();
	}
?>