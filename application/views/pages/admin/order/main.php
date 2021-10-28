<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Order List</h1>
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
            <div class="col-12">
                <form action="<?= base_url('order/index'); ?>" method="get">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Order Filter</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
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
                                        <label for="status_order">STATUS ORDER</label>
                                        <select class="form-control" id="status_order" name="status_order" required>
                                            <option value="all">SEMUA</option>
                                            <option value="order dibuat">ORDER DIBUAT</option>
                                            <option value="naik produksi">NAIK PRODUKSI</option>
                                            <option value="pengiriman">PENGIRIMAN</option>
                                            <option value="selesai">SELESAI</option>
                                            <option value="order dibatalkan">ORDER DIBATALKAN</option>
                                            <option value="retur pending">RETUR PENDING</option>
                                            <option value="retur terkirim">RETUR TERKIRIM</option>
                                            <option value="refund">REFUND</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status_pembayaran">STATUS PEMBAYARAN</label>
                                        <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                                            <option value="all">SEMUA</option>
                                            <option value="menunggu pembayaran">MENUNGGU PEMBAYARAN</option>
                                            <option value="partial">PARTIAL</option>
                                            <option value="lunas">LUNAS</option>
                                            <option value="melewati batas transfer">MELEWATI BATAS TRANSFER</option>
                                            <option value="refund pending">REFUND PENDING</option>
                                            <option value="refund selesai">REFUND SELESAI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="admin_order">ADMIN ORDER</label>
                                        <select class="form-control select2" id="admin_order" name="admin_order" required>
                                            <option value="all">SEMUA</option>
                                            <?php foreach ($admin_orders->result() as $admin_order) { ?>
                                                <option value="<?= $admin_order->id; ?>"><?= $admin_order->name; ?> - <?= $admin_order->whatsapp; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_produksi">ADMIN PRODUKSI</label>
                                        <select class="form-control select2" id="admin_produksi" name="admin_produksi" required>
                                            <option value="all">SEMUA</option>
                                            <?php foreach ($admin_produksis->result() as $admin_produksi) { ?>
                                                <option value="<?= $admin_produksi->id; ?>"><?= $admin_produksi->name; ?> - <?= $admin_produksi->whatsapp; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_cs">ADMIN CUSTOMER</label>
                                        <select class="form-control select2" id="admin_cs" name="admin_cs" required>
                                            <option value="all">SEMUA</option>
                                            <?php foreach ($admin_css->result() as $admin_cs) { ?>
                                                <option value="<?= $admin_cs->id; ?>"><?= $admin_cs->name; ?> - <?= $admin_cs->whatsapp; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_finance">ADMIN PEMBAYARAN</label>
                                        <select class="form-control select2" id="admin_finance" name="admin_finance" required>
                                            <option value="all">SEMUA</option>
                                            <?php foreach ($admin_finances->result() as $admin_finance) { ?>
                                                <option value="<?= $admin_finance->id; ?>"><?= $admin_finance->name; ?> - <?= $admin_finance->whatsapp; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="order_via">ORDER VIA</label>
                                        <select class="form-control" id="order_via" name="order_via" required>
                                            <option value="all">SEMUA</option>
                                            <option value="web">WEB</option>
                                            <option value="wa">WHATSAPP</option>
                                            <option value="tokped">TOKOPEDIA</option>
                                            <option value="shopee">SHOPEE</option>
                                            <option value="offline">OFFLINE</option>
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
                                        <input type="text" class="form-control" id="keyword" name="keyword" minlength="1" maxlength="50" value="<?= ($this->input->get('keyword')) ? $this->input->get('keyword') : null; ?>" placeholder="KEYWORD">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search"></i> Filter Order</button>
                            <a href="<?= base_url('order/index'); ?>" class="btn btn-secondary btn-block btn-flat">Reset Filter Order</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($list->num_rows() > 0) { ?>
        <div class="row">
            <div class="col-12">
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <blockquote class="elevation-2">
                    <p>
                        Total Data: <?= number_format($list->num_rows(), 0); ?> Data<br />
                        Cari Berdasarkan: <?= strtoupper($field_show); ?><br />
                        Status Member: <?= strtoupper($status_show); ?><br />
                        Keyword: <?= strtoupper($keyword_show); ?>
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
                                    <td>NAMA</td>
                                    <td><?= $key->name; ?></td>
                                </tr>
                                <tr>
                                    <td>NO WHATSAPP</td>
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
                                    <td style="vertical-align: top;">STATUS</td>
                                    <td>
                                        <?= strtoupper($key->status); ?>
                                        <?php if ($key->status == 'tidak aktif') { ?>
                                            <br />
                                            <?= $key->reason_inactive; ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>JUMLAH ORDER</td>
                                    <td><?= number_format($key->order_created, 0); ?></td>
                                </tr>
                                <tr>
                                    <td>GRAND TOTAL ORDER</td>
                                    <td>Rp.<?= number_format($key->order_total, 0); ?></td>
                                </tr>
                                <tr>
                                    <td>PEMBATALAN ORDER</td>
                                    <td><?= number_format($key->order_canceled, 0); ?></td>
                                </tr>
                                <tr class="bg-dark">
                                    <td colspan="2" class="text-center pb-1 pt-1">
                                        AKSI
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <a href="<?= base_url('order/edit/' . $key->id); ?>" class="btn btn-info btn-block btn-xs btn-flat">EDIT</a>
                                    </td>
                                    <td class="p-0">
                                        <button type="button" class="btn btn-danger btn-block btn-xs btn-flat" onclick="destroy(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">HAPUS</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <?php if ($key->status == "aktif") { ?>
                                            <button type="button" class="btn btn-danger btn-block btn-xs btn-flat" onclick="modalBlokir(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">BLOKIR</button>
                                        <?php } else { ?>
                                            <a href="<?= base_url('order/status/aktifkan/' . $key->id); ?>" class="btn btn-success btn-block btn-xs btn-flat">AKTIFKAN</a>
                                        <?php } ?>
                                    </td>
                                    <td class="p-0">
                                        <a href="#" class="btn btn-secondary  btn-block btn-xs btn-flat">RESET PASSWORD</a>
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
<form id="form_blokir">
    <div class="modal fade" id="modal_blokir" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Blokir Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="whatsapp_blokir">WHATSAPP</label>
                            <input type="text" class="form-control" id="whatsapp_blokir" name="whatsapp_blokir" placeholder="WHATSAPP" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="reason_inactive">ALASAN BLOKIR</label>
                            <textarea class="form-control" id="reason_inactive" name="reason_inactive" minlength="3" placeholder="Masukan Alsan Blokir" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_blokir" name="id_blokir">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Blokir Order</button>
                </div>
            </div>
        </div>
    </div>
</form>