<div class="row">
	<div class="col-md-12">
		<?php if($this->session->flashdata('flashconfirm')): ?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-check"></i> Sukses! <?php echo $this->session->flashdata('flashconfirm'); ?>.
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('flasherror')): ?>
		<div class="alert alert-info alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-info"></i> Perhatian! <?php echo $this->session->flashdata('flasherror'); ?>.
		</div>
		<?php endif; ?>
		<div class="box box-success box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<p>Selamat datang pada simpeg versi Beta 3.0</p>
						<p>Ini merupakan versi pengembangan dimana pada semester 4 terdapat modul pengembangan laporan kinerja per skpd, pembaharuan keamanan login dan permission, desain sistem untuk di pergunakan seluruh ASN di lingkungan provinsi kalimantan selatan, desain API untuk keperluan pengembangan aplikasi pihak instansi lain di luar Badan Kepegawaian Daerah Provinsi Kalimantan Selatan yang menggunakan data kepegawaian SIMPEG.</p>
						<p>IT Data dan Informasi</p>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			
			<div class="box-footer">
				<div class="row">
					<div class="col-md-12">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>