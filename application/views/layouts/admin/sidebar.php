<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- add class menu-open to expand dropdown -->
        <li class="nav-item">
            <a href="<?= base_url(); ?>dashboard" class="nav-link <?= ($this->uri->segment(1) == "dashboard") ? "active" : null; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item <?= (in_array($this->uri->segment(1), ['order', 'pembayaran', 'produksi', 'pengiriman'])) ? "menu-open" : null; ?>">
            <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['order', 'pembayaran', 'produksi', 'pengiriman'])) ? "active" : null; ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                    Order
                    <i class="right fas fa-angle-left"></i> <span class="badge badge-pill badge-primary"><?= $sdb; ?></span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('order/index'); ?>" class="nav-link <?= (uri_string() == "order/index") ? "active" : null; ?>">
                        <i class="fas fa-scroll nav-icon"></i>
                        <p>List Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('order/add'); ?>" class="nav-link <?= (uri_string() == "order/add") ? "active" : null; ?>">
                        <i class="fas fa-cart-plus nav-icon"></i>
                        <p>Tambah Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('pembayaran/index'); ?>" class="nav-link <?= (uri_string() == "pembayaran/index") ? "active" : null; ?>">
                        <i class="fas fa-money-bill nav-icon"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('produksi/index'); ?>" class="nav-link <?= (uri_string() == "produksi/index") ? "active" : null; ?>">
                        <i class="fas fa-cut nav-icon"></i>
                        <p>Produksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('pengiriman/index'); ?>" class="nav-link <?= (uri_string() == "pengiriman/index") ? "active" : null; ?>">
                        <i class="fas fa-truck nav-icon"></i>
                        <p>Pengiriman</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item <?= (in_array($this->uri->segment(1), ['customer'])) ? "menu-open" : null; ?>">
            <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['customer'])) ? "active" : null; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Customer
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('customer/index'); ?>" class="nav-link <?= (uri_string() == "customer/index") ? "active" : null; ?>">
                        <i class="fas fa-scroll nav-icon"></i>
                        <p>List Customer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('customer/add'); ?>" class="nav-link <?= (uri_string() == "customer/add") ? "active" : null; ?>">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Tambah Customer</p>
                    </a>
                </li>
            </ul>
        </li>
        <?php if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris'))) { ?>
            <li class="nav-item <?= (in_array($this->uri->segment(1), ['produk'])) ? "menu-open" : null; ?>">
                <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['produk'])) ? "active" : null; ?>">
                    <i class="nav-icon fas fa-tshirt"></i>
                    <p>
                        Produk
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('produk/index'); ?>" class="nav-link <?= (uri_string() == "produk/index") ? "active" : null; ?>">
                            <i class="fas fa-scroll nav-icon"></i>
                            <p>List Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('produk/add'); ?>" class="nav-link <?= (uri_string() == "produk/add") ? "active" : null; ?>">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Tambah Produk</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= (in_array($this->uri->segment(1), ['admin'])) ? "menu-open" : null; ?>">
                <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['admin'])) ? "active" : null; ?>">
                    <i class="nav-icon fas fa-user-secret"></i>
                    <p>
                        Admin
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('admin/index'); ?>" class="nav-link <?= (uri_string() == "admin/index") ? "active" : null; ?>">
                            <i class="fas fa-scroll nav-icon"></i>
                            <p>List Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/add'); ?>" class="nav-link <?= (uri_string() == "admin/add") ? "active" : null; ?>">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Tambah Admin</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mb-3 <?= (in_array($this->uri->segment(1), ['setup'])) ? "menu-open" : null; ?>">
                <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['setup'])) ? "active" : null; ?>">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Setup
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('setup/project'); ?>" class="nav-link <?= (uri_string() == "setup/project") ? "active" : null; ?>">
                            <i class="fas fa-project-diagram nav-icon"></i>
                            <p>Project</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('setup/karyawan'); ?>" class="nav-link <?= (uri_string() == "setup/karyawan") ? "active" : null; ?>">
                            <i class="fas fa-user-tie nav-icon"></i>
                            <p>Karyawan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('setup/hpp'); ?>" class="nav-link <?= (uri_string() == "setup/hpp") ? "active" : null; ?>">
                            <i class="fas fa-cubes nav-icon"></i>
                            <p>HPP</p>
                        </a>
                    </li>
                    <li class="nav-item <?= (in_array($this->uri->segment(1), ['setup']) && in_array($this->uri->segment(2), ['parameter'])) ? "menu-open" : null; ?>">
                        <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['setup']) && in_array($this->uri->segment(2), ['parameter'])) ? "active" : null; ?>">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Parameter
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('setup/parameter/satuan'); ?>" class="nav-link <?= (uri_string() == "setup/parameter/satuan") ? "active" : null; ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Satuan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('setup/parameter/warna'); ?>" class="nav-link <?= (uri_string() == "setup/parameter/warna") ? "active" : null; ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Warna</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('setup/parameter/ukuran'); ?>" class="nav-link <?= (uri_string() == "setup/parameter/ukuran") ? "active" : null; ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Ukuran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('setup/parameter/request'); ?>" class="nav-link <?= (uri_string() == "setup/parameter/request") ? "active" : null; ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Request</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <li class="nav-item bg-danger">
            <a href="<?= base_url(); ?>logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p class="font-weight-bold">
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>