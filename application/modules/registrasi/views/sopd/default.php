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
  
    <?= form_open_multipart('registrasi/sopd/daftar'); ?>
      <div class="form-group <?php echo form_error('nip') ? 'has-error' : 'has-feedback'; ?>">
        <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?= set_value('nip'); ?>">
        <span class="fa fa-id-card form-control-feedback"></span>
        <?= form_error('nip') ? form_error('nip', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('nama') ? 'has-error' : 'has-feedback'; ?>">
        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
        <span class="fa fa-user form-control-feedback"></span>
        <?= form_error('nama') ? form_error('nama', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('username') ? 'has-error' : 'has-feedback'; ?>">
        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
        <span class="fa fa-tag form-control-feedback"></span>
        <?= form_error('username') ? form_error('username', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('email') ? 'has-error' : 'has-feedback'; ?>">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
        <span class="fa fa-envelope form-control-feedback"></span>
        <?= form_error('email') ? form_error('email', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('telpon') ? 'has-error' : 'has-feedback'; ?>">
        <input type="text" class="form-control" name="telpon" placeholder="Telpon/Handphone" value="<?= set_value('telpon'); ?>">
        <span class="fa fa-phone form-control-feedback"></span>
        <?= form_error('telpon') ? form_error('telpon', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('password') ? 'has-error' : 'has-feedback'; ?>">
        <input type="password" class="form-control" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
        <span class="fa fa-lock form-control-feedback"></span>
        <?= form_error('password') ? form_error('password', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('repassword') ? 'has-error' : 'has-feedback'; ?>">
        <input type="password" class="form-control" name="repassword" placeholder="Ulangi Password" value="<?= set_value('repassword'); ?>">
        <span class="fa fa-lock form-control-feedback"></span>
        <?= form_error('repassword') ? form_error('repassword', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('unker') ? 'has-error' : 'has-feedback'; ?>">
        <?php 
          $selected = set_value('unker');
          echo form_dropdown('unker', $unker, $selected, "class='form-control select2' name='unker' id='unker'");
        ?>
        <span class="form-control-feedback"></span>
        <?= form_error('unker') ? form_error('unker', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('satker') ? 'has-error' : 'has-feedback'; ?>">
        <?php 
          $selected = set_value('satker');
          echo form_dropdown('satker', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker' id='satker'");
        ?>
        <span class="form-control-feedback"></span>
        <?= form_error('satker') ? form_error('satker', '<p class="help-block">','</p>') : ''; ?>
      </div>
      <div class="form-group  <?php echo form_error('file') ? 'has-error' : 'has-feedback'; ?>">
        <input type="file" class="form-control" name="file" id="file" placeholder="Dokumen Penunjukan Petugas" value="<?= set_value('file'); ?>">
        <span class="fa fa-file form-control-feedback"></span>
        <?= form_error('file') ? form_error('file', '<p class="help-block">','</p>') : '<span style="font-size:11px;">Dokumen Penunjukan. PDF|JPG|PNG. Max 2 MB</span>'; ?>
      </div>
      <p><?php echo $img; ?></p>
      <div class="form-group  <?php echo form_error('security_code') ? 'has-error' : 'has-feedback'; ?>">
        <input type="security_code" class="form-control" name="security_code" id="security_code" placeholder="Masukan Kode Diatas" value="">
        <span class="fa fa-lock form-control-feedback"></span>
        <?= form_error('security_code') ? form_error('security_code', '<p class="help-block">','</p>') : ''; ?>
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
          <button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-file-text"></i> REGISTRASI</button>
        </div>
        <div class="col-xs-6">
          <a href="<?= site_url('registrasi/sopd/reset_password'); ?>" class="btn btn-danger btn-block btn-flat"><i class="fa fa-unlock"></i> MINTA PASSWORD</a>
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
