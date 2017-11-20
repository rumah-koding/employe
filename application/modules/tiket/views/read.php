<?php
$avatar = base_url().'asset/dist/img/avatar5.png';
?>
<div class="box box-widget">
  <div class="box-header with-border">
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
    <div class="user-block">
      <img class="img-circle" src="<?php echo $avatar; ?>" alt="user image">
      <span class="username"><a href="#"><?php echo $record->nama; ?></a></span>
      <span class="description"><?php echo $record->unitkerja; ?> - <?php echo tanggal($record->created_at); ?></span>
    </div><!-- /.user-block -->
    <div class="box-tools">
      <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body" style="display: block;">
    <!-- post text -->
    <?php echo $record->informasi; ?>

    <!-- Attachment -->
    <?php if($record->file): ?>
      <div class="attachment-block clearfix">
        <img class="attachment-img" src="<?php echo base_url(); ?>asset/dist/img/file.png" alt="attachment image">
        <div class="attachment-pushed" style="margin-left:40px !important">
          <h5 class="attachment-heading" style="margin-top:10px;"><a href="<?php echo base_url(); ?>uploads/<?php echo $record->file; ?>"><?php echo $record->file; ?></a></h5>
          <div class="attachment-text">
            <a href="#"></a>
          </div><!-- /.attachment-text -->
        </div><!-- /.attachment-pushed -->
      </div><!-- /.attachment-block -->
    <?php endif; ?>

    <!-- Social sharing buttons -->
    <span class="pull-right text-muted">
     <?php if($record->status == 1): ?>
      <a href='<?php echo site_url('tiket/close/'.$record->id); ?>' class="btn btn-danger btn-sm">
        <i class="fa fa-warning"></i> Tutup Tiket</a >
        <a href='<?php echo site_url('tiket'); ?>' class="btn btn-primary btn-sm">
          <i class="fa fa-undo"></i> Kembali</a >
        <?php else: ?>
          <a href='<?php echo site_url('tiket'); ?>' class="btn btn-info btn-sm">
            <i class="fa fa-info"></i> Tiket Sudah Di Tutup</a >
          <?php endif; ?>
        </span>
      </div><!-- /.box-body -->
      
      <?php if($komentar): ?>
        <?php foreach($komentar as $row): ?>
          <div class="box-footer box-comments" style="display: block;">
            <div class="box-comment">
              <!-- User image -->
              <img class="img-circle img-sm" src="<?php echo $avatar; ?>" alt="user image">
              <div class="comment-text">
                <span class="username">
                  <?php echo $row->nama.' ('.$row->unitkerja.')'; ?>
                  <span class="text-muted pull-right"><?php echo tanggal($row->created_at); ?></span>
                </span><!-- /.username -->
                <?php echo $row->tanggapan; ?>
              </div><!-- /.comment-text -->
            </div><!-- /.box-comment -->
          </div><!-- /.box-footer -->
        <?php endforeach; ?>
      <?php endif; ?>
      
      <?php if($record->status == 1): ?>
        <div class="box-footer" style="display: block;">
          <form action="#" method="post">
            <img class="img-responsive img-circle img-sm" src="<?php echo $avatar; ?>" alt="alt text">
            <!-- .img-push is used to add margin to elements next to floating images -->
            <div class="img-push">
              <?php echo form_open(); ?>
              <?php
              $data = array('name'=>'id','id'=>'id','type'=>'hidden','value'=>set_value('id', $record->id));
              echo form_input($data);
              
              $data = array('class'=>'form-control input-sm','name'=>'tanggapan','id'=>'tanggapan','type'=>'text','value'=>set_value('tanggapan'),'placeholder'=>'Tekan Enter Untuk Membalas Tiket');
              echo form_input($data);
              ?>
              <?php echo form_close(); ?>  
            </div>
          </form>
        </div><!-- /.box-footer -->
      <?php endif; ?>
    </div>