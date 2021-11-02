<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function get_total_order()
    {
        $this->db->where('month(created_at)', date('m'));
        $exec = $this->db->get('orders');
        return $exec->num_rows();
    }
}
                        
/* End of file Dashboard_model.php */
