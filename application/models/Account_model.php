<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Account_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'accounts.id',
            'accounts.no_akun',
            'accounts.nama_akun',
            'accounts.kelompok_akun',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('accounts');
        $this->db->where('accounts.deleted_at', null);
        $this->db->order_by('accounts.no_akun', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('accounts');
        $this->db->join('units', 'units.id = accounts.unit_id', 'left');
        $this->db->where($field, $keyword);
        $this->db->where('accounts.deleted_at', null);
        $this->db->order_by('accounts.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }


    public function store($data)
    {
        return $this->db->insert('accounts', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('accounts', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('accounts', $data, $where);
    }
}
                        
/* End of file Account_model.php */
