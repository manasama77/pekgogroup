<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'customers.id',
            'customers.whatsapp',
            'customers.name',
            'customers.id_tokped',
            'customers.id_shopee',
            'customers.id_instagram',
            'customers.order_created',
            'customers.order_canceled',
            'customers.order_total',
            'customers.status',
            'customers.reason_inactive',
        );
    }

    public function get_all_data($field = 'all', $status = 'aktif', $keyword = "")
    {
        if ($field != null && $status != null) {
            $this->db->select($this->select);
            $this->db->from('customers');
            $this->db->where('customers.status', $status);
            $this->db->where('customers.deleted_at', null);

            if ($field == 'all') {
                $this->db
                    ->group_start()
                    ->like('customers.whatsapp', $keyword)
                    ->or_like('customers.name', $keyword)
                    ->or_like('customers.id_tokped', $keyword)
                    ->or_like('customers.id_shopee', $keyword)
                    ->or_like('customers.id_instagram', $keyword)
                    ->or_like('customers.order_total', $keyword)
                    ->group_end();
            } else {
                $this->db->like('customers.' . $field, $keyword);
            }

            $this->db->order_by('customers.id', 'asc');
            $exec = $this->db->get();
            return $exec;
        }

        return null;
    }

    public function get_single_data($field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('customers');
        $this->db->where('customers.' . $field, $keyword);
        $this->db->where('customers.deleted_at', null);
        $this->db->order_by('customers.id', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('customers', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('customers', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('customers', $data, $where);
    }
}
                        
/* End of file Customer_model.php */
