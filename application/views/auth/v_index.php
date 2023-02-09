<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?= base_url() ?>assets/img/logo/logo.png" rel="icon">
  <title><?= $title ?></title>
  <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>assets/css/ruang-admin.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/toastr/toastr.min.css" rel="stylesheet">
  <style>
    @media (min-width:576px) {
      #box-login {
        margin-left: 100px !important;
        margin-right: 100px !important;
      }
    }
  </style>
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login py-5">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div id="box-login" class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Sistem Inventaris & Kasir | <span class="text-info">SIVENKA</span></h1>
                  </div>
                  <hr>
                  <form class="user" method="POST" action="./auth/login">
                    <div class="form-group">
                      <label for="inputUsername">Username</label>
                      <input name="username" type="text" class="form-control" id="inputUsername" aria-describedby="usernameHelp"
                      placeholder="Input username" required autofocus>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword">Password</label>
                      <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Input password" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <hr>
                  </form>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url() ?>assets/js/ruang-admin.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/toastr/toastr.min.js"></script>
  <script>
  <?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
  <?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
  <?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
  <?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
  <?php } ?>
</script>
</body>

</html>