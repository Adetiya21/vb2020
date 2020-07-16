<script>
    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    };

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

  <main id="main">
    <!--==========================
      Akun Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Biodata</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <?= $this->session->flashdata('pesan'); ?>
        <?= $this->session->flashdata('error'); ?>
        <?php $arb = array('enctype' => "multipart/form-data", );?>
        <?= form_open('akun/proses',$arb); ?>
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" name="id" value="<?= $profil->id ?>">
                    <div class="form-group">
                        <label >Nama</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?= $profil->nama ?>" required/>
                        <span class="help-block"></span>
                    </div> 
                    <div class="form-group">
                        <label >Tempat / Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" placeholder="Tempat" name="tmp_lahir" value="<?= $profil->tmp_lahir ?>" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-7">
                                <input type="date" name="tgl_lahir" class="form-control" value="<?= $profil->tgl_lahir ?>" required/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Jenis Kelamin</label>
                        <select name="jenkel" class="form-control" value="<?= $profil->jenkel ?>" required>
                            <option>Pilih Jenis Kelamin</option>
                            <?php if ($profil->jenkel=='Laki-Laki') {
                                echo '<option value="Laki-Laki" selected>Laki-Laki</option>
                                      <option value="Perempuan">Perempuan</option>';
                            } else { 
                                echo '<option value="Laki-Laki">Laki-Laki</option>
                                      <option value="Perempuan" selected>Perempuan</option>';
                            }?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label >Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Alamat Sekarang" rows="3"><?= $profil->alamat ?></textarea>
                        <span class="help-block"></span>
                    </div>                                
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >Tinggi / Berat Badan</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Tinggi" name="tinggi" value="<?= $profil->tinggi ?>" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-6">
                                <input type="number" placeholder="Berat" name="berat" class="form-control" value="<?= $profil->berat ?>" required/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Posisi</label>
                        <select name="posisi" class="form-control" value="<?= $profil->posisi ?>" required>
                            <option>Pilih Posisi</option>
                            <?php if ($profil->posisi=='Server') {
                                echo '<option value="Server" selected>Server</option>
                                <option value="Spiker / Smasher">Spiker / Smasher</option>
                                <option value="Tosser / Set-Upper">Tosser / Set-Upper</option>
                                <option value="Defender / Libero">Defender / Libero</option>';
                            } else if ($profil->posisi=='Spiker / Smasher') { 
                                echo '<option value="Server">Server</option>
                                <option value="Spiker / Smasher" selected>Spiker / Smasher</option>
                                <option value="Tosser / Set-Upper">Tosser / Set-Upper</option>
                                <option value="Defender / Libero">Defender / Libero</option>';
                            } else if ($profil->posisi=='Tosser / Set-Upper') { 
                                echo '<option value="Server">Server</option>
                                <option value="Spiker / Smasher">Spiker / Smasher</option>
                                <option value="Tosser / Set-Upper" selected>Tosser / Set-Upper</option>
                                <option value="Defender / Libero">Defender / Libero</option>';
                            } else if ($profil->posisi=='Defender / Libero') { 
                                echo '<option value="Server">Server</option>
                                <option value="Spiker / Smasher">Spiker / Smasher</option>
                                <option value="Tosser / Set-Upper">Tosser / Set-Upper</option>
                                <option value="Defender / Libero" selected>Defender / Libero</option>';
                            } ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label >Prestasi</label>
                        <textarea name="prestasi" class="form-control" placeholder="Prestasi Sebelumnya" rows="3"><?= $profil->prestasi ?></textarea>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label >Motivasi</label>
                        <textarea name="motivasi" class="form-control" placeholder="Motivasi Bergabung" rows="3"><?= $profil->motivasi ?></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >No. Telp</label>
                        <input type="text" class="form-control" placeholder="No.Telp" name="no_telp" value="<?= $profil->no_telp ?>" required maxlength="13" onkeypress='return check_int(event)'/>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">  
                        <label >Foto</label>                                  
                        <input id="uploadImage" type="file" name="gambar" onchange="PreviewImage();" class="form-control" />   
                        <p style="font-size: 0.8em; padding: 5px;">JPG, JPEG, PNG - Max. 2MB</p>
                        <?php if ($profil->gambar==null) {
                            echo "((tidak ada foto))";
                        } else {?>
                        <div class="form-group" id="photo-preview">
                            <div>
                            <input type="checkbox" name="remove_photo" value="<?= $profil->gambar ?>"/> Hapus foto lama?
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo">
                            <div>
                            <img id="uploadPreview" style="max-width:210px;" class="img-thumbnail" src="<?= base_url('assets/assets/img/anggota/'.$profil->gambar) ?>" />
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <h5>Akun Login</h5>
                  <div class="row">
                    <div class="col-md-6 form-group wow fadeInLeft">
                        <label >Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $profil->email ?>" required />
                        <span class="help-block"></span>
                    </div>
                    <div class="col-md-6 form-group wow fadeInRight">
                        <label >Password</label>
                        <input type="password" class="form-control" placeholder="Isi kembali password lama / baru anda" name="password" required />
                        <span class="help-block"></span>
                    </div><br>
                    <hr><br>
                  </div>
                </div>
            </div>
            <hr>
            <div class="text-center"><button type="submit" class="btn btn-success btn-lg"><span class="fa fa-edit"></span> Simpan Data</button></div>
          <?php form_close(); ?>
      </div>
    </section><!-- #akun -->
    <br><br>
  </main>