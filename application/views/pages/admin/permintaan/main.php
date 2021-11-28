<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permintaan</h1>
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
                        <h3 class="card-title">Permintaan List</h3>

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
                                        <th>NAMA</th>
                                        <th>REQUEST ITEM</th>
                                        <th>UNTUK</th>
                                        <th>BARANG</th>
                                        <th>KODE</th>
                                        <th class="text-right">QTY</th>
                                        <th class="text-center">STATUS</th>
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
                                            <td><?= $key->nama; ?></td>
                                            <td><?= $key->request_item; ?></td>
                                            <td><?= $key->untuk; ?></td>
                                            <td><?= $key->nama_barang; ?> - <?= $key->nama_merk; ?> - <?= $key->nama_warna; ?></td>
                                            <td><?= $key->kode_barang; ?></td>
                                            <td class="text-right"><?= $key->qty; ?> <?= $key->nama_satuan; ?></td>
                                            <td class="text-center text-capitalize">
                                                <?php
                                                if ($key->status_permintaan == "pending") {
                                                    $color = "badge-secondary";
                                                } elseif ($key->status_permintaan == "order") {
                                                    $color = "badge-primary";
                                                } elseif ($key->status_permintaan == "selesai") {
                                                    $color = "badge-success";
                                                }
                                                ?>
                                                <span class="badge badge-pill <?= $color; ?>"><?= $key->status_permintaan; ?></span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php
                                                    if ($key->status_permintaan == "pending") {
                                                        echo '<button class="btn btn-primary" onclick="pendingToOrder(' . $key->id . ');">Pending <i class="fas fa-arrow-right"></i> Order</button>';
                                                    } elseif ($key->status_permintaan == "order") {
                                                        echo '<button class="btn btn-success" onclick="orderToSelesai(' . $key->id . ');">Order <i class="fas fa-arrow-right"></i> Selesai</button>';
                                                    }
                                                    ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="destroy(<?= $key->id; ?>, '<?= urlencode($key->untuk); ?>');" title="Delete">DELETE</button>
                                                </div>
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