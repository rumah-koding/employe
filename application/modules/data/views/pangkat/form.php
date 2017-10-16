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
						<div class="form-group <?php echo form_error('sk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('SK Pangkat','sk');
							$data = array('class'=>'form-control','name'=>'sk','id'=>'sk','type'=>'text','value'=>set_value('sk', $record->sk));
							echo form_input($data);
							echo form_error('sk') ? form_error('sk', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('tglsk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TGL SK Pangkat','tglsk');
							$data = array('class'=>'form-control','name'=>'tglsk','id'=>'tglsk','type'=>'text','value'=>set_value('tglsk', ddmmyyyy($record->tglsk)));
							echo form_input($data);
							echo form_error('tglsk') ? form_error('tglsk', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tmt') ? 'has-error' : null; ?>">
							<?php
							echo form_label('TMT Pangkat','tmt');
							$data = array('class'=>'form-control','name'=>'tmt','id'=>'tmt','type'=>'text','value'=>set_value('tmt', ddmmyyyy($record->tmt)));
							echo form_input($data);
							echo form_error('tmt') ? form_error('tmt', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('gol') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Golongan','gol');
							$selected = set_value('gol', $record->gol);
							echo form_dropdown('gol', $gol, $selected, "class='form-control select2' name='gol' id='gol'");
							echo form_error('gol') ? form_error('gol', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('thn') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tahun','thn');
							$data = array('class'=>'form-control','name'=>'thn','id'=>'thn','type'=>'text','value'=>set_value('thn', $record->thn));
							echo form_input($data);
							echo form_error('thn') ? form_error('thn', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('bln') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Bulan','bln');
							$data = array('class'=>'form-control','name'=>'bln','id'=>'bln','type'=>'text','value'=>set_value('bln', $record->bln));
							echo form_input($data);
							echo form_error('bln') ? form_error('bln', '<p class="help-block">','</p>') : '';
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
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="backward(<?= $nip; ?>);"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>