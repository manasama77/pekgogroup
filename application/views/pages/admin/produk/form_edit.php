<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Produk - Edit</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>
                            <?= $this->session->flashdata('error'); ?>
                            <!-- repair bug php 8 -->
                            <?php $this->session->unset_userdata('error'); ?>
                        </strong>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <form id="form_produk" action="<?= base_url('produk/edit/' . $products->row()->id); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-4">
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
                                <input type="text" class="form-control" id="code" name="code" placeholder="KODE PRODUK" value="<?= $products->row()->code; ?>" readonly required>
                                <?= form_error('code'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">NAMA PRODUK</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA PRODUK" minlength="3" maxlength="50" value="<?= (set_value('name')) ? set_value('name') : $products->row()->name; ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="description">DESKRIPSI</label>
                                <textarea class="form-control" id="description" name="description" placeholder="DESKRIPSI" required><?= $products->row()->description; ?></textarea>
                                <?= form_error('description'); ?>
                            </div>
                            <div class="form-group">
                                <label for="price">HARGA</label>
                                <?php
                                $product_price = number_format($products->row()->price, 0, '', '');
                                ?>
                                <input type="number" class="form-control" id="price" name="price" placeholder="HARGA" min="1" max="1000000000" value="<?= (set_value('price')) ? set_value('price') : $product_price; ?>" required>
                                <?= form_error('price'); ?>
                            </div>
                            <div class="form-group">
                                <label>WARNA</label>
                                <div class="row">
                                    <?php
                                    foreach ($colors->result() as $color) {
                                    ?>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="color_id[]" id="color_<?= $color->id; ?>" value="<?= $color->id; ?>" <?= set_value('color_id[]'); ?> <?= (in_array($color->id, $product_colors) == true) ? "checked" : null; ?>>
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
                                                <input class="form-check-input" type="checkbox" name="size_id[]" id="size_<?= $size->id; ?>" value="<?= $size->id; ?>" <?= set_value('size_id[]'); ?> <?= (in_array($size->id, $product_sizes) == true) ? "checked" : null; ?>>
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
                                                <input class="form-check-input" type="checkbox" name="request_id[]" id="request_<?= $request->id; ?>" value="<?= $request->id; ?>" <?= set_value('request_id[]'); ?> <?= (in_array($request->id, $product_requests) == true) ? "checked" : null; ?>>
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
                                <label>JENIS JAHITAN</label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="standard" id="standard" value="1" <?= ($products->row()->standard == 1) ? "checked" : null; ?> required disabled>
                                            <label class="form-check-label" for="standard">
                                                STANDARD
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="express" id="express" value="1" <?= ($products->row()->express == 1) ? "checked" : null; ?>>
                                            <label class="form-check-label" for="express">
                                                EXPRESS
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="urgent" id="urgent" value="1" <?= ($products->row()->urgent == 1) ? "checked" : null; ?>>
                                            <label class="form-check-label" for="urgent">
                                                URGENT
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="super_urgent" id="super_urgent" value="1" <?= ($products->row()->super_urgent == 1) ? "checked" : null; ?>>
                                            <label class="form-check-label" for="super_urgent">
                                                SUPER URGENT
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="path_image">GAMBAR PRODUK 1</label>
                                <input type="file" class="form-control" id="path_image" name="path_image" placeholder="GAMBAR PRODUK" accept=".jpg, .png, .jpeg" files>
                            </div>
                            <div class="form-group">
                                <label for="path_image_2">GAMBAR PRODUK 2</label>
                                <input type="file" class="form-control" id="path_image_2" name="path_image_2" placeholder="GAMBAR PRODUK" accept=".jpg, .png, .jpeg" files>
                            </div>
                            <div class="form-group">
                                <label for="path_image_3">GAMBAR PRODUK 3</label>
                                <input type="file" class="form-control" id="path_image_3" name="path_image_3" placeholder="GAMBAR PRODUK" accept=".jpg, .png, .jpeg" files>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                            <input type="hidden" id="id_product" name="id_product" value="<?= $products->row()->id; ?>" />
                            <input type="hidden" id="count_hpp" name="count_hpp" value="0" />
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-5">
                            <div class="card card-warning">
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
                                        <select class="form-control select2" id="id_hpp" name="id_hpp" data-placeholder="Pilih Jenis HPP">
                                            <?php foreach ($hpps->result() as $hpp) { ?>
                                                <option value="<?= $hpp->id; ?>"><?= $hpp->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty_hpp">QTY KEBUTUHAN HPP</label>
                                        <input type="number" class="form-control" id="qty_hpp" name="qty_hpp" placeholder="QTY KEBUTUHAN HPP" minlength="1" maxlength="1000">
                                        <div class="text-muted">Pemisah Desimal menggunakan titik</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-warning btn-block btn-flat" id="tambah_hpp">TAMBAH HPP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11">
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-center"><i class="fas fa-cog"></i></th>
                                        <th>JENIS HPP</th>
                                        <th class="text-right">QTY HPP</th>
                                        <th class="text-right">HARGA</th>
                                    </tr>
                                </thead>
                                <tbody id="v_hpp">
                                    <tr>
                                        <td class="text-center"></td>
                                        <td></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-dark">
                                    <tr>
                                        <th class="text-right" colspan="3">GRAND TOTAL</th>
                                        <th class="text-right" id="grand_total">0</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>