<div class="row">
	<div class="col-md-12">
		<div id="message"></div>
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
						<table id="tableIDX" class="table table-striped table-bordered responsive nowrap print tree" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Satuan Kerja</th>
									<th>Jabatan</th>
									<th>TMT</th>
									<th>Eselon</th>
									<th>Nama Lengkap</th>
									<th>NIP</th>
									<th>Golongan</th>
									<th>TMT</th>
									<th>Pendidikan Akhir</th>
									<th>Jenis</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php if($record): ?>
								<?php $no = 1; ?>
								<?php foreach($record as $row): ?>
								<tr class="treegrid-<?= $row->kode; ?> treegrid-parent-<?= $row->parent_id; ?>">
									<td><?= $no; ?></td>
									<td><?= $row->satker; ?></td>
									<td><?= $row->jabatan; ?></td>
									<td nowrap><?= ddmmyyyy($row->tmt); ?></td>
									<td><?= eselon($row->eselon) ? eselon($row->eselon) : '-'; ?></td>
									<td><?= nama($row->nip); ?></td>
									<td nowrap><?= $row->nip; ?></td>
									<td><?= pangkat_akhir($row->nip) ? gol(pangkat_akhir($row->nip)->gol) : '-'; ?></td>
									<td nowrap><?= pangkat_akhir($row->nip) ? ddmmyyyy(pangkat_akhir($row->nip)->tmt) : '-'; ?></td>
									<td><?= ktpu_akhir($row->nip) ? ktpu_akhir($row->nip)->jurusan : '-'; ?></td>
									<td><?= jenis_jabatan($row->jenis); ?></td>
									<td><?= analisa($row->nip, $row->eselon, $row->kode, $row->parent_id ); ?></td>
								</tr>
								<?php $no++; ?>
								<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
		</div>
	</div>
</div>