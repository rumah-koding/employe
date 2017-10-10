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
			<input type="hidden" name="unker_idx" id="unker_idx" value="<?= set_value('unker_idx', $record->unker_id); ?>"/>
			<input type="hidden" name="satker_idx" id="satker_idx" value="<?= set_value('satker_idx', $record->satker_id); ?>"/>
			
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('instansi') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Instansi Kerja','instansi');
							$selected = set_value('instansi', $record->instansi_id);
							echo form_dropdown('instansi', $instansi, $selected, "class='form-control select2' name='instansi' id='instansi'");
							echo form_error('instansi') ? form_error('instansi', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('unker') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Unit Kerja','unker');
							echo form_dropdown('unker', array(''=>'Pilih Unit Kerja'), '', "class='form-control select2' name='unker' id='unker'");
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
						<div class="form-group <?php echo form_error('jenis') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jenis Jabatan','jenis');
							$selected = set_value('jenis', $record->jenis);
							$jenis = array('1'=>'Jabatan Struktural','2'=>'Fungsional Tertentu','3'=>'Pejabat Negara','4'=>'Fungsional Umum');
							echo form_dropdown('jenis', $jenis, $selected, "class='form-control select2' name='jenis' id='jenis'");
							echo form_error('jenis') ? form_error('jenis', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jabatan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jabatan','jabatan');
							$data = array('class'=>'form-control','name'=>'jabatan','id'=>'jabatan','type'=>'text','value'=>set_value('jabatan', $record->jabatan));
							echo form_input($data);
							echo form_error('jabatan') ? form_error('jabatan', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('bup') ? 'has-error' : null; ?>">
							<?php
							echo form_label('B.U.P','bup');
							$data = array('class'=>'form-control','name'=>'bup','id'=>'bup','type'=>'text','value'=>set_value('bup', $record->bup));
							echo form_input($data);
							echo form_error('bup') ? form_error('bup', '<p class="help-block">','</p>') : '';
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