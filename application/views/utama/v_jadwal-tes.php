<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.jadwal-tes').addClass('menu-active');
      $('.info').addClass('menu-active');
    });
</script>

    <!--==========================
      Jadwal Tes Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Jadwal Tes Calon Anggota</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="card-block">
          <div class="dt-responsive table-responsive">
            <table id="compact" class="table table-hover" width="100%">
              <thead>
                <tr><th width="1%">No</th>
                <th>Pelatih</th>
                <th>Tanggal Tes</th>
                <th>Waktu Tes</th>
                <th>Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <br><br>
      </div>
    </section><!-- #jadwal tes -->

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
        ajax: {"url": "<?= base_url() ?>jadwal_tes/json", "type": "POST"},
        columns: [
        {
            "data": "id",
            "orderable": false
        },
        {"data": "nama"},
        {"data": "tgl",
          render: function(data) {
                var datePart = data.match(/\d+/g),
                year = datePart[0].substring(0), // get only four digits
                month = datePart[1], day = datePart[2];

                var ttgl =  day+'/'+month+'/'+year;
                return ttgl;
            },
            defaultContent: 'tgl'
      },
        {"data": "jam"},
        {"data": "status",
          render: function(data) { 
                if(data==='Belum Selesai') {
                  return '<label class="btn btn-sm btn-warning" style="width:100%; text-align:center">Belum Selesai</label>' 
                }
                else if(data==='Selesai') {
                  return '<label class="btn btn-sm btn-success" style="width:100%; text-align:center">Selesai</label>' 
                } 
              },
              defaultContent: 'status'
            
        },
        // {"data": "view","orderable": false}
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