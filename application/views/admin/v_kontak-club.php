<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>bower_components/jquery.steps/css/jquery.steps.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>assets/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
	  $('.club').addClass('active');
      $('.kontak').addClass('active');
  	});

  	
    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }

    function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

		oFReader.onload = function (oFREvent) {
		  document.getElementById("uploadPreview").src = oFREvent.target.result;
		};
	};
</script>

<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-book bg-c-blue"></i>
					<div class="d-inline">
						<h5>Informasi Kontak Club</h5>
						<span>Isi data informasi kontak club.</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/kontak-club') ?>">Kontak Club</a>
						</li>
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
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h5>Data Informasi Kontak Club</h5>	
									<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>				
								</div>
								<div class="card-block">
									<?= $this->session->flashdata('pesan'); ?>
			                        <?= $this->session->flashdata('error'); ?>
			                        <?php $arb = array('enctype' => "multipart/form-data", );?>
			                        <?= form_open('admin/kontak-club/proses',$arb); ?>
			                        <input type="hidden" class="form-control" value="<?= $kontak->id ?>" name="id">
			                        	<div class="form-group row">
											<label class="col-sm-2 col-form-label">Email Club</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?= $kontak->email ?>" name="email">
											</div>
										</div>
			                        	<div class="form-group row">
											<label class="col-sm-2 col-form-label">No Telp Club</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?= $kontak->no_telp ?>" name="no_telp" maxlength="13" onkeypress='return check_int(event)'>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Facebook Club</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?= $kontak->facebook ?>" name="facebook">
											</div>
										</div>
										<div class="form-group row">
					                    	<label class="col-sm-2 col-form-label">Instagram Club</label>
					                    		<div class="col-sm-10 input-group">
					                        	<span class="input-group-prepend" id="basic-addon2">
					                          		<label class="input-group-text">@</label>
					                        	</span>
					                        	<input type="text" class="form-control" value="<?= $kontak->instagram ?>" name="instagram">
					                      	</div>
					                    </div>
					                    <div class="form-group row">
											<label class="col-sm-2 col-form-label">Alamat Sekertariat</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="alamat" rows="2"><?= $kontak->alamat ?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Tempat Latihan</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="tmp_latihan" rows="2"><?= $kontak->tmp_latihan ?></textarea>
											</div>
										</div>
										<hr>
										<div class="form-group row">
											<div class="col-sm-2">
												<button class="btn btn-primary m-b-0 btn-round" style="color: #fff"><i class="fa fa-edit"></i> Simpan Perubahan</abutton>
											</div>
										</div>
									<?= form_close(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>