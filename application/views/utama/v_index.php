<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.home').addClass('menu-active');
  	});
</script>
  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-content">
      <h2>Ayo Bergabung<br>Bersama <span>TB VAS</span> !!</h2>
      <div>
        <a href="javascript:void(0)" onclick="login()" class="btn-get-started scrollto">Login Sekarang</a>
        <a href="<?= site_url('daftar') ?>" class="btn-projects scrollto">Daftar Sekarang</a>
      </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('<?= base_url('assets/front-end/') ?>img/intro-carousel/head0.jpg');"></div>
      <div class="item" style="background-image: url('<?= base_url('assets/front-end/') ?>img/intro-carousel/head1.jpg');"></div>
      <div class="item" style="background-image: url('<?= base_url('assets/front-end/') ?>img/intro-carousel/head2.jpg');"></div>
      <div class="item" style="background-image: url('<?= base_url('assets/front-end/') ?>img/intro-carousel/head3.jpg');"></div>
      <div class="item" style="background-image: url('<?= base_url('assets/front-end/') ?>img/intro-carousel/head4.jpg');"></div>
    </div>

  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Arti Logo Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <div class="box wow fadeInUp">
              <div class="row">
                <div class="col-lg-4">
                  <div class="icon" style="margin-left: -10px;margin-top: -25px"><img src="<?= base_url('assets/assets/img/logo/'.$ten->gambar) ?>" alt="" width="100%"></div>
                </div>
                <div class="col-lg-8">
                  <h2 class="title" style="font-weight: bold;color:#0c2e8a"><?= $ten->nama ?></h2><hr>
                  <p class="description" style="margin-left: 0px;"><?= $ten->arti_logo ?>  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- #arti logo -->

    <!--==========================
      Prestasi Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Prestasi</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="row">
          <?php foreach ($prestasi->result() as $key) { ?>
          <div class="col-lg-6">
            <div class="box wow fadeInUp">
              <div class="row">
                <div class="col-lg-4">
                  <div class="icon" style="margin-left: -20px;"><img src="<?= base_url('assets/assets/img/prestasi/'.$key->gambar) ?>" alt="" width="150px"></div>
                </div>
                <div class="col-lg-8">
                  <h4 class="title" style="margin-bottom: 0;margin-left: 0;"><a href=""><?= $key->hasil ?></a></h4>
                  <span style="font-size: 0.7em; margin-left: 0;"><?= date('d-m-Y', strtotime($key->tgl)) ?> | Tim <?= $key->tim ?></span><hr>
                  <p class="description" style="margin-top: 10px;margin-left: 0;"><?= $key->keterangan ?></p>
                </div>
              </div>              
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="text-right">
        <a href="<?= site_url('prestasi-club') ?>" class="btn btn-success" href="">Selengkapnya...</a>
        </div>
        <hr>
      </div>
    </section>
    <!-- #prestasi -->
    
    <!--==========================
      Pelatih Section
    ============================-->
    <section id="team" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Pelatih</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>
        <div class="row">
          <?php foreach ($pelatih->result() as $key) {?>
          <div class="col-lg-3 col-md-6">
            <div class="member" style="box-shadow: 0 0 10px 0">
              <a href="<?= site_url('daftar-pelatih') ?>" title="Detail <?= $key->nama ?>" onclick="detail(<?= $key->id ?>)">
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
    </section>
    <!-- #pelatih -->

  </main>