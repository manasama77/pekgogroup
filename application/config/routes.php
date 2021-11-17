<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'landing';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

//customer
$route['about/index']  = 'cabout/index';

$route['shop/index']                      = 'cshop/index';
$route['shop/index/(:num)']               = 'cshop/index/$1';
$route['shop/checkout/(:num)']            = 'cshop/checkout/$1';
$route['shop/requests']                   = 'cshop/requests';
$route['shop/render_order']               = 'cshop/render_order';
$route['shop/store_request']              = 'cshop/store_request';
$route['shop/remove_request']             = 'cshop/remove_request';
$route['shop/finish']                     = 'cshop/finish';
$route['shop/thanks']                     = 'cshop/thanks';
$route['shop/list_order/(:num)']          = 'cshop/list_order/$1';
$route['shop/list_order']                 = 'cshop/list_order';
$route['shop/order_detail']               = 'cshop/order_detail';
$route['shop/check_pembayaran_dp']        = 'cshop/check_pembayaran_dp';
$route['shop/store_dp']                   = 'cshop/store_dp';
$route['shop/check_pembayaran_pelunasan'] = 'cshop/check_pembayaran_pelunasan';
$route['shop/store_pelunasan']            = 'cshop/store_pelunasan';
$route['shop/order_track']                = 'cshop/order_track';
$route['products/(:num)']                 = 'cshop/show/$1';

$route['contact/index']  = 'ccontact/index';



$route['customer/login']  = 'clogin/index';
$route['customer/logout'] = 'clogin/logout';

// $route['cdashboard'] = 'cdashboard/index';

// $route['corder/index']                      = 'corder/index';
// $route['corder/add']                        = 'corder/add';
// $route['corder/store_request']['post']      = 'corder/store_request';
// $route['corder/render_detail']              = 'corder/render_detail';
// $route['corder/remove_request']             = 'corder/remove_request';
// $route['corder/copy_order']                 = 'corder/copy_order';
// $route['corder/show_request']               = 'corder/show_request';
// $route['corder/check_pembayaran_dp']        = 'corder/check_pembayaran_dp';
// $route['corder/store_dp']                   = 'corder/store_dp';
// $route['corder/check_pembayaran_pelunasan'] = 'corder/check_pembayaran_pelunasan';
// $route['corder/store_pelunasan']            = 'corder/store_pelunasan';
// $route['corder/invoice/(:num)']             = 'corder/invoice/$1';

// $route['cproduk/show/(:num)'] = 'cproduk/show/$1';

// admin
$route['login'] = 'login/index';
$route['logout'] = 'login/logout';

$route['dashboard'] = 'dashboard/index';

$route['order/index']                 = 'order/index';
$route['order/add']                   = 'order/add';
$route['order/store_request']['post'] = 'order/store_request';
$route['order/render_detail']         = 'order/render_detail';
$route['order/remove_request']        = 'order/remove_request';
$route['order/copy_order']            = 'order/copy_order';
$route['order/show_request']          = 'order/show_request';
$route['order/invoice/(:num)']        = 'order/invoice/$1';
$route['order/show_detail']           = 'order/show_detail';

$route['pembayaran/index']                    = 'pembayaran/index';
$route['pembayaran/verifikasi_dp']            = 'pembayaran/verifikasi_dp';
$route['pembayaran/approve_dp']               = 'pembayaran/approve_dp';
$route['pembayaran/reject_dp']                = 'pembayaran/reject_dp';
$route['pembayaran/verifikasi_pelunasan']     = 'pembayaran/verifikasi_pelunasan';
$route['pembayaran/approve_pelunasan']        = 'pembayaran/approve_pelunasan';
$route['pembayaran/cek_pembayaran_dp']        = 'pembayaran/cek_pembayaran_dp';
$route['pembayaran/store_tambah_dp']          = 'pembayaran/store_tambah_dp';
$route['pembayaran/cek_pembayaran_pelunasan'] = 'pembayaran/cek_pembayaran_pelunasan';
$route['pembayaran/store_tambah_pelunasan']   = 'pembayaran/store_tambah_pelunasan';

$route['produksi/index']         = 'produksi/index';
$route['produksi/print/(:num)']  = 'produksi/print/$1';
$route['produksi/store_history'] = 'produksi/store_history';

$route['pengiriman/index']               = 'pengiriman/index';
$route['pengiriman/cek_data_pengiriman'] = 'pengiriman/cek_data_pengiriman';
$route['pengiriman/store']               = 'pengiriman/store';
$route['pengiriman/track']               = 'pengiriman/track';
$route['pengiriman/selesai']             = 'pengiriman/selesai';

$route['customer/index']                    = 'customer/index';
$route['customer/show/(:num)']              = 'customer/show/$1';
$route['customer/add']                      = 'customer/add';
$route['customer/destroy/(:num)']['delete'] = 'customer/destroy/$1';
$route['customer/edit/(:num)']['post']      = 'customer/edit/$1';
$route['customer/edit/(:num)']['get']       = 'customer/edit/$1';
$route['customer/status/(:any)/(:num)']     = 'customer/status/$1/$2';
$route['customer/blokir']                   = 'customer/blokir';
$route['customer/reset']                    = 'customer/reset';

$route['admin/index']                    = 'admin/index';
$route['admin/add']                      = 'admin/add';
$route['admin/destroy/(:num)']['delete'] = 'admin/destroy/$1';
$route['admin/edit/(:num)']['post']      = 'admin/edit/$1';
$route['admin/edit/(:num)']['get']       = 'admin/edit/$1';
$route['admin/disable']                  = 'admin/disable';
$route['admin/active']                   = 'admin/active';
$route['admin/reset']                    = 'admin/reset';

$route['produk/index']                        = 'produk/index';
$route['produk/show/(:num)']                  = 'produk/show/$1';
$route['produk/add']                          = 'produk/add';
$route['produk/hpp/render']['get']            = 'produk/render_hpp';
$route['produk/hpp/store']['post']            = 'produk/store_hpp';
$route['produk/destroy_hpp/(:num)']['delete'] = 'produk/destroy_hpp/$1';
$route['produk/destroy/(:num)']['delete']     = 'produk/destroy/$1';
$route['produk/edit/(:num)']['post']          = 'produk/edit/$1';
$route['produk/edit/(:num)']['get']           = 'produk/edit/$1';
$route['produk/hpp/render_active']['get']            = 'produk/render_hpp_active';

// setup
$route['setup/project']                    = 'project/index';
$route['project/update']                   = 'project/update';
$route['project/destroy/(:num)']['delete'] = 'project/destroy/$1';

$route['setup/karyawan']                    = 'karyawan/index';
$route['karyawan/update']                   = 'karyawan/update';
$route['karyawan/destroy/(:num)']['delete'] = 'karyawan/destroy/$1';

$route['setup/hpp']                    = 'hpp/index';
$route['hpp/update']                   = 'hpp/update';
$route['hpp/destroy/(:num)']['delete'] = 'hpp/destroy/$1';

$route['setup/parameter/satuan']                  = 'satuan/index';
$route['setup/parameter/satuan/(:num)']['delete'] = 'satuan/destroy/$1';
$route['setup/parameter/satuan/(:num)']['post']   = 'satuan/edit/$1';
$route['setup/parameter/satuan/(:num)']['get']    = 'satuan/edit/$1';

$route['setup/parameter/warna']                  = 'warna/index';
$route['setup/parameter/warna/(:num)']['delete'] = 'warna/destroy/$1';
$route['setup/parameter/warna/(:num)']['post']   = 'warna/edit/$1';
$route['setup/parameter/warna/(:num)']['get']    = 'warna/edit/$1';

$route['setup/parameter/ukuran']                  = 'ukuran/index';
$route['setup/parameter/ukuran/(:num)']['delete'] = 'ukuran/destroy/$1';
$route['setup/parameter/ukuran/(:num)']['post']   = 'ukuran/edit/$1';
$route['setup/parameter/ukuran/(:num)']['get']    = 'ukuran/edit/$1';

$route['setup/parameter/request']                  = 'request/index';
$route['setup/parameter/request/(:num)']['delete'] = 'request/destroy/$1';
$route['setup/parameter/request/(:num)']['post']   = 'request/edit/$1';
$route['setup/parameter/request/(:num)']['get']    = 'request/edit/$1';

// init
$route['init/admin'] = 'init/admin';


// cli
$route['cli/check_expired'] = 'cli/check_expired';
$route['cli/check_resi']    = 'cli/check_resi';
