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
					<div class="col-md-9">
						<div class="form-group <?php echo form_error('tahun') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Tahun','tahun');
							$selected = set_value('tahun');
							echo form_dropdown('tahun', $tahun, $selected, "class='form-control select2' name='tahun' id='tahun'");
							echo form_error('tahun') ? form_error('tahun', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-3">
						<label>&nbsp;</label>
						<div class="form-group <?php echo form_error('tahun') ? 'has-error' : null; ?>">
						<button type="button" class="btn btn-sm btn-flat btn-success btn-block" id="process"><i class="fa fa-refresh"></i> Tampilkan Data</button>
						</div>
					</div>
					<div class="col-md-12">
						<div id="report">
							<p>Silahkan Pilih Tahun Masa Pensiun Kemudian Klik Tampilkan Data dan Tunggu Hingga Data Tampil</p>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
		</div>
	</div>
</div>