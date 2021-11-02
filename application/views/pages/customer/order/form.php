<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Order - Tambah</h1>
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
    <div class="container-fluid small">
        <form id="form_order" action="<?= base_url('corder/add'); ?>" method="post">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Order</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="sales_invoice">SALES INVOICE</label>
                                <input type="text" class="form-control form-control-sm" id="sales_invoice" name="sales_invoice" placeholder="SALES INVOICE" value="<?= $sales_invoice; ?>" readonly required>
                                <?= form_error('sales_invoice'); ?>
                            </div>
                            <div class="form-group">
                                <label for="created_at">TANGGAL & JAM ORDER</label>
                                <input type="text" class="form-control form-control-sm" id="created_at" name="created_at" placeholder="TANGGAL & JAM ORDER" value="<?= $created_at; ?>" readonly required>
                                <?= form_error('created_at'); ?>
                            </div>
                            <div class="form-group">
                                <label for="durasi_batas_transfer">DURASI BATAS TRANSFER</label>
                                <select class="form-control form-control-sm" id="durasi_batas_transfer" name="durasi_batas_transfer" required>
                                    <option value="3">+3 Jam</option>
                                    <option value="5">+5 Jam</option>
                                    <option value="24">+24 Jam</option>
                                </select>
                                <?= form_error('durasi_batas_transfer'); ?>
                            </div>
                            <div class="form-group">
                                <label for="batas_waktu_transfer">BATAS WAKTU TRANSFER</label>
                                <input type="text" class="form-control form-control-sm" id="batas_waktu_transfer" name="batas_waktu_transfer" placeholder="BATAS WAKTU TRANSFER" value="<?= $batas_waktu_transfer; ?>" readonly required>
                                <?= form_error('batas_waktu_transfer'); ?>
                            </div>
                            <div class="form-group">
                                <label for="pilih_jahitan">JAHITAN</label>
                                <select class="form-control form-control-sm" id="pilih_jahitan" name="pilih_jahitan" required>
                                    <option value="standard">Standard (4 Minggu Jadi) Rp.0,-</option>
                                    <option value="express">Express (2 Minggu Jadi) +Rp.50,000,-</option>
                                    <option value="urgent">URGENT (1 Minggu Jadi) +Rp.100,000,-</option>
                                    <option value="super urgent">SUPER URGENT (3 Hari Jadi) +Rp.150,000,-</option>
                                </select>
                                <?= form_error('pilih_jahitan'); ?>
                            </div>
                            <div class="form-group">
                                <label for="estimasi_selesai">ESTIMASI SELESAI</label>
                                <input type="text" class="form-control form-control-sm" id="estimasi_selesai" name="estimasi_selesai" placeholder="ESTIMASI SELESAI" value="<?= $estimasi_selesai; ?>" readonly required>
                                <?= form_error('estimasi_selesai'); ?>
                            </div>
                            <div class="form-group">
                                <label for="jenis_dp">JENIS DP</label>
                                <select class="form-control form-control-sm" id="jenis_dp" name="jenis_dp" onchange="updateDP()" required>
                                    <option value="30">30%</option>
                                    <option value="50">50%</option>
                                    <option value="100">100%</option>
                                </select>
                                <?= form_error('jenis_dp'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Order Produk</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_id">PRODUK</label>
                                <select class="form-control form-control-sm select2" id="product_id" name="product_id" data-placeholder="Pilih Produk" style="width: 100%;" required>
                                    <option value=""></option>
                                    <?php for ($i = 0; $i < $products['num_rows']; $i++) { ?>
                                        <option value="<?= $products['data'][$i]['id']; ?>"><?= $products['data'][$i]['name']; ?> - Rp.<?= number_format($products['data'][$i]['price'], 0); ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('product_id'); ?>
                            </div>
                            <div class="form-group">
                                <label for="color_id">WARNA</label>
                                <select class="form-control form-control-sm" id="color_id" name="color_id" data-placeholder="Pilih Warna" required>
                                    <option value=""></option>
                                </select>
                                <?= form_error('color_id'); ?>
                            </div>
                            <div class="form-group">
                                <label for="size_id">UKURAN</label>
                                <select class="form-control form-control-sm" id="size_id" name="size_id" data-placeholder="Pilih Ukuran" required>
                                    <option value=""></option>
                                </select>
                                <?= form_error('size_id'); ?>
                            </div>
                            <div class="form-group">
                                <label for="catatan">CATATAN TAMBAHAN</label>
                                <textarea class="form-control form-control-sm" id="catatan" name="catatan" placeholder="CATATAN TAMBAHAN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Order Request</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body bg-gradient-orange">
                            <div class="form-group">
                                <label for="request_id">JENIS REQUEST</label>
                                <select class="form-control form-control-sm select2" id="request_id" name="request_id" data-placeholder="Pilih Request">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer bg-warning">
                            <button type="button" class="btn bg-orange btn-block btn-sm" id="tambah_request">Tambah Request</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <hr />
                </div>
                <div class="col-sm-12 col-md-6 offset-md-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-sm">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center" colspan="2">DETAIL ORDER</th>
                                </tr>
                                <tr>
                                    <th class="text-left">ITEM</th>
                                    <th class="text-right">HARGA</th>
                                </tr>
                            </thead>
                            <tbody id="v_order" class="bg-secondary">
                                <tr>
                                    <td class="text-center font-weight-bold" colspan="2">Tidak ada data</td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-dark">
                                <tr>
                                    <th class="text-right">SUBTOTAL</th>
                                    <th class="text-right" id="sub_total">Rp 0</th>
                                </tr>
                                <tr>
                                    <th class="text-right">KODE UNIK</th>
                                    <th class="text-right">Rp <span id="kode_unik"><?= $kode_unik; ?></span></th>
                                </tr>
                                <tr>
                                    <th class="text-right">GRAND TOTAL</th>
                                    <th class="text-right bg-danger" id="grand_total">0</th>
                                </tr>
                                <tr>
                                    <th class="text-right">NILAI DP <span id="persen_dp">(0%)</span></th>
                                    <th class="text-right" id="nilai_dp">0</th>
                                </tr>
                                <tr>
                                    <th class="text-right">NILAI PELUNASAN <span id="persen_lunas">(0%)</span> </th>
                                    <th class="text-right" id="nilai_lunas">0</th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        CATATAN TAMBAHAN:
                                        <p id="catatan_tambahan">-</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="bg-warning">
                                        <button type="button" class="btn bg-orange btn-sm btn-block font-weight-bold" id="copy_detail_order">
                                            <i class="fas fa-copy fa-fw"></i> COPY DETAIL ORDER
                                        </button>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                    <input type="hidden" id="id_order" name="id_order" value="<?= $id_order; ?>" />
                    <input type="hidden" id="sub_total_order" name="sub_total_order" value="0" />
                    <input type="hidden" id="kode_unik_order" name="kode_unik_order" value="<?= $kode_unik; ?>" />
                    <input type="hidden" id="grand_total_order" name="grand_total_order" value="0" />
                    <input type="hidden" id="dp_order" name="dp_order" value="0" />
                    <input type="hidden" id="lunas_order" name="lunas_order" value="0" />
                    <button type="submit" class="btn btn-primary btn-block btn-flat font-weight-bold">Save Order</button>
                    <a href="<?= base_url('order/index'); ?>" class="btn btn-secondary btn-block btn-flat font-weight-bold">Kembali Ke Order List</a>
                </div>
            </div>
        </form>
    </div>
</div>