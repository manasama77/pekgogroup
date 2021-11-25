<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'supplier.id',
            'supplier.name',
            'supplier.location',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('supplier');
        $this->db->where('supplier.deleted_at', null);
        $this->db->order_by('supplier.name', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('supplier');
        $this->db->join('units', 'units.id = supplier.unit_id', 'left');
        $this->db->where($field, $keyword);
        $this->db->where('supplier.deleted_at', null);
        $this->db->order_by('supplier.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }


    public function store($data)
    {
        return $this->db->insert('supplier', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('supplier', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('supplier', $data, $where);
    }
}
                        
/* End of file Supplier_model.php */
