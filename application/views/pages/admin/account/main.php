<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">AKUN</h1>
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
            <div class="col-lg-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">AKUN List</h3>

                        <div class="card-tools">
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
                                        <th>NO AKUN</th>
                                        <th>NAMA AKUN</th>
                                        <th>KELOMPOK AKUN</th>
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
                                            <td><?= $key->no_akun; ?></td>
                                            <td><?= $key->nama_akun; ?></td>
                                            <td class="text-uppercase"><?= $key->kelompok_akun; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info" onclick="modalEdit(<?= $key->id; ?>, '<?= urlencode($key->no_akun); ?>', '<?= urlencode($key->nama_akun); ?>', '<?= urlencode($key->account_group_id); ?>')">EDIT</button>
                                                    <button type="button" class="btn btn-danger" onclick="destroy(<?= $key->id; ?>, '<?= urlencode($key->nama_akun); ?>')">DELETE</button>
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
            <div class="col-lg-4">
                <form action="<?= base_url('account/index'); ?>" method="post">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Tambah AKUN</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="no_akun">NO AKUN</label>
                                <input type="text" class="form-control" id="no_akun" name="no_akun" placeholder="NO AKUN" minlength="3" maxlength="5" value="<?= set_value('no_akun'); ?>" required>
                                <?= form_error('no_akun'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nama_akun">NAMA AKUN</label>
                                <input type="text" class="form-control" id="nama_akun" name="nama_akun" placeholder="NAMA AKUN" minlength="3" maxlength="255" value="<?= set_value('nama_akun'); ?>" required>
                                <?= form_error('nama_akun'); ?>
                            </div>
                            <div class="form-group">
                                <label for="account_group_id">KELOMPOK AKUN</label>
                                <select class="form-control" id="account_group_id" name="account_group_id" autocomplete="off" required>
                                    <?php foreach ($account_groups->result() as $key) { ?>
                                        <option value="<?= $key->id; ?>"><?= $key->name; ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('account_group_id'); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required />
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<form id="form_edit" action="<?= base_url('account/update'); ?>" method="post">
    <div class="modal fade" id="modal_edit" tabindex="-1" data-backdrop="static" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit AKUN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="xno_akun">NO AKUN</label>
                            <input type="text" class="form-control" id="xno_akun" name="xno_akun" placeholder="NO AKUN" minlength="3" maxlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="xnama_akun">NAMA AKUN</label>
                            <input type="text" class="form-control" id="xnama_akun" name="xnama_akun" placeholder="NAMA AKUN" minlength="3" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="xaccount_group_id">KELOMPOK AKUN</label>
                            <select class="form-control" id="xaccount_group_id" name="xaccount_group_id" autocomplete="off" required>
                                <?php foreach ($account_groups->result() as $key) { ?>
                                    <option value="<?= $key->id; ?>"><?= $key->name; ?></option>
                                <?php } ?>
                            </select>
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