<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admin List</h1>
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
                            <h3 class="card-title">Admin List</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('admin/add'); ?>" class="btn bg-gradient-green btn-xs btn-flat">
                                    <i class="fas fa-plus-circle fa-fw"></i> Tambah Admin
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>NAMA</th>
                                        <th>NO WA</th>
                                        <th>ROLE</th>
                                        <th>STATUS</th>
                                        <th class="text-center" style="width: 340px;"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $itteration = 1;
                                    foreach ($list->result() as $key) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $itteration++; ?></td>
                                            <td><?= $key->name; ?></td>
                                            <td><?= $key->whatsapp; ?></td>
                                            <td><?= strtoupper($key->role); ?></td>
                                            <td><?= strtoupper($key->status); ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?= base_url('admin/edit/' . $key->id); ?>" class="btn btn-info btn-sm">EDIT</a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="destroy(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">DELETE</button>
                                                    <button type="button" class="btn btn-success btn-sm" onclick="X(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">AKTIFKAN</button>
                                                    <button type="button" class="btn btn-dark btn-sm" onclick="destroy(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">RESET PASSWORD</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
                    <h5 class="modal-title">Blokir Admin</h5>
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
                    <button type="submit" class="btn btn-primary">Blokir Admin</button>
                </div>
            </div>
        </div>
    </div>
</form>