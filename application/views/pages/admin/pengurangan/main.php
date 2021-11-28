<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengurangan</h1>
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pengurangan List</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-1">
                        <div class="table-responsive">
                            <table class="table table-bordered datatables">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>TANGGAL</th>
                                        <th>UNTUK</th>
                                        <th>KETERANGAN</th>
                                        <th>KATEGORI</th>
                                        <th>BARANG</th>
                                        <th>KODE</th>
                                        <th class="text-right">QTY</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $itteration = 1;
                                    foreach ($list->result() as $key) {
                                    ?>
                                        <tr>
                                            <td><?= $itteration++; ?></td>
                                            <td><?= $key->tanggal; ?></td>
                                            <td><?= $key->untuk; ?></td>
                                            <td><?= nl2br($key->keterangan); ?></td>
                                            <td><?= $key->nama_kategori; ?></td>
                                            <td><?= $key->nama_barang; ?></td>
                                            <td><?= $key->kode_barang; ?></td>
                                            <td class="text-right"><?= $key->qty; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="destroy(<?= $key->id; ?>, '<?= urlencode($key->untuk); ?>');" title="Delete">DELETE</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>