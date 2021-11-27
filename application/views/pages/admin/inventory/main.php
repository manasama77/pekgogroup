<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Invetory</h1>
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
                        <h3 class="card-title">Inventory List</h3>

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
                            <table class="table table-bordered">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>KATEGORI</th>
                                        <th>NAMA BARANG</th>
                                        <th>MERK</th>
                                        <th>WARNA</th>
                                        <th>SATUAN</th>
                                        <th>TOTAL STOCK</th>
                                        <th>SUPPLIER</th>
                                        <th>KODE</th>
                                        <th>HARGA</th>
                                        <th>STOCK</th>
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
                                            <td><?= $data[$i]['nama_kategori']; ?></td>
                                            <td><?= $data[$i]['name']; ?></td>
                                            <td><?= $data[$i]['nama_merk']; ?></td>
                                            <td><?= $data[$i]['nama_warna']; ?></td>
                                            <td><?= $data[$i]['nama_satuan']; ?></td>
                                            <td><?= $data[$i]['stock']; ?></td>
                                            <td>
                                                <?php
                                                if (count($data[$i]['sub']) > 0) {
                                                    echo '<ul class="p-2">';
                                                    for ($j = 0; $j < count($data[$i]['sub']); $j++) {
                                                        echo '<li>';
                                                        echo $data[$i]['sub'][$j]['nama_supplier'];
                                                        echo '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (count($data[$i]['sub']) > 0) {
                                                    echo '<ul class="p-2">';
                                                    for ($j = 0; $j < count($data[$i]['sub']); $j++) {
                                                        echo '<li>';
                                                        echo $data[$i]['sub'][$j]['kode'];
                                                        echo '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (count($data[$i]['sub']) > 0) {
                                                    echo '<ul class="p-2">';
                                                    for ($j = 0; $j < count($data[$i]['sub']); $j++) {
                                                        echo '<li>';
                                                        echo "Rp." . $data[$i]['sub'][$j]['harga'];
                                                        echo '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (count($data[$i]['sub']) > 0) {
                                                    echo '<ul class="p-2">';
                                                    for ($j = 0; $j < count($data[$i]['sub']); $j++) {
                                                        echo '<li>';
                                                        echo $data[$i]['sub'][$j]['stock'];
                                                        echo '</li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('inventory/edit/' . $data[$i]['id']); ?>" class="btn btn-info">EDIT</a>
                                                <button type="button" class="btn btn-danger" onclick="destroy(<?= $data[$i]['id']; ?>, '<?= urlencode($data[$i]['name']); ?>')">DELETE</button>
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
<form id="form_edit" action="<?= base_url('supplier/update'); ?>" method="post">
    <div class="modal fade" id="modal_edit" tabindex="-1" data-backdrop="static" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit SUPPLIER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="xname">NAMA SUPPLIER</label>
                            <input type="text" class="form-control" id="xname" name="xname" placeholder="NAMA SUPPLIER" minlength="3" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="xlocation">LOKASI</label>
                            <input type="text" class="form-control" id="xlocation" name="xlocation" placeholder="LOKASI" minlength="3" maxlength="255" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                    <input type="hidden" id="xid" name="xid" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>