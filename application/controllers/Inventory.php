<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Inventory_model');
        $this->load->model('Kategori_model');
        $this->load->model('Merk_model');
        $this->load->model('Warna_model');
        $this->load->model('Satuan_model');
        $this->load->model('Supplier_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $data = $this->Inventory_model->get_all_data();

        $data = array(
            'title'   => 'INVENTORY',
            'page'    => 'inventory/main',
            'vitamin' => 'inventory/main_vitamin',
            'data'    => $data,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $admin_id   = $this->session->userdata(SESS_ADM . 'id');
        $this->Inventory_model->clear_temp_supplier($admin_id);

        $categories = $this->Kategori_model->get_all_data();
        $merks      = $this->Merk_model->get_all_data();
        $colors     = $this->Warna_model->get_all_data();
        $units      = $this->Satuan_model->get_all_data();
        $suppliers  = $this->Supplier_model->get_all_data();

        $data = array(
            'title'      => 'INVENTORY',
            'page'       => 'inventory/form',
            'vitamin'    => 'inventory/form_vitamin',
            'categories' => $categories,
            'merks'      => $merks,
            'colors'     => $colors,
            'units'      => $units,
            'suppliers'      => $suppliers,
            'error'      => null,
        );
        $this->theme->render($data);
    }

    public function store()
    {
        $code        = 200;
        $kategori_id = $this->input->post('kategori_id');
        $name        = $this->input->post('name');
        $merk_id     = $this->input->post('merk_id');
        $color_id    = $this->input->post('color_id');
        $unit_id     = $this->input->post('unit_id');

        $admin_id = $this->session->userdata(SESS_ADM . 'id');
        $data     = $this->Inventory_model->get_supplier_temp($admin_id);

        if (count($data) == 0) {
            $code = 404;
        } else {
            $data = array(
                'kategori_id' => $kategori_id,
                'name'        => $name,
                'merk_id'     => $merk_id,
                'color_id'    => $color_id,
                'unit_id'     => $unit_id,
                'stock'       => 0,
                'created_at'  => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_at'  => $this->cur_datetime->format('Y-m-d H:i:s'),
                'created_by'  => $this->session->userdata(SESS_ADM . 'id'),
                'updated_by'  => $this->session->userdata(SESS_ADM . 'id'),
            );
            $exec = $this->Inventory_model->store($data);

            if (!$exec) {
                $code = 500;
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function store_supplier()
    {
        $code        = 500;
        $supplier_id = $this->input->post('supplier_id');
        $kode        = $this->input->post('kode');
        $harga       = $this->input->post('harga');

        $data = [
            'barang_id'   => null,
            'supplier_id' => $supplier_id,
            'kode'        => $kode,
            'harga'       => $harga,
            'stock'       => 0,
            'temp_by'     => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $exec = $this->Inventory_model->store_supplier($data);

        if ($exec) {
            $code = 200;
        }

        $return = ['code' => $code];

        echo json_encode($return);
    }

    public function get_supplier_temp()
    {
        $code     = 200;
        $admin_id = $this->session->userdata(SESS_ADM . 'id');

        $data = $this->Inventory_model->get_supplier_temp($admin_id);

        $return = [
            'code' => $code,
            'data' => $data,
        ];

        echo json_encode($return);
    }

    public function destroy_supplier()
    {
        $code = 500;
        $id   = $this->input->post('id');
        $exec = $this->Inventory_model->destroy_supplier($id);

        if ($exec) {
            $code = 200;
        }

        $return = ['code' => $code];

        echo json_encode($return);
    }

    public function edit($id)
    {
        $categories = $this->Kategori_model->get_all_data();
        $merks      = $this->Merk_model->get_all_data();
        $colors     = $this->Warna_model->get_all_data();
        $units      = $this->Satuan_model->get_all_data();
        $suppliers  = $this->Supplier_model->get_all_data();

        $old_data = $this->Inventory_model->get_single_data($id);
        // echo '<pre>' . print_r($old_data, 1) . '</pre>';
        // exit;

        $data = array(
            'title'      => 'INVENTORY',
            'page'       => 'inventory/form_edit',
            'vitamin'    => 'inventory/form_edit_vitamin',
            'barang_id'  => $id,
            'old_data'   => $old_data,
            'categories' => $categories,
            'merks'      => $merks,
            'colors'     => $colors,
            'units'      => $units,
            'suppliers'  => $suppliers,
            'error'      => null,
        );
        $this->theme->render($data);
    }

    public function get_supplier($id)
    {
        $code     = 200;
        $data = $this->Inventory_model->get_supplier($id);

        $return = [
            'code' => $code,
            'data' => $data,
        ];

        echo json_encode($return);
    }

    public function store_supplier_fix()
    {
        $code        = 500;
        $barang_id   = $this->input->post('barang_id');
        $supplier_id = $this->input->post('supplier_id');
        $kode        = $this->input->post('kode');
        $harga       = $this->input->post('harga');

        $data = [
            'barang_id'   => $barang_id,
            'supplier_id' => $supplier_id,
            'kode'        => $kode,
            'harga'       => $harga,
            'stock'       => 0,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
            'created_by'  => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by'  => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $exec = $this->Inventory_model->store_supplier($data);

        if ($exec) {
            $code = 200;
        }

        $return = ['code' => $code];

        echo json_encode($return);
    }

    public function update()
    {
        $code        = 200;
        $barang_id   = $this->input->post('barang_id');
        $kategori_id = $this->input->post('kategori_id');
        $name        = $this->input->post('name');
        $merk_id     = $this->input->post('merk_id');
        $color_id    = $this->input->post('color_id');
        $unit_id     = $this->input->post('unit_id');

        $data     = $this->Inventory_model->get_supplier($barang_id);

        if (count($data) == 0) {
            $code = 404;
        } else {
            $data = array(
                'kategori_id' => $kategori_id,
                'name'        => $name,
                'merk_id'     => $merk_id,
                'color_id'    => $color_id,
                'unit_id'     => $unit_id,
                'updated_at'  => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'  => $this->session->userdata(SESS_ADM . 'id'),
            );
            $where = array('id' => $barang_id);
            $exec  = $this->Inventory_model->update($data, $where);

            if (!$exec) {
                $code = 500;
            }
        }

        echo json_encode(['code' => $code]);
    }

    public function destroy($id)
    {
        $data_barang = [
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where_barang     = ['id' => $id];
        $where_sub_barang = ['barang_id' => $id];
        $exec = $this->Inventory_model->destroy($data_barang, $where_barang, $where_sub_barang);
        $code = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Inventory.php */
