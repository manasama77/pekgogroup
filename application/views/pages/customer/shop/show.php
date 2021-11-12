<div class="site-section">
    <div class="container">
        <?php if ($this->session->flashdata('warning')) { ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong><?= $this->session->flashdata('warning'); ?></strong>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12">
                        <img src="<?= base_url('assets/img/products/' . $products['data'][0]['path_image']); ?>" alt="<?= $products['data'][0]['name']; ?>" class="img-thumbnail shadow-sm">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4">
                        <a href="<?= base_url('assets/img/products/' . $products['data'][0]['path_image']); ?>" data-lightbox="image-1" data-title="<?= $products['data'][0]['name']; ?>">
                            <img src="<?= base_url('assets/img/products/' . $products['data'][0]['path_image']); ?>" alt="<?= $products['data'][0]['name']; ?>" class="img-thumbnail shadow">
                        </a>
                    </div>
                    <?php if ($products['data'][0]['path_image_2']) { ?>
                        <div class="col-4">
                            <a href="<?= base_url('assets/img/products/' . $products['data'][0]['path_image_2']); ?>" data-lightbox="image-1" data-title="<?= $products['data'][0]['name']; ?>">
                                <img src="<?= base_url('assets/img/products/' . $products['data'][0]['path_image_2']); ?>" alt="<?= $products['data'][0]['name']; ?>" class="img-thumbnail shadow">
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($products['data'][0]['path_image_3']) { ?>
                        <div class="col-4">
                            <a href="<?= base_url('assets/img/products/' . $products['data'][0]['path_image_3']); ?>" data-lightbox="image-1" data-title="<?= $products['data'][0]['name']; ?>">
                                <img src="<?= base_url('assets/img/products/' . $products['data'][0]['path_image_3']); ?>" alt="<?= $products['data'][0]['name']; ?>" class="img-thumbnail shadow">
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-6">

                <form action="<?= base_url('shop/checkout/' . $products['data'][0]['id']); ?>" method="post">
                    <h2 class="text-black"><?= $products['data'][0]['name']; ?></h2>
                    <p><?= $products['data'][0]['description']; ?></p>
                    <p><strong class="text-primary h4">Rp.<?= number_format($products['data'][0]['price'], 0, ',', '.'); ?>,-</strong></p>

                    <h5 class="mt-4">Size</h5>
                    <div class="mb-1 d-flex">
                        <?php for ($i = 0; $i < count($products['data'][0]['sizes']); $i++) { ?>
                            <div class="form-check form-check-inline mr-5">
                                <input class="form-check-input" type="radio" name="size_id" id="size_<?= $products['data'][0]['sizes'][$i]['id']; ?>" value="<?= $products['data'][0]['sizes'][$i]['id']; ?>">
                                <label class="form-check-label" for="size_<?= $products['data'][0]['sizes'][$i]['id']; ?>">
                                    <?= $products['data'][0]['sizes'][$i]['name']; ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>

                    <h5 class="mt-4">Color</h5>
                    <div class="mb-1 d-flex">
                        <select class="form-control" id="color_id" name="color_id" required>
                            <?php for ($i = 0; $i < count($products['data'][0]['colors']); $i++) { ?>
                                <option value="<?= $products['data'][0]['colors'][$i]['id']; ?>"><?= $products['data'][0]['colors'][$i]['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <h5 class="mt-4">Jahitan</h5>
                    <div class="mb-1">
                        <div class="form-group">
                            <div class="form-check mr-5">
                                <input class="form-check-input" type="radio" name="pilih_jahitan" id="standard" value="standard" checked>
                                <label class="form-check-label" for="standard">
                                    Standard - 4 Minggu Jadi (+Rp.0,-)
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check mr-5">
                                <input class="form-check-input" type="radio" name="pilih_jahitan" id="express" value="express">
                                <label class="form-check-label" for="express">
                                    Express - 2 Minggu Jadi (+Rp.50.000,-)
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check mr-5">
                                <input class="form-check-input" type="radio" name="pilih_jahitan" id="urgent" value="urgent">
                                <label class="form-check-label" for="urgent">
                                    Urgent - 1 Minggu Jadi (+Rp.100.000,-)
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check mr-5">
                                <input class="form-check-input" type="radio" name="pilih_jahitan" id="super_urgent" value="super urgent">
                                <label class="form-check-label" for="super_urgent">
                                    Super Urgent - 3 Hari Jadi (+Rp.150.000,-)
                                </label>
                            </div>
                        </div>

                        <?php if ($this->session->userdata('id') && $this->session->userdata('whatsapp') && $this->session->userdata('name')) { ?>
                            <div class="mt-4">
                                <button type="submit" class="buy-now btn btn-sm btn-primary"><i class="fas fa-shopping-cart"></i> Buy</button>
                            </div>
                        <?php } ?>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2 bg-light mt-5 mb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Top Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <?php foreach ($top_products->result() as $top_product) { ?>
                        <div class="item shadow">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <a href="<?= base_url('products/' . $top_product->id); ?>">
                                        <img src="<?= base_url('assets/img/products/' . $top_product->path_image); ?>" alt="<?= $top_product->name; ?>" class="img-fluid" />
                                    </a>
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="<?= base_url('products/' . $top_product->id); ?>"><?= $top_product->name; ?></a></h3>
                                    <p class="text-primary font-weight-bold">Rp.<?= number_format($top_product->price, 0, ',', '.'); ?>,-</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>