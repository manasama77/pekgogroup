<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admin - Tambah</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="<?= base_url('admin/add'); ?>" method="post">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Admin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="whatsapp">NO WHATSAPP</label>
                                <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="WHATSAPP" minlength="8" maxlength="16" value="<?= set_value('whatsapp'); ?>" autocomplete="tel" required>
                                <?= form_error('whatsapp'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password">PASSWORD</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD" minlength="4" maxlength="20" value="<?= set_value('password'); ?>" autocomplete="new-password" required>
                                <?= form_error('password'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password_verifikasi">PASSWORD VERIFIKASI</label>
                                <input type="password" class="form-control" id="password_verifikasi" name="password_verifikasi" placeholder="PASSWORD VERIFIKASI" minlength="4" maxlength="20" value="<?= set_value('password_verifikasi'); ?>" autocomplete="new-password" required>
                                <?= form_error('password_verifikasi'); ?>
                            </div>
                            <hr />
                            <div class="form-group">
                                <label for="name">NAMA</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA" minlength="2" maxlength="50" value="<?= set_value('name'); ?>" autocomplete="name" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label>ROLE</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_cs" value="cs" <?= set_radio('role', 'cs', true); ?>>
                                    <label class="form-check-label" for="role_cs">
                                        Admin CS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_order" value="order" value="cs" <?= set_radio('role', 'order', false); ?>>
                                    <label class="form-check-label" for="role_order">
                                        Admin Order
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_produksi" value="produksi" <?= set_radio('role', 'produksi', false); ?>>
                                    <label class="form-check-label" for="role_produksi">
                                        Admin Produksi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_finance" value="finance" <?= set_radio('role', 'finance', false); ?>>
                                    <label class="form-check-label" for="role_finance">
                                        Admin Finance
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_owner" value="owner" <?= set_radio('role', 'owner', false); ?>>
                                    <label class="form-check-label" for="role_owner">
                                        Owner
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_komisaris" value="komisaris" <?= set_radio('role', 'komisaris', false); ?>>
                                    <label class="form-check-label" for="role_komisaris">
                                        Komisaris
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_developer" value="developer" <?= set_radio('role', 'developer', false); ?>>
                                    <label class="form-check-label" for="role_developer">
                                        Developer
                                    </label>
                                </div>
                                <?= form_error('role'); ?>
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