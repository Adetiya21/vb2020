<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.club').addClass('menu-active');
      $('.sejarah').addClass('menu-active');
    });
</script>
<?php $ten = $this->DButama->GetDB('tb_club')->row(); ?>

    <!--==========================
      Arti Logo Section
    ============================-->
    <section id="services" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Arti Logo Club</h2>
        </div>

        <div class="row">

          <div class="col-lg-12">
            <div class="box wow fadeInUp">
              <div class="row">
          <div class="col-lg-5">
            <img src="<?= base_url('assets/assets/img/logo/'.$ten->gambar) ?>" alt="" width="400px">
          </div>

          <div class="col-lg-7">
            <h2 style="font-weight: bold;color:#0c2e8a"><?= $ten->nama ?></h2>
            <div style="text-align: justify;margin-left: -100px">
            	<?= $ten->arti_logo ?>	
            </div>
          </div>
        </div>
          </div>

        </div>

      </div>
    </section><!-- #arti logo -->

    <!--==========================
      Sejarah Section
    ============================-->
    <section id="clients" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Sejarah Club</h2>
          <div style="text-align: center">
          	<?= $ten->sejarah ?>
          </div>
        </div>
      </div>
    </section><!-- #sejarah -->