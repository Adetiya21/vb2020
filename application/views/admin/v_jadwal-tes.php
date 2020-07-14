<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
   	  $('.jadwal').addClass('active');
      $('.jadwal-tes').addClass('active');
  	});
</script>

<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-briefcase bg-c-blue"></i>
					<div class="d-inline">
						<h5>Jadwal Tes Calon Anggota</h5>
						<span>Berikut daftar jadwal tes calon anggota club.</span>
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
							<a href="<?= site_url('admin/jadwal-tes') ?>">Jadwal Tes</a>
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
					<div class="card">
						<div class="card-header">
							<h5>Data Jadwal Tes</h5>
                            <div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
						</div>
						<div style="position: absolute;right: 20px; top: 15px;">
							<button class="btn btn-primary btn-round" onclick="tambah()"><span class="fa fa-edit"></span> Input Data</button>	
						</div>
						
						<div class="card-block">
							<div class="dt-responsive">
								<table id="compact" class="table table-responsive table-bordered table-hover nowrap" width="100%">
									<thead>
										<tr><th width="1%">No</th>
										<th>Pelatih</th>
										<th>Tanggal Tes</th>
										<th>Waktu Tes</th>
										<th>Status</th>
                                        <th width="10%">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
        ajax: {"url": "<?= base_url() ?>admin/jadwal_tes/json", "type": "POST"},
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
            defaultContent: 'Gambar'
    	},
        {"data": "jam"},
        {"data": "status",
    		render: function(data) { 
                if(data==='Belum Selesai') {
                  return '<label class="label label-lg label-inverse-warning" style="width:100%; text-align:center">Belum Selesai</label>' 
                }
                else if(data==='Selesai') {
                  return '<label class="label label-lg label-inverse-info" style="width:100%; text-align:center">Selesai</label>' 
                } 
              },
              defaultContent: 'status'
            
      	},
        {"data": "view","orderable": false}
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

    //Fun Hapus
    function hapus(id)
    {
        if(confirm('Anda yakin ingin menghapus data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : '<?php echo site_url("admin/jadwal_tes/hapus/'+id+'") ?>',
                type: "POST",
                dataType: "JSON",
                data: { <?= $this->security->get_csrf_token_name(); ?> : function () {
                  refreshTokens();
                  return $( "#csrfHash" ).val();
              }},
              success: function(data)
              {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Data Gagal Dihapus, Data Mungkin Sedang Digunakan');
                }
            });
        }
    }

    //fun tambah
    function tambah()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Jadwal Tes'); // Set Title to Bootstrap modal title
    }

    //fun edit
    function edit(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $.ajax({
	        url : '<?php echo site_url("admin/jadwal_tes/edit/'+id+'") ?>',
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	            $('[name="id"]').val(data.id);
	            $('[name="id_pelatih"]').val(data.id_pelatih);
                $('[name="tgl"]').val(data.tgl);
                $('[name="jam_mulai"]').val(data.jam_mulai);
                $('[name="jam_selesai"]').val(data.jam_selesai);
                $('[name="status"]').val(data.status);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Data Jadwal Tes'); // Set title to Bootstrap modal title
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

    //fun simpan
    function save()
    {
        refreshTokens();
	    $('#btnSave').text('saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable
	    var url;

	    if(save_method == 'add') {
	        url = "<?php echo site_url('admin/jadwal_tes/tambah')?>";
	    } else {
	        url = "<?php echo site_url('admin/jadwal_tes/update')?>";
	    }
	    // ajax adding data to database
	    var formData = new FormData($('#form')[0]);
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: formData,
	        contentType: false,
	        processData: false,
	        dataType: "JSON",

	        success: function(data)
	        {
	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#modal_form').modal('hide');
	                reload_table();
	            } else
	            {
	                for (var i = 0; i < data.inputerror.length; i++)
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable
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

<!--modal tambah dan edit -->
<div class="modal fade" id="modal_form" role="dialog">
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
                    	<input type="hidden" name="id">
                    	<div class="row">
                    		<div class="col-md-4">
                    			<div class="form-group">
		                            <label >Nama Pelatih</label>
		                            <select name="id_pelatih" class="form-control">
		                            	<option>Pilih Pelatih</option>
		                            	<?php foreach ($pelatih->result() as $key) { ?>
		                            	<option value="<?= $key->id ?>"><?= $key->nama ?></option>
		                                <?php } ?>
		                            </select>
		                            <span class="help-block"></span>
		                        </div>
		                        <div class="form-group">
		                            <label >Tanggal Tes</label>
		                            <input type="date" class="form-control" name="tgl">
		                            <span class="help-block"></span>
		                        </div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="form-group">
		                            <label >Jam Mulai Tes</label>
		                            <input type="time" class="form-control" name="jam_mulai">
		                            <span class="help-block"></span>
		                        </div>
		                        <div class="form-group">
		                            <label >Jam Selesai Tes</label>
		                            <input type="time" class="form-control" name="jam_selesai">
		                            <span class="help-block"></span>
		                        </div>
                    		</div>
                    		<div class="col-md-4">
                    			<div class="form-group">
		                            <label >Status </label>
		                            <select name="status" class="form-control">
		                            	<option>Pilih Status</option>
		                            	<option value="Belum Selesai">Belum Selesai</option>
		                            	<option value="Selesai">Selesai</option>
		                            </select>
		                            <span class="help-block"></span>
		                        </div>  
                    		</div>
                    	</div>                      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-edit "></i> Simpan</button>
                </div>
                <div class="pull-left">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal