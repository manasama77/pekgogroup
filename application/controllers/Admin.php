<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Admin_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $list = $this->Admin_model->get_all_data();

        $data = array(
            'title'   => 'Admin',
            'page'    => 'admin/main',
            'vitamin' => 'admin/main_vitamin',
            'list'    => $list,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $this->form_validation->set_rules('whatsapp', 'NO WHATSAPP', 'required|is_unique[admins.whatsapp]');
        $this->form_validation->set_rules('password', 'PASSWORD', 'required');
        $this->form_validation->set_rules('password_verifikasi', 'PASSWORD VERIFIKASI', 'required|matches[password]');
        $this->form_validation->set_rules('name', 'NAMA', 'required');
        $this->form_validation->set_rules('role', 'ROLE', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data = array(
                'title'   => 'Admin',
                'page'    => 'admin/form',
                'vitamin' => 'admin/form_vitamin',
                'csrf'    => $csrf,
                'error'   => null,
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
        $exec = $this->Admin_model->store($data);

        if (!$exec) {
            echo "Tambah Admin gagal, silahkan coba kembali!";
        }

        $this->session->set_flashdata('success', 'Tambah Admin Berhasil');
        session_write_close();
        redirect(base_url() . 'admin/index', 'location');
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
            $list = $this->Admin_model->get_single_data('id', $id);
            $data = array(
                'title' => 'Admin Edit',
                'page'  => 'admin/form_edit',
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
        $exec  = $this->Admin_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Edit Admin Gagal');
            session_write_close();
            redirect(base_url() . 'admin/index', 'location');
        }

        $this->session->set_flashdata('success', 'Edit Admin Berhasil');
        session_write_close();
        redirect(base_url() . 'admin/index', 'location');
    }

    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Admin_model->destroy($data, $where);

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
        $where = array('admins.id' => $id);
        $exec  = $this->Admin_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Update status admin Gagal');
            session_write_close();
            redirect($_SERVER['HTTP_REFERER'], 'location');
        }

        $this->session->set_flashdata('success', 'Update status admin Berhasil');
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
        $exec  = $this->Admin_model->update($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }
}
        
    /* End of file  Admin.php */
