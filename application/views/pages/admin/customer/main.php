<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Customer List</h1>
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
            <div class="col-sm-12 col-lg-4">
                <form action="<?= base_url('customer/index'); ?>" method="get">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Customer Filter</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="status">STATUS MEMBER</label>
                                <select class="form-control" id="status" name="status" autocomplete="off" required>
                                    <option value="aktif" <?= ($this->input->get('status') == "aktif") ? "selected" : null; ?>>AKTIF</option>
                                    <option value="tidak aktif" <?= ($this->input->get('status') == "tidak aktif") ? "selected" : null; ?>>TIDAK AKTIF</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="field">CARI BERDASARKAN</label>
                                <select class="form-control" id="field" name="field" autocomplete="off" required>
                                    <option value="all" <?= ($this->input->get('field') == "all") ? "selected" : null; ?>>SEMUA</option>
                                    <option value="name" <?= ($this->input->get('field') == "name") ? "selected" : null; ?>>NAMA</option>
                                    <option value="whatsapp" <?= ($this->input->get('field') == "whatsapp") ? "selected" : null; ?>>WHATSAPP</option>
                                    <option value="id_tokped" <?= ($this->input->get('field') == "id_tokped") ? "selected" : null; ?>>ID TOKPED</option>
                                    <option value="id_shopee" <?= ($this->input->get('field') == "id_shopee") ? "selected" : null; ?>>ID SHOPEE</option>
                                    <option value="id_instagram" <?= ($this->input->get('field') == "id_instagram") ? "selected" : null; ?>>ID INSTAGRAM</option>
                                    <option value="order_total" <?= ($this->input->get('field') == "order_total") ? "selected" : null; ?>>GRAND TOTAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keyword">KEYWORD</label>
                                <input type="text" class="form-control" id="keyword" name="keyword" minlength="1" maxlength="100" value="<?= ($this->input->get('keyword')) ? $this->input->get('keyword') : null; ?>" placeholder="KEYWORD">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fas fa-search"></i> Filter Customer</button>
                            <a href="<?= base_url('customer/index'); ?>" class="btn btn-secondary btn-block btn-flat">Reset Filter Customer</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($list != null) { ?>
        <div class="row">
            <div class="col-12">
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <blockquote class="elevation-2">
                    <p>
                        Total Data: <?= number_format($list->num_rows(), 0); ?> Data<br />
                        Cari Berdasarkan: <?= strtoupper($field_show); ?><br />
                        Status Member: <?= strtoupper($status_show); ?><br />
                        Keyword: <?= strtoupper($keyword_show); ?>
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card elevation-2 mb-5">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm bg-light">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>Whatsapp</th>
                                        <th>Nama</th>
                                        <th>ID Tokped</th>
                                        <th>ID Shopee</th>
                                        <th>ID Instagram</th>
                                        <th class="text-center">Status</th>
                                        <th>Jumlah Order</th>
                                        <th>Grand Total Order</th>
                                        <th>Pembatalan Order</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($list->num_rows() == 0) { ?>
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada data</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php foreach ($list->result() as $key) { ?>
                                            <tr>
                                                <td><?= $key->whatsapp; ?></td>
                                                <td><?= $key->name; ?></td>
                                                <td><?= $key->id_tokped; ?></td>
                                                <td><?= $key->id_shopee; ?></td>
                                                <td><?= $key->id_instagram; ?></td>
                                                <td class="text-center text-uppercase">
                                                    <?php if ($key->status == "aktif") { ?>
                                                        <span class="badge badge-success">Aktif</span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    <?php } ?>
                                                    <?php if ($key->status == 'tidak aktif') { ?>
                                                        <br />
                                                        (<?= $key->reason_inactive; ?>)
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?= number_format($key->order_created, 0); ?>
                                                </td>
                                                <td>
                                                    Rp.<?= number_format($key->order_total, 0); ?>
                                                </td>
                                                <td><?= number_format($key->order_canceled, 0); ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('customer/edit/' . $key->id); ?>" class="btn btn-info btn-xs">EDIT</a>
                                                        <button type="button" class="btn btn-danger btn-xs" onclick="destroy(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">HAPUS</button>
                                                        <?php if ($key->status == "aktif") { ?>
                                                            <button type="button" class="btn btn-warning btn-xs" onclick="modalBlokir(<?= $key->id; ?>, '<?= $key->whatsapp; ?>');">BLOKIR</button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url('customer/status/aktifkan/' . $key->id); ?>" class="btn btn-success btn-xs">AKTIFKAN</a>
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-secondary btn-xs" onclick="modalReset(<?= $key->id; ?>, '<?= $key->whatsapp; ?>')">RESET PASSWORD</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<form id="form_blokir">
    <div class="modal fade" id="modal_blokir" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Blokir Customer</h5>
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
                    <button type="submit" class="btn btn-primary">Blokir Customer</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="form_reset">
    <div class="modal fade" id="modal_reset" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="whatsapp_reset">WHATSAPP</label>
                            <input type="text" class="form-control" id="whatsapp_reset" name="whatsapp_reset" placeholder="WHATSAPP" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="new_password">PASSWORD BARU</label>
                            <input type="text" class="form-control" id="new_password" name="new_password" placeholder="NEW PASSWORD" autocomplete="new-password" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_reset" name="id_reset">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reset Password Customer</button>
                </div>
            </div>
        </div>
    </div>
</form>