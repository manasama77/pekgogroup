<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cdashboard_model extends CI_Model
{

    public function get_total_order()
    {
        $this->db->where('month(created_at)', date('m'));
        $this->db->where('customer_id', $this->session->userdata('id'));
        $exec = $this->db->get('orders');
        return $exec->num_rows();
    }
}
                        
/* End of file Cdashboard_model.php */
