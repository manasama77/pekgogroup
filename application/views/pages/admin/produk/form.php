<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Produk - Tambah</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <form action="<?= base_url('produk/add'); ?>" method="post">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Dasar Produk</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="code">KODE PRODUK</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="KODE PRODUK" value="<?= set_value('whatsapp'); ?>" readonly required>
                                <?= form_error('code'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">NAMA PRODUK</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA PRODUK" minlength="3" maxlength="50" value="<?= set_value('name'); ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label>WARNA</label>
                                <div class="row">
                                    <?php foreach ($colors->result() as $color) { ?>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="color_id[]" id="color_<?= $color->id; ?>" value="<?= $color->name; ?>" <?= set_value('color_id[]'); ?>>
                                                <label class="form-check-label" for="color_<?= $color->id; ?>">
                                                    <?= $color->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?= form_error('color_id[]'); ?>
                            </div>
                            <div class="form-group">
                                <label>UKURAN</label>
                                <div class="row">
                                    <?php foreach ($sizes->result() as $size) { ?>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="size_id[]" id="size_<?= $size->id; ?>" value="<?= $size->name; ?>" <?= set_value('size_id[]'); ?>>
                                                <label class="form-check-label" for="size_<?= $size->id; ?>">
                                                    <?= $size->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?= form_error('size_id[]'); ?>
                            </div>
                            <div class="form-group">
                                <label>REQUEST</label>
                                <div class="row">
                                    <?php foreach ($requests->result() as $request) { ?>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="request_id[]" id="request_<?= $request->id; ?>" value="<?= $request->name; ?>" <?= set_value('request_id[]'); ?>>
                                                <label class="form-check-label" for="request_<?= $request->id; ?>">
                                                    <?= $request->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?= form_error('request_id[]'); ?>
                            </div>
                            <div class="form-group">
                                <label for="path_image">GAMBAR PRODUK</label>
                                <input type="file" class="form-control" id="path_image" name="path_image" placeholder="GAMBAR PRODUK" value="<?= set_value('path_image'); ?>" accept=".jpg, .png, .jpeg" capture files required>
                                <?= form_error('path_image'); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">HPP Produk</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="code">JENIS HPP</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="KODE PRODUK" value="<?= set_value('whatsapp'); ?>" readonly required>
                                <?= form_error('code'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">NAMA PRODUK</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA PRODUK" minlength="3" maxlength="50" value="<?= set_value('name'); ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label>WARNA</label>
                                <div class="row">
                                    <?php foreach ($colors->result() as $color) { ?>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="color_id[]" id="color_<?= $color->id; ?>" value="<?= $color->name; ?>" <?= set_value('color_id[]'); ?>>
                                                <label class="form-check-label" for="color_<?= $color->id; ?>">
                                                    <?= $color->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?= form_error('color_id[]'); ?>
                            </div>
                            <div class="form-group">
                                <label>UKURAN</label>
                                <div class="row">
                                    <?php foreach ($sizes->result() as $size) { ?>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="size_id[]" id="size_<?= $size->id; ?>" value="<?= $size->name; ?>" <?= set_value('size_id[]'); ?>>
                                                <label class="form-check-label" for="size_<?= $size->id; ?>">
                                                    <?= $size->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?= form_error('size_id[]'); ?>
                            </div>
                            <div class="form-group">
                                <label>REQUEST</label>
                                <div class="row">
                                    <?php foreach ($requests->result() as $request) { ?>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="request_id[]" id="request_<?= $request->id; ?>" value="<?= $request->name; ?>" <?= set_value('request_id[]'); ?>>
                                                <label class="form-check-label" for="request_<?= $request->id; ?>">
                                                    <?= $request->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?= form_error('request_id[]'); ?>
                            </div>
                            <div class="form-group">
                                <label for="path_image">GAMBAR PRODUK</label>
                                <input type="file" class="form-control" id="path_image" name="path_image" placeholder="GAMBAR PRODUK" value="<?= set_value('path_image'); ?>" accept=".jpg, .png, .jpeg" capture files required>
                                <?= form_error('path_image'); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>