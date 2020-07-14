<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>bower_components/jquery.steps/css/jquery.steps.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>assets/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
	  $('.club').addClass('active');
      $('.tentang').addClass('active');
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
						<h5>Informasi Tentang Club</h5>
						<span>Isi data informasi tentang club.</span>
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
							<a href="<?= site_url('admin/tentang-club') ?>">Tentang Club</a>
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
									<h5>Data Informasi Tentang Club</h5>	
									<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>				
								</div>
								<div class="card-block">
									<?= $this->session->flashdata('pesan'); ?>
			                        <?= $this->session->flashdata('error'); ?>
			                        <?php $arb = array('enctype' => "multipart/form-data", );?>
			                        <?= form_open('admin/tentang-club/proses',$arb); ?>
			                        <input type="hidden" class="form-control" value="<?= $tentang->id ?>" name="id">
				                        <div class="form-group row">
											<label class="col-sm-2 col-form-label">Nama Club</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?= $tentang->nama ?>" name="nama">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Logo Club</label>
											<div class="col-sm-10">
												<input id="uploadImage" class="form-control" type="file" name="gambar" onchange="PreviewImage();" value="<?= $tentang->gambar ?>" />
												<div class="form-group" id="photo-preview"></div>
								                <p class="help-block">PNG, JPG, JPEG -  Max. 2MB </p>
								                <img id="uploadPreview" style="max-width:300px; height:150px; border-radius: 10px; box-shadow: 0px 0px 3px 0px;" src="<?= base_url('assets/assets/img/logo/') ?><?= $tentang->gambar ?>" />
												<!-- <input type="file" class="form-control"> -->
											</div>
										</div>
			                        	<div class="form-group row">
											<label class="col-sm-2 col-form-label">Arti Logo Club</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="arti_logo" rows="5" id="editor1"><?= $tentang->arti_logo ?></textarea>
											</div>
										</div>
			                        	<div class="form-group row">
											<label class="col-sm-2 col-form-label">Sejarah Club</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="sejarah" rows="5" id="editor2"><?= $tentang->sejarah ?></textarea>
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

<!-- ckeditor -->
<script src="<?= base_url('assets/') ?>bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>