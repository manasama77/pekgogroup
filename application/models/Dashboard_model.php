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
}
                        
/* End of file Dashboard_model.php */
