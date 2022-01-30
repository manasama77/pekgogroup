<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pembelian</h1>
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
                        <h3 class="card-title">Pembelian List</h3>

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
                                        <th>TANGGAL PEMBELIAN</th>
                                        <th>NO INVOICE</th>
                                        <th>SUPPLIER</th>
                                        <th>TOTAL</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $itteration = 1;
                                    for ($i = 0; $i < count($data); $i++) {
                                    ?>
                                        <tr>
                                            <td><?= $itteration++; ?></td>
                                            <td><?= $data[$i]['tanggal_pembelian']; ?></td>
                                            <td><?= $data[$i]['no_invoice']; ?></td>
                                            <td><?= $data[$i]['nama_supplier']; ?></td>
                                            <td><?= $data[$i]['total']; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning" onclick="detail(<?= $data[$i]['id']; ?>);">DETAIL</button>
                                                    <button type="button" class="btn btn-danger" onclick="destroy(<?= $data[$i]['id']; ?>, '<?= urlencode($data[$i]['no_invoice']); ?>');">DELETE</button>
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

<!-- Modal -->
<div class="modal fade" id="modal_detail" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETAIL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal Pembelian</th>
                                <th id="tanggal_pembelian"></th>
                            </tr>
                            <tr>
                                <th>No Invoice</th>
                                <th id="no_invoice"></th>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <th id="nama_supplier"></th>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <th id="total"></th>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Barang</th>
                                    <th>Kode</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Qty</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody id="v_barang">
                                <tr>
                                    <td colspan="5" class="text-center">-Tidak ada data-</td>
                                </tr>
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