<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'employees.id',
            'employees.name',
            'employees.role',
            'employees.path_photo',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('employees');
        $this->db->where('employees.deleted_at', null);
        $this->db->order_by('employees.id', 'asc');
        $exec = $this->db->get();

        $result = array();

        if ($exec->num_rows() == 0) {
            $result[0] = array(
                'no'        => 1,
                'name'      => '',
                'role'      => '',
                'path_photo' => base_url() . 'assets/img/default-150x150.png',
            );
        } else {
            $itteration = 1;
            foreach ($exec->result() as $key) {
                $nested['no']        = $itteration++;
                $nested['name']      = $key->name;
                $nested['role']      = $key->role;
                if ($key->path_photo != null || $key->path_photo != '') {
                    $nested['path_photo'] = base_url() . 'assets/img/karyawan/' . $key->path_photo;
                } else {
                    $nested['path_photo'] = base_url() . 'assets/img/default-150x150.png';
                }
                array_push($result, $nested);
            }
        }

        return $result;
    }

    public function get_single_data($keyword)
    {
        $this->db->select($this->select);
        $this->db->from('employees');
        $this->db->where('employees.role', $keyword);
        $this->db->where('employees.deleted_at', null);
        $this->db->order_by('employees.id', 'asc');
        $exec = $this->db->get();

        if ($exec->num_rows() == 0) {
            $result['name'] = 'Pekgo Group';
            $result['logo'] = base_url() . 'assets/img/AdminLTELogo.png';
        } else {
            $result['name'] = $exec->row()->name;
            $result['logo'] = base_url() . 'assets/img/employees/' . $exec->row()->path_photo;
        }

        return $result;
    }


    public function store($data)
    {
        return $this->db->insert('employees', $data);
    }

    public function get_all_petugas($type)
    {
        $this->db->from('employees');
        $this->db->where('employees.role', $type);
        $this->db->where('employees.deleted_at', null);
        $this->db->order_by('employees.id', 'desc');
        $exec = $this->db->get();
        return $exec;
    }
}
                        
/* End of file Karyawan_model.php */
