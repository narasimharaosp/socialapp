<?php
//echo base_url();exit;
$theme_path = base_url().'assets/sba2/';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Social App - Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?= $theme_path; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= $theme_path; ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-7 col-lg-6 col-md-4">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                  </div>
                  <?php
                    if(!empty($this->session->userdata('msg'))){ 
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show"><?=$this->session->userdata('msg');?>
                    </div>
                  <?php } ?> 
                  <form id="register" class="user" method="POST" action="<?= base_url('user/createaccount') ?>">
                    <div class="form-group row">
                      <div class="col-sm-12 mb-3 mb-sm-0">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName" placeholder="Name" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" required>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-2">
                        Gender
                      </div>
                      <div class="col-md-6">
                          <div class="form-check float-left">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="0" name="gender">Male
                            </label>
                          </div>
                          <div class="form-check float-left ml-4">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="1" name="gender">Female
                            </label>
                          </div>
                      </div>
                    </div>
                    <input type="hidden" name="lat" id="lat" />
                    <input type="hidden" name="long" id="long" />

                    <div class="form-group">
                      <input type="number" name="age" min="0" class="form-control form-control-user" id="age" placeholder="Age" required>
                    </div>
                    <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block">
                    <!-- <hr> -->
                    <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                      Register Account
                    </a>
                    <hr> -->
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                    </a> -->
                  </form>
                  <hr>
                  <!-- <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> -->
                  <div class="text-center">
                    <a class="small" href="<?= base_url('user/login'); ?>">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="<?= $theme_path; ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= $theme_path; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= $theme_path; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= $theme_path; ?>js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        // console.log(position);
        $("#lat").val(position.coords.latitude);
        $("#long").val(position.coords.longitude);
      });
    }
  </script>

</body>

</html>
