<?php	
	session_start();
if (empty($_POST['Documento'])){
	$errors[] = "Documento";
} elseif (empty($_POST['Tipo_Documento'])){
	$errors[] = "Tipo_Documento";
}elseif (empty($_POST['Tipo_Persona'])){
	$errors[] = "Tipo_Persona";
}elseif (empty($_POST['Nombre'])){
	$errors[] = "Nombre";
}elseif (empty($_POST['Telefono'])){
	$errors[] = "Telefono";
}elseif (empty($_POST['Direccion'])){
	$errors[] = "Direccion";
}elseif (empty($_POST['Correo'])){
	$errors[] = "Correo";
}elseif (empty($_POST['Estado'])){
	$errors[] = "Estado";
}elseif (empty($_POST['Ciudad'])){
	$errors[] = "Ciudad";
}elseif (
			!empty($_POST['Documento'])
			&& !empty($_POST['Tipo_Documento'])
			&& !empty($_POST['Tipo_Persona'])
			&& !empty($_POST['Nombre'])
			&& !empty($_POST['Telefono'])
			&& !empty($_POST['Direccion'])
			&& !empty($_POST['Correo'])
			&& !empty($_POST['Estado'])
			&& !empty($_POST['Ciudad'])
          )
         {
            require_once ("../../config/db.php");
            require_once ("../../config/conexion.php");
            
				$Documento = mysqli_real_escape_string($con,(strip_tags($_POST["Documento"],ENT_QUOTES)));
				$Tipo_Documento = mysqli_real_escape_string($con,(strip_tags($_POST["Tipo_Documento"],ENT_QUOTES)));
				$Tipo_Persona = mysqli_real_escape_string($con,(strip_tags($_POST["Tipo_Persona"],ENT_QUOTES)));
				$Nombre = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre"],ENT_QUOTES)));
				$Telefono = mysqli_real_escape_string($con,(strip_tags($_POST["Telefono"],ENT_QUOTES)));
				$Direccion = mysqli_real_escape_string($con,(strip_tags($_POST["Direccion"],ENT_QUOTES)));
				$Correo = mysqli_real_escape_string($con,(strip_tags($_POST["Correo"],ENT_QUOTES)));
				$Estado = mysqli_real_escape_string($con,(strip_tags($_POST["Estado"],ENT_QUOTES)));
				$Ciudad = mysqli_real_escape_string($con,(strip_tags($_POST["Ciudad"],ENT_QUOTES)));
				$FechaCreacion = mysqli_real_escape_string($con,(strip_tags($_POST["FechaCreacion"],ENT_QUOTES)));
                
               
				
               
				
				$sql =  "INSERT INTO  Clientes(Documento,Tipo_Documento,Tipo_Persona,Nombre,Telefono,Correo,FechaCreacion,Estado,Ciudad,Direccion) VALUES

				('".$Documento."', '".$Tipo_Documento."', '".$Tipo_Persona."', '".$Nombre."', '".$Telefono."','".$Correo."',
				 '".$FechaCreacion."','".$Estado."',".$Ciudad.",'".$Direccion."'
				) ON DUPLICATE  KEY UPDATE
				Tipo_Documento = '".$Tipo_Documento."',Tipo_Persona ='".$Tipo_Persona."',Nombre='".$Nombre."',Telefono='".$Telefono."'
				,Correo='".$Correo."'
				,FechaCreacion='".$FechaCreacion."',Estado='".$Estado."',Ciudad='".$Ciudad."',Direccion='".$Direccion."';";

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