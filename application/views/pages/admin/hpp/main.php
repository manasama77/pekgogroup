<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">HPP</h1>
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
                        <h3 class="card-title">HPP List</h3>

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
                                    <th>NAMA HPP</th>
                                    <th>HPP</th>
                                    <th>SATUAN</th>
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
                                        <td><?= $key->name; ?></td>
                                        <td>Rp.<?= number_format($key->cost, 0); ?></td>
                                        <td><?= $key->unit_name; ?></td>
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
                <form action="<?= base_url('hpp/index'); ?>" method="post">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Tambah HPP</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">NAMA HPP</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA HPP" minlength="3" maxlength="20" value="<?= set_value('name'); ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="cost">HPP</label>
                                <input type="number" class="form-control" id="cost" name="cost" placeholder="HPP" min="0" max="1000000000" value="<?= set_value('cost'); ?>" required>
                                <?= form_error('cost'); ?>
                            </div>
                            <div class="form-group">
                                <label for="unit_id">SATUAN</label>
                                <select class="form-control" id="unit_id" name="unit_id" required>
                                    <?php foreach ($units->result() as $unit) { ?>
                                        <option value="<?= $unit->id; ?>"><?= $unit->name; ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('cost'); ?>
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