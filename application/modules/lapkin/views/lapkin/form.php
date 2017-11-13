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
			<?= form_open_multipart('lapkin/upload_data', array('class' => 'form', 'id' => 'formID', 'role'=>'form'));?>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tahun') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Tahun','tahun');
							$selected = set_value('tahun');
							echo form_dropdown('tahun', $tahun, $selected, "class='form-control select2' name='tahun' id='tahun' required");
							echo form_error('tahun') ? form_error('tahun', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Dokumen Excel Format E-Lapkin</label>
							<div>
								<input name="file" id="file" placeholder="Masukan File Excel" class="form-control" type="file">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="submit" id="btn-upload" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-upload"></i> Upload</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>