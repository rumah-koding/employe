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
			<input type="hidden" name="nip" id="nip" value="<?= $nip; ?>"/>
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
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('sk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('SK CPNS','sk');
							$data = array('class'=>'form-control','name'=>'sk','id'=>'sk','type'=>'text','value'=>set_value('sk', $record->sk));
							echo form_input($data);
							echo form_error('sk') ? form_error('sk', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tglsk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TGL SK CPNS','tglsk');
							$data = array('class'=>'form-control','name'=>'tglsk','id'=>'tglsk','type'=>'text','value'=>set_value('tglsk', ddmmyyyy($record->tglsk)));
							echo form_input($data);
							echo form_error('tglsk') ? form_error('tglsk', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tmt') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TMT CPNS','tmt');
							$data = array('class'=>'form-control','name'=>'tmt','id'=>'tmt','type'=>'text','value'=>set_value('tmt', ddmmyyyy($record->tmt)));
							echo form_input($data);
							echo form_error('tmt') ? form_error('tmt', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('gol') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Golongan Awal','gol');
							$selected = set_value('gol', $record->gol);
							echo form_dropdown('gol', $gol, $selected, "class='form-control select2' name='gol' id='gol'");
							echo form_error('gol') ? form_error('gol', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('ktpu') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tingkat Pendidikan','ktpu');
							$selected = set_value('ktpu', $record->ktpu);
							echo form_dropdown('ktpu', $ktpu, $selected, "class='form-control select2' name='ktpu' id='ktpu'");
							echo form_error('ktpu') ? form_error('ktpu', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('pengesahan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Pejabat Pengesahan','pengesahan');
							$data = array('class'=>'form-control','name'=>'pengesahan','id'=>'pengesahan','type'=>'text','value'=>set_value('pengesahan', $record->pengesahan));
							echo form_input($data);
							echo form_error('pengesahan') ? form_error('pengesahan', '<p class="help-block">','</p>') : '';
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
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="backward();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>