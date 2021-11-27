<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Pembelian_model');
        $this->load->model('Inventory_model');
        $this->load->model('Supplier_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $data = $this->Pembelian_model->get_all_data();

        $data = array(
            'title'   => 'PEMBELIAN',
            'page'    => 'pembelian/main',
            'vitamin' => 'pembelian/main_vitamin',
            'data'    => $data,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $admin_id   = $this->session->userdata(SESS_ADM . 'id');
        $this->Pembelian_model->clear_temp_barang($admin_id);

        $suppliers = $this->Supplier_model->get_all_data();

        $data = array(
            'title'     => 'PEMBELIAN',
            'page'      => 'pembelian/form',
            'vitamin'   => 'pembelian/form_vitamin',
            'suppliers' => $suppliers,
            'error'     => null,
        );
        $this->theme->render($data);
    }

    public function get_barang_list()
    {
        $code        = 500;
        $supplier_id = $this->input->get('supplier_id');
        $data        = $this->Pembelian_model->get_barang_list($supplier_id);

        if ($data) {
            $code = 200;
        }

        $return = [
            'code' => $code,
            'data' => $data,
        ];

        echo json_encode($return);
    }

    public function get_kode_list()
    {
        $code        = 500;
        $barang_id = $this->input->get('barang_id');
        $data        = $this->Pembelian_model->get_kode_list($barang_id);

        if ($data) {
            $code = 200;
        }

        $return = [
            'code' => $code,
            'data' => $data,
        ];

        echo json_encode($return);
    }

    public function store()
    {
        $code              = 200;
        $tanggal_pembelian = $this->input->post('tanggal_pembelian');
        $supplier_id       = $this->input->post('supplier_id');
        $no_invoice        = $this->input->post('no_invoice');

        $admin_id = $this->session->userdata(SESS_ADM . 'id');
        $data     = $this->Pembelian_model->get_barang_temp($admin_id);

        if (count($data) == 0) {
            $code = 404;
        } else {
            $total = 0;

            for ($i = 0; $i < count($data); $i++) {
                $barang_id     = $data[$i]['barang_id'];
                $sub_barang_id = $data[$i]['sub_barang_id'];
                $xqty          = $data[$i]['xqty'];
                $this->Pembelian_model->update_stock_sub($sub_barang_id, $xqty);
                $this->Pembelian_model->update_stock_total($barang_id, $xqty);

                $xtotal  = intval($data[$i]['xtotal']);
                $total  += $xtotal;
            }

            $data = array(
                'tanggal_pembelian' => $tanggal_pembelian,
                'supplier_id'       => $supplier_id,
                'no_invoice'        => $no_invoice,
                'total'             => $total,
                'created_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'created_by'        => $this->session->userdata(SESS_ADM . 'id'),
                'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
            );
            $exec = $this->Pembelian_model->store($data);
            $last_id = $this->db->insert_id();

            if (!$exec) {
                $code = 500;
            }

            $data_sub = [
                'pembelian_id' => $last_id,
                'created_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
                'created_by'   => $this->session->userdata(SESS_ADM . 'id'),
                'updated_by'   => $this->session->userdata(SESS_ADM . 'id'),
            ];
            $where_sub = ['temp_by' => $this->session->userdata(SESS_ADM . 'id')];
            $this->Pembelian_model->update_sub($data_sub, $where_sub);
        }

        echo json_encode(['code' => $code]);
    }

    public function store_barang()
    {
        $code          = 500;
        $barang_id     = $this->input->post('barang_id');
        $sub_barang_id = $this->input->post('sub_barang_id');
        $harga         = $this->input->post('harga');
        $qty           = $this->input->post('qty');
        $total         = $harga * $qty;

        $data = [
            'pembelian_id'  => null,
            'barang_id'     => $barang_id,
            'sub_barang_id' => $sub_barang_id,
            'harga'         => $harga,
            'qty'           => $qty,
            'total'         => $total,
            'temp_by'       => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $exec = $this->Pembelian_model->store_barang($data);

        if ($exec) {
            $code = 200;
        }

        $return = ['code' => $code];

        echo json_encode($return);
    }

    public function get_barang_temp()
    {
        $code     = 200;
        $admin_id = $this->session->userdata(SESS_ADM . 'id');

        $data = $this->Pembelian_model->get_barang_temp($admin_id);

        $return = [
            'code' => $code,
            'data' => $data,
        ];

        echo json_encode($return);
    }

    public function destroy_barang()
    {
        $code = 500;
        $id   = $this->input->post('id');
        $exec = $this->Pembelian_model->destroy_barang($id);

        if ($exec) {
            $code = 200;
        }

        $return = ['code' => $code];

        echo json_encode($return);
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

    public function detail()
    {
        $id   = $this->input->get('id');
        $data = $this->Pembelian_model->get_single_data($id);
        echo json_encode(['code' => 200, 'data' => $data]);
    }
}
        
    /* End of file  Inventory.php */
