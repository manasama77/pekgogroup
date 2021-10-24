<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Request_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'requests.id',
            'requests.name',
            'requests.cost',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('requests');
        $this->db->where('requests.deleted_at', null);
        $this->db->order_by('requests.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('requests');
        $this->db->where('requests.' . $field, $keyword);
        $this->db->where('requests.deleted_at', null);
        $this->db->order_by('requests.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('requests', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('requests', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('requests', $data, $where);
    }
}
                        
/* End of file Request_model.php */
