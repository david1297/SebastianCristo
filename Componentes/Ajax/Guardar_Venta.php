<?php	
	session_start();
if (empty($_POST['FechaCreacion'])){
	$errors[] = "FechaCreacion";
}elseif (empty($_POST['Cliente'])){
	$errors[] = "Cliente";
}elseif (empty($_POST['Usuario'])){
	$errors[] = "Usuario";
}elseif (empty($_POST['Estado'])){
	$errors[] = "Estado";
}elseif (empty($_POST['FechaCobro'])){
	$errors[] = "FechaCobro";
}elseif (
			!empty($_POST['FechaCreacion'])
			&& !empty($_POST['Cliente'])
			&& !empty($_POST['Usuario'])
			&& !empty($_POST['Estado'])
			&& !empty($_POST['FechaCobro'])
          )
         {
            require_once ("../../config/db.php");
            require_once ("../../config/conexion.php");
            
				$FechaCreacion = mysqli_real_escape_string($con,(strip_tags($_POST["FechaCreacion"],ENT_QUOTES)));
				$Cliente = mysqli_real_escape_string($con,(strip_tags($_POST["Cliente"],ENT_QUOTES)));
				$Usuario = mysqli_real_escape_string($con,(strip_tags($_POST["Usuario"],ENT_QUOTES)));
				$Estado = mysqli_real_escape_string($con,(strip_tags($_POST["Estado"],ENT_QUOTES)));
				$FechaCobro = mysqli_real_escape_string($con,(strip_tags($_POST["FechaCobro"],ENT_QUOTES)));
                
				if (isset($_POST['Numero'])) {
					$Numero = mysqli_real_escape_string($con,(strip_tags($_POST["Numero"],ENT_QUOTES)));	
					if ($Numero<>0){
						$NumeroVenta = $Numero;	
					}else{
						$sql=mysqli_query($con, "select LAST_INSERT_ID(Numero) as last from Ventas order by Numero desc limit 0,1 ");
						$rw=mysqli_fetch_array($sql);
						$NumeroVenta=$rw['last']+1;
					}
				}

				$query=mysqli_query($con, "select sum(VentasDT.Valor) Total
                from VentasDT 
				where VentasDT.Venta= $Numero and VentasDT.Cliente ='$Cliente' "); 
				
				$rw_Admin=mysqli_fetch_array($query);

				$Total=$rw_Admin['Total'];
				if($Total > 0){

					$sql =  "INSERT INTO  Ventas(Numero,Fecha,Cliente,Usuario,FechaCobro,Total,Estado) VALUES

					($NumeroVenta, '$FechaCreacion', '$Cliente', '$Usuario','$FechaCobro',$Total,'$Estado'
					) ON DUPLICATE  KEY UPDATE
					Fecha = '$FechaCreacion',Cliente='$Cliente',Usuario='$Usuario',FechaCobro='$FechaCobro'
					,Total=$Total
					,Estado='$Estado';";
	
						$query_update = mysqli_query($con,$sql);
						if ($query_update) {
							$sql =  "DELETE FROM VentasD Where Venta = $NumeroVenta";
							$query_update = mysqli_query($con,$sql);
							$sql="select * from VentasDT where VentasDT.Venta= $Numero and VentasDT.Cliente ='$Cliente' ";
							$query=mysqli_query($con, $sql); 
							
							while($rw_Admin=mysqli_fetch_array($query)){
								$Producto=$rw_Admin['Producto'];
								$Valor=$rw_Admin['Valor'];
								$sql1 =  "INSERT INTO  VentasD(Venta,Producto,Valor) VALUES ($NumeroVenta, '$Producto', $Valor)";
								$query1=mysqli_query($con, $sql1); 
							}
							$sql =  "DELETE FROM VentasDT Where  Venta= $Numero and Cliente ='$Cliente'";
							$query_update = mysqli_query($con,$sql);

							if (isset($_POST['Cotizacion'])) {
								$Cotizacion = mysqli_real_escape_string($con,(strip_tags($_POST["Cotizacion"],ENT_QUOTES)));	
								$sql =  "UPDATE Cotizacion  set Cruce=$NumeroVenta Where Numero = $Cotizacion";
								$query_update = mysqli_query($con,$sql);
							}

							$messages[] = "Los Datos Se Han Guardado Con Exito.";
						   
						} else {
							$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
						}
				}else{
					$errors[] = "El Total de Venta No Puede Ser 0";
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

				echo '*Correcto*'.$NumeroVenta.'*';
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