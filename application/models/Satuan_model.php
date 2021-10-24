<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Satuan_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'units.id',
            'units.name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('units');
        $this->db->where('units.deleted_at', null);
        $this->db->order_by('units.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('units');
        $this->db->where('units.' . $field, $keyword);
        $this->db->where('units.deleted_at', null);
        $this->db->order_by('units.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }


    public function store($data)
    {
        return $this->db->insert('units', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('units', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('units', $data, $where);
    }
}
                        
/* End of file Satuan_model.php */
