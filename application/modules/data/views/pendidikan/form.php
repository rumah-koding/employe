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
						<div class="form-group <?php echo form_error('jurusan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jurusan Pendidikan','jurusan');
							$data = array('class'=>'form-control','name'=>'jurusan','id'=>'jurusan','type'=>'text','value'=>set_value('jurusan', $record->jurusan));
							echo form_input($data);
							echo form_error('jurusan') ? form_error('jurusan', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('ijasah') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nomer Ijasah','ijasah');
							$data = array('class'=>'form-control','name'=>'ijasah','id'=>'ijasah','type'=>'text','value'=>set_value('ijasah', $record->ijasah));
							echo form_input($data);
							echo form_error('ijasah') ? form_error('ijasah', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tanggal') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tanggal Ijasah/Lulus','tanggal');
							$data = array('class'=>'form-control','name'=>'tanggal','id'=>'tanggal','type'=>'text','value'=>set_value('tanggal', ddmmyyyy($record->tanggal)));
							echo form_input($data);
							echo form_error('tanggal') ? form_error('tanggal', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('sekolah') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nama Sekolah/Perguruan Tinggi','sekolah');
							$data = array('class'=>'form-control','name'=>'sekolah','id'=>'sekolah','type'=>'text','value'=>set_value('sekolah', $record->sekolah));
							echo form_input($data);
							echo form_error('sekolah') ? form_error('sekolah', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tempat') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Kota Sekolah/Perguruan Tinggi Asal','tempat');
							$data = array('class'=>'form-control','name'=>'tempat','id'=>'tempat','type'=>'text','value'=>set_value('tempat', $record->tempat));
							echo form_input($data);
							echo form_error('tempat') ? form_error('tempat', '<p class="help-block">','</p>') : '';
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