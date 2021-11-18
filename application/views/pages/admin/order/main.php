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
            <div class="col-6">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="filter_product_id">PRODUK</label>
                                        <select class="form-control select2" id="filter_product_id" name="filter_product_id" required>
                                            <option value="all">SEMUA</option>
                                            <?php for ($i = 0; $i < $products['num_rows']; $i++) { ?>
                                                <option value="<?= $products['data'][$i]['id']; ?>" <?= ($filter_product_id == $products['data'][$i]['id']) ? "selected" : null; ?>><?= $products['data'][$i]['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_customer_id">CUSTOMER</label>
                                        <select class="form-control select2" id="filter_customer_id" name="filter_customer_id" required>
                                            <option value="all">SEMUA</option>
                                            <?php foreach ($customers->result() as $customer) { ?>
                                                <option value="<?= $customer->id; ?>" <?= ($filter_customer_id == $customer->id) ? "selected" : null; ?>><?= $customer->name; ?> - <?= $customer->whatsapp; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_order_via">ORDER VIA</label>
                                        <select class="form-control" id="filter_order_via" name="filter_order_via" required>
                                            <option value="all" <?= ($filter_order_via == "all") ? "selected" : null; ?>>SEMUA</option>
                                            <option value="web" <?= ($filter_order_via == "web") ? "selected" : null; ?>>WEB</option>
                                            <option value="wa" <?= ($filter_order_via == "wa") ? "selected" : null; ?>>WHATSAPP</option>
                                            <option value="tokped" <?= ($filter_order_via == "tokped") ? "selected" : null; ?>>TOKOPEDIA</option>
                                            <option value="shopee" <?= ($filter_order_via == "shopee") ? "selected" : null; ?>>SHOPEE</option>
                                            <option value="offline" <?= ($filter_order_via == "offline") ? "selected" : null; ?>>OFFLINE</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
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
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="filter_status_order">STATUS ORDER</label>
                                        <select class="form-control" id="filter_status_order" name="filter_status_order" required>
                                            <option value="all" <?= ($filter_status_order == "all") ? "selected" : null; ?>>SEMUA</option>
                                            <option value="order dibuat" <?= ($filter_status_order == "order dibuat") ? "selected" : null; ?>>ORDER DIBUAT</option>
                                            <option value="naik produksi" <?= ($filter_status_order == "naik produksi") ? "selected" : null; ?>>NAIK PRODUKSI</option>
                                            <option value="pengiriman" <?= ($filter_status_order == "pengiriman") ? "selected" : null; ?>>PENGIRIMAN</option>
                                            <option value="selesai" <?= ($filter_status_order == "selesai") ? "selected" : null; ?>>SELESAI</option>
                                            <option value="order dibatalkan" <?= ($filter_status_order == "order dibatalkan") ? "selected" : null; ?>>ORDER DIBATALKAN</option>
                                            <option value="retur pending" <?= ($filter_status_order == "retur pending") ? "selected" : null; ?>>RETUR PENDING</option>
                                            <option value="retur terkirim" <?= ($filter_status_order == "retur terkirim") ? "selected" : null; ?>>RETUR TERKIRIM</option>
                                            <option value="refund" <?= ($filter_status_order == "refund") ? "selected" : null; ?>>REFUND</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_status_pembayaran">STATUS PEMBAYARAN</label>
                                        <select class="form-control" id="filter_status_pembayaran" name="filter_status_pembayaran" required>
                                            <option value="all" <?= ($filter_status_pembayaran == "refund") ? "selected" : null; ?>>SEMUA</option>
                                            <option value="menunggu pembayaran" <?= ($filter_status_pembayaran == "menunggu pembayaran") ? "selected" : null; ?>>MENUNGGU PEMBAYARAN</option>
                                            <option value="partial" <?= ($filter_status_pembayaran == "partial") ? "selected" : null; ?>>PARTIAL</option>
                                            <option value="lunas" <?= ($filter_status_pembayaran == "lunas") ? "selected" : null; ?>>LUNAS</option>
                                            <option value="melewati batas transfer" <?= ($filter_status_pembayaran == "melewati batas transfer") ? "selected" : null; ?>>MELEWATI BATAS TRANSFER</option>
                                            <option value="refund pending" <?= ($filter_status_pembayaran == "refund pending") ? "selected" : null; ?>>REFUND PENDING</option>
                                            <option value="refund selesai" <?= ($filter_status_pembayaran == "refund selesai") ? "selected" : null; ?>>REFUND SELESAI</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_sales_invoice">SALES INVOICE</label>
                                        <input type="text" class="form-control" id="filter_sales_invoice" name="filter_sales_invoice" minlength="1" maxlength="15" value="<?= ($this->input->get('filter_sales_invoice')) ? $this->input->get('filter_sales_invoice') : null; ?>" placeholder="Sales Invoice">
                                    </div>
                                    <!-- <div class="form-group">
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
                                    </div> -->
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
    <?php if ($this->input->get('filter_product_id')) { ?>
        <div class="row">
            <div class="col-12">
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <blockquote class="elevation-2">
                    <p>
                        Total Data: <?= number_format($total_data, 0); ?> Data
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Order List</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if ($list->num_rows() == 0) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <i class="fas fa-cogs"></i>
                                            </th>
                                            <th>Sales Invoice</th>
                                            <th>Tanggal & Jam Order</th>
                                            <th>Estimasi Selesai</th>
                                            <th>Order Via</th>
                                            <th>Customer</th>
                                            <th>Whatsapp</th>
                                            <th>Produk</th>
                                            <th>Warna</th>
                                            <th>Ukuran</th>
                                            <th>Jahitan</th>
                                            <th>Status Order</th>
                                            <th>Status Pembayaran</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center" colspan="14">Data Tidak Ditemukan</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="table-responsive mb-5">
                                <table class="table table-bordered table-striped table-sm" stlye="min-height: 500px; height: 500px;">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="text-center">
                                                <i class="fas fa-cogs"></i>
                                            </th>
                                            <th>Sales Invoice</th>
                                            <th>Tanggal & Jam Order</th>
                                            <th>Estimasi Selesai</th>
                                            <th>Order Via</th>
                                            <th>Customer</th>
                                            <th>Whatsapp</th>
                                            <th>Produk</th>
                                            <th>Warna</th>
                                            <th>Ukuran</th>
                                            <th>Jahitan</th>
                                            <th>Status Order</th>
                                            <th>Status Pembayaran</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($list->result() as $key) { ?>
                                            <tr>
                                                <th>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary btn-sm btn-flat dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <button type="button" class="dropdown-item" onclick="showDetail(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>')"><i class="fas fa-eye fa-fw"></i> Detail</button>
                                                            <button type="button" class="dropdown-item" onclick="comingSoon();"><i class="fas fa-pencil-alt fa-fw"></i> EDIT</button>
                                                            <button type="button" class="dropdown-item" onclick="comingSoon();"><i class="fas fa-trash fa-fw"></i> HAPUS</button>
                                                            <button type="button" class="dropdown-item" onclick="copyOrder(<?= $key->id; ?>, <?= $key->product_id; ?>, <?= $key->color_id; ?>, <?= $key->size_id; ?>, <?= $key->kode_unik; ?>, <?= $key->jenis_dp; ?>, '<?= $key->pilih_jahitan; ?>');"><i class="fas fa-copy fa-fw"></i> COPY DETAIL ORDER</button>
                                                            <a href="<?= base_url('order/invoice/' . $key->id); ?>" class="dropdown-item" target="_blank"><i class="fas fa-print fa-fw"></i> PRINT INVOICE</a>
                                                            <hr />
                                                            <a href="<?= base_url('pembayaran/index?product_id=' . $key->product_id . '&customer_id=' . $key->customer_id . '&field=sales_invoice&keyword=' . $key->sales_invoice); ?>" class="dropdown-item" target="_blank">DATA PEMBAYARAN</a>
                                                            <a href="<?= base_url('produksi/index?product_id=' . $key->product_id . '&customer_id=' . $key->customer_id . '&field=sales_invoice&keyword=' . $key->sales_invoice); ?>" class="dropdown-item" target="_blank">DATA PRODUKSI</a>
                                                            <a href="<?= base_url('pengiriman/index?product_id=' . $key->product_id . '&customer_id=' . $key->customer_id . '&field=sales_invoice&keyword=' . $key->sales_invoice); ?>" class="dropdown-item" target="_blank">DATA PENGIRIMAN</a>
                                                            <button type="button" class="dropdown-item" onclick="comingSoon()">DATA PENGADUAN</button>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th><?= $key->sales_invoice; ?></th>
                                                <th><?= $key->created_at; ?></th>
                                                <th><?= $key->estimasi_selesai; ?></th>
                                                <th><?= strtoupper($key->order_via); ?></th>
                                                <th><?= $key->nama_customer; ?></th>
                                                <th><?= $key->whatsapp; ?></th>
                                                <th><?= $key->nama_produk; ?></th>
                                                <th><?= $key->nama_warna; ?></th>
                                                <th><?= $key->nama_ukuran; ?></th>
                                                <th><?= strtoupper($key->pilih_jahitan); ?></th>
                                                <th><?= strtoupper($key->status_order); ?></th>
                                                <th><?= strtoupper($key->status_pembayaran); ?></th>
                                                <th>Rp <?= number_format($key->grand_total, 2); ?></th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?= $this->pagination->create_links(); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Detail <span id="v_sales_invoice"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody id="v_detail">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>