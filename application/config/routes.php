<?php
defined('BASEPATH') or exit('No direct script access allowed');

// reserved
$route['default_controller']   = 'landing';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

// landing
$route['about/index']   = 'cabout/index';
$route['contact/index'] = 'ccontact/index';

// customer
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
$route['customer/login']    = 'clogin/index';
$route['customer/logout']   = 'clogin/logout';
$route['customer/register'] = 'clogin/register';

///////////////////////////////////////////// GRAND LINE /////////////////////////////////////////////

// admin auth
$route['login'] = 'login/index';
$route['logout'] = 'login/logout';

// dashboard
$route['dashboard']            = 'dashboard/index';
$route['dashboard/show_track'] = 'dashboard/show_track';

// order
$route['order/index']                    = 'order/index';
$route['order/add']                      = 'order/add';
$route['order/store_request']['post']    = 'order/store_request';
$route['order/render_detail']            = 'order/render_detail';
$route['order/remove_request']           = 'order/remove_request';
$route['order/copy_order']               = 'order/copy_order';
$route['order/show_request']             = 'order/show_request';
$route['order/invoice/(:num)']           = 'order/invoice/$1';
$route['order/show_detail']              = 'order/show_detail';
$route['order/destroy/(:num)']['delete'] = 'order/destroy/$1';

// pembayaran
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

// produksi
$route['produksi/index']         = 'produksi/index';
$route['produksi/print/(:num)']  = 'produksi/print/$1';
$route['produksi/store_history'] = 'produksi/store_history';

// pengiriman
$route['pengiriman/index']               = 'pengiriman/index';
$route['pengiriman/cek_data_pengiriman'] = 'pengiriman/cek_data_pengiriman';
$route['pengiriman/store']               = 'pengiriman/store';
$route['pengiriman/track']               = 'pengiriman/track';
$route['pengiriman/selesai']             = 'pengiriman/selesai';

// customer
$route['customer/index/(:num)']             = 'customer/index/$1';
$route['customer/index']                    = 'customer/index';
$route['customer/show/(:num)']              = 'customer/show/$1';
$route['customer/add']                      = 'customer/add';
$route['customer/destroy/(:num)']['delete'] = 'customer/destroy/$1';
$route['customer/edit/(:num)']['post']      = 'customer/edit/$1';
$route['customer/edit/(:num)']['get']       = 'customer/edit/$1';
$route['customer/status/(:any)/(:num)']     = 'customer/status/$1/$2';
$route['customer/blokir']                   = 'customer/blokir';
$route['customer/reset']                    = 'customer/reset';

// admin management
$route['admin/index']                    = 'admin/index';
$route['admin/add']                      = 'admin/add';
$route['admin/destroy/(:num)']['delete'] = 'admin/destroy/$1';
$route['admin/edit/(:num)']['post']      = 'admin/edit/$1';
$route['admin/edit/(:num)']['get']       = 'admin/edit/$1';
$route['admin/disable']                  = 'admin/disable';
$route['admin/active']                   = 'admin/active';
$route['admin/reset']                    = 'admin/reset';

// produk management
$route['produk/index']                        = 'produk/index';
$route['produk/show/(:num)']                  = 'produk/show/$1';
$route['produk/add']                          = 'produk/add';
$route['produk/hpp/render']['get']            = 'produk/render_hpp';
$route['produk/hpp/store']['post']            = 'produk/store_hpp';
$route['produk/destroy_hpp/(:num)']['delete'] = 'produk/destroy_hpp/$1';
$route['produk/destroy/(:num)']['delete']     = 'produk/destroy/$1';
$route['produk/edit/(:num)']['post']          = 'produk/edit/$1';
$route['produk/edit/(:num)']['get']           = 'produk/edit/$1';
$route['produk/hpp/render_active']['get']     = 'produk/render_hpp_active';

// inventory management
$route['inventory/index']                    = 'inventory/index';
$route['inventory/add']                      = 'inventory/add';
$route['inventory/store']                    = 'inventory/store';
$route['inventory/store_supplier']           = 'inventory/store_supplier';
$route['inventory/get_supplier_temp']        = 'inventory/get_supplier_temp';
$route['inventory/destroy_supplier']         = 'inventory/destroy_supplier';
$route['inventory/edit/(:num)']              = 'inventory/edit/$1';
$route['inventory/get_supplier/(:num)']      = 'inventory/get_supplier/$1';
$route['inventory/store_supplier_fix']       = 'inventory/store_supplier_fix';
$route['inventory/update']                   = 'inventory/update';
$route['inventory/destroy/(:num)']['delete'] = 'inventory/destroy/$1';

// pembelian
$route['pembelian/index']                    = 'pembelian/index';
$route['pembelian/add']                      = 'pembelian/add';
$route['pembelian/get_barang_list']          = 'pembelian/get_barang_list';
$route['pembelian/get_kode_list']            = 'pembelian/get_kode_list';
$route['pembelian/store_barang']             = 'pembelian/store_barang';
$route['pembelian/get_barang_temp']          = 'pembelian/get_barang_temp';
$route['pembelian/destroy_barang']           = 'pembelian/destroy_barang';
$route['pembelian/store']                    = 'pembelian/store';
$route['pembelian/detail']                   = 'pembelian/detail';
$route['pembelian/destroy/(:num)']['delete'] = 'pembelian/destroy/$1';

// pengurangan
$route['pengurangan/index']                    = 'pengurangan/index';
$route['pengurangan/add']                      = 'pengurangan/add';
$route['pengurangan/get_barang_list']          = 'pengurangan/get_barang_list';
$route['pengurangan/get_kode_list']            = 'pengurangan/get_kode_list';
$route['pengurangan/store']                    = 'pengurangan/store';
$route['pengurangan/destroy/(:num)']['delete'] = 'pengurangan/destroy/$1';

// permintaan
$route['permintaan/index']                    = 'permintaan/index';
$route['permintaan/get_kode_list']            = 'permintaan/get_kode_list';
$route['permintaan/store']                    = 'permintaan/store';
$route['permintaan/pending_to_order']         = 'permintaan/pending_to_order';
$route['permintaan/order_to_selesai']         = 'permintaan/order_to_selesai';
$route['permintaan/destroy/(:num)']['delete'] = 'permintaan/destroy/$1';

// akun
$route['account/index']                    = 'account/index';
$route['account/update']                   = 'account/update';
$route['account/destroy/(:num)']['delete'] = 'account/destroy/$1';

// akun grup
$route['account_group/index']                    = 'account_group/index';
$route['account_group/update']                   = 'account_group/update';
$route['account_group/destroy/(:num)']['delete'] = 'account_group/destroy/$1';

// cashflow kas cash
$route['cashflow_kas_cash/index']                    = 'cashflow_kas_cash/index';
$route['cashflow_kas_cash/add']                      = 'cashflow_kas_cash/add';
$route['cashflow_kas_cash/store']                    = 'cashflow_kas_cash/store';
$route['cashflow_kas_cash/render']                   = 'cashflow_kas_cash/render';
$route['cashflow_kas_cash/destroy/(:num)']['delete'] = 'cashflow_kas_cash/destroy/$1';

// cashflow bca
$route['cashflow_bca/index']                    = 'cashflow_bca/index';
$route['cashflow_bca/add']                      = 'cashflow_bca/add';
$route['cashflow_bca/store']                    = 'cashflow_bca/store';
$route['cashflow_bca/render']                   = 'cashflow_bca/render';
$route['cashflow_bca/destroy/(:num)']['delete'] = 'cashflow_bca/destroy/$1';

// cashflow mandiri
$route['cashflow_mandiri/index']                    = 'cashflow_mandiri/index';
$route['cashflow_mandiri/add']                      = 'cashflow_mandiri/add';
$route['cashflow_mandiri/store']                    = 'cashflow_mandiri/store';
$route['cashflow_mandiri/render']                   = 'cashflow_mandiri/render';
$route['cashflow_mandiri/destroy/(:num)']['delete'] = 'cashflow_mandiri/destroy/$1';

// rekap cashflow
$route['rekap_cashflow/index'] = 'rekap_cashflow/index';

//// setup
// setup project
$route['setup/project']                    = 'project/index';
$route['project/update']                   = 'project/update';
$route['project/destroy/(:num)']['delete'] = 'project/destroy/$1';

// setup karyawan
$route['setup/karyawan']                    = 'karyawan/index';
$route['karyawan/update']                   = 'karyawan/update';
$route['karyawan/destroy/(:num)']['delete'] = 'karyawan/destroy/$1';

// setup hpp
$route['setup/hpp']                    = 'hpp/index';
$route['hpp/update']                   = 'hpp/update';
$route['hpp/destroy/(:num)']['delete'] = 'hpp/destroy/$1';

// setup supplier
$route['setup/supplier']                    = 'supplier/index';
$route['supplier/update']                   = 'supplier/update';
$route['supplier/destroy/(:num)']['delete'] = 'supplier/destroy/$1';

// setup parameter satuan
$route['setup/parameter/satuan']                  = 'satuan/index';
$route['setup/parameter/satuan/(:num)']['delete'] = 'satuan/destroy/$1';
$route['setup/parameter/satuan/(:num)']['post']   = 'satuan/edit/$1';
$route['setup/parameter/satuan/(:num)']['get']    = 'satuan/edit/$1';

// setup parameter warna
$route['setup/parameter/warna']                  = 'warna/index';
$route['setup/parameter/warna/(:num)']['delete'] = 'warna/destroy/$1';
$route['setup/parameter/warna/(:num)']['post']   = 'warna/edit/$1';
$route['setup/parameter/warna/(:num)']['get']    = 'warna/edit/$1';

// setup parameter ukuran
$route['setup/parameter/ukuran']                  = 'ukuran/index';
$route['setup/parameter/ukuran/(:num)']['delete'] = 'ukuran/destroy/$1';
$route['setup/parameter/ukuran/(:num)']['post']   = 'ukuran/edit/$1';
$route['setup/parameter/ukuran/(:num)']['get']    = 'ukuran/edit/$1';

// setup parameter request
$route['setup/parameter/request']                  = 'request/index';
$route['setup/parameter/request/(:num)']['delete'] = 'request/destroy/$1';
$route['setup/parameter/request/(:num)']['post']   = 'request/edit/$1';
$route['setup/parameter/request/(:num)']['get']    = 'request/edit/$1';

$route['setup/parameter/kategori']                          = 'kategori/index';
$route['setup/parameter/kategori/update']                   = 'kategori/update';
$route['setup/parameter/kategori/destroy/(:num)']['delete'] = 'kategori/destroy/$1';

$route['setup/parameter/merk']                          = 'merk/index';
$route['setup/parameter/merk/update']                   = 'merk/update';
$route['setup/parameter/merk/destroy/(:num)']['delete'] = 'merk/destroy/$1';

// init
$route['init/admin'] = 'init/admin';


// cli
$route['cli/check_expired'] = 'cli/check_expired';
$route['cli/check_resi']    = 'cli/check_resi';

// test
$route['test']   = 'test/index';
$route['upload'] = 'test/upload';
