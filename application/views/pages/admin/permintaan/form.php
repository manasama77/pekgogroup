<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">TAMBAH PERMINTAAN</h1>
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
        <form id="form_barang" action="<?= base_url('permintaan/store'); ?>" method="POST">
            <div class="row">
                <div class="col-sm-12 col-lg-4 offset-lg-4">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Permintaan</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tanggal">Tanggal Permintaan</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" autocomplete="off" minlength="1" maxlength="255" required />
                            </div>
                            <div class="form-group">
                                <label for="request_item">Request Item</label>
                                <input type="text" class="form-control" id="request_item" name="request_item" placeholder="Request Item" autocomplete="off" minlength="1" maxlength="255" required />
                            </div>
                            <div class="form-group">
                                <label for="untuk">Untuk</label>
                                <input type="text" class="form-control" id="untuk" name="untuk" placeholder="Untuk" autocomplete="off" minlength="1" maxlength="255" required />
                            </div>
                            <div class="form-group">
                                <label for="barang_id">Barang</label>
                                <select class="form-control select2" id="barang_id" name="barang_id" autocomplete="off" data-placeholder="Pilih Barang" required>
                                    <option value=""></option>
                                    <?php foreach ($barangs->result() as $barang) { ?>
                                        <option value="<?= $barang->id; ?>" data-satuan="<?= $barang->nama_satuan; ?>"><?= $barang->name; ?> - <?= $barang->nama_merk; ?> - <?= $barang->nama_warna; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_barang_id">Kode</label>
                                <select class="form-control select2" id="sub_barang_id" name="sub_barang_id" autocomplete="off" data-placeholder="Pilih Kode" required disabled>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty" autocomplete="off" min="1" max="1000000" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="satuan">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-save fa-fw"></i> Save</button>
                            <a href="<?= base_url('permintaan/index'); ?>" class="btn btn-secondary btn-block btn-flat"><i class="fas fa-backward fa-fw"></i> Kembali ke List</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>