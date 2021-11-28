<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengurangan_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'pengurangan.id',
            'pengurangan.tanggal',
            'pengurangan.untuk',
            'pengurangan.keterangan',
            'pengurangan.kategori_id',
            'pengurangan.barang_id',
            'pengurangan.sub_barang_id',
            'pengurangan.qty',
            'categories.name as nama_kategori',
            'barangs.name as nama_barang',
            'sub_barangs.kode as kode_barang',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('pengurangan');
        $this->db->join('categories', 'categories.id = pengurangan.kategori_id', 'left');
        $this->db->join('barangs', 'barangs.id = pengurangan.barang_id', 'left');
        $this->db->join('sub_barangs', 'sub_barangs.id = pengurangan.sub_barang_id', 'left');
        $this->db->where('pengurangan.deleted_at', null);
        $this->db->order_by('pengurangan.created_at', 'asc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($id)
    {
        $data = [];

        $this->db->select($this->select);
        $this->db->from('pengurangan');
        $this->db->join('supplier', 'supplier.id = pengurangan.supplier_id', 'left');
        $this->db->where('pengurangan.id', $id);
        $this->db->where('pengurangan.deleted_at', null);
        $this->db->order_by('pengurangan.created_at', 'asc');
        $exec = $this->db->get();

        foreach ($exec->result() as $key) {
            $data['id']                = $key->id;
            $data['tanggal_pengurangan'] = $key->tanggal_pengurangan;
            $data['supplier_id']       = $key->supplier_id;
            $data['no_invoice']        = $key->no_invoice;
            $data['total']             = number_format($key->total, 0);
            $data['nama_supplier']     = $key->nama_supplier;

            $this->db->select([
                'sub_pengurangan.id',
                'sub_pengurangan.pengurangan_id',
                'sub_pengurangan.barang_id',
                'sub_pengurangan.sub_barang_id',
                'sub_pengurangan.harga',
                'sub_pengurangan.qty',
                'sub_pengurangan.total',
                'barangs.name as nama_barang',
                'sub_barangs.kode as kode_barang',
            ]);
            $this->db->join('barangs', 'barangs.id = sub_pengurangan.barang_id', 'left');
            $this->db->join('sub_barangs', 'sub_barangs.id = sub_pengurangan.sub_barang_id', 'left');
            $this->db->where('sub_pengurangan.pengurangan_id', $key->id);
            $this->db->where('sub_pengurangan.deleted_at', null);
            $exec_sub = $this->db->get('sub_pengurangan');

            $itt_sub = 0;
            foreach ($exec_sub->result() as $key_sub) {
                $data['sub'][$itt_sub]['id']            = $key_sub->id;
                $data['sub'][$itt_sub]['pengurangan_id']  = $key_sub->pengurangan_id;
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

    public function get_barang_list($kategori_id)
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
        $this->db->where('barangs.kategori_id', $kategori_id);
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

    public function store($data, $barang_id, $sub_barang_id, $qty)
    {
        $this->db->insert('pengurangan', $data);

        $this->db->set('stock', 'stock - ' . $qty, false);
        $this->db->set('updated_by', $this->session->userdata(SESS_ADM . 'id'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $sub_barang_id);
        $this->db->update('sub_barangs');

        $this->db->set('stock', 'stock - ' . $qty, false);
        $this->db->set('updated_by', $this->session->userdata(SESS_ADM . 'id'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $barang_id);
        $this->db->update('barangs');
    }

    public function destroy($data, $where, $id)
    {
        $this->db->where('id', $id);
        $exec = $this->db->get('pengurangan');

        $barang_id     = $exec->row()->barang_id;
        $sub_barang_id = $exec->row()->sub_barang_id;
        $qty           = $exec->row()->qty;

        $this->db->set('stock', 'stock + ' . $qty, false);
        $this->db->set('updated_by', $this->session->userdata(SESS_ADM . 'id'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $sub_barang_id);
        $this->db->update('sub_barangs');

        $this->db->set('stock', 'stock + ' . $qty, false);
        $this->db->set('updated_by', $this->session->userdata(SESS_ADM . 'id'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $barang_id);
        $this->db->update('barangs');

        return $this->db->update('pengurangan', $data, $where);
    }
}
                        
/* End of file Pengurangan_model.php */
