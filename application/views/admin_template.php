<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pekgo Group | <?= $title; ?></title>
    <link rel="icon" href="<?= base_url('favicon.ico'); ?>" sizes="any"><!-- 32×32 -->
    <link rel="icon" href="<?= base_url('icon.svg'); ?>" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png'); ?>"><!-- 180×180 -->
    <link rel="manifest" href="<?= base_url('manifest.webmanifest'); ?>">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/adminlte.min.css">
</head>

<body class="control-sidebar-slide-open layout-fixed sidebar-mini text-sm accent-orange sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <?php $this->load->view('layouts/admin/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-dark-purple">
            <!-- Brand Logo -->
            <a href="<?= base_url('dashboard'); ?>" class="brand-link navbar-purple">
                <img src="<?= $theme_logo; ?>" alt="<?= $theme_name; ?>" class="brand-image" style="opacity: .8; width: 45px; height: 25px; margin-left: .45rem">
                <span class="brand-text font-weight-light"><?= $theme_name; ?></span>
            </a>

            <!-- Admin Info -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-1 mb-3 d-flex">
                    <div class="image">
                        <img class="img-circle elevation-2" src="<?= base_url(); ?>assets/img/avatar2.png" alt="PP">
                    </div>
                    <div class="info" style="padding: 0px 5px 5px 8px;">
                        <a href="#" class="d-block">
                            <small class="font-weight-bold">
                                <?= $this->session->userdata('name'); ?><br /><?= strtoupper($this->session->userdata('role')); ?>
                            </small>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <?php $this->load->view('layouts/admin/sidebar') ?>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php $this->load->view('pages/admin/' . $page); ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <small><?= APP_NAME; ?> <?= APP_VERSION; ?></small>
            </div>
            <!-- Default to the left -->
            <small>
                <strong>Copyright &copy; <?= APP_YEAR; ?> <a href="<?= base_url(); ?>">pekgogroup.com</a></strong>
            </small>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="<?= base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Sweetalert2 -->
    <script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- BlockUI -->
    <script src="<?= base_url(); ?>assets/js/jquery.blockUI.js"></script>
    <!-- select2 -->
    <script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- momentjs -->
    <script src="<?= base_url(); ?>assets/plugins/moment/moment.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/adam_helper.js"></script>
</body>

</html>

<?php
if (isset($vitamin)) {
    $this->load->view('pages/admin/' . $vitamin);
}
?>