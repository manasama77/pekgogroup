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
                            <div class="table-responsive">
                                <table class="table table-bordered datatables">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>NAMA</th>
                                            <th>NO WA</th>
                                            <th>ROLE</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center" style="width: 350px;"><i class="fas fa-cogs"></i></th>
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
                                                <td class="text-center">
                                                    <?php if ($key->status == 'aktif') { ?>
                                                        <span class="badge badge-pill badge-success"><?= ucwords($key->status); ?></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-pill badge-danger"><?= ucwords($key->status); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('admin/edit/' . $key->id); ?>" class="btn btn-info btn-sm">EDIT</a>
                                                        <?php if ($key->id != 1) { ?>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">DELETE</button>
                                                        <?php } ?>
                                                        <?php if ($key->status == "aktif") { ?>
                                                            <button type="button" class="btn btn-warning btn-sm" onclick="nonAktifKan(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">Non Aktifkan</button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-success btn-sm" onclick="aktifKan(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">AKTIFKAN</button>
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-dark btn-sm" onclick="modalResetPassword(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">RESET PASSWORD</button>
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
        <?php } ?>
    </div>
</div>

<!-- Modal -->
<form id="form_reset">
    <div class="modal fade" id="modal_reset" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="whatsapp">WHATSAPP</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WHATSAPP" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="New Password" minlength="4" maxlength="20" autocomplete="new-password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_reset" name="id_reset">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </div>
        </div>
    </div>
</form>