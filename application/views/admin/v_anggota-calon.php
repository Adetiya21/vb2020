<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.anggota').addClass('active');
      $('.anggota-calon').addClass('active');
  	});

  	function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    };

    function PreviewImage() {
        $('#photo-preview div').empty();
        $('#photo div').html('<img id="uploadPreview" style="max-width:210px;" class="img-thumbnail" />'); // show photo
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
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-users bg-c-blue"></i>
					<div class="d-inline">
						<h5>Calon Anggota</h5>
						<span>Berikut daftar para calon anggota.</span>
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
							<a href="<?= site_url('admin/anggota/calon') ?>">Calon Anggota</a>
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
							<h5>Data Calon Anggota</h5>
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
										<th>Nama</th>
										<th>Posisi</th>
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
        ajax: {"url": "<?= base_url() ?>admin/anggota/json_calon", "type": "POST"},
        columns: [
        {
            "data": "id",
            "orderable": false
        },
        {"data": "gambar","orderable": false,
        	render: function(data) { 
                if(data!==null) {
                  // return 'Tidak Ada Foto'
                  return '<img class="img-thumbnail" width="100%" height="100" src="<?= base_url('assets/assets/img/anggota/') ?>'+data+'">' 
                } else {
                    return '<i>(Tidak ada foto)</i>'
                }},
              defaultContent: 'Gambar'
    	},
        {"data": "nama"},
        {"data": "posisi"},
        {"data": "status"},
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

    //Fun Hapus
    function hapus(id)
    {
        if(confirm('Anda yakin ingin menghapus data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : '<?php echo site_url("admin/anggota/hapus/'+id+'") ?>',
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
        $('#photo div').html('<img id="uploadPreview" style="max-width:210px;" class="img-thumbnail" />'); // show photo
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Anggota'); // Set Title to Bootstrap modal title
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
            url : '<?php echo site_url("admin/anggota/edit/'+id+'") ?>',
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="prestasi"]').val(data.prestasi);
                $('[name="motivasi"]').val(data.motivasi);
                $('[name="no_telp"]').val(data.no_telp);
                $('[name="alamat"]').val(data.alamat);
                $('[name="status"]').val(data.status);
                $('[name="posisi"]').val(data.posisi);
                $('[name="tmp_lahir"]').val(data.tmp_lahir);
                $('[name="tgl_lahir"]').val(data.tgl_lahir);
                $('[name="jenkel"]').val(data.jenkel);
                $('[name="tinggi"]').val(data.tinggi);
                $('[name="berat"]').val(data.berat);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Anggota'); // Set title to Bootstrap modal title
                if(data.gambar)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img id="uploadPreview1" src="<?= base_url('assets/assets/img/anggota/') ?>'+data.gambar+'" style="max-width:210px;" class="img-thumbnail">'); // show photo
                    $('#photo-preview div').append('<br><br><input type="checkbox" name="remove_photo" value="'+data.gambar+'"/> Hapus foto lama?'); // remove photo
                    
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

    //fun view
    function view(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url : '<?php echo site_url("admin/anggota/edit/'+id+'") ?>',
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
                $('.modal-title').text('Preview Data Anggota'); // Set title to Bootstrap modal title
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
            url = "<?php echo site_url('admin/anggota/tambah')?>";
        } else {
            url = "<?php echo site_url('admin/anggota/update')?>";
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama" required/>
                                    <span class="help-block"></span>
                                </div> 
                                <div class="form-group">
                                    <label >Tempat / Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Tempat" name="tmp_lahir" required/>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="date" name="tgl_lahir" class="form-control" required/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label >Jenis Kelamin</label>
                                    <select name="jenkel" class="form-control" required>
                                        <option>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
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
                                    <label >Alamat</label>
                                    <textarea name="alamat" class="form-control" placeholder="Alamat Sekarang" rows="3"></textarea>
                                    <span class="help-block"></span>
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" required />
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >No. Telp</label>
                                    <input type="text" class="form-control" placeholder="No.Telp" name="no_telp" required maxlength="13" onkeypress='return check_int(event)'/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Posisi</label>
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
                                    <label >Motivasi</label>
                                    <textarea name="motivasi" class="form-control" placeholder="Motivasi Bergabung" rows="3"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Foto</label><br>
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
                                <div class="form-group">
                                    <hr>
                                    <label >Status</label>
                                    <select name="status" class="form-control form-control-primary">
                                        <option value="Calon Anggota">Calon Anggota</option>
                                        <option value="Anggota">Anggota</option>
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
</div><!-- /.modal -->

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
                                    <label >Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama" required readonly/>
                                    <span class="help-block"></span>
                                </div> 
                                <div class="form-group">
                                    <label >Tempat / Tanggal Lahir</label>
                                    <input type="text" class="form-control" placeholder="Tempat / Tanggal Lahir" name="ttl" required readonly/>
                                    <span class="help-block"></span>
                                </div>  
                                <div class="form-group">
                                    <label >Jenis Kelamin</label>
                                    <input type="text" class="form-control" placeholder="Jenis Kelamin" name="jenkel" required readonly/>
                                    <span class="help-block"></span>
                                </div> 
                                <div class="form-group">
                                    <label >Tinggi dan Berat Badan</label>
                                    <input type="text" class="form-control" placeholder="Tinggi dan Berat Badan" name="tbb" required readonly/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Alamat Sekarang</label>
                                    <textarea name="alamat" class="form-control" cols="30" rows="3" readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Posisi</label>
                                    <input type="text" class="form-control" placeholder="Posisi" name="posisi" required readonly/>
                                    <span class="help-block"></span>
                                </div> 
                                <div class="form-group">
                                    <label >Prestasi Sebelumnya</label>
                                    <textarea name="prestasi" class="form-control" cols="30" rows="3" readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Motivasi</label>
                                    <textarea name="motivasi" class="form-control" cols="30" rows="3" readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >No. Telp</label>
                                    <input type="text" class="form-control" placeholder="No.Telp" name="no_telp" required maxlength="13" onkeypress='return check_int(event)' readonly/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label><br>
                                    <div class="form-group" id="photo-preview">
                                        <div class="col-md-9">
                                            (tidak ada foto)
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label >Status</label>
                                    <input type="text" class="form-control form-control-primary" placeholder="Status" name="status" required readonly/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" required  readonly/>
                                    <span class="help-block"></span>
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
</div><!-- /.modal