<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{

    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->cur_datetime = new DateTime('now');
        $this->select = array(
            'products.id',
            'products.code',
            'products.name',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('products');
        $this->db->where('products.deleted_at', null);
        $this->db->order_by('products.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($whatsapp)
    {
        $this->db->where('whatsapp', $whatsapp);
        $this->db->where('products.status', 'aktif');
        $this->db->where('products.deleted_at', null);
        $exec = $this->db->get('produks', 1);

        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('produks', $data);
    }

    public function update_log($id, $whatsapp)
    {
        $data = array(
            'products.updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'products.updated_by' => $id,
        );
        $this->db->set($data);
        $this->db->where('products.whatsapp', $whatsapp);
        $this->db->update('produks');
    }

    public function init_produk()
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

        $this->db->truncate('produks');
        $exec = $this->db->insert('produks', $data);
        return $exec;
    }

    public function whatsapp_check($whatsapp)
    {
        $this->db->where('products.whatsapp', $whatsapp);
        $this->db->where('products.status', 'aktif');
        $this->db->where('products.deleted_at', null);
        $result = $this->db->count_all_results('produks');

        if ($result == 0) {
            return false;
        } elseif ($result > 1) {
            return false;
        }

        return true;
    }

    public function password_check($whatsapp, $password)
    {
        $this->db->select('products.password');
        $this->db->from('produks');
        $this->db->where('products.whatsapp', $whatsapp);
        $this->db->where('products.status', 'aktif');
        $this->db->where('products.deleted_at', null);
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
}
                        
/* End of file Produk_model.php */
