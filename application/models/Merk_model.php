<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Merk_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'merks.id',
            'merks.name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('merks');
        $this->db->where('merks.deleted_at', null);
        $this->db->order_by('merks.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('merks');
        $this->db->where('merks.' . $field, $keyword);
        $this->db->where('merks.deleted_at', null);
        $this->db->order_by('merks.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('merks', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('merks', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('merks', $data, $where);
    }
}
                        
/* End of file Merk_model.php */
