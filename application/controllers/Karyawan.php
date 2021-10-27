<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Karyawan_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'NAMA KARYAWAN', 'required');
        $this->form_validation->set_rules('role', 'ROLE', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list = $this->Karyawan_model->get_all_data();
            $data = array(
                'title' => 'Karyawan',
                'page'  => 'karyawan/main',
                'csrf'  => $csrf,
                'list'  => $list,
                'error' => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $config['upload_path']   = './assets/img/karyawan/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_photo')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            session_write_close();
            redirect(base_url() . 'setup/karyawan', 'location');
        } else {
            $image_data = $this->upload->data();
            $path_photo = $image_data['file_name'];

            $name = $this->input->post('name');
            $role = $this->input->post('role');

            $data = array(
                'name'       => $name,
                'role'       => $role,
                'path_photo' => $path_photo,
                'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id'),
                'updated_by' => $this->session->userdata('id'),
            );
            $exec = $this->Karyawan_model->store($data);

            if (!$exec) {
                echo "Proses Upload Gambar Gagal, silahkan coba kembali!";
            }

            $this->session->set_flashdata('success', 'Tambah Karyawan Berhasil');
            session_write_close();
            redirect(base_url() . 'setup/karyawan', 'location');
        }
    }
}
        
    /* End of file  Karyawan.php */
