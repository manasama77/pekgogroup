<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $page_title; ?> &mdash; <?= $projects['name']; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="<?= base_url('favicon.ico'); ?>" sizes="any"><!-- 32×32 -->
  <link rel="icon" href="<?= base_url('icon.svg'); ?>" type="image/svg+xml">
  <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png'); ?>"><!-- 180×180 -->
  <link rel="manifest" href="<?= base_url('manifest.webmanifest'); ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/css/magnific-popup.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/css/jquery-ui.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/css/aos.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/shoppers/css/style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/flexbox2/css/lightbox.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
  <style>
    .swal2-container {
      z-index: 10000 !important;
    }
  </style>

</head>

<body>

  <div class="site-wrap">
    <?php $this->load->view('template/customer/header'); ?>
    <?php $this->load->view('pages/customer/' . $page); ?>
    <?php $this->load->view('template/customer/footer'); ?>
  </div>

  <script src="<?= base_url(); ?>assets/shoppers/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url(); ?>assets/shoppers/js/jquery-ui.js"></script>
  <script src="<?= base_url(); ?>assets/shoppers/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/shoppers/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/shoppers/js/owl.carousel.min.js"></script>
  <script src="<?= base_url(); ?>assets/shoppers/js/jquery.magnific-popup.min.js"></script>
  <script src="<?= base_url(); ?>assets/shoppers/js/aos.js"></script>
  <script src="<?= base_url(); ?>assets/shoppers/js/main.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/jquery.blockUI.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/adam_helper.js"></script>

</body>

</html>

<?php
if (isset($vitamin)) {
  $this->load->view('pages/customer/' . $vitamin);
}
?>