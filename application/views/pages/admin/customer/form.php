<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer - Add</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="<?= base_url('customer/add'); ?>" method="post">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Customer</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
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
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>