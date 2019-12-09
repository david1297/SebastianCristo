<?php	
	session_start();

            require_once ("../../config/db.php");
			require_once ("../../config/conexion.php");
			

			$Id = mysqli_real_escape_string($con,(strip_tags($_GET["Id"],ENT_QUOTES)));

           

				
               
				
				$sql =  "DELETE FROM CotizacionDT Where Id = $Id";
				$query_update = mysqli_query($con,$sql);
				if ($query_update) {
					$messages[] = "Los Datos Se Han Guardado Con Exito.";
				   
				} else {
					$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
				}
                
?>