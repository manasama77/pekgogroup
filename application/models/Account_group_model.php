<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Account_group_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'account_groups.id',
            'account_groups.name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('account_groups');
        $this->db->where('account_groups.deleted_at', null);
        $this->db->order_by('account_groups.name', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('account_groups');
        $this->db->where($field, $keyword);
        $this->db->where('account_groups.deleted_at', null);
        $this->db->order_by('account_groups.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }


    public function store($data)
    {
        return $this->db->insert('account_groups', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('account_groups', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('account_groups', $data, $where);
    }
}
                        
/* End of file Account_group_model.php */
