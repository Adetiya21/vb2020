<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.club').addClass('menu-active');
      $('.pengurus').addClass('menu-active');
    });
</script>

    <!--==========================
      Pengurus Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Pengurus</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5>Daftar Pengurus</h5>
                <hr>
                <div class="dt-responsive" style="font-size: 0.85em">
                  <table id="compact" class="table table-responsive table-sm table-hover" width="100%">
                    <thead>
                      <tr><th width="1%">No</th>
                      <th width="150px">Foto</th>
                      <th width="250px">Nama Pengurus</th>
                      <th>Posisi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
            </div>
            <div  class="col-md-6 table-responsive">
                <h5>Struktur Organisasi</h5>
                <hr>
                <div style="left: 0px; font-size: 0.72em" id="my_tree"></div>
            </div>
        </div>
        <br><br>
      </div>
    </section><!-- #pengurus -->



<link rel="stylesheet" href="<?= base_url('assets/front-end/struktur/') ?>lib/tree_maker-min.css">
<script type="text/javascript" src="<?= base_url('assets/front-end/struktur/') ?>lib/tree_maker-min.js"></script>
<!-- script structur -->
<script type="text/javascript">
    let tree = {
        1: {
            2: {
                3: {
                    4: {
                        5: {
                            8: {
                                9: '',
                            },
                        },
                        6: '',
                        7: {
                            10: '',
                        },
                    },
                },
            },
        },
    };

    let treeParams = {
        1: {trad: '<strong>Pemilik Club</strong><br><?php foreach ($pemilik->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        2: {trad: '<strong>Penasehat</strong><br><?php foreach ($penasehat->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        3: {trad: '<strong>Ketua</strong><br><?php foreach ($ketua->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        4: {trad: '<strong>Wakil Ketua</strong><br><?php foreach ($wketua->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        5: {trad: '<strong>Pelatih Kepala</strong><br><?php foreach ($pk->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        6: {trad: '<strong>Bagian Umum</strong><br><?php foreach ($bu->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        7: {trad: '<strong>Sekretaris</strong><br><?php foreach ($sekretaris->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        8: {trad: '<strong>Tim Pelatih</strong><br><?php foreach ($tp->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
        9: {trad: '<strong>Atlet</strong><br>'},
        10: {trad: '<strong>Bendahara</strong><br><?php foreach ($bendahara->result() as $key ) { echo $key->nama.'<br>'; } ?>'},
    };

    treeMaker(tree, {
        id: 'my_tree', card_click: function (element) {
            console.log(element);
        },
        treeParams: treeParams,
        'link_width': '3px',
        'link_color': '#0c2e8a',
    });
</script>

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
        ajax: {"url": "<?= base_url() ?>pengurus/json", "type": "POST"},
        columns: [
        {
            "data": "id",
            "orderable": false
        },
        {"data": "gambar","orderable": false,
            render: function(data) { 
                if(data!==null) {
                  // return 'Tidak Ada Foto'
                  return '<img class="img-thumbnail" width="100%" height="100" src="<?= base_url('assets/assets/img/pengurus/') ?>'+data+'">' 
                } else {
                    return '<i>(Tidak ada foto)</i>'
                }},
              defaultContent: 'Gambar'
        },
        {"data": "nama"},
        {"data": "posisi",
            render: function(data) { 
                return '<label class="label label-sm label-success" style="width:100%">'+data+'</label>'
            },
            defaultContent: 'posisi'
        }
        ],
        order: [[0, 'asc']],
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
