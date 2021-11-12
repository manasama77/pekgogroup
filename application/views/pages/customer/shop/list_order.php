<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="site-blocks-table">

                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong><?= $this->session->flashdata('success'); ?></strong>
                        </div>
                    <?php } ?>

                    <h1>List Order</h1>
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th style="min-width: 150px;">Image</th>
                                <th style="min-width: 160px;">Tanggal Order</th>
                                <th>Sales Invoice</th>
                                <th style="min-width: 250px;">Product</th>
                                <th style="min-width: 150px;">Total</th>
                                <th style="min-width: 150px;">Status Order</th>
                                <th>Status Pembayaran</th>
                                <th>
                                    <i class="fas fa-cogs"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders->result() as $order) { ?>
                                <tr>
                                    <td>
                                        <img src="<?= base_url('assets/img/products/' . $order->path_image); ?>" alt="Image" class="img-fluid img-thumbnail">
                                    </td>
                                    <td>
                                        <?= $order->created_at; ?>
                                    </td>
                                    <td class="text-black">
                                        <?= $order->sales_invoice; ?>
                                    </td>
                                    <td class="text-black">
                                        <?= $order->product_name; ?><br />
                                        <small>
                                            Color: <?= $order->color_name; ?><br />
                                            Size: <?= $order->size_name; ?><br />
                                            Jahitan: <?= ucwords($order->pilih_jahitan); ?>
                                        </small>
                                    </td>
                                    <td>Rp. <?= number_format($order->grand_total, 2, ',', '.'); ?></td>
                                    <td><?= ucwords($order->status_order); ?></td>
                                    <td>
                                        <?= ucwords($order->status_pembayaran); ?><br />
                                        <?php if ($order->status_pembayaran == "menunggu pembayaran") { ?>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="showModalDP(<?= $order->id; ?>, '<?= $order->sales_invoice; ?>');">Upload Pembayaran DP</button>
                                        <?php } ?>
                                        <?php if ($order->status_pembayaran == "partial") { ?>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="showModalPelunasan(<?= $order->id; ?>, '<?= $order->sales_invoice; ?>');">Upload Pembayaran Pelunasan</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm" title="Lihat Detail" onclick="showModalDetail(<?= $order->id; ?>, '<?= $order->sales_invoice; ?>');">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <?php if ($order->status_pembayaran == "pengiriman") { ?>
                                                <button class="btn btn-dark btn-sm" title="Lihat Detail">
                                                    <i class="fas fa-map"></i>
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <!-- <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul> -->
                        <?= $this->pagination->create_links(); ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Order - <span id="sales_invoice_detail"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <tbody id="v_detail"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<form id="form_dp" action="<?= base_url('shop/store_dp'); ?>" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modal_dp" tabindex="-1" data-backdrop="static" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Pembayaran DP - <span id="sales_invoice_dp"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="path_image_dp">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="path_image_dp" name="path_image_dp" accept=".jpg, .png, .jpeg" files required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_dp" name="id_dp" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form id="form_pelunasan" action="<?= base_url('shop/store_pelunasan'); ?>" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modal_pelunasan" tabindex="-1" data-backdrop="static" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Pembayaran Pelunasan - <span id="sales_invoice_pelunasan"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="path_image_pelunasan">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="path_image_pelunasan" name="path_image_pelunasan" accept=".jpg, .png, .jpeg" files required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_pelunasan" name="id_pelunasan" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>