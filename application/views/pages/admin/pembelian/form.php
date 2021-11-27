<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">TAMBAH PEMBELIAN</h1>
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
                            <h3 class="card-title">Informasi Pembelian</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tanggal_pembelian">Tanggal Pembelian</label>
                                <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control select2" id="supplier_id" name="supplier_id" autocomplete="off" data-placeholder="Pilih Supplier" required>
                                    <option value=""></option>
                                    <?php foreach ($suppliers->result() as $supplier) { ?>
                                        <option value="<?= $supplier->id; ?>"><?= $supplier->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_invoice">No Invoice</label>
                                <input type="text" class="form-control" id="no_invoice" name="no_invoice" placeholder="No Invoice" minlength="3" maxlength="255" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Barang</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="barang_id">Barang</label>
                                <select class="form-control select2" id="barang_id" name="barang_id" autocomplete="off" data-placeholder="Pilih Barang" disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_barang_id">Kode</label>
                                <select class="form-control select2" id="sub_barang_id" name="sub_barang_id" autocomplete="off" data-placeholder="Pilih Kode" disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" min="1" maxlength="1000000000" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty" min="1" maxlength="1000000000" autocomplete="off">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-warning btn-block btn-flat" id="tambah">Tambah Barang</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">List Barang</h3>

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
                                            <th>Barang</th>
                                            <th>Kode</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Qty</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="v_barang">
                                        <tr>
                                            <td colspan="6" class="text-center">-Tidak ada data-</td>
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