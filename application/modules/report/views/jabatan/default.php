<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DAFTAR NOMINATIF PEGAWAI KALSEL</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			body {
				margin: 0;
				padding: 0;
				background-color: #fff;
				font: 7px "tahoma";
			}
			
			*{
				box-sizing: border-box;
				-moz-box-sizing: border-box;
			}
			
			.page {
				width: 100%;
				/* min-height: 21cm; */
				padding: 0.2cm;
				margin: 0.2cm auto;
				border: 1px #cfcfcf solid;
				background: white;
				box-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
			}

			.logo{
				/* float: left; */
			}
			
			.title{
				text-align: center;
				margin-bottom: 20px;
			}

			.judul{
				padding-top: 10px;
			}
			
			.title h2, .title h3, .title p{
				margin: 0;
				padding: 0;
				text-transform: uppercase;
				margin-bottom: 10px;
			}

			@page {
				size: A4 landscape;
			}
			
			@media print {
				.page {
					margin: 0;
					border: initial;
					border-radius: initial;
					width: initial;
					min-height: initial;
					box-shadow: initial;
					background: initial;
					padding: 0.2cm;
					margin: 0.2cm auto;
					page-break-after: always;
				}
				
				table { page-break-inside:avoid }
				tr    { page-break-inside:avoid; page-break-after:auto }
				thead { display:table-header-group;  -webkit-print-color-adjust: exact;  }
				tfoot { display:table-footer-group }
			}
			
			h2{
				margin: 0px;
				padding-top : 10px;
				padding-bottom: 5px; 
			}
			
			table.print {
				border: 1px solid black;
				width: 100%;
			}
			
			table.print th{
				background-color: #000;
				color: white;
				text-align: center;
			}
			
			table.print tr td{
				text-align: left;
				vertical-align: top;
			}
		</style>
	</head>
<body>
<div class="book">
    <div class="page">
	<div class="title">
            <div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
            <div class="judul"><h3>DAFTAR NOMINATIF PEGAWAI BERDASARKAN TINGKAT JABATAN <br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
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
			<td><?php echo $i; ?></td>
			<td><?php echo nama($row->nip); ?></td>
			<td><?php echo $row->nip; ?></td>
			<td><?php echo pangkat_akhir($row->nip)->gol ? pkt(pangkat_akhir($row->nip)->gol) : '-'; ?></td>
			<td><?php echo ddmmyyyy($row->tmtgol); ?></td>
			<td><?php echo jabatan_akhir($row->nip)->jabatan ? jabatan_akhir($row->nip)->jabatan : '-'; ?></td>
			<td><?php echo eselon($row->eselon); ?></td>
			<td><?php echo ddmmyyyy($row->tmtjab); ?></td>
			<td><?php echo jabatan_akhir($row->nip)->unker ? jabatan_akhir($row->nip)->unker : '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo '-'; ?></td>
			<td><?php echo ktpu_akhir($row->nip)->jurusan ? ktpu_akhir($row->nip)->jurusan : '-'; ?></td>
			<td><?php echo ktpu_akhir($row->nip)->tahun ? ktpu_akhir($row->nip)->tahun : '-'; ?></td>
			<td><?php echo ktpu_akhir($row->nip)->ktpu ? ktpu(ktpu_akhir($row->nip)->ktpu) : '-'; ?></td>
			<td><?php echo age($row->tglahir); ?></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>
	<p><?php echo '<img src="'.site_url('report/jabatan/barcode/0123456789').'">'; ?></p>
</div>
</div>
</body>
</html>