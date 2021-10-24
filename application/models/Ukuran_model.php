<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ukuran_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'sizes.id',
            'sizes.name',
            'sizes.cost',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('sizes');
        $this->db->where('sizes.deleted_at', null);
        $this->db->order_by('sizes.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('sizes');
        $this->db->where('sizes.' . $field, $keyword);
        $this->db->where('sizes.deleted_at', null);
        $this->db->order_by('sizes.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('sizes', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('sizes', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('sizes', $data, $where);
    }
}
                        
/* End of file Ukuran_model.php */
