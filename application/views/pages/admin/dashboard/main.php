<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-sm-6 col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Order (bulan ini)</span>
                        <span class="info-box-number"><?= $total_order; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-6 col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pendapatan (bulan ini)</span>
                        <span class="info-box-number">Rp.<?= number_format($pendapatan, 0); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-6 col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Customer</span>
                        <span class="info-box-number"><?= $total_customers; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-6 col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Customer (bulan ini)</span>
                        <span class="info-box-number"><?= $customers_this_month; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <form action="#" method="POST" id="form_track">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Track Order</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="keyword">Keyword</label>
                                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
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
                        <tbody id="v_track">
                            <tr>
                                <th class="text-center" colspan="13">Data Tidak Ditemukan</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>