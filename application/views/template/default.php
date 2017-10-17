<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= isset($title) ? $title : 'SIMPEG KALSEL'; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/tableexport/dist/css/tableexport.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/datepicker/datepicker3.css'); ?>" />
	<link rel="stylesheet" href="<?= base_url('asset/plugins/select2/select2.min.css'); ?>" />
  <link rel="stylesheet" href="<?= base_url('asset/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/skins/_all-skins.min.css'); ?>">
	<script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?= base_url('asset/plugins/pace/themes/blue/pace-theme-loading-bar.css'); ?>" />
  <?= isset($style) ? $this->load->view($style) : ''; ?>
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<style>body{font-size: 12px;}.nav-tabs-custom>.nav-tabs>li.active {border-top-color: #00a65a !important;}@media(min-width: 1024px){.main-header{top:0;left: 0;position: fixed;right: 0;z-index: 999;}.content-wrapper{padding-top:50px; padding-bottom:50px;}}.print{font-size: 9px;}.main-footer{bottom:0;left: 0;position: fixed;right: 0;z-index: 999;}.has-error .select2-selection {border: 1px solid #a94442;border-radius: 0px;}</style>
	
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b>SIM</b>PEG</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li><a href="<?= site_url('data/pegawai'); ?>"><i class="fa fa-book"></i> Data Pokok</a></li>
						<li><a href="<?= site_url('lapkin'); ?>"><i class="fa fa-cloud-upload"></i> E-Lapkin</a></li>
						<li><a href="<?= site_url('sotk'); ?>"><i class="fa fa-sitemap"></i> SOTK</a></li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i> Data Referensi <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('referensi/agama'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Agama</a></li>
								<li><a href="<?= site_url('referensi/pekerjaan'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Pekerjaan</a></li>
								<li><a href="<?= site_url('referensi/profesi'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Profesi</a></li>
								<li><a href="<?= site_url('referensi/ktpu'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Tingkat Pendidikan</a></li>
								<li><a href="<?= site_url('referensi/organisasi'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Jenis Organisasi</a></li>
								<li><a href="<?= site_url('referensi/diklat'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Diklat Struktural</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('referensi/instansi'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Instansi</a></li>
								<li><a href="<?= site_url('referensi/unker'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Unit Kerja</a></li>
								<li><a href="<?= site_url('referensi/satker'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Satuan Kerja</a></li>
								<li><a href="<?= site_url('referensi/eselon'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Tingkat Jabatan</a></li>
								<li><a href="<?= site_url('referensi/jabatan'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Jabatan</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('referensi/kedudukan'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Kedudukan Pegawai</a></li>
								<li><a href="<?= site_url('referensi/status'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Status Pegawai</a></li>
								<li><a href="<?= site_url('referensi/jenis'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Jenis Pegawai</a></li>
								<li><a href="<?= site_url('referensi/pangkat'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Golongan Pegawai</a></li>
              </ul>
            </li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-print"></i> Laporan <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('report/pangkat'); ?>" target="_BLANK"><i class="fa fa-file-text-o"></i> Laporan Nominatif Pangkat</a></li>
                <li><a href="<?= site_url('report/pkt'); ?>"><i class="fa fa-file-text-o"></i> Laporan Nominatif Pangkat SOPD</a></li>
								<li><a href="<?= site_url('report/jabatan'); ?>" target="_BLANK"><i class="fa fa-file-text-o"></i> Laporan Nominatif Tingkat Jabatan</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('report/peta'); ?>"><i class="fa fa-file-text-o"></i> Laporan Pemetaan</a></li>
								<li><a href="<?= site_url('report/analisa'); ?>"><i class="fa fa-file-text-o"></i> Laporan Analisa Jabatan</a></li>
                <li class="divider"></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Daftar Jaga Pangkat</a></li>
								<li><a href="<?= site_url('report/pensiun'); ?>"><i class="fa fa-file-text-o"></i> Daftar Jaga Pensiun</a></li>
								<li class="divider"></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Rekapitulasi Agama</a></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Rekapitulasi Pendidikan</a></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Rekapitulasi Golongan</a></li>
								<li><a href="#"><i class="fa fa-file-text-o"></i> Rekapitulasi Status</a></li>
              </ul>
            </li>
						<li><a href="#"><i class="fa fa-ticket"></i> Tiket Layanan</a></li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i> Pengaturan <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('setting/user'); ?>"><i class="fa fa-users"></i> Pengguna</a></li>
								<li><a href="<?= site_url('setting/folder'); ?>"><i class="fa fa-folder"></i> Manajeman File</a></li>
								<li><a href="<?= site_url('setting/informasi'); ?>"><i class="fa fa-file-text-o"></i> Manajemen Informasi</a></li>
								
								<li><a href="<?= site_url('setting/log'); ?>"><i class="fa fa-tasks"></i> Log Pengguna</a></li>
								<li><a href="<?= site_url('setting/backup'); ?>"><i class="fa fa-database"></i> Backup Database</a></li>
              </ul>
						</li>
						<li><a href="<?= site_url('logout'); ?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
						<!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('asset/dist/img/avatar5.png'); ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $this->session->userdata('username'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?= base_url('asset/dist/img/avatar5.png'); ?>" class="img-circle" alt="User Image">
								  <p>
                    Login Simpeg
                    <small>Versi 3.0 2017</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= site_url('setting/password/updated/'.$this->session->userdata('userID')); ?>" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ganti Password</a>
                  </div>
									<div class="pull-right">
                    <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>SIMPEG KALSEL<small>Beta 3.0</small></h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?= isset($content) ? $this->load->view($content) : ''; ?>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> Beta 3.0
      </div>
      <strong>Copyright &copy; 2016-2017 <a href="#">Badan Kepegawaian Daerah Provinsi Kalimantan Selatan</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/fastclick/fastclick.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/extensions/Responsive/js/responsive.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/js-xlsx/xlsx.core.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/Blob.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/FileSaver.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/dist/js/tableexport.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('asset/app.js'); ?>"></script>
<?= isset($js) ? $this->load->view($js) : ''; ?>

</body>
</html>
