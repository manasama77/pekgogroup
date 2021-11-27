<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'barangs.id',
            'barangs.kategori_id',
            'barangs.name',
            'barangs.merk_id',
            'barangs.color_id',
            'barangs.unit_id',
            'barangs.stock',
            'categories.name as nama_kategori',
            'merks.name as nama_merk',
            'colors.name as nama_warna',
            'units.name as nama_satuan',
        );
    }

    public function get_all_data()
    {
        $data = [];

        $this->db->select($this->select);
        $this->db->from('barangs');
        $this->db->join('categories', 'categories.id = barangs.kategori_id', 'left');
        $this->db->join('merks', 'merks.id = barangs.merk_id', 'left');
        $this->db->join('colors', 'colors.id = barangs.color_id', 'left');
        $this->db->join('units', 'units.id = barangs.unit_id', 'left');
        $this->db->where('barangs.deleted_at', null);
        $this->db->order_by('barangs.name', 'asc');
        $exec = $this->db->get();

        $itt = 0;
        foreach ($exec->result() as $key) {
            $data[$itt]['id']            = $key->id;
            $data[$itt]['kategori_id']   = $key->kategori_id;
            $data[$itt]['name']          = $key->name;
            $data[$itt]['merk_id']       = $key->merk_id;
            $data[$itt]['color_id']      = $key->color_id;
            $data[$itt]['unit_id']       = $key->unit_id;
            $data[$itt]['stock']         = number_format($key->stock, 0);
            $data[$itt]['nama_kategori'] = $key->nama_kategori;
            $data[$itt]['nama_merk']     = $key->nama_merk;
            $data[$itt]['nama_warna']    = $key->nama_warna;
            $data[$itt]['nama_satuan']   = $key->nama_satuan;

            $this->db->select([
                'sub_barangs.id',
                'sub_barangs.barang_id',
                'sub_barangs.supplier_id',
                'sub_barangs.kode',
                'sub_barangs.harga',
                'sub_barangs.stock',
                'supplier.name as nama_supplier',
            ]);
            $this->db->join('supplier', 'supplier.id = sub_barangs.supplier_id', 'left');
            $this->db->where('sub_barangs.barang_id', $key->id);
            $this->db->where('sub_barangs.deleted_at', null);
            $exec_sub = $this->db->get('sub_barangs');

            $itt_sub = 0;
            foreach ($exec_sub->result() as $key_sub) {
                $data[$itt]['sub'][$itt_sub]['id']            = $key_sub->id;
                $data[$itt]['sub'][$itt_sub]['barang_id']     = $key_sub->barang_id;
                $data[$itt]['sub'][$itt_sub]['supplier_id']   = $key_sub->supplier_id;
                $data[$itt]['sub'][$itt_sub]['kode']          = $key_sub->kode;
                $data[$itt]['sub'][$itt_sub]['harga']         = number_format($key_sub->harga, 0);
                $data[$itt]['sub'][$itt_sub]['stock']         = number_format($key_sub->stock, 0);
                $data[$itt]['sub'][$itt_sub]['nama_supplier'] = $key_sub->nama_supplier;

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
        $this->db->from('barangs');
        $this->db->join('categories', 'categories.id = barangs.kategori_id', 'left');
        $this->db->join('merks', 'merks.id = barangs.merk_id', 'left');
        $this->db->join('colors', 'colors.id = barangs.color_id', 'left');
        $this->db->join('units', 'units.id = barangs.unit_id', 'left');
        $this->db->where('barangs.id', $id);
        $this->db->where('barangs.deleted_at', null);
        $this->db->order_by('barangs.name', 'asc');
        $exec = $this->db->get();

        foreach ($exec->result() as $key) {
            $data['id']            = $key->id;
            $data['kategori_id']   = $key->kategori_id;
            $data['name']          = $key->name;
            $data['merk_id']       = $key->merk_id;
            $data['color_id']      = $key->color_id;
            $data['unit_id']       = $key->unit_id;
            $data['stock']         = number_format($key->stock, 0);
            $data['nama_kategori'] = $key->nama_kategori;
            $data['nama_merk']     = $key->nama_merk;
            $data['nama_warna']    = $key->nama_warna;
            $data['nama_satuan']   = $key->nama_satuan;

            $this->db->select([
                'sub_barangs.id',
                'sub_barangs.barang_id',
                'sub_barangs.supplier_id',
                'sub_barangs.kode',
                'sub_barangs.harga',
                'sub_barangs.stock',
                'supplier.name as nama_supplier',
            ]);
            $this->db->join('supplier', 'supplier.id = sub_barangs.supplier_id', 'left');
            $this->db->where('sub_barangs.barang_id', $key->id);
            $this->db->where('sub_barangs.deleted_at', null);
            $exec_sub = $this->db->get('sub_barangs');

            $itt_sub = 0;
            foreach ($exec_sub->result() as $key_sub) {
                $data['sub'][$itt_sub]['id']            = $key_sub->id;
                $data['sub'][$itt_sub]['barang_id']     = $key_sub->barang_id;
                $data['sub'][$itt_sub]['supplier_id']   = $key_sub->supplier_id;
                $data['sub'][$itt_sub]['kode']          = $key_sub->kode;
                $data['sub'][$itt_sub]['harga']         = number_format($key_sub->harga, 0);
                $data['sub'][$itt_sub]['stock']         = number_format($key_sub->stock, 0);
                $data['sub'][$itt_sub]['nama_supplier'] = $key_sub->nama_supplier;

                $itt_sub++;
            }
        }
        return $data;
    }


    public function store($data)
    {
        $this->db->insert('barangs', $data);
        $last_id = $this->db->insert_id();

        $data_sub = [
            'barang_id'  => $last_id,
            'temp_by'    => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['temp_by' => $this->session->userdata(SESS_ADM . 'id')];
        $exec = $this->db->update('sub_barangs', $data_sub, $where);
        return $exec;
    }

    public function update($data, $where)
    {
        return $this->db->update('barangs', $data, $where);
    }

    public function destroy($data, $where, $where_sub)
    {
        $this->db->update('barangs', $data, $where);
        return $this->db->update('sub_barangs', $data, $where_sub);
    }

    public function store_supplier($data)
    {
        return $this->db->insert('sub_barangs', $data);
    }

    public function get_supplier_temp($admin_id)
    {
        $this->db->select([
            'sub_barangs.id',
            'supplier.name as nama_supplier',
            'sub_barangs.kode',
            'sub_barangs.harga',
        ]);
        $this->db->join('supplier', 'supplier.id = sub_barangs.supplier_id', 'left');
        $this->db->where('sub_barangs.deleted_at', null);
        $this->db->where('sub_barangs.temp_by', $admin_id);
        $exec = $this->db->get('sub_barangs');

        if (!$exec) {
            return [];
        } else {
            $data = [];
            foreach ($exec->result() as $key) {
                $nested['id']            = $key->id;
                $nested['nama_supplier'] = $key->nama_supplier;
                $nested['kode']          = $key->kode;
                $nested['harga']         = "Rp." . number_format($key->harga, 0);

                array_push($data, $nested);
            }
        }
        return $data;
    }

    public function clear_temp_supplier($admin_id)
    {
        $this->db->where('temp_by', $admin_id);
        $this->db->delete('sub_barangs');
    }

    public function destroy_supplier($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('sub_barangs');
    }

    public function get_supplier($id)
    {
        $this->db->select([
            'sub_barangs.id',
            'supplier.name as nama_supplier',
            'sub_barangs.kode',
            'sub_barangs.harga',
        ]);
        $this->db->join('supplier', 'supplier.id = sub_barangs.supplier_id', 'left');
        $this->db->where('sub_barangs.deleted_at', null);
        $this->db->where('sub_barangs.temp_by', null);
        $this->db->where('sub_barangs.barang_id', $id);
        $exec = $this->db->get('sub_barangs');

        if (!$exec) {
            return [];
        } else {
            $data = [];
            foreach ($exec->result() as $key) {
                $nested['id']            = $key->id;
                $nested['nama_supplier'] = $key->nama_supplier;
                $nested['kode']          = $key->kode;
                $nested['harga']         = "Rp." . number_format($key->harga, 0);

                array_push($data, $nested);
            }
        }
        return $data;
    }
}
                        
/* End of file Inventory_model.php */
