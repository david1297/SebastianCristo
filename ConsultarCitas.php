<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
  require_once ("config/conexion.php");

$Numero='';
$Fecha='';
$Hora='';
$Descripcion='';
$Direccion='';
$Nombre_Completo='';
$Nombre='';
$Estado='';


$query=mysqli_query($con, "select Citas.Numero,Citas.Fecha,Citas.Hora,Citas.Descripcion,Citas.Direccion,
Usuarios.Nombre_Completo,Clientes.Nombre,Citas.Estado

from Citas 
inner join Usuarios on Usuarios.Identificacion = Citas.Usuario 
inner join Clientes on Clientes.Documento = Citas.Cliente
order by Citas.Fecha asc
"); 
?>
<!DOCTYPE html>
<html lang="es">
  <?php
    include('Head.php')
  ?>
  <body id="page-top">
    <div id="wrapper">
      <?php
        include('Menu.php');
      ?>
      <div class="container-fluid">


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" style='float: left !important;'>Citas</h6>
        <div class="btn-group" style='float: right !important;'>
		    <button type="button" class="btn btn-danger" onclick="NuevaCita()">
				<span class="fas fa-user-tie"></span> Nueva Cita
			</button>
		</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Usuario</th>
            <th>Cliente</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tfoot>
        
        <tr>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Usuario</th>
            <th>Cliente</th>
            <th>Estado</th>
          </tr>
     
        
        </tfoot>
        <tbody>
            <?php
             while($rw_Admin=mysqli_fetch_array($query)){
                $Numero=$rw_Admin['Numero'];
                $Fecha=$rw_Admin['Fecha'];
                $Hora=$rw_Admin['Hora'];
                $Usuario=$rw_Admin['Nombre_Completo'];
                $Cliente=$rw_Admin['Nombre'];
                $Estado=$rw_Admin['Estado'];
               
                ?>
               
                <tr style="cursor:pointer;" onclick='EditarCita("<?php echo  $Numero;?>")'>
                      <td><?php echo  $Numero;?></td>
                      <td><?php echo  $Fecha;?></td>
                      <td><?php echo  $Hora;?></td>
                      <td><?php echo  $Usuario;?></td>
                      <td><?php echo  $Cliente;?></td>
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

</div>


      <?php
        include('Footer.php');
      ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
<script>
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
function EditarCita(Numero){
    location.href='Citas.php?Numero='+Numero;
}
function NuevaCita(){
    location.href='Citas.php';
}
</script>
</body>

</html>
