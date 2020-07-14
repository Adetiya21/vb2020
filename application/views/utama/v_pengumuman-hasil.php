<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.pengumuman').addClass('menu-active');
      $('.info').addClass('menu-active');
    });
</script>

    <!--==========================
      Pengumuman Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Hasil Tes Calon Anggota</h2>
          <p>Berikut hasil tes calon anggota pada tanggal : <strong>
            <?php foreach ($jtes->result() as $key) {
             if ($id_jtes==$key->id) {
                echo date('d-m-Y', strtotime($key->tgl));
                }
            } ?></strong></p>
        </div>

        <div class="table-responsive ">
          <table id="compact" class="table table-hover" width="100%">
            <thead>
              <tr><th width="1%">No</th>
              <th>Nama Calon Anggota</th>
              <th>Posisi</th>
              <th width="100px">Keterangan</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <br><br>
      </div>
    </section><!-- #pengumuman -->

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
        ajax: {"url": "<?= base_url() ?>pengumuman_tes/json_hasil/<?= $id_jtes ?>", "type": "POST"},
        columns: [
        {
            "data": "id",
            "orderable": false
        },
        {"data": "nama_anggota"},
        {"data": "posisi"},
        {"data": "keterangan",
            render: function(data) { 
            if(data==='Belum Lulus') {
                  return '<label class="btn btn-sm btn-danger" style="width:100%; text-align:center">'+data+'</label>' 
                }
                else if(data==='Lulus') {
                  return '<label class="btn btn-sm btn-success" style="width:100%; text-align:center">'+data+'</label>' 
                } 
              },
              defaultContent: 'keterangan'        
        }
        ],
        order: [[1, 'asc']],
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

    function refreshTokens() {
        var url = "<?= base_url()."welcome/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }
</script>