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
						<div class="user-block">
						<img class="img-circle img-bordered-sm" src="<?= base_url('asset/dist/img/avatar5.png'); ?>" alt="user image">
						  <span class="username">
							<a href="#"><?= $record->fullname; ?></a>
						  </span>
						<span class="description"><?= $record->username; ?></span>
						</div>
					<br>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('password') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Password Baru','password');
							$data = array('class'=>'form-control','name'=>'password','id'=>'password','type'=>'password','value'=>set_value('password'));
							echo form_input($data);
							echo form_error('password') ? form_error('password', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('repassword') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Ulangi Password','repassword');
							$data = array('class'=>'form-control','name'=>'repassword','id'=>'repassword','type'=>'password','value'=>set_value('repassword'));
							echo form_input($data);
							echo form_error('repassword') ? form_error('repassword', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="saveout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>