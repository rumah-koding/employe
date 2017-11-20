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

<div class="box-body">
  <div class="row">
  <div class="col-md-2" style="margin-left:5px;">
    <a href="<?php echo site_url('tiket/created'); ?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-tag"></i> Buka Tiket Layanan</a>
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <div class="mailbox-controls">
      <div class="table-responsive mailbox-messages" >
        <table id="datatable" class="table table-bordered table-hover no-wrap">
    <thead>
    <tr>
      <th>Tiket</th>
      <th>Pengirim</th>
      <th>Subjek</th>
      <th>Respon</th>
      <th>Status</th>
      <th>Tanggal</th>
    </tr>
    </thead>
          <tbody>
            <?php if($record): ?>
            <?php foreach($record as $row): ?>
            <tr>
              <td class="mailbox-star"><a href="#">#<?php echo $row->kode; ?></a></td>
              <td class="mailbox-name"><a href="<?php echo site_url('tiket/read/'.$row->id); ?>"><?php echo $row->unitkerja.' ( '.$row->nama.' )'; ?></a></td>
              <td class="mailbox-subject"><b><?php echo $row->kategori; ?></b> - <?php echo $row->subjek; ?></td>
              <td class="mailbox-star"><span class="label bg-aqua"><?php echo jumlah_komentar($row->id) ? jumlah_komentar($row->id).' komentar': '0 komentar' ; ?></span></td>
              <td class="mailbox-star"><?php echo $row->status ? '<span class="label bg-green">BUKA</span>' : '<span class="label bg-red">TUTUP</span>'; ?></td>
              <td class="mailbox-date"><?php echo tanggal($row->created_at); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table><!-- /.table -->
      </div><!-- /.mail-box-messages -->
</div><!-- /.col -->          
  </div><!-- /.row -->
</div><!-- /.box-body -->

</div>
	</div>
</div>