<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman_model extends CI_Model
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

        $this->db->where('orders.status_order', 'pengiriman');
        $this->db->where('orders.status_pembayaran', 'lunas');
        $this->db->where('orders.status', 'active');
        $this->db->where('orders.deleted_at', null);
        $this->db->order_by('orders.id', 'desc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_data_pengiriman($id)
    {
        $this->db->from('orders');
        $this->db->where('orders.id', $id);
        $this->db->where('orders.deleted_at', null);
        $exec = $this->db->get();

        $tanggal_pengiriman = $exec->row()->tanggal_pengiriman;

        if ($tanggal_pengiriman == null) {
            return 200;
        } else {
            return 404;
        }
    }

    public function store($order_id, $tanggal_pengiriman, $ekspedisi, $no_resi, $alamat_pengiriman)
    {
        $data = [
            'orders.tanggal_pengiriman' => $tanggal_pengiriman,
            'orders.ekspedisi'          => $ekspedisi,
            'orders.no_resi'            => $no_resi,
            'orders.alamat_pengiriman'  => $alamat_pengiriman,
            'orders.status_pengiriman'  => 'proses pengiriman',
            'admin_order'               => $this->session->userdata('id'),
            'updated_at'                => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'                => $this->session->userdata('id'),
        ];
        $this->db->where('orders.id', $order_id);
        return $this->db->update('orders', $data);
    }

    public function selesai($id)
    {
        $data = [
            'status_order'      => 'selesai',
            'status_pengiriman' => 'terkirim',
            'admin_order'       => $this->session->userdata('id'),
            'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'        => $this->session->userdata('id'),
        ];
        $where = ['id' => $id];
        return $this->db->update('orders', $data, $where);
    }
}
                        
/* End of file Pengiriman_model.php */
