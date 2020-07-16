<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.club').addClass('menu-active');
      $('.sejarah').addClass('menu-active');
    });
</script>
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
                <div class="col-lg-4">
                  <div class="icon" style="margin-left: -10px;margin-top: -25px"><img src="<?= base_url('assets/assets/img/logo/'.$ten->gambar) ?>" alt="" width="100%"></div>
                </div>
                <div class="col-lg-8">
                  <h2 class="title" style="font-weight: bold;color:#0c2e8a"><?= $ten->nama ?></h2><hr>
                  <p class="description" style=""><?= $ten->arti_logo ?></p>
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
          <div style="text-align: justify;">
          	<?= $ten->sejarah ?>
          </div>
        </div>
      </div>
    </section><!-- #sejarah -->