<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.club').addClass('active');
      $('.prestasi').addClass('active');
  	});

    function PreviewImage() {
        $('#photo-preview div').empty(); //menghilangkan div photo lama
        $('#photo div').html('<img id="uploadPreview" style="max-width:300px;" class="img-thumbnail" />'); // show photo
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
            document.getElementById("uploadPreview1").src = oFREvent.target.result;
        };
    };
</script>

<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-briefcase bg-c-blue"></i>
					<div class="d-inline">
						<h5>Prestasi</h5>
						<span>Berikut daftar para prestasi club.</span>
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
							<a href="<?= site_url('admin/prestasi-club') ?>">Prestasi</a>
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
							<h5>Data Prestasi</h5>
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
										<th width="100px">Gambar</th>
										<th width="100px">Tanggal</th>
										<th width="100px">Tim</th>
                                        <th width="100px">Hasil</th>
                                        <th>Keterangan</th>
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
        ajax: {"url": "<?= base_url() ?>admin/prestasi-club/json", "type": "POST"},
        columns: [
        {
            "data": "id",
            "orderable": false
        },
        {"data": "gambar","orderable": false,
        	render: function(data) { 
                if(data!==null) {
                  // return 'Tidak Ada Foto'
                  return '<img class="img-thumbnail" width="100%" height="100" src="<?= base_url('assets/assets/img/prestasi/') ?>'+data+'">' 
                } else {
                    return '<i>(Tidak ada foto)</i>'
                }},
              defaultContent: 'Gambar'
    	},
        {"data": "tgl"},
        {"data": "tim"},
        {"data": "hasil"},
        {"data": "keterangan",
            render: function(data) { 
                return '<p>'+data.substr(0,70)+'<br>'+data.substr(70,70)+'<br>'+data.substr(140,70)+'<br>'+data.substr(210,70)+'<br>'+data.substr(280,70)+'</p>'
            }
        },
        {"data": "view","orderable": false}
        ],
        order: [[2, 'desc']],
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
                url : '<?php echo site_url("admin/prestasi-club/hapus/'+id+'") ?>',
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
        $('#photo-preview div').empty();
        $('#photo div').html('<img id="uploadPreview" style="max-width:300px;" class="img-thumbnail" />'); // show photo
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Prestasi'); // Set Title to Bootstrap modal title
    }

    //fun edit
    function edit(id)
    {
        save_method = 'update';
        $('#photo div').empty();
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $.ajax({
	        url : '<?php echo site_url("admin/prestasi-club/edit/'+id+'") ?>',
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	            $('[name="id"]').val(data.id);
	            $('[name="tgl"]').val(data.tgl);
                $('[name="tim"]').val(data.tim);
                $('[name="hasil"]').val(data.hasil);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Data prestasi'); // Set title to Bootstrap modal title
                if(data.gambar)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img id="uploadPreview1" src="<?= base_url('assets/assets/img/prestasi/') ?>'+data.gambar+'" width="300px" class="img-thumbnail">'); // show photo
                    $('#photo-preview div').append('<br><hr><input type="checkbox" name="remove_photo" value="'+data.gambar+'"/> Hapus foto lama?'); // remove photo
                    
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

    //fun simpan
    function save()
    {
        refreshTokens();
	    $('#btnSave').text('saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable
	    var url;

	    if(save_method == 'add') {
	        url = "<?php echo site_url('admin/prestasi-club/tambah')?>";
	    } else {
	        url = "<?php echo site_url('admin/prestasi-club/update')?>";
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
                        <div class="row">
                            <input type="hidden" name="id">
                            <div class="col-md-6">
                            	<div class="form-group">
                                    <label >Tanggal</label>
                                    <input type="date" class="form-control" name="tgl">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Tim</label>
                                    <select name="tim" class="form-control">
                                        <option>Pilih Tim</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Hasil</label>
                                    <input type="text" class="form-control" name="hasil">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="4"></textarea>
                                        </textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Foto</label><br>
                                    <input id="uploadImage" type="file" name="gambar" onchange="PreviewImage();" class="form-control" />   
                                    <p style="font-size: 0.8em; padding: 5px;">JPG, JPEG, PNG - Max. 2MB</p>
                                </div>
                                <div class="form-group" id="photo-preview">
                                    <div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group" id="photo">
                                    <div>
                                        <img id="uploadPreview" style="max-width:300px;" class="img-thumbnail" />
                                        <span class="help-block"></span>
                                    </div>
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