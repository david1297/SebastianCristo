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
}elseif (
			!empty($_POST['FechaCreacion'])
			&& !empty($_POST['Cliente'])
			&& !empty($_POST['Usuario'])
			&& !empty($_POST['Estado'])
	
          )
         {
            require_once ("../../config/db.php");
            require_once ("../../config/conexion.php");
            
				$FechaCreacion = mysqli_real_escape_string($con,(strip_tags($_POST["FechaCreacion"],ENT_QUOTES)));
				$Cliente = mysqli_real_escape_string($con,(strip_tags($_POST["Cliente"],ENT_QUOTES)));
				$Usuario = mysqli_real_escape_string($con,(strip_tags($_POST["Usuario"],ENT_QUOTES)));
				$Estado = mysqli_real_escape_string($con,(strip_tags($_POST["Estado"],ENT_QUOTES)));
				$Cruce = mysqli_real_escape_string($con,(strip_tags($_POST["Cruce"],ENT_QUOTES)));
                if ($Cruce==''){
					$Cruce=0;
				}
				if (isset($_POST['Numero'])) {
					$Numero = mysqli_real_escape_string($con,(strip_tags($_POST["Numero"],ENT_QUOTES)));	
					if ($Numero<>0){
						$NumeroCotizacion = $Numero;	
					}else{
						$sql=mysqli_query($con, "select LAST_INSERT_ID(Numero) as last from Cotizacion order by Numero desc limit 0,1 ");
						$rw=mysqli_fetch_array($sql);
						$NumeroCotizacion=$rw['last']+1;
					}
				}

				$query=mysqli_query($con, "select sum(CotizacionDT.Valor) Total
                from CotizacionDT 
				where CotizacionDT.Cotizacion= $Numero and CotizacionDT.Cliente ='$Cliente' "); 
				
				$rw_Admin=mysqli_fetch_array($query);

				$Total=$rw_Admin['Total'];
				if($Total > 0){

					$sql =  "INSERT INTO  Cotizacion(Numero,Fecha,Cliente,Usuario,Total,Estado,Cruce) VALUES

					($NumeroCotizacion, '$FechaCreacion', '$Cliente', '$Usuario',$Total,'$Estado',$Cruce
					) ON DUPLICATE  KEY UPDATE
					Fecha = '$FechaCreacion',Cliente='$Cliente',Usuario='$Usuario'
					,Total=$Total
					,Estado='$Estado',Cruce=$Cruce;";
	
						$query_update = mysqli_query($con,$sql);
						if ($query_update) {
							$sql =  "DELETE FROM CotizacionD Where Cotizacion = $NumeroCotizacion";
							$query_update = mysqli_query($con,$sql);
							$sql="select * from CotizacionDT where CotizacionDT.Cotizacion= $Numero and CotizacionDT.Cliente ='$Cliente' ";
							$query=mysqli_query($con, $sql); 
							
							while($rw_Admin=mysqli_fetch_array($query)){
								$Producto=$rw_Admin['Producto'];
								$Valor=$rw_Admin['Valor'];
								$sql1 =  "INSERT INTO  CotizacionD(Cotizacion,Producto,Valor) VALUES ($NumeroCotizacion, '$Producto', $Valor)";
								$query1=mysqli_query($con, $sql1); 
							}
							$sql =  "DELETE FROM CotizacionDT Where  Cotizacion= $Numero and Cliente ='$Cliente'";
							$query_update = mysqli_query($con,$sql);

							$messages[] = "Los Datos Se Han Guardado Con Exito.";
						   
						} else {
							$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
						}
				}else{
					$errors[] = "El Total de Cotizacion No Puede Ser 0";
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

				echo '*Correcto*'.$NumeroCotizacion.'*';
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