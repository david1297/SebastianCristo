<?php	
	session_start();
if (empty($_POST['Tipo_Documento'])){
	$errors[] = "Falta Definir el Tipo de Documento";
} elseif (empty($_POST['Identificacion'])){
	$errors[] = "Falta Definir el Numero de Identificacion";
}elseif (empty($_POST['Primer_Nombre'])){
	$errors[] = "Primer_Nombre";
}elseif (empty($_POST['Primer_Apellido'])){
	$errors[] = "Primer_Apellido";
}elseif (empty($_POST['Telefono'])){
	$errors[] = "Telefono";
}elseif (empty($_POST['Direccion'])){
	$errors[] = "Direccion";
}elseif (empty($_POST['Celular'])){
	$errors[] = "Celular";
}elseif (
			!empty($_POST['Tipo_Documento'])
			&& !empty($_POST['Identificacion'])
			&& !empty($_POST['Primer_Nombre'])
			&& !empty($_POST['Primer_Apellido'])
			&& !empty($_POST['Telefono'])
			&& !empty($_POST['Direccion'])
			&& !empty($_POST['Celular'])
          )
         {
            require_once ("../../config/db.php");
            require_once ("../../config/conexion.php");
            
				$Tipo_Documento = mysqli_real_escape_string($con,(strip_tags($_POST["Tipo_Documento"],ENT_QUOTES)));
				$Identificacion = mysqli_real_escape_string($con,(strip_tags($_POST["Identificacion"],ENT_QUOTES)));
				$Primer_Nombre = mysqli_real_escape_string($con,(strip_tags($_POST["Primer_Nombre"],ENT_QUOTES)));
				$Segundo_Nombre = mysqli_real_escape_string($con,(strip_tags($_POST["Segundo_Nombre"],ENT_QUOTES)));
				$Primer_Apellido = mysqli_real_escape_string($con,(strip_tags($_POST["Primer_Apellido"],ENT_QUOTES)));
				$Segundo_Apellido = mysqli_real_escape_string($con,(strip_tags($_POST["Segundo_Apellido"],ENT_QUOTES)));
				$Telefono = mysqli_real_escape_string($con,(strip_tags($_POST["Telefono"],ENT_QUOTES)));
				$Direccion = mysqli_real_escape_string($con,(strip_tags($_POST["Direccion"],ENT_QUOTES)));
				$Celular = mysqli_real_escape_string($con,(strip_tags(@$_POST["Celular"],ENT_QUOTES)));
                
                $Nombre_Completo = $Primer_Nombre;
                if($Segundo_Nombre !=''){
                    $Nombre_Completo = $Nombre_Completo.' '.$Segundo_Nombre;
                }
                $Nombre_Completo = $Nombre_Completo.' '.$Primer_Apellido;
                if($Segundo_Apellido !=''){
                    $Nombre_Completo = $Nombre_Completo.' '.$Segundo_Apellido;
                }
				
                $sql =  "UPDATE Usuarios Set Tipo_Documento='$Tipo_Documento',Primer_Nombre='$Primer_Nombre',Segundo_Nombre='$Segundo_Nombre',
                Primer_Apellido='$Primer_Apellido',Segundo_Apellido='$Segundo_Apellido',Telefono='$Telefono',Direccion='$Direccion',
                Celular='$Celular' where Identificacion = '$Identificacion' ";
                    $query_update = mysqli_query($con,$sql);
                    if ($query_update) {
                        $messages[] = "Los Datos Se Han Modificado Con Exito.";
                        if ($_SESSION['Identificacion']==$Identificacion){

                            $_SESSION['Nombre_Completo']= $Nombre_Completo;
                        }
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