<div class="site-section block-3 site-blocks-2 bg-light mt-5 mb-0">
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="text-black">Nama <span class="text-danger">*</span></label>
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
                                <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" placeholder="Alamat Pengiriman" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatan" class="text-black">Catatan</label>
                            <textarea name="catatan" id="catatan" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
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
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody id="v_order">
                                        <!-- <tr>
                                            <td>Top Up T-Shirt <strong class="mx-2">x</strong> 1</td>
                                            <td>$250.00</td>
                                        </tr> -->
                                        <tr>
                                            <td class="text-center font-weight-bold" colspan="2">Data Not Found</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                                            <td class="text-black">Rp.<span id="sub_total">0</span>,-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Kode Unik</strong></td>
                                            <td class="text-black">Rp.<span id="kode_unik">0</span>,-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>Rp.<span id="grand_total">0</span>,-</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.html'">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>