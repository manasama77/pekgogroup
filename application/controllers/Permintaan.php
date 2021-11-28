<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Permintaan_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $list = $this->Permintaan_model->get_all_data();

        $data = array(
            'title'   => 'PERMINTAAN',
            'page'    => 'permintaan/main',
            'vitamin' => 'permintaan/main_vitamin',
            'list'    => $list,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $barangs = $this->Permintaan_model->get_barang_list();

        $data = array(
            'title'   => 'PERMINTAAN',
            'page'    => 'permintaan/form',
            'vitamin' => 'permintaan/form_vitamin',
            'barangs' => $barangs,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function get_kode_list()
    {
        $code      = 500;
        $barang_id = $this->input->get('barang_id');
        $data      = $this->Permintaan_model->get_kode_list($barang_id);

        if ($data) {
            $code = 200;
        }

        $return = [
            'code' => $code,
            'data' => $data->result(),
        ];

        echo json_encode($return);
    }

    public function store()
    {
        $tanggal           = $this->input->post('tanggal');
        $nama              = $this->input->post('nama');
        $request_item      = $this->input->post('request_item');
        $untuk             = $this->input->post('untuk');
        $barang_id         = $this->input->post('barang_id');
        $sub_barang_id     = $this->input->post('sub_barang_id');
        $qty               = $this->input->post('qty');
        $status_permintaan = 'pending';

        $data = [
            'tanggal'           => $tanggal,
            'nama'              => $nama,
            'request_item'      => $request_item,
            'untuk'             => $untuk,
            'barang_id'         => $barang_id,
            'sub_barang_id'     => $sub_barang_id,
            'qty'               => $qty,
            'status_permintaan' => $status_permintaan,
            'created_by'        => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
            'created_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
        ];
        $exec = $this->Permintaan_model->store($data);

        if ($exec) {
            $this->session->set_flashdata('success', 'Permintaan Berhasil');
        } else {
            $this->session->set_flashdata('error', 'Permintaan Gagal');
        }

        redirect(base_url('permintaan/add'));
    }

    public function pending_to_order()
    {
        $id = $this->input->post('id');
        $exec = $this->Permintaan_model->pending_to_order($id);

        if ($exec) {
            $code = 200;
        } else {
            $code = 500;
        }

        echo json_encode(['code' => $code]);
    }

    public function order_to_selesai()
    {
        $id = $this->input->post('id');
        $exec = $this->Permintaan_model->order_to_selesai($id);

        if ($exec) {
            $code = 200;
        } else {
            $code = 500;
        }

        echo json_encode(['code' => $code]);
    }

    public function destroy($id)
    {
        $data = [
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        $exec  = $this->Permintaan_model->destroy($data, $where);
        $code  = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Permintaan.php */
