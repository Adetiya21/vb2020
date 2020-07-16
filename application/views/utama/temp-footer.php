  <?php $ten = $this->DButama->GetDB('tb_club')->row(); ?>
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        Copyright&copy; 2020 <strong><?= $ten->nama ?></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="<?= base_url('assets/front-end/') ?>lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/easing/easing.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/superfish/hoverIntent.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/superfish/superfish.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/wow/wow.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="<?= base_url('assets/front-end/') ?>lib/sticky/sticky.js"></script>

  <!-- Contact Form JavaScript File -->
  <!-- <script src="<?= base_url('assets/front-end/') ?>contactform/contactform.js"></script> -->

  <!-- Template Main Javascript File -->
  <script src="<?= base_url('assets/front-end/') ?>js/main.js"></script>

</body>
</html>