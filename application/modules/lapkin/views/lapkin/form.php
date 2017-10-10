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
			<form id="formID" role="form" action="" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('unker') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Unit Kerja','unker');
							$selected = set_value('unker');
							echo form_dropdown('unker', $unker, $selected, "class='form-control select2' name='unker' id='unker'");
							echo form_error('unker') ? form_error('unker', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('satker') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Satuan Kerja','satker');
							echo form_dropdown('satker', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker' id='satker'");
							echo form_error('satker') ? form_error('satker', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tahun') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Tahun','tahun');
							$selected = set_value('tahun');
							echo form_dropdown('tahun', $tahun, $selected, "class='form-control select2' name='tahun' id='tahun'");
							echo form_error('tahun') ? form_error('tahun', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('file') ? 'has-error' : null; ?>">
							<?php
							echo form_label('File Excel E-Lapkin','file');
							$data = array('class'=>'form-control','name'=>'file','id'=>'file','type'=>'file','value'=>set_value('file'));
							echo form_upload($data);
							echo form_error('file') ? form_error('file', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-success" onclick="save()"><i class="fa fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="saveout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>