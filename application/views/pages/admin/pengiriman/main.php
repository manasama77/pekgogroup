<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengiriman List</h1>
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
                <form action="<?= base_url('pengiriman/index'); ?>" method="get">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Pengiriman Filter</h3>
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
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search"></i> Filter Pengiriman</button>
                            <a href="<?= base_url('Pengiriman/index'); ?>" class="btn btn-secondary btn-block btn-flat">Reset Filter Pengiriman</a>
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
                                    <td>ESTIMASI SELESAI</td>
                                    <td><?= $key->estimasi_selesai; ?></td>
                                </tr>
                                <tr>
                                    <td>TANGGAL & JAM PENGIRIMAN</td>
                                    <td><?= $key->tanggal_pengiriman; ?></td>
                                </tr>
                                <tr>
                                    <td>EKSPEDISI</td>
                                    <td><?= $key->ekspedisi; ?></td>
                                </tr>
                                <tr>
                                    <td>NO RESI</td>
                                    <td><?= $key->no_resi; ?></td>
                                </tr>
                                <tr>
                                    <td>ALAMAT PENGIRIMAN</td>
                                    <td><?= $key->alamat_pengiriman; ?></td>
                                </tr>
                                <tr>
                                    <td>STATUS PENGIRIMAN</td>
                                    <td><?= ucwords($key->status_pengiriman); ?></td>
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
                                    <td>GRAND TOTAL</td>
                                    <td>Rp <?= number_format($key->grand_total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td>ADMIN ORDER</td>
                                    <td><?= $key->nama_admin_order; ?></td>
                                </tr>
                                <tr>
                                    <td>ADMIN FINANCE</td>
                                    <td><?= $key->nama_admin_finance; ?></td>
                                </tr>
                                <tr>
                                    <td>ADMIN PRODUKSI</td>
                                    <td><?= $key->nama_admin_produksi; ?></td>
                                </tr>
                                <tr class="bg-dark">
                                    <td colspan="2" class="text-center pb-1 pt-1">
                                        AKSI
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-primary btn-block btn-xs btn-flat" onclick="historyPengiriman('<?= $key->no_resi; ?>', '<?= $key->ekspedisi; ?>')">History Pengiriman</button>
                                    </td>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-secondary btn-block btn-xs btn-flat" onclick="inputDataPengiriman(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>', '<?= $key->alamat_pengiriman; ?>')" <?php ($key->tanggal_pengiriman != null) ? "disabled" : null; ?>>Input Data Pengiriman</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0" colspan="2">
                                        <button type="button" class="btn btn-warning btn-block btn-xs btn-flat" onclick="selesaikanOrder(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>', '<?= $key->no_resi; ?>')" <?php ($key->tanggal_pengiriman == null) ? "disabled" : null; ?>>Selesaikan Order</button>
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
<div class="modal fade" id="modal_history_pengiriman" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">History Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="v_history">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<form id="form_pengiriman">
    <div class="modal fade" id="modal_pengiriman" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Data Pengiriman</h5>
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
                            <label for="tanggal_pengiriman">Tanggal & Jam Pengiriman</label>
                            <input type="datetime-local" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" required />
                        </div>
                        <div class="form-group">
                            <label for="ekspedisi">Ekspedisi</label>
                            <select class="form-control" id="ekspedisi" name="ekspedisi" required>
                                <option value=""></option>
                                <option value="POS">POS</option>
                                <option value="LION">LION</option>
                                <option value="NINJA">NINJA</option>
                                <option value="IDE">IDE</option>
                                <option value="SICEPAT">SICEPAT</option>
                                <option value="SAP">SAP</option>
                                <option value="NCS">NCS</option>
                                <option value="ANTERAJA">ANTERAJA</option>
                                <option value="REX">REX</option>
                                <option value="SENTRAL">SENTRAL</option>
                                <option value="WAHANA">WAHANA</option>
                                <option value="J&T">J&T</option>
                                <option value="JET">JET</option>
                                <option value="JNE">JNE</option>
                                <option value="TIKI">TIKI</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_resi">No Resi</label>
                            <input type="text" class="form-control" id="no_resi" name="no_resi" minlength="3" maxlength="30" required />
                        </div>
                        <div class="form-group">
                            <label for="alamat_pengiriman">Alamat Pengiriman</label>
                            <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" minlength="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_order" name="id_order" />
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>