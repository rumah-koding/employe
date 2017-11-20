
<?= form_open_multipart('data/file/upload', array('class' => 'form', 'id' => 'formID', 'role'=>'form'));?>
<form id="formID" role="form" action="<?= site_url('data/file/upload'); ?>" method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type="hidden" name="modul_id" value="<?= $modul_id; ?>" />
<input type="hidden" name="modul" value="<?= $modul; ?>" />
<input type="hidden" name="nip" value="<?= $nip; ?>" />
<!-- box-body -->
<div class="row">
	<div class="col-md-12">
		<div class="form-group <?php echo form_error('file') ? 'has-error' : null; ?>">
			<?php
			echo form_label('Upload File','file');
			$data = array('class'=>'form-control','name'=>'file','id'=>'file','type'=>'file','value'=>set_value('file'));
			echo form_input($data);
			echo form_error('file') ? form_error('file', '<p class="help-block">','</p>') : 'Silahkan Upload Dokumen PDF|JPG|PNG. Ukuran Maksimal 2MB';
			?>
		</div>
	</div>
</div>
</div>
<!-- ./box-body -->
<button type="submit" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Upload</button>
<button type="button" class="btn btn-sm btn-flat btn-danger" data-dismiss='modal'><i class="fa fa-close"></i> Keluar</button>
<?php form_close(); ?>
		