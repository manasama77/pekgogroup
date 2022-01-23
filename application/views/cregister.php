<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Register | Pekgo Group</title>
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
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-warning alert-dismissible fade show my-3" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong><?= $this->session->flashdata('error'); ?></strong>
            </div>
        <?php } ?>

        <!-- /.login-logo -->
        <div class="card card-outline card-info my-3">
            <div class="card-header text-center">
                <a href="<?= base_url(); ?>" class="h1"><b>Pekgo</b>Group</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Customer Register</p>

                <form action="<?= base_url('customer/register'); ?>" method="post">
                    <div class="form-group">
                        <label for="whatsapp">WHATSAPP <span class="text-danger" title="wajib diisi">*</span></label>
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="WHATSAPP" minlength="8" maxlength="16" value="<?= set_value('whatsapp'); ?>" autocomplete="tel" required>
                        <?= form_error('whatsapp'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password">PASSWORD <span class="text-danger" title="wajib diisi">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD" minlength="4" maxlength="20" value="<?= set_value('password'); ?>" autocomplete="new-password" required>
                        <?= form_error('password'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password_verifikasi">PASSWORD VERIFIKASI <span class="text-danger" title="wajib diisi">*</span></label>
                        <input type="password" class="form-control" id="password_verifikasi" name="password_verifikasi" placeholder="PASSWORD VERIFIKASI" minlength="4" maxlength="20" value="<?= set_value('password_verifikasi'); ?>" autocomplete="new-password" required>
                        <?= form_error('password_verifikasi'); ?>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label for="name">NAMA <span class="text-danger" title="wajib diisi">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="NAMA" minlength="2" maxlength="100" value="<?= set_value('name'); ?>" autocomplete="name" required>
                        <?= form_error('name'); ?>
                    </div>
                    <!-- <div class="form-group">
                        <label for="address">ALAMAT LENGKAP <span class="text-danger" title="wajib diisi">*</span></label>
                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="ALAMAT LENGKAP" required></textarea>
                        <?= form_error('address'); ?>
                    </div> -->
                    <div class="form-group">
                        <label for="id_tokped">ID TOKPED</label>
                        <input type="text" class="form-control" id="id_tokped" name="id_tokped" placeholder="ID TOKPED" minlength="6" maxlength="20" value="<?= set_value('id_tokped'); ?>">
                        <?= form_error('id_tokped'); ?>
                    </div>
                    <div class="form-group">
                        <label for="id_shopee">ID SHOPEE</label>
                        <input type="text" class="form-control" id="id_shopee" name="id_shopee" placeholder="ID SHOPEE" minlength="6" maxlength="20" value="<?= set_value('id_shopee'); ?>">
                        <?= form_error('id_shopee'); ?>
                    </div>
                    <div class="form-group">
                        <label for="id_instagram">ID INSTAGRAM</label>
                        <input type="text" class="form-control" id="id_instagram" name="id_instagram" placeholder="ID INSTAGRAM" minlength="6" maxlength="20" value="<?= set_value('id_instagram'); ?>">
                        <?= form_error('id_instagram'); ?>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label for="verif_wa">Verifikasi Whatsapp</label>
                        <input type="number" class="form-control" id="verif_wa" name="verif_wa" placeholder="Kode Verifikasi" minlength="6" maxlength="6" required>
                        <button type="button" class="btn btn-warning btn-block btn-sm" id="kirim_kode">Kirim Kode Verifikasi</button>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 mt-3">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                            <button type="submit" class="btn btn-info btn-block" disabled><i class="fas fa-pencil-alt"></i> Register</button>
                            <a href="<?= base_url(''); ?>" class="btn btn-secondary btn-block"><i class="fas fa-sign-in-alt"></i> Sudah terdaftar, Login</a>
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
    <script src="<?= base_url(); ?>assets/js/adam_helpers.js"></script>
</body>

</html>

<script>
    setInputFilter(document.getElementById("whatsapp"), function(value) {
        return /^\d*?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });

    $(document).ready(() => {
        $('#kirim_kode').on('click', () => {
            alert('kirim kode verifikasi')
            // proses kirim kode otp
        })
    })
</script>