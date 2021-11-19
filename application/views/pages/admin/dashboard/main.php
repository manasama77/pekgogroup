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
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Customer</span>
                        <span class="info-box-number"><?= $total_customers; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-6 col-lg-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Customer (bulan ini)</span>
                        <span class="info-box-number"><?= $customers_this_month; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>