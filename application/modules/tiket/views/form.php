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

    <div class="box-body">
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
    <?php echo form_open_multipart(); ?>   
    <div class="form-group <?php echo form_error('kategori') ? 'has-error' : null; ?>">
            <?php
            echo form_label('Kategori *','kategori');
            $selected = set_value('kategori');
            echo form_dropdown('kategori', $kategori, $selected, "class='form-control select2' id='kategori' placeholder='Pilih Kategori'");
            echo form_error('kategori') ? form_error('kategori', '<p class="help-block">','</p>') : '';
            ?>
    </div>

    <div class="form-group <?php echo form_error('subjek') ? 'has-error' : null; ?>">
        <?php
        echo form_label('Subjek *','subjek');
        $data = array('class'=>'form-control','name'=>'subjek','id'=>'subjek','type'=>'text','value'=>set_value('subjek'),'placeholder'=>'Subjek');
        echo form_input($data);
        echo form_error('subjek') ? form_error('subjek', '<p class="help-block">','</p>') : '';
        ?>
    </div>
    
    <div class="form-group <?php echo form_error('informasi') ? 'has-error' : null; ?>">
        <?php
        echo form_label('Informasi *','informasi');
        ?>
        <textarea class="form-control ckeditor" id="informasi" name="informasi" rows='6' maxlength='1000'><?php echo set_value('informasi'); ?></textarea>
        <?php
        echo form_error('informasi') ? form_error('informasi', '<p class="help-block">','</p>') : '';
        ?>
    </div>
          <div class="form-group">
            <div class="btn btn-default btn-file">
              <i class="fa fa-paperclip"></i> Sisipkan Dokumen
              <?php
              $data = array('class'=>'form-control','name'=>'files','id'=>'files','type'=>'file','value'=>set_value('files'));
              echo form_input($data);
              ?>
              <!--<input type="file" name="file" id="file">-->
            </div>
            <p class="help-block">Maksimal. 50MB</p>
          </div>
    </div><!-- /.box-body -->
<div class="box-footer">
<button type="button" class="btn btn-sm btn-flat btn-success" onclick="save()"><i class="fa fa-save"></i> Simpan</button>
<button type="button" class="btn btn-sm btn-flat btn-info" onclick="saveout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
</div>
<?php echo form_close(); ?>

</div>
	</div>
</div>