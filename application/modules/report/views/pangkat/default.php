<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DAFTAR NOMINATIF PEGAWAI KALSEL</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?= base_url('asset/dist/css/print_fullpage.css'); ?>" />
		<link rel="stylesheet" href="<?= base_url('asset/plugins/tableexport/dist/css/tableexport.min.css'); ?>">
  		<link rel="stylesheet" href="<?= base_url('asset/plugins/pace/themes/blue/pace-theme-loading-bar.css'); ?>" />
	</head>
<body>
<div class="book">
    <div class="page">
	<div class="title">
            <div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
            <div class="judul"><h3>DAFTAR NOMINATIF PEGAWAI BERDASARKAN PANGKAT <br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
    </div>
	<!-- identitas -->
	<div class="tabel">
		<table class="print" id="tableID">
		<thead>
		<tr>
			<th rowspan="2">URUT</th>
			<th rowspan="2">NAMA LENGKAP</th>
			<th rowspan="2">NIP</th>
			<th colspan="2">PANGKAT</th>
			<th colspan="4">JABATAN</th>
			<th rowspan="2">MASA<br>KERJA<br>GOL</th>
			<th colspan="3">LATIHAN JABATAN</th>
			<th colspan="3">PENDIDIKAN</th>
			<th rowspan="2">USIA</th>
		</tr>
		<tr>
			<th>GOL<br>RUANG</th>
			<th>TMT</th>
			<th>NAMA</th>
			<th>ESELON</th>
			<th>TMT<br>JABATAN</th>
			<th>UNKER</th>
			<th>NAMA</th>
			<th>THN</th>
			<th>JAM</th>
			<th>NAMA</th>
			<th>TAHUN<br>LULUS</th>
			<th>TINGKAT<br>IZASAH</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="17"><div id="message"></div></th>
			</tr>
		</tbody>
		
	</table>
</div>
	<p><?php //echo '<img src="'.site_url('report/pangkat/barcode/0123456789').'">'; ?></p>
</div>
</div>
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/js-xlsx/xlsx.core.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/Blob.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/FileSaver.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/dist/js/tableexport.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ajaxStart(function() { Pace.restart(); });

$(function () {
	//Pace.start
	$.ajax({
		type: "GET",
		async: false,
		url : "<?php echo site_url('report/pangkat/get_data')?>",
		data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
		success: function(result) {
			//Pace.stop
			$('#tableID').html(result);
			$("#tableID").tableExport({
				bootstrap: true,
				formats: ["xlsx","txt"],
				position: "top",
				fileName: "DAFTAR NOMINATIF BERDASARKAN PANGKAT-<?php echo date('dmyyyy'); ?>",
			});
		},
		error: function(errorMsg) {
			//Pace.stop
			$('#message').text('Error Dalam Melakukan Load Data Harap Coba Kembali.');
		}
	});
});
</script>
</body>
</html>