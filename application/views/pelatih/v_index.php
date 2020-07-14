<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.home').addClass('active');
	});
</script>

<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-home bg-c-blue"></i>
					<div class="d-inline">
						<h5>Dashboard Pelatih</h5>
						<span>Selamat Datang Pelatih <?= $this->session->userdata('nama')?></span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('pelatihan/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item"><a href="<?= site_url('pelatihan/home') ?>">Home</a> </li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">

						<div class="col-xl-6 col-md-6">
							<a href="<?= site_url('pelatihan/pengurus') ?>" class="card prod-p-card card-blue">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Pengurus</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $pengurus ?> <span style="font-size: 0.7em">Pengurus</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users text-c-blue f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-6 col-md-6">
							<a href="<?= site_url('pelatihan/pelatih') ?>" class="card prod-p-card card-yellow">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Pelatih</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $pelatih ?> <span style="font-size: 0.7em">Pelatih</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users text-c-yellow f-18"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						
						<div class="col-xl-6 col-md-6">
							<a href="<?= site_url('pelatihan/anggota/calon') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Calon Anggota</h6>
											<h3 class="f-w-700 text-c-blue"><?= $canggota ?> Orang</h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users bg-c-blue"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xl-6 col-md-6">
							<a href="<?= site_url('pelatihan/anggota') ?>" class="card comp-card">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-25">Total Pemain / Anggota</h6>
											<h3 class="f-w-700 text-c-yellow"><?= $anggota ?> Orang</h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-users bg-c-yellow"></i>
										</div>
									</div>
								</div>
							</a>
						</div>
						
						<div class="col-xl-6 col-md-12">
							<div class="card table-card">
								<div class="card-header">
									<h5>Calon Anggota Terbaru</h5>
									<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
								</div>
								<div class="card-block">
									<div class="">
										<table class="table table-responsive table-hover table-sm table-borderless">
											<thead>
												<tr>
													<th width="10px">No.</th>
													<th>Nama</th>
													<th>Posisi</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach ($cang->result() as $key) { ?>
												<tr><td align="center"><?= $no; ?></td>
													<td><?= $key->nama ?></td>
													<td width="100px"><label class="label label-sm label-danger" style="width:100%; text-align:center"><?= $key->posisi ?></label></td>
												</tr>
												<?php $no++; } ?>
											</tbody>	
										</table>
										<hr style="margin-top: 0">
										<div class="pull-right" style="padding-right: 20px;">
											<a href="<?= site_url('pelatihan/anggota/calon') ?>">Selengkapnya..</a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-md-12">
							<div class="card table-card">
								<div class="card-header">
									<h5>Jadwal Tes Terbaru</h5>
									<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
								</div>
								<div class="card-block">
									<div class="">
										<table class="table table-responsive table-hover table-sm table-borderless">
											<thead>
												<tr>
													<th width="10px">No.</th>
													<th>Pelatih</th>
													<th>Tanggal Tes</th>
													<th>Waktu Tes</th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach ($kjtes->result() as $key) { ?>
												<tr><td align="center"><?= $no; ?></td>
													<td><?= $key->nama ?></td>
													<td><?= date('d-m-Y', strtotime($key->tgl)) ?></td>
													<td width="100px"><?= $key->jam ?></td>
												</tr>
												<?php $no++; } ?>
											</tbody>	
										</table>
										<hr style="margin-top: 0">
										<div class="pull-right" style="right:0 ;padding-right: 20px;">
											<a href="<?= site_url('pelatihan/jadwal-tes') ?>">Selengkapnya..</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>