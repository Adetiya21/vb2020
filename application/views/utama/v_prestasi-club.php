<!-- pagination -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/css/style-pagination.css') ?>">
<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.prestasi').addClass('menu-active');
    });
</script>

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
              <div class="icon" style="margin-left: -10px;"><img src="<?= base_url('assets/assets/img/prestasi/'.$key->gambar) ?>" alt="" width="80px"></div>
              <h4 class="title" style="margin-bottom: 0px;"><a href=""><?= $key->hasil ?></a></h4>
              <span style="font-size: 0.7em; margin-left: 30px;"><?= $key->tgl ?> | Tim <?= $key->tim ?></span>
              <p class="description" style="margin-top: 10px;"><?= $key->keterangan ?></p>
            </div>
          </div>
          <?php } ?>
        </div>
        <hr><br>
        
        <div class="text-center">
        <div class="pagination modal-2">
            <?php echo $halaman; ?> <!--Memanggil variable pagination-->
        </div>
        </div>

      </div>
    </section><!-- #prestasi -->