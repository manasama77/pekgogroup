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
            'hpps.supplier_id',
            'units.name as unit_name',
            'supplier.name as supplier_name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('hpps');
        $this->db->join('units', 'units.id = hpps.unit_id', 'left');
        $this->db->join('supplier', 'supplier.id = hpps.supplier_id', 'left');
        $this->db->where('hpps.deleted_at', null);
        $this->db->order_by('hpps.name', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('hpps');
        $this->db->join('units', 'units.id = hpps.unit_id', 'left');
        $this->db->join('supplier', 'supplier.id = hpps.supplier_id', 'left');
        $this->db->where($field, $keyword);
        $this->db->where('hpps.deleted_at', null);
        $this->db->order_by('hpps.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }


    public function store($data)
    {
        return $this->db->insert('hpps', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('hpps', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('hpps', $data, $where);
    }
}
                        
/* End of file Hpp_model.php */
