<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Request_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'NAMA REQUEST', 'required');
        $this->form_validation->set_rules('cost', 'BIAYA REQUEST', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list = $this->Request_model->get_all_data();
            $data = array(
                'title'   => 'Request',
                'page'    => 'request/main',
                'vitamin' => 'request/main_vitamin',
                'csrf'    => $csrf,
                'list'    => $list,
                'error'   => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $name = $this->input->post('name');
        $cost = $this->input->post('cost');

        $data = array(
            'name'       => $name,
            'cost'       => $cost,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $exec = $this->Request_model->store($data);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Tambah Request Gagal');
            session_write_close();
            redirect(base_url() . 'setup/parameter/request', 'location');
        }

        $this->session->set_flashdata('success', 'Tambah Request Berhasil');
        session_write_close();
        redirect(base_url() . 'setup/parameter/request', 'location');
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'NAMA REQUEST', 'required');
        $this->form_validation->set_rules('cost', 'BIAYA REQUEST', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list = $this->Request_model->get_single_data('id', $id);
            $data = array(
                'title' => 'Request',
                'page'  => 'request/form_edit',
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
            'name' => $this->input->post('name'),
            'cost' => $this->input->post('cost'),
        );
        $where = array('id' => $id);
        $exec  = $this->Request_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Edit Request Gagal');
            session_write_close();
            redirect(base_url() . 'setup/parameter/request', 'location');
        }

        $this->session->set_flashdata('success', 'Edit Request Berhasil');
        session_write_close();
        redirect(base_url() . 'setup/parameter/request', 'location');
    }

    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Request_model->destroy($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }
}
        
    /* End of file  Request.php */
