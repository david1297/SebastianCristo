<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
	require_once ("config/conexion.php");
$Identificacion='';
$Tipo_Documento='';
$Primer_Nombre='';
$Segundo_Nombre='';
$Primer_Apellido='';
$Segundo_Apellido=''; 
$Nombre_Completo='';
$Telefono='';
$Direccion='';
$Correo='';
$Celular='';
$Rol='';
$Estado='';

$query=mysqli_query($con, "select * from Usuarios 
inner join Roles on Roles.Numero = Usuarios.Rol
where Identificacion ='".$_SESSION['Identificacion']."' ");
    $rw_Admin=mysqli_fetch_array($query);

    $Identificacion=$rw_Admin['Identificacion'];
    $Tipo_Documento=$rw_Admin['Tipo_Documento'];
    $Primer_Nombre=$rw_Admin['Primer_Nombre'];
    $Segundo_Nombre=$rw_Admin['Segundo_Nombre'];
    $Primer_Apellido=$rw_Admin['Primer_Apellido'];
    $Segundo_Apellido=$rw_Admin['Segundo_Apellido'];
    $Nombre_Completo=$rw_Admin['Nombre_Completo'];
    $Telefono=$rw_Admin['Telefono'];
    $Direccion=$rw_Admin['Direccion'];
    $Correo=$rw_Admin['Correo'];
    $Celular=$rw_Admin['Celular'];
    $Rol=$rw_Admin['Tipo'];
    $Estado=$rw_Admin['Estado'];
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

<div class="row" >
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Perfil </h6>
      </div>
      <div class="card-body">
        <form   id="Actualizar_Perfil" name="Actualizar_Perfil" class="form-horizontal col-sm-12" method="post">
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
						  <label for="Identificacion" class="control-label">Identificacion</label>
					  </div>
            <div class="col-sm-8">
				  	  <input readonly='readonly' type="text" class="form-control form-control-user"  onkeypress='return validaNumericos(event)' id="Identificacion" name="Identificacion" required placeholder="Identificacion" value="<?php echo $Identificacion; ?>" autocomplete='off'>
					  </div>
          </div>
          <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
            <div class="col-sm-2 offset-sm-1">
						  <label for="Primer_Nombre" class="control-label">Nombres</label>
					  </div>
            <div class="col-sm-4">
				  	  <input type="text" class="form-control form-control-user"  id="Primer_Nombre" name="Primer_Nombre" required placeholder="Primer Nombre" value="<?php echo $Primer_Nombre; ?>" autocomplete='off'>
            </div>
            <div class="col-sm-4">
				  	  <input type="text" class="form-control form-control-user"  id="Segundo_Nombre" name="Segundo_Nombre"  placeholder="Segundo Nombre" value="<?php echo $Segundo_Nombre; ?>" autocomplete='off'>
					  </div>
          </div>
          <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
            <div class="col-sm-2 offset-sm-1">
						  <label for="Primer_Apellido" class="control-label">Apellidos</label>
					  </div>
            <div class="col-sm-4">
				  	  <input type="text" class="form-control form-control-user"  id="Primer_Apellido" name="Primer_Apellido" required placeholder="Primer Apellido" value="<?php echo $Primer_Apellido; ?>" autocomplete='off'>
            </div>
            <div class="col-sm-4">
				  	  <input type="text" class="form-control form-control-user"  id="Segundo_Apellido" name="Segundo_Apellido"  placeholder="Segundo Apellido" value="<?php echo $Segundo_Apellido; ?>" autocomplete='off'>
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
				  	  <input readonly='readonly' type="email" class="form-control form-control-user"   id="Correo" name="Correo" required placeholder="Correo" value="<?php echo $Correo; ?>" autocomplete='off'>
					  </div>
          </div>
          <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
            <div class="col-sm-2 offset-sm-1">
						  <label for="Celular" class="control-label">Celular</label>
					  </div>
            <div class="col-sm-8">
				  	  <input type="text" class="form-control form-control-user"  onkeypress='return validaNumericos(event)' id="Celular" name="Celular" required placeholder="Celular" value="<?php echo $Celular; ?>" autocomplete='off'>
					  </div>
          </div>
          <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
            <div class="col-sm-2 offset-sm-1">
						  <label for="Rol" class="control-label">Rol</label>
					  </div>
            <div class="col-sm-8">
				  	  <input readonly='readonly' type="text" class="form-control form-control-user" id="Rol" name="Rol" required placeholder="Rol" value="<?php echo $Rol; ?>" autocomplete='off'>
					  </div>
          </div>
          <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
            <div class="col-sm-2 offset-sm-1">
						  <label for="Estado" class="control-label">Estado</label>
					  </div>
            <div class="col-sm-8">
				  	  <input readonly='readonly' type="text" class="form-control form-control-user" id="Estado" name="Estado" required placeholder="Estado" value="<?php echo $Estado; ?>" autocomplete='off'>
					  </div>
          </div>
          <div class="" id="Resultado">
          
          </div>
          
          <div class=" pull-right col-sm-8 offset-sm-1">
            <button type="submit" class="btn btn-primary" >Guardar datos</button>			
            <button type="button" class="btn btn-danger" id="Cancelar">Cancelar</button>
          </div>	
        </form>
      </div>
    </div>
  </div>
  

  

</div>

</div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
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

<script>
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
$( "#Actualizar_Perfil" ).submit(function( event ) {
 		var parametros = $(this).serialize();
	 	$.ajax({
			type: "POST",
			url: "Componentes/Ajax/ActualizarPerfil.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#Resultado").html('<div class="col-sm-2 offset-sm-6 spinner-border text-danger text-center" role="status"><span class="sr-only">Loading...</span></div>');
			  },
			success: function(datos){
			$("#Resultado").html(datos);
			
		  }
	});
  event.preventDefault();
})
</script>
</body>

</html>
