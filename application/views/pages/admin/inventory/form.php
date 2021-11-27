<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">SUPPLIER</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>
                            <?= $this->session->flashdata('success'); ?>
                            <!-- repair bug php 8 -->
                            <?php $this->session->unset_userdata('success'); ?>
                        </strong>
                    </div>
                <?php } ?>

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
        <form id="form_barang">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Barang</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kategori_id">Kategori</label>
                                <select class="form-control select2" id="kategori_id" name="kategori_id" autocomplete="off" data-placeholder="Pilih Kategori" required>
                                    <option value=""></option>
                                    <?php foreach ($categories->result() as $category) { ?>
                                        <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Barang" minlength="3" maxlength="255" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="merk_id">Merk</label>
                                <select class="form-control select2" id="merk_id" name="merk_id" data-placeholder="Pilih Merk" autocomplete="off" required>
                                    <option value=""></option>
                                    <?php foreach ($merks->result() as $merk) { ?>
                                        <option value="<?= $merk->id; ?>"><?= $merk->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color_id">Warna</label>
                                <select class="form-control select2" id="color_id" name="color_id" data-placeholder="Pilih Warna" autocomplete="off" required>
                                    <option value=""></option>
                                    <?php foreach ($colors->result() as $color) { ?>
                                        <option value="<?= $color->id; ?>"><?= $color->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="unit_id">Satuan</label>
                                <select class="form-control select2" id="unit_id" name="unit_id" data-placeholder="Pilih Satuan" autocomplete="off" required>
                                    <option value=""></option>
                                    <?php foreach ($units->result() as $unit) { ?>
                                        <option value="<?= $unit->id; ?>"><?= $unit->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Supplier</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control select2" id="supplier_id" name="supplier_id" autocomplete="off" data-placeholder="Pilih Supplier">
                                    <option value=""></option>
                                    <?php foreach ($suppliers->result() as $supplier) { ?>
                                        <option value="<?= $supplier->id; ?>"><?= $supplier->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kode">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode" minlength="3" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" min="1" maxlength="1000000000" autocomplete="off">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-warning btn-block btn-flat" id="tambah">Tambah Supplier</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">List Supplier</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 110px;">
                                                <i class="fas fa-cog"></i>
                                            </th>
                                            <th>Supplier</th>
                                            <th>Kode</th>
                                            <th class="text-right">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody id="v_supplier">
                                        <tr>
                                            <td colspan="4" class="text-center">-Tidak ada data-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4 mt-4">
                    <input type="hidden" id="count" value="0" />
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>