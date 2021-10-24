<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Project_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'NAMA PROJECT', 'required');
        $this->form_validation->set_rules('abbr', 'SINGKATAN', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list = $this->Project_model->get_all_data();
            $data = array(
                'title' => 'Project',
                'page'  => 'project/main',
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
        $config['upload_path']   = './assets/img/projects/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 512;
        $config['max_height']    = 512;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_logo')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            session_write_close();
            redirect(base_url() . 'setup/project', 'refresh');
        } else {
            $image_data = $this->upload->data();
            $path_logo = $image_data['file_name'];

            $name = $this->input->post('name');
            $abbr = $this->input->post('abbr');

            $data = array(
                'name'       => $name,
                'abbr'       => $abbr,
                'path_logo'  => $path_logo,
                'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id'),
                'updated_by' => $this->session->userdata('id'),
            );
            $exec = $this->Project_model->store($data);

            if (!$exec) {
                echo "Proses Upload Gambar Gagal, silahkan coba kembali!";
            }

            $this->session->set_flashdata('success', 'Tambah Project Berhasil');
            session_write_close();
            redirect(base_url() . 'setup/project', 'refresh');
        }
    }
}
        
    /* End of file  Project.php */
