<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hpp extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Hpp_model');
        $this->load->model('Satuan_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'NAMA HPP', 'required');
        $this->form_validation->set_rules('cost', 'HPP', 'required|numeric');
        $this->form_validation->set_rules('unit_id', 'SATUAN', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list  = $this->Hpp_model->get_all_data();
            $units = $this->Satuan_model->get_all_data();
            $data = array(
                'title' => 'HPP',
                'page'  => 'hpp/main',
                'csrf'  => $csrf,
                'list'  => $list,
                'units' => $units,
                'error' => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $name    = $this->input->post('name');
        $cost    = $this->input->post('cost');
        $unit_id = $this->input->post('unit_id');

        $data = array(
            'name'       => $name,
            'cost'       => $cost,
            'unit_id'    => $unit_id,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
            'updated_by' => $this->session->userdata('id'),
        );
        $exec = $this->Hpp_model->store($data);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Tambah Hpp Gagal');
            session_write_close();
            redirect(base_url() . 'setup/hpp', 'location');
        }

        $this->session->set_flashdata('success', 'Tambah Hpp Berhasil');
        session_write_close();
        redirect(base_url() . 'setup/hpp', 'location');
    }
}
        
    /* End of file  Hpp.php */
