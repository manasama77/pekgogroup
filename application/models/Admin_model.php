<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->cur_datetime = new DateTime('now');
        $this->select = array(
            'admins.id',
            'admins.whatsapp',
            'admins.name',
            'admins.role',
            'admins.status',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('admins');
        $this->db->where('admins.deleted_at', null);
        $this->db->order_by('admins.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($whatsapp)
    {
        $this->db->where('whatsapp', $whatsapp);
        $this->db->where('admins.status', 'aktif');
        $this->db->where('admins.deleted_at', null);
        $exec = $this->db->get('admins', 1);

        return $exec;
    }

    public function get_single_data_2($field, $keyword)
    {
        $this->db->where($field, $keyword);
        $this->db->where('admins.deleted_at', null);
        $exec = $this->db->get('admins', 1);
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('admins', $data);
    }

    public function update_log($id, $whatsapp)
    {
        $data = array(
            'admins.updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'admins.updated_by' => $id,
        );
        $this->db->set($data);
        $this->db->where('admins.whatsapp', $whatsapp);
        $this->db->update('admins');
    }

    public function init_admin()
    {
        $password      = 'adam';
        $password_hash = password_hash($password . HASH_SLING_SLICER, PASSWORD_BCRYPT);

        $data = array(
            'whatsapp'   => '082114578976',
            'password'   => $password_hash,
            'name'       => 'Adam',
            'role'       => 'developer',
            'status'     => 'aktif',
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_at' => null,
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null,
        );

        $this->db->truncate('admins');
        $exec = $this->db->insert('admins', $data);
        return $exec;
    }

    public function whatsapp_check($whatsapp)
    {
        $this->db->where('admins.whatsapp', $whatsapp);
        $this->db->where('admins.status', 'aktif');
        $this->db->where('admins.deleted_at', null);
        $result = $this->db->count_all_results('admins');

        if ($result == 0) {
            return false;
        } elseif ($result > 1) {
            return false;
        }

        return true;
    }

    public function password_check($whatsapp, $password)
    {
        $this->db->select('admins.password');
        $this->db->from('admins');
        $this->db->where('admins.whatsapp', $whatsapp);
        $this->db->where('admins.status', 'aktif');
        $this->db->where('admins.deleted_at', null);
        $result = $this->db->get();

        if ($result->num_rows() == 0) {
            return 404;
        } elseif ($result->num_rows() > 1) {
            return 404;
        } elseif (password_verify($password . HASH_SLING_SLICER, $result->row()->password) === false) {
            return false;
        } elseif (password_verify($password . HASH_SLING_SLICER, $result->row()->password) === true) {
            return true;
        }

        return false;
    }

    public function get_admin($type)
    {
        $this->db->select($this->select);
        $this->db->from('admins');
        $this->db->where('admins.deleted_at', null);
        $this->db->where('admins.role', $type);
        $this->db->order_by('admins.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function update($data, $where)
    {
        return $this->db->update('admins', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('admins', $data, $where);
    }
}
                        
/* End of file Admin_model.php */
