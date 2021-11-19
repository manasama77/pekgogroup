<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function get_total_order()
    {
        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $exec = $this->db->get('orders');
        return $exec->num_rows();
    }

    public function get_total_order_this_month()
    {
        $this->db->where('month(created_at)', date('m'));
        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $exec = $this->db->get('orders');
        return $exec->num_rows();
    }

    public function get_pendapatan_this_month()
    {
        $this->db->select_sum('grand_total');
        $this->db->where('month(created_at)', date('m'));
        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $exec = $this->db->get('orders');
        return $exec->row()->grand_total;
    }

    public function get_total_customers()
    {
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at', null);
        $exec = $this->db->get('customers');
        return $exec->num_rows();
    }

    public function get_total_customers_this_month()
    {
        $this->db->where('month(created_at)', date('m'));
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at', null);
        $exec = $this->db->get('customers');
        return $exec->num_rows();
    }

    public function get_track($sales_invoice)
    {
        $this->db->select([
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
        ]);
        $this->db->join('products', 'products.id = orders.product_id', 'left');
        $this->db->join('colors', 'colors.id = orders.color_id', 'left');
        $this->db->join('sizes', 'sizes.id = orders.size_id', 'left');
        $this->db->join('customers', 'customers.id = orders.customer_id', 'left');
        $this->db->join('admins as admin_order', 'admin_order.id = orders.admin_order', 'left');
        $this->db->join('admins as admin_produksi', 'admin_produksi.id = orders.admin_produksi', 'left');
        $this->db->join('admins as admin_cs', 'admin_cs.id = orders.admin_cs', 'left');
        $this->db->join('admins as admin_finance', 'admin_finance.id = orders.admin_finance', 'left');

        $this->db->like('orders.sales_invoice', $sales_invoice);
        $this->db->where('orders.status', 'active');
        $this->db->where('orders.deleted_at', null);
        $exec = $this->db->get('orders');

        $data = [];

        foreach ($exec->result() as $key) {
            $nested['sales_invoice']     = $key->sales_invoice;
            $nested['created_at']        = $key->created_at;
            $nested['estimasi_selesai']  = $key->estimasi_selesai;
            $nested['order_via']         = strtoupper($key->order_via);
            $nested['nama_customer']     = $key->nama_customer;
            $nested['whatsapp']          = $key->whatsapp;
            $nested['nama_produk']       = ucwords($key->nama_produk);
            $nested['nama_warna']        = ucwords($key->nama_warna);
            $nested['nama_ukuran']       = ucwords($key->nama_ukuran);
            $nested['pilih_jahitan']     = ucwords($key->pilih_jahitan);
            $nested['status_order']      = ucwords($key->status_order);
            $nested['status_pembayaran'] = ucwords($key->status_pembayaran);
            $nested['grand_total']       = number_format($key->grand_total, 0);

            array_push($data, $nested);
        }

        return $data;
    }
}
                        
/* End of file Dashboard_model.php */
