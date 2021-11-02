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
                                    <?php
                                    for ($i = 0; $i < $products['num_rows']; $i++) {
                                        $selected = ($this->input->get('product_id') == $products['data'][$i]['id']) ? "selected" : null;
                                    ?>
                                        <option value="<?= $products['data'][$i]['id']; ?>" <?= $selected; ?>><?= $products['data'][$i]['name']; ?></option>
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
                                        <button type="button" class="btn btn-primary btn-block btn-xs btn-flat" onclick="verifikasiDP(<?= $key->id; ?>)" <?= $disabled; ?>>Verifikasi DP</button>
                                    </td>
                                    <td class="p-0">
                                        <?php $disabled2 = ($key->status_pembayaran == "partial") ? "" : "disabled"; ?>
                                        <button type="button" class="btn btn-primary btn-block btn-xs btn-flat" onclick="verifikasiPelunasan(<?= $key->id; ?>)" <?= $disabled2; ?>>Verifikasi Pelunasan</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="p-0">
                                        <?php
                                        if ($key->status_pembayaran == "menunggu pembayaran") {
                                        ?>
                                            <button type="button" class="btn btn-info btn-block btn-xs btn-flat" onclick="checkDP(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>', '<?= $key->customer_id; ?>', '<?= $key->jenis_dp; ?>', '<?= $key->dp_value; ?>')">Tambah Data Pembayaran DP</button>
                                        <?php
                                        } elseif ($key->status_pembayaran == "partial") {
                                        ?>
                                            <button type="button" class="btn btn-info btn-block btn-xs btn-flat" onclick="checkPelunasan(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>', '<?= $key->customer_id; ?>', '<?= $key->jenis_dp; ?>', '<?= $key->dp_value; ?>', '<?= $key->pelunasan_value; ?>')">Tambah Data Pembayaran Pelunasan</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_verifikasi_dp" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi DP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="text-center" id="v_dp"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_verifikasi_pelunasan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi Pelunasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="text-center" id="v_pelunasan"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<form id="form_tambah_dp" enctype="multipart/form-data">
    <div class="modal fade" id="modal_tambah_dp" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran DP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="sales_invoice_dp">Sales Invoice</label>
                            <input type="text" class="form-control" id="sales_invoice_dp" name="sales_invoice_dp" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="created_at_dp">Tanggal & Pembayaran</label>
                            <input type="datetime-local" class="form-control" id="created_at_dp" name="created_at_dp" required />
                        </div>
                        <div class="form-group">
                            <label for="path_image_dp">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="path_image_dp" name="path_image_dp" accept=".jpg, .png, .jpeg" capture files required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_dp" name="id_dp" />
                    <input type="hidden" id="id_customer_dp" name="id_customer_dp" />
                    <input type="hidden" id="jenis_dp_dp" name="jenis_dp_dp" />
                    <input type="hidden" id="dp_value_dp" name="dp_value_dp" />
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form id="form_tambah_pelunasan" enctype="multipart/form-data">
    <div class="modal fade" id="modal_tambah_pelunasan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran DP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="sales_invoice_pelunasan">Sales Invoice</label>
                            <input type="text" class="form-control" id="sales_invoice_pelunasan" name="sales_invoice_pelunasan" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="created_at_pelunasan">Tanggal & Pembayaran</label>
                            <input type="datetime-local" class="form-control" id="created_at_pelunasan" name="created_at_pelunasan" required />
                        </div>
                        <div class="form-group">
                            <label for="path_image_pelunasan">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="path_image_pelunasan" name="path_image_pelunasan" accept=".jpg, .png, .jpeg" capture files required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_pelunasan" name="id_pelunasan" />
                    <input type="hidden" id="id_customer_pelunasan" name="id_customer_pelunasan" />
                    <input type="hidden" id="jenis_dp_pelunasan" name="jenis_dp" />
                    <input type="hidden" id="dp_value_pelunasan" name="dp_value_pelunasan" />
                    <input type="hidden" id="pelunasan_value_pelunasan" name="pelunasan_value_pelunasan" />
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>