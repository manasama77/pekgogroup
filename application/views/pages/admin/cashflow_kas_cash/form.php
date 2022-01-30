<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">TAMBAH CASHFLOW KAS CASH</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <div class="card card-dark">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="no_invoice">No Invoice</label>
                            <input type="text" class="form-control" id="no_invoice" name="no_invoice" autocomplete="off" placeholder="Masukan No Invoice" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-10">
                <form id="form_add">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="account_id">No Akun</label>
                                        <select class="form-control select2" id="account_id" name="account_id" data-placeholder="Pilih No Akun" autocomplete="off" required>
                                            <option value=""></option>
                                            <?= $accounts; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dari_untuk">Dari / Untuk</label>
                                        <select class="form-control select2" id="dari_untuk" name="dari_untuk" data-placeholder="Dari / Untuk" autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                            foreach ($suppliers->result() as $supplier) {
                                                echo '<option value="' . $supplier->id . '">' . $supplier->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="produk">Produk</label>
                                        <input type="text" class="form-control" id="produk" name="produk" autocomplete="off" placeholder="Masukan Nama Produk" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="variasi">Variasi</label>
                                        <input type="text" class="form-control" id="variasi" name="variasi" autocomplete="off" placeholder="Masukan Nama Variasi" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="harga_produk">Harga Produk</label>
                                        <input type="number" class="form-control" id="harga_produk" name="harga_produk" autocomplete="off" min="0" max="1000000000" step="0.01" value="0" required />
                                        <div class="text-muted">Pemisah Desimal Menggunakan Titik</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="number" class="form-control" id="qty" name="qty" autocomplete="off" min="0" max="1000000000" step="0.01" value="0" required />
                                        <div class="text-muted">Pemisah Desimal Menggunakan Titik</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtotal">Subtotal</label>
                                        <input type="text" class="form-control-plaintext" id="subtotal" name="subtotal" autocomplete="off" value="Rp.0" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Pos</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" style="accent-color: #6F42C1;" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Debet
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" style="accent-color: #6F42C1;">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Kredit
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-block btn-flat"><i class="fas fa-plus fa-fw"></i> Tambah Cashflow</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-dark">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm bg-light">
                            <thead class="bg-gradient-dark">
                                <tr>
                                    <th class="text-center"><i class="fas fa-cogs"></i></th>
                                    <th>Tanggal</th>
                                    <th>Akun</th>
                                    <th>No Voucher</th>
                                    <th>Dari / Untuk</th>
                                    <th>Keterangan</th>
                                    <th class="text-right">Debet</th>
                                    <th class="text-right">Kredit</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody id="v_data">
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <a href="<?= base_url('cashflow_kas_cash/index'); ?>" class="btn btn-secondary btn-lg btn-block btn-flat"><i class="fas fa-backward fa-fw"></i> Kembali Ke List Cashflow Kas Cash</a>
        </div>
    </div>
</div>