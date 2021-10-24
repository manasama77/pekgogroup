<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Request - Edit</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form action="<?= base_url('setup/parameter/request/' . $list->row()->id); ?>" method="post">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Edit Request</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">NAMA REQUEST</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA REQUEST" minlength="1" maxlength="50" value="<?= (set_value('name')) ? set_value('name') : $list->row()->name; ?>" required>
                                <?= form_error('name'); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cost">BIAYA REQUEST</label>
                                <input type="number" class="form-control" id="cost" name="cost" placeholder="BIAYA UKURAN" min="0" max="1000000000" value="<?= (set_value('cost')) ? set_value('cost') : number_format($list->row()->cost, 0, '', ''); ?>" required>
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