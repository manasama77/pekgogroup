<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Produk_model');
        $this->load->model('Warna_model');
        $this->load->model('Ukuran_model');
        $this->load->model('Request_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $list = $this->Produk_model->get_all_data();

        $data = array(
            'title'   => 'Produk',
            'page'    => 'produk/main',
            'vitamin' => 'produk/main_vitamin',
            'list'    => $list,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $this->form_validation->set_rules('code', 'KODE PRODUK', 'required|is_unique[produks.code]');
        $this->form_validation->set_rules('name', 'NAMA PRODUK', 'required');
        $this->form_validation->set_rules('color_id[]', 'WARNA', 'required');
        $this->form_validation->set_rules('size_id[]', 'UKURAN', 'required');
        $this->form_validation->set_rules('request_id[]', 'REQUEST', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );

            $colors   = $this->Warna_model->get_all_data();
            $sizes    = $this->Ukuran_model->get_all_data();
            $requests = $this->Request_model->get_all_data();

            $data = array(
                'title'    => 'Produk',
                'page'     => 'produk/form',
                'vitamin'  => 'produk/form_vitamin',
                'colors'   => $colors,
                'sizes'    => $sizes,
                'requests' => $requests,
                'csrf'     => $csrf,
                'error'    => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $whatsapp = $this->input->post('whatsapp');
        $password = PASSWORD_HASH($this->input->post('password') . HASH_SLING_SLICER, PASSWORD_BCRYPT);
        $name     = $this->input->post('name');
        $role     = $this->input->post('role');

        $data = array(
            'whatsapp'   => $whatsapp,
            'password'   => $password,
            'name'       => $name,
            'role'       => $role,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
            'updated_by' => $this->session->userdata('id'),
        );
        $exec = $this->Produk_model->store($data);

        if (!$exec) {
            echo "Tambah Produk gagal, silahkan coba kembali!";
        }

        $this->session->set_flashdata('success', 'Tambah Produk Berhasil');
        session_write_close();
        redirect(base_url() . 'produk/index', 'location');
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('whatsapp', 'WHATSAPP', 'required');
        $this->form_validation->set_rules('name', 'NAMA', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list = $this->Produk_model->get_single_data('id', $id);
            $data = array(
                'title' => 'Produk Edit',
                'page'  => 'produk/form_edit',
                'csrf'  => $csrf,
                'list'  => $list,
                'error' => null,
            );
            $this->theme->render($data);
        } else {
            $this->update($id);
        }
    }

    protected function update($id)
    {
        $data  = array(
            'name'         => $this->input->post('name'),
            'id_tokped'    => $this->input->post('id_tokped'),
            'id_shopee'    => $this->input->post('id_shopee'),
            'id_instagram' => $this->input->post('id_instagram'),
            'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'   => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Produk_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Edit Produk Gagal');
            session_write_close();
            redirect(base_url() . 'produk/index', 'location');
        }

        $this->session->set_flashdata('success', 'Edit Produk Berhasil');
        session_write_close();
        redirect(base_url() . 'produk/index', 'location');
    }

    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Produk_model->destroy($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function status($status, $id)
    {
        $new_status = ($status == 'aktifkan') ? 'aktif' : 'tidak aktif';
        $data  = array(
            'status'     => $new_status,
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id'),
        );
        $where = array('produks.id' => $id);
        $exec  = $this->Produk_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Update status produk Gagal');
            session_write_close();
            redirect($_SERVER['HTTP_REFERER'], 'location');
        }

        $this->session->set_flashdata('success', 'Update status produk Berhasil');
        session_write_close();
        redirect($_SERVER['HTTP_REFERER'], 'location');
    }

    public function blokir()
    {
        $id              = $this->input->post('id');
        $reason_inactive = trim($this->input->post('reason_inactive'));

        $data = array(
            'status'          => 'tidak aktif',
            'reason_inactive' => $reason_inactive,
            'updated_at'      => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'      => $this->session->userdata('id'),
        );

        $where = array('id' => $id);
        $exec  = $this->Produk_model->update($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }
}
        
    /* End of file  Produk.php */
