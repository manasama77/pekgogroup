<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produksi_model extends CI_Model
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->cur_datetime = new DateTime('now');
        $this->select = array(
            'orders.id',
            'orders.project_id',
            'orders.sales_invoice',
            'orders.durasi_batas_transfer',
            'orders.batas_waktu_transfer',
            'orders.estimasi_selesai',
            'orders.order_via',
            'orders.product_id',
            'orders.color_id',
            'orders.size_id',
            'orders.pilih_jahitan',
            'orders.catatan',
            'orders.customer_id',
            'orders.whatsapp',
            'orders.id_tokped',
            'orders.id_shopee',
            'orders.id_instagram',
            'orders.status_order',
            'orders.status_pembayaran',
            'orders.status_pengiriman',
            'orders.sub_total',
            'orders.kode_unik',
            'orders.grand_total',
            'orders.jenis_dp',
            'orders.dp_value',
            'orders.pelunasan_value',
            'orders.terbayarkan',
            'orders.tanggal_pengiriman',
            'orders.ekspedisi',
            'orders.no_resi',
            'orders.admin_order',
            'orders.alamat_pengiriman',
            'orders.admin_finance',
            'orders.admin_cs',
            'orders.admin_produksi',
            'orders.is_printed',
            'orders.is_production',
            'orders.is_paid_off',
            'orders.status',
            'orders.created_at',
            'products.name as nama_produk',
            'products.price as harga_produk',
            'colors.name as nama_warna',
            'sizes.name as nama_ukuran',
            'sizes.cost as harga_ukuran',
            'customers.name as nama_customer',
            'admin_order.name as nama_admin_order',
            'admin_produksi.name as nama_admin_produksi',
            'admin_cs.name as nama_admin_cs',
            'admin_finance.name as nama_admin_finance',

            'potong.id as id_petugas_potong_kain',
            'potong.name as petugas_potong_kain',
            'order_productions.tanggal_potong_kain',

            'jahit.id as id_petugas_jahit',
            'jahit.name as petugas_jahit',
            'order_productions.tanggal_jahit',

            'qc_1.id as id_petugas_qc_1',
            'qc_1.name as petugas_qc_1',
            'order_productions.tanggal_qc_1',

            'aksesoris.id as id_petugas_aksesoris',
            'aksesoris.name as petugas_aksesoris',
            'order_productions.tanggal_aksesoris',

            'qc_2.id as id_petugas_qc_2',
            'qc_2.name as petugas_qc_2',
            'order_productions.tanggal_qc_2',
        );
    }

    public function get_all_data($product_id, $customer_id, $field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('orders');
        $this->db->join('products', 'products.id = orders.product_id', 'left');
        $this->db->join('product_color_params', 'product_color_params.id = orders.color_id', 'left');
        $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
        $this->db->join('product_size_params', 'product_size_params.id = orders.size_id', 'left');
        $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
        $this->db->join('customers', 'customers.id = orders.customer_id', 'left');
        $this->db->join('admins as admin_order', 'admin_order.id = orders.admin_order', 'left');
        $this->db->join('admins as admin_produksi', 'admin_produksi.id = orders.admin_produksi', 'left');
        $this->db->join('admins as admin_cs', 'admin_cs.id = orders.admin_cs', 'left');
        $this->db->join('admins as admin_finance', 'admin_finance.id = orders.admin_finance', 'left');
        $this->db->join('order_productions', 'order_productions.order_id = orders.id', 'left');
        $this->db->join('employees as potong', 'potong.id = order_productions.petugas_potong_kain', 'left');
        $this->db->join('employees as jahit', 'jahit.id = order_productions.petugas_jahit', 'left');
        $this->db->join('employees as qc_1', 'qc_1.id = order_productions.petugas_qc_1', 'left');
        $this->db->join('employees as aksesoris', 'aksesoris.id = order_productions.petugas_aksesoris', 'left');
        $this->db->join('employees as qc_2', 'qc_2.id = order_productions.petugas_qc_2', 'left');

        if ($product_id != 'all') {
            $this->db->where('orders.product_id', $product_id);
        }

        if ($customer_id != 'all') {
            $this->db->where('orders.customer_id', $customer_id);
        }

        if ($field == 'all') {
            $this->db->group_start();
            $this->db->like('orders.created_at', $keyword);
            $this->db->or_like('orders.sales_invoice', $keyword);
            $this->db->or_like('orders.whatsapp', $keyword);
            $this->db->or_like('orders.id_tokped', $keyword);
            $this->db->or_like('orders.id_shopee', $keyword);
            $this->db->or_like('orders.id_instagram', $keyword);
            $this->db->or_like('orders.grand_total', $keyword);
            $this->db->group_end();
        } else {
            $this->db->like('orders.' . $field, $keyword);
        }

        $array_status_order = ['order dibuat', 'naik produksi'];
        $this->db->where_in('orders.status_order', $array_status_order);

        $array_status_pembayaran = ['partial', 'lunas'];
        $this->db->where_in('orders.status_pembayaran', $array_status_pembayaran);

        $this->db->where('orders.status', 'active');
        $this->db->where('orders.deleted_at', null);
        $this->db->order_by('orders.id', 'desc');
        $exec = $this->db->get();
        return $exec;
    }

    public function generate_data_produksi($id)
    {
        $this->db->select('path_logo');
        $this->db->from('projects');
        $this->db->where('id', 1);
        $exec = $this->db->get();
        $path_logo = base_url() . 'assets/img/projects/' . $exec->row()->path_logo;

        $this->db->select($this->select);
        $this->db->from('orders');
        $this->db->join('products', 'products.id = orders.product_id', 'left');
        $this->db->join('product_color_params', 'product_color_params.id = orders.color_id', 'left');
        $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
        $this->db->join('product_size_params', 'product_size_params.id = orders.size_id', 'left');
        $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
        $this->db->join('customers', 'customers.id = orders.customer_id', 'left');
        $this->db->join('admins as admin_order', 'admin_order.id = orders.admin_order', 'left');
        $this->db->join('admins as admin_produksi', 'admin_produksi.id = orders.admin_produksi', 'left');
        $this->db->join('admins as admin_cs', 'admin_cs.id = orders.admin_cs', 'left');
        $this->db->join('admins as admin_finance', 'admin_finance.id = orders.admin_cs', 'left');
        $this->db->join('order_productions', 'order_productions.order_id = orders.id', 'left');
        $this->db->join('employees as potong', 'potong.id = order_productions.petugas_potong_kain', 'left');
        $this->db->join('employees as jahit', 'jahit.id = order_productions.petugas_jahit', 'left');
        $this->db->join('employees as qc_1', 'qc_1.id = order_productions.petugas_qc_1', 'left');
        $this->db->join('employees as aksesoris', 'aksesoris.id = order_productions.petugas_aksesoris', 'left');
        $this->db->join('employees as qc_2', 'qc_2.id = order_productions.petugas_qc_2', 'left');
        $this->db->where('orders.id', $id);
        $this->db->where('orders.status', 'active');
        $this->db->where('orders.deleted_at', null);
        $this->db->order_by('orders.id', 'desc');
        $exec_order = $this->db->get();

        $this->db->select(array(
            'requests.name',
            'requests.cost',
        ));
        $this->db->from('order_requests');
        $this->db->join('product_request_params', 'product_request_params.id = order_requests.request_id', 'left');
        $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
        $this->db->where('order_requests.order_id', $id);
        $exec_request = $this->db->get();

        $this->db->select(array(
            'hpps.name',
            'product_hpp_params.qty',
            'units.name as satuan_unit',
        ));
        $this->db->from('products');
        $this->db->join('product_hpp_params', 'product_hpp_params.product_id = products.id', 'left');
        $this->db->join('hpps', 'hpps.id = product_hpp_params.hpp_id', 'left');
        $this->db->join('units', 'units.id = hpps.unit_id', 'left');
        $this->db->where('products.id', $exec_order->row()->product_id);
        $exec_hpp = $this->db->get();

        $this->db->select(array(
            'ppk.name as petugas_potong_kain',
            'pj.name as petugas_jahit',
            'pqc1.name as petugas_qc_1',
            'pas.name as petugas_aksesoris',
            'pqc2.name as petugas_qc_2',
            'order_productions.tanggal_potong_kain',
            'order_productions.tanggal_jahit',
            'order_productions.tanggal_qc_1',
            'order_productions.tanggal_aksesoris',
            'order_productions.tanggal_qc_2',
        ));
        $this->db->from('order_productions');
        $this->db->join('employees as ppk', 'ppk.id = order_productions.petugas_potong_kain', 'left');
        $this->db->join('employees as pj', 'pj.id = order_productions.petugas_jahit', 'left');
        $this->db->join('employees as pqc1', 'pqc1.id = order_productions.petugas_qc_1', 'left');
        $this->db->join('employees as pas', 'pas.id = order_productions.petugas_aksesoris', 'left');
        $this->db->join('employees as pqc2', 'pqc2.id = order_productions.petugas_qc_2', 'left');
        $this->db->where('order_productions.order_id', $exec_order->row()->id);
        $exec_karyawan = $this->db->get();

        if ($exec_karyawan->num_rows() == 0) {
            $data_karyawan = [
                'petugas_potong'    => "",
                'tgl_potong'        => "",
                'petugas_jahit'     => "",
                'tgl_jahit'         => "",
                'petugas_qc_1'      => "",
                'tgl_qc_1'          => "",
                'petugas_aksesoris' => "",
                'tgl_aksesoris'     => "",
                'petugas_qc_2'      => "",
                'tgl_qc_2'          => "",
            ];
        } else {
            $data_karyawan = [
                'petugas_potong'    => $exec_karyawan->row()->petugas_potong_kain,
                'tgl_potong'        => $exec_karyawan->row()->tanggal_potong_kain,
                'petugas_jahit'     => $exec_karyawan->row()->petugas_jahit,
                'tgl_jahit'         => $exec_karyawan->row()->tanggal_jahit,
                'petugas_qc_1'      => $exec_karyawan->row()->petugas_qc_1,
                'tgl_qc_1'          => $exec_karyawan->row()->tanggal_qc_1,
                'petugas_aksesoris' => $exec_karyawan->row()->petugas_aksesoris,
                'tgl_aksesoris'     => $exec_karyawan->row()->tanggal_aksesoris,
                'petugas_qc_2'      => $exec_karyawan->row()->petugas_qc_2,
                'tgl_qc_2'          => $exec_karyawan->row()->tanggal_qc_2,
            ];
        }

        $data = [
            'orders.status_order'   => 'naik produksi',
            'orders.admin_produksi' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $this->db->where('orders.id', $id);
        $this->db->where('orders.status_order', 'order dibuat');
        $this->db->where_in('orders.status_pembayaran', ['partial', 'lunas']);
        $this->db->update('orders', $data);

        $return = array(
            'path_logo'     => $path_logo,
            'data_orders'   => $exec_order->result(),
            'data_requests' => $exec_request->result(),
            'data_hpps'     => $exec_hpp->result(),
            'data_karyawan' => $data_karyawan,
        );

        return $return;
    }

    public function store_history($order_id, $data_1, $data_2)
    {
        $this->db->where('order_productions.order_id', $order_id);
        $exec = $this->db->get('order_productions');
        if ($exec->num_rows() == 0) {
            //insert
            $exec = $this->db->insert('order_productions', $data_1);
        } else {
            //update
            $where = ['order_id' => $order_id];
            $exec  = $this->db->update('order_productions', $data_2, $where);
        }


        $this->db->where('order_productions.order_id', $order_id);
        $exec = $this->db->get('order_productions');

        $petugas_potong_kain = ($exec->row()->petugas_potong_kain) ?? null;
        $petugas_jahit       = ($exec->row()->petugas_jahit) ?? null;
        $petugas_qc_1        = ($exec->row()->petugas_qc_1) ?? null;
        $petugas_aksesoris   = ($exec->row()->petugas_aksesoris) ?? null;
        $petugas_qc_2        = ($exec->row()->petugas_qc_2) ?? null;

        if ($petugas_potong_kain != null && $petugas_jahit != null && $petugas_qc_1 != null && $petugas_aksesoris != null && $petugas_qc_2 != null) {
            $data = [
                'status_order'   => 'pengiriman',
                'admin_produksi' => $this->session->userdata(SESS_ADM . 'id'),
                'updated_at'     => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'     => $this->session->userdata(SESS_ADM . 'id'),
            ];
            $this->db->where('orders.status_pembayaran', 'lunas');
            $this->db->where('orders.id', $order_id);
            $this->db->update('orders', $data);
        } else {
            $data = [
                'status_order'   => 'naik produksi',
                'admin_produksi' => $this->session->userdata(SESS_ADM . 'id'),
                'updated_at'     => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'     => $this->session->userdata(SESS_ADM . 'id'),
            ];
            $this->db->where_in('orders.status_pembayaran', ['partial', 'lunas']);
            $this->db->where('orders.id', $order_id);
            $this->db->update('orders', $data);
        }

        return $exec;
    }
}
                        
/* End of file Produksi_model.php */
