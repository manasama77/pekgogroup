<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Warna_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'colors.id',
            'colors.name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('colors');
        $this->db->where('colors.deleted_at', null);
        $this->db->order_by('colors.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('colors');
        $this->db->where('colors.' . $field, $keyword);
        $this->db->where('colors.deleted_at', null);
        $this->db->order_by('colors.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('colors', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('colors', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('colors', $data, $where);
    }
}
                        
/* End of file Warna_model.php */
