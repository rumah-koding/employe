<table id="tableIDX" class="table table-striped table-bordered responsive nowrap print" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Lengkap</th>
			<th>NIP</th>
			<th>Golongan</th>
			<th>Jabatan</th>
			<th>Tingkat Jabatan</th>
			<th>Satuan Kerja</th>
			<th>Unit Kerja</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php if($record): ?>
		<?php $no = 1; ?>
		<?php foreach($record as $row): ?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= nama($row->nip); ?></td>
			<td><?= $row->nip; ?></td>
			<td><?= pangkat_akhir($row->nip) ? gol(pangkat_akhir($row->nip)->gol) : '-'; ?></td>
			<td><?= $row->jabatan; ?></td>
			<td><?= eselon($row->eselon); ?></td>
			<td><?= $row->satker; ?></td>
			<td><?= $row->unker; ?></td>
			<td>-</td>
		</tr>
		<?php $no++; ?>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>