<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hpp_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'hpps.id',
            'hpps.name',
            'hpps.cost',
            'hpps.unit_id',
            'units.name as unit_name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('hpps');
        $this->db->join('units', 'units.id = hpps.unit_id', 'left');
        $this->db->where('hpps.deleted_at', null);
        $this->db->order_by('hpps.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($keyword)
    {
        $this->db->select($this->select);
        $this->db->from('hpps');
        $this->db->where('hpps.cost', $keyword);
        $this->db->where('hpps.deleted_at', null);
        $this->db->order_by('hpps.id', 'asc');
        $exec = $this->db->get();

        if ($exec->num_rows() == 0) {
            $result['name'] = 'Pekgo Group';
            $result['logo'] = base_url() . 'assets/img/AdminLTELogo.png';
        } else {
            $result['name'] = $exec->row()->name;
            $result['logo'] = base_url() . 'assets/img/hpps/' . $exec->row()->unit_id;
        }

        return $result;
    }


    public function store($data)
    {
        return $this->db->insert('hpps', $data);
    }
}
                        
/* End of file Hpp_model.php */
