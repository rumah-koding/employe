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
						<div class="form-group <?php echo form_error('jenis') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jenis Diklat','jenis');
							$selected = set_value('jenis', $record->jenis);
							$jenis = array(''=>'Pilih Jenis Diklat','01'=>'Diklat Struktural','02'=>'Diklat Fungsional','03'=>'Diklat Teknis');
							echo form_dropdown('jenis', $jenis, $selected, "class='form-control select2' name='jenis' id='jenis'");
							echo form_error('jenis') ? form_error('jenis', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('kode') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Diklat Struktural','kode');
							$selected = set_value('kode', $record->kode);
							echo form_dropdown('kode', $kode, $selected, "class='form-control select2' name='kode' id='kode'");
							echo form_error('kode') ? form_error('kode', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('diklat') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nama Kegiatan Diklat','diklat');
							$data = array('class'=>'form-control','name'=>'diklat','id'=>'diklat','type'=>'text','value'=>set_value('diklat', $record->diklat));
							echo form_input($data);
							echo form_error('diklat') ? form_error('diklat', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php echo form_error('tempat') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Lokasi/Tempat Pelaksanaan','tempat');
							$data = array('class'=>'form-control','name'=>'tempat','id'=>'tempat','type'=>'text','value'=>set_value('tempat', $record->tempat));
							echo form_input($data);
							echo form_error('tempat') ? form_error('tempat', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php echo form_error('panitia') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Panitia/Penyelenggara','panitia');
							$data = array('class'=>'form-control','name'=>'panitia','id'=>'panitia','type'=>'text','value'=>set_value('panitia', $record->panitia));
							echo form_input($data);
							echo form_error('panitia') ? form_error('panitia', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php echo form_error('angkatan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Angkatan','angkatan');
							$data = array('class'=>'form-control','name'=>'angkatan','id'=>'angkatan','type'=>'text','value'=>set_value('angkatan', $record->angkatan));
							echo form_input($data);
							echo form_error('angkatan') ? form_error('angkatan', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php echo form_error('mulai') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tanggal Mulai','mulai');
							$data = array('class'=>'form-control','name'=>'mulai','id'=>'mulai','type'=>'text','value'=>set_value('mulai', ddmmyyyy($record->mulai)));
							echo form_input($data);
							echo form_error('mulai') ? form_error('mulai', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php echo form_error('akhir') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tanggal Akhir','akhir');
							$data = array('class'=>'form-control','name'=>'akhir','id'=>'akhir','type'=>'text','value'=>set_value('akhir', ddmmyyyy($record->akhir)));
							echo form_input($data);
							echo form_error('akhir') ? form_error('akhir', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php echo form_error('jam') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jumlah Jam','jam');
							$data = array('class'=>'form-control','name'=>'jam','id'=>'jam','type'=>'text','value'=>set_value('jam', $record->jam));
							echo form_input($data);
							echo form_error('jam') ? form_error('jam', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('sk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nomer SK/Sertifikat','sk');
							$data = array('class'=>'form-control','name'=>'sk','id'=>'sk','type'=>'text','value'=>set_value('sk', $record->sk));
							echo form_input($data);
							echo form_error('sk') ? form_error('sk', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo form_error('tglsk') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tanggal SK/Sertifikat','tglsk');
							$data = array('class'=>'form-control','name'=>'tglsk','id'=>'tglsk','type'=>'text','value'=>set_value('tglsk', ddmmyyyy($record->tglsk)));
							echo form_input($data);
							echo form_error('tglsk') ? form_error('tglsk', '<p class="help-block">','</p>') : '';
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