<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.club').addClass('menu-active');
      $('.pelatih').addClass('menu-active');
    });
</script>

    <!--==========================
      Pelatih Section
    ============================-->
    <section id="team" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Daftar Pelatih</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>
        <div class="row">
          <?php foreach ($pelatih->result() as $key) {?>
          <div title="Detail" class="col-lg-3 col-md-6">
            <div class="member" style="box-shadow: 0 0 10px 0">
              <a href="javascript:void(0)" title="Detail <?= $key->nama ?>" onclick="detail(<?= $key->id ?>)">
              <div class="pic">
                <?php if ($key->gambar!==null) { ?>
                <img src="<?= base_url('assets/assets/img/pelatih/'.$key->gambar) ?>" alt="" style="width:280px; height: 300px;">
                <?php } else { echo "<< tidak ada gambar >>";} ?>
              </div>
              </a>
              <div class="details">
                <h4><?= $key->nama ?></h4>
                <span>Melatih Tim <?= $key->melatih ?></span>
                <hr>
                <div class="social">
                  <a href="tel:<?= $key->no_telp ?>"><i class="fa fa-phone"></i></a>
                  <a href="mailto:<?= $key->email ?>"><i class="fa fa-envelope"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <br><br>
      </div>
    </section><!-- #pelatih -->

<!-- page script -->
<script type="text/javascript">

    //fun detail
    function detail(id)
    {
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url : '<?php echo site_url("daftar_pelatih/detail/'+id+'") ?>',
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#nama').text(data.nama);
                $('#email').text(data.email);
                $('#no_telp').text(data.no_telp);
                $('#alamat').text(data.alamat);
                $('#melatih').text(data.melatih);
                $('#pengalaman').text(data.pengalaman);
                $('#modal_view').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Preview Pelatih'); // Set title to Bootstrap modal title
                if(data.gambar)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img id="uploadPreview1" src="<?= base_url('assets/assets/img/pelatih/') ?>'+data.gambar+'" style="max-width:210px;" class="img-thumbnail">'); // show photo   
                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(Tidak ada photo)');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function refreshTokens() {
        var url = "<?= base_url()."welcome/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }
</script>

<!--modal view -->
<div class="modal fade" id="modal_view" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="id">
                                <div class="form-group">
                                    <label ><strong>Nama Pelatih</strong></label><br>
                                    <span id="nama"></span>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>Email</strong></label><br>
                                    <span id="email"></span>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>No. Telp</strong></label><br>
                                    <span id="no_telp"></span>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>Alamat</strong></label><br>
                                    <span id="alamat"></span>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>Pengalaman Melatih</strong></label><br>
                                    <span style="text-align: justify;" id="pengalaman"></span>
                                    <span class="help-block"></span>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label ><strong>Melatih Tim</strong></label><br>
                                    <span id="melatih"></span>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>Foto</strong></label><br>
                                    <div class="form-group" id="photo-preview">
                                        <div class="col-md-9">
                                            (tidak ada foto)
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->