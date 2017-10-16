<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BIODATA PEGAWAI KALSEL</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			body {
				margin: 0;
				padding: 0;
				background-color: #fff;
				font: 8px "tahoma";
			}
			
			*{
				box-sizing: border-box;
				-moz-box-sizing: border-box;
			}
			
			.page {
				width: 21cm;
				min-height: 29.7cm;
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
				size: A4 portrait;
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
<body onload="window.print();">
<div class="book">
    <div class="page">
	<div class="title">
            <div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
            <div class="judul"><h3>PROFIL PEGAWAI <br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
    </div>
	<!-- identitas -->
	<div class="tabel">
	<table id="cpns" class="print" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th colspan="4">BIODATA</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="175px"> NIP</td>
				<td width="2px">:</td>
				<td><?= biodata($nip)->nip; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>NAMA LENGKAP</td>
				<td>:</td>
				<td><?= nama($nip); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>TEMPAT LAHIR</td>
				<td>:</td>
				<td><?= biodata($nip)->tmlahir; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>TANGGAL LAHIR</td>
				<td>:</td>
				<td><?= ddmmyyyy(biodata($nip)->tglahir); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>JENIS KELAMIN</td>
				<td>:</td>
				<td><?= sex(biodata($nip)->sex); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>AGAMA</td>
				<td>:</td>
				<td><?= agama(biodata($nip)->agama_id); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>GOLONGAN DARAH</td>
				<td>:</td>
				<td><?= biodata($nip)->darah; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>STATUS PERNIKAHAN</td>
				<td>:</td>
				<td><?= kawin(biodata($nip)->kawin); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>ALAMAT TINGGAL</td>
				<td>:</td>
				<td><?= biodata($nip)->alamat; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>TELPON</td>
				<td>:</td>
				<td><?= biodata($nip)->telpon; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>EMAIL</td>
				<td>:</td>
				<td><?= biodata($nip)->email; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>STATUS PEGAWAI</td>
				<td>:</td>
				<td><?= status(biodata($nip)->status_id); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>KEDUDUKAN PEGAWAI</td>
				<td>:</td>
				<td><?= kedudukan(biodata($nip)->kedudukan_id); ?></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<!-- cpns -->
	<h2>DATA CPNS</h2>
	<div class="tabel">
	<table id="cpns" class="print" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5px">NO</th>
				<th>SK CPNS</th>
				<th>TGL SK</th>
				<th>TMT</th>
				<th>GOLONGAN</th>
			</tr>
		</thead>
		<tbody>
			<?php if(cpns($nip)): ?>
			<?php $no = 1; ?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= cpns($nip)->sk.' ('.cpns($nip)->tglsk.')'; ?></td>
				<td><?= ddmmyyyy(cpns($nip)->tglsk); ?></td>
				<td><?= ddmmyyyy(cpns($nip)->tmt); ?></td>
				<td><?= gol(cpns($nip)->gol); ?></td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	</div>
	<!-- pns -->
	<h2>DATA PNS</h2>
	<div class="tabel">
	<table id="pns" class="print" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5px">NO</th>
				<th>SK PNS</th>
				<th>TGL SK</th>
				<th>TMT</th>
				<th>GOLONGAN</th>
			</tr>
		</thead>
		<tbody>
			<?php if(pns($nip)): ?>
			<?php $no = 1; ?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= pns($nip)->sk.' ('.pns($nip)->tglsk.')'; ?></td>
				<td><?= ddmmyyyy(pns($nip)->tglsk); ?></td>
				<td><?= ddmmyyyy(pns($nip)->tmt); ?></td>
				<td><?= gol(pns($nip)->gol); ?></td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	</div>
	<!-- pangkat -->
	<h2>RIWAYAT PANGKAT</h2>
	<div class="tabel">
	<table id="pangkat" class="print" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5px">NO</th>
				<th>GOLONGAN</th>
				<th>PANGKAT</th>
				<th>TMT</th>
				<th>NO.SK</th>
				<th>TGL.SK</th>
			</tr>
		</thead>
		<tbody>
			<?php if(pangkat($nip)): ?>
			<?php $no = 1; ?>
			<?php foreach(pangkat($nip) as $row): ?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= gol($row->gol); ?></td>
				<td><?= pkt($row->gol); ?></td>
				<td><?= ddmmyyyy($row->tmt); ?></td>
				<td><?= $row->sk; ?></td>
				<td><?= ddmmyyyy($row->tglsk); ?></td>
			</tr>
			<?php $no++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	</div>
	<!-- jabatan -->
	<h2>RIWAYAT JABATAN</h2>
	<div class="tabel">
	<table class="print" id="jabatan" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5px">NO</th>
				<th>JABATAN</th>
				<th>TMT</th>
				<th>SATKER</th>
				<th>UNKER</th>
				<th>INSTANSI</th>
			</tr>
		</thead>
		<tbody>
			<?php if(jabatan($nip)): ?>
			<?php $no = 1; ?>
			<?php foreach(jabatan($nip) as $row): ?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $row->jabatan; ?></td>
				<td><?= ddmmyyyy($row->tmt); ?></td>
				<td><?= $row->satker; ?></td>
				<td><?= $row->unker; ?></td>
				<td><?= $row->instansi; ?></td>
			</tr>
			<?php $no++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	</div>
	<!-- pendidikan -->
	<h2>RIWAYAT PENDIDIKAN</h2>
	<div class="tabel">
	<table class="print" id="pendidikan" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5px">NO</th>
				<th>PENDIDIKAN</th>
				<th>KTPU</th>
				<th>LULUS</th>
				<th>TEMPAT</th>
				<th>LOKASI</th>
			</tr>
		</thead>
		<tbody>
			<?php if(pendidikan($nip)): ?>
			<?php $no = 1; ?>
			<?php foreach(pendidikan($nip) as $row): ?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $row->jurusan; ?></td>
				<td><?= ktpu($row->ktpu); ?></td>
				<td><?= $row->tahun; ?></td>
				<td><?= $row->sekolah; ?></td>
				<td><?= $row->tempat; ?></td>
			</tr>
			<?php $no++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	</div>
	<!-- diklat -->
	<h2>RIWAYAT DIKLAT</h2>
	<div class="tabel">
	<table class="print" id="diklat" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5px">NO</th>
				<th>DIKLAT</th>
				<th>JENIS</th>
				<th>TANGGAL</th>
				<th>TEMPAT</th>
				<th>PELAKSANA</th>
			</tr>
		</thead>
		<tbody>
			<?php if(diklat($nip)): ?>
			<?php $no = 1; ?>
			<?php foreach(diklat($nip) as $row): ?>
			<?php
				switch($row->jenis){
					case '01':
						$jenis = 'STRUKTURAL';
						break;
					case '02':
						$jenis = 'FUNGSIONAL';
						break;
					default:
						$jenis = 'TEKNIS';
				}
			?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $row->diklat; ?></td>
				<td><?= $jenis; ?></td>
				<td><?= ddmmyyyy($row->akhir); ?></td>
				<td><?= $row->tempat; ?></td>
				<td><?= $row->panitia; ?></td>
			</tr>
			<?php $no++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	</div>
	<p><?php echo '<img src="'.site_url('report/biodata/barcode/').$nip.'">'; ?></p>
	
</div>
</div>
</body>
</html>