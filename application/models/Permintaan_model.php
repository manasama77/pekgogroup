<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'permintaan.id',
            'permintaan.tanggal',
            'permintaan.nama',
            'permintaan.request_item',
            'permintaan.untuk',
            'permintaan.barang_id',
            'permintaan.sub_barang_id',
            'permintaan.qty',
            'permintaan.status_permintaan',
            'barangs.name as nama_barang',
            'merks.name as nama_merk',
            'colors.name as nama_warna',
            'units.name as nama_satuan',
            'sub_barangs.kode as kode_barang',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('permintaan');
        $this->db->join('barangs', 'barangs.id = permintaan.barang_id', 'left');
        $this->db->join('merks', 'merks.id = barangs.merk_id', 'left');
        $this->db->join('colors', 'colors.id = barangs.color_id', 'left');
        $this->db->join('units', 'units.id = barangs.unit_id', 'left');
        $this->db->join('sub_barangs', 'sub_barangs.id = permintaan.sub_barang_id', 'left');
        $this->db->where('permintaan.deleted_at', null);
        $this->db->order_by('permintaan.created_at', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($id)
    {
        $data = [];

        $this->db->select($this->select);
        $this->db->from('permintaan');
        $this->db->join('supplier', 'supplier.id = permintaan.supplier_id', 'left');
        $this->db->where('permintaan.id', $id);
        $this->db->where('permintaan.deleted_at', null);
        $this->db->order_by('permintaan.created_at', 'asc');
        $exec = $this->db->get();

        foreach ($exec->result() as $key) {
            $data['id']                = $key->id;
            $data['tanggal_permintaan'] = $key->tanggal_permintaan;
            $data['supplier_id']       = $key->supplier_id;
            $data['no_invoice']        = $key->no_invoice;
            $data['total']             = number_format($key->total, 0);
            $data['nama_supplier']     = $key->nama_supplier;

            $this->db->select([
                'sub_permintaan.id',
                'sub_permintaan.permintaan_id',
                'sub_permintaan.barang_id',
                'sub_permintaan.sub_barang_id',
                'sub_permintaan.harga',
                'sub_permintaan.qty',
                'sub_permintaan.total',
                'barangs.name as nama_barang',
                'sub_barangs.kode as kode_barang',
            ]);
            $this->db->join('barangs', 'barangs.id = sub_permintaan.barang_id', 'left');
            $this->db->join('sub_barangs', 'sub_barangs.id = sub_permintaan.sub_barang_id', 'left');
            $this->db->where('sub_permintaan.permintaan_id', $key->id);
            $this->db->where('sub_permintaan.deleted_at', null);
            $exec_sub = $this->db->get('sub_permintaan');

            $itt_sub = 0;
            foreach ($exec_sub->result() as $key_sub) {
                $data['sub'][$itt_sub]['id']            = $key_sub->id;
                $data['sub'][$itt_sub]['permintaan_id']  = $key_sub->permintaan_id;
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

    public function get_barang_list()
    {
        $this->db->select([
            'barangs.id',
            'barangs.name',
            'merks.name as nama_merk',
            'colors.name as nama_warna',
            'units.name as nama_satuan',
        ]);
        $this->db->join('merks', 'merks.id = barangs.merk_id', 'left');
        $this->db->join('colors', 'colors.id = barangs.color_id', 'left');
        $this->db->join('units', 'units.id = barangs.unit_id', 'left');
        $this->db->where('barangs.deleted_at', null);
        return $this->db->get('barangs');
    }

    public function get_kode_list($barang_id)
    {
        $this->db->where('deleted_at', null);
        $this->db->where('barang_id', $barang_id);
        $exec = $this->db->get('sub_barangs');
        return $exec;
    }

    public function store($data)
    {
        return $this->db->insert('permintaan', $data);
    }

    public function pending_to_order($id)
    {
        $data = [
            'status_permintaan' => 'order',
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
            'updated_at'        => date('Y-m-d'),
        ];
        $where = ['id' => $id];
        return $this->db->update('permintaan', $data, $where);
    }

    public function order_to_selesai($id)
    {
        $data = [
            'status_permintaan' => 'selesai',
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
            'updated_at'        => date('Y-m-d'),
        ];
        $where = ['id' => $id];
        return $this->db->update('permintaan', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('permintaan', $data, $where);
    }
}
                        
/* End of file Permintaan_model.php */
