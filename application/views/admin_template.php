<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pekgo Group">
    <meta name="author" content="@adampm">
    <title>Pekgo Apparel | <?= $title; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>" sizes="any"><!-- 32×32 -->
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png'); ?>"><!-- 180×180 -->
    <link rel="manifest" href="<?= base_url('manifest.webmanifest'); ?>">
    <meta name="theme-color" content="#6F42C1">


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
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/adminlte.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

        html,
        body {
            font-family: 'Sarabun', sans-serif, "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
        }

        .pagination>li>a {
            background-color: white;
            color: #5A4181 !important;
        }

        .pagination>li>a:focus,
        .pagination>li>a:hover,
        .pagination>li>span:focus,
        .pagination>li>span:hover {
            color: #5a5a5a !important;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination>.active>a {
            color: white !important;
            background-color: #6F42C1 !Important;
            border: solid 1px #6F42C1 !Important;
        }

        .pagination>.active>a:hover {
            background-color: #522d97 !Important;
            border: solid 1px #522d97;
            color: white !important;
        }

        .card-primary:not(.card-outline)>.card-header {
            background-color: #6F42C1 !important;
        }

        .form-check-input {
            accent-color: #6F42C1 !important;
        }

        .select2-selection__rendered {
            font-size: 13px !important;
        }
    </style>
</head>

<body class="control-sidebar-slide-open layout-fixed sidebar-mini text-sm accent-orange sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <?php $this->load->view('layouts/admin/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-dark-purple">
            <!-- Brand Logo -->
            <a href="<?= base_url('dashboard'); ?>" class="brand-link logo-switch navbar-purple">
                <img src="<?= $theme_logo; ?>" alt="<?= $theme_name; ?>" class="brand-image-xl logo-xs" style="width: 50px; height: 25px; margin-left: -0.2rem; margin-top: 1px;">
                <span class="brand-text font-weight-bold"><?= $theme_name; ?></span>
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
                                <?= $this->session->userdata(SESS_ADM . 'name'); ?><br /><?= strtoupper($this->session->userdata(SESS_ADM . 'role')); ?>
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
    <script src="<?= base_url(); ?>assets/js/adam_helpers.js"></script>
    <!-- datatables -->
    <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</body>

</html>

<?php
if (isset($vitamin)) {
    $this->load->view('pages/admin/' . $vitamin);
}
?>