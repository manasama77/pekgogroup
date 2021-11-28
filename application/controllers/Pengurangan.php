<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengurangan extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Pengurangan_model');
        $this->load->model('Kategori_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $list = $this->Pengurangan_model->get_all_data();

        $data = array(
            'title'   => 'PENGURANGAN',
            'page'    => 'pengurangan/main',
            'vitamin' => 'pengurangan/main_vitamin',
            'list'    => $list,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $kategoris = $this->Kategori_model->get_all_data();

        $data = array(
            'title'     => 'PENGURANGAN',
            'page'      => 'pengurangan/form',
            'vitamin'   => 'pengurangan/form_vitamin',
            'kategoris' => $kategoris,
            'error'     => null,
        );
        $this->theme->render($data);
    }

    public function get_barang_list()
    {
        $code        = 500;
        $kategori_id = $this->input->get('kategori_id');
        $data        = $this->Pengurangan_model->get_barang_list($kategori_id);

        if ($data) {
            $code = 200;
        }

        $return = [
            'code' => $code,
            'data' => $data->result(),
        ];

        echo json_encode($return);
    }

    public function get_kode_list()
    {
        $code      = 500;
        $barang_id = $this->input->get('barang_id');
        $data      = $this->Pengurangan_model->get_kode_list($barang_id);

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
        $code          = 200;
        $tanggal       = $this->input->post('tanggal');
        $untuk         = $this->input->post('untuk');
        $keterangan    = $this->input->post('keterangan');
        $kategori_id   = $this->input->post('kategori_id');
        $barang_id     = $this->input->post('barang_id');
        $sub_barang_id = $this->input->post('sub_barang_id');
        $qty           = $this->input->post('qty');

        $data = [
            'tanggal'       => $tanggal,
            'untuk'         => $untuk,
            'keterangan'    => $keterangan,
            'kategori_id'   => $kategori_id,
            'barang_id'     => $barang_id,
            'sub_barang_id' => $sub_barang_id,
            'qty'           => $qty,
            'created_by'    => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by'    => $this->session->userdata(SESS_ADM . 'id'),
            'created_at'    => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at'    => $this->cur_datetime->format('Y-m-d H:i:s'),
        ];
        $this->Pengurangan_model->store($data, $barang_id, $sub_barang_id, $qty);

        $this->session->set_flashdata('success', 'Pengurangan Berhasil');
        redirect(base_url('pengurangan/add'));
    }

    public function destroy($id)
    {
        $data = [
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        $exec  = $this->Pengurangan_model->destroy($data, $where, $id);
        $code  = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Pengurangan.php */
