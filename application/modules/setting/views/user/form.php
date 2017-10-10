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
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('username') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Username','username');
							$data = array('class'=>'form-control','name'=>'username','id'=>'username','type'=>'text','value'=>set_value('username', $record->username));
							echo form_input($data);
							echo form_error('username') ? form_error('username', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('fullname') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nama Lengkap','fullname');
							$data = array('class'=>'form-control','name'=>'fullname','id'=>'fullname','type'=>'text','value'=>set_value('fullname', $record->fullname));
							echo form_input($data);
							echo form_error('fullname') ? form_error('fullname', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('email') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Email','email');
							$data = array('class'=>'form-control','name'=>'email','id'=>'email','type'=>'email','value'=>set_value('email', $record->email));
							echo form_input($data);
							echo form_error('email') ? form_error('email', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('password') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Password','password');
							$data = array('class'=>'form-control','name'=>'password','id'=>'password','type'=>'password','value'=>set_value('password', $record->password));
							echo form_input($data);
							echo form_error('password') ? form_error('password', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('repassword') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Ulangi Password','repassword');
							$data = array('class'=>'form-control','name'=>'repassword','id'=>'repassword','type'=>'password','value'=>set_value('repassword', $record->repassword));
							echo form_input($data);
							echo form_error('repassword') ? form_error('repassword', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('telpon') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Telpon','telpon');
							$data = array('class'=>'form-control','name'=>'telpon','id'=>'telpon','type'=>'text','value'=>set_value('telpon', $record->telpon));
							echo form_input($data);
							echo form_error('telpon') ? form_error('telpon', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('unker') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Unit Kerja','unker');
							$selected = set_value('unker', $record->unker_id);
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
						<div class="form-group <?php echo form_error('level') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Tingkat Pengguna','level');
							$selected = set_value('level', $record->level);
							echo form_dropdown('level', $group, $selected, "class='form-control select2' name='level' id='level'");
							echo form_error('level') ? form_error('level', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('active') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Status','active');
							$selected = set_value('level', $record->active);
							$status = array('0'=>'Tidak Aktif','1'=>'Aktif');
							echo form_dropdown('active', $status, $selected, "class='form-control select2' name='active' id='active'");
							echo form_error('active') ? form_error('active', '<p class="help-block">','</p>') : '';
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