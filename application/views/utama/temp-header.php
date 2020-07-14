<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $title ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?= base_url('assets/front-end/') ?>img/favicon.ico" rel="icon">
  <link href="<?= base_url('assets/front-end/') ?>img/apple-touch-icon.icon" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?= base_url('assets/front-end/') ?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?= base_url('assets/front-end/') ?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/front-end/') ?>lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/front-end/') ?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/front-end/') ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/front-end/') ?>lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="<?= base_url('assets/front-end/') ?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?= base_url('assets/front-end/') ?>css/style.css" rel="stylesheet">

  <!-- Recapcha -->
  <?=  $this->recaptcha->getScriptTag(); ?>
</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <?php $kon = $this->DButama->GetDB('tb_kontak')->row(); ?>
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
      	<a href="<?= $kon->facebook ?>" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="<?= $kon->instagram ?>" class="instagram"><i class="fa fa-instagram"></i></a>
        <i class="fa fa-envelope-o"></i> <a href="mailto:<?= $kon->email ?>"><?= $kon->email ?></a>
        <i class="fa fa-phone"></i> <a href="tel:<?= $kon->no_telp ?>"><?= $kon->no_telp ?></a>
      </div>
      <div class="contact-info float-right">
        <?php if ($this->session->userdata('user_logged_in') == 'Sudah_Loggin') {
            ?>
            <div class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><strong> <?php echo $this->session->userdata('nama');  ?></strong> <b class="caret"></b></a>
                <ul class="dropdown-menu" style="width: 100px;padding: 15px; font-size: 1em">
                    <li><a href="<?php echo site_url('akun/i/'.$this->session->userdata('id')); ?>"><i class="fa fa-user"></i> Akun</a>
                    </li>
                    <li style="margin-top: 10px;"><a href="<?php echo site_url('logout'); ?>"><i class="fa fa-sign-in"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <?php
        }else{ ?>
        <a href="javascript:void(0)" onclick="login()"><span class="text-uppercase"><i class=" fa fa-sign-in"></i> <span class="text-uppercase">Login</span></a>
        <a href="<?= site_url('daftar') ?>"><span class="text-uppercase"><i class=" fa fa-user" style="padding-left: 25px;margin-left: 20px;border-left: 1px solid #e9e9e9;"></i> Daftar</span></a>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php $ten = $this->DButama->GetDB('tb_club')->row(); ?>
  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
         <a href="<?= site_url() ?>"><img src="<?= base_url('assets/assets/img/logo/'.$ten->gambar) ?>" alt="" title="" style="width:110px;margin-top: -10px" /></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="home"><a href="<?= site_url() ?>">Home</a></li>
          <li class="prestasi"><a href="<?= site_url('prestasi-club') ?>">Prestasi</a></li>
          <li class="club menu-has-children"><a href="javascript:void(0)">Club</a>
            <ul>
              <li class="sejarah"><a href="<?= site_url('sejarah') ?>">Sejarah dan Arti Logo Club</a></li>
          	  <li class="pelatih"><a href="<?= site_url('daftar-pelatih') ?>">Daftar Pelatih</a></li>
              <li class="pemain"><a href="<?= site_url('pemain') ?>">Daftar Pemain</a></li>
              <li class="pengurus"><a href="<?= site_url('pengurus') ?>">Stuktur Pengurus</a></li>
            </ul>
          </li>
          <li class="info menu-has-children"><a href="javascript:void(0">Info</a>
            <ul>
            <?php if ($this->session->userdata('user_logged_in') == 'Sudah_Loggin') { ?>
              <li class="jadwal-tes"><a href="<?= site_url('jadwal-tes') ?>">Jadwal Tes</a></li>
              <li class="pengumuman"><a href="<?= site_url('pengumuman-tes') ?>">Pengumuman Hasil Tes</a></li>
	        <?php } ?>
              <!-- <li><a href="<?= site_url('tempat-latihan') ?>">Tempat Latihan</a></li> -->
              <li class="jadwal-latihan"><a href="<?= site_url('jadwal-latihan') ?>">Jadwal Latihan</a></li>
            </ul>
          </li>
          <li class="kontak"><a href="<?= site_url('kontak') ?>">Kontak Club</a></li>
          <!-- <li><a href="javascript:void(0)" onclick="login()"><span class="text-uppercase"><i class=" fa fa-sign-in"></i> <span class="text-uppercase">Login</span></a></li>
          <li><span style="border-left: 1px solid #e9e9e9;"></span></li>
          <li><a href="javascript:void(0)" onclick="tambah()"><span class="text-uppercase"><i class=" fa fa-user"></i> Daftar</span></a></li> -->
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

<!--==========================
    Login Modal
  ============================-->
    <?php if ($this->session->userdata('user_logged_in') != 'Sudah_Loggin') {
        ?>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog" style="width: 367px">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h3 class="modal-title">LOGIN</h3>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		            </div>
                    <div class="modal-body">
                        <form action="#" id="form-login" class="form-horizontal">
                            <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id" required/>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required/>
                                    <span class="help-block"></span>
                                </div>   
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <?= $this->recaptcha->getWidget() ?>
                                </div>   
                            </div>
                            <button type="button" id="btnLogin" onclick="savelogin()" class="btn btn-block btn-success"> Login</button>    
                        </form>
                    </div>
                    <div class="modal-footer">
                        Powered by&nbsp;<a href="<?php echo site_url() ?>"><?= $ten->nama ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

<!-- *** LOGIN MODAL END *** -->

<!--==========================
    Script Login
  ============================-->
<script type="text/javascript">
    //fun login
    function login()
    {
        save_method = 'login';
        $('#form-login')[0].reset();
        $('#login-modal').modal('show');
    }

    //fun login
    function savelogin()
    {
        refreshTokens();
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        if(save_method == 'login') {
            url = "<?php echo site_url('welcome/login')?>";
            // ajax adding data to database
            var formData = new FormData($('#form-login')[0]);
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
                        $('#login-modal').modal('hide');
                        location.reload();
                        alert("Login Berhasil");                       
                    } 
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Login Gagal');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }
    }

    function refreshTokens() {
        var url = "<?= base_url()."welcome/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }

</script>