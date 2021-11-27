<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'categories.id',
            'categories.name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('categories');
        $this->db->where('categories.deleted_at', null);
        $this->db->order_by('categories.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('categories');
        $this->db->where('categories.' . $field, $keyword);
        $this->db->where('categories.deleted_at', null);
        $this->db->order_by('categories.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('categories', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('categories', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('categories', $data, $where);
    }
}
                        
/* End of file Kategori_model.php */
