<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">CASHFLOW BANK BCA</h1>
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
            <div class="col-sm-12 col-lg-4">
                <form action="<?= base_url('cashflow_bca/index'); ?>" method="get">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Cashflow Filter</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="from">From Date</label>
                                <input type="date" class="form-control" id="from" name="from" autocomplete="off" value="<?= $from; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="to">To Date</label>
                                <input type="date" class="form-control" id="to" name="to" autocomplete="off" value="<?= $to; ?>" required />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search fa-fw"></i> Filter Data</button>
                            <a href="<?= base_url('cashflow_bca/index'); ?>" class="btn btn-secondary btn-block btn-flat">Reset Filter Data</a>
                            <a href="<?= base_url('cashflow_bca/add'); ?>" class="btn btn-success btn-block btn-flat"><i class="fas fa-plus fa-fw"></i> Tambah Data Cashflow</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($list['code'] == 200) { ?>
        <div class="row">
            <div class="col-12">
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <blockquote class="elevation-2">
                    <p>
                        Total Data: <?= number_format(count($list['data']), 0); ?> Data<br />
                        From Date: <?= $from; ?><br />
                        To Date: <?= $to; ?><br />
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table1" class="table table-bordered table-striped table-sm bg-light">
                                <caption>Data Cashflow Bank BCA <?= $from; ?> - <?= $to; ?></caption>
                                <thead class="bg-gradient-dark">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Akun</th>
                                        <th>No Voucher</th>
                                        <th>Dari / Untuk</th>
                                        <th>Keterangan</th>
                                        <th class="text-right">Debet</th>
                                        <th class="text-right">Kredit</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($list['data']) == 0) { ?>
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php for ($i = 0; $i < count($list['data']); $i++) { ?>
                                            <tr>
                                                <td><?= $list['data'][$i]['tanggal']; ?></td>
                                                <td><?= $list['data'][$i]['no_akun']; ?> <?= $list['data'][$i]['nama_akun']; ?></td>
                                                <td><?= $list['data'][$i]['no_voucher']; ?></td>
                                                <td><?= $list['data'][$i]['dari_untuk']; ?></td>
                                                <td><?= $list['data'][$i]['keterangan']; ?></td>
                                                <td class="text-right"><?= $list['data'][$i]['debet']; ?></td>
                                                <td class="text-right"><?= $list['data'][$i]['kredit']; ?></td>
                                                <td class="text-right <?= ($list['data'][$i]['total'] < 0) ? "text-danger" : "text-black"; ?>"><strong><?= $list['data'][$i]['total']; ?></strong></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<form id="form_blokir">
    <div class="modal fade" id="modal_blokir" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Blokir Customer</h5>
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
                    <button type="submit" class="btn btn-primary">Blokir Customer</button>
                </div>
            </div>
        </div>
    </div>
</form>