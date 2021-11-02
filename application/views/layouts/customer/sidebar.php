<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- add class menu-open to expand dropdown -->
        <li class="nav-item">
            <a href="<?= base_url('cdashboard'); ?>" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('corder/index'); ?>" class="nav-link">
                <i class="fas fa-scroll nav-icon"></i>
                <p>List Order</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('corder/add'); ?>" class="nav-link">
                <i class="fas fa-cart-plus nav-icon"></i>
                <p>Tambah Order</p>
            </a>
        </li>
        <li class="nav-item bg-danger">
            <a href="<?= base_url(); ?>clogout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p class="font-weight-bold">
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>