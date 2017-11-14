<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrasi SIMPEG SOPD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/select2/select2.min.css'); ?>" />
  <link rel="stylesheet" href="<?= base_url('asset/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/iCheck/square/blue.css'); ?>">
  
  <?= isset($style) ? $this->load->view($style) : ''; ?>
	
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
    <a href="#">REGISTRASI SOPD<br><b>SIMPEG-</b>KALSEL</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"</p>
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
  
    <?= form_open('registrasi/sopd/send_password'); ?>
      <div class="form-group  <?php echo form_error('email') ? 'has-error' : 'has-feedback'; ?>">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
        <span class="fa fa-envelope form-control-feedback"></span>
        <?= form_error('email') ? form_error('email', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Ingatkan Saya
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-send"></i> KIRIM PASSWORD</button>
        </div>
		<div class="col-xs-6">
          <a href="<?= site_url('login'); ?>" class="btn btn-success btn-block btn-flat"><i class="fa fa-sign-in"></i> LOGIN</a>
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
<script src="<?= base_url('asset/plugins/select2/select2.full.min.js'); ?>"></script>
<?= isset($js) ? $this->load->view($js) : ''; ?>
</body>
</html>
