<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Supplier_model');
        $this->load->model('Satuan_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'NAMA SUPPLIER', 'required');
        $this->form_validation->set_rules('location', 'LOKASI', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list  = $this->Supplier_model->get_all_data();
            $units = $this->Satuan_model->get_all_data();
            $data = array(
                'title'   => 'SUPPLIER',
                'page'    => 'supplier/main',
                'vitamin' => 'supplier/main_vitamin',
                'csrf'    => $csrf,
                'list'    => $list,
                'units'   => $units,
                'error'   => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $name     = $this->input->post('name');
        $location = $this->input->post('location');

        $data = array(
            'name'       => $name,
            'location'   => $location,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $exec = $this->Supplier_model->store($data);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Tambah Supplier Gagal');
            redirect(base_url() . 'setup/supplier', 'location');
        }

        $this->session->set_flashdata('success', 'Tambah Supplier Berhasil');
        redirect(base_url() . 'setup/supplier', 'location');
    }

    public function update()
    {
        $id       = $this->input->post('xid');
        $name     = $this->input->post('xname');
        $location = $this->input->post('xlocation');

        $data = array(
            'name'       => $name,
            'location'   => $location,
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $where = array('id' => $id);
        $exec = $this->Supplier_model->update($data, $where);

        if (!$exec) {
            echo "Update data gagal, silahkan coba kembali!";
        }

        $this->session->set_flashdata('success', 'Update HPP Berhasil');
        redirect(base_url() . 'setup/supplier', 'location');
    }

    public function destroy($id)
    {
        $data = [
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        $exec = $this->Supplier_model->destroy($data, $where);
        $code = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Supplier.php */
