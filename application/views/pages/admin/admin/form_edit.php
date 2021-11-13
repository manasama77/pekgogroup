<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admin - Edit</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="<?= base_url('admin/edit/' . $list->row()->id); ?>" method="post">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Edit Admin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="whatsapp">WHATSAPP</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WHATSAPP" value="<?= $list->row()->whatsapp; ?>" readonly required>
                                <?= form_error('whatsapp'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">NAMA</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA CUSTOMER" minlength="2" maxlength="50" value="<?= (set_value('name')) ? set_value('name') : $list->row()->name; ?>" autocomplete="name" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label>ROLE</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_cs" value="cs" <?= set_radio('role', 'cs', ($list->row()->role == "cs") ? true : false); ?>>
                                    <label class="form-check-label" for="role_cs">
                                        Admin CS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_order" value="order" value="cs" <?= set_radio('role', 'order', ($list->row()->role == "order") ? true : false); ?>>
                                    <label class="form-check-label" for="role_order">
                                        Admin Order
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_produksi" value="produksi" <?= set_radio('role', 'produksi', ($list->row()->role == "produksi") ? true : false); ?>>
                                    <label class="form-check-label" for="role_produksi">
                                        Admin Produksi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_finance" value="finance" <?= set_radio('role', 'finance', ($list->row()->role == "finance") ? true : false); ?>>
                                    <label class="form-check-label" for="role_finance">
                                        Admin Finance
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_owner" value="owner" <?= set_radio('role', 'owner', ($list->row()->role == "owner") ? true : false); ?>>
                                    <label class="form-check-label" for="role_owner">
                                        Owner
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_komisaris" value="komisaris" <?= set_radio('role', 'komisaris', ($list->row()->role == "komisaris") ? true : false); ?>>
                                    <label class="form-check-label" for="role_komisaris">
                                        Komisaris
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_developer" value="developer" <?= set_radio('role', 'developer', ($list->row()->role == "developer") ? true : false); ?>>
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