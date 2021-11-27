<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'pembelian.id',
            'pembelian.tanggal_pembelian',
            'pembelian.supplier_id',
            'pembelian.no_invoice',
            'pembelian.total',
            'supplier.name as nama_supplier',
        );
    }

    public function get_all_data()
    {
        $data = [];

        $this->db->select($this->select);
        $this->db->from('pembelian');
        $this->db->join('supplier', 'supplier.id = pembelian.supplier_id', 'left');
        $this->db->where('pembelian.deleted_at', null);
        $this->db->order_by('pembelian.created_at', 'asc');
        $exec = $this->db->get();

        $itt = 0;
        foreach ($exec->result() as $key) {
            $data[$itt]['id']                = $key->id;
            $data[$itt]['tanggal_pembelian'] = $key->tanggal_pembelian;
            $data[$itt]['supplier_id']       = $key->supplier_id;
            $data[$itt]['no_invoice']        = $key->no_invoice;
            $data[$itt]['total']             = number_format($key->total, 0);
            $data[$itt]['nama_supplier']     = $key->nama_supplier;

            $this->db->select([
                'sub_pembelian.id',
                'sub_pembelian.pembelian_id',
                'sub_pembelian.barang_id',
                'sub_pembelian.sub_barang_id',
                'sub_pembelian.harga',
                'sub_pembelian.qty',
                'sub_pembelian.total',
                'barangs.name as nama_barang',
                'sub_barangs.kode as kode_barang',
            ]);
            $this->db->join('barangs', 'barangs.id = sub_pembelian.barang_id', 'left');
            $this->db->join('sub_barangs', 'sub_barangs.id = sub_pembelian.sub_barang_id', 'left');
            $this->db->where('sub_pembelian.pembelian_id', $key->id);
            $this->db->where('sub_pembelian.deleted_at', null);
            $exec_sub = $this->db->get('sub_pembelian');

            $itt_sub = 0;
            foreach ($exec_sub->result() as $key_sub) {
                $data[$itt]['sub'][$itt_sub]['id']            = $key_sub->id;
                $data[$itt]['sub'][$itt_sub]['pembelian_id']  = $key_sub->pembelian_id;
                $data[$itt]['sub'][$itt_sub]['barang_id']     = $key_sub->barang_id;
                $data[$itt]['sub'][$itt_sub]['sub_barang_id'] = $key_sub->sub_barang_id;
                $data[$itt]['sub'][$itt_sub]['sub_barang_id'] = $key_sub->sub_barang_id;
                $data[$itt]['sub'][$itt_sub]['harga']         = number_format($key_sub->harga, 0);
                $data[$itt]['sub'][$itt_sub]['qty']           = number_format($key_sub->qty, 0);
                $data[$itt]['sub'][$itt_sub]['total']         = number_format($key_sub->total, 0);
                $data[$itt]['sub'][$itt_sub]['nama_barang']   = $key_sub->nama_barang;
                $data[$itt]['sub'][$itt_sub]['kode_barang']   = $key_sub->kode_barang;

                $itt_sub++;
            }

            $itt++;
        }
        return $data;
    }

    public function get_single_data($id)
    {
        $data = [];

        $this->db->select($this->select);
        $this->db->from('pembelian');
        $this->db->join('supplier', 'supplier.id = pembelian.supplier_id', 'left');
        $this->db->where('pembelian.id', $id);
        $this->db->where('pembelian.deleted_at', null);
        $this->db->order_by('pembelian.created_at', 'asc');
        $exec = $this->db->get();

        foreach ($exec->result() as $key) {
            $data['id']                = $key->id;
            $data['tanggal_pembelian'] = $key->tanggal_pembelian;
            $data['supplier_id']       = $key->supplier_id;
            $data['no_invoice']        = $key->no_invoice;
            $data['total']             = number_format($key->total, 0);
            $data['nama_supplier']     = $key->nama_supplier;

            $this->db->select([
                'sub_pembelian.id',
                'sub_pembelian.pembelian_id',
                'sub_pembelian.barang_id',
                'sub_pembelian.sub_barang_id',
                'sub_pembelian.harga',
                'sub_pembelian.qty',
                'sub_pembelian.total',
                'barangs.name as nama_barang',
                'sub_barangs.kode as kode_barang',
            ]);
            $this->db->join('barangs', 'barangs.id = sub_pembelian.barang_id', 'left');
            $this->db->join('sub_barangs', 'sub_barangs.id = sub_pembelian.sub_barang_id', 'left');
            $this->db->where('sub_pembelian.pembelian_id', $key->id);
            $this->db->where('sub_pembelian.deleted_at', null);
            $exec_sub = $this->db->get('sub_pembelian');

            $itt_sub = 0;
            foreach ($exec_sub->result() as $key_sub) {
                $data['sub'][$itt_sub]['id']            = $key_sub->id;
                $data['sub'][$itt_sub]['pembelian_id']  = $key_sub->pembelian_id;
                $data['sub'][$itt_sub]['barang_id']     = $key_sub->barang_id;
                $data['sub'][$itt_sub]['sub_barang_id'] = $key_sub->sub_barang_id;
                $data['sub'][$itt_sub]['sub_barang_id'] = $key_sub->sub_barang_id;
                $data['sub'][$itt_sub]['harga']         = number_format($key_sub->harga, 0);
                $data['sub'][$itt_sub]['qty']           = number_format($key_sub->qty, 0);
                $data['sub'][$itt_sub]['total']         = number_format($key_sub->total, 0);
                $data['sub'][$itt_sub]['nama_barang']   = $key_sub->nama_barang;
                $data['sub'][$itt_sub]['kode_barang']   = $key_sub->kode_barang;

                $itt_sub++;
            }
        }
        return $data;
    }

    public function get_barang_list($supplier_id)
    {
        $data = array();

        $sql = "
        SELECT
            barangs.*,
            sub_barangs.supplier_id 
        FROM
            barangs
            LEFT JOIN sub_barangs ON sub_barangs.barang_id = barangs.id 
        WHERE
            barangs.deleted_at IS NULL 
        GROUP BY
            barangs.id 
        HAVING
            sub_barangs.supplier_id = $supplier_id
        ";
        $exec_barang = $this->db->query($sql);

        foreach ($exec_barang->result() as $a) {
            $nested['id']   = $a->id;
            $nested['name'] = $a->name;

            array_push($data, $nested);
        }

        return $data;
    }

    public function get_kode_list($barang_id)
    {
        $data = array();

        $this->db->where('deleted_at', null);
        $this->db->where('barang_id', $barang_id);
        $exec_sub = $this->db->get('sub_barangs');

        foreach ($exec_sub->result() as $b) {
            $nested_sub['id']    = $b->id;
            $nested_sub['kode']  = $b->kode;
            $nested_sub['harga'] = intval($b->harga);

            array_push($data, $nested_sub);
        }

        return $data;
    }

    public function store($data)
    {
        $this->db->insert('pembelian', $data);
        $last_id = $this->db->insert_id();

        $data_sub = [
            'pembelian_id'  => $last_id,
            'temp_by'    => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['temp_by' => $this->session->userdata(SESS_ADM . 'id')];
        $exec = $this->db->update('sub_pembelian', $data_sub, $where);
        return $exec;
    }

    public function update($data, $where)
    {
        return $this->db->update('pembelian', $data, $where);
    }

    public function destroy($data, $where, $where_sub)
    {
        $this->db->update('pembelian', $data, $where);
        return $this->db->update('sub_pembelian', $data, $where_sub);
    }

    public function store_barang($data)
    {
        return $this->db->insert('sub_pembelian', $data);
    }

    public function get_barang_temp($admin_id)
    {
        $this->db->select([
            'sub_pembelian.id',
            'sub_pembelian.pembelian_id',
            'sub_pembelian.barang_id',
            'sub_pembelian.sub_barang_id',
            'sub_pembelian.harga',
            'sub_pembelian.qty',
            'sub_pembelian.total',
            'barangs.name as nama_barang',
            'sub_barangs.kode as kode_barang',
        ]);
        $this->db->join('barangs', 'barangs.id = sub_pembelian.barang_id', 'left');
        $this->db->join('sub_barangs', 'sub_barangs.id = sub_pembelian.sub_barang_id', 'left');
        $this->db->where('sub_pembelian.deleted_at', null);
        $this->db->where('sub_pembelian.temp_by', $admin_id);
        $exec = $this->db->get('sub_pembelian');

        if (!$exec) {
            return [];
        } else {
            $data = [];
            foreach ($exec->result() as $key) {
                $nested['id']            = $key->id;
                $nested['barang_id']     = $key->barang_id;
                $nested['sub_barang_id'] = $key->sub_barang_id;
                $nested['nama_barang']   = $key->nama_barang;
                $nested['kode_barang']   = $key->kode_barang;
                $nested['harga']         = "Rp." . number_format($key->harga, 0);
                $nested['xharga']        = $key->harga;
                $nested['qty']           = number_format($key->qty, 0);
                $nested['xqty']          = $key->qty;
                $nested['total']         = "Rp." . number_format($key->total, 0);
                $nested['xtotal']        = $key->total;

                array_push($data, $nested);
            }
        }
        return $data;
    }

    public function clear_temp_barang($admin_id)
    {
        $this->db->where('temp_by', $admin_id);
        $this->db->delete('sub_pembelian');
    }

    public function destroy_barang($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('sub_pembelian');
    }

    public function get_barang($id)
    {
        $this->db->select([
            'sub_pembelian.id',
            'sub_pembelian.pembelian_id',
            'sub_pembelian.barang_id',
            'sub_pembelian.sub_barang_id',
            'sub_pembelian.harga',
            'sub_pembelian.qty',
            'sub_pembelian.total',
            'barangs.name as nama_barang',
            'sub_barangs.kode as kode_barang',
        ]);
        $this->db->join('barangs', 'barangs.id = sub_pembelian.barang_id', 'left');
        $this->db->join('sub_barangs', 'sub_barangs.id = sub_pembelian.sub_barang_id', 'left');
        $this->db->where('sub_pembelian.deleted_at', null);
        $this->db->where('sub_pembelian.temp_by', null);
        $this->db->where('sub_pembelian.pembelian_id', $id);
        $exec = $this->db->get('sub_pembelian');

        if (!$exec) {
            return [];
        } else {
            $data = [];
            foreach ($exec->result() as $key) {
                $nested['id']          = $key->id;
                $nested['nama_barang'] = $key->nama_barang;
                $nested['kode_barang'] = $key->kode_barang;
                $nested['harga']       = "Rp." . number_format($key->harga, 0);
                $nested['qty']         = number_format($key->qty, 0);
                $nested['total']       = "Rp." . number_format($key->total, 0);

                array_push($data, $nested);
            }
        }
        return $data;
    }

    public function update_sub($data, $where)
    {
        $this->db->update('sub_pembelian', $data, $where);
    }

    public function update_stock_sub($sub_barang_id, $xqty)
    {
        $this->db->set('stock', 'stock + ' . $xqty, false);
        $this->db->set('updated_by', $this->session->userdata(SESS_ADM . 'id'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $sub_barang_id);
        $this->db->update('sub_barangs');
    }

    public function update_stock_total($barang_id, $xqty)
    {
        $this->db->set('stock', 'stock + ' . $xqty, false);
        $this->db->set('updated_by', $this->session->userdata(SESS_ADM . 'id'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $barang_id);
        $this->db->update('barangs');
    }
}
                        
/* End of file Pembelian_model.php */
