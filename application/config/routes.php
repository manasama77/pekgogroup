<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'clogin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//customer
$route['clogin']  = 'clogin/index';
$route['clogout'] = 'clogin/logout';

$route['cdashboard'] = 'cdashboard/index';

$route['corder/index']                      = 'corder/index';
$route['corder/add']                        = 'corder/add';
$route['corder/store_request']['post']      = 'corder/store_request';
$route['corder/render_detail']              = 'corder/render_detail';
$route['corder/remove_request']             = 'corder/remove_request';
$route['corder/copy_order']                 = 'corder/copy_order';
$route['corder/show_request']               = 'corder/show_request';
$route['corder/check_pembayaran_dp']        = 'corder/check_pembayaran_dp';
$route['corder/store_dp']                   = 'corder/store_dp';
$route['corder/check_pembayaran_pelunasan'] = 'corder/check_pembayaran_pelunasan';
$route['corder/store_pelunasan']            = 'corder/store_pelunasan';

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
$route['admin/blokir']                   = 'admin/blokir';

$route['produk/index']                        = 'produk/index';
$route['produk/show/(:num)']                  = 'produk/show/$1';
$route['produk/add']                          = 'produk/add';
$route['produk/hpp/render']['get']            = 'produk/render_hpp';
$route['produk/hpp/store']['post']            = 'produk/store_hpp';
$route['produk/destroy_hpp/(:num)']['delete'] = 'produk/destroy_hpp/$1';
$route['produk/destroy/(:num)']['delete']     = 'produk/destroy/$1';
$route['produk/edit/(:num)']['post']          = 'produk/edit/$1';
$route['produk/edit/(:num)']['get']           = 'produk/edit/$1';

// setup
$route['setup/project']  = 'project/index';
$route['setup/karyawan'] = 'karyawan/index';
$route['setup/hpp']      = 'hpp/index';
$route['project/update'] = 'project/update';

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
