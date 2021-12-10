<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Theme style -->
<link rel="stylesheet" media="screen" href="<?= base_url(); ?>assets/css/adminlte.min.css">
<link rel="stylesheet" media="print" href="<?= base_url(); ?>assets/css/adminlte.css">

<style media="print" type="text/css">
    .table-bordered .table-striped thead tbody tr td th {
        border: 1px solid #000 !important;
    }

    .table-bordered .table-striped tr th {
        color: #fff !important;
    }

    .table-striped {
        color: #000 !important;
    }
</style>

<div class="container">
    <div class="row d-flex justify-content-between">
        <div class="col-4 d-flex justify-content-start">
            <table class="table table-bordered small table-sm">
                <tr>
                    <td>SALES INVOICE</td>
                    <td><?= $data_orders[0]->sales_invoice; ?></td>
                </tr>
                <tr>
                    <td>TANGGAL & JAM ORDER</td>
                    <td><?= $data_orders[0]->created_at; ?></td>
                </tr>
                <tr>
                    <td>ESTIMASI SELESAI</td>
                    <td><?= $data_orders[0]->estimasi_selesai; ?></td>
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
    <div class="row d-flex justify-content-between">
        <div class="col-4 d-flex justify-content-start">
            <table class="table table-bordered table-striped small table-sm">
                <tr>
                    <th colspan="2" style="background-color: black !important; color: white;">INFORMASI PRODUK</th>
                </tr>
                <tr>
                    <td>PRODUK</td>
                    <td><?= $data_orders[0]->nama_produk; ?></td>
                </tr>
                <tr>
                    <td>UKURAN</td>
                    <td><?= $data_orders[0]->nama_ukuran; ?></td>
                </tr>
                <tr>
                    <td>WARNA</td>
                    <td><?= $data_orders[0]->nama_warna; ?></td>
                </tr>
                <tr>
                    <td>JAHITAN</td>
                    <td><?= strtoupper($data_orders[0]->pilih_jahitan); ?></td>
                </tr>
                <tr>
                    <td>REQUEST</td>
                    <td>
                        <?php foreach ($data_requests as $key) { ?>
                            <p><?= $key->name;; ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-1"></div>
        <div class="col-4 text-right">
            <table class="table table-bordered table-striped small table-sm">
                <tr>
                    <th style="background-color: black !important; color: white;">CATATAN</th>
                </tr>
                <tr>
                    <td style="height: 145px;"><?= $data_orders[0]->catatan; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6 offset-3">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark">
                    <tr>
                        <th colspan="2" class="text-center" style="background-color: black !important; color: white;">DETAIL HPP</th>
                    </tr>
                    <tr>
                        <th style="background-color: black !important; color: white;">ITEM</th>
                        <th class="text-right" style="background-color: black !important; color: white;">QTY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_hpps as $key) { ?>
                        <tr>
                            <td style="border: 1px solid #000;"><?= $key->name; ?></td>
                            <td class="text-right" style="border: 1px solid #000;">
                                <?= number_format($key->qty, 0); ?> <?= $key->satuan_unit; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark">
                    <tr>
                        <th colspan="2" class="text-center" style="background-color: black !important; color: white;">LIST PETUGAS</th>
                    </tr>
                    <tr>
                        <th style="background-color: black !important; color: white;">TUGAS</th>
                        <th class="text-center" style="background-color: black !important; color: white;">KARYAWAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 180px;">PETUGAS POTONG KAIN</td>
                        <td class="text-center">
                            <?= $data_karyawan['petugas_potong']; ?> <br /><?= $data_karyawan['tgl_potong']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>PETUGAS JAHIT</td>
                        <td class="text-center">
                            <?= $data_karyawan['petugas_jahit']; ?> <br /><?= $data_karyawan['tgl_jahit']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>PETUGAS QC 1</td>
                        <td class="text-center">
                            <?= $data_karyawan['petugas_qc_1']; ?> <br /><?= $data_karyawan['tgl_qc_1']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>PETUGAS AKSESORIS</td>
                        <td class="text-center">
                            <?= $data_karyawan['petugas_aksesoris']; ?> <br /><?= $data_karyawan['tgl_aksesoris']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>PETUGAS QC 2</td>
                        <td class="text-center">
                            <?= $data_karyawan['petugas_qc_2']; ?> <br /><?= $data_karyawan['tgl_qc_2']; ?>
                        </td>
                    </tr>
                </tbody>
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