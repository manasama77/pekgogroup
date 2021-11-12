<header class="site-navbar" role="banner">
    <div class="site-navbar-top">
        <div class="container">
            <div class="row d-flex justify-content-lg-between">

                <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 text-center">
                    <a href="<?= base_url(); ?>" class="js-logo-clone">
                        <img src="<?= $projects['logo']; ?>" alt="<?= $projects['name']; ?>" style="max-width: 100px;">
                    </a>
                </div>

                <div class="col-12 col-md-4 order-2 text-center">
                    <div class="site-top-icons">
                        <ul>
                            <li>
                                <?php if ($this->session->userdata('id') && $this->session->userdata('whatsapp') && $this->session->userdata('name')) { ?>
                                    <i class="fas fa-user fa-fw"></i> <?= $this->session->userdata('name'); ?>
                                    <a href="<?= base_url('customer/logout'); ?>" title="Customer Logout" class="ml-4">
                                        <i class="fas fa-sign-out-alt fa-fw"></i> Logout
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= base_url('customer/login'); ?>" title="Customer Login">
                                        <i class="fas fa-user fa-fw"></i> Login
                                    </a>
                                <?php } ?>
                            </li>
                            <li class="d-inline-block d-md-none ml-md-0"><a href="<?= base_url(); ?>assets/shoppers/#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
            <?php
            if ($this->uri->segment(1) == "about") {
                $home_active    = "";
                $about_active   = "active";
                $shop_active    = "";
                $contact_active = "";
            } elseif ($this->uri->segment(1) == "shop" && $this->uri->segment(2) != 'list_order') {
                $home_active    = "";
                $about_active   = "";
                $shop_active    = "active";
                $contact_active = "";
            } elseif ($this->uri->segment(1) == "contact") {
                $home_active    = "";
                $about_active   = "";
                $shop_active    = "";
                $contact_active = "active";
            } else if ($this->uri->segment(1) == null) {
                $home_active    = "active";
                $about_active   = "";
                $shop_active    = "";
                $contact_active = "";
            } else {
                $home_active    = "";
                $about_active   = "";
                $shop_active    = "";
                $contact_active = "";
            }
            ?>
            <ul class="site-menu js-clone-nav d-none d-md-block">
                <li class="<?= $home_active; ?>"><a href="<?= base_url(); ?>">Home</a></li>
                <li class="<?= $about_active; ?>"><a href="<?= base_url('about/index'); ?>">About Us</a></li>
                <li class="<?= $shop_active; ?>"><a href="<?= base_url('shop/index'); ?>">Shop</a></li>
                <li class="<?= $contact_active; ?>"><a href="<?= base_url('contact/index'); ?>">Contact</a></li>
                <?php
                if ($this->session->userdata('id') && $this->session->userdata('whatsapp') && $this->session->userdata('name')) {
                    $list_order_active = ($this->uri->segment('2') == "list_order") ? "active" : null;
                ?>
                    <li class="<?= $list_order_active; ?>"><a href="<?= base_url('shop/list_order'); ?>">List Order</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>