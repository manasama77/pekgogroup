<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sidebar_model extends CI_Model
{

    public function get()
    {
        $data = [
            'order'      => 0,
            'pembayaran' => 0,
            'produksi'   => 0,
            'pengiriman' => 0,
        ];

        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $orders = $this->db->get('orders');
        $data['order'] = $orders->num_rows();

        $this->db->where('status_pembayaran', 'menunggu verifikasi');
        $this->db->where('deleted_at', null);
        $pembayarans = $this->db->get('order_payments');
        $data['pembayaran'] = $pembayarans->num_rows();

        $this->db->where('status_order', 'naik produksi');
        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $orders = $this->db->get('orders');
        $data['produksi'] = $orders->num_rows();

        $this->db->where('status_order', 'pengiriman');
        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $orders = $this->db->get('orders');
        $data['pengiriman'] = $orders->num_rows();

        return $data;
    }
}
                        
/* End of file Sidebar_model.php */
