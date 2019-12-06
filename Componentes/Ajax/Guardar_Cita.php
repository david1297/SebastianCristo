<?php	
	session_start();
if (empty($_POST['Fecha'])){
	$errors[] = "Fecha";
}elseif (empty($_POST['FechaCreacion'])){
	$errors[] = "FechaCreacion";
}elseif (empty($_POST['Hora'])){
	$errors[] = "Hora";
}elseif (empty($_POST['Cliente'])){
	$errors[] = "Cliente";
}elseif (empty($_POST['Usuario'])){
	$errors[] = "Usuario";
}elseif (empty($_POST['Descripcion'])){
	$errors[] = "Descripcion";
}elseif (empty($_POST['Direccion'])){
	$errors[] = "Direccion";
}elseif (empty($_POST['Estado'])){
	$errors[] = "Estado";
}elseif (empty($_POST['Asignado'])){
	$errors[] = "Asignado";
}elseif (
			!empty($_POST['Fecha'])
			&& !empty($_POST['FechaCreacion'])
			&& !empty($_POST['Hora'])
			&& !empty($_POST['Cliente'])
			&& !empty($_POST['Usuario'])
			&& !empty($_POST['Descripcion'])
			&& !empty($_POST['Direccion'])
			&& !empty($_POST['Estado'])
			&& !empty($_POST['Asignado'])
          )
         {
            require_once ("../../config/db.php");
            require_once ("../../config/conexion.php");
            
				$Fecha = mysqli_real_escape_string($con,(strip_tags($_POST["Fecha"],ENT_QUOTES)));
				$FechaCreacion = mysqli_real_escape_string($con,(strip_tags($_POST["FechaCreacion"],ENT_QUOTES)));
				$Hora = mysqli_real_escape_string($con,(strip_tags($_POST["Hora"],ENT_QUOTES)));
				$Cliente = mysqli_real_escape_string($con,(strip_tags($_POST["Cliente"],ENT_QUOTES)));
				$Usuario = mysqli_real_escape_string($con,(strip_tags($_POST["Usuario"],ENT_QUOTES)));
				$Descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["Descripcion"],ENT_QUOTES)));
				$Respuesta = mysqli_real_escape_string($con,(strip_tags($_POST["Respuesta"],ENT_QUOTES)));
				$Direccion = mysqli_real_escape_string($con,(strip_tags($_POST["Direccion"],ENT_QUOTES)));
				$Estado = mysqli_real_escape_string($con,(strip_tags($_POST["Estado"],ENT_QUOTES)));
				$Asignado = mysqli_real_escape_string($con,(strip_tags($_POST["Asignado"],ENT_QUOTES)));
                
				if (isset($_POST['Numero'])) {
					$Numero = mysqli_real_escape_string($con,(strip_tags($_POST["Numero"],ENT_QUOTES)));	
					if ($Numero<>''){
						$NumeroCita = $Numero;	
					}else{
						$sql=mysqli_query($con, "select LAST_INSERT_ID(Numero) as last from Citas order by Numero desc limit 0,1 ");
						$rw=mysqli_fetch_array($sql);
						$NumeroCita=$rw['last']+1;
					}
				}

				
               
				
				$sql =  "INSERT INTO  Citas(Numero,Fecha,Hora,Cliente,Usuario,Descripcion,Direccion,Estado,FechaCreacion,Respuesta,Asignado) VALUES

				('$NumeroCita', '".$Fecha."', '".$Hora."', '".$Cliente."', '".$Usuario."','".$Descripcion."',
				 '".$Direccion."','".$Estado."','".$FechaCreacion."','".$Respuesta."','$Asignado'
				) ON DUPLICATE  KEY UPDATE
				Fecha = '".$Fecha."',Hora ='".$Hora."',Cliente='".$Cliente."',Usuario='".$Usuario."'
				,Descripcion='".$Descripcion."'
				,Direccion='".$Direccion."',Estado='".$Estado."',FechaCreacion='".$FechaCreacion."',Respuesta='".$Respuesta."',Asignado='$Asignado';";

                    $query_update = mysqli_query($con,$sql);
                    if ($query_update) {
                        $messages[] = "Los Datos Se Han Modificado Con Exito.";
                       
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
                    }
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
		if (isset($errors)){
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error! </strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho! </strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>