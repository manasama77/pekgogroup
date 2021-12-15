<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">REKAP CASHFLOW</h1>
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
                <form action="<?= base_url('rekap_cashflow/index'); ?>" method="get">
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
                                <label for="tahun">TAHUN</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" autocomplete="off" min="2000" max="2050" value="<?= $tahun; ?>" required />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search fa-fw"></i> Filter Data</button>
                            <a href="<?= base_url('rekap_cashflow/index'); ?>" class="btn btn-secondary btn-block btn-flat">Reset Filter Data</a>
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
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?= $list; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>