<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer - Edit</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="<?= base_url('customer/edit/' . $list->row()->id); ?>" method="post">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Edit Customer</h3>
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
                                <label for="name">NAMA CUSTOMER</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA CUSTOMER" minlength="2" maxlength="50" value="<?= (set_value('name')) ? set_value('name') : $list->row()->name; ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="id_tokped">ID TOKPED</label>
                                <input type="text" class="form-control" id="id_tokped" name="id_tokped" placeholder="ID TOKPED" minlength="6" maxlength="20" value="<?= (set_value('id_tokped')) ? set_value('id_tokped') : $list->row()->id_tokped; ?>">
                                <?= form_error('id_tokped'); ?>
                            </div>
                            <div class="form-group">
                                <label for="id_shopee">ID SHOPEE</label>
                                <input type="text" class="form-control" id="id_shopee" name="id_shopee" placeholder="ID SHOPEE" minlength="6" maxlength="20" value="<?= (set_value('id_shopee')) ? set_value('id_shopee') : $list->row()->id_shopee; ?>">
                                <?= form_error('id_shopee'); ?>
                            </div>
                            <div class="form-group">
                                <label for="id_instagram">ID INSTAGRAM</label>
                                <input type="text" class="form-control" id="id_instagram" name="id_instagram" placeholder="ID INSTAGRAM" minlength="6" maxlength="20" value="<?= (set_value('id_instagram')) ? set_value('id_instagram') : $list->row()->id_instagram; ?>">
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