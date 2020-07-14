<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.pemain').addClass('menu-active');
      $('.club').addClass('menu-active');
    });
</script>

    <!--==========================
      Pemain Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Daftar Pemain</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="table-responsive ">
          <table id="compact" class="table table-hover" width="100%">
            <thead>
              <tr><th width="1%">No</th>
              <th width="150px">Foto</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Tinggi Badan</th>
              <th>Berat Badan</th>
              <th width="100px">Posisi</th>
              <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <br><br>
      </div>
    </section><!-- #pemain -->

<!-- DataTables -->
<script src="<?= base_url('assets/') ?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>datatables/js/dataTables.bootstrap.js"></script>

<script src="<?= base_url('assets/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/jszip.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>assets/pages/data-table/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var table = $('#compact').DataTable({
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "<?= base_url() ?>pemain/json", "type": "POST"},
        columns: [
        {
            "data": "id",
            "orderable": false
        },
        {"data": "gambar","orderable": false,
          render: function(data) { 
                if(data!==null) {
                  // return 'Tidak Ada Foto'
                  return '<img class="img-thumbnail" width="100%" height="150" src="<?= base_url('assets/assets/img/anggota/') ?>'+data+'">' 
                } else {
                    return '<i>(Tidak ada foto)</i>'
                }},
              defaultContent: 'Gambar'
      },
        {"data": "nama"},
        {"data": "jenkel"},
        {"data": "tinggi",
          render: function(data) {
            return data+' cm'
          }
        },
        {"data": "berat",
          render: function(data) {
            return data+' kg'
          }
        },
        {"data": "posisi",
          render: function(data) {
            if(data=='Server'){
              return '<span class="btn btn-danger btn-sm" style="width:100%">'+data+'</span>'
            } else if(data=='Spiker / Smasher'){
              return '<span class="btn btn-warning btn-sm" style="width:100%">'+data+'</span>'
            } else if(data=='Tosser / Set-Upper'){
              return '<span class="btn btn-success btn-sm" style="width:100%">'+data+'</span>'
            } else if(data=='Defender / Libero'){
              return '<span class="btn btn-info btn-sm" style="width:100%">'+data+'</span>'
            }
          }
        },
        {"data": "view","orderable": false}
        ],
        order: [[2, 'asc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    //fun reload
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    //fun view
    function view(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url : '<?php echo site_url("pemain/view/'+id+'") ?>',
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                var datePart = data.tgl_lahir.match(/\d+/g),
                year = datePart[0].substring(0), // get only four digits
                month = datePart[1], day = datePart[2];

                var ttgl =  day+'/'+month+'/'+year;
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="ttl"]').val(data.tmp_lahir+', '+ ttgl);
                $('[name="jenkel"]').val(data.jenkel);
                $('[name="tbb"]').val(data.tinggi+' cm - '+data.berat+' kg');
                $('[name="prestasi"]').val(data.prestasi);
                $('[name="motivasi"]').val(data.motivasi);
                $('[name="no_telp"]').val(data.no_telp);
                $('[name="alamat"]').val(data.alamat);
                $('[name="status"]').val(data.status);
                $('[name="posisi"]').val(data.posisi);
                $('[name="email"]').val(data.email);

                $('#nama').text(data.nama);
                $('#jenkel').text(data.jenkel);
                $('#no_telp').text(data.no_telp);
                $('#email').text(data.email);
                $('#posisi').text(data.posisi);
                $('#prestasi').text(data.prestasi);
                $('#motivasi').text(data.motivasi);
                if(data.gambar)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img id="uploadPreview1" src="<?= base_url('assets/assets/img/anggota/') ?>'+data.gambar+'" style="max-width:210px;" class="img-thumbnail">'); // show photo   
                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(Tidak ada photo)');
                }
                $('#modal_view').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Preview Data Pemain'); // Set title to Bootstrap modal title
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label ><strong>Nama</strong></label><br>
                                    <p id="nama"></p>
                                    <span class="help-block"></span>
                                </div> 
                                <div class="form-group">
                                    <label ><strong>Jenis Kelamin</strong></label>
                                    <p id="jenkel"></p>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>Email</strong></label>
                                    <p id="email"></p>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>No. Telp</strong></label>
                                    <p id="no_telp"></p>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label ><strong>Posisi</strong></label>
                                    <p id="posisi"></p>
                                    <span class="help-block"></span>
                                </div> 
                                <div class="form-group">
                                    <label ><strong>Prestasi Sebelumnya</strong></label>
                                    <p id="prestasi"></p>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label ><strong>Motivasi</strong></label>
                                    <p id="motivasi"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong>Foto</strong></label><br>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal