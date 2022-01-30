<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Warna</h1>
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
                        <h3 class="card-title">Warna List</h3>
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
                                        <th>NAMA WARNA</th>
                                        <th>HEX WARNA</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i></th>
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
                                            <td>
                                                <div class="color-palette-set">
                                                    <div class="color-palette" style="background-color: <?= $key->hex; ?>;"><span class="text-white">&nbsp;</span></div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?= base_url('setup/parameter/warna/' . $key->id); ?>" class="btn btn-info">EDIT</a>
                                                    <button type="button" class="btn btn-danger" onclick="destroy(<?= $key->id; ?>, '<?= $key->name; ?>');">DELETE</button>
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
                <form action="<?= base_url('setup/parameter/warna'); ?>" method="post">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Warna</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">NAMA WARNA</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA WARNA" minlength="3" maxlength="20" value="<?= set_value('name'); ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="hex">HEX WARNA</label>
                                <input type="color" class="form-control" id="hex" name="hex" required />
                                <!-- <div class="input-group my-colorpicker2">
                                    <input type="text" id="hex" name="hex" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div> -->
                                <?= form_error('hex'); ?>
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