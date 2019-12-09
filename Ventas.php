<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
	require_once ("config/conexion.php");
$Numero=0;
$Cotizacion=0;
$FechaCreacion=date("Y-m-d");
$Cliente='';
$Usuario=$_SESSION['Identificacion'];
$Descripcion=''; 
$Respuesta=''; 
$Estado='';
$Nombre_Completo=$_SESSION['Nombre_Completo'];
$FechaCobro="";
$Nombre='';
$Asignado='';
$Pendiente='';
$Cancelada='';
$Aprobada='';
$Total='0';

if (isset($_GET['Numero'])) {

    $query=mysqli_query($con, "select Ventas.Numero,Ventas.Fecha,Ventas.FechaCobro,
    Ventas.Cliente,Ventas.Usuario, Ventas.Total,
    Ventas.Estado,Usuarios.Nombre_Completo,Clientes.Nombre from Ventas 
    inner join Usuarios on Usuarios.Identificacion = Ventas.Usuario
    inner join Clientes on Clientes.Documento = Ventas.Cliente
    where Ventas.Numero =".$_GET['Numero']." ");
        $rw_Admin=mysqli_fetch_array($query);
    
        
        $Numero=$rw_Admin['Numero'];
        $Fecha=$rw_Admin['Fecha'];
        $Cliente=$rw_Admin['Cliente'];
        $Usuario=$rw_Admin['Usuario'];
        $Estado=$rw_Admin['Estado'];
        $Nombre_Completo=$rw_Admin['Nombre_Completo'];
        $Nombre=$rw_Admin['Nombre'];
        $FechaCobro=$rw_Admin['FechaCobro'];
  
        
     
        if($Estado =='Pendiente'){
            $Pendiente='selected';
        }else{
          if($Estado =='Cancelada'){
            $Cancelada='selected';
          }else{
            if($Estado =='Aprobada'){
              $Aprobada='selected';
            }
          }
        }
        $sql =  "DELETE FROM VentasDT Where  Venta= $Numero and Cliente ='$Cliente'";
              $query_update = mysqli_query($con,$sql);
              
        $sql="select * from VentasD where VentasD.Venta= $Numero  ";
							$query=mysqli_query($con, $sql); 
							while($rw_Admin=mysqli_fetch_array($query)){
								$Codigo=$rw_Admin['Producto'];
								$Precio=$rw_Admin['Valor'];
                $sql =  "INSERT INTO  VentasDT(Cliente,Venta,Producto,Valor) VALUES ('$Cliente', '$Numero', '$Codigo', $Precio);";
                $query_update = mysqli_query($con,$sql);
              }
              
              $query=mysqli_query($con, "select Numero from Cotizacion WHERE Cruce = $Numero");
                  $rw_Admin=mysqli_fetch_array($query);

                  $Cotizacion=$rw_Admin['Numero'];
                  if ($Cotizacion==''){
                    $Cotizacion=0;
                  }
        
       
        $EstadoC="Editando";
    $Read= "readonly='readonly'";
    $Venta="Venta N: ".$Numero;

}else{
  if (isset($_GET['Cotizacion'])) {
    $Cotizacion=$_GET['Cotizacion'];
    $sql="select Cotizacion.Numero,Cotizacion.Fecha,
    Cotizacion.Cliente,Cotizacion.Usuario, Cotizacion.Total,
    Cotizacion.Estado,Usuarios.Nombre_Completo,Clientes.Nombre from Cotizacion 
    inner join Usuarios on Usuarios.Identificacion = Cotizacion.Usuario
    inner join Clientes on Clientes.Documento = Cotizacion.Cliente
    where Cotizacion.Numero =".$_GET['Cotizacion']." ";

    $query=mysqli_query($con,$sql);
        $rw_Admin=mysqli_fetch_array($query);
    
        
        $Numero=0;
        $Fecha=$rw_Admin['Fecha'];
        $Cliente=$rw_Admin['Cliente'];
        $Usuario=$rw_Admin['Usuario'];
        $Estado=$rw_Admin['Estado'];
        $Nombre_Completo=$rw_Admin['Nombre_Completo'];
        $Nombre=$rw_Admin['Nombre'];
      
  
        
     
        if($Estado =='Pendiente'){
            $Pendiente='selected';
        }else{
          if($Estado =='Cancelada'){
            $Cancelada='selected';
          }else{
            if($Estado =='Aprobada'){
              $Aprobada='selected';
            }
          }
        }
        $sql =  "DELETE FROM VentasDT Where  Venta= $Numero and Cliente ='$Cliente'";
              $query_update = mysqli_query($con,$sql);
              
        $sql="select * from CotizacionD where CotizacionD.Cotizacion= $Cotizacion  ";
							$query=mysqli_query($con, $sql); 
							while($rw_Admin=mysqli_fetch_array($query)){
								$Codigo=$rw_Admin['Producto'];
								$Precio=$rw_Admin['Valor'];
                $sql =  "INSERT INTO  VentasDT(Cliente,Venta,Producto,Valor) VALUES ('$Cliente', '$Numero', '$Codigo', $Precio);";
                $query_update = mysqli_query($con,$sql);
							}
              $Procesos='disabled';
              $EstadoC="Nuevo";
              $Read= "";
              $Venta="Nueva Venta";

  }else{
    $Procesos='disabled';
    $EstadoC="Nuevo";
    $Read= "";
    $Venta="Nueva Venta";
    if (isset($_GET['Cliente'])) {
    
      $query=mysqli_query($con, "select  Documento,Nombre,Direccion from  Clientes
    where  Documento='".$_GET['Cliente']."' ");
        $rw_Admin=mysqli_fetch_array($query);
    
        $Cliente=$rw_Admin['Documento'];
        $Nombre=$rw_Admin['Nombre'];
        $Direccion=$rw_Admin['Direccion'];
    }

  } 


  
}

         
    
    
?>
<!DOCTYPE html>
<html lang="es">
  <?php
    include('Head.php')
  ?>
  <body id="page-top" onload="Cargar()">
    <div id="wrapper">
      <?php
        include('Menu.php');
      ?>
      <div class="modal fade" id="BuscarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog Modal-large" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Buscador</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <?php
                $query=mysqli_query($con, "select Clientes.Documento,Clientes.Nombre,Clientes.Telefono,
                Clientes.Correo,Ciudades.Nombre As Ciudad,Clientes.Direccion
                
                from Clientes inner join Ciudades on Ciudades.Codigo =Clientes.Ciudad where Clientes.Estado ='Activo' "); 

                ?>
                <div class="table-responsive">
                  <table class="table table-hover" id="BuscarClienteT" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Ciudad</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        while($rw_Admin=mysqli_fetch_array($query)){
                            $CDocumento=$rw_Admin['Documento'];
                            $CNombre=$rw_Admin['Nombre'];
                            $CTelefono=$rw_Admin['Telefono'];
                            $CCorreo=$rw_Admin['Correo'];
                            $CDireccion=$rw_Admin['Direccion'];
                            $CCorreo=$rw_Admin['Correo'];
                            $CCiudad=$rw_Admin['Ciudad'];
                            ?>
                          
                            <tr style="cursor:pointer;" onclick='CargarCliente("<?php echo  $CDocumento;?>","<?php echo  $CNombre;?>","<?php echo  $CDireccion;?>")'>
                                  <td><?php echo  $CDocumento;?></td>
                                  <td><?php echo  $CNombre;?></td>
                                  <td><?php echo  $CTelefono;?></td>
                                  <td><?php echo  $CCorreo;?></td>
                                  <td><?php echo  $CCiudad;?></td>
                                </tr>
                            <?php
                            }
                        ?>
                      
                    </tbody>
                  </table>
                </div>  
              </div>
              <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
      </div>
      <div class="modal fade" id="BuscarProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog Modal-large" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Buscador</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <?php
                $query=mysqli_query($con, "select Codigo,Nombre,Descripcion,Precio 
                
                from Productos "); 

                ?>
                <div class="table-responsive">
                  <table class="table table-hover" id="BuscarProductoT" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        while($rw_Admin=mysqli_fetch_array($query)){
                            $PCodigo=$rw_Admin['Codigo'];
                            $PNombre=$rw_Admin['Nombre'];
                            $PDescripcion=$rw_Admin['Descripcion'];
                            $Precio=$rw_Admin['Precio'];
                            
                            ?>
                          
                            <tr style="cursor:pointer;" onclick='AgregarProducto("<?php echo  $PCodigo;?>","<?php echo  $Precio;?>")'>
                                  <td><?php echo  $PCodigo;?></td>
                                  <td><?php echo  $PNombre;?></td>
                                  <td><?php echo  $PDescripcion;?></td>
                                  <td><?php echo  number_format($Precio);?></td>
                                </tr>
                            <?php
                            }
                        ?>
                      
                    </tbody>
                  </table>
                </div>  
              </div>
              <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
      </div>

      <div class="container-fluid">
        <div class="row" >
          <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary align-middle" id="LNumero"style='float: left !important;vertical-align: middle !important;'><?php echo $Venta; ?></h2>
                    <div class="btn-group" style='float: right !important;'>
                        <button type="button" class="btn btn-danger" onclick="location.href='ConsultarVentas.php';">
                        <i class="far fa-calendar-alt"></i> Consultar Ventas
                        </button>
                    </div>
                </div>
                <div class="card-body">               
                  <form   id="Guardar_Venta" name="Guardar_Venta" class="form-horizontal col-sm-12" method="post">
                        <input type="text" class="form-control " hidden id="EstadoC" name="EstadoC"  value="<?php echo $EstadoC; ?>" >
                        <input type="text" class="form-control " hidden id="Numero" name="Numero"  value="<?php echo $Numero; ?>" >
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Documento" class="control-label">Fecha de Creacion</label>  
                            <input type="Date" class="form-control" id="FechaCreacion" name="FechaCreacion" value="<?php echo $FechaCreacion?>"readonly>
                          </div>
                          <div class="col-sm-2 ">
                            <label for="Documento" class="control-label">Cliente</label>  
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder="Cliente" name="NCliente" id="NCliente" value="<?php echo $Nombre?>">
                              <input hidden type="text" class="form-control" placeholder="Cliente" name="Cliente" id="Cliente" value="<?php echo $Cliente?>">
                              <div class="input-group-append">
                                <button class="btn  btn-info" type="button" id="button-addon2" data-toggle="modal" data-target="#BuscarCliente">
                                <i class="fas fa-search"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2 ">
                            <label for="Usuario" class="control-label">Usuario</label>  
                            <input type="text" class="form-control" id="NUsuario" name="NUsuario" value="<?php echo $Nombre_Completo?>"readonly>
                            <input hidden type="text" class="form-control" id="Usuario" name="Usuario" value="<?php echo $Usuario?>" >
                          </div>
                          <div class="col-sm-2">
                            <label for="Estado" class="control-label">Estado</label>
                            <select name="Estado" id="Estado" class='form-control form-control-user'>
                              <option value="Pendiente" <?php echo $Pendiente;?>>Pendiente</option>
                              <option value="Cancelada"<?php echo $Cancelada;?>>Cancelada</option>
                              <option value="Aprobada"<?php echo $Aprobada;?>>Aprobada</option>
                            </select>
                          </div> 
                          <div class="col-sm-2">
                            <label for="Estado" class="control-label">Fecha de Cobro</label>
                            <select name="FechaCobro" id="FechaCobro" class='form-control form-control-user'>
                            <?php
                              for($i=1;$i<=5;$i++){
                                if($FechaCobro == $i){
                                  ?>                                
                                  <option value="<?php echo $i;?>" selected><?php echo $i;?></option>
                                  <?php
                                }else{
                                  ?>                                
                                  <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                  <?php
                                }

                                
                              }

                            ?>
                            </select>
                          </div>        
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Documento" class="control-label">Cotizacion</label>  
                            <input type="text" class="form-control" id="Cotizacion" name="Cotizacion" value="<?php echo $Cotizacion?>"readonly>
                          </div>
                        
                          
                                
                        </div>

                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-md-10 offset-sm-1">
                            <h2>Servicios: </h2>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-md-10 offset-sm-1">
                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#BuscarProductos">Agregar <i class="fas fa-plus-circle"></i></button>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-md-10 offset-sm-1">
                          <div id="Productos"></div>
                            
                          </div>
                        </div>
                      
                        <div class="" id="Resultado">
                          <?php
                          if (isset($_GET['Res'])) {
                            ?>
                            <div class="alert alert-success" role="alert">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>¡Bien hecho! </strong>
                              Los Datos Se Han Guardado Con Exito.
                            </div>
                            <?php
                          }  
                          ?>
                        </div>
                        <div class=" pull-right col-sm-8 offset-sm-1">
                          <button type="submit" class="btn btn-primary" >Guardar datos</button>			
                          <button type="button" class="btn btn-danger"  onclick='Cancelar()'>Cancelar</button>
                        </div>	
                      </form> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        include('Footer.php');
      ?>
    </div>
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

<script>
  $(document).ready( function () {
    $('#BuscarProductoT').DataTable();
    $('#BuscarClienteT').DataTable();

    
} );
function CargarCliente(Documento,Nombre,Direccion){
$('#Cliente').val(Documento);
$('#NCliente').val(Nombre);
$('#Direccion').val(Direccion); 
$('#BuscarCliente').modal("hide");

}
function CargarProductos(){
  var Cliente = $("#Cliente").val();
  var Numero = $("#Numero").val();
  $.ajax({
			type: "GET",
			url: "Componentes/Ajax/CargarProductosVenta.php?Cliente="+Cliente+"&Numero="+Numero,
			 beforeSend: function(objeto){
				$("#Productos").html('<div class="col-sm-2 offset-sm-6 spinner-border text-danger text-center" role="status"><span class="sr-only">Loading...</span></div>');
			  },
			success: function(datos){
				$("#Productos").html('');

				$("#Productos").html(datos);
       
		  }
	});

}
function AgregarProducto(Codigo,Precio){
  var Cliente = $('#Cliente').val();
  var Numero = $('#Numero').val();
  if (Numero ==''){
    Numero = 0;
  }
  if(Cliente==''){
    alert('Debes Seleccionar El Cliente');
  }else{
    $.ajax({
			type: "GET",
			url: "Componentes/Ajax/AgregarProductoVenta.php?Codigo="+Codigo+"&Cliente="+Cliente+"&Numero="+Numero+"&Precio="+Precio,
			 beforeSend: function(objeto){
				$("#Resultado").html('<div class="col-sm-2 offset-sm-6 spinner-border text-danger text-center" role="status"><span class="sr-only">Loading...</span></div>');
			  },
			success: function(datos){
        $('#BuscarProductos').modal("hide");
				$("#Resultado").html(datos);
        CargarProductos();
       
		  }
	});
  }
  
  event.preventDefault();
}
function EliminarProducto(Id){
  $.ajax({
			type: "GET",
			url: "Componentes/Ajax/EliminarProductoVenta.php?Id="+Id,
			 beforeSend: function(objeto){
				$("#Resultado").html('<div class="col-sm-2 offset-sm-6 spinner-border text-danger text-center" role="status"><span class="sr-only">Loading...</span></div>');
			  },
			success: function(datos){
        CargarProductos();
				$("#Resultado").html(datos);
       
		  }
	});
  event.preventDefault();

}
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
function Cargar() {
  CargarProductos();
		}
$( "#Guardar_Venta" ).submit(function( event ) {
 		var parametros = $(this).serialize();
	 	$.ajax({
			type: "POST",
			url: "Componentes/Ajax/Guardar_Venta.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#Resultado").html('<div class="col-sm-2 offset-sm-6 spinner-border text-danger text-center" role="status"><span class="sr-only">Loading...</span></div>');
			  },
			success: function(datos){
        $('#pills-Procesos-tab').removeClass('disabled');
			  $("#Resultado").html(datos);
        var Res = datos.split('*');
					if(Res[1]=='Correcto'){
						 $('#Numero').val(Res[2]);
             location.href='Ventas.php?Numero='+Res[2]+'&Res=Correcto';

						 $('#LNumero').html("Venta Numero: "+Res[2]);
						 $("#Resultado").html(Res[3]);
					}else{
						$("#Resultado").html(datos);
					}
		  }
	});
  event.preventDefault();
})
function Cancelar(){
    var Estado=$('#EstadoC').val();
    if(Estado=='Nuevo'){
        location.href='ConsultarCitas.php';
    }else{
        location.reload();
    }
}
</script>
</body>

</html>
