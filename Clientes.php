<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
	require_once ("config/conexion.php");
$Documento='';
$Tipo_Documento='';
$Tipo_Persona='';
$Nombre='';
$Telefono='';
$Correo=''; 
$FechaCreacion =date("Y-m-d");
$Estado='';
$Ciudad='';
$Direccion='';
$Departamento='';
$Activo='';
$InActivo='';
$Natural='';
$Juridica='';
$Cedula='';
        $Pasaporte='';
        $Nit='';
        $Extrangera='';
if (isset($_GET['Documento'])) {


    $query=mysqli_query($con, "select Clientes.Documento,Clientes.Tipo_Documento,Clientes.Tipo_Persona,Clientes.Nombre,Clientes.Telefono,
    Clientes.Correo,Clientes.FechaCreacion,Clientes.Estado,Clientes.Ciudad,Clientes.Direccion,Ciudades.Departamento from Clientes 
    inner join Ciudades on Clientes.Ciudad = Ciudades.Codigo
    where Documento ='".$_GET['Documento']."' ");
        $rw_Admin=mysqli_fetch_array($query);
    
        $Documento=$rw_Admin['Documento'];
        $Tipo_Documento=$rw_Admin['Tipo_Documento'];
        $Tipo_Persona=$rw_Admin['Tipo_Persona'];
        $Nombre=$rw_Admin['Nombre'];
        $Telefono=$rw_Admin['Telefono'];
        $Correo=$rw_Admin['Correo'];
        $FechaCreacion=$rw_Admin['FechaCreacion'];
        $Estado=$rw_Admin['Estado'];
        $Ciudad=$rw_Admin['Ciudad'];
        $Direccion=$rw_Admin['Direccion'];
        $Departamento=$rw_Admin['Departamento'];
     
        $Cedula='';
        $Pasaporte='';
        $Nit='';
        $Extrangera='';
        if ($Tipo_Documento=='Cedula'){
          $Cedula = 'selected';
        }else{
          if ($Tipo_Documento=='Pasaporte'){
            $Pasaporte = 'selected';
          }else{
            if ($Tipo_Documento=='Nit'){
              $Nit = 'selected';
            }else{
              if ($Tipo_Documento=='Extrangera'){
                $Extrangera = 'selected';
              }
            }
          }
        }
        if($Estado =='Activo'){
            $Activo='selected';
        }else{
            $InActivo='selected';
        }
        if($Tipo_Persona='Natural'){
            $Natural='selected';
        }else{
            $Juridica='selected';
        }
        $EstadoC="Editando";
		$Read= "readonly='readonly'";

}else{
  $Procesos='disabled';
    $EstadoC="Nuevo";
    $Read= "";
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
      <div class="container-fluid">
        <div class="row" >
          <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary align-middle" style='float: left !important;vertical-align: middle !important;'>Clientes</h2>
                    <div class="btn-group" style='float: right !important;'>
                        <button type="button" class="btn btn-danger" onclick="location.href='ConsultarClientes.php';">
                            <span class="fas fa-user-tie"></span> Consultar Clientes
                        </button>
                    </div>
                </div>
                <div class="card-body"> 
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-Datos-tab" data-toggle="pill" href="#pills-Datos" role="tab" aria-controls="pills-Datos" aria-selected="true">Datos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php echo $Procesos;?>" id="pills-Procesos-tab" data-toggle="pill" href="#pills-Procesos" role="tab" aria-controls="pills-Procesos" aria-selected="false">Procesos</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Datos" role="tabpanel" aria-labelledby="pills-Datos-tab">
                      <form   id="Guardar_Cliente" name="Guardar_Cliente" class="form-horizontal col-sm-12" method="post">
                        <input type="text" class="form-control " hidden id="EstadoC" name="EstadoC"  value="<?php echo $EstadoC; ?>" >
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Documento" class="control-label">Fecha de Creacion</label>
                          </div>
                          <div class="col-sm-8">      
                            <input type="Date" class="form-control" id="FechaCreacion" name="FechaCreacion" value="<?php echo $FechaCreacion?>"readonly>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Tipo_Documento" class="control-label">Tipo de Documento</label>
                          </div>
                          <div class="col-sm-8">
                            <select name="Tipo_Documento" id="Tipo_Documento" class='form-control form-control-user'>
                              <option value="Cedula" <?php echo $Cedula;?>>Cedula de Ciudadania</option>
                              <option value="Pasaporte"<?php echo $Pasaporte;?>>Pasaporte</option>
                              <option value="Nit" <?php echo $Nit;?>>Nit</option>
                              <option value="Extrangera" <?php echo $Extrangera;?>>Cedula Extrangera</option>
                            </select>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Tipo_Persona" class="control-label">Tipo de Persona</label>
                          </div>
                          <div class="col-sm-8">
                            <select name="Tipo_Persona" id="Tipo_Persona" class='form-control form-control-user'>
                              <option value="Natural" <?php echo $Natural;?>>Natural</option>
                              <option value="Juridica"<?php echo $Juridica;?>>Juridica</option>
                            </select>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Documento" class="control-label">Numero de Documento</label>
                          </div>
                          <div class="col-sm-8">
                            <input  type="text" class="form-control form-control-user"  onkeypress='return validaNumericos(event)' id="Documento" name="Documento" required placeholder="Numero de Documento" value="<?php echo $Documento; ?>" autocomplete='off'>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Nombre" class="control-label">Nombre</label>
                          </div>
                          <div class="col-sm-8">
                            <input  type="text" class="form-control form-control-user"  id="Nombre" name="Nombre" required placeholder="Nombre " value="<?php echo $Nombre; ?>" autocomplete='off'>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Telefono" class="control-label">Telefono</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control form-control-user"  onkeypress='return validaNumericos(event)' id="Telefono" name="Telefono" required placeholder="Telefono" value="<?php echo $Telefono; ?>" autocomplete='off'>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Direccion" class="control-label">Direccion</label>
                          </div>
                          <div class="col-sm-8">
                            <input type="text" class="form-control form-control-user"   id="Direccion" name="Direccion" required placeholder="Direccion" value="<?php echo $Direccion; ?>" autocomplete='off'>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Correo" class="control-label">Correo</label>
                          </div>
                          <div class="col-sm-8">
                            <input  type="email" class="form-control form-control-user"   id="Correo" name="Correo" required placeholder="Correo" value="<?php echo $Correo; ?>" autocomplete='off'>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Tipo_Documento" class="control-label">Departamento</label>
                          </div>
                          <div class="col-sm-8">
                            <?PHP
                              $query1=mysqli_query($con, "select * from DEPARTAMENTOS order by Nombre");
                              echo' <select class="form-control" id="Departamento" name ="Departamento" placeholder="Departamento" onchange="CargarCiudades()">';
                              while($rw_Admin1=mysqli_fetch_array($query1)){
                                if ($Departamento ==$rw_Admin1['Codigo']){
                                  echo '<option value="'.$rw_Admin1['Codigo'].'" selected >'.utf8_encode($rw_Admin1['Nombre']).'</option>';
                                } else{
                                  echo '<option value="'.$rw_Admin1['Codigo'].'">'.utf8_encode($rw_Admin1['Nombre']).'</option>';	
                                }     
                              }
                              echo '</select>';
                            ?>	
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Tipo_Documento" class="control-label">Ciudad</label>
                          </div>
                          <div class="col-sm-8">
                            <input hidden type="Text" class="form-control " id="Ciu" name="Ciu" require value="<?php echo $Ciudad?>" readonly="readonly">
                            <div  id="Ciudades" ></div>
                          </div>
                        </div>     
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Estado" class="control-label">Estado</label>
                          </div>
                          <div class="col-sm-8">
                            <select name="Estado" id="Estado" class='form-control form-control-user'>
                              <option value="Activo" <?php echo $Activo;?>>Activo</option>
                              <option value="InActivo"<?php echo $InActivo;?>>InActivo</option>
                            </select>
                          </div>
                        </div>
                        <div class="" id="Resultado"></div>
                        <div class=" pull-right col-sm-8 offset-sm-1">
                          <button type="submit" class="btn btn-primary" >Guardar datos</button>			
                          <button type="button" class="btn btn-danger"  onclick='Cancelar()'>Cancelar</button>
                        </div>	
                      </form>
                    </div>
                    <div class="tab-pane fade" id="pills-Procesos" role="tabpanel" aria-labelledby="pills-Procesos-tab">
                      <div class="card mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary align-middle" style='float: left !important;vertical-align: middle !important;'>Cotizaciones</h6>
                          <div class="btn-group" style='float: right !important;'>
                            <button type="button" class="btn btn-danger" onclick="location.href='Cotizacion.php?Cliente=<?php echo $Documento;?>';">
                              <i class="fas fa-file"></i>  Nueva Cotizacion
                            </button>
                          </div>
                        </div>
                        <?php
                        $query=mysqli_query($con, "select Cotizacion.Numero,Cotizacion.Fecha,
                        Usuarios.Nombre_Completo,Clientes.Nombre,Cotizacion.Estado,Cotizacion.Total
                        
                        from Cotizacion 
                        inner join Usuarios on Usuarios.Identificacion = Cotizacion.Usuario
                        inner join Clientes on Clientes.Documento = Cotizacion.Cliente
                        where Cotizacion.Cliente='$Documento' 
                        order by Cotizacion.Fecha asc
                        "); 
                        ?>
                        <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover table-sm" id="TablaCotizaciones" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Numero</th>
                              <th>Fecha</th>
                              <th>Usuario</th>
                              <th>Cliente</th>
                              <th>Estado</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                              while($rw_Admin=mysqli_fetch_array($query)){
                                  $Numero=$rw_Admin['Numero'];
                                  $Fecha=$rw_Admin['Fecha'];
                                  $Total=$rw_Admin['Total'];
                                  $Usuario=$rw_Admin['Nombre_Completo'];
                                  $Cliente=$rw_Admin['Nombre'];
                                  $Estado=$rw_Admin['Estado'];
                                
                                  ?>
                                
                                  <tr style="cursor:pointer;" onclick='EditarCotizacion("<?php echo  $Numero;?>")'>
                                        <td><?php echo  $Numero;?></td>
                                        <td><?php echo  $Fecha;?></td>
                                        <td><?php echo  $Usuario;?></td>
                                        <td><?php echo  $Cliente;?></td>
                                        <td><?php echo  $Estado;?></td>
                                        <td>$<?php echo  number_format($Total);?></td>

                                      
                                      </tr>
                                
                                
                                  <?php
                                  }

                              
                              
                              ?>
                            
                          </tbody>
                          </table>
                        </div>
                              
                        </div>
                      </div>
                      <div class="card mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary align-middle" style='float: left !important;vertical-align: middle !important;'>Ventas</h6>
                          <div class="btn-group" style='float: right !important;'>
                            <button type="button" class="btn btn-danger" onclick="location.href='Ventas.php?Cliente=<?php echo $Documento;?>';">
                              <i class="fas fa-file"></i>  Nueva Venta
                            </button>
                          </div>
                        </div>
                        <?php
                        $query=mysqli_query($con, "select Ventas.Numero,Ventas.Fecha,
                        Usuarios.Nombre_Completo,Clientes.Nombre,Ventas.Estado,Ventas.Total
                        
                        from Ventas 
                        inner join Usuarios on Usuarios.Identificacion = Ventas.Usuario
                        inner join Clientes on Clientes.Documento = Ventas.Cliente
                        where Ventas.Cliente='$Documento' 
                        order by Ventas.Fecha asc
                        "); 
                        ?>
                        <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Numero</th>
                              <th>Fecha</th>
                              <th>Usuario</th>
                              <th>Cliente</th>
                              <th>Estado</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                              while($rw_Admin=mysqli_fetch_array($query)){
                                  $Numero=$rw_Admin['Numero'];
                                  $Fecha=$rw_Admin['Fecha'];
                                  $Total=$rw_Admin['Total'];
                                  $Usuario=$rw_Admin['Nombre_Completo'];
                                  $Cliente=$rw_Admin['Nombre'];
                                  $Estado=$rw_Admin['Estado'];
                                
                                  ?>
                                
                                  <tr style="cursor:pointer;" onclick='EditarVenta("<?php echo  $Numero;?>")'>
                                        <td><?php echo  $Numero;?></td>
                                        <td><?php echo  $Fecha;?></td>
                                        <td><?php echo  $Usuario;?></td>
                                        <td><?php echo  $Cliente;?></td>
                                        <td><?php echo  $Estado;?></td>
                                        <td>$<?php echo  number_format($Total);?></td>

                                      
                                      </tr>
                                
                                
                                  <?php
                                  }

                              
                              
                              ?>
                            
                          </tbody>
                        </table>
                        </div>
                              
                        </div>
                      </div>
                      <div class="card mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary align-middle" style='float: left !important;vertical-align: middle !important;'>Citas</h6>
                          <div class="btn-group" style='float: right !important;'>
                            <button type="button" class="btn btn-danger" onclick="location.href='Citas.php?Cliente=<?php echo $Documento;?>';">
                              <i class="fas fa-file"></i>  Nueva Cita
                            </button>
                          </div>
                        </div>
                        <?php 
                        $query=mysqli_query($con, "select Citas.Numero,Citas.Fecha,Citas.Hora,Citas.Descripcion,
                        Usuarios.Nombre_Completo,Citas.Estado
                        
                        from Citas 
                        inner join Usuarios on Usuarios.Identificacion = Citas.Asignado 
                        inner join Clientes on Clientes.Documento = Citas.Cliente
                        where Citas.Cliente = '$Documento'
                        order by Citas.Fecha,Citas.Hora  asc
                        "); 
                        ?>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-hover table-sm" id="TablaCitas" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Numero</th>
                                  <th>Fecha</th>
                                  <th>Hora</th>
                                  <th>Usuario</th>
                                  <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                while($rw_Admin=mysqli_fetch_array($query)){
                                    $Numero=$rw_Admin['Numero'];
                                    $Fecha=$rw_Admin['Fecha'];
                                    $Hora=$rw_Admin['Hora'];
                                    $Usuario=$rw_Admin['Nombre_Completo'];
                                 
                                    $Estado=$rw_Admin['Estado'];
                                  
                                    ?>
                                  
                                    <tr style="cursor:pointer;" onclick='EditarCita("<?php echo  $Numero;?>")'>
                                          <td><?php echo  $Numero;?></td>
                                          <td><?php echo  $Fecha;?></td>
                                          <td><?php echo  $Hora;?></td>
                                          <td><?php echo  $Usuario;?></td>
                               
                                          <td><?php echo  $Estado;?></td>
                                        </tr>
                                  
                                  
                                    <?php
                                    }

                                
                                
                                ?>
                              </tbody>
                            </table>  
                          </div>
                        </div>
                      </div>
                      <div class="card mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary align-middle" style='float: left !important;vertical-align: middle !important;'>Incidencias</h6>
                          <div class="btn-group" style='float: right !important;'>
                            <button type="button" class="btn btn-danger" onclick="location.href='Incidencia.php?Cliente=<?php echo $Documento;?>';">
                              <i class="fas fa-file"></i>  Nueva Incidencia
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-hover table-sm" id="TablaIncidencias" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Numero</th>
                                  <th>Fecha</th>
                                  <th>Usuario</th>
                                  <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr style="cursor:pointer;" onclick=''>
                                  <td>1</td>
                                  <td>01-01-2019</td>
                                  <td>Vendedor1</td>
                                  <td>Pendiente</td>
                                </tr>
                                   
                              </tbody>
                            </table>  
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>  
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
    $('#TablaCotizaciones').DataTable();
    $('#TablaIncidencias').DataTable();
    $('#TablaVentas').DataTable();
    $('#TablaCitas').DataTable();
    

    
} );
function EditarCita(Numero){
    location.href='Citas.php?Numero='+Numero;
}
function EditarVenta(Numero){
  location.href='Ventas.php?Numero='+Numero;
}
function EditarCotizacion(Numero){
  location.href='Cotizacion.php?Numero='+Numero;
}
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
function Cargar() {
			CargarCiudades();
		}
$( "#Guardar_Cliente" ).submit(function( event ) {
 		var parametros = $(this).serialize();
	 	$.ajax({
			type: "POST",
			url: "Componentes/Ajax/Guardar_Cliente.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#Resultado").html('<div class="col-sm-2 offset-sm-6 spinner-border text-danger text-center" role="status"><span class="sr-only">Loading...</span></div>');
			  },
			success: function(datos){
        $('#pills-Procesos-tab').removeClass('disabled');
			$("#Resultado").html(datos);
			
		  }
	});
  event.preventDefault();
})
function CargarCiudades(){
			var Depto = $("#Departamento").val();
			
			var Ciu = $("#Ciu").val();
			$.ajax({
				type: "POST",
				url: "Componentes/Ajax/Cargar_Ciudades.php",
				data: "Depto="+Depto+"&Ciu="+Ciu,
				beforeSend: function(objeto){
                    $("#Ciudades").html('<div class="col-sm-2 offset-sm-6 spinner-border text-danger text-center" role="status"><span class="sr-only">Loading...</span></div>');
				},success: function(datos){
					$("#Ciudades").html(datos);
				}	
			});
        }
function Cancelar(){
    var Estado=$('#EstadoC').val();
    if(Estado=='Nuevo'){
        location.href='ConsultarClientes.php';
    }else{
        location.reload();
    }
}
</script>
</body>

</html>
