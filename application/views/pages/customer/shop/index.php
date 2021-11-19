<div class="site-section">
    <div class="container">

        <div class="row mb-5">
            <div class="col-md-9 order-2">

                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left mb-4">
                            <h2 class="text-black h5">Shop All</h2>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <?php foreach ($products->result() as $product) { ?>
                        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                            <div class="block-4 text-center border shadow">
                                <figure class="block-4-image">
                                    <a href="<?= base_url('products/' . $product->id); ?>"><img src="<?= base_url(); ?>assets/img/products/<?= $product->path_image; ?>" alt="Image placeholder" class="img-fluid"></a>
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="<?= base_url('products/' . $product->id); ?>"><?= $product->name; ?></a></h3>
                                    <p class="text-primary font-weight-bold">Rp.<?= number_format($product->price, 0); ?>,-</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                        <div class="site-block-27">
                            <?= $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <form action="<?= current_url(); ?>" method="get">
                    <div class="border p-4 rounded mb-4 shadow-sm">
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                            <?php
                            $i = 0;
                            foreach ($sizes->result() as $size) {
                                $selected = null;
                                if ($f_size) {
                                    $selected = (in_array($size->id, $f_size)) ? "checked" : null;
                                }
                            ?>
                                <label for="<?= $size->id; ?>" class="d-flex">
                                    <input type="checkbox" id="<?= $size->id; ?>" name="size[]" value="<?= $size->id; ?>" class="mr-2 mt-1" <?= $selected; ?>>
                                    <span class="text-black"><?= $size->name; ?></span>
                                </label>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>

                        <!-- <div class="mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                        <?php foreach ($colors->result() as $color) { ?>
                            <a href="https://example.com/no-js-login" class="d-flex color-item align-items-center ignore-click" onclick="filterColor('<?= $color->name; ?>');">
                                <span class="color d-inline-block rounded-circle mr-2" style="background-color: <?= $color->hex; ?>"></span> <span class="text-black"><?= $color->name; ?></span>
                            </a>
                        <?php } ?>
                    </div> -->

                        <button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fas fa-filter"></i> Filter</button>
                        <a href="<?= base_url('shop/index'); ?>" class="btn btn-secondary btn-block btn-sm"><i class="fas fa-redo"></i> Reset</a>

                    </div>
                </form>
            </div>



        </div>

    </div>
</div>