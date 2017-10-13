<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/iCheck/square/blue.css'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>SIMPEG</b>KALSEL</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Login Terlebih Dahulu.</p>
	<?php if($this->session->flashdata('flashconfirm')): ?>
	<div class="alert alert-success alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <?php echo $this->session->flashdata('flashconfirm'); ?>
	</div>
	<?php endif; ?>
	<?php if($this->session->flashdata('flasherror')): ?>
	<div class="alert alert-warning alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <?php echo $this->session->flashdata('flasherror'); ?>
	</div>
	<?php endif; ?>
  
    <?= form_open('auth/login'); ?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Ingatkan Saya
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> LOGIN</button>
        </div>
        <!-- /.col -->
      </div>
    <?= form_close(); ?>
    <a href="#"></a><br>
    <img src="<?= base_url('asset/dist/img/RapidSSL_SEAL-90x50.gif'); ?>">
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/iCheck/icheck.min.js'); ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
