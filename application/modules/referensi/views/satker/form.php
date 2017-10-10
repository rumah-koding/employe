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
			<input type="hidden" name="parent_idx" id="parent_idx" value="<?= set_value('parent_idx', $record->parent_id); ?>"/>
			
			<!-- box-body -->
			<div class="box-body">
				<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#data" data-toggle="tab">Satuan Kerja</a></li>
				  <li><a href="#address" data-toggle="tab">Alamat Kantor</a></li>
				</ul>
					<div class="tab-content">
						<div id="data" class="tab-pane fade in active">
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
									<div class="form-group <?php echo form_error('parent') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Satuan Kerja Induk','parent');
										echo form_dropdown('parent', array(''=>'Pilih Satuan Kerja Induk'), '', "class='form-control select2' name='parent' id='parent'");
										echo form_error('parent') ? form_error('parent', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group <?php echo form_error('satker') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Satuan Kerja','satker');
										$data = array('class'=>'form-control','name'=>'satker','id'=>'satker','type'=>'text','value'=>set_value('satker', $record->satker));
										echo form_input($data);
										echo form_error('satker') ? form_error('satker', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group <?php echo form_error('upt') ? 'has-error' : null; ?>">
										<?php
										echo form_label('UPT - Dinas/Badan','upt');
										$selected = set_value('upt', $record->upt);
										$upt = array(''=>'TIDAK','1'=>'YA');
										echo form_dropdown('upt', $upt, $selected, "class='form-control select2' name='upt' id='upt'");
										echo form_error('upt') ? form_error('upt', '<p class="help-block">','</p>') : '';
										?>
									</div>
								</div>
							</div>
						</div>
					
						<div id="address" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group <?php echo form_error('alamat') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Alamat Kantor','alamat');
										$data = array('class'=>'form-control','name'=>'alamat','id'=>'alamat','type'=>'text','value'=>set_value('alamat', $record->alamat));
										echo form_input($data);
										echo form_error('alamat') ? form_error('alamat', '<p class="help-block">','</p>') : '';
										?>
									</div>
									<div class="form-group <?php echo form_error('email') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Email Kantor','email');
										$data = array('class'=>'form-control','name'=>'email','id'=>'email','type'=>'text','value'=>set_value('email', $record->email));
										echo form_input($data);
										echo form_error('email') ? form_error('email', '<p class="help-block">','</p>') : '';
										?>
									</div>
									<div class="form-group <?php echo form_error('telpon') ? 'has-error' : null; ?>">
										<?php
										echo form_label('Telpon Kantor','telpon');
										$data = array('class'=>'form-control','name'=>'telpon','id'=>'telpon','type'=>'text','value'=>set_value('telpon', $record->telpon));
										echo form_input($data);
										echo form_error('telpon') ? form_error('telpon', '<p class="help-block">','</p>') : '';
										?>
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