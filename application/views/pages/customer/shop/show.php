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
                        <!-- repair bug php 8 -->
                        <?php $this->session->unset_userdata('warning'); ?>
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
                    <h5><?= $products['data'][0]['description']; ?></h5>
                    <p><strong class="text-primary h4">Rp.<?= number_format($products['data'][0]['price'], 0, ',', '.'); ?>,-</strong></p>

                    <h5 class="mt-4">Size</h5>
                    <?php for ($i = 0; $i < count($products['data'][0]['sizes']); $i++) { ?>
                        <div class="mb-1">
                            <div class="form-group">
                                <div class="form-check mr-5">
                                    <input class="form-check-input" type="radio" name="size_id" id="size_<?= $products['data'][0]['sizes'][$i]['id']; ?>" value="<?= $products['data'][0]['sizes'][$i]['id']; ?>">
                                    <label class="form-check-label" for="size_<?= $products['data'][0]['sizes'][$i]['id']; ?>">
                                        <?= $products['data'][0]['sizes'][$i]['name']; ?> &mdash; (+Rp.<?= number_format($products['data'][0]['sizes'][$i]['cost'], 0); ?>,-)
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <h5 class="mt-4">Color</h5>
                    <div class="mb-1 d-flex">
                        <select class="form-control" id="color_id" name="color_id" required>
                            <?php for ($i = 0; $i < count($products['data'][0]['colors']); $i++) { ?>
                                <option value="<?= $products['data'][0]['colors'][$i]['id']; ?>"><?= $products['data'][0]['colors'][$i]['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php if ($products['data'][0]['standard'] == 1 || $products['data'][0]['express'] == 1 || $products['data'][0]['urgent'] == 1 || $products['data'][0]['super_urgent'] == 1) { ?>
                        <h5 class="mt-4">Jahitan</h5>
                    <?php } ?>
                    <div class="mb-1">
                        <div class="form-group">
                            <div class="form-check mr-5">
                                <input class="form-check-input" type="radio" name="pilih_jahitan" id="standard" value="standard" autocomplete="off" checked>
                                <label class="form-check-label" for="standard">
                                    Standard &mdash; 4 Minggu Jadi (+Rp.0,-)
                                </label>
                            </div>
                        </div>

                        <?php if ($products['data'][0]['express'] == 1) { ?>
                            <div class="form-group">
                                <div class="form-check mr-5">
                                    <input class="form-check-input" type="radio" name="pilih_jahitan" id="express" value="express" autocomplete="off">
                                    <label class="form-check-label" for="express">
                                        Express &mdash; 2 Minggu Jadi (+Rp.50.000,-)
                                    </label>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($products['data'][0]['urgent'] == 1) { ?>
                            <div class="form-group">
                                <div class="form-check mr-5">
                                    <input class="form-check-input" type="radio" name="pilih_jahitan" id="urgent" value="urgent" autocomplete="off">
                                    <label class="form-check-label" for="urgent">
                                        Urgent &mdash; 1 Minggu Jadi (+Rp.100.000,-)
                                    </label>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($products['data'][0]['super_urgent'] == 1) { ?>
                            <div class="form-group">
                                <div class="form-check mr-5">
                                    <input class="form-check-input" type="radio" name="pilih_jahitan" id="super_urgent" value="super urgent" autocomplete="off">
                                    <label class="form-check-label" for="super_urgent">
                                        Super Urgent &mdash; 3 Hari Jadi (+Rp.150.000,-)
                                    </label>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($this->session->userdata('id') && $this->session->userdata('whatsapp') && $this->session->userdata('name')) { ?>
                            <div class="mt-4">
                                <button type="submit" class="buy-now btn btn-sm btn-primary"><i class="fas fa-shopping-cart"></i> Buy</button>
                            </div>
                        <?php } else { ?>
                            <div class="mt-4">
                                <a href="<?= base_url('customer/login'); ?>" class="buy-now btn btn-sm btn-warning"><i class="fas fa-sign-in-alt"></i> Login to Buy</a>
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
                <h2>Popular Products</h2>
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