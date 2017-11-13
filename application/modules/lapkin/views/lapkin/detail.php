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
						<span id="key" style="display: none;"><?= $this->security->get_csrf_hash(); ?></span>
						<table id="tableID" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th width="5px"><input type="checkbox" id="check-all"></th>
									<th>Nama Lengkap</th>
									<th>NIP</th>
									<th>Jabatan</th>
									<th>Unit Kerja</th>
									<th>Satuan Kerja</th>
									<th>SKP</th>
									<th>Pelayanan</th>
									<th>Integritas</th>
									<th>Komitmen</th>
									<th>Disiplin</th>
									<th>Kerjasama</th>
									<th>Kepemimpinan</th>
									<th>Tahun</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
		</div>
	</div>
</div>