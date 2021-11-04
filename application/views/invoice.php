<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Theme style -->
<link rel="stylesheet" media="screen" href="<?= base_url(); ?>assets/css/adminlte.min.css">
<link rel="stylesheet" media="print" href="<?= base_url(); ?>assets/css/adminlte.css">

<style media="print" type="text/css">
    .table-bordered td,
    th {
        border: 1px solid #000 !important;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mb-2">
            <img src="<?= $path_logo; ?>" style="width: 100px;" />
        </div>
    </div>
    <div class="row d-flex justify-content-between">
        <div class="col-4 d-flex justify-content-start">
            <table class="table table-bordered small table-sm">
                <tr>
                    <td>TANGGAL & JAM ORDER</td>
                    <td><?= $data_orders[0]->created_at; ?></td>
                </tr>
                <tr>
                    <td>BATAS WAKTU TRANSFER</td>
                    <td><?= $data_orders[0]->batas_waktu_transfer; ?></td>
                </tr>
                <tr>
                    <td>SALES INVOICE</td>
                    <td><?= $data_orders[0]->sales_invoice; ?></td>
                </tr>
                <tr>
                    <td>ADMIN ORDER</td>
                    <td><?= $data_orders[0]->nama_admin_order; ?></td>
                </tr>
                <tr>
                    <td>ORDER VIA</td>
                    <td><?= strtoupper($data_orders[0]->order_via); ?></td>
                </tr>
            </table>
        </div>
        <div class="col-1"></div>
        <div class="col-4 text-right">
            <table class="table table-bordered small table-sm">
                <tr>
                    <td>CUSTOMER</td>
                    <td><?= $data_orders[0]->nama_customer; ?></td>
                </tr>
                <tr>
                    <td>NO WHATSAPP</td>
                    <td><?= $data_orders[0]->whatsapp; ?></td>
                </tr>
                <tr>
                    <td>ID TOKPED</td>
                    <td><?= $data_orders[0]->id_tokped; ?></td>
                </tr>
                <tr>
                    <td>ID SHOPEE</td>
                    <td><?= $data_orders[0]->id_shopee; ?></td>
                </tr>
                <tr>
                    <td>ID INSTAGRAM</td>
                    <td><?= strtoupper($data_orders[0]->id_instagram); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark">
                    <tr>
                        <th colspan="2" class="text-center" style="background-color: black !important; color: white;">DETAIL ORDER</th>
                    </tr>
                    <tr>
                        <th style="background-color: black !important; color: white;">ITEM</th>
                        <th class="text-right" style="background-color: black !important; color: white;">HARGA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $data_orders[0]->nama_produk; ?> Warna: <?= $data_orders[0]->nama_warna; ?></td>
                        <td class="text-right">Rp <?= number_format($data_orders[0]->harga_produk, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Ukuran: <?= $data_orders[0]->nama_ukuran; ?></td>
                        <td class="text-right">Rp <?= number_format($data_orders[0]->harga_ukuran, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Jahitan: <?= ucwords($data_orders[0]->pilih_jahitan); ?></td>
                        <td class="text-right">
                            <?php
                            if ($data_orders[0]->pilih_jahitan == "standard") {
                                $harga_jahitan = 0;
                            } elseif ($data_orders[0]->pilih_jahitan == "express") {
                                $harga_jahitan = 50000;
                            } elseif ($data_orders[0]->pilih_jahitan == "urgent") {
                                $harga_jahitan = 100000;
                            } elseif ($data_orders[0]->pilih_jahitan == "super urgent") {
                                $harga_jahitan = 150000;
                            }
                            ?>
                            Rp <?= number_format($data_orders[0]->harga_jahitan, 2); ?>
                        </td>
                    </tr>
                    <?php foreach ($data_requests as $key) { ?>
                        <tr>
                            <td>Request: <?= $key->name; ?></td>
                            <td class="text-right">Rp <?= number_format($key->cost, 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="bg-dark">
                    <tr>
                        <th class="text-right" style="background-color: black !important; color: white;">SUB TOTAL</th>
                        <th class="text-right" style="background-color: black !important; color: white;"><?= number_format($data_orders[0]->sub_total, 2); ?></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background-color: black !important; color: white;">KODE UNIK</th>
                        <th class="text-right" style="background-color: black !important; color: white;"><?= number_format($data_orders[0]->kode_unik, 2); ?></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background-color: black !important; color: white;">GRAND TOTAL</th>
                        <th class="text-right" style="background-color: black !important; color: white;"><?= number_format($data_orders[0]->grand_total, 2); ?></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background-color: black !important; color: white;">NILAI DP (<?= $data_orders[0]->jenis_dp; ?>%)</th>
                        <th class="text-right" style="background-color: black !important; color: white;"><?= number_format($data_orders[0]->dp_value, 2); ?></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background-color: black !important; color: white;">NILAI PELUNASAN (<?= 100 - $data_orders[0]->jenis_dp; ?>%)</th>
                        <th class="text-right" style="background-color: black !important; color: white;"><?= number_format($data_orders[0]->pelunasan_value, 2); ?></th>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color: black !important; color: white;">
                            CATATAN TAMBAHAN:<br />
                            <?= $data_orders[0]->catatan; ?>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    window.print()
</script>