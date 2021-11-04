<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pekgo Group | Admin Log in</title>
    <link rel="icon" href="<?= base_url('favicon.ico'); ?>" sizes="any"><!-- 32×32 -->
    <link rel="icon" href="<?= base_url('icon.svg'); ?>" type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png'); ?>"><!-- 180×180 -->
    <link rel="manifest" href="<?= base_url('manifest.webmanifest'); ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <a href="<?= base_url(); ?>" class="h1"><b>Pekgo</b>Group</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Admin Area</p>

                <form action="<?= base_url(); ?>login/index" method="post">
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="Whatsapp" minlength="4" maxlength="16" autocomplete="mobile" value="<?= set_value('whatsapp'); ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fab fa-whatsapp"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('whatsapp'); ?>

                    <div class="input-group mt-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="4" maxlength="10" autocomplete="current-password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password'); ?>

                    <div class="row">
                        <div class="col-12 mt-3">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                            <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-sign-in-alt"></i> Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/adam_helper.js"></script>
</body>

</html>

<script>
    setInputFilter(document.getElementById("whatsapp"), function(value) {
        return /^\d*?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
</script>