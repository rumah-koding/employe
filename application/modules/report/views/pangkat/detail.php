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
		<td class="text"><?php echo nama($row->nip); ?></td>
		<td class="text"><?php echo $row->nip; ?></td>
		<td><?php echo pangkat_akhir($row->nip)->gol ? pkt(pangkat_akhir($row->nip)->gol) : '-'; ?></td>
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