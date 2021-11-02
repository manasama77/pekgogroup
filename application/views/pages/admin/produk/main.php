<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Produk List</h1>
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
        <?php if ($list != null) { ?>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Produk List</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('produk/add'); ?>" class="btn bg-gradient-green btn-xs btn-flat">
                                    <i class="fas fa-plus-circle fa-fw"></i> Tambah Produk
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">GAMBAR</th>
                                            <th>KODE PRODUK</th>
                                            <th>NAMA PRODUK</th>
                                            <th>HARGA</th>
                                            <th>WARNA</th>
                                            <th>UKURAN</th>
                                            <th>REQUEST</th>
                                            <th>HPP</th>
                                            <th class="text-center" style="width: 100px;"><i class="fas fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $itteration = 1;
                                        if ($list['num_rows'] == 0) {
                                            echo '<tr>';
                                            echo '<td class="text-center" colspan="10">Tidak ada data</td>';
                                            echo '</td>';
                                        } else {
                                            for ($i = 0; $i < $list['num_rows']; $i++) {
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?= $itteration++; ?></td>
                                                    <td class="text-center">
                                                        <img class="img-thumbnail" src="<?= base_url('assets/img/products/' . $list['data'][$i]['path_image']); ?>" alt="<?= $list['data'][$i]['path_image']; ?>" style="width: 100px;">
                                                    </td>
                                                    <td><?= $list['data'][$i]['code']; ?></td>
                                                    <td><?= $list['data'][$i]['name']; ?></td>
                                                    <td>Rp.<?= number_format($list['data'][$i]['price'], 0); ?></td>
                                                    <td><?= $list['data'][$i]['colors']; ?></td>
                                                    <td><?= $list['data'][$i]['sizes']; ?></td>
                                                    <td><?= $list['data'][$i]['requests']; ?></td>
                                                    <td><?= $list['data'][$i]['hpps']; ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="<?= base_url('produk/edit/' . $list['data'][$i]['id']); ?>" class="btn btn-info btn-sm">EDIT</a>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy(<?= $list['data'][$i]['id']; ?>, '<?= $list['data'][$i]['name']; ?>');">DELETE</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Modal -->
<form id="form_blokir">
    <div class="modal fade" id="modal_blokir" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Blokir Produk</h5>
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
                    <button type="submit" class="btn btn-primary">Blokir Produk</button>
                </div>
            </div>
        </div>
    </div>
</form>