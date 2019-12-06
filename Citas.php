<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
	require_once ("config/conexion.php");
$Numero='';
$Fecha=date("Y-m-d");
$FechaCreacion=date("Y-m-d");
$Hora='09:00:00';
$Cliente='';
$Usuario=$_SESSION['Identificacion'];
$Descripcion=''; 
$Respuesta=''; 
$Direccion ='';
$Estado='';
$Nombre_Completo=$_SESSION['Nombre_Completo'];
$Nombre='';

$Programada='';
$Cancelada='';
$Realizada='';

if (isset($_GET['Numero'])) {


    $query=mysqli_query($con, "select Citas.Respuesta,Citas.Numero,Citas.Fecha,Citas.FechaCreacion,Citas.Hora,Citas.Cliente,Citas.Usuario,Citas.Descripcion,Citas.Direccion,
    Citas.Estado,Usuarios.Nombre_Completo,Clientes.Nombre from Citas 
    inner join Usuarios on Usuarios.Identificacion = Citas.Usuario
    inner join Clientes on Clientes.Documento = Citas.Cliente
    where Citas.Numero ='".$_GET['Numero']."' ");
        $rw_Admin=mysqli_fetch_array($query);
    
        
        $Numero=$rw_Admin['Numero'];
        $Fecha=$rw_Admin['Fecha'];
        $FechaCreacion=$rw_Admin['FechaCreacion'];
        $Hora=$rw_Admin['Hora'];
        $Cliente=$rw_Admin['Cliente'];
        $Usuario=$rw_Admin['Usuario'];
        $Descripcion=$rw_Admin['Descripcion']; 
        $Respuesta=$rw_Admin['Respuesta'];  
        $Direccion =$rw_Admin['Direccion'];
        $Estado=$rw_Admin['Estado'];
        $Nombre_Completo=$rw_Admin['Nombre_Completo'];
        $Nombre=$rw_Admin['Nombre'];
     
        if($Estado =='Programada'){
            $Programada='selected';
        }else{
          if($Estado =='Cancelada'){
            $Cancelada='selected';
          }else{
            if($Estado =='Realizada'){
              $Realizada='selected';
            }
          }
        }
        
       
        $EstadoC="Editando";
    $Read= "readonly='readonly'";
    $Cita="Cita N: ".$Numero;

}else{
  $Procesos='disabled';
    $EstadoC="Nuevo";
    $Read= "";
    $Cita="Nueva Cita";
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
              <h5 class="modal-title" id="exampleModalLabel">¿Preparado para irte?</h5>
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
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
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
                            $Documento=$rw_Admin['Documento'];
                            $Nombre=$rw_Admin['Nombre'];
                            $Telefono=$rw_Admin['Telefono'];
                            $Correo=$rw_Admin['Correo'];
                            $Direccion=$rw_Admin['Direccion'];
                            $Correo=$rw_Admin['Correo'];
                            $Ciudad=$rw_Admin['Ciudad'];
                            ?>
                          
                            <tr style="cursor:pointer;" onclick='CargarCliente("<?php echo  $Documento;?>")'>
                                  <td><?php echo  $Documento;?></td>
                                  <td><?php echo  $Nombre;?></td>
                                  <td><?php echo  $Telefono;?></td>
                                  <td><?php echo  $Correo;?></td>
                                  <td><?php echo  $Ciudad;?></td>
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
                    <h2 class="m-0 font-weight-bold text-primary align-middle" style='float: left !important;vertical-align: middle !important;'><?php echo $Cita; ?></h2>
                    <div class="btn-group" style='float: right !important;'>
                        <button type="button" class="btn btn-danger" onclick="location.href='ConsultarCitas.php';">
                        <i class="far fa-calendar-alt"></i> Consultar Citas
                        </button>
                    </div>
                </div>
                <div class="card-body">               
                  <form   id="Guardar_Cita" name="Guardar_Cita" class="form-horizontal col-sm-12" method="post">
                        <input type="text" class="form-control " hidden id="EstadoC" name="EstadoC"  value="<?php echo $EstadoC; ?>" >
                        <input type="text" class="form-control " hidden id="Numero" name="Numero"  value="<?php echo $Numero; ?>" >
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Documento" class="control-label">Fecha de Creacion</label>  
                            <input type="Date" class="form-control" id="FechaCreacion" name="FechaCreacion" value="<?php echo $FechaCreacion?>"readonly>
                          </div>
                          <div class="col-sm-2 ">
                            <label for="Documento" class="control-label">Fecha de Cita</label>  
                            <input type="Date" class="form-control" id="Fecha" name="Fecha" value="<?php echo $Fecha?>">
                          </div>
                          <div class="col-sm-2 ">
                            <label for="Documento" class="control-label">Hora de Cita</label>  
                            <input type="time" class="form-control" id="Hora" name="Hora" value="<?php echo $Hora?>">
                          </div>
                          <div class="col-sm-2 ">
                            <label for="Documento" class="control-label">Cliente</label>  
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder="Cliente" name="NCliente" id="NCliente" value="<?php echo $Nombre?>">
                              <input hidden type="text" class="form-control" placeholder="Cliente" name="Cliente" id="Cliente" value="<?php echo $Cliente?>">
                              <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="modal" data-target="#BuscarCliente">
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
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-sm-2 offset-sm-1">
                            <label for="Direccion" class="control-label">Direccion</label>
                            <input  type="text" class="form-control form-control-user"  id="Direccion" name="Direccion" required placeholder="Direccion" value="<?php echo $Direccion; ?>" autocomplete='off'>
                          </div>
                          <div class="col-sm-2">
                            <label for="Estado" class="control-label">Estado</label>
                            <select name="Estado" id="Estado" class='form-control form-control-user'>
                              <option value="Programada" <?php echo $Programada;?>>Programada</option>
                              <option value="Cancelada"<?php echo $Cancelada;?>>Cancelada</option>
                              <option value="Realizada"<?php echo $Realizada;?>>Realizada</option>
                            </select>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-md-10 offset-sm-1">
  										      <label for="Descripcion">Descripcion:</label>
  										      <textarea class="form-control" rows="5" id="Descripcion" name="Descripcion"><?php echo $Descripcion;?></textarea>
									        </div>
                        </div>
                        <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
                          <div class="col-md-10 offset-sm-1">
  										      <label for="Respuesta">Respuesta:</label>
  										      <textarea class="form-control" rows="5" id="Respuesta" name="Respuesta"><?php echo $Respuesta;?></textarea>
									        </div>
                        </div>
                       
                        
                        
                        
                        <div class="" id="Resultado"></div>
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
    $('#TablaCotizaciones').DataTable();
    $('#TablaIncidencias').DataTable();
    $('#TablaVentas').DataTable();

    
} );
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
function Cargar() {
			CargarCiudades();
		}
$( "#Guardar_Cita" ).submit(function( event ) {
 		var parametros = $(this).serialize();
	 	$.ajax({
			type: "POST",
			url: "Componentes/Ajax/Guardar_Cita.php",
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
