<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.club').addClass('menu-active');
      $('.pelatih').addClass('menu-active');
    });
</script>

    <!--==========================
      Pelatih Section
    ============================-->
    <section id="team" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Daftar Pelatih</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>
        <div class="row">
          <?php foreach ($pelatih->result() as $key) {?>
          <div class="col-lg-3 col-md-6">
            <div class="member" style="box-shadow: 0 0 10px 0">
              <div class="pic">
                <?php if ($key->gambar!==null) { ?>
                <img src="<?= base_url('assets/assets/img/pelatih/'.$key->gambar) ?>" alt="" style="width:280px; height: 300px;">
                <?php } else { echo "<< tidak ada gambar >>";} ?>
              </div>
              <div class="details">
                <h4><?= $key->nama ?></h4>
                <span>Melatih Tim <?= $key->melatih ?></span>
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
    </section><!-- #pelatih -->