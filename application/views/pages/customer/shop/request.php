<div class="site-section block-3 site-blocks-2 bg-light mt-5 mb-0">
    <div class="container">
        <form action="<?= base_url('shop/finish'); ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="sales_invoice" class="text-black">Sales Invoice</label>
                                <input type="text" class="form-control" id="sales_invoice" name="sales_invoice" value="<?= $orders->row()->sales_invoice; ?>" readonly required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="created_at" class="text-black">Tanggal & Jam Order</label>
                                <input type="text" class="form-control" id="created_at" name="created_at" value="<?= $orders->row()->created_at; ?>" readonly required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="batas_waktu_transfer" class="text-black">Batas Waktu Transfer</label>
                                <input type="text" class="form-control" id="batas_waktu_transfer" name="batas_waktu_transfer" value="<?= $orders->row()->batas_waktu_transfer; ?>" readonly required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="estimasi_selesai" class="text-black">Estimasi Selesai</label>
                                <input type="text" class="form-control" id="estimasi_selesai" name="estimasi_selesai" value="<?= $orders->row()->estimasi_selesai; ?>" readonly required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="text-black">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $customers->row()->name; ?>" readonly required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="whatsapp" class="text-black">Whatsapp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= $customers->row()->whatsapp; ?>" readonly required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="alamat_pengiriman" class="text-black">Alamat Pengiriman <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" placeholder="Alamat Pengiriman" minlength="10" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatan" class="text-black">Catatan</label>
                            <textarea name="catatan" id="catatan" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="jenis_dp" class="text-black">Jenis DP <span class="text-danger">*</span></label>
                                <select class="form-control" id="jenis_dp" name="jenis_dp" required>
                                    <option value="30">30%</option>
                                    <option value="50">50%</option>
                                    <option value="100">100%</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Request</h2>
                            <div class="p-3 p-lg-5 border">

                                <div class="form-group">
                                    <label for="request_id" class="text-black mb-3">Pilih Request</label>
                                    <select class="form-control" id="request_id" name="request_id">
                                        <option value=""></option>
                                        <?php foreach ($requests->result() as $request) { ?>
                                            <option value="<?= $request->id; ?>"><?= $request->name; ?> (+Rp.<?= number_format($request->cost, 0, ',', '.'); ?>,-)</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <button class="btn btn-warning btn-sm btn-block" type="button" id="btn_request">Apply</button>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border">

                                <div class="table-responsive">

                                    <table class="table site-block-order-table mb-5 w-100">
                                        <thead>
                                            <th>Product</th>
                                            <th class="text-right">Total</th>
                                        </thead>
                                        <tbody id="v_order">
                                            <!-- <tr>
                                            <td>Top Up T-Shirt <strong class="mx-2">x</strong> 1</td>
                                            <td>$250.00</td>
                                        </tr> -->
                                            <tr>
                                                <td class="text-center font-weight-bold" colspan="2">Data Not Found</td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-warning">
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                                                <td class="text-black text-right" id="sub_total">Rp. 0,00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Kode Unik</strong></td>
                                                <td class="text-black text-right" id="kode_unik">
                                                    <input type="hidden" id="h_kode_unik" value="<?= $orders->row()->kode_unik; ?>" />
                                                    Rp. <?= number_format($orders->row()->kode_unik, 2, ',', '.'); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                                <td class="text-black font-weight-bold text-right" id="grand_total"><strong>Rp. 0,00</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Nilai DP (<span id="persen_dp"></span>)</strong></td>
                                                <td class="text-black font-weight-bold text-right" id="nilai_dp"><strong>Rp. 0,00</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Nilai Pelunasan (<span id="persen_pelunasan"></span>)</strong></td>
                                                <td class="text-black font-weight-bold text-right" id="nilai_pelunasan"><strong>Rp.0,00</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank"><i class="fas fa-exclamation-circle fa-fw"></i> Cara Pembayaran</a></h3>

                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0" <b>
                                                <i class="fas fa-exclamation-triangle fa-2x fa-fw text-danger"></i>
                                                Transfer ke <b><u>BANK BCA 4980312297 an Isanda Lirian</u></b><br>
                                                Pembayaran harus sesuai nominal jika tidak akan direfund ( artinya tercancel )<br />
                                                Konfirmasi pembayaran sebelum jam yang sudah di tentukan.<br />
                                                Lebih baik 15 menit sebelum batas waktu menghindari trafic website. Karna jika telat maka tercancel</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>