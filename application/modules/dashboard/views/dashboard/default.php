<div class="row">
	<div class="col-md-12">
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
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-lg-4 col-xs-12">
						<div class="small-box bg-aqua">
							<div class="inner">
							<h3><?= $people ? number_format(count($people)) : 0; ?></h3>
							<p>Pegawai Aktif</p>
							</div>
							<div class="icon">
							<i class="ion ion-ios-people"></i>
							</div>
							<a href="#" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-4 col-xs-12">
						<div class="small-box bg-yellow">
							<div class="inner">
							<h3><?= $male ? number_format(count($male)) : 0; ?></h3>
							<p>Laki-Laki</p>
							</div>
							<div class="icon">
							<i class="ion ion-male"></i>
							</div>
							<a href="#" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-4 col-xs-12">
						<div class="small-box bg-red">
							<div class="inner">
							<h3><?= $female ? number_format(count($female)) : 0; ?></h3>
							<p>Perempuan</p>
							</div>
							<div class="icon">
							<i class="ion ion-female"></i>
							</div>
							<a href="#" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<?php if($informasi): ?>
					<ul class="timeline">
						<?php foreach($informasi as $row): ?>
						<li class="time-label">
							<span class="bg-red">
								<?= ddmmyyyy($row->tanggal); ?>
							</span>
						</li>
						<!-- /.timeline-label -->
						<!-- timeline item -->
						<li>
							<!-- timeline icon -->
							<i class="fa fa-envelope bg-blue"></i>
							<div class="timeline-item bg-gray">
								<span class="time"><i class="fa fa-clock-o"></i> &nbsp</span>

								<h3 class="timeline-header"><?= $row->judul; ?></h3>

								<div class="timeline-body">
									<?= $row->informasi; ?>
								</div>

								<!-- <div class="timeline-footer">
									<a class="btn btn-primary btn-xs"></a>
								</div> -->
							</div>
						</li>
						<?php endforeach; ?>
						<li>
						<i class="fa fa-clock-o bg-gray"></i>
						</li>
						<!-- END timeline item -->
					</ul>
					<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			
			<div class="box-footer">
				<div class="row">
					<div class="col-md-12">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>