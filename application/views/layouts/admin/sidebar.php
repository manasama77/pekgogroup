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
                    <i class="right fas fa-angle-left"></i> <span class="badge badge-pill badge-primary"><?= $sdb['order']; ?></span>
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
                        <p>Pembayaran <span class="badge badge-pill badge-primary"><?= $sdb['pembayaran']; ?></span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('produksi/index'); ?>" class="nav-link <?= (uri_string() == "produksi/index") ? "active" : null; ?>">
                        <i class="fas fa-cut nav-icon"></i>
                        <p>Produksi <span class="badge badge-pill badge-primary"><?= $sdb['produksi']; ?></span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('pengiriman/index'); ?>" class="nav-link <?= (uri_string() == "pengiriman/index") ? "active" : null; ?>">
                        <i class="fas fa-truck nav-icon"></i>
                        <p>Pengiriman <span class="badge badge-pill badge-primary"><?= $sdb['pengiriman']; ?></span></p>
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
            <li class="nav-item <?= (in_array($this->uri->segment(1), ['inventory', 'pembelian', 'pengurangan', 'permintaan'])) ? "menu-open" : null; ?>">
                <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['inventory', 'pembelian', 'pengurangan', 'permintaan'])) ? "active" : null; ?>">
                    <i class="nav-icon fab fa-dropbox"></i>
                    <p>
                        Inventory
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('inventory/index'); ?>" class="nav-link <?= (uri_string() == "inventory/index") ? "active" : null; ?>">
                            <i class="fas fa-scroll nav-icon"></i>
                            <p>List Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('inventory/add'); ?>" class="nav-link <?= (uri_string() == "inventory/add") ? "active" : null; ?>">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Tambah Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pembelian/index'); ?>" class="nav-link <?= (uri_string() == "pembelian/index") ? "active" : null; ?>">
                            <i class="fas fa-scroll nav-icon"></i>
                            <p>List Pembelian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pembelian/add'); ?>" class="nav-link <?= (uri_string() == "pembelian/add") ? "active" : null; ?>">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Tambah Pembelian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurangan/index'); ?>" class="nav-link <?= (uri_string() == "pengurangan/index") ? "active" : null; ?>">
                            <i class="fas fa-scroll nav-icon"></i>
                            <p>List Pengurangan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurangan/add'); ?>" class="nav-link <?= (uri_string() == "pengurangan/add") ? "active" : null; ?>">
                            <i class="fas fa-minus-circle nav-icon"></i>
                            <p>Pengurangan Stock</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('permintaan/index'); ?>" class="nav-link <?= (uri_string() == "permintaan/index") ? "active" : null; ?>">
                            <i class="fas fa-scroll nav-icon"></i>
                            <p>List Permintaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('permintaan/add'); ?>" class="nav-link <?= (uri_string() == "permintaan/add") ? "active" : null; ?>">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Tambah Permintaan</p>
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
            <li class="nav-item <?= (in_array($this->uri->segment(1), ['account', 'account_group', 'cashflow_kas_cash', 'cashflow_bca', 'cashflow_mandiri', 'rekap_cashflow'])) ? "menu-open" : null; ?>">
                <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), ['account', 'account_group', 'cashflow_kas_cash', 'cashflow_bca', 'cashflow_mandiri', 'rekap_cashflow'])) ? "active" : null; ?>">
                    <i class="nav-icon fas fa-balance-scale"></i>
                    <p>
                        Accounting
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('account/index'); ?>" class="nav-link <?= (uri_string() == "account/index") ? "active" : null; ?>">
                            <i class="fas fa-list nav-icon"></i>
                            <p>Akun</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('account_group/index'); ?>" class="nav-link <?= (uri_string() == "account_group/index") ? "active" : null; ?>">
                            <i class="fas fa-tags nav-icon"></i>
                            <p>Kelompok Akun</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('cashflow_kas_cash/index'); ?>" class="nav-link <?= (uri_string() == "cashflow_kas_cash/index") ? "active" : null; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Cash Flow Kas Cash</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('cashflow_bca/index'); ?>" class="nav-link <?= (uri_string() == "cashflow_bca/index") ? "active" : null; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Cash Flow Bank BCA</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('cashflow_mandiri/index'); ?>" class="nav-link <?= (uri_string() == "cashflow_mandiri/index") ? "active" : null; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Cash Flow Bank Mandiri</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('rekap_cashflow/index'); ?>" class="nav-link <?= (uri_string() == "rekap_cashflow/index") ? "active" : null; ?>">
                            <i class="fas fa-book nav-icon"></i>
                            <p>Rekap Cash Flow</p>
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
                    <li class="nav-item">
                        <a href="<?= base_url('setup/supplier'); ?>" class="nav-link <?= (uri_string() == "setup/supplier") ? "active" : null; ?>">
                            <i class="fas fa-warehouse nav-icon"></i>
                            <p>Supplier</p>
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
                            <li class="nav-item">
                                <a href="<?= base_url('setup/parameter/kategori'); ?>" class="nav-link <?= (uri_string() == "setup/parameter/kategori") ? "active" : null; ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('setup/parameter/merk'); ?>" class="nav-link <?= (uri_string() == "setup/parameter/merk") ? "active" : null; ?>">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Merk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <li class="nav-item bg-danger mb-5">
            <a href="<?= base_url(); ?>logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p class="font-weight-bold">
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>