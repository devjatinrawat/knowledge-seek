<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="icon" href="<?php echo base_url()."/public/images/fav1.png" ?>" sizes="16x16" type="image/png">
  <link rel="stylesheet" href="<?php echo base_url()?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>public/admin/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style=" background-image: linear-gradient(to bottom right, #FF8000, yellow);">


  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Admin</b>Login</a>
    </div>
    <?php
  if (!empty($this->session->flashdata('pass_error'))) {
      echo "<div class='alert alert-danger' id='error'>".$this->session->flashdata('pass_error')."</div>";
    }
    if (!empty($this->session->flashdata('name_error'))) {
     echo "<div class='alert alert-danger' id='error1'>".$this->session->flashdata('name_error')."</div>";
    }
        if (!empty($this->session->flashdata('passVerfication'))) {
     echo "<div class='alert alert-success' id='error1'>".$this->session->flashdata('passVerfication')."</div>";
    }
      if (!empty($this->session->flashdata('tokenVerfication'))) {
     echo "<div class='alert alert-success' id='error1'>".$this->session->flashdata('tokenVerfication')."</div>";
    }
    ?>

    <!-- /.login-logo -->
    <div class="card login-card bg-light">

      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?php echo base_url().'admin/admin_login/index'; ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" id="name" name="username"
              class="form-control <?php echo (form_error('username') != '')? 'is-invalid': ''; ?>"
              placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>

              </div>
            </div>

          </div>

          <div class="input-group mb-3">
            <input type="password" id="pass" name="password"
              class="form-control <?php echo (form_error('password') != '')? 'is-invalid': ''; ?>"
              placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="check">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-danger btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-3 mt-4">
          <a href="<?php echo base_url().'forgot_password'; ?>" class="text-uppercase">forgot
            password</a>
        </p>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url()?>public/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url()?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()?>public/admin/dist/js/adminlte.min.js"></script>
  <?php
if(get_cookie('admin_username') && get_cookie('admin_password')){
$username = get_cookie('admin_username');
$password = get_cookie('admin_password');

?>
  <script>
    $('document').ready(function () {
      $('#name').val('<?php echo $username; ?>');
      $('#pass').val('<?php echo $password; ?>');
    });

  </script>
  <?php
}
?>
  <!-- <script>
$('document').ready(function(){
  $('#error').fadeOut('slow');
  $('#error1').fadeOut('slow');
});
</script> -->

</body>

</html>