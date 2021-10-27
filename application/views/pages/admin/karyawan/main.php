<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Karyawan</h1>
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
                        <h3 class="card-title">Karyawan List</h3>

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
                                    <th class="text-center">PHOTO</th>
                                    <th>NAMA KARYAWAN</th>
                                    <th>ROLE</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($list); $i++) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <img class="img-thumbnail" src="<?= $list[$i]['path_photo']; ?>" alt="Logo" style="width: 80px;">
                                        </td>
                                        <td><?= $list[$i]['name']; ?></td>
                                        <td>PETUGAS <?= strtoupper($list[$i]['role']); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info">EDIT</button>
                                            <button type="button" class="btn btn-danger">DELETE</button>
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
                <form action="<?= base_url('karyawan/index'); ?>" method="post" enctype="multipart/form-data">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Karyawan</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">NAMA KARYAWAN</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA KARYAWAN" minlength="4" maxlength="16" value="<?= set_value('name'); ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label>ROLE</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_potong_kain" value="potong kain" <?= set_radio('role', 'potong kain', true); ?>>
                                    <label class="form-check-label" for="role_potong_kain">
                                        Petugas Potong Kain
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_penjahit" value="penjahit" <?= set_radio('role', 'penjahit', false); ?>>
                                    <label class="form-check-label" for="role_penjahit">
                                        Petugas Penjahit
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_qc" value="qc" <?= set_radio('role', 'qc', false); ?>>
                                    <label class="form-check-label" for="role_qc">
                                        Petugas QC
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role_aksesoris" value="aksesoris" <?= set_radio('role', 'aksesoris', false); ?>>
                                    <label class="form-check-label" for="role_aksesoris">
                                        Petugas Aksesoris
                                    </label>
                                </div>
                                <?= form_error('role'); ?>
                            </div>
                            <div class="form-group">
                                <label for="path_photo">PHOTO</label>
                                <input type="file" class="form-control" id="path_photo" name="path_photo" placeholder="PHOTO" accept=".jpg, .png, .jpeg" capture files required>
                                <?= form_error('path_photo'); ?>
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