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
      Daftar Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Daftar Anggota Club</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
          <hr>
          <span>* : Wajib diisi.</span>
        </div>

        <?= $this->session->flashdata('pesan'); ?>
        <?= $this->session->flashdata('error'); ?>
        <?php $arb = array('enctype' => "multipart/form-data", );?>
        <?= form_open('daftar/proses',$arb); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label >Nama*</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required/>
                        <span class="help-block"></span>
                    </div> 
                    <div class="form-group">
                        <label >Tempat / Tanggal Lahir*</label>
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" placeholder="Tempat" name="tmp_lahir" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-7">
                                <input type="date" name="tgl_lahir" class="form-control" required/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Jenis Kelamin*</label>
                        <select name="jenkel" class="form-control" required>
                            <option>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label >Alamat*</label>
                        <textarea name="alamat" class="form-control" placeholder="Alamat Sekarang" rows="3"></textarea>
                        <span class="help-block"></span>
                    </div>                                
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >Tinggi / Berat Badan</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Tinggi" name="tinggi" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-6">
                                <input type="number" placeholder="Berat" name="berat" class="form-control" required/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Posisi*</label>
                        <select name="posisi" class="form-control" required>
                            <option>Pilih Posisi</option>
                            <option value="Server">Server</option>
                            <option value="Spiker / Smasher">Spiker / Smasher</option>
                            <option value="Tosser / Set-Upper">Tosser / Set-Upper</option>
                            <option value="Defender / Libero">Defender / Libero</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label >Prestasi</label>
                        <textarea name="prestasi" class="form-control" placeholder="Prestasi Sebelumnya" rows="3"></textarea>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label >Motivasi*</label>
                        <textarea name="motivasi" class="form-control" placeholder="Motivasi Bergabung" rows="3"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label >No. Telp*</label>
                        <input type="text" class="form-control" placeholder="No.Telp" name="no_telp" required maxlength="13" onkeypress='return check_int(event)'/>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">  
                        <label >Foto</label>                                  
                        <input id="uploadImage" type="file" name="gambar" onchange="PreviewImage();" class="form-control" />   
                        <p style="font-size: 0.8em; padding: 5px;">JPG, JPEG, PNG - Max. 2MB</p>
                        <div class="form-group" id="photo-preview">
                            <div>
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo">
                            <div>
                            <img id="uploadPreview" style="max-width:210px;" class="img-thumbnail" />
                            <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <h5>Akun Login</h5>
                  <div class="row">
                    <div class="col-md-6 form-group wow fadeInLeft">
                        <label >Email*</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" required />
                        <span class="help-block"></span>
                    </div>
                    <div class="col-md-6 form-group wow fadeInRight">
                        <label >Password*</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required />
                        <span class="help-block"></span>
                    </div><br>
                    <hr><br>
                  </div>
                </div>
            </div>
            <hr>
            <div class="text-center"><button type="submit" class="btn btn-success btn-lg"><span class="fa fa-edit"></span> Kirim Data</button></div>
          <?php form_close(); ?>
      </div>
    </section><!-- #daftar -->
    <br><br>
  </main>