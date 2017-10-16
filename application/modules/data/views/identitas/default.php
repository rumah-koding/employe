<span id="key" style="display: none;"><?= $this->security->get_csrf_hash(); ?></span>
<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
          <div class="box box-success">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url('asset/dist/img/avatar5.png'); ?>" alt="User profile picture">
              <h3 class="profile-username text-center"><?= nama($nip); ?></h3>
              <p class="text-muted text-center">
				<?= biodata($nip)->nip; ?><br>
				<?= biodata($nip)->tmlahir.', '.ddMMMyyyy(biodata($nip)->tglahir); ?>
			  </p>
			  <a href="#" class="btn btn-success btn-block btn-flat btn-sm"><i class="fa fa-image"></i> Upload Photo</a>
			  <hr>
			  <strong><i class="fa fa-bank margin-r-5"></i> JABATAN</strong>
				<p class="text-muted">
				  <?= jabatan_akhir($nip)->jabatan.' '; ?>
				  <?= jabatan_akhir($nip)->satker.' '; ?>
				  <?= jabatan_akhir($nip)->unker.' '; ?>
				  <?= jabatan_akhir($nip)->instansi.'<br>'; ?>
				  <?= pkt(pangkat_akhir($nip)->gol).' ('.gol(pangkat_akhir($nip)->gol).')'; ?>
				</p>
			  <hr>
			  <strong><i class="fa fa-graduation-cap margin-r-5"></i> PENDIDIKAN</strong>
				<p class="text-muted">
				  <?= ktpu(ktpu_akhir($nip)->ktpu).' | '; ?>
				  <?= ktpu_akhir($nip)->jurusan.' '; ?>
				  <?= ktpu_akhir($nip)->sekolah.' '; ?>
				  <?= ktpu_akhir($nip)->tempat.' '; ?>
				  <?= ktpu_akhir($nip)->tahun; ?>
				</p>
			  <?php if(biodata($nip)): ?>
			  <hr>
			  <strong><i class="fa fa-map-marker margin-r-5"></i> ALAMAT</strong>
				<p class="text-muted">
				  <?= biodata($nip)->alamat; ?>
				</p>
			  <strong><i class="fa fa-phone margin-r-5"></i> TELPON</strong>
				<p class="text-muted">
				  <?= biodata($nip)->telpon; ?>
				</p>
			  <strong><i class="fa fa-envelope margin-r-5"></i> EMAIL</strong>
				<p class="text-muted">
				  <?= biodata($nip)->email; ?>
				</p>
			  <?php endif; ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	</div>
	
	<div class="col-md-9">
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
              <h3 class="box-title">Data Identitas</h3>
			  <div class="pull-right">
					<a href="<?= site_url('data/pegawai'); ?>" class="btn btn-xs btn-default"><i class="fa fa-book"></i> Daftar Pegawai</a>
				</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<a href="<?= site_url('data/cpns/'.$nip); ?>" class="btn btn-app btn-flat"><i class="fa fa-hourglass-start"></i> CPNS</a>
				<a href="<?= site_url('data/pns/'.$nip); ?>" class="btn btn-app btn-flat"><i class="fa fa-hourglass"></i> PNS</a>
				<a href="<?= site_url('data/pangkat/'.$nip); ?>" class="btn btn-app btn-flat"><i class="fa fa-tags"></i> PANGKAT</a>
				<a href="<?= site_url('data/jabatan/'.$nip); ?>" class="btn btn-app btn-flat"><i class="fa fa-bank"></i> JABATAN</a>
				<a href="<?= site_url('data/pendidikan/'.$nip); ?>" class="btn btn-app btn-flat"><i class="fa fa-graduation-cap"></i> PENDIDIKAN</a>
				<a href="<?= site_url('data/diklat/'.$nip); ?>" class="btn btn-app btn-flat"><i class="fa fa-book"></i> DIKLAT</a>
				<a href="<?= site_url('#'); ?>" class="btn btn-app btn-flat"><i class="fa fa-group"></i> KELUARGA</a>
				<a href="<?= site_url('#'); ?>" class="btn btn-app btn-flat"><i class="fa fa-certificate"></i> TANDA JASA</a>
				<a href="<?= site_url('#'); ?>" class="btn btn-app btn-flat"><i class="fa fa-gavel"></i> HUKUMAN</a>
				<a href="" class="btn btn-app btn-flat"><i class="fa fa-flag"></i> ORGANISASI</a>
				<a href="" class="btn btn-app btn-flat"><i class="fa fa-money"></i> KGB</a>
				<a href="" class="btn btn-app btn-flat"><i class="fa fa-coffee"></i> CUTI</a>
				<a href="" class="btn btn-app btn-flat"><i class="fa fa-bar-chart"></i> SKP</a>
				<a href="" class="btn btn-app btn-flat"><i class="fa fa-exchange"></i> MUTASI</a>
				<a href="<?= site_url('report/biodata/'.$nip); ?>" class="btn btn-app btn-flat" target="_BLANK"><i class="fa fa-print"></i> BIODATA</a>
				<a href="" class="btn btn-app btn-flat"><i class="fa fa-edit"></i> UBAH NIP</a>
			</div>
		</div>
		
		<!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			  <!--<li class="pull-left header"><i class="fa fa-info"></i> TABEL</li>-->
			  <li class="active"><a href="#data" data-toggle="tab">DATA</a></li>
              <li><a href="#pangkat" data-toggle="tab"><i class="fa fa-tags"></i></a></li>
              <li><a href="#jabatan" data-toggle="tab"><i class="fa fa-bank"></i></a></li>
			  <li><a href="#pendidikan" data-toggle="tab"><i class="fa fa-graduation-cap"></i></a></li>
			  <li><a href="#diklat" data-toggle="tab"><i class="fa fa-book"></i></a></li>
			  <li><a href="#keluarga" data-toggle="tab"><i class="fa fa-group"></i></a></li>
			  <li><a href="#jasa" data-toggle="tab"><i class="fa fa-certificate"></i></a></li>
			  <li><a href="#hukuman" data-toggle="tab"><i class="fa fa-gavel"></i></a></li>
			  <li><a href="#organisasi" data-toggle="tab"><i class="fa fa-flag"></i></a></li>
              <li><a href="#kgb" data-toggle="tab"><i class="fa fa-money"></i></a></li>
			  <li><a href="#cuti" data-toggle="tab"><i class="fa fa-coffee"></i></a></li>
			  <li><a href="#skp" data-toggle="tab"><i class="fa fa-bar-chart"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="data">
                <div class="row">
					<div class="col-md-4">
						<dl>
						<dt>CPNS</dt>
						<?php if(cpns($nip)): ?>
						<dd><?= cpns($nip)->sk.' ('.cpns($nip)->tglsk.')'; ?></dd>
						<dd><?= cpns($nip)->tglsk; ?></dd>
						<dd><?= gol(cpns($nip)->gol); ?></dd>
						<dd>
						<a class="btn btn-xs btn-flat btn-danger pull-right" data-toggle="tooltip" data-url="cpns" title="Hapus" href="<?= site_url('data/cpns/trash/'.$nip.'/'.cpns($nip)->id); ?>"><i class="glyphicon glyphicon-trash"></i></a>
						<a class="btn btn-xs btn-flat btn-info pull-right" data-toggle="tooltip" data-url="cpns" title="Upload"><i class="glyphicon glyphicon-upload"></i></a>
						</dd>
						<br>
						<?php endif; ?>
						<dt>PNS</dt>
						<?php if(pns($nip)): ?>
						<dd><?= pns($nip)->sk.' ('.pns($nip)->tglsk.')'; ?></dd>
						<dd><?= pns($nip)->tglsk; ?></dd>
						<dd><?= gol(pns($nip)->gol); ?></dd>
						<dd>
						<a class="btn btn-xs btn-flat btn-danger pull-right" data-toggle="tooltip" title="Hapus" href="<?= site_url('data/pns/trash/'.$nip.'/'.pns($nip)->id); ?>"><i class="glyphicon glyphicon-trash"></i></a>
						<a class="btn btn-xs btn-flat btn-info pull-right" data-toggle="tooltip" title="Upload"><i class="glyphicon glyphicon-upload"></i></a>
						</dd>
						<?php endif; ?>
						</dl>
					</div>
					
					<div class="col-md-4">
						<dl>
						<dt>KTP</dt>
						<dd><?= biodata($nip)->ktp; ?></dd>
						<dt>KARPEG</dt>
						<dd><?= biodata($nip)->karpeg; ?></dd>
						<dt>KARIS/KARSU</dt>
						<dd><?= biodata($nip)->karis; ?></dd>
						<dt>BPJS</dt>
						<dd><?= biodata($nip)->bpjs; ?></dd>
						<dt>NPWP</dt>
						<dd><?= biodata($nip)->npwp; ?></dd>
						</dl>
					</div>
					
					<div class="col-md-4">
						<dl>
						<dt>KEDUDUKAN</dt>
						<dd><?= kedudukan(biodata($nip)->kedudukan_id); ?></dd>
						<dt>STATUS</dt>
						<dd><?= status(biodata($nip)->status_id); ?></dd>
						<dt>JENIS</dt>
						<dd><?= jenis(biodata($nip)->jenis_id); ?></dd>
						</dl>
					</div>
				</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="pangkat">
                <table id="tableID1" class="table table-striped table-bordered responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="5px">NO</th>
							<th>GOLONGAN</th>
							<th>PANGKAT</th>
							<th>TMT</th>
							<th>NO.SK</th>
							<th>TGL.SK</th>
							<th width="60px"></th>
						</tr>
					</thead>
					<tbody>
						<?php if(pangkat($nip)): ?>
						<?php $no = 1; ?>
						<?php foreach(pangkat($nip) as $row): ?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= gol($row->gol); ?></td>
							<td><?= pkt($row->gol); ?></td>
							<td nowrap><?= $row->tmt; ?></td>
							<td><?= $row->sk; ?></td>
							<td nowrap><?= $row->tglsk; ?></td>
							<td>
								<a class="btn btn-xs btn-flat btn-info" onclick="#" href="" data-toggle="tooltip" title="Upload"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-xs btn-flat btn-warning" onclick="#" href="<?= site_url('data/pangkat/updated/'.$row->id); ?>" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-xs btn-flat btn-danger" href="<?= site_url('data/pangkat/trash/'.$nip.'/'.$row->id); ?>" data-toggle="tooltip" title="Hapus" onclick="#"><i class="glyphicon glyphicon-trash"></i></a></td>
						</tr>
						<?php $no++; ?>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="jabatan">
                <table class="table table-bordered table-striped" id="tableID2">
					<thead>
						<tr>
							<th width="5px">NO</th>
							<th>JABATAN</th>
							<th>TMT</th>
							<th>SATKER</th>
							<th>UNKER</th>
							<th>INSTANSI</th>
							<th width="60px"></th>
						</tr>
					</thead>
					<tbody>
						<?php if(jabatan($nip)): ?>
						<?php $no = 1; ?>
						<?php foreach(jabatan($nip) as $row): ?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $row->jabatan; ?></td>
							<td nowrap><?= $row->tmt; ?></td>
							<td><?= $row->satker; ?></td>
							<td><?= $row->unker; ?></td>
							<td><?= $row->instansi; ?></td>
							<td>
								<a class="btn btn-xs btn-flat btn-info" onclick="#" href="#" data-toggle="tooltip" title="Upload"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-xs btn-flat btn-warning" onclick="#" href="<?= site_url('data/jabatan/updated/'.$row->id); ?>" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-xs btn-flat btn-danger" href="<?= site_url('data/jabatan/trash/'.$nip.'/'.$row->id); ?>" data-toggle="tooltip" title="Hapus" onclick="#"><i class="glyphicon glyphicon-trash"></i></a></td>
						</tr>
						<?php $no++; ?>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
              </div>
              <!-- /.tab-pane -->
			  <div class="tab-pane" id="pendidikan">
                <table class="table table-bordered table-striped" id="tableID3">
					<thead>
						<tr>
							<th width="5px">NO</th>
							<th>PENDIDIKAN</th>
							<th>KTPU</th>
							<th>LULUS</th>
							<th>TEMPAT</th>
							<th>LOKASI</th>
							<th width="60px"></th>
						</tr>
					</thead>
					<tbody>
						<?php if(pendidikan($nip)): ?>
						<?php $no = 1; ?>
						<?php foreach(pendidikan($nip) as $row): ?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $row->jurusan; ?></td>
							<td><?= ktpu($row->ktpu); ?></td>
							<td><?= $row->tahun; ?></td>
							<td><?= $row->sekolah; ?></td>
							<td><?= $row->tempat; ?></td>
							<td>
								<a class="btn btn-xs btn-flat btn-info" onclick="#" href="#" data-toggle="tooltip" title="Upload"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-xs btn-flat btn-warning" onclick="#" href="<?= site_url('data/pendidikan/updated/'.$row->id); ?>" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-xs btn-flat btn-danger" href="<?= site_url('data/pendidikan/trash/'.$nip.'/'.$row->id); ?>" data-toggle="tooltip" title="Hapus" onclick="#"><i class="glyphicon glyphicon-trash"></i></a></td>
						</tr>
						<?php $no++; ?>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
              </div>
              <!-- /.tab-pane -->
			  <div class="tab-pane" id="diklat">
                <table class="table table-bordered table-striped" id="tableID4">
					<thead>
						<tr>
							<th width="5px">NO</th>
							<th>DIKLAT</th>
							<th>JENIS</th>
							<th>TANGGAL</th>
							<th>TEMPAT</th>
							<th>PELAKSANA</th>
							<th width="60px"></th>
						</tr>
					</thead>
					<tbody>
						<?php if(diklat($nip)): ?>
						<?php $no = 1; ?>
						<?php foreach(diklat($nip) as $row): ?>
						<?php
							switch($row->jenis){
								case '01':
									$jenis = 'STRUKTURAL';
									break;
								case '02':
									$jenis = 'FUNGSIONAL';
									break;
								default:
									$jenis = 'TEKNIS';
							}
						?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $row->diklat; ?></td>
							<td><?= $jenis; ?></td>
							<td><?= $row->akhir; ?></td>
							<td><?= $row->tempat; ?></td>
							<td><?= $row->panitia; ?></td>
							<td>
								<a class="btn btn-xs btn-flat btn-info" onclick="#" href="#" data-toggle="tooltip" title="Upload"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-xs btn-flat btn-warning" onclick="#" href="<?= site_url('data/diklat/updated/'.$row->id); ?>" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-xs btn-flat btn-danger" href="<?= site_url('data/diklat/trash/'.$nip.'/'.$row->id); ?>" data-toggle="tooltip" title="Hapus" onclick="#"><i class="glyphicon glyphicon-trash"></i></a></td>
						</tr>
						<?php $no++; ?>
						<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
	</div>
</div>