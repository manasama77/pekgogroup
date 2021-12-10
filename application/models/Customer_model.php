<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    protected $select;
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->cur_datetime = new DateTime('now');
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

    public function get_single_data_can_order($customer_id)
    {
        $sql = "
        SELECT
            customers.*,
            (
            SELECT
                count(*) 
            FROM
                orders 
            WHERE
                orders.customer_id = customers.id 
                AND orders.status_order NOT IN ( 'selesai', 'order dibatalkan', 'retur pending', 'retur terkirim', 'refund' ) 
                AND orders.STATUS = 'active' 
                AND orders.deleted_at IS NULL
            ) AS active_order 
        FROM
            customers 
        WHERE
            customers.id = $customer_id
        ";
        $exec = $this->db->query($sql);
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

    public function reset($id, $new_password)
    {
        return $this->db->update('customers', ['password' => $new_password], ['id' => $id]);
    }

    public function whatsapp_check($whatsapp)
    {
        $this->db->where('customers.whatsapp', $whatsapp);
        $this->db->where('customers.status', 'aktif');
        $this->db->where('customers.deleted_at', null);
        $result = $this->db->count_all_results('customers');

        if ($result == 0) {
            return false;
        } elseif ($result > 1) {
            return false;
        }

        return true;
    }

    public function password_check($whatsapp, $password)
    {
        $this->db->select('customers.password');
        $this->db->from('customers');
        $this->db->where('customers.whatsapp', $whatsapp);
        $this->db->where('customers.status', 'aktif');
        $this->db->where('customers.deleted_at', null);
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

    public function update_log($id, $whatsapp)
    {
        $data = array(
            'customers.updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'customers.updated_by' => $id,
        );
        $this->db->set($data);
        $this->db->where('customers.whatsapp', $whatsapp);
        $this->db->update('customers');
    }

    public function reduce_order($customer_id, $price)
    {
        $this->db->set('customers.order_created', 'customers.order_created - 1', false);
        $this->db->set('customers.order_total', 'customers.order_total - ' . $price, false);
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->set('updated_by', $this->session->userdata(SESS_ADM, 'id'));
        $this->db->where('id', $customer_id);
        $this->db->update('customers');
    }
}
                        
/* End of file Customer_model.php */
