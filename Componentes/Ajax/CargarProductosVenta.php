<?php	
	session_start();
  require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$Cliente = mysqli_real_escape_string($con,(strip_tags($_GET["Cliente"],ENT_QUOTES)));
	$Numero = mysqli_real_escape_string($con,(strip_tags($_GET["Numero"],ENT_QUOTES)));
?>
<div class="table-responsive">
  <table class="table table-hover" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <?php
			$sql="select VentasDT.Id,VentasDT.Producto,VentasDT.Valor,Productos.Nombre from VentasDT 
            inner join Productos on Productos.Codigo=VentasDT.Producto where VentasDT.Venta= $Numero and VentasDT.Cliente ='$Cliente' ";
      $query=mysqli_query($con,$sql); 
    ?>
    <tbody>
      <?php
        $Total=0;	
        while($rw_Admin=mysqli_fetch_array($query)){
          $Producto=$rw_Admin['Producto'];
          $PNombre=$rw_Admin['Nombre'];
          $Precio=$rw_Admin['Valor'];
          $Id=$rw_Admin['Id'];
          $Total = $Total +$Precio;
          ?>                          
          <tr style="cursor:pointer;" >
            <td><?php echo  $Producto;?></td>
            <td><?php echo  $PNombre;?></td>
            <td>$<?php echo  number_format($Precio);?></td>
            <td>
              <button class="btn btn-danger" type="button" onclick="EliminarProducto(<?php echo $Id;?>)"> <i class="far fa-trash-alt" ></i></button>
            </td>
          </tr>
          <?php
        }
      ?>
      <td></td>
      <td></td>
      <td>TOTAL:</td>
      <td>$<?php echo  number_format($Total);?></td>
    </tbody>
  </table>
</div>
                
