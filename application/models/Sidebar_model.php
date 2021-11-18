<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sidebar_model extends CI_Model
{

    public function get()
    {
        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $orders = $this->db->get('orders');
        return $orders->num_rows();
    }
}
                        
/* End of file Sidebar_model.php */
