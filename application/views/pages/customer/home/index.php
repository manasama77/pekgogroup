<div class="site-blocks-cover" style="background-image: url(<?= base_url(); ?>assets/img/banner/hero_1.png); background-repeat:no-repeat; background-size:cover; background-position:left;" data-aos="fade">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                <h1 class="mb-2">PEKGO APPAREL</h1>
                <div class="intro-text text-center text-md-left">
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla. </p>
                    <p>
                        <a href="<?= base_url('shop/index'); ?>" class="btn btn-sm btn-warning">Shop Now</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section site-section-sm site-blocks-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-truck"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Gratis Pengiriman</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                <div class="icon mr-4 align-self-start">
                    <span class="fas fa-gem"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Bahan Berkualitas</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon mr-4 align-self-start">
                    <span class="fas fa-eye"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Pengerjaan Teliti</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Popular Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <?php for ($i = 0; $i < $products['num_rows']; $i++) { ?>
                        <div class="item shadow">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <a href="<?= base_url('products/' . $products['data'][$i]['id']); ?>">
                                        <img src="<?= base_url(); ?>assets/img/products/<?= $products['data'][$i]['path_image']; ?>" alt="<?= $products['data'][$i]['name']; ?>" class="img-fluid" />
                                    </a>
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="<?= base_url('products/' . $products['data'][$i]['id']); ?>"><?= $products['data'][$i]['name']; ?></a></h3>
                                    <p class="text-primary font-weight-bold">Rp.<?= number_format($products['data'][$i]['price'], 0); ?>,-</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>