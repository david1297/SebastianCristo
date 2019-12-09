<?php	
	session_start();

            require_once ("../../config/db.php");
			require_once ("../../config/conexion.php");
			

			$Codigo = mysqli_real_escape_string($con,(strip_tags($_GET["Codigo"],ENT_QUOTES)));
			$Cliente = mysqli_real_escape_string($con,(strip_tags($_GET["Cliente"],ENT_QUOTES)));
			$Numero = mysqli_real_escape_string($con,(strip_tags($_GET["Numero"],ENT_QUOTES)));
			$Precio = mysqli_real_escape_string($con,(strip_tags($_GET["Precio"],ENT_QUOTES)));

           

				
               
				
				$sql =  "INSERT INTO  CotizacionDT(Cliente,Cotizacion,Producto,Valor) VALUES

				('$Cliente', '$Numero', '$Codigo', $Precio);";
				$query_update = mysqli_query($con,$sql);
				if ($query_update) {
					$messages[] = "Los Datos Se Han Guardado Con Exito.";
				   
				} else {
					$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
				}
                
?>