<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pembayaran List</h1>
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
        <div class="row">
            <div class="col-4">
                <form action="<?= base_url('pembayaran/index'); ?>" method="get">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Pembayaran Filter</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_id">PRODUK</label>
                                <select class="form-control select2" id="product_id" name="product_id" required>
                                    <option value="all">SEMUA</option>
                                    <?php for ($i = 0; $i < count($products); $i++) { ?>
                                        <option value="<?= $products[$i]['id']; ?>"><?= $products[$i]['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customer_id">CUSTOMER</label>
                                <select class="form-control select2" id="customer_id" name="customer_id" required>
                                    <option value="all">SEMUA</option>
                                    <?php foreach ($customers->result() as $customer) { ?>
                                        <option value="<?= $customer->id; ?>"><?= $customer->name; ?> - <?= $customer->whatsapp; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="field">CARI BERDASARKAN</label>
                                <select class="form-control" id="field" name="field" required>
                                    <option value="all">SEMUA</option>
                                    <option value="created_at">TANGGAL ORDER</option>
                                    <option value="sales_invoice">SALES INVOICE</option>
                                    <option value="whatsapp">NO WA</option>
                                    <option value="id_tokped">ID TOKPED</option>
                                    <option value="id_shopee">ID SHOPEE</option>
                                    <option value="id_instagram">ID INSTAGRAM</option>
                                    <option value="grand_total">GRAND TOTAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keyword">KEYWORD</label>
                                <input type="text" class="form-control" id="keyword" name="keyword" minlength="1" maxlength="50" value="<?= ($this->input->get('keyword')) ?? null; ?>" placeholder="KEYWORD">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search"></i> Filter Pembayaran</button>
                            <a href="<?= base_url('pembayaran/index'); ?>" class="btn btn-secondary btn-block btn-flat">Reset Filter Pembayaran</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($list != null) { ?>
        <div class="row">
            <div class="col-12">
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <blockquote class="elevation-2">
                    <p>
                        Total Data: <?= number_format($list->num_rows(), 0); ?> Data
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <?php foreach ($list->result() as $key) { ?>
                <div class="col-lg-4">
                    <div class="card card-primary elevation-3">
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped table-valign-middle table-sm small">
                                <tr>
                                    <td>SALES INVOICE</td>
                                    <td><?= $key->sales_invoice; ?></td>
                                </tr>
                                <tr>
                                    <td>TANGGAL & JAM ORDER</td>
                                    <td><?= $key->created_at; ?></td>
                                </tr>
                                <tr>
                                    <td>BATAS WAKTU TRANSFER</td>
                                    <td><?= $key->batas_waktu_transfer; ?></td>
                                </tr>
                                <tr>
                                    <td>ORDER VIA</td>
                                    <td><?= strtoupper($key->order_via); ?></td>
                                </tr>
                                <tr>
                                    <td>PRODUK</td>
                                    <td><?= $key->nama_produk; ?></td>
                                </tr>
                                <tr>
                                    <td>WARNA</td>
                                    <td><?= $key->nama_warna; ?></td>
                                </tr>
                                <tr>
                                    <td>UKURAN</td>
                                    <td><?= $key->nama_ukuran; ?></td>
                                </tr>
                                <tr>
                                    <td>JAHITAN</td>
                                    <td><?= strtoupper($key->pilih_jahitan); ?></td>
                                </tr>
                                <tr>
                                    <td>CUSTOMER</td>
                                    <td><?= $key->nama_customer; ?></td>
                                </tr>
                                <tr>
                                    <td>WHATSAPP</td>
                                    <td><?= $key->whatsapp; ?></td>
                                </tr>
                                <tr>
                                    <td>ID TOKPED</td>
                                    <td><?= $key->id_tokped; ?></td>
                                </tr>
                                <tr>
                                    <td>ID SHOPEE</td>
                                    <td><?= $key->id_shopee; ?></td>
                                </tr>
                                <tr>
                                    <td>ID INSTAGRAM</td>
                                    <td><?= $key->id_instagram; ?></td>
                                </tr>
                                <tr>
                                    <td>STATUS ORDER</td>
                                    <td><?= strtoupper($key->status_order); ?></td>
                                </tr>
                                <tr>
                                    <td>STATUS PEMBAYARAN</td>
                                    <td><?= strtoupper($key->status_pembayaran); ?></td>
                                </tr>
                                <tr>
                                    <td>GRAND TOTAL</td>
                                    <td>Rp <?= number_format($key->grand_total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td>DP (<?= $key->jenis_dp; ?>%)</td>
                                    <td>Rp <?= number_format($key->dp_value, 2); ?></td>
                                </tr>
                                <tr>
                                    <td>PELUNASAN</td>
                                    <td>Rp <?= number_format($key->pelunasan_value, 2); ?></td>
                                </tr>
                                <tr>
                                    <td>ADMIN ORDER</td>
                                    <td><?= $key->nama_admin_order; ?></td>
                                </tr>
                                <tr>
                                    <td>ADMIN FINANCE</td>
                                    <td><?= $key->nama_admin_finance; ?></td>
                                </tr>
                                <tr class="bg-dark">
                                    <td colspan="2" class="text-center pb-1 pt-1">
                                        AKSI
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <?php $disabled = ($key->status_pembayaran == "menunggu pembayaran") ? "" : "disabled"; ?>
                                        <button type="button" class="btn btn-info btn-block btn-xs btn-flat" onclick="verifikasiDP(<?= $key->id; ?>)" <?= $disabled; ?>>Verifikasi DP</button>
                                    </td>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-info btn-block btn-xs btn-flat">Verifikasi Pelunasan</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-info btn-block btn-xs btn-flat">Batalkan Order</button>
                                    </td>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-info btn-block btn-xs btn-flat">Tambah Data Pembayaran</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_verifikasi_dp" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi DP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="v_dp">
                </div>
            </div>
        </div>
    </div>
</div>