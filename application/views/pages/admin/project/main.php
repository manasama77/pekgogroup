<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Project</h1>
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
                        <h3 class="card-title">Project List</h3>

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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>NAMA PROJECT</th>
                                    <th>SINGKATAN</th>
                                    <th class="text-center">LOGO PROJECT</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($list); $i++) { ?>
                                    <tr>
                                        <td class="text-center"><?= $list[$i]['no']; ?></td>
                                        <td><?= $list[$i]['name']; ?></td>
                                        <td><?= $list[$i]['abbr']; ?></td>
                                        <td class="text-center">
                                            <img class="img-thumbnail" src="<?= $list[$i]['path_logo']; ?>" alt="Logo" style="width: 80px;">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info" onclick="modalEdit(<?= $list[$i]['id']; ?>, '<?= $list[$i]['name']; ?>', '<?= $list[$i]['abbr']; ?>');">EDIT</button>
                                            <?php if ($list[$i]['id'] != 1) { ?>
                                                <button type="button" class="btn btn-danger" onclick="destroy(<?= $list[$i]['id']; ?>, '<?= $list[$i]['name']; ?>')">DELETE</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-4">
                <form action="<?= base_url('project/index'); ?>" method="post" enctype="multipart/form-data">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Project</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">NAMA PROJECT</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA PROEJCT" minlength="4" maxlength="16" value="<?= set_value('name'); ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="abbr">SINGKATAN</label>
                                <input type="text" class="form-control" id="abbr" name="abbr" placeholder="SINGKATAN" minlength="2" maxlength="5" value="<?= set_value('abbr'); ?>" required>
                                <?= form_error('abbr'); ?>
                            </div>
                            <div class="form-group">
                                <label for="path_logo">LOGO PROJECT</label>
                                <input type="file" class="form-control" id="path_logo" name="path_logo" placeholder="LOGO PROJECT" accept=".jpg, .png, .jpeg" capture files required>
                                <div class="text-muted">Rekomendasi ukuran 512x512 px</div>
                                <?= form_error('path_logo'); ?>
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
<form id="form_edit" action="<?= base_url('project/update'); ?>" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="xname">NAMA PROJECT</label>
                            <input type="text" class="form-control" id="xname" name="xname" placeholder="NAMA PROEJCT" minlength="4" maxlength="16" required>
                        </div>
                        <div class="form-group">
                            <label for="xabbr">SINGKATAN</label>
                            <input type="text" class="form-control" id="xabbr" name="xabbr" placeholder="SINGKATAN" minlength="2" maxlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="xpath_logo">LOGO PROJECT</label>
                            <input type="file" class="form-control" id="xpath_logo" name="xpath_logo" placeholder="LOGO PROJECT" accept=".jpg, .png, .jpeg" capture files>
                            <div class="text-muted">Rekomendasi ukuran 512x512 px</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="xid" name="xid" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>