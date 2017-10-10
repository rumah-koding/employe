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
			<input type="hidden" name="nip" id="nip" value="<?= set_value('nip', $nip); ?>"/>
			<input type="hidden" name="unker_idx" id="unker_idx" value="<?= set_value('unker_idx', $record->unker_id); ?>"/>
			<input type="hidden" name="satker_idx" id="satker_idx" value="<?= set_value('satker_idx', $record->satker_id); ?>"/>
			<input type="hidden" name="jabatan_idx" id="jabatan_idx" value="<?= set_value('jabatan_idx', $record->jabatan_id); ?>"/>
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="user-block">
						<img class="img-circle img-bordered-sm" src="<?= base_url('asset/dist/img/avatar5.png'); ?>" alt="user image">
						  <span class="username">
							<a href="#"><?= nama($nip); ?></a>
						  </span>
						<span class="description"><?= $nip; ?></span>
						</div>
					<br>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('instansi_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Instansi Kerja','instansi_id');
							$selected = set_value('instansi_id', $record->instansi_id);
							echo form_dropdown('instansi_id', $instansi, $selected, "class='form-control select2' name='instansi_id' id='instansi_id'");
							echo form_error('instansi_id') ? form_error('instansi_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('unker_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Unit Kerja','unker_id');
							echo form_dropdown('unker_id', array(''=>'Pilih Unit Kerja'), '', "class='form-control select2' name='unker_id' id='unker_id'");
							echo form_error('unker_id') ? form_error('unker_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('satker_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Satuan Kerja','satker_id');
							echo form_dropdown('satker_id', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker_id' id='satker_id'");
							echo form_error('satker_id') ? form_error('satker_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('jenis') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Jenis Jabatan','jenis');
							$selected = set_value('jenis', $record->jenis);
							$jenis = array(''=>'Pilih Salah Satu Jenis Jabatan','1'=>'Struktural','2'=>'Fungsional Tertentu','3'=>'Pejabat Negara','4'=>'Fungsional Umum');
							echo form_dropdown('jenis', $jenis, $selected, "class='form-control select2' name='jenis' id='jenis'");
							echo form_error('jenis') ? form_error('jenis', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('jabatan_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jabatan','jabatan_id');
							echo form_dropdown('jabatan_id', array(''=>'Pilih Jabatan'), '', "class='form-control select2' name='jabatan_id' id='jabatan_id'");
							echo form_error('jabatan_id') ? form_error('jabatan_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('instansi') ? 'has-error' : null; ?>">
							<?php
							echo form_label('&nbsp','instansi');
							$data = array('class'=>'form-control','name'=>'instansi','id'=>'instansi','type'=>'text','value'=>set_value('instansi', $record->instansi));
							echo form_input($data);
							echo form_error('instansi') ? form_error('instansi', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('unker') ? 'has-error' : null; ?>">
							<?php
							echo form_label('&nbsp','unker');
							$data = array('class'=>'form-control','name'=>'unker','id'=>'unker','type'=>'text','value'=>set_value('unker', $record->unker));
							echo form_input($data);
							echo form_error('unker') ? form_error('unker', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('satker') ? 'has-error' : null; ?>">
							<?php
							echo form_label('&nbsp','satker');
							$data = array('class'=>'form-control','name'=>'satker','id'=>'satker','type'=>'text','value'=>set_value('satker', $record->satker));
							echo form_input($data);
							echo form_error('satker') ? form_error('satker', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('disable') ? 'has-error' : null; ?>">
							<?php
							echo form_label('&nbsp','disable');
							$data = array('class'=>'form-control','name'=>'disable','id'=>'disable','type'=>'text','value'=>set_value('disable'),'disabled'=>'disabled');
							echo form_input($data);
							echo form_error('disable') ? form_error('disable', '<p class="help-block">','</p>') : '';
							?>
						</div>
						<div class="form-group <?php echo form_error('jabatan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('&nbsp','jabatan');
							$data = array('class'=>'form-control','name'=>'jabatan','id'=>'jabatan','type'=>'text','value'=>set_value('jabatan', $record->jabatan));
							echo form_input($data);
							echo form_error('jabatan') ? form_error('jabatan', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('sk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nomer SK','sk');
							$data = array('class'=>'form-control','name'=>'sk','id'=>'sk','type'=>'text','value'=>set_value('sk', $record->sk));
							echo form_input($data);
							echo form_error('sk') ? form_error('sk', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('tglsk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tanggal SK','tglsk');
							$data = array('class'=>'form-control','name'=>'tglsk','id'=>'tglsk','type'=>'text','value'=>set_value('tglsk', $record->tglsk ? ddmmyyyy($record->tglsk): ''));
							echo form_input($data);
							echo form_error('tglsk') ? form_error('tglsk', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('tmt') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TMT Jabatan','tmt');
							$data = array('class'=>'form-control','name'=>'tmt','id'=>'tmt','type'=>'text','value'=>set_value('tmt', $record->tmt ? ddmmyyyy($record->tmt) : '' ));
							echo form_input($data);
							echo form_error('tmt') ? form_error('tmt', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('eselon') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Tingkat Jabatan','eselon');
							$selected = set_value('eselon', $record->eselon);
							echo form_dropdown('eselon', $eselon, $selected, "class='form-control select2' name='eselon' id='eselon'");
							echo form_error('eselon') ? form_error('eselon', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('penetapan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Pejabat Penetapan','penetapan');
							$data = array('class'=>'form-control','name'=>'penetapan','id'=>'penetapan','type'=>'text','value'=>set_value('penetapan', $record->penetapan));
							echo form_input($data);
							echo form_error('penetapan') ? form_error('penetapan', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-success" onclick="save()"><i class="fa fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="savebackout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="backward(<?= $nip; ?>);"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>