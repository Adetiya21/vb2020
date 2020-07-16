<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.kontak').addClass('menu-active');
    });
</script>

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Kontak Club</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="row contact-info">
          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Alamat Sekretariat</h3>
              <address><?= $kon->alamat ?></address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Nomor Telpon</h3>
              <p><a href="tel:<?= $kon->no_telp ?>"><?= $kon->no_telp ?></a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:<?= $kon->email ?>"><?= $kon->email ?></a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-address">
              <h3>Tempat Latihan</h3>
              <address><?= $kon->tmp_latihan ?></address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <h3>Facebook</h3>
              <p><a href="https://facebook.com/<?= $kon->facebook ?>"><?= $kon->facebook ?></a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <h3>Instagram</h3>
              <p><a href="https://instagram.com/<?= $kon->instagram ?>"><?= $kon->instagram ?></a></p>
            </div>
          </div>
        </div>
      </div>

      </div>
    </section><!-- #contact -->