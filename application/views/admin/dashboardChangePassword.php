<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Change Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" href="<?php echo base_url()."/public/images/fav1.png" ?>" sizes="16x16" type="image/png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style=" background-image: linear-gradient(to bottom right, #FF8000, yellow);">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Change</b>Password</a>
    </div>
    <!-- /.login-logo -->
  <?php
  if (!empty($this->session->flashdata('a_error'))) {
      echo "<div class='alert alert-danger' id='error'>".$this->session->flashdata('a_error')."</div>";
    }
 if (!empty($this->session->flashdata('old_pass_error'))) {
      echo "<div class='alert alert-danger' id='error'>".$this->session->flashdata('old_pass_error')."</div>";
    }
    
    ?>

    <div class="card">
      <div class="card-body login-card-body bg-light">
        <p class="login-box-msg">Change your password</p>

        <form action="<?php echo base_url().'admin_change_password/'.$this->session->userData('adminID') ?>" method="post">
        <div class="input-group mb-3">
            <input type="password" name="oldpassword"
              class="form-control <?php echo (form_error('oldpassword') != '')? 'is-invalid' : ''; ?>"
              placeholder="OLD Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password"
              class="form-control <?php echo (form_error('password') != '')? 'is-invalid' : ''; ?>"
              placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>


          <div class="input-group mb-3">
            <input type="password" name="confirmpassword"
              class="form-control  <?php echo (form_error('confirmpassword') != '')? 'is-invalid' : ''; ?>"
              placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
              <a href="<?php echo base_url().'dashboard'; ?>" class="btn btn-primary btn-block">Go Back</a>
            </div>

            <div class="col-md-6">
              <button type="submit" id="changeBtn" class="btn btn-primary btn-block">Change Password</button>
            </div>
            <!-- /.col -->
          </div>
           <p class="mb-3 mt-4">
          <a href="<?php echo base_url().'forgot_password'; ?>" class="text-uppercase">forgot
            password</a>
        </p>
        </form>

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

</body>

</html>