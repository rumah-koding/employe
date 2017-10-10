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
						<div id="smartwizard">
						<ul>
							<li><a href="#1">Step 1<br /><small>Informasi</small></a></li>
							<li><a href="#2">Step 2<br /><small>Biodata Diri</small></a></li>
							<li><a href="#3">Step 3<br /><small>Kedudukan Pegawai</small></a></li>
							<li><a href="#4">Step 4<br /><small>Kontak Pegawai</small></a></li>
							<li><a href="#5">Step 5<br /><small>Kepemilikan Kartu</small></a></li>
						</ul>
						
						<div>
							<div id="1" class="">
								<h2>Informasi</h2>
								<p>Sebelum menambahkan data pegawai mau pun merubah data pegawai pastikan data yang anda masukan sudah tersedia dan lengkap, dan jika data anda sudah tersedia dan lengkap maka silahkan tekan tombol 'lanjut' pada posisi kanan bawah atau meng-klik setiap tahap yang ada di atas form.</p>
								<p>Jika data sudah terisi semua, makan silahkan tekan tombol 'simpan' untuk menyimpan data dan tetap pada halaman tambah data, atau tombol 'simpan dan keluar' untuk berpindah pada halaman daftar data pegawai setelah proses simpan sukses. Jika tidak dapat disimpan atau terdapat pesan kesalahan (<i>error</i>) mohon untuk memeriksa setiap langkah atau tahapan untuk melihat data inputan bahwa tidak ada pesan error validasi pada setiap inputan.</p>
							</div>
							<div id="2" class="">
								<h2>Biodata Diri</h2>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('nip') ? 'has-error' : null; ?>">
										<?php
										echo form_label('NIP','nip');
										$data = array('class'=>'form-control','name'=>'nip','id'=>'nip','type'=>'text','value'=>set_value('nip', $record->nip));
										echo form_input($data);
										echo form_error('nip') ? form_error('nip', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('nama') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Nama Lengkap','nama');
										$data = array('class'=>'form-control','name'=>'nama','id'=>'nama','type'=>'text','value'=>set_value('nama', $record->nama));
										echo form_input($data);
										echo form_error('nama') ? form_error('nama', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('gelar1') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Gelar Depan','gelar1');
										$data = array('class'=>'form-control','name'=>'gelar1','id'=>'gelar1','type'=>'text','value'=>set_value('gelar1', $record->gelar1));
										echo form_input($data);
										echo form_error('gelar1') ? form_error('gelar1', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('gelar2') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Gelar Belakang','gelar2');
										$data = array('class'=>'form-control','name'=>'gelar2','id'=>'gelar2','type'=>'text','value'=>set_value('gelar2', $record->gelar2));
										echo form_input($data);
										echo form_error('gelar2') ? form_error('gelar2', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('tmlahir') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Tempat Lahir','tmlahir');
										$data = array('class'=>'form-control','name'=>'tmlahir','id'=>'tmlahir','type'=>'text','value'=>set_value('tmlahir', $record->tmlahir));
										echo form_input($data);
										echo form_error('tmlahir') ? form_error('tmlahir', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('tglahir') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Tanggal Lahir','tglahir');
										$data = array('class'=>'form-control','name'=>'tglahir','id'=>'tglahir','type'=>'text','value'=>set_value('tglahir', ddmmyyyy($record->tglahir)));
										echo form_input($data);
										echo form_error('tglahir') ? form_error('tglahir', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('sex') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Jenis Kelamin','sex');
										$selected = set_value('sex', $record->sex);
										$sex = array('1'=>'Laki-Laki','2'=>'Perempuan');
										echo form_dropdown('sex', $sex, $selected, "class='form-control select2' name='sex' id='sex'");
										echo form_error('sex') ? form_error('sex', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('agama_id') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Agama','agama_id');
										$selected = set_value('agama_id', $record->agama_id);
										echo form_dropdown('agama_id', $agama, $selected, "class='form-control select2' name='agama_id' id='agama_id'");
										echo form_error('agama_id') ? form_error('agama_id', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('kawin') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Status Pernikahan','kawin');
										$selected = set_value('kawin', $record->kawin);
										$kawin = array('1'=>'Belum Menikah','2'=>'Sudah Menikah','3'=>'Janda/Duda Perceraian','4'=>'Janda/Duda Meninggal Dunia');
										echo form_dropdown('kawin', $kawin, $selected, "class='form-control select2' name='kawin' id='kawin'");
										echo form_error('kawin') ? form_error('kawin', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('darah') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Golongan Darah','darah');
										$selected = set_value('darah', $record->darah);
										$darah = array('1'=>'A','2'=>'B','3'=>'O','4'=>'AB');
										echo form_dropdown('darah', $darah, $selected, "class='form-control select2' name='darah' id='darah'");
										echo form_error('darah') ? form_error('darah', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
							</div>
							<div id="3" class="">
								<h2>Kedudukan Pegawai</h2>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('status_id') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Status Pegawai','status_id');
										$selected = set_value('status_id', $record->status_id);
										echo form_dropdown('status_id', $status, $selected, "class='form-control select2' name='status_id' id='status_id'");
										echo form_error('status_id') ? form_error('status_id', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('kedudukan_id') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Kedudukan Pegawai','kedudukan_id');
										$selected = set_value('kedudukan_id', $record->kedudukan_id);
										echo form_dropdown('kedudukan_id', $kedudukan, $selected, "class='form-control select2' name='kedudukan_id' id='kedudukan_id'");
										echo form_error('kedudukan_id') ? form_error('kedudukan_id', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('jenis_id') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Jenis Pegawai','jenis_id');
										$selected = set_value('jenis_id', $record->status_id);
										echo form_dropdown('jenis_id', $jenis, $selected, "class='form-control select2' name='jenis_id' id='jenis_id'");
										echo form_error('jenis_id') ? form_error('jenis_id', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('profesi') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Profesi Pegawai','profesi');
										$selected = set_value('profesi', $record->status_id);
										$pilih = array(''=>'Profesi Pegawai');
										echo form_dropdown('profesi', $pilih, $selected, "class='form-control select2' name='status_id' id='status_id' disabled='disabled'");
										echo form_error('profesi') ? form_error('status_id', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
							</div>
							<div id="4" class="">
								<h2>Kontak Pegawai</h2>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('alamat') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Alamat Lengkap','alamat');
										$data = array('class'=>'form-control','name'=>'alamat','id'=>'alamat','type'=>'text','value'=>set_value('alamat', $record->alamat));
										echo form_input($data);
										echo form_error('alamat') ? form_error('alamat', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('kodepos') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Kode Pos','kodepos');
										$data = array('class'=>'form-control','name'=>'kodepos','id'=>'kodepos','type'=>'text','value'=>set_value('kodepos', $record->kodepos));
										echo form_input($data);
										echo form_error('kodepos') ? form_error('kodepos', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('telpon') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Telpon/Handphone','telpon');
										$data = array('class'=>'form-control','name'=>'telpon','id'=>'telpon','type'=>'text','value'=>set_value('telpon', $record->telpon));
										echo form_input($data);
										echo form_error('telpon') ? form_error('telpon', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('email') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Email','email');
										$data = array('class'=>'form-control','name'=>'email','id'=>'email','type'=>'email','value'=>set_value('email', $record->email));
										echo form_input($data);
										echo form_error('email') ? form_error('email', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
							</div>
							<div id="5" class="">
								<h2>Kepemilikan Kartu</h2>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('ktp') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Kartu Penduduk','ktp');
										$data = array('class'=>'form-control','name'=>'ktp','id'=>'ktp','type'=>'text','value'=>set_value('ktp', $record->ktp));
										echo form_input($data);
										echo form_error('ktp') ? form_error('ktp', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('karpeg') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Kartu Pegawai','karpeg');
										$data = array('class'=>'form-control','name'=>'karpeg','id'=>'karpeg','type'=>'text','value'=>set_value('karpeg', $record->karpeg));
										echo form_input($data);
										echo form_error('karpeg') ? form_error('karpeg', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('bpjs') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Askes/BPJS','bpjs');
										$data = array('class'=>'form-control','name'=>'bpjs','id'=>'bpjs','type'=>'text','value'=>set_value('bpjs', $record->bpjs));
										echo form_input($data);
										echo form_error('bpjs') ? form_error('bpjs', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('taspen') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Taspen','taspen');
										$data = array('class'=>'form-control','name'=>'taspen','id'=>'taspen','type'=>'text','value'=>set_value('taspen', $record->taspen));
										echo form_input($data);
										echo form_error('taspen') ? form_error('taspen', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('karis') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Karis/Karsu','karis');
										$data = array('class'=>'form-control','name'=>'karis','id'=>'karis','type'=>'text','value'=>set_value('karis', $record->karis));
										echo form_input($data);
										echo form_error('karis') ? form_error('karis', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo form_error('npwp') ? 'has-error' : null; ?>">
										<?php
										echo form_label('NPWP','npwp');
										$data = array('class'=>'form-control','name'=>'npwp','id'=>'npwp','type'=>'text','value'=>set_value('npwp', $record->npwp));
										echo form_input($data);
										echo form_error('npwp') ? form_error('npwp', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
							</div>
						</div>
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