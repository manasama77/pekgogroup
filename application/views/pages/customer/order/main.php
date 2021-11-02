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
        <?php if ($list->num_rows() > 0) { ?>
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
                                        <td>REQUEST</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-info" onclick="showRequest(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>')">Show</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CATATAN</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-info" onclick="showCatatan('<?= $key->catatan; ?>', '<?= $key->sales_invoice; ?>')">Show</button>
                                        </td>
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
                                        <td>TANGGAL PENGIRIMAN</td>
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
                                        <td>ADMIN ORDER</td>
                                        <td><?= $key->nama_admin_order; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ADMIN PRODUKSI</td>
                                        <td><?= $key->nama_admin_produksi; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ADMIN CS</td>
                                        <td><?= $key->nama_admin_cs; ?></td>
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
                                        <td class="p-0" colspan="2">
                                            <a href="<?= base_url('order/invoice/' . $key->id); ?>" class="btn btn-info btn-block btn-xs btn-flat" target="_blank">PRINT INVOICE</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0" colspan="2">
                                            <?php
                                            if ($key->status_pembayaran == "menunggu pembayaran") {
                                            ?>
                                                <button type="button" class="btn btn-success btn-block btn-xs btn-flat" onclick="pembayaranDP(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>')">Pembayaran DP</button>
                                            <?php } elseif ($key->status_pembayaran == "partial") { ?>
                                                <button type="button" class="btn btn-success btn-block btn-xs btn-flat" onclick="pembayaranPelunasan(<?= $key->id; ?>, '<?= $key->sales_invoice; ?>')">Pembayaran Pelunasan</button>
                                            <?php } ?>
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
</div>