<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Produksi List</h1>
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
                <form action="<?= base_url('produksi/index'); ?>" method="get">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Produksi Filter</h3>
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
                                    <?php
                                    foreach ($customers->result() as $customer) {
                                        $selected = ($this->input->get('customer_id') == $customer->id) ? "selected" : null;
                                    ?>
                                        <option value="<?= $customer->id; ?>" <?= $selected; ?>><?= $customer->name; ?> - <?= $customer->whatsapp; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="field">CARI BERDASARKAN</label>
                                <select class="form-control" id="field" name="field" required>
                                    <option value="all" <?= ($this->input->get('field') == "all") ? "selected" : null; ?>>SEMUA</option>
                                    <option value="created_at" <?= ($this->input->get('field') == "created_at") ? "selected" : null; ?>>TANGGAL ORDER</option>
                                    <option value="sales_invoice" <?= ($this->input->get('field') == "sales_invoice") ? "selected" : null; ?>>SALES INVOICE</option>
                                    <option value="whatsapp" <?= ($this->input->get('field') == "whatsapp") ? "selected" : null; ?>>NO WA</option>
                                    <option value="id_tokped" <?= ($this->input->get('field') == "id_tokped") ? "selected" : null; ?>>ID TOKPED</option>
                                    <option value="id_shopee" <?= ($this->input->get('field') == "id_shopee") ? "selected" : null; ?>>ID SHOPEE</option>
                                    <option value="id_instagram" <?= ($this->input->get('field') == "id_instagram") ? "selected" : null; ?>>ID INSTAGRAM</option>
                                    <option value="grand_total" <?= ($this->input->get('field') == "grand_total") ? "selected" : null; ?>>GRAND TOTAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keyword">KEYWORD</label>
                                <input type="text" class="form-control" id="keyword" name="keyword" minlength="1" maxlength="50" value="<?= ($this->input->get('keyword')) ?? null; ?>" placeholder="KEYWORD">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search"></i> Filter Produksi</button>
                            <a href="<?= base_url('produksi/index'); ?>" class="btn btn-secondary btn-block btn-flat">Reset Filter Produksi</a>
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
                                    <td>ESTIMASI SELESAI</td>
                                    <td><?= $key->estimasi_selesai; ?></td>
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
                                    <td>ADMIN ORDER</td>
                                    <td><?= $key->nama_admin_order; ?></td>
                                </tr>
                                <tr>
                                    <td>ADMIN PRODUKSI</td>
                                    <td><?= $key->nama_admin_produksi; ?></td>
                                </tr>
                                <tr>
                                    <td>PETUGAS POTONG KAIN</td>
                                    <td><?= $key->petugas_potong_kain; ?></td>
                                </tr>
                                <tr>
                                    <td>PETUGAS JAHIT</td>
                                    <td><?= $key->petugas_jahit; ?></td>
                                </tr>
                                <tr>
                                    <td>PETUGAS QC 1</td>
                                    <td><?= $key->petugas_qc_1; ?></td>
                                </tr>
                                <tr>
                                    <td>PETUGAS AKSESORIS</td>
                                    <td><?= $key->petugas_aksesoris; ?></td>
                                </tr>
                                <tr>
                                    <td>PETUGAS QC 2</td>
                                    <td><?= $key->petugas_qc_2; ?></td>
                                </tr>
                                <tr class="bg-dark">
                                    <td colspan="2" class="text-center pb-1 pt-1">
                                        AKSI
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-primary btn-block btn-xs btn-flat" onclick="printData(<?= $key->id; ?>)">Print Data Produksi</button>
                                    </td>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-secondary btn-block btn-xs btn-flat" onclick="inputHistory(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>', '<?= $key->id_petugas_potong_kain; ?>', '<?= $key->tanggal_potong_kain; ?>', '<?= $key->id_petugas_jahit; ?>', '<?= $key->tanggal_jahit; ?>', '<?= $key->id_petugas_qc_1; ?>', '<?= $key->tanggal_qc_1; ?>', '<?= $key->id_petugas_aksesoris; ?>', '<?= $key->tanggal_aksesoris; ?>', '<?= $key->id_petugas_qc_2; ?>', '<?= $key->tanggal_qc_2; ?>' );">Input History Produksi</button>
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
<form id="form_history">
    <div class="modal fade" id="modal_history" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input History Produksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="sales_invoice">Sales Invoice</label>
                            <input type="text" class="form-control" id="sales_invoice" name="sales_invoice" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="petugas_potong_kain">Petugas Potong Kain</label>
                            <select class="form-control" id="petugas_potong_kain" name="petugas_potong_kain">
                                <option value=""></option>
                                <?php foreach ($list_petugas_potong_kain->result() as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_potong_kain">Tanggal Potong Kain</label>
                            <input type="date" class="form-control" id="tanggal_potong_kain" name="tanggal_potong_kain" />
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="petugas_jahit">Petugas Jahit</label>
                            <select class="form-control" id="petugas_jahit" name="petugas_jahit">
                                <option value=""></option>
                                <?php foreach ($list_petugas_penjahit->result() as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_jahit">Tanggal Jahit</label>
                            <input type="date" class="form-control" id="tanggal_jahit" name="tanggal_jahit" />
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="petugas_qc_1">Petugas QC 1</label>
                            <select class="form-control" id="petugas_qc_1" name="petugas_qc_1">
                                <option value=""></option>
                                <?php foreach ($list_petugas_qc_1->result() as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_qc_1">Tanggal QC 1</label>
                            <input type="date" class="form-control" id="tanggal_qc_1" name="tanggal_qc_1" />
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="petugas_aksesoris">Petugas Aksesoris</label>
                            <select class="form-control" id="petugas_aksesoris" name="petugas_aksesoris">
                                <option value=""></option>
                                <?php foreach ($list_petugas_aksesoris->result() as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_aksesoris">Tanggal Aksesoris</label>
                            <input type="date" class="form-control" id="tanggal_aksesoris" name="tanggal_aksesoris" />
                        </div>
                        <hr />
                        <div class="form-group">
                            <label for="petugas_qc_2">Petugas QC 2</label>
                            <select class="form-control" id="petugas_qc_2" name="petugas_qc_2">
                                <option value=""></option>
                                <?php foreach ($list_petugas_qc_2->result() as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_qc_2">Tanggal QC 2</label>
                            <input type="date" class="form-control" id="tanggal_qc_2" name="tanggal_qc_2" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="order_id" name="order_id">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>