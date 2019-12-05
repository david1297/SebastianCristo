<?php
require_once("config/db.php");
require_once("classes/Login.php");
require_once ("config/conexion.php");
$login = new Login();
if ($login->isUserLoggedIn() == true) {
   header("location: index.php");

} else {
    ?>
<!DOCTYPE html>
<html lang="es">
<?php
    include('Head.php')
  ?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido</h1>
                  </div>
                  <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="user">
                  <?php
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                  <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="user_name" value="juandavid.andrade1997@gmail.com" aria-describedby="emailHelp" placeholder="Correo Electronico">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="user_password" value="123456" placeholder="Contraseña">
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login" id="submit">INICIAR SESIÓN</button>
                    <hr>
                   
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
}
?>