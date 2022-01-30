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
                        </strong>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid small">
        <form id="form_order" action="<?= base_url('order/add'); ?>" method="post">
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
                                <label for="admin_order">ADMIN ORDER</label>
                                <input type="text" class="form-control " id="admin_order" name="admin_order" placeholder="KODE PRODUK" value="<?= $this->session->userdata(SESS_ADM . 'name'); ?>" readonly required>
                                <?= form_error('admin_order'); ?>
                            </div>
                            <div class="form-group">
                                <label for="project_id">PROJECT</label>
                                <select class="form-control " id="project_id" name="project_id" required>
                                    <?php for ($i = 0; $i < count($projects); $i++) { ?>
                                        <option value="<?= $projects[$i]['id']; ?>"><?= $projects[$i]['name']; ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('project_id'); ?>
                            </div>
                            <div class="form-group">
                                <label for="sales_invoice">SALES INVOICE</label>
                                <input type="text" class="form-control " id="sales_invoice" name="sales_invoice" placeholder="SALES INVOICE" value="<?= $sales_invoice; ?>" readonly required>
                                <?= form_error('sales_invoice'); ?>
                            </div>
                            <div class="form-group">
                                <label for="order_via">ORDER VIA</label>
                                <select class="form-control " id="order_via" name="order_via" required>
                                    <option value="wa">WHATSAPP</option>
                                    <option value="tokped">TOKPED</option>
                                    <option value="shopee">SHOPEE</option>
                                    <option value="offline">OFFLINE</option>
                                </select>
                                <?= form_error('order_via'); ?>
                            </div>
                            <div class="form-group">
                                <label for="created_at">TANGGAL & JAM ORDER</label>
                                <input type="text" class="form-control " id="created_at" name="created_at" placeholder="TANGGAL & JAM ORDER" value="<?= $created_at; ?>" readonly required>
                                <?= form_error('created_at'); ?>
                            </div>
                            <div class="form-group">
                                <label for="durasi_batas_transfer">DURASI BATAS TRANSFER</label>
                                <select class="form-control " id="durasi_batas_transfer" name="durasi_batas_transfer" required>
                                    <option value="3">+3 Jam</option>
                                    <option value="5">+5 Jam</option>
                                    <option value="24">+24 Jam</option>
                                </select>
                                <?= form_error('durasi_batas_transfer'); ?>
                            </div>
                            <div class="form-group">
                                <label for="batas_waktu_transfer">BATAS WAKTU TRANSFER</label>
                                <input type="text" class="form-control " id="batas_waktu_transfer" name="batas_waktu_transfer" placeholder="BATAS WAKTU TRANSFER" value="<?= $batas_waktu_transfer; ?>" readonly required>
                                <?= form_error('batas_waktu_transfer'); ?>
                            </div>
                            <div class="form-group">
                                <label for="estimasi_selesai">ESTIMASI SELESAI</label>
                                <input type="text" class="form-control " id="estimasi_selesai" name="estimasi_selesai" placeholder="ESTIMASI SELESAI" value="<?= $estimasi_selesai; ?>" readonly required>
                                <?= form_error('estimasi_selesai'); ?>
                            </div>
                            <div class="form-group">
                                <label for="jenis_dp">JENIS DP</label>
                                <select class="form-control " id="jenis_dp" name="jenis_dp" onchange="updateDP()" required>
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
                            <h3 class="card-title">Informasi Customer</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="customer_id">CUSTOMER</label>
                                <div class="input-group">
                                    <select class="form-control form-control-lg select2" id="customer_id" name="customer_id" data-placeholder="Pilih Customer" autocomplete="off" style="width: 100%;" required>
                                        <option value=""></option>
                                        <?php foreach ($customers->result() as $customer) { ?>
                                            <option value="<?= $customer->id; ?>"><?= $customer->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <!-- <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-flat btn-sm" disabled><i class="fas fa-plus"></i> TAMBAH</button>
                                    </div> -->
                                </div>
                                <?= form_error('nama_customer'); ?>
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">NO WA</label>
                                <input type="text" class="form-control " id="whatsapp" name="whatsapp" placeholder="NO WA" readonly required />
                                <?= form_error('whatsapp'); ?>
                            </div>
                            <div class="form-group">
                                <label for="id_tokped">ID TOKPED</label>
                                <input type="text" class="form-control " id="id_tokped" name="id_tokped" placeholder="ID TOKPED" readonly />
                                <?= form_error('id_tokped'); ?>
                            </div>
                            <div class="form-group">
                                <label for="id_shopee">ID SHOPEE</label>
                                <input type="text" class="form-control " id="id_shopee" name="id_shopee" placeholder="ID SHOPEE" readonly />
                                <?= form_error('id_shopee'); ?>
                            </div>
                            <div class="form-group">
                                <label for="id_instagram">ID INSTAGRAM</label>
                                <input type="text" class="form-control " id="id_instagram" name="id_instagram" placeholder="ID INSTAGRAM" readonly />
                                <?= form_error('id_instagram'); ?>
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
                                <select class="form-control select2" id="product_id" name="product_id" data-placeholder="Pilih Produk" autocomplete="off" style="width: 100%;" required>
                                    <option value=""></option>
                                    <?php for ($i = 0; $i < $products['num_rows']; $i++) { ?>
                                        <option value="<?= $products['data'][$i]['id']; ?>"><?= $products['data'][$i]['name']; ?> - Rp.<?= number_format($products['data'][$i]['price'], 0); ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('product_id'); ?>
                            </div>
                            <div class="form-group">
                                <label for="color_id">WARNA</label>
                                <select class="form-control" id="color_id" name="color_id" data-placeholder="Pilih Warna" autocomplete="off" required>
                                    <option value=""></option>
                                </select>
                                <?= form_error('color_id'); ?>
                            </div>
                            <div class="form-group">
                                <label for="size_id">UKURAN</label>
                                <select class="form-control " id="size_id" name="size_id" data-placeholder="Pilih Ukuran" autocomplete="off" required>
                                    <option value=""></option>
                                </select>
                                <?= form_error('size_id'); ?>
                            </div>
                            <div class="form-group">
                                <label for="pilih_jahitan">JAHITAN</label>
                                <select class="form-control " id="pilih_jahitan" name="pilih_jahitan" required>
                                    <option value="standard">Standard (4 Minggu Jadi) Rp.0,-</option>
                                </select>
                                <?= form_error('pilih_jahitan'); ?>
                            </div>
                            <div class="form-group">
                                <label for="catatan">CATATAN TAMBAHAN</label>
                                <textarea class="form-control " id="catatan" name="catatan" placeholder="CATATAN TAMBAHAN"></textarea>
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
                                <select class="form-control  select2" id="request_id" name="request_id" autocomplete="off" data-placeholder="Pilih Request" style="width: 100%;">
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
                    <table class="table table-bordered table-stripped">
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
                            <!-- <tr>
                                <td></td>
                                <td class="text-right"></td>
                            </tr> -->
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
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                    <input type="hidden" id="id_order" name="id_order" value="<?= $id_order; ?>" />
                    <input type="hidden" id="sub_total_order" name="sub_total_order" value="0" />
                    <input type="hidden" id="kode_unik_order" name="kode_unik_order" value="<?= $kode_unik; ?>" />
                    <input type="hidden" id="grand_total_order" name="grand_total_order" value="0" />
                    <input type="hidden" id="dp_order" name="dp_order" value="0" />
                    <input type="hidden" id="lunas_order" name="lunas_order" value="0" />
                    <button type="submit" class="btn btn-primary btn-block btn-flat font-weight-bold" id="save_order">Save Order</button>
                    <a href="<?= base_url('order/index'); ?>" class="btn btn-secondary btn-block btn-flat font-weight-bold">Kembali Ke Order List</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Customer -->
<form id="form_cari_customer">
    <div class="modal fade" id="modal_cari_customer" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="customer_id">Customer</label>
                            <textarea class="form-control" name="customer_id" id="customer_id"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="pilih_customer">Pilih</button>
                </div>
            </div>
        </div>
    </div>
</form>