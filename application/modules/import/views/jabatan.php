<div class="row">
	<div class="col-md-12">
		<div id="message"></div>
		<?php if($this->session->flashdata('flashconfirm')): ?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-check"></i> Sukses! <?php echo $this->session->flashdata('flashconfirm'); ?>.
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('flasherror')): ?>
		<div class="alert alert-info alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-info"></i> Perhatian! <?php echo $this->session->flashdata('flasherror'); ?>.
		</div>
		<?php endif; ?>
		<div class="box box-success box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
			</div>
			<!-- box-body -->
			<?= form_open_multipart('import/upload_jabatan', array('class' => 'form', 'id' => 'form'));?>
			<div class="box-body">
				<div class="row">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<div class="col-md-12">
							<div class="form-group">
								<label>Dokumen Excel</label>
								<div>
										<input name="file" id="file" placeholder="Masukan File Excel" class="form-control" type="file">
								</div>
							</div>
							<button type="submit" id="btn-upload" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
					</div>
				</div>
			</div>
			<?= form_close(); ?>
			<!-- ./box-body -->
		</div>
	</div>
</div>
