<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.profil').addClass('active');
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
      <div class="col-lg-9">
        <div class="page-header-title">
          <i class="feather icon-user bg-c-blue"></i>
          <div class="d-inline">
            <h5>Profil</h5>
            <span>Lengkapi data diri anda.</span>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="page-header-breadcrumb">
          <ul class=" breadcrumb breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="<?= site_url('vendor/home') ?>"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item">
              <a href="<?= site_url('vendor/home/profil') ?>">Profil</a>
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
                  <h5>Data Profil</h5>
                  <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
                </div>
                <div class="card-block" data-intro="This is Card body" data-step="2" data-hint="Hello step osne!">
                  <!-- <form id="main" method="post" action="https://colorlib.com/" novalidate> -->
                  <?= $this->session->flashdata('pesan'); ?>
                  <?= $this->session->flashdata('error'); ?>
                  
                    <?php $arb = array('enctype' => "multipart/form-data", );?>
                    <?= form_open('pelatih/home/edit_profil',$arb); ?>
                              
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" value="<?= $profil->email ?>" name="email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="Masukkan Password Lama / Baru" name="password">
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <input type="hidden" class="form-control" value="<?= $profil->id ?>" name="id">
                      <label class="col-sm-3 col-form-label">Nama Pelatih</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?= $profil->nama ?>" name="nama" selected>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No.Telp</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?= $profil->no_telp ?>" maxlength="13"  name="no_telp" onkeypress='return check_int(event)'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="alamat"><?= $profil->alamat ?>
                        </textarea> 
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Pengalaman Melatih</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="pengalaman"><?= $profil->pengalaman ?>
                        </textarea> 
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Melatih Tim</label>
                      <div class="col-sm-9">
                        <select name="melatih" class="form-control">
                          <?php if ($profil->melatih=='Pria') {
                            echo '<option value="Pria" selected>Tim Pria</option>
                                  <option value="Wanita">Tim Wanita</option>';
                          } else if ($profil->melatih=='Wanita') {
                            echo '<option value="Pria">Tim Pria</option>
                                  <option value="Wanita" selected>Tim Wanita</option>';
                          }?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Foto</label>
                      <div class="col-sm-9">
                        <input id="uploadImage" class="form-control" type="file" name="gambar" onchange="PreviewImage();" value="<?= $profil->gambar ?>" />
                        <div class="form-group" id="photo-preview"></div>
                          <p class="help-block">JPG, JPEG, PNG, Max. 2MB</p>
                          <img id="uploadPreview" style="max-width: 350px; border-radius: 10px; box-shadow: 0px 0px 3px 0px;" src="<?= base_url('assets/assets/img/pelatih/') ?><?= $profil->gambar ?>" />
                      </div>
                    </div>
                    <hr>
                    
                    
                    <div class="form-group row">
                      <!-- <label class="col-sm-2"></label> -->
                      <div class="col-sm-2">
                        <button class="btn btn-primary m-b-0 btn-round" style="color: #fff"><i class="fa fa-edit"></i> Edit Data</abutton>
                      </div>
                    </div>
                  <!-- </form> -->
                  <?= form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div id="styleSelector">
    </div>
  </div>
</div>