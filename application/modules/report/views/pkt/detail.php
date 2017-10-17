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
            <div class="judul"><h3>DAFTAR NOMINATIF PEGAWAI BERDASARKAN PANGKAT <br><?= $head; ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
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
		<?php if($record): ?>
			<?php $i = 1; ?>
			<?php foreach($record as $row): ?>
			<tr>
			<td><?php echo number_format($i); ?></td>
			<td class="text"><?php echo nama($row->nip); ?></td>
			<td class="text"><?php echo $row->nip; ?></td>
			<td><?php echo pangkat_akhir($row->nip) ? gol(pangkat_akhir($row->nip)->gol) : '-'; ?></td>
			<td class="text"><?php echo ddmmyyyy($row->tmtgol); ?></td>
			<td><?php echo jabatan_akhir($row->nip) ? jabatan_akhir($row->nip)->jabatan : '-'; ?></td>
			<td><?php echo eselon($row->eselon); ?></td>
			<td class="text"><?php echo ddmmyyyy($row->tmtjab); ?></td>
			<td><?php echo jabatan_akhir($row->nip) ? jabatan_akhir($row->nip)->unker : '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo ktpu_akhir($row->nip) ? ktpu_akhir($row->nip)->jurusan : '-'; ?></td>
			<td class="text"><?php echo ktpu_akhir($row->nip) ? ktpu_akhir($row->nip)->tahun : '-'; ?></td>
			<td><?php echo ktpu_akhir($row->nip) ? ktpu(ktpu_akhir($row->nip)->ktpu) : '-'; ?></td>
			<td><?php echo age($row->tglahir); ?></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
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
$(function () {
e = $("#tableID").tableExport({
        bootstrap: true,
        formats: ["xlsx","txt"],
        position: "top",
        fileName: "DAFTAR NOMINATIF PANGKAT-<?php echo $head; ?>",
    });
});
</script>
</body>
</html>